@extends('app.layouts.app')
@section('title', 'Sepetim')
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
                                        <th>KULLANICI ADI</th>
                                        <th>REF KOD</th>
                                        <th>ÜRÜN ADI</th>
                                        <th>MARKA</th>
                                        <th>BİRİM</th>
                                        <th>FİYAT</th>
                                        <th>ADET</th>
                                        <th>İSKONTO</th>
                                        <th>NET FİYAT + KDV</th>
                                        <th>TUTAR</th>
                                        <th>İŞLEMLER</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $generalTotalPrice = 0;
                                        $totalPrice = 0;
                                    @endphp
                                    @forelse($carts as $cart)
                                        <tr>
                                            <td>{{ $cart?->user?->username ?? '-' }}</td>
                                            <td>{{ $cart?->product_code ?? '-' }}</td>
                                            <td class="product-list">
                                                <div class="cart-product-item d-flex align-items-center">
                                                    <div class="remove-icon">
                                                        <button><i
                                                                class="fa fa-file-o"></i></button>
                                                    </div>
                                            {{--<a href="single-product.html" class="product-thumb">
                                                        <img src="assets/img/products/prod-01.jpg" alt="Product">
                                                    </a>--}}
                                                    <a href="" class="product-name">{{ $cart?->product?->name ??'-' }}</a>
                                                </div>
                                            </td>
                                            <td>
                                                {{ $cart?->brand?->name ??'-' }}
                                            </td>
                                            <td>
                                                {{ $cart?->unit_formatted ??'-' }}
                                            </td>
                                            <td>
                                                @php
                                                    $totalPrice+= $cart?->price * $cart->quantity
                                                @endphp
                                                {{ $cart?->price }}
                                            </td>
                                            <td>
                                                <div class="pro-qty">
                                                    <input type="text" data-id="{{ $cart->hashid() }}" class="quantity" title="Adet" min="0" value="{{ $cart?->quantity ?? 0 }}">
                                                </div>
                                            </td>
                                            <td>
                                                {{ $cart?->general_discount ??'-' }}
                                            </td>
                                            <td>

                                                {{ $cart?->net_price_vat ??'-' }}
                                            </td>
                                            <td>
                                                @php
                                                    $generalTotalPrice+=$cart?->total_price;
                                                @endphp
                                                {{ $cart?->total_price ??'-' }}
                                            </td>
                                            <td>
                                                <button type="button" data-id="{{ $cart->hashid() }}" class="btn btn-brand btn-small remove-product">
                                                   SİL
                                                </button>
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
                    <div class="col-lg-3">
                        <!-- Cart Calculate Area -->
                        <div class="cart-calculate-area mt-sm-30 mt-md-30">
                            <h5 class="cal-title">Sepet Tutarı</h5>
                            <div class="cart-cal-table table-responsive">
                                <table class="table table-borderless">
                                    <tr class="cart-sub-total">
                                        <th>Toplam Tutar</th>
                                        <td>{{ $totalPrice }}</td>
                                    </tr>
                                    <tr class="cart-sub-total">
                                        <th>İskonto</th>
                                        <td>{{ $totalPrice - $generalTotalPrice ?? '-' }}</td>
                                    </tr>
                                {{--    <tr class="shipping">
                                        <th>Shipping</th>
                                        <td>
                                            <ul class="shipping-method">
                                                <li>
                                                    <div class="custom-control custom-radio"><input type="radio"
                                                                                                    id="flat_shipping" name="shipping_method"
                                                                                                    class="custom-control-input" checked="checked"> <label
                                                            class="custom-control-label" for="flat_shipping">Flat Rate :
                                                            $10</label></div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-radio"><input type="radio"
                                                                                                    id="free_shipping" name="shipping_method"
                                                                                                    class="custom-control-input"> <label
                                                            class="custom-control-label" for="free_shipping">Free
                                                            Shipping</label></div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-radio"><input type="radio"
                                                                                                    id="cod_shipping" name="shipping_method"
                                                                                                    class="custom-control-input"> <label
                                                            class="custom-control-label" for="cod_shipping">Cash on
                                                            Delivery</label></div>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>--}}
                                    <tr class="order-total">
                                        <th>Genel Toplam</th>
                                        <td><b>{{ $generalTotalPrice }}</b></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="proceed-checkout-btn">
                                <button type="button" onclick="document.getElementById('cartForm').submit()" class="btn btn-brand d-block w-100">Sepet Onayla</button>
                            </div>
                            <form action="{{ route('order.store') }}" method="post" id="cartForm">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function(){
            // Artı butonuna tıklandığında
            $('.qty-btn.inc').click(function(e){
                e.preventDefault(); // Linkin varsayılan davranışını engelle
                var input = $(this).prev('.quantity'); // Önceki kardeş olan giriş alanını seç
                var currentValue = parseInt(input.val()); // Giriş alanının mevcut değerini al

                input.val(currentValue); // Giriş alanına yeni değeri yerleştir

                // Sepeti güncelleme işlemi
                updateCart(input);
            });

            // Eksi butonuna tıklandığında
            $('.qty-btn.dec').click(function(e){
                e.preventDefault(); // Linkin varsayılan davranışını engelle
                var input = $(this).siblings('.quantity'); // Sonraki kardeş olan giriş alanını seç

                var currentValue = parseInt(input.val()); // Giriş alanının mevcut değerini al ve sayısal bir değere dönüştür

                input.val(currentValue); // Giriş alanına yeni değeri yerleştir

                // Sepeti güncelleme işlemi
                updateCart(input);
            });

            // Sepeti güncelleme fonksiyonu
            function updateCart(input) {
                var cartId = input.data('id'); // Değişen miktarın hangi sepet öğesine ait olduğunu alın
                var newQuantity = input.val(); // Yeni miktarı alın

                let url = '{{ route('cart.update', ['cart' => '%%cartId%%']) }}'
                url = url.replace('%%cartId%%', cartId)

                $.ajax({
                    type: 'POST',
                    url: url,
                    dataType: 'json',
                    data: {_token: '{{ csrf_token() }}', quantity: newQuantity},
                    success: function (response) {
                        Swal.fire({
                            title: "Başarılı!",
                            text: response.data.message,
                            icon: "success",
                            confirmButtonText: "Tamam!",
                        })
                    },
                    error: function (error) {
                        Swal.fire({
                            title: "Hata!",
                            text: error.message,
                            icon: "error",
                            confirmButtonText: "Tamam!",
                        })
                    }
                })
            }

            $('.quantity').change(function () {
                updateCart($(this))
            })
        });

    </script>
    <script>
        $(document).ready(function () {
            $('.remove-product').click(function () {
                let cartId = $(this).data('id');
                let url = '{{ route('cart.destroy', ['cart' => '%%cartId%%']) }}'
                url = url.replace('%%cartId%%', cartId)

                $.ajax({
                    type: 'DELETE',
                    url: url,
                    dataType: 'json',
                    data: {_token: '{{ csrf_token() }}'},
                    success: function (response) {
                        Swal.fire({
                            title: "Başarılı!",
                            text: response.data.message,
                            icon: "success",
                            confirmButtonText: "Tamam!",
                        }).then((result) => {
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
                        })
                    }
                })
            })
        })
    </script>
@endpush
