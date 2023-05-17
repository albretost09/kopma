<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/media/image/favicon.png') }}" />

    @stack('before-style')

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('backend/vendors/bundle.css') }}" type="text/css">

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Daterangepicker -->
    <link rel="stylesheet" href="{{ asset('backend/vendors/datepicker/daterangepicker.css') }}" type="text/css">

    <!-- DataTable -->
    <link rel="stylesheet" href="{{ asset('backend/vendors/dataTable/datatables.min.css') }}" type="text/css">

    <!-- App css -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/app.min.css') }}" type="text/css">

    @stack('style')

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <!-- Preloader -->
    {{-- <div class="preloader">
        <div class="preloader-icon"></div>
        <span>Loading...</span>
    </div> --}}
    <!-- ./ Preloader -->

    <!-- Layout wrapper -->
    <div class="layout-wrapper">

        @include('includes.admin.header')

        <!-- Content wrapper -->
        <div class="content-wrapper">
            @include('includes.admin.sidebar')

            <!-- Content body -->
            @yield('content')
            <!-- ./ Content body -->
        </div>
        <!-- ./ Content wrapper -->
    </div>
    <!-- ./ Layout wrapper -->

    @stack('before-script')

    <!-- Main scripts -->
    <script src="{{ asset('backend/vendors/bundle.js') }}"></script>

    <!-- Apex chart -->
    <script src="{{ asset('backend/vendors/charts/apex/apexcharts.min.js') }}"></script>

    <!-- Daterangepicker -->
    <script src="{{ asset('backend/vendors/datepicker/daterangepicker.js') }}"></script>

    <!-- DataTable -->
    <script src="{{ asset('backend/vendors/dataTable/datatables.min.js') }}"></script>

    <!-- Dashboard scripts -->
    <script src="{{ asset('backend/assets/js/examples/pages/dashboard.js') }}"></script>

    <!-- App scripts -->
    <script src="{{ asset('backend/assets/js/app.min.js') }}"></script>

    @stack('script')
</body>

</html>
