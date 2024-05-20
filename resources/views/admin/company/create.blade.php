@php
    use App\Enum\Company\CompanyCreditCanPayEnum;
     use App\Enum\Company\CompanyCurrentCanPayEnum;
     use App\Enum\Company\CompanyCurrentEnum;
@endphp
@extends('admin.layouts.app')
@push('css')
    <!-- Plugins css -->
    <link href="{{ asset('assets/admin/libs/dropzone/dropzone.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Firma Ekle</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Anasayfa</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.company.index') }}">Firmalar</a></li>
                        <li class="breadcrumb-item active">Firma Ekle</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <form id="" autocomplete="off" action="{{ route('admin.company.store') }}" method="post"
          enctype="multipart/form-data">
        @csrf
        <div class="row">
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
                                            <label class="form-label" for="manufacturer-name-input">Ad/Ünvan:</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                   value="{{ old('name') }}"
                                                   name="name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturer-name-input">Müşteri
                                                Kodu:</label>
                                            <input type="text" class="form-control @error('code') is-invalid @enderror"
                                                   value="{{ old('code') }}"
                                                   name="code">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturer-name-input">Vergi
                                                Dairesi:</label>
                                            <input type="text"
                                                   class="form-control @error('tax_administration') is-invalid @enderror"
                                                   value="{{ old('tax_administration') }}"
                                                   name="tax_administration">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturer-name-input">Vergi Numarası/TC
                                                Kimlik Numarası:</label>
                                            <input type="text"
                                                   class="form-control @error('identity_number') is-invalid @enderror"
                                                   value="{{ old('identity_number') }}"
                                                   name="identity_number">
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row">
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="stocks-input">Cari:</label>
                                            <select name="current" id=""
                                                    class="form-select @error('current') is-invalid @enderror">
                                                <option value="{{ CompanyCurrentEnum::CURRENT }}" selected>Cari</option>
                                                <option value="{{ CompanyCurrentEnum::NOT_CURRENT }}" >Cari Değil
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="stocks-input">Cari Ödeyebilir:</label>
                                            <select name="current_can_pay" id=""
                                                    class="form-select @error('current_can_pay') is-invalid @enderror">
                                                <option value="{{ CompanyCurrentCanPayEnum::TRUE }}" selected>Ödeyebilir</option>
                                                <option value="{{ CompanyCurrentCanPayEnum::FALSE }}" >Ödeyemez</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="stocks-input">Kredi Karti ile
                                                Ödeyebilir:</label>
                                            <select name="credit_can_pay" id=""
                                                    class="form-select @error('credit_can_pay') is-invalid @enderror">
                                                <option value="{{ CompanyCreditCanPayEnum::TRUE }}" >Ödeyebilir</option>
                                                <option value="{{ CompanyCreditCanPayEnum::FALSE }}" selected>Ödeyemez</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="stocks-input">Genel İskonto:</label>
                                            <input name="general_discount" type="number" step="any" min="0" id="" value="{{ old('general_discount') ?? 0 }}"
                                                   class="form-control @error('general_discount') is-invalid @enderror"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="stocks-input">Peşin İskonto:</label>
                                            <input name="advance_discount" type="number" step="any" min="0" id="" value="{{ old('advance_discount') ?? 0 }}"
                                                   class="form-control @error('advance_discount') is-invalid @enderror"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="stocks-input">Tek Çekim İskonto:</label>
                                            <input name="one_shot_discount" type="number" step="any" min="0" id="" value="{{ old('one_shot_discount') ?? 0 }}"
                                                   class="form-control @error('one_shot_discount') is-invalid @enderror"/>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                                <div class="row mb-3">
                                    <h5 class="fs-13 mb-1">Açıklama Not:</h5>
                                    <div class="fallback">
                                        <textarea name="description" class="form-control" id="" cols="30" rows="10">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <h5 class="fs-13 mb-1">Dosya:</h5>
                                    <div class="fallback">
                                        <input name="file" type="file" multiple="multiple">
                                    </div>
                                </div>
                            </div>
                            <!-- end tab-pane -->
                            <!-- end tab pane -->
                        </div>
                        <!-- end tab content -->
                    </div>
                    <!-- end card body -->
                </div>
                <div class="row authorizedPeople">
                    <div class="col-xl-12 authorizedPerson" id="card-none2">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <h6 class="card-title mb-0">Yetkili Ekle</h6>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <ul class="list-inline card-toolbar-menu d-flex align-items-center mb-0">
                                            <li class="list-inline-item">
                                                <a class="align-middle minimize-card  add-card">
                                                    <i class="mdi mdi-plus-box align-middle"
                                                       style="font-size: 25px; cursor: pointer;"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body show" id="">
                                <div class="row ">
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="stocks-input">Görev:</label>
                                            <input name="authorized_person[duty][]" type="text"
                                                   class="form-control @error('authorized_person.duty') is-invalid @enderror"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="stocks-input">Ad:</label>
                                            <input name="authorized_person[name][]" type="text"
                                                   class="form-control @error('authorized_person.name') is-invalid @enderror"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="stocks-input">Telefon:</label>
                                            <input name="authorized_person[phone][]" id="cleave-phone2"
                                                   placeholder="(xxx)xxx-xxxx" type="text"
                                                   class="phone form-control @error('authorized_person.phone') is-invalid @enderror"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="stocks-input">GSM:</label>
                                            <input name="authorized_person[gsm][]" type="text"
                                                   class="form-control @error('authorized_person.gsm') is-invalid @enderror"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="stocks-input">Email:</label>
                                            <input name="authorized_person[email][]" type="text"
                                                   class="form-control @error('authorized_person.email') is-invalid @enderror"/>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->
                </div>
                <!-- end row -->
                <!-- end card -->
                <div class="text-end mb-3">
                    <button type="submit" class="btn btn-success w-sm">Kaydet</button>
                </div>
            </div>
            <!-- end col -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">İletişim</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="cleave-phone" class="form-label">Telefon:</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="cleave-phone" name="phone"
                                   value="{{ old('phone') }}"
                                   placeholder="(xxx)xxx-xxxx">
                        </div>
                        <div>
                            <label for="choices-publish-visibility-input" class="form-label">E-Posta</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email">
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Adres</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="city" class="form-label">İl:</label>
                            <input type="text" class="form-control @error('city') is-invalid @enderror" value="{{ old('city') }}" name="city">
                        </div>
                        <div class="mb-3">
                            <label for="district" class="form-label">İlçe:</label>
                            <input type="text" class="form-control @error('district') is-invalid @enderror" value="{{ old('district') }}"  name="district">
                        </div>
                        <div class="mb-3 " id="addresses">
                            <p class="text-muted mb-2"><a onclick="addAddressLine()"
                                                          class="float-end text-decoration-underline">Yeni
                                    Adres Satırı</a></p>
                            <input type="text" class="form-control" name="address[]">
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
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
    <script src="{{ asset('assets/admin/libs/dropzone/dropzone-min.js') }}"></script>

    <script>
        $('.add-card').click(function () {
            let html = `<div class="col-xl-12 authorizedPerson" id="card-none2">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <h6 class="card-title mb-0">Yetkili Ekle</h6>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <ul class="list-inline card-toolbar-menu d-flex align-items-center mb-0">
                                            <li class="list-inline-item">
                                                <a class="align-middle minimize-card  remove-card">
                                                    <i class="mdi mdi-close align-middle" style="font-size: 25px; cursor: pointer; color:red;"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body show" id="">
                                <div class="row ">
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="stocks-input">Görev:</label>
                                            <input name="authorized_person[duty][]" type="text" class="form-control @error('authorized_person.duty') is-invalid @enderror"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="stocks-input">Ad:</label>
                                            <input name="authorized_person[name][]" type="text" class="form-control @error('authorized_person.name') is-invalid @enderror"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="stocks-input">Telefon:</label>
                                            <input name="authorized_person[phone][]"  id="cleave-phone2" placeholder="(xxx)xxx-xxxx" type="text" class="phone form-control @error('authorized_person.phone') is-invalid @enderror"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="stocks-input">GSM:</label>
                                            <input name="authorized_person[gsm][]" type="text" class="form-control @error('authorized_person.gsm') is-invalid @enderror"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="stocks-input">Email:</label>
                                            <input name="authorized_person[email][]" type="email" class="form-control @error('authorized_person.email') is-invalid @enderror"/>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->`
            $('.authorizedPeople').append(html)

            $('.authorizedPerson').on('click', '.remove-card', function () {
                event.preventDefault()
                $(this).closest('.authorizedPerson').remove();
            });
        })
    </script>
    <script>
        let phone = document.getElementsByClassName('phone');

        for (var i = 0; i < phone.length; i++) {
            cleaveBlocks = new Cleave(phone[i],
                {delimiters: ["(", ")", "-"], blocks: [0, 3, 3, 4]})
        }
    </script>
    <script>
        function addAddressLine() {
            // Yeni bir div öğesi oluşturun
            var newDiv = document.createElement("div");
            newDiv.className = "mb-3";

            // Yeni bir input öğesi oluşturun
            var newInput = document.createElement("input");
            newInput.type = "text";
            newInput.className = "form-control";
            newInput.name = "address[]";

            // Yeni bir paragraf öğesi oluşturun
            var newParagraph = document.createElement("p");
            newParagraph.className = "text-muted mb-2";

            // Paragrafı yeni div öğesine ekleyin
            newDiv.appendChild(newParagraph);

            // Yeni input öğesini yeni div öğesine ekleyin
            newDiv.appendChild(newInput);

            // addresses divine yeni div öğesini ekleyin
            document.getElementById("addresses").appendChild(newDiv);
        }
    </script>
@endpush
