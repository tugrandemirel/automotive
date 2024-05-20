@php use App\Enum\User\UserStatusEnum; @endphp

@extends('admin.layouts.app')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endpush
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Kullanıcı Düzenle</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Anasayfa</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Kullanıcılar</a></li>
                        <li class="breadcrumb-item active">Kullanıcı Düzenle</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <form id="" autocomplete="off" action="{{ route('admin.user.update', ['user' => $user?->hashid()]) }}" method="post"
          enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- end card -->

                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#addproduct-general-info"
                                   role="tab">
                                    Genel Bilgiler
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- end card header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="addproduct-general-info" role="tabpanel">
                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturer-name-input">Firmalar:</label>
                                            <select class="form-control company" name="company">
                                                @forelse($companies as $company)
                                                    <option
                                                        value="{{ $company?->id }}" @selected(old('company') && old('company') === (string)$company?->id ? old('company') === $company?->id : $user?->company_id === $company?->id)>{{ $company?->name }}</option>
                                                @empty
                                                    <option value="">LÜTFEN FİRMA OLUŞTURUNUZ</option>
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturer-name-input">Kullanıcı
                                                Adı:</label>
                                            <input type="text"
                                                   class="form-control @error('username') is-invalid @enderror"
                                                   value="{{ old('username') ? old('username') : $user?->username }}"
                                                   name="username">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturer-name-input">E-Posta:</label>
                                            <input type="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   value="{{ old('email') ? old('email') : $user?->email }}"
                                                   name="email">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturer-name-input">Şifre:</label>
                                            <input type="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   name="password">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturer-name-input">Kulanıcı
                                                Durumu:</label>
                                            <select class="form-control" name="status">
                                                <option
                                                    value="{{ UserStatusEnum::ACTIVE }}" @selected(old('status') && old('status') === UserStatusEnum::ACTIVE ? old('status') === UserStatusEnum::ACTIVE : $user?->status === UserStatusEnum::ACTIVE)>
                                                    Aktif
                                                </option>
                                                <option
                                                    value="{{ UserStatusEnum::PASSIVE }}" @selected(old('status') && old('status') === UserStatusEnum::PASSIVE ? old('status') === UserStatusEnum::PASSIVE : $user?->status === UserStatusEnum::PASSIVE)>
                                                    Pasif
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturer-name-input">Telefon:</label>
                                            <input type="text"
                                                   class="form-control phone @error('phone') is-invalid @enderror"
                                                   placeholder="(xxx)xxx-xxxx"
                                                   value="{{ old('phone') ? old('phone') : $user?->phone }}"
                                                   name="phone">
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->
                            </div>
                            <!-- end tab-pane -->
                            <!-- end tab pane -->
                        </div>
                        <!-- end tab content -->
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end row -->
                <!-- end card -->
                <div class="text-end mb-3">
                    <button type="submit" class="btn btn-success w-sm">Kaydet</button>
                </div>
            </div>
            <!-- end col -->
            <!-- end col -->
        </div>
        <!-- end row -->
    </form>
@endsection
@push('js')
    <!-- cleave.js -->
    <script src="{{ asset('assets/admin/libs/cleave.js/cleave.min.js') }}"></script>
    <!-- form masks init -->
    <script src="{{ asset('assets/admin/js/pages/form-masks.init.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.company').select2();
        });
    </script>
    <script>
        let phone = document.getElementsByClassName('phone');

        for (var i = 0; i < phone.length; i++) {
            cleaveBlocks = new Cleave(phone[i],
                {delimiters: ["(", ")", "-"], blocks: [0, 3, 3, 4]})
        }
    </script>
    <script>
        $(document).ready(function () {
            $('input[name="username"]').keypress(function () {
                let username = $(this)
                let value = username.val()
                let usernameRegex = /[\sışçöüğİŞÇÖÜĞ]/; // Boşluk ve Türkçe karakter içermeyen regex
                if(usernameRegex.test(value)) {
                    Swal.fire({
                        title: "Hata!",
                        text: "Kullanıcı adında türkçe karakter ve boşluk olmamalıdır.",
                        icon: "error",
                        confirmButtonText: "Tamam!",
                    })
                    return false
                }
            })
        })
    </script>
@endpush
