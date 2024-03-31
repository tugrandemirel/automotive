@php
    use App\Enum\Company\CompanyCreditCanPayEnum;
    use App\Enum\Company\CompanyCurrentCanPayEnum;use App\Enum\User\UserStatusEnum;
@endphp
@extends('admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Anasayfa</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Anasayfa</a></li>
                        <li class="breadcrumb-item active">Kullanıcılar</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="orderList">
                <div class="card-header border-0">
                    <div class="row align-items-center gy-3">
                        <div class="col-sm">
                            <h5 class="card-title mb-0">Kullanıcılar</h5>
                        </div>
                        <div class="col-sm-auto">
                            <div class="d-flex gap-1 flex-wrap">
                                <a class="btn btn-success add-btn" href="{{ route('admin.user.create') }}"><i
                                        class="ri-add-line align-bottom me-1"></i> Kullanıcı Ekle</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body border border-dashed border-end-0 border-start-0">
                    <form>
                        <div class="row g-3">
                            <div class="col-xxl-3 col-sm-3">
                                <div class="search-box">
                                    <input type="text" class="form-control search" placeholder="Ad/Ünvan Giriniz" name="company" value="{{ request()->get('company') }}">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-sm-3">
                                <div class="search-box">
                                    <input type="text" class="form-control search" name="fullname"
                                           placeholder="Kullanıcı Adı Giriniz" value="{{ request()->get('fullname') }}">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                            <!--end col-->
                            <!--end col-->

                            <!--end col-->
                            <div class="col-xxl-1 col-sm-4">
                                <div class="hstack gap-2 ">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="ri-search-line"></i>
                                    </button>
                                    @if(count(request()->all()) > 0)
                                        <button type="button" onclick="location.href = '{{route('admin.user.index')}}'"
                                                class="btn btn-danger w-100"><i
                                                class="ri-delete-bin-5-line"></i>

                                        </button>
                                    @endif
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>
                <div class="card-body pt-0">
                    <div>
                        <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active All py-3" data-bs-toggle="tab" id="All" href="#home1"
                                   role="tab" aria-selected="true">
                                    <i class="ri-store-2-fill me-1 align-bottom"></i> Kullanıcılar
                                </a>
                            </li>

                        </ul>

                        <div class="table-responsive table-card mb-1">
                            @if($users->count() > 0)
                            <table class="table table-nowrap align-middle" id="orderTable">
                                <thead class="text-muted table-light">
                                <tr class="text-uppercase">
                                    <th class="sort" data-sort="customer_name">Ad/Ünvan</th>
                                    <th class="sort" data-sort="username">Kullanıcı Adı</th>
                                    <th class="sort" data-sort="email">E-Posta</th>
                                    <th class="sort" data-sort="status">Durum</th>
                                    <th class="sort" data-sort="action">İşlemler</th>
                                </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                @foreach($users as $user)
                                    <tr>
                                        <td class="customer_name">{{ $user?->company?->name ?? '-' }}</td>
                                        <td class="phone">{{ $user?->full_name ?? '-' }}</td>
                                        <td class="email">
                                            {{ $user?->email ?? '-' }}
                                        </td>
                                        <td class="status">
                                            @if($user?->status === UserStatusEnum::ACTIVE)
                                                <span class="badge bg-success-subtle text-success" data-toggle="tooltip"
                                                      title="Aktif">Aktif</span>
                                            @else
                                                <span class="badge bg-danger-subtle text-danger" data-toggle="tooltip"
                                                      title="Pasif">Pasif</span>
                                            @endif
                                        </td>

                                        <td>
                                            <ul class="list-inline hstack gap-2 mb-0">
                                                <li class="list-inline-item edit" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" data-bs-placement="top" title="Düzenle">
                                                    <a href="{{ route('admin.user.edit', ['user' => $user->hashid()]) }}"
                                                       class="text-primary d-inline-block edit-item-btn">
                                                        <i class="ri-pencil-fill fs-16"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" data-bs-placement="top" title="Sil">
                                                    <a onclick="deleteItem('{{ route('admin.user.destroy', ['user' => $user->hashid()]) }}')"
                                                       class="text-danger d-inline-block remove-item-btn"
                                                    >
                                                        <i class="ri-delete-bin-5-fill fs-16"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @else
                                <x-no-found/>
                                @endif
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="pagination-wrap hstack gap-2">
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--end col-->
    </div>

@endsection
@push('js')
    <script>
        function deleteItem(url) {
            Swal.fire({
                title: 'Silmek İstediğinize Emin Misiniz?',
                icon: "question",
                text: 'Silme işleminiz onaylandığı anda bütün bağlı veriler silinecektir.',
                confirmButtonColor: "#DD6B55",
                cancelButtonColor: "#4b38b3",
                showCancelButton: true,
                confirmButtonText: "Evet, sil!",
                cancelButtonText: "Hayır, vazgeç!",
                reverseButtons: true
            }).then(result => {
                console.log('here')
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: url,
                        data: {_token: '{{ csrf_token() }}'},
                        success: function (response) {
                            Swal.fire({
                                title: "Başarılı!",
                                text: response.data.message,
                                icon: "success",
                                confirmButtonText: "Tamam!",
                            }).then(result => {
                                if (result.isConfirmed) {
                                    location.reload()
                                }
                            })
                        },
                        error: function (error) {
                            Swal.fire({
                                title: "Hata!",
                                text: response.data.message,
                                icon: "error",
                                confirmButtonText: "Tamam!",
                            }).then(result => {
                                if (result.isConfirmed) {
                                    location.reload()
                                }
                            })
                        }
                    })
                }
            })
        }
    </script>
@endpush
