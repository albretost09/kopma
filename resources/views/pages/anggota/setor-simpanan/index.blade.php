@extends('layouts.admin')

@section('content')
    <!-- Content body -->
    <div class="content-body">
        <!-- Content -->
        <div class="content ">

            <div class="page-header">
                <div>
                    <h3>Setor Simpanan</h3>
                    <nav aria-label="breadcrumb" class="d-flex align-items-start">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href={{ route('dashboard') }}>Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Setor Simpanan</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('anggota.setor-simpanan.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">Setor Simpanan</h6>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <ul class="nav nav-pills mb-3" role="tablist">
                                                    <li class="nav-item w-50 text-center">
                                                        <label class="nav-link active" id="tunai-tab" data-toggle="pill"
                                                            role="tab" aria-controls="tunai"
                                                            aria-selected="true">Tunai</label>
                                                    </li>
                                                    <li class="nav-item w-50 text-center">
                                                        <label class="nav-link" id="transfer-tab" data-toggle="pill"
                                                            role="tab" aria-controls="transfer"
                                                            aria-selected="false">Transfer</label>
                                                    </li>
                                                </ul>
                                                <input type="hidden" name="jenis_transaksi" value="Tunai">
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Jenis Simpanan</label>
                                                    <div class="col-sm-10">
                                                        <select name="jenis_simpanan" class="form-control">
                                                            <option value="Wajib">Simpanan Wajib</option>
                                                            <option value="Sukarela">Simpanan Sukarela
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Jumlah</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="jumlah" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row d-none bukti">
                                                    <label class="col-sm-2 col-form-label">Bukti Transfer</label>
                                                    <div class="col-sm-10">
                                                        <input type="file" name="bukti_transaksi" accept="image/*"
                                                            class="form-control border border-0">
                                                    </div>
                                                </div>
                                                <div class="form-group row d-none bukti">
                                                    <label class="col-sm-2 col-form-label">Preview: </label>
                                                    <img src="" alt="" class="img-fluid bukti-gambar"
                                                        width="150">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-primary">SETOR</button>
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
    <style>
        .nav-pills .nav-link {
            border: 1px solid #f4f5fd !important;
        }
    </style>
@endpush

@push('script')
    <script>
        $('input[name="jumlah"]').on('keyup', function() {
            var value = $(this).val();
            var rupiah = value.replace(/[^0-9]/g, '');
            var rupiah = rupiah.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
            $(this).val(rupiah);
        });

        $('.nav-pills .nav-link').click(function() {
            var jenis = $(this).attr('id');

            if (jenis == 'tunai-tab') {
                $('input[name="jenis_transaksi"]').val('Tunai');
                $('.bukti').addClass('d-none');
                $('input[name="bukti_transaksi"]').val('');
                $('.bukti-gambar').attr('src', '');
            } else {
                $('input[name="jenis_transaksi"]').val('Transfer');
                $('.bukti').removeClass('d-none');
            }
        });

        $('input[name="bukti_transaksi"]').on('change', function() {
            var file = $(this)[0].files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.bukti-gambar').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        });

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
            toastr.error("{{ session('error') }}");
        @endif
    </script>
@endpush
