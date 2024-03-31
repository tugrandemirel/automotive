@extends('app.layouts.app')
@section('title', 'Siparişlerim')
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
                                        <th>SİPARİŞ ID</th>
                                        <th>SİPARİŞ KODU</th>
                                        <th>AD/ÜNVAN</th>
                                        <th>ÖDEME METODU</th>
                                        <th>SİPARİŞ DURUMU</th>
                                        <th>İŞLEMLER</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @forelse($orders as $order)
                                        <tr>
                                            <td>#{{ $order?->id ?? '-' }}</td>
                                            <td class="product-list">
                                                <div class="cart-product-item d-flex align-items-center">
                                                    <div class="remove-icon">
                                                        <button><i
                                                                class="fa fa-file-o"></i></button>
                                                    </div>
                                            {{--<a href="single-product.html" class="product-thumb">
                                                        <img src="assets/img/products/prod-01.jpg" alt="Product">
                                                    </a>--}}
                                                    <a href="" class="product-name">{{ $order?->code ??'-' }}</a>
                                                </div>
                                            </td>
                                            <td>
                                                {{ $order?->company?->name ??'-' }}
                                            </td>
                                            <td>
                                                {{ $order?->payment_method_formatted ??'-' }}
                                            </td>
                                            <td>
                                                {{ $order?->status_formatted ??'-' }}
                                            </td>
                                            <td>
                                                <a href="{{ route('order.show', ['order' => $order->hashid()]) }}" class="btn btn-brand btn-small remove-product">
                                                    DETAY
                                                </a>
                                            </td>
                                    @empty
                                        <tr>
                                            <td colspan="11">Geçmiş siparişiiz bulunamadı. Hemen alışveriş yapın.</td>
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
