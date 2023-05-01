@extends('layouts.admin')

@section('content')
    <!-- Content body -->
    <div class="content-body">
        <!-- Content -->
        <div class="content ">
            <div class="page-header d-md-flex justify-content-between">
                <div>
                    <h3>Welcome back, {{ auth()->user()->nama }}</h3>
                </div>
            </div>

            @if ($statusAnggota == 'NONAKTIF')
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-warning">
                            <i data-feather="alert-circle"></i>
                            Untuk mengaktifkan keanggotaan anda, silahkan melakukan pembayaran simpanan pokok.
                            <div class="mt-2">
                                <a href="{{ route('anggota.setor-simpanan.index') }}"
                                    class="btn btn-primary btn-sm ml-4">Bayar
                                    Simpanan Pokok</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Jumlah Saldo</h6>
                            <div class="d-flex align-items-center mb-3">
                                <div>
                                    <div class="avatar">
                                        <span class="avatar-title bg-secondary-bright text-secondary rounded-pill">
                                            <i data-feather="dollar-sign"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="font-weight-bold ml-1 font-size-30 ml-3">
                                    {{ 'Rp. ' . number_format($jumlahSaldo, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Simpanan Sukarela</h6>
                            <div class="d-flex align-items-center mb-3">
                                <div>
                                    <div class="avatar">
                                        <span class="avatar-title bg-primary-bright text-primary rounded-pill">
                                            <i data-feather="dollar-sign"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="font-weight-bold ml-1 font-size-30 ml-3">
                                    {{ 'Rp. ' . number_format($jumlahSimpananSukarela, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Simpanan Pokok dan Wajib</h6>
                            <div class="d-flex align-items-center mb-3">
                                <div>
                                    <div class="avatar">
                                        <span class="avatar-title bg-info-bright text-info rounded-pill">
                                            <i data-feather="dollar-sign"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="font-weight-bold ml-1 font-size-30 ml-3">
                                    {{ 'Rp. ' . number_format($jumlahSimpananPokokWajib, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- ./ Content -->

        @include('includes.admin.footer')
    </div>
    <!-- ./ Content body -->
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
    </script>
@endpush
