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
                            <form action="{{ route('pengurus.setor-simpanan.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="card-title">Setor Simpanan</h6>
                                            <div class="d-flex justify-content-between">
                                                <img src="{{ asset('backend/assets/media/image/bank/bri.png') }}"
                                                    alt="image" class="img-fluid mb-4" width="50">
                                                <div class="text-right ml-3">
                                                    <div class="font-weight-bold">343401047858531</div>
                                                    <span>a.n KOPMA UPR</span>
                                                </div>
                                            </div>
                                        </div>
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
                                                    </div>
                                                </div>
                                                <div class="form-group row bukti">
                                                    <label class="col-sm-2 col-form-label">Bukti Transfer</label>
                                                    <div class="col-sm-10">
                                                        <input type="file" name="bukti_transaksi" accept="image/*"
                                                            class="form-control border border-0">
                                                    </div>
                                                </div>
                                                <div class="form-group row bukti">
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
