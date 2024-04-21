@extends('app.layouts.app')
@section('title', 'B2B ürünler')
@section('content')

    <!--== Start Team Member Content Area ==-->
    <section class="team-member-area-wrapper">
        <div class="container-fluid p-0">
            <div class="row g-0">

                <!-- Start Team Member Item -->
                <div class="col-sm-6 col-lg-4 col-xl-6">
                    <div class="team-member-item row g-0">

                        <div class="team-member-info col-xl-8 my-auto">
                            <h3>Hoşgeldiniz.</h3>
                            <h3>Sayın, {{ $company->name }}.</h3>
                            <p>Bizi tercihiniz ettiğiniz için teşekkür eder, iyi alışverişler dileriz.</p>

                        </div><!-- End Team Member Info -->
                    </div>
                </div><!-- End Team Member Item -->
                <!-- Start Team Member Item -->
                <div class="col-sm-6 col-lg-4 col-xl-6">
                    <div class="team-member-item row g-0">

                        <!-- Start Team Member Info -->
                        <div class="team-member-info col-xl-8 my-auto">
                            <h2>Nurhak BARIKAN</h2>
                            <h4>MÜŞTERİ TEMSİLCİSİ</h4>
                            <p>+90 533 920 40 25</p>
                            <div class="about-social-icons mt-20"><a href="#"><i class="fa fa-facebook"></i></a> <a
                                    href="#"><i class="fa fa-twitter"></i></a> <a href="#"><i
                                        class="fa fa-linkedin"></i></a> <a href="#"><i
                                        class="fa fa-instagram"></i></a></div>
                        </div><!-- End Team Member Info -->
                    </div>
                </div><!-- End Team Member Item -->


            </div>
        </div>
    </section>
    <!--== End Team Member Content Area ==-->
    </div>
    <!--== End Page Content Wrapper ==-->
    {{--<div class="port-details-header mt-120 mt-md-80 mt-sm-60">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Start Portfolio Details Thumb -->
                    <div class="ht-slick-slider-wrapper">
                        <div class="ht-slick-slider portfolio-thumbnail-inner"
                             data-slick='{"slidesToShow": 1, "infinite": false, "arrows": true, "prevArrow": ".prev-arrow", "nextArrow": ".next-arrow", "responsive": [{"breakpoint": 991,"settings": {"dots": false}}]}'>
                            <figure class="port-details-thumb-item"><img src="assets/front/img/port-details/01.jpg"
                                                                         alt="Portfolio"></figure>
                            <figure class="port-details-thumb-item"><img src="assets/front/img/port-details/02.jpg"
                                                                         alt="Portfolio"></figure>
                            <figure class="port-details-thumb-item"><img src="assets/front/img/port-details/01.jpg"
                                                                         alt="Portfolio"></figure>
                        </div>
                        <div class="ht-slick-nav ht-slick-nav--five"><button class="prev-arrow"><i
                                    class="tri-o-prev-arrow"></i></button> <button class="next-arrow"><i
                                    class="tri-o-next-arrow"></i></button></div>
                    </div><!-- End Portfolio Details Thumb -->
                </div>
            </div>
        </div>
    </div>--}}

    <!--== Start Page Content Wrapper ==-->
    <div class="page-wrapper">
        <div class="wishlist-page-content mt-120 mt-md-80 mt-sm-60 mb-104 mb-md-80 mb-sm-60">
            <div class="container">
                <div class="shopping-cart-list-area">
                    <div class="shopping-cart-table table-responsive">
                        <div class="single-input-item">
                            <label for="com-name">Detaylı arama</label>
                            <form action="#">
                                <div class="src-from-content d-flex"><input name="product" value="{{ request()->get('product') }}" type="search" placeholder="REF kodu, ürün adı girerek arama yapabilirsiniz">
                                    <button class="btn-search" type="submit"><i class="fa fa-search"></i></button>
                                    @if(request()->all())
                                    <button style="background-color: red" class="btn-search" type="button" onclick="location.href = '{{ route('home') }}'"><i class="fa fa-remove"></i></button>
                                    @endif
                                </div>
                            </form>
                        </div>
                        <table class="table table-bordered text-center">
                            <thead>
                            <tr>
                                <th>REF KOD</th>
                                <th>ÜRÜN ADI</th>
                                <th>MARKA</th>
                                <th>STOK DURUMU</th>
                                <th>BİRİM</th>
                                <th>FİYAT</th>
                                <th>ADET</th>
                                <th>SİPARİŞ VER</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td>{{ $product?->code }}</td>
                                    <td class="product-list">
                                        <div class="cart-product-item d-flex align-items-center">
                                            <div class="remove-icon">
                                                <button><i
                                                        class="fa fa-file-o"></i></button>
                                            </div>
                                            {{--<a href="single-product.html" class="product-thumb">
                                                <img src="assets/img/products/prod-01.jpg" alt="Product">
                                            </a>--}}
                                            <a href="" class="product-name">{{ $product?->name }}</a>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $product?->brand?->name }}
                                    </td>
                                    <td>
                                        {{ $product?->stock }}
                                    </td>
                                    <td>
                                        {{ $product?->unit_formatted }}
                                    </td>
                                    <td>
                                        {{ $product?->sale_price + ($product?->sale_price * 20/100) }} {{ $product?->currency?->symbol }}
                                    </td>
                                    <td>
                                        <div class="pro-qty"><input type="text" class="quantity" title="Quantity" name="quantity" min="0" value="0"></div>
                                    </td>
                                    <td>
                                        <button type="button" data-id="{{ $product?->id }}" class="btn btn-transparent btn-small add-product">
                                            @if($product?->quantity == 0)
                                                TEDARİK ET
                                            @else
                                                SEPETE EKLE
                                            @endif
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">ÜRÜN BULUNAMADI</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('.add-product').click(function () {
                let productId = $(this).data('id');
                let quantity = $(this).closest('tr').find('.quantity').val();

                $.ajax({
                    type: 'POST',
                    url: '{{ route('cart.store') }}',
                    data: {_token: '{{ csrf_token() }}', quantity : quantity, product_id: productId},
                    success: function (response) {
                        Swal.fire({
                            title: "Başarılı!",
                            text: response.message,
                            icon: "success",
                            confirmButtonText: "Tamam!",
                        }).then((result) => {
                                location.reload()
                        })
                    },
                    error: function (error) {
                        Swal.fire({
                            title: "Hata!",
                            text: error.message,
                            icon: "error",
                            confirmButtonText: "Tamam!",
                        }).then((result) => {
                            location.reload()

                        })
                    }
                })
            })
        })
    </script>
@endpush
