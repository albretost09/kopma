@extends('layouts.admin')

@section('content')
    <!-- Content body -->
    <div class="content-body">
        <!-- Content -->
        <div class="content ">

            <div id="header">
                <div class="page-header d-flex justify-content-between">
                    <div>
                        <h3>Tarik Simpanan</h3>
                        <nav aria-label="breadcrumb" class="d-flex align-items-start">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href={{ route('dashboard') }}>Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Tarik Simpanan</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="text-xs">
                        <h6 class="mb-0">Saldo Simpanan</h6>
                        <h3 class="mb-0">Rp. {{ number_format(0, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('admin.permintaan-penarikan.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">Tarik Simpanan</h6>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <ul class="nav nav-pills mb-3" role="tablist">
                                                    <li class="nav-item w-100 text-center">
                                                        <label class="nav-link active" id="transfer-tab" data-toggle="pill"
                                                            role="tab" aria-controls="transfer"
                                                            aria-selected="false">Transfer</label>
                                                    </li>
                                                </ul>
                                                <input type="hidden" name="jenis_transaksi" value="Transfer">
                                                <div class="form-group row">
                                                    <label for="pengguna_id" class="col-sm-2 col-form-label">Anggota</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-select select2" id="pengguna_id"
                                                            name="pengguna_id" required>
                                                            @foreach ($anggota as $item)
                                                                <option value="{{ $item->id }}">
                                                                    {{ $item->nama . ' - ' . $item->nim }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Jumlah</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="jumlah_penarikan" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row transfer">
                                                    <label class="col-sm-2 col-form-label">Bank Tujuan</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="bank_tujuan" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row transfer">
                                                    <label class="col-sm-2 col-form-label">No. Rekening</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="nomor_rekening" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-primary">TARIK</button>
                                </div>
                                <div class="alert alert-warning my-4">
                                    Proses penarikan simpanan akan diproses dalam waktu 1x24 jam.
                                </div>
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <h6 class="card-title">Kontak Admin</h6>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div>
                                                    Silahkan hubungi admin jika terjadi kesalahan.
                                                </div>
                                                <div class="mt-3">
                                                    <a href="https://api.whatsapp.com/send?phone={{ $whatsappAdmin }}&text=Halo%20Admin%20Saya%20Mau%20Tanya%20Tentang%20Tarik%20Simpanan%20Anggota%20{{ auth()->user()->nama }}"
                                                        class="btn btn-success btn-sm" target="_blank">
                                                        <i class="fa fa-whatsapp"></i>
                                                        <span class="ml-2">Hubungi Admin</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
    <link rel="stylesheet" href="{{ asset('backend/vendors/select2/css/select2.min.css') }}" type="text/css">
    <style>
        .nav-pills .nav-link {
            border: 1px solid #f4f5fd !important;
        }
    </style>
@endpush

@push('script')
    <script src="{{ asset('backend/vendors/select2/js/select2.min.js') }}"></script>
    <script>
        $('input[name="jumlah_penarikan"]').on('keyup', function() {
            var value = $(this).val();
            var rupiah = value.replace(/[^0-9]/g, '');
            var rupiah = rupiah.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
            $(this).val(rupiah);
        });

        $('.select2').select2({
            placeholder: 'Pilih Anggota',
            allowClear: true,
        });

        $('.select2').change(function() {
            var value = $(this).val();
            if (value != '') {
                $.ajax({
                    url: "{{ route('admin.permintaan-penarikan.data') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        pengguna_id: value
                    },
                    success: function(result) {
                        $('#header').html(result);
                    }
                });
            }
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
