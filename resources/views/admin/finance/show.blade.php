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
                        <li class="breadcrumb-item "><a href="{{ route('admin.finance.index') }}">Anasayfa</a></li>
                        <li class="breadcrumb-item active">Siparişler</li>
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
                            <h5 class="card-title mb-0">Siparişler</h5>
                        </div>

                    </div>
                </div>
                <div class="card-body border border-dashed border-end-0 border-start-0">
{{--                   <x-order.order-navbar-filter :url="route('admin.order.index')"/>--}}
                </div>
                <div class="card-body pt-0">
                    <div>
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
                                            <td class="created_at">{{ $order?->created_at ?? '-' }}</td>
                                            <td class="name">
                                                {{ $order?->user?->full_name ??'-' }}
                                            </td>
                                            <td class="amount">
                                                {{ $order?->order_details_count ?? '-' }}
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
                                                        <a href="{{ route('admin.finance.salesPayment.index', ['company' => $company->hashid(),'order' => $order->hashid()]) }}" class="text-primary d-inline-block">
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
