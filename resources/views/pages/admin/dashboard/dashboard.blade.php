@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <!-- Content -->
        <div class="content ">
            <div class="page-header d-md-flex justify-content-between">
                <div>
                    <h3>Welcome back, {{ auth('admin')->user()->nama }}</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Jumlah Anggota</h6>
                            <div class="d-flex align-items-center mb-3">
                                <div>
                                    <div class="avatar">
                                        <span class="avatar-title bg-primary-bright text-primary rounded-pill">
                                            <i data-feather="user"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="font-weight-bold ml-1 font-size-30 ml-3">{{ $jumlahAnggota }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Kas Kopma</h6>
                            <div class="d-flex align-items-center mb-3">
                                <div>
                                    <div class="avatar">
                                        <span class="avatar-title bg-info-bright text-info rounded-pill">
                                            <i data-feather="dollar-sign"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="font-weight-bold ml-1 font-size-30 ml-3">
                                    {{ 'Rp. ' . number_format($kasKopma, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Total Simpanan</h6>
                            <div class="d-flex align-items-center mb-3">
                                <div>
                                    <div class="avatar">
                                        <span class="avatar-title bg-secondary-bright text-secondary rounded-pill">
                                            <i data-feather="dollar-sign"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="font-weight-bold ml-1 font-size-30 ml-3">
                                    {{ 'Rp. ' . number_format($totalSimpanan, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <h6 class="card-title mb-2 text-center">Kas Tahun {{ date('Y') }}</h6>
                            <hr>
                            <div class="font-size-40 font-weight-bold">
                                {{ 'Rp. ' . number_format($kasTahunIni, 0, ',', '.') }}</div>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p class="text-muted mb-1">Pemasukan</p>
                                    <div>
                                        <span
                                            class="font-weight-bold">{{ 'Rp. ' . number_format($pemasukanTahunIni, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-muted mb-1">Pengeluaran</p>
                                    <div>
                                        <span
                                            class="font-weight-bold">{{ 'Rp. ' . number_format($pengeluaranTahunIni, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div id="kas-chart"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- ./ Content -->

        @include('includes.admin.footer')
    </div>
@endsection

@push('script')
    <script>
        toastr.options = {
            timeOut: 3000,
            progressBar: true,
            showMethod: "slideDown",
            hideMethod: "slideUp",
            showDuration: 200,
            hideDuration: 200
        };

        @if (session()->has('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if (session()->has('error'))
            toastr.danger("{{ session('error') }}");
        @endif

        $(function() {
            var colors = {
                primary: $('.colors .bg-primary').css('background-color').replace('rgb', '').replace(')', '')
                    .replace('(',
                        '').split(','),
                secondary: $('.colors .bg-secondary').css('background-color').replace('rgb', '').replace(')',
                    '').replace(
                    '(', '').split(','),
                info: $('.colors .bg-info').css('background-color').replace('rgb', '').replace(')', '').replace(
                        '(', '')
                    .split(','),
                success: $('.colors .bg-success').css('background-color').replace('rgb', '').replace(')', '')
                    .replace('(',
                        '').split(','),
                danger: $('.colors .bg-danger').css('background-color').replace('rgb', '').replace(')', '')
                    .replace('(', '')
                    .split(','),
                warning: $('.colors .bg-warning').css('background-color').replace('rgb', '').replace(')', '')
                    .replace('(',
                        '').split(','),
            };

            var rgbToHex = function(rgb) {
                var hex = Number(rgb).toString(16);
                if (hex.length < 2) {
                    hex = "0" + hex;
                }
                return hex;
            };

            var fullColorHex = function(r, g, b) {
                var red = rgbToHex(r);
                var green = rgbToHex(g);
                var blue = rgbToHex(b);
                return red + green + blue;
            };

            colors.primary = '#' + fullColorHex(colors.primary[0], colors.primary[1], colors.primary[2]);
            colors.secondary = '#' + fullColorHex(colors.secondary[0], colors.secondary[1], colors.secondary[2]);
            colors.info = '#' + fullColorHex(colors.info[0], colors.info[1], colors.info[2]);
            colors.success = '#' + fullColorHex(colors.success[0], colors.success[1], colors.success[2]);
            colors.danger = '#' + fullColorHex(colors.danger[0], colors.danger[1], colors.danger[2]);
            colors.warning = '#' + fullColorHex(colors.warning[0], colors.warning[1], colors.warning[2]);

            function activityChart() {
                if ($("#kas-chart").length) {
                    var options = {
                        chart: {
                            type: "bar",
                            fontFamily: "Inter",
                            toolbar: {
                                show: false,
                            },
                        },
                        series: [{
                                name: "Pemasukan",
                                data: {{ json_encode($dataChart['pemasukan']) }},
                            },
                            {
                                name: "Pengeluaran",
                                data: {{ json_encode($dataChart['pengeluaran']) }},
                            },
                        ],
                        colors: [colors.secondary, colors.info],
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: "50%",
                                endingShape: "rounded",
                            },
                        },
                        dataLabels: {
                            enabled: false,
                        },
                        stroke: {
                            show: true,
                            width: 8,
                            colors: ["transparent"],
                        },
                        grid: {
                            show: false,
                            padding: {
                                left: 0,
                                right: 0,
                            },
                        },
                        xaxis: {
                            labels: {
                                show: false,
                            },
                            axisBorder: {
                                show: false,
                            },
                            // categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
                        },
                        yaxis: {
                            show: false,
                        },
                        fill: {
                            opacity: 1,
                        },
                        legend: {
                            show: false,
                        },
                    };

                    if ($(window).width() > 992) {
                        options.chart.height = 395;
                    }

                    var chart = new ApexCharts(
                        document.querySelector("#kas-chart"),
                        options
                    );

                    chart.render();
                }
            }

            activityChart();
        });
    </script>
@endpush
