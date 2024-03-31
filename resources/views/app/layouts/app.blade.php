<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="meta description">
    <title>@yield('title', 'B2B ürünler')</title>

    <link
        href="https://fonts.googleapis.com/css?family=Poppins:300,400,400i,500,600,700%7CPlayfair+Display:400,400i%7CDancing+Script:400,700"
        rel="stylesheet">
    <!--=== All Plugins CSS ===-->
    <link href="{{ asset('assets/front/css/plugins.css') }}" rel="stylesheet">
    <!--=== All Vendor CSS ===-->
    <link href="{{ asset('assets/front/css/vendor.css') }}" rel="stylesheet">
    <!--=== Main Style CSS ===-->
    <link href="{{ asset('assets/front/css/style.css') }}" rel="stylesheet"><!-- Modernizer JS -->

    <script src="{{ asset('assets/front/js/modernizr-2.8.3.min.js') }}"></script>
</head>

<body class="preloader-active">
<!--== Start PreLoader Wrap ==-->
<div class="preloader-area-wrap">
    <div class="spinner d-flex justify-content-center align-items-center h-100">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
    </div>
</div>
<!--== End PreLoader Wrap ==-->
<!--== Start Header Area Wrapper ==-->
<header class="header-area-wrapper black-header header-padding sticky-header">
    <div class="container-fluid">
        <div class="row">
            <!-- Start Logo Area Wrap -->
            <div class="col-6 col-lg-2"><a href="{{ route('home') }}" class="logo-wrap d-block"><img
                        src="{{ asset('images/oto-yedek-parca.jpg') }}" class="sticky-logo" alt="Black Logo"
                        width="100"></a></div>
            <!-- End Logo Area Wrap -->
            <!-- Start Main Navigation Wrap -->
            <div class="col-6 col-lg-10 my-auto ms-auto position-static">
                <div class="header-right-area d-flex justify-content-end align-items-center">
                    <div class="navigation-area-wrap d-none d-lg-block">
                        <nav class="main-navigation">
                            <ul class="main-menu nav justify-content-end">
                                <li class="dropdown-navbar arrow"><a href="{{ route('home') }}">ANASAYFA</a>
                                    <ul class="dropdown-nav mega-menu-wrap">


                                    </ul>
                                </li>
                                <li class="dropdown-navbar arrow"><a href="#">FİRMA BİLGİLERİM</a>

                                </li>
                                <li class="dropdown-navbar arrow"><a href="{{ route('order.index') }}">SİPARİŞ GEÇMİŞİ</a>

                                </li>
                                <li class="dropdown-navbar arrow"><a href="shop.html">KAMPANYALAR</a>

                                </li>
                                <li class="dropdown-navbar arrow"><a href="" onclick="event.preventDefault();
                                                 document.getElementById('logoutForm').submit();">ÇIKIŞ</a>
                                </li>
                                <form method="POST" id="logoutForm" action="{{ route('logout') }}">
                                    @csrf
                                </form>
                            </ul>
                        </nav>
                    </div>
                    <div class="off-canvas-area-wrap nav"><a href="{{ route('cart.index') }}" class="cart-button"><i
                                class="fa fa-shopping-cart"></i> <span class="count">2</span> </a>
                        <button
                            class="search-box-open d-block d-lg-none"><i class="fa fa-search"></i></button>
                        <button
                            class="off-canvas-btn d-none d-lg-block"><i class="fa fa-bars"></i></button>
                        <button
                            class="mobile-menu d-lg-none"><i class="fa fa-bars"></i></button>
                    </div>
                </div>
            </div><!-- End Main Navigation Wrap -->
        </div>
    </div>
</header>
<!--== End Header Area Wrapper ==-->


<!--== Start Page Header Area ==-->
<div class="page-header-wrapper bg-offwhite">

</div>
<!--== End Page Header Area ==-->
@yield('content')
<!--== End Page Content Wrapper ==-->
<!--== Start Footer Area Wrapper ==-->
{{--<footer class="footer-wrapper">
    <!-- Start Footer Widget Area -->
    <div class="footer-widget-wrapper pt-120 pt-md-80 pt-sm-60 pb-116 pb-md-78 pb-sm-60">
        <div class="container">
            <div class="row mtm-44">
                <!-- Start Single Widget Wrap -->
                <div class="col-lg-3 col-md-6">
                    <div class="single-widget-wrap">
                        <h3 class="widget-title">ADRES</h3>
                        <div class="widget-body">
                            <div class="about-text">
                                <address>Max Weatherall. Productions<br>562 Sycamore Circle<br>Atlanta, GA
                                    30342<br>T: +920364426</address><a href="mailto:your@example.com">Email:
                                    your@example.com</a><br><a href="https://www.hastech.company"
                                                               target="_blank">www.hastech.company</a>
                            </div>
                        </div>
                    </div>
                </div><!-- End Single Widget Wrap -->
                <!-- Start Single Widget Wrap -->
                <div class="col-lg-2 col-md-6">
                    <div class="single-widget-wrap">
                        <h3 class="widget-title">MENU1</h3>
                        <div class="widget-body">
                            <ul class="widget-list">
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><a href="shop.html">Shop</a></li>
                                <li><a href="about.html">About us</a></li>
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="contact.html">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div><!-- End Single Widget Wrap -->
                <!-- Start Single Widget Wrap -->
                <div class="col-lg-2 col-md-6">
                    <div class="single-widget-wrap">
                        <h3 class="widget-title">MENU1</h3>
                        <div class="widget-body">
                            <ul class="widget-list">
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><a href="shop.html">Shop</a></li>
                                <li><a href="about.html">About us</a></li>
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="contact.html">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div><!-- End Single Widget Wrap -->
                <!-- Start Single Widget Wrap -->
                <div class="col-lg-2 col-md-6">
                    <div class="single-widget-wrap">
                        <h3 class="widget-title">MENU1</h3>
                        <div class="widget-body">
                            <ul class="widget-list">
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><a href="shop.html">Shop</a></li>
                                <li><a href="about.html">About us</a></li>
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="contact.html">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div><!-- End Single Widget Wrap -->


            </div>
        </div>
    </div><!-- End Footer Widget Area -->
    <!-- Start Footer Bottom Area -->
    <div class="footer-bottom-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-sm-7 order-last">
                    <div class="footer-copyright-area mt-xs-10 text-center text-sm-start">
                        <p>Copyright ©<script>
                                document.write(new Date().getFullYear() + ' ');
                            </script> - All Rights Reserved.</p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-5 order-first order-sm-last">
                    <div class="footer-social-icons nav justify-content-center justify-content-md-end"><a href="#"
                                                                                                          target="_blank" class="trio-tooltip" data-tippy-content="Facebook"><i
                                class="fa fa-facebook"></i></a> <a href="#" target="_blank" class="trio-tooltip"
                                                                   data-tippy-content="Twitter"><i class="fa fa-twitter"></i></a> <a href="#"
                                                                                                                                     target="_blank" class="trio-tooltip" data-tippy-content="Pinterest"><i
                                class="fa fa-pinterest"></i></a> <a href="#" target="_blank" class="trio-tooltip"
                                                                    data-tippy-content="Instagram"><i class="fa fa-instagram"></i></a></div>
                </div>
            </div>
        </div>
    </div><!-- End Footer Bottom Area -->
</footer>--}}
<!--== End Footer Area Wrapper ==-->
<!--== Start Off Canvas Area Wrapper ==-->
<aside class="off-canvas-search-box">
    <!-- Off Canvas Overlay -->
    <div class="off-canvas-overlay"></div>
    <!--== Start Search Box Area ==-->
    <div class="search-box-wrapper text-center">
        <div class="search-box-content">
            <form action="#" method="post"><input type="search" placeholder="Search">
                <button class="btn-search"><i
                        class="fa fa-search"></i></button>
            </form>
        </div>
    </div>
    <!--== End Search Box Area ==-->
</aside>
<!--== End Off Canvas Area Wrapper ==-->
<!--== Start Off Canvas Area Wrapper ==-->
<aside class="off-canvas-area-wrapper">
    <!-- Off Canvas Overlay -->
    <div class="off-canvas-overlay"></div><!-- Start Off Canvas Content Area -->
    <div class="off-canvas-content-wrap">
        <div class="off-canvas-content">

            <div class="about-content off-canvas-item">
                <h2>Mobil menü</h2>
                <p>Organic seitan post-ironic, four loko bicycle rights art party tousled. Mlkshk tote bag
                    stumptown.</p>
            </div><!-- Start Useful Links Content -->
            <div class="useful-link-wrap off-canvas-item">
                <h2>Useful Links</h2>
                <ul class="useful-link-menu">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="shop.html">Shop</a></li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="blog.html">Blog</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </div><!-- Start Social Links Content -->
            <div class="social-links-wrap off-canvas-item">
                <h2>Connect</h2>
                <div class="social-links"><a href="#" class="trio-tooltip" data-tippy-content="Facebook"><i
                            class="fa fa-facebook"></i></a> <a href="#" class="trio-tooltip"
                                                               data-tippy-content="Twitter"><i
                            class="fa fa-twitter"></i></a> <a href="#"
                                                              class="trio-tooltip" data-tippy-content="Pinterest"><i
                            class="fa fa-pinterest"></i></a> <a
                        href="#" class="trio-tooltip" data-tippy-content="Instagram"><i
                            class="fa fa-instagram"></i></a></div>
            </div>
        </div><!-- Off Canvas Close Icon -->
        <button class="btn-close trio-tooltip" data-tippy-content="Close"
                data-tippy-placement="left"><i class="fa fa-close"></i></button>
    </div><!-- End Off Canvas Content Area -->
</aside>
<!--== End Off Canvas Area Wrapper ==-->
<!--== Start Off Canvas Area Wrapper ==-->
<aside class="off-canvas-responsive-menu">
    <!-- Off Canvas Overlay -->
    <div class="off-canvas-overlay"></div><!-- Start Off Canvas Content Area -->
    <div class="off-canvas-content-wrap">
        <div class="off-canvas-content"></div><!-- Off Canvas Close Icon -->
        <button class="btn-close trio-tooltip"
                data-tippy-content="Close" data-tippy-placement="right"><i class="fa fa-close"></i></button>
    </div><!-- End Off Canvas Content Area -->
</aside>
<!--== End Off Canvas Area Wrapper ==-->

<!--=======================Javascript============================-->
<!--=== All Vendor Js ===-->
@include('sweetalert::alert')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.all.min.js"></script>
<script src="{{ asset('assets/front/js/vendor.js') }}"></script>
<!--=== All Plugins Js ===-->
<script src="{{ asset('assets/front/js/plugins.js') }}"></script>
<!--=== Active Js ===-->
<script src="{{ asset('assets/front/js/active.js') }}"></script>

@stack('js')
</body>

</html>
