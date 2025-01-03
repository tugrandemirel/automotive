@php
    use App\Enum\Company\CompanyCreditCanPayEnum;
    use App\Enum\Company\CompanyCurrentCanPayEnum;use App\Enum\Product\ProductUnitEnum;use App\Enum\User\UserStatusEnum;
@endphp
@extends('admin.layouts.app')
@push('css')
@endpush
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Anasayfa</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Anasayfa</a></li>
                        <li class="breadcrumb-item active">Ürünler</li>
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
                            <h5 class="card-title mb-0">Ürünler</h5>
                        </div>
                        <div class="col-sm-auto">
                            <div class="d-flex gap-1 flex-wrap">
                                <a class="btn btn-success add-btn"  data-bs-toggle="modal" data-bs-target="#exampleModalgrid"><i
                                        class="ri-file-upload-fill align-bottom me-1"></i> Ürün Yükle</a>
                                <a class="btn btn-success add-btn" href="{{ route('admin.product.create') }}"><i
                                        class="ri-add-line align-bottom me-1"></i> Ürün Ekle</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body border border-dashed border-end-0 border-start-0">
                    <form id="searchForm">
                        <div class="row g-3">
                            <div class="col-xxl-3 col-sm-6">
                                <div class="search-box">
                                    <input type="text" class="form-control search" name="name" value="{{ request()->get('name')  }}" placeholder="Ürün Adı Giriniz">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-sm-6">
                                <div class="search-box">
                                    <input type="text" class="form-control search" name="ref" value="{{ request()->get('ref')  }}" placeholder="Ürün Referans Kodu Giriniz">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                            <!--end col-->
                            <!--end col-->

                            <!--end col-->
                            <div class="col-xxl-1 col-sm-4">
                                <div class="hstack gap-2 ">
                                    <button type="submit" class="btn btn-primary w-100" ><i
                                            class="ri-search-line"></i>

                                    </button>
                                    @if(count(request()->all()) > 0)
                                    <button type="button" onclick="location.href = '{{route('admin.product.index')}}'" class="btn btn-danger w-100" ><i
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
                                    <i class="ri-store-2-fill me-1 align-bottom"></i> Ürünler
                                </a>
                            </li>

                        </ul>

                        <div class="table-responsive table-card mb-1">
                            @if($products->count())
                            <table class="table table-nowrap align-middle" id="orderTable">
                                <thead class="text-muted table-light">
                                <tr class="text-uppercase">
                                    <th class="sort" data-sort="code">ÜRÜN/REFERANS KODU</th>
                                    <th class="sort" data-sort="name">ÜRÜN Adı</th>
                                    <th class="sort" data-sort="brand">MARKA</th>
                                    <th class="sort" data-sort="unit">BİRİM</th>
                                    <th class="sort" data-sort="purchase_price">ALIŞ FİYATI</th>
                                    <th class="sort" data-sort="sale_price">SATIŞ FİYATI</th>
                                    <th class="sort" data-sort="quantity">STOK ADEDİ</th>
                                    <th class="sort" data-sort="action">İŞLEMLER</th>
                                </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                @foreach($products as $product)
                                    <tr>
                                        <td class="code">{{ $product?->code ?? '-' }}</td>
                                        <td class="name">{{ $product?->name ?? '-' }}</td>
                                        <td class="brand">
                                            {{ $product?->brand?->name ?? '-' }}
                                        </td>
                                        <td class="unit">
                                            @if($product?->unit ===  ProductUnitEnum::PIECE)
                                                <span class="badge bg-info-subtle text-info" data-toggle="tooltip"
                                                      title="Aktif">Adet</span>
                                            @else
                                                <span class="badge bg-info-subtle text-info" data-toggle="tooltip"
                                                      title="Pasif">Takım</span>
                                            @endif
                                        </td>
                                        <td class="purchase_price">
                                            {{ number_format($product?->purchase_price, 2) ?? '-' }}
                                        </td>
                                        <td class="sale_price">
                                            {{ number_format($product?->sale_price, 2) ?? '-' }}
                                        </td>
                                        <td class="quantity">
                                            {{ $product?->quantity ?? '-' }}
                                        </td>
                                        <td>
                                            <ul class="list-inline hstack gap-2 mb-0">
                                                <li class="list-inline-item edit" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" data-bs-placement="top" title="Düzenle">
                                                    <a href="{{ route('admin.product.edit', ['product' => $product?->slug]) }}"
                                                       class="text-primary d-inline-block edit-item-btn">
                                                        <i class="ri-pencil-fill fs-16"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" data-bs-placement="top" title="Sil">
                                                    <a onclick="deleteItem('{{ route('admin.product.destroy', ['product' => $product?->hashid()]) }}')"
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
                                {{ $products->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--end col-->
    </div>
    <div class="modal fade" id="exampleModalgrid" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalgridLabel">Ürün Yükle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.product.import') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-xxl-12">
                                <div>
                                    <label for="importExcel" class="form-label">Excel Dosyası</label>
                                    <input type="file" class="form-control" name="file" id="importExcel">
                                </div>
                            </div><!--end col-->
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">İptal Et</button>
                                    <button type="submit" class="btn btn-primary">Kaydet</button>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </form>
                </div>
            </div>
        </div>
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
