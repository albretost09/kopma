<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>

    <!-- responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- For IE -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="stylesheet" href="{{ asset('frontend/assets/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/imp.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/custom-animate.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/hiddenbar.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/assets/css/color.css') }}">
    <link href="{{ asset('frontend/assets/css/color/theme-color.css') }}" id="jssDefault" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css') }}">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('frontend/assets/images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('frontend/assets/images/favicon/favicon-32x32.png') }}"
        sizes="32x32">
    <link rel="icon" type="image/png" href="{{ asset('frontend/assets/images/favicon/favicon-16x16.png') }}"
        sizes="16x16">

    <!-- Fixing Internet Explorer-->
    <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <script src="assets/js/html5shiv.js"></script>
    <![endif]-->

    <style>
        .header-style-one {
            padding-top: 0px !important;
        }

        .footer {
            padding: 90px 0 70px !important;
        }
    </style>

    @stack('style')
</head>

<body>
    <div class="boxed_wrapper">

        {{-- <div class="preloader"></div> --}}

        <!-- Main header -->
        <header class="main-header header-style-one">
            <!--Start Header Bottom-->
            <div class="header-bottom">
                <div class="container">
                    <div class="outer-box clearfix">
                        <div class="header-bottom-left pull-left">

                            <div class="nav-outer clearfix">
                                <!--Mobile Navigation Toggler-->
                                <div class="mobile-nav-toggler">
                                    <div class="inner">
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </div>
                                </div>
                                <!-- Main Menu -->
                                @include('includes.navbar')
                                <!-- Main Menu End-->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!--End Header Bottom-->

            <!--Sticky Header-->
            <div class="sticky-header">
                <div class="container">
                    <div class="clearfix">
                        <!--Logo-->
                        <div class="logo float-left">
                            <a href="index.html" class="img-responsive"><img
                                    src="{{ asset('frontend/assets/images/resources/sticky-logo.png') }}"
                                    alt="" title=""></a>
                        </div>
                        <!--Right Col-->
                        <div class="right-col float-right">
                            <!-- Main Menu -->
                            <nav class="main-menu clearfix">
                                <!--Keep This Empty / Menu will come through Javascript-->
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Sticky Header-->

            <!-- Mobile Menu  -->
            <div class="mobile-menu">
                <div class="menu-backdrop"></div>
                <div class="close-btn"><span class="icon flaticon-multiply"></span></div>

                <nav class="menu-box">
                    <div class="nav-logo"><a href="index.html"><img
                                src="{{ asset('frontend/assets/images/resources/logo.png') }}" alt=""
                                title=""></a></div>
                    <div class="menu-outer">
                        <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                    </div>
                    <!--Social Links-->
                    <div class="social-links">
                        <ul class="clearfix">
                            <li><a href="#"><span class="fab fa fa-facebook-square"></span></a></li>
                            <li><a href="#"><span class="fab fa fa-twitter-square"></span></a></li>
                            <li><a href="#"><span class="fab fa fa-pinterest-square"></span></a></li>
                            <li><a href="#"><span class="fab fa fa-google-plus-square"></span></a></li>
                            <li><a href="#"><span class="fab fa fa-youtube-square"></span></a></li>
                        </ul>
                    </div>
                </nav>
            </div>
            <!-- End Mobile Menu -->
        </header>


        <!-- Start Main Slider -->
        @include('includes.slider')
        <!-- End Main Slider -->

        <!--Start Tentang Kami -->
        @include('includes.tentang-kopma')
        <!--End Tentang Kami -->

        <!--Start Visi Misi -->
        @include('includes.visi-kopma')
        <!--End Visi Misi -->

        <!--Start Keuntungan Bergabung-->
        @include('includes.keuntungan-kopma')
        <!--End Keuntungan Bergabung-->

        <!--Start Layanan Kami -->
        @include('includes.layanan-kopma')
        <!--End Layanan Kami -->

        <!--Start Kontak-->
        @include('includes.kontak-kopma')
        <!--End Kontak-->

        <!--Start footer area-->
        @include('includes.footer')
        <!--End footer area-->





    </div>






    <script src="{{ asset('frontend/assets/js/jquery.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/aos.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/appear.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/isotope.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.bootstrap-touchspin.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.countTo.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.enllax.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.fancybox.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.mixitup.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.paroller.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.polyglot.language.switcher.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/map-script.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/nouislider.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/owl.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/timePicker.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/validation.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/wow.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/slick.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/lazyload.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/scrollbar.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/tilt.jquery.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.bxslider.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jQuery.style.switcher.min.js') }}"></script>
    <!-- thm custom script -->
    <script src="{{ asset('frontend/assets/js/custom.js') }}"></script>



</body>

</html>
