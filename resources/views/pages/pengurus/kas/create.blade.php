@extends('layouts.admin')

@section('content')
    <!-- Content body -->
    <div class="content-body">
        <!-- Content -->
        <div class="content ">

            <div class="page-header">
                <div>
                    <h3>Buat Kas</h3>
                    <nav aria-label="breadcrumb" class="d-flex align-items-start">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href={{ route('pengurus.dashboard') }}>Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Buat Kas</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('pengurus.kas.store') }}" method="post">
                                @csrf
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">Buat Kas</h6>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <ul class="nav nav-pills mb-3" role="tablist">
                                                    <li class="nav-item w-50 text-center">
                                                        <label class="nav-link active" id="pengeluaran-tab"
                                                            data-toggle="pill" role="tab" aria-controls="pengeluaran"
                                                            aria-selected="true">Pengeluaran</label>
                                                    </li>
                                                    <li class="nav-item w-50 text-center">
                                                        <label class="nav-link" id="pemasukan-tab" data-toggle="pill"
                                                            role="tab" aria-controls="pemasukan"
                                                            aria-selected="false">Pemasukan</label>
                                                    </li>
                                                </ul>
                                                <input type="hidden" name="jenis" value="Keluar">
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Tanggal</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="tanggal_transaksi" class="form-control"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Jumlah</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="jumlah" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Keterangan</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="keterangan" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">No. Cek</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="no_cek" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-primary">SIMPAN</button>
                                </div>
                            </form>
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

@push('style')
    <link rel="stylesheet" href="{{ asset('backend/vendors/datepicker/daterangepicker.css') }}" type="text/css">
    <style>
        .nav-pills .nav-link {
            background: #f4f5fd !important;
            color: #000 !important;
        }

        #pengeluaran-tab.active {
            background: #ff3e6c !important;
            color: #fff !important;
        }

        #pemasukan-tab.active {
            background: #34cd86 !important;
            color: #fff !important;
        }
    </style>
@endpush

@push('script')
    <script src="{{ asset('backend/vendors/datepicker/moment.min.js') }}"></script>
    <script>
        $('input[name="tanggal_transaksi"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true
        });

        $('input[name="jumlah"]').on('keyup', function() {
            var value = $(this).val();
            var rupiah = value.replace(/[^0-9]/g, '');
            var rupiah = rupiah.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
            $(this).val(rupiah);
        });

        $('.nav-pills .nav-link').click(function() {
            var jenis = $(this).attr('id');

            if (jenis == 'pengeluaran-tab') {
                $('input[name="jenis"]').val('Keluar');
            } else {
                $('input[name="jenis"]').val('Masuk');
            }
        });
    </script>
@endpush
