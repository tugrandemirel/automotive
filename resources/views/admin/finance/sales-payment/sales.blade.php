@php use App\Enum\Order\OrderStatusEnum; @endphp
@extends('admin.layouts.app')
@section('content')
    <!--end row-->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Anasayfa</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Anasayfa</a></li>
                        <li class="breadcrumb-item active">Satışlar</li>
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
                            <h5 class="card-title mb-0">Satışlar ve Ödemeler</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body border border-dashed border-end-0 border-start-0">
                    <h6 class="card-title mb-0">{{ $company?->name }}</h6>
                </div>
                <div class="card-body pt-0">
                    <div>
                        <form id="filterForm">
                            <div class="row g-3">
                                <div class="col-xxl-4 col-sm-6">
                                    <div class="search-box">
                                        <input type="text" class="form-control search" name="code" value="{{ request()->get('code') }}" placeholder="Sipariş Numarası giriniz">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-sm-6">
                                    <div class="search-box">
                                        <input type="date" class="form-control search" name="date" value="{{ request()->get('date') }}" placeholder="Tarih seçiniz">
                                        <i class="ri-calendar-2-fill search-icon"></i>
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-sm-6">
                                    <div class="search-box">
                                        <input type="user" class="form-control search" name="user" value="{{ request()->get('user') }}" placeholder="Sipariş veren giriniz">
                                        <i class="ri-calendar-2-fill search-icon"></i>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-1 col-sm-4">
                                    <div class="hstack gap-2 ">
                                        <button type="submit" class="btn btn-primary w-100"><i
                                                class="ri-search-line"></i>
                                        </button>
                                        @if(count(request()->all()) > 0)
                                            <button type="button" onclick="location.href = '{{ route('admin.finance.show', ['company' => $company->hashid()]) }}'" class="btn btn-danger w-100"><i
                                                    class="ri-delete-bin-5-line"></i>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </form>
                        <x-payment-sales.navbar :active="'sales'"  :company="$company"/>
                        <div class="table-responsive table-card mb-1">
                            @if($orders->count())
                                <table class="table table-nowrap align-middle" id="orderTable">
                                    <thead class="text-muted table-light">
                                    <tr class="text-uppercase">
                                        <th data-sort="code">SİPARİŞ KODU</th>
                                        <th data-sort="created_at">SİPARİŞ TARİHİ</th>
                                        <th data-sort="product_name">SİPARİŞ VEREN</th>
                                        <th data-sort="amount">ÜRÜN TUTARI</th>
                                        <th data-sort="payment">ÖDEME YÖNTEMİ</th>
                                        <th data-sort="action">İŞLEMLER</th>
                                    </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                    @foreach($orders as $order)
                                        <tr>
                                            <td class="code">{{ $order?->code ?? '-' }}</td>
                                            <td class="created_at">{{ $order?->created_at->format('d/m/y') ?? '-' }}</td>
                                            <td class="name">
                                                {{ $order?->user?->username ??'-' }}
                                            </td>
                                            <td class="amount">
                                                {{ number_format($order?->order_details_sum_total_price, 2) ?? '-' }} TL
                                            </td>
                                            <td class="payment_method">
                                                <span
                                                    class="badge bg-{{ $order?->payment_method_color_formatted }}-subtle text-{{ $order?->payment_method_color_formatted }}"
                                                    data-toggle="tooltip"
                                                    title="{{ $order?->payment_method_formatted ??'-' }}">
                                                    {{ $order?->payment_method_formatted ??'-' }}
                                                </span>
                                            </td>
                                            <td>
                                                <ul class="list-inline hstack gap-2 mb-0">
                                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                        data-bs-placement="top" title="View">
                                                        <a href="{{ route('admin.order.show', ['order' => $order->hashid()]) }}" class="text-primary d-inline-block">
                                                            <i class="ri-eye-fill fs-16"></i>
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
                                {{ $orders->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
