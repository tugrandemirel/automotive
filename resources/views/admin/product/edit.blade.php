@php
    use App\Enum\Product\ProductStatusEnum;
    use App\Enum\Product\ProductUnitEnum;
    use App\Enum\SystemSetting\Currency\CurrencyMainEnum;
@endphp

@extends('admin.layouts.app')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css"/>
    <script src="https://cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
@endpush
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Ürün Ekle</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Anasayfa</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Ürünlar</a></li>
                        <li class="breadcrumb-item active">Ürün Ekle</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <form action="{{ route('admin.product.update', ['product' => $product?->slug]) }}" autocomplete="off" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="code">Ürün Kodu/ Referans
                                        Kodu:</label>
                                    <input type="text" class="form-control  @error('code') is-invalid @enderror"
                                           id="code" name="code"
                                           value="{{ old('code') ? old('code') : $product?->code }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="name">Ürün Adı:</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           id="name" name="name"
                                           value="{{ old('name') ? old('name') : $product?->name }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="quantity">Stok Adeti:
                                        Kodu:</label>
                                    <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                           id="quantity" maxlength="999999" name="quantity"
                                           value="{{ old('quantity') ? old('quantity') : $product?->quantity }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="critical_quantity">Kritik Stok Adeti:</label>
                                    <input type="number"
                                           class="form-control @error('critical_quantity') is-invalid @enderror"
                                           id="critical_quantity" maxlength="999999" name="critical_quantity"
                                           value="{{ old('critical_quantity') ? old('critical_quantity') : $product?->critical_quantity }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="purchase_price">Alış Fiyatı:</label>
                                    <input type="number"
                                           class="form-control @error('purchase_price') is-invalid @enderror"
                                           id="purchase_price"
                                           name="purchase_price"
                                           value="{{ old('purchase_price') ? old('purchase_price') : $product?->purchase_price }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="sale_price">Satış Fiyatı:</label>
                                    <input type="number" class="form-control @error('sale_price') is-invalid @enderror"
                                           id="sale_price" name="sale_price"
                                           value="{{ old('sale_price') ? old('sale_price') : $product?->sale_price }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="product-title-input">Para Birimi:</label>
                                    <select class="form-select @error('currency_id') is-invalid @enderror" name="currency_id">
                                        <option value="" selected>Seçiniz</option>
                                        @foreach($currencies as $curreny)
                                            <option
                                                value="{{ $curreny?->id }}" @selected($curreny?->id === $product?->currency_id || old('currency_id') == $curreny?->id)>
                                                {{ $curreny?->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="description">Ürün Detay:</label>
                                    <textarea name="description" id="description" class="ckeditor1" cols="30"
                                              rows="10">{{ old('description') ? old('description') : $product?->description }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Ürün Resimleri</h5>
                    </div>
                    <div class="card-body images">
                        <ul class="list-unstyled mb-0" id="dropzone-preview">
                            @foreach($product?->productMedias as $media)
                                <li class="mt-2" id="dropzone-preview-list">
                                    <!-- This is used as the file preview template -->
                                    <div class="border rounded">
                                        <div class="d-flex p-2">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar-sm bg-light rounded">
                                                    <img class="img-fluid rounded d-block" src="{{ asset($media?->path) }}" alt="{{ $media?->path }}" />
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="pt-1">
                                                    <h5 class="fs-14 mb-1" >&nbsp;</h5>
                                                    <p class="fs-13 text-muted mb-0" ></p>
                                                    <strong class="error text-danger" ></strong>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0 ms-3">
                                                <button onclick="deleteImages('{{ route('admin.product.single_image_destroy', ['media' => $media?->hashid()]) }}')" type="button" class="btn btn-sm btn-danger">Sil</button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="row mt-2">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <input type="file" class="form-control" name="images[]" value="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <button type="button" id="add"
                                            class="btn btn-success btn-label rounded-pill waves-effect waves-light"><i
                                            class="ri-add-circle-fill label-icon align-middle rounded-pill fs-16 me-2"></i>Ekle
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#addproduct-metadata" role="tab">
                                    SEO
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- end card header -->
                    <div class="card-body">
                        <div class="tab-content">

                            <div class="tab-pane active" id="addproduct-metadata" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="meta-keywords-input">SEO Meta Anahtar
                                                Kelime</label>
                                            <input type="text"
                                                   class="form-control @error('meta_keywords') is-invalid @enderror"
                                                   id="meta_keywords"
                                                   name="meta_keywords" value="{{ old('meta_keywords') ? old('meta_keywords') : $product?->meta_keywords }}">
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row -->

                                <div>
                                    <label class="form-label" for="meta-description-input">SEO Meta Açıklama</label>
                                    <textarea class="form-control @error('meta_description') is-invalid @enderror"
                                              name="meta_description" rows="3">{{ old('meta_description') ? old('meta_description') : $product?->meta_description }}</textarea>
                                </div>
                            </div>
                            <!-- end tab pane -->
                        </div>
                        <!-- end tab content -->
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
                <div class="text-end mb-3">
                    <button type="submit" class="btn btn-success w-sm">Kaydet</button>
                </div>
            </div>
            <!-- end col -->

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Yayın Durumu</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="choices-publish-status-input" class="form-label">Durum</label>
                            <select class="form-select @error('status') is-invalid @enderror" name="status">
                                <option value="" selected>Seçiniz</option>
                                <option value="{{ ProductStatusEnum::ACTIVE }}" @selected($product?->status === ProductStatusEnum::ACTIVE )>Aktf</option>
                                <option value="{{ ProductStatusEnum::PASSIVE }}" @selected($product?->status === ProductStatusEnum::PASSIVE )>Pasif</option>
                            </select>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Marka</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="choices-publish-status-input" class="form-label">Marka:</label>
                            <select class="form-control brand @error('brand') is-invalid @enderror" name="brand">
                                @forelse($brands as $brand)
                                    <option
                                        value="{{ $brand?->slug }}" @selected($product?->brand_id === $brand?->id)>{{ $brand?->name }}</option>
                                @empty
                                    <option value="">LÜTFEN NARKA OLUŞTURUNUZ</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Birim</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="choices-publish-status-input" class="form-label">Birim:</label>
                            <select class="form-control @error('unit') is-invalid @enderror" name="unit">
                                <option value="{{ ProductUnitEnum::PIECE }}" @selected( $product?->unit === ProductUnitEnum::PIECE)>
                                    Adet
                                </option>
                                <option value="{{ ProductUnitEnum::SET }}" @selected( $product?->unit === ProductUnitEnum::SET)>
                                    Takım
                                </option>
                            </select>
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

    <script type="text/javascript">

        let ck = document.querySelectorAll('.ckeditor1');
        for (let i = 0; i < ck.length; i++) {
            CKEDITOR.replace(ck[i], {
                height: 300
            });
        }
    </script>
    <script>
        var inputElm = document.querySelector('#meta_keywords'),
            tagify = new Tagify(inputElm);
    </script>

    <script>
        $(document).ready(function () {
            $('#add').click(function () {
                let html = `<div class="row"><hr><div class="col-sm-6">
                                <div class="mb-3">
                                    <input type="file" class="form-control" name="images[]" value="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <button type="button" class="btn btn-danger btn-label rounded-pill waves-effect waves-light remove-product"><i class="ri-delete-back-2-fill label-icon align-middle rounded-pill fs-16 me-2"></i>Sil</button>
                                </div>
                            </div></div>`;
                $('.images').append(html);
            })
            $('.images').on('click', '.remove-product', function () {
                $(this).closest('.row').remove();
            })
        })
    </script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.brand').select2();
        });
    </script>
    <script>
        function deleteImages(url) {
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
                                text: error.message,
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
