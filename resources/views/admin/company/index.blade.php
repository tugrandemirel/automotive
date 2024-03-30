@php
    use App\Enum\Company\CompanyCreditCanPayEnum;
    use App\Enum\Company\CompanyCurrentCanPayEnum;
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
                        <li class="breadcrumb-item active">Firmalar</li>
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
                            <h5 class="card-title mb-0">Firmalar</h5>
                        </div>
                        <div class="col-sm-auto">
                            <div class="d-flex gap-1 flex-wrap">
                                <a class="btn btn-success add-btn" href="{{ route('admin.company.create') }}"><i
                                        class="ri-add-line align-bottom me-1"></i> Firma Ekle</a>
                                <button class="btn btn-soft-danger" id="remove-actions" onClick="deleteMultiple()"><i
                                        class="ri-delete-bin-2-line"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body border border-dashed border-end-0 border-start-0">
                    <form>
                        <div class="row g-3">
                            <div class="col-xxl-5 col-sm-6">
                                <div class="search-box">
                                    <input type="text" class="form-control search" placeholder="Firma Adı Giriniz">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                            <!--end col-->
                            <!--end col-->

                            <!--end col-->
                            <div class="col-xxl-1 col-sm-4">
                                <div>
                                    <button type="button" class="btn btn-primary w-100" onclick="SearchData();"><i
                                            class="ri-equalizer-fill me-1 align-bottom"></i>
                                        Filters
                                    </button>
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
                                    <i class="ri-store-2-fill me-1 align-bottom"></i> Firmalar
                                </a>
                            </li>

                        </ul>

                        <div class="table-responsive table-card mb-1">
                            <table class="table table-nowrap align-middle" id="orderTable">
                                <thead class="text-muted table-light">
                                <tr class="text-uppercase">
                                    <th class="sort" data-sort="customer_name">Ad/Ünvan</th>
                                    <th class="sort" data-sort="phone">Telefon</th>
                                    <th class="sort" data-sort="city">İl</th>
                                    <th class="sort" data-sort="district">İlçe</th>
                                    <th class="sort" data-sort="payment">Ödeme Şekli</th>
                                    <th class="sort" data-sort="general_discount">Genel İskonto</th>
                                    <th class="sort" data-sort="one_shot_discount">Tek Çekim İskonto</th>
                                    <th class="sort" data-sort="advance_discount">Peşin İskonto</th>
                                    <th class="sort" data-sort="action">İşlemler</th>
                                </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                @forelse($companies as $company)
                                    <tr>
                                        <td class="customer_name">{{ $company?->name ?? '-' }}</td>
                                        <td class="phone">{{ $company?->phone ?? '-' }}</td>
                                        <td class="city">
                                            {{ $company?->city ?? '-' }}
                                        </td>
                                        <td class="district">{{ $company?->district }}</td>
                                        <td class="payment">
                                            @if($company?->credit_can_pay === CompanyCreditCanPayEnum::TRUE)
                                                <span class="badge bg-success-subtle text-success" data-toggle="tooltip"
                                                      title="Kredi Kartı ile ödeyebilir">KK Ödeyebilir</span>
                                            @endif
                                            @if($company?->current_can_pay === CompanyCurrentCanPayEnum::TRUE)
                                                <span class="badge bg-success-subtle text-success" data-toggle="tooltip"
                                                      title="Cari ödeyebilir">Cari Ödeyebilir</span>
                                            @endif
                                        </td>
                                        <td class="general_discount">{{ $company?->general_discount ?? '-' }}</td>
                                        <td class="one_shot_discount">{{ $company?->one_shot_discount ?? '-' }}</td>
                                        <td class="credit_discount">{{ $company?->advance_discount ?? '-' }}</td>
                                        <td>
                                            <ul class="list-inline hstack gap-2 mb-0">
                                               {{-- <li class="list-inline-item" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" data-bs-placement="top" title="View">
                                                    <a href="apps-ecommerce-order-details.html"
                                                       class="text-primary d-inline-block">
                                                        <i class="ri-eye-fill fs-16"></i>
                                                    </a>
                                                </li>--}}
                                                <li class="list-inline-item edit" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" data-bs-placement="top" title="Düzenle">
                                                    <a href="{{ route('admin.company.edit', ['company' => $company->hashid()]) }}"
                                                       class="text-primary d-inline-block edit-item-btn">
                                                        <i class="ri-pencil-fill fs-16"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" data-bs-placement="top" title="Sil">
                                                    <a onclick="deleteItem('{{ route('admin.company.destroy', ['company' => $company->hashid()]) }}')" class="text-danger d-inline-block remove-item-btn"
                                                      >
                                                        <i class="ri-delete-bin-5-fill fs-16"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @empty
                                    <x-no-found/>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="pagination-wrap hstack gap-2">
                                {{ $companies->links() }}
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
                if(result.isConfirmed) {
                    $.ajax({
                        type:'DELETE',
                        url: url,
                        data: { _token: '{{ csrf_token() }}'},
                        success: function (response) {
                            Swal.fire({
                                title: "Başarılı!",
                                text: response.data.message,
                                icon: "success",
                                confirmButtonText: "Tamam!",
                            }).then(result => {
                                if(result.isConfirmed) {
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
                                if(result.isConfirmed) {
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
