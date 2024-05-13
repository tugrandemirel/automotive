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
                        <li class="breadcrumb-item active">Finans</li>
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
                            <h5 class="card-title mb-0">Finans</h5>
                        </div>
                        <div class="col-sm-auto">
                            <div class="d-flex gap-1 flex-wrap">
                                <a class="btn btn-success add-btn"  data-bs-toggle="modal" data-bs-target="#exampleModalgrid"><i
                                        class="ri-add-line align-bottom me-1"></i> Ödeme Ekle</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body border border-dashed border-end-0 border-start-0">
                    <form>
                        <div class="row g-3">
                            <div class="col-md-3 col-sm-3">
                                <div class="search-box">
                                    <input type="text" class="form-control search" name="name" value="{{ request()->get('name') }}" placeholder="Firma Adı Giriniz">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-1 col-sm-4">
                                <div class="hstack gap-2 ">
                                    <button type="submit" class="btn btn-primary w-100" ><i
                                            class="ri-search-line"></i>

                                    </button>
                                    @if(count(request()->all()) > 0)
                                        <button type="button" onclick="location.href = '{{route('admin.finance.index')}}'" class="btn btn-danger w-100" ><i
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
                                    <i class="ri-store-2-fill me-1 align-bottom"></i> SATIŞ ÖDEME
                                </a>
                            </li>

                        </ul>

                        <div class="table-responsive table-card mb-1">
                            @if($salesPayments->count() > 0)
                                <table class="table table-nowrap align-middle" id="orderTable">
                                    <thead class="text-muted table-light">
                                    {{--<tr class="text-uppercase">
                                        <th class="sort" data-sort="company_name">FİRMA ADI</th>
                                        <th class="sort" data-sort="customer_name">YETKİLİ KULLANICI</th>
                                        <th class="sort" data-sort="phone">TELEFON</th>
                                        <th class="sort" data-sort="payment">ÖDEME ŞEKLİ</th>
                                        <th class="sort" data-sort="total_order">TOPLAM ŞİPARİŞ</th>
                                        <th class="sort" data-sort="debt">BORÇ</th>
                                        <th class="sort" data-sort="total_payment">TOPLAM ÖDEME</th>
                                        <th class="sort" data-sort="action">İŞLEMLER</th>
                                    </tr>--}}
                                    </thead>
                                    <tbody class="list form-check-all">
                                    @foreach($salesPayments as $salesPayment)
                                        <tr>
                                            <td class="payment_method">
                                                <span
                                                    class="badge bg-{{ $salesPayment?->payment_method_color_formatted }}-subtle text-{{ $salesPayment?->payment_method_color_formatted }}"
                                                    data-toggle="tooltip"
                                                    title="{{ $salesPayment?->payment_method_formatted ??'-' }}">
                                                    {{ $salesPayment?->payment_method_formatted ??'-' }}
                                                </span>
                                            </td>
                                            <td class="">{{ $salesPayment?->created_at?->format('d/m/y') ?? '-' }}</td>
                                            <td class="">{{ $salesPayment?->description ?? '-' }}</td>

                                            <td class="">{{ $salesPayment?->amount ?? 0 }}</td>

                                            <td class="">{{ $salesPayment?->type }}</td>
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
                                {{ $salesPayments->links() }}
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
                    <h5 class="modal-title" id="exampleModalgridLabel">Ödeme Ekle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.finance.salesPayment.store', ['company' => $company?->hashid(), 'order' => $order?->hashid()]) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-xxl-12">
                                <div>
                                    <label for="importExcel" class="form-label">Açıklama</label>
                                    <input type="text" class="form-control" name="description">
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-12">
                                <div>
                                    <label for="importExcel" class="form-label">Ödeme Şekli</label>
                                    <input type="text" class="form-control" name="type">
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-12">
                                <div>
                                    <label for="importExcel" class="form-label">Tutar</label>
                                    <input type="number" class="form-control" name="amount">
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
@endpush
