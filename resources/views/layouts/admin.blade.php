<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gogi - Admin and Dashboard Template</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/media/image/favicon.png') }}" />

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

    <!-- Sidebar group -->
    <div class="sidebar-group">

        <!-- BEGIN: Settings -->
        <div class="sidebar" id="settings">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title d-flex justify-content-between">
                        Settings
                        <a class="btn-sidebar-close" href="#">
                            <i class="ti-close"></i>
                        </a>
                    </h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item pl-0 pr-0">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
                                <label class="custom-control-label" for="customSwitch1">Allow notifications.</label>
                            </div>
                        </li>
                        <li class="list-group-item pl-0 pr-0">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch2">
                                <label class="custom-control-label" for="customSwitch2">Hide user requests</label>
                            </div>
                        </li>
                        <li class="list-group-item pl-0 pr-0">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch3" checked>
                                <label class="custom-control-label" for="customSwitch3">Speed up demands</label>
                            </div>
                        </li>
                        <li class="list-group-item pl-0 pr-0">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch4" checked>
                                <label class="custom-control-label" for="customSwitch4">Hide menus</label>
                            </div>
                        </li>
                        <li class="list-group-item pl-0 pr-0">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch5">
                                <label class="custom-control-label" for="customSwitch5">Remember next visits</label>
                            </div>
                        </li>
                        <li class="list-group-item pl-0 pr-0">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch6">
                                <label class="custom-control-label" for="customSwitch6">Enable report
                                    generation.</label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- END: Settings -->

        <!-- BEGIN: Chat List -->
        <div class="sidebar" id="chat-list">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title d-flex justify-content-between">
                        Chats
                        <a class="btn-sidebar-close" href="#">
                            <i class="ti-close"></i>
                        </a>
                    </h6>
                    <div class="list-group list-group-flush">
                        <a href="chat.html" class="list-group-item d-flex px-0 align-items-start">
                            <div class="pr-3">
                                <span class="avatar avatar-state-danger">
                                    <img src="../../assets/media/image/user/women_avatar3.jpg" class="rounded-circle"
                                        alt="image">
                                </span>
                            </div>
                            <div class="flex-grow- 1">
                                <h6 class="mb-1">Cass Queyeiro</h6>
                                <span class="text-muted">
                                    <i class="fa fa-image mr-1"></i> Photo
                                </span>
                            </div>
                            <div class="text-right ml-auto d-flex flex-column">
                                <span class="small text-muted">Yesterday</span>
                            </div>
                        </a>
                        <a href="chat.html" class="list-group-item d-flex px-0 align-items-start">
                            <div class="pr-3">
                                <span class="avatar avatar-state-warning">
                                    <img src="../../assets/media/image/user/man_avatar4.jpg" class="rounded-circle"
                                        alt="image">
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Evered Asquith</h6>
                                <span class="text-muted">
                                    <i class="fa fa-video-camera mr-1"></i> Video
                                </span>
                            </div>
                            <div class="text-right ml-auto d-flex flex-column">
                                <span class="small text-muted">Last week</span>
                            </div>
                        </a>
                        <a href="chat.html" class="list-group-item px-0 d-flex align-items-start">
                            <div class="pr-3">
                                <div class="avatar avatar-state-danger">
                                    <span class="avatar-title bg-success rounded-circle">F</span>
                                </div>
                            </div>
                            <div>
                                <h6 class="mb-1">Francisco Ubsdale</h6>
                                <span class="text-muted">Hello how are you?</span>
                            </div>
                            <div class="text-right ml-auto d-flex flex-column">
                                <span class="small text-muted">2:32 PM</span>
                            </div>
                        </a>
                        <a href="chat.html" class="list-group-item px-0 d-flex align-items-start">
                            <div class="pr-3">
                                <div class="avatar avatar-state-success">
                                    <img src="../../assets/media/image/user/women_avatar1.jpg" class="rounded-circle"
                                        alt="image">
                                </div>
                            </div>
                            <div>
                                <h6 class="mb-1">Natale Janu</h6>
                                <span class="text-muted">Hi!</span>
                            </div>
                            <div class="text-right ml-auto d-flex flex-column">
                                <span class="badge badge-primary badge-pill ml-auto mb-2">3</span>
                                <span class="small text-muted">08:27 PM</span>
                            </div>
                        </a>
                        <a href="chat.html" class="list-group-item d-flex px-0 align-items-start">
                            <div class="pr-3">
                                <span class="avatar avatar-state-warning">
                                    <img src="../../assets/media/image/user/women_avatar2.jpg" class="rounded-circle"
                                        alt="image">
                                </span>
                            </div>
                            <div class="flex-grow- 1">
                                <h6 class="mb-1">Orelie Rockhall</h6>
                                <span class="text-muted">
                                    <i class="fa fa-image mr-1"></i> Photo
                                </span>
                            </div>
                            <div class="text-right ml-auto d-flex flex-column">
                                <span class="small text-muted">Yesterday</span>
                            </div>
                        </a>
                        <a href="chat.html" class="list-group-item d-flex px-0 align-items-start">
                            <div class="pr-3">
                                <span class="avatar avatar-state-info">
                                    <img src="../../assets/media/image/user/man_avatar1.jpg" class="rounded-circle"
                                        alt="image">
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Barbette Bolf</h6>
                                <span class="text-muted">
                                    <i class="fa fa-video-camera mr-1"></i> Video
                                </span>
                            </div>
                            <div class="text-right ml-auto d-flex flex-column">
                                <span class="small text-muted">Last week</span>
                            </div>
                        </a>
                        <a href="chat.html" class="list-group-item d-flex px-0 align-items-start">
                            <div class="pr-3">
                                <span class="avatar avatar-state-secondary">
                                    <span class="avatar-title bg-warning rounded-circle">D</span>
                                </span>
                            </div>
                            <div>
                                <h6 class="mb-1">Dudley Laborde</h6>
                                <span class="text-muted">Hello how are you?</span>
                            </div>
                            <div class="text-right ml-auto d-flex flex-column">
                                <span class="small text-muted">2:32 PM</span>
                            </div>
                        </a>
                        <a href="chat.html" class="list-group-item d-flex px-0 align-items-start">
                            <div class="pr-3">
                                <span class="avatar avatar-state-success">
                                    <img src="../../assets/media/image/user/man_avatar2.jpg" class="rounded-circle"
                                        alt="image">
                                </span>
                            </div>
                            <div>
                                <h6 class="mb-1">Barbaraanne Riby</h6>
                                <span class="text-muted">Hi!</span>
                            </div>
                            <div class="text-right ml-auto d-flex flex-column">
                                <span class="small text-muted">08:27 PM</span>
                            </div>
                        </a>
                        <a href="chat.html" class="list-group-item d-flex px-0 align-items-start">
                            <div class="pr-3">
                                <span class="avatar avatar-state-danger">
                                    <img src="../../assets/media/image/user/women_avatar3.jpg" class="rounded-circle"
                                        alt="image">
                                </span>
                            </div>
                            <div class="flex-grow- 1">
                                <h6 class="mb-1">Mariana Ondrousek</h6>
                                <span class="text-muted">
                                    <i class="fa fa-image mr-1"></i> Photo
                                </span>
                            </div>
                            <div class="text-right ml-auto d-flex flex-column">
                                <span class="small text-muted">Yesterday</span>
                            </div>
                        </a>
                        <a href="chat.html" class="list-group-item d-flex px-0 align-items-start">
                            <div class="pr-3">
                                <span class="avatar avatar-state-warning">
                                    <img src="../../assets/media/image/user/man_avatar4.jpg" class="rounded-circle"
                                        alt="image">
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Ruprecht Lait</h6>
                                <span class="text-muted">
                                    <i class="fa fa-video-camera mr-1"></i> Video
                                </span>
                            </div>
                            <div class="text-right ml-auto d-flex flex-column">
                                <span class="small text-muted">Last week</span>
                            </div>
                        </a>
                        <a href="chat.html" class="list-group-item d-flex px-0 align-items-start">
                            <div class="pr-3">
                                <span class="avatar avatar-state-info">
                                    <img src="../../assets/media/image/user/man_avatar1.jpg" class="rounded-circle"
                                        alt="image">
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Cosme Hubbold</h6>
                                <span class="text-muted">
                                    <i class="fa fa-video-camera mr-1"></i> Video
                                </span>
                            </div>
                            <div class="text-right ml-auto d-flex flex-column">
                                <span class="small text-muted">Last week</span>
                            </div>
                        </a>
                        <a href="chat.html" class="list-group-item d-flex px-0 align-items-start">
                            <div class="pr-3">
                                <span class="avatar avatar-state-secondary">
                                    <span class="avatar-title bg-secondary rounded-circle">M</span>
                                </span>
                            </div>
                            <div>
                                <h6 class="mb-1">Mallory Darch</h6>
                                <span class="text-muted">Hello how are you?</span>
                            </div>
                            <div class="text-right ml-auto d-flex flex-column">
                                <span class="small text-muted">2:32 PM</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Chat List -->

    </div>
    <!-- ./ Sidebar group -->

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
