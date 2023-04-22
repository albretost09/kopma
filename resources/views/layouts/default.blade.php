<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gogi - Admin and Dashboard Template</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/media/image/favicon.png') }}" />

    <!-- Plugin styles -->
    <link rel="stylesheet" href="{{ asset('backend/vendors/bundle.css') }}" type="text/css">

    <!-- App styles -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/app.min.css') }}" type="text/css">
</head>

<body class="form-membership">

    <!-- begin::preloader-->
    <div class="preloader">
        <div class="preloader-icon"></div>
    </div>
    <!-- end::preloader -->

    @yield('content')

    <!-- Plugin scripts -->
    <script src="{{ asset('backend/vendors/bundle.js') }}"></script>

    <!-- App scripts -->
    <script src="{{ asset('backend/assets/js/app.min.js') }}"></script>

    @stack('script')
</body>

</html>
