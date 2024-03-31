@extends('app.layouts.app')
@section('title', 'Sipariş Detay')
@section('content')
    <div class="page-wrapper">
        <section class="cart-page-area-wrapper mt-120 mt-md-80 mt-sm-60 mb-120 mb-md-80 mb-sm-60">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-9">
                        <div class="shopping-cart-list-area">
                            <div class="shopping-cart-table table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                    <tr>
                                        <th>REF KOD</th>
                                        <th>ÜRÜN ADI</th>
                                        <th>MARKA</th>
                                        <th>BİRİM</th>
                                        <th>FİYAT</th>
                                        <th>ADET</th>
                                        <th>İSKONTO</th>
                                        <th>NET FİYAT + KDV</th>
                                        <th>TUTAR</th>
                                        <th>SİPARİŞ DURUMU</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $generalTotalPrice = 0;
                                        $totalPrice = 0;
                                    @endphp
                                    @forelse($orderDetails as $order)
                                        <tr>
                                            <td>{{ $order?->product_code ?? '-' }}</td>
                                            <td class="product-list">
                                                <div class="cart-product-item d-flex align-items-center">
                                                    <div class="remove-icon">
                                                        <button><i
                                                                class="fa fa-file-o"></i></button>
                                                    </div>
                                                    {{--<a href="single-product.html" class="product-thumb">
                                                                <img src="assets/img/products/prod-01.jpg" alt="Product">
                                                            </a>--}}
                                                    <a href="" class="product-name">{{ $order?->product?->name ??'-' }}</a>
                                                </div>
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
                                    @empty
                                        <tr>
                                            <td colspan="11">Sepetinizde ürün bulunamadı. Hemen alışveriş yapın.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('js')

@endpush
