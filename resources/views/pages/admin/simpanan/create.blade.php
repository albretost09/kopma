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
                            <form action="{{ route('admin.simpanan.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="card-title">Setor Simpanan</h6>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <ul class="nav nav-pills mb-3" role="tablist">
                                                    <li class="nav-item w-100 text-center">
                                                        <label class="nav-link active" id="tunai-tab" data-toggle="pill"
                                                            role="tab" aria-controls="tunai"
                                                            aria-selected="false">Tunai</label>
                                                    </li>
                                                </ul>
                                                <input type="hidden" name="jenis_transaksi" value="Tunai">
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
                                                    <label class="col-sm-2 col-form-label">Jenis Simpanan</label>
                                                    <div class="col-sm-10">
                                                        <select name="jenis_simpanan" class="form-control">
                                                            <option value="Pokok">Simpanan Pokok</option>
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
                                                        <span class="text-danger">{{ $errors->first('jumlah') }}</span>
                                                    </div>
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
        $('input[name="jumlah"]').on('keyup', function() {
            var value = $(this).val();
            var rupiah = value.replace(/[^0-9]/g, '');
            var rupiah = rupiah.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
            $(this).val(rupiah);
        });

        $('input[name="bukti_transaksi"]').on('change', function() {
            var file = $(this)[0].files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.bukti-gambar').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        });

        $('.select2').select2({
            placeholder: 'Pilih Anggota',
            allowClear: true,
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
