{{--<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>--}}
    <!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="meta description">
    <title>SYN Oto Yedek Parça Giriş</title>
    <!--=== Favicon ===-->
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
    <!--== Google Fonts ==-->
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:300,400,400i,500,600,700%7CPlayfair+Display:400,400i%7CDancing+Script:400,700"
        rel="stylesheet">
    <!--=== All Plugins CSS ===-->
    <link href="{{ asset('assets/front/css/plugins.css') }}" rel="stylesheet">
    <!--=== All Vendor CSS ===-->
    <link href="{{ asset('assets/front/css/vendor.css') }}" rel="stylesheet">
    <!--=== Main Style CSS ===-->
    <link href="{{ asset('assets/front/css/style.css') }}" rel="stylesheet"><!-- Modernizer JS -->
    <script src="{{ asset('assets/js/modernizr-2.8.front/3.min.js') }}"></script>
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
                        src="{{ asset('images/oto-yedek-parca.jpg') }}" class="sticky-logo" alt="Black Logo"></a></div>
            <!-- End Logo Area Wrap -->
        </div>
    </div>
</header>
<!--== End Header Area Wrapper ==-->
<!--== Start Page Header Area ==-->
<div class="page-header-wrapper bg-offwhite">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="page-header-content d-flex">
                    <h1>SYN Oto Yedek Parça GİRİŞ Ekranı</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!--== End Page Header Area ==-->
<!--== Start Page Content Wrapper ==-->
<div class="page-wrapper">
    <div class="checkout-area-wrapper mt-120 mt-md-80 mt-sm-60 mb-120 mb-md-80 mb-sm-60">
        <div class="container">
            <div class="checkout-page-coupon-area">
                <!-- Checkout Coupon Accordion Start -->

            </div>

            <div class="row justify-content-between">
                <div class="col-lg-6">
                    <!-- Checkout Form Area Start -->
                    <div class="checkout-billing-details-wrap">
                        <h2>Giriş Bilgileri</h2>
                        <div class="billing-form-wrap">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="single-input-item">
                                    <label for="email" class="required">E-Posta Adresi</label>
                                    <input type="email" id="email" placeholder="E-Posta Adresi"  name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                                </div>
                                <div class="single-input-item"><label for="com-name">Şifre</label>
                                    <input type="password"  id="password"
                                           name="password"  placeholder="***"
                                           required autocomplete="current-password">
                                </div>

                                <div class="single-input-item">
                                    <button type="submit" class="btn btn-brand">GİRİŞ YAP</button>
                                </div>

                        </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-5">
            </div>
        </div>
    </div>
</div>
{{--<footer class="footer-wrapper">
    <!-- Start Footer Widget Area -->
    <div class="footer-widget-wrapper pt-120 pt-md-80 pt-sm-60 pb-116 pb-md-78 pb-sm-60">
        <div class="container">
            <div class="row mtm-44">
                <!-- Start Single Widget Wrap -->
                <div class="col-lg-3 col-md-6">
                    <div class="single-widget-wrap">
                        <h3 class="widget-title">Booking</h3>
                        <div class="widget-body">
                            <div class="about-text">
                                <address>Max Weatherall. Productions<br>562 Sycamore Circle<br>Atlanta, GA
                                    30342<br>T: +920364426
                                </address>
                                <a href="mailto:your@example.com">Email:
                                    your@example.com</a><br><a href="https://www.hastech.company"
                                                               target="_blank">www.hastech.company</a>
                            </div>
                        </div>
                    </div>
                </div><!-- End Single Widget Wrap -->
                <!-- Start Single Widget Wrap -->
                <div class="col-lg-2 col-md-6">
                    <div class="single-widget-wrap">
                        <h3 class="widget-title">Links</h3>
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
                <div class="col-lg-4 col-md-6">
                    <div class="single-widget-wrap">
                        <h3 class="widget-title">Latest Form Blog</h3>
                        <div class="widget-body">
                            <div class="latest-blog-widget">
                                <div class="single-blog-item">
                                    <h3><a href="blog-details.html">Work Passionately</a></h3><span
                                        class="post-date"><i class="fa fa-clock-o"></i> March 9, 2022</span>
                                </div>
                                <div class="single-blog-item">
                                    <h3><a href="blog-details.html">Creating electronic beats in the</a></h3><span
                                        class="post-date"><i class="fa fa-clock-o"></i> March 8, 2022</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Single Widget Wrap -->
                <!-- Start Single Widget Wrap -->
                <div class="col-lg-3 col-md-6">
                    <div class="single-widget-wrap">
                        <h3 class="widget-title">Get In Touch</h3>
                        <div class="widget-body">
                            <div class="newsletter-widget-wrap">
                                <p>Enter your email and receive the latest news from us.</p>
                                <div class="newsletter-form-wrap">
                                    <form
                                        action="https://company.us19.list-manage.com/subscribe/post?u=2f2631cacbe4767192d339ef2&amp;id=24db23e68a"
                                        method="post" id="mc-form" class="mc-form"><input type="email" id="mc-email"
                                                                                          placeholder="Enter Email Address"
                                                                                          required>
                                        <button
                                            class="btn-newsletter"><i class="fa fa-envelope"></i></button>
                                    </form>
                                    <!-- MailChimp Alerts Start -->
                                    <div class="mailchimp-alerts text-centre">
                                        <div class="mailchimp-submitting"></div>
                                        <div class="mailchimp-success"></div>
                                        <div class="mailchimp-error"></div>
                                    </div><!-- MailChimp Alerts End -->
                                </div>
                            </div>
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
                        <p>Copyright ©
                            <script>
                                document.write(new Date().getFullYear() + ' ');
                            </script>
                            TRIO - All Rights Reserved.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-5 order-first order-sm-last">
                    <div class="footer-social-icons nav justify-content-center justify-content-md-end"><a href="#"
                                                                                                          target="_blank"
                                                                                                          class="trio-tooltip"
                                                                                                          data-tippy-content="Facebook"><i
                                class="fa fa-facebook"></i></a> <a href="#" target="_blank" class="trio-tooltip"
                                                                   data-tippy-content="Twitter"><i
                                class="fa fa-twitter"></i></a> <a href="#"
                                                                  target="_blank" class="trio-tooltip"
                                                                  data-tippy-content="Pinterest"><i
                                class="fa fa-pinterest"></i></a> <a href="#" target="_blank" class="trio-tooltip"
                                                                    data-tippy-content="Instagram"><i
                                class="fa fa-instagram"></i></a></div>
                </div>
            </div>
        </div>
    </div><!-- End Footer Bottom Area -->
</footer>--}}

<script src="{{ asset('assets/front/js/vendor.js') }}"></script>
<!--=== All Plugins Js ===-->
<script src="{{ asset('assets/front/js/plugins.js') }}"></script>
<!--=== Active Js ===-->
<script src="{{ asset('assets/front/js/active.js') }}"></script>
<!--=== Revolution Slider Js ===-->
<script src="{{ asset('assets/front/js/revslider/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ asset('assets/front/js/revslider/revslider-active.js') }}"></script>
</body>

</html>
