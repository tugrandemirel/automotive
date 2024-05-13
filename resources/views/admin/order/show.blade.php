@extends('admin.layouts.app')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Sipariş Detayı</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.order.index') }}">Siparişler</a></li>
                        <li class="breadcrumb-item active">Sipariş Detayı</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    @isset($order)
    <div class="row">
        <div class="col-xl-9">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title flex-grow-1 mb-0">Sipariş #{{ $order->code }}</h5>
                        {{--  <div class="flex-shrink-0">
                              <a href="apps-invoices-details.html" class="btn btn-success btn-sm"><i class="ri-download-2-fill align-middle me-1"></i> Invoice</a>
                          </div>--}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap align-middle table-borderless mb-0">
                            <thead class="table-light text-muted">
                            <tr>
                                <th scope="col">Ref Kod</th>
                                <th scope="col">Ürün Adı</th>
                                <th scope="col">Marka</th>
                                <th scope="col">Birim</th>
                                <th scope="col">Fiyat</th>
                                <th scope="col">Adet</th>
                                <th scope="col">İskonto</th>
                                <th scope="col">Net Fiyat + KDV</th>
                                <th scope="col">Tutar</th>
                                <th scope="col">Sipariş Durumu</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $generalTotalPrice = 0;
                                $totalPrice = 0;
                            @endphp
                            @foreach($orderDetails as $order)
                                <tr>
                                    <td>
                                        {{ $order?->product_code ?? '-' }}
                                    </td>
                                    <td>
                                        {{ $order?->product?->name ??'-' }}
                                    </td>
                                    <td>
                                        {{ $order?->product?->brand?->name ??'-' }}
                                    </td>
                                    <td>
                                        {{ $order?->unit_formatted ??'-' }}
                                    </td>
                                    <td>
                                        @php
                                            $totalPrice+= $order?->price * $order->quantity
                                        @endphp
                                        {{ $order?->price }}
                                    </td>
                                    <td>
                                        {{ $order?->quantity ?? 0 }}
                                    </td>
                                    <td>
                                        {{ $order?->general_discount ??'-' }}
                                    </td>
                                    <td>

                                        {{ $order?->net_price_vat ??'-' }}
                                    </td>
                                    <td>
                                        @php
                                            $generalTotalPrice+=$order?->total_price;
                                        @endphp
                                        {{ $order?->total_price ??'-' }}
                                    </td>
                                    <td>
                                        {{ $order?->status_formatted ??'-' }}
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="border-top border-top-dashed">
                                <td class="fw-medium p-0">
                                    <table class="table table-borderless mb-0">
                                        <tbody>
                                        <tr>
                                            <td>Toplam Tutar :</td>
                                            <td class="text-end">{{ $totalPrice }}</td>
                                        </tr>
                                        <tr>
                                            <td>İskonto :</td>
                                            <td class="text-end">{{ $totalPrice - $generalTotalPrice ?? '-' }}</td>
                                        </tr>
                                        <tr class="border-top border-top-dashed">
                                            <th scope="row">Genel Toplam :</th>
                                            <th class="text-end">{{ $generalTotalPrice }}</th>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
        <div class="col-xl-3">
            {{--<div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h5 class="card-title flex-grow-1 mb-0"><i class="mdi mdi-truck-fast-outline align-middle me-1 text-muted"></i> Logistics Details</h5>
                        <div class="flex-shrink-0">
                            <a href="javascript:void(0);" class="badge bg-primary-subtle text-primary fs-11">Track Order</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <lord-icon src="https://cdn.lordicon.com/uetqnvvg.json" trigger="loop" colors="primary:#4b38b3,secondary:#0ab39c" style="width:80px;height:80px"></lord-icon>
                        <h5 class="fs-16 mt-2">RQK Logistics</h5>
                        <p class="text-muted mb-0">ID: MFDS1400457854</p>
                        <p class="text-muted mb-0">Payment Mode : Debit Card</p>
                    </div>
                </div>
            </div>--}}
            <!--end card-->
            @isset($company)
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h5 class="card-title flex-grow-1 mb-0">Müşteri Detayları</h5>
                        <div class="flex-shrink-0">
                            <a href="{{ route('admin.company.edit', ['company' => $company?->hashid()]) }}" class="link-secondary">Görüntüle</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0 vstack gap-3">
                        <li>
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fs-14 mb-1">{{ $company?->name ?? '-' }}</h6>
                                    <p class="text-muted mb-0">Müşteri</p>
                                </div>
                            </div>
                        </li>
                        <li><i class="ri-mail-line me-2 align-middle text-muted fs-16"></i>{{ $company?->email ?? '-' }}</li>
                        <li><i class="ri-phone-line me-2 align-middle text-muted fs-16"></i>{{ $company?->phone ?? '-' }}</li>
                    </ul>
                </div>
            </div>
            @endisset
            @isset($user)
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h5 class="card-title flex-grow-1 mb-0">Sipariş Veren</h5>
                        <div class="flex-shrink-0">
                            <a href="{{ route('admin.user.edit', ['user' => $user?->hashid()]) }}" class="link-secondary">Görüntüle</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0 vstack gap-3">
                        <li>
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fs-14 mb-1">{{ $user?->name ?? '-' }}</h6>
                                    <p class="text-muted mb-0">Sipariş Veren</p>
                                </div>
                            </div>
                        </li>
                        <li><i class="ri-mail-line me-2 align-middle text-muted fs-16"></i>{{ $user?->email ?? '-' }}</li>
                        <li><i class="ri-phone-line me-2 align-middle text-muted fs-16"></i>{{ $user?->phone ?? '-' }}</li>
                    </ul>
                </div>
            </div>
            @endisset
            @isset($company)
            <!--end card-->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="ri-map-pin-line align-middle me-1 text-muted"></i> Teslimat Adresi</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled vstack gap-2 fs-13 mb-0">
                        <li class="fw-medium fs-14"></li>
                        <li>{{ $company->phone ?? '' }}</li>
                        <li>
                            @foreach($company->address as $address)
                                {{ $address }}
                            @endforeach
                        </li>
                        <li>{{ $company?->city ?? '' }} {{ $company?->district ?? ''}}</li>

                    </ul>
                </div>
            </div>
            @endisset
            <!--end card-->

            <!--end card-->
        </div>
        <!--end col-->
    </div>
    @endisset
    <!--end row-->
@endsection
