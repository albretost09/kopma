@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <!-- Content -->
        <div class="content ">

            <div class="page-header d-md-flex justify-content-between">
                <div>
                    <h3>Pembagian SHU</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Pembagian SHU</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row align-items-center">
                        <label for="tahun" class="col-md-3 col-form-label">SHU Tahun</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="tahun" value="{{ date('Y') }}"
                                placeholder="SHU Tahun" readonly>
                        </div>
                    </div>
                    <div class="form-group row align-items-center">
                        <label for="tahun" class="col-md-3 col-form-label">Jumlah SHU</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="jumlahSHU"
                                value="{{ 'Rp. ' . number_format($jumlahSHU, 0, ',', '.') }}" placeholder="SHU Tahun"
                                readonly>
                        </div>
                    </div>
                    <div class="form-group row align-items-center">
                        <label for="tahun" class="col-md-3 col-form-label">Tanggal Pembagian SHU</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="tanggal-pembagian">
                        </div>
                    </div>
                </div>
            </div>

            <form action="" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>Kebijakan</th>
                                    <th style="width: 100px">%</th>
                                    <th>Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="hidden" name="kebijakan[]" value="Cadangan Koperasi">
                                        Cadangan Koperasi
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="persentase[]"
                                            id="persen_cadangan_koperasi" max="100"
                                            value={{ $SHUCadanganKoperasi?->persentase ?? 0 }}>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="nominal[]"
                                            id="nominal_cadangan_koperasi" value="{{ $SHUCadanganKoperasi?->nominal ?? 0 }}"
                                            readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="hidden" name="kebijakan[]" value="Anggota Koperasi">
                                        Anggota Koperasi
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="persentase[]"
                                            id="persen_anggota_koperasi" max="100"
                                            value="{{ $SHUAnggotaKoperasi?->persentase ?? 0 }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="nominal[]"
                                            id="nominal_anggota_koperasi" value="{{ $SHUAnggotaKoperasi?->nominal ?? 0 }}"
                                            readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="hidden" name="kebijakan[]" value="Dana Sosial">
                                        Dana Sosial
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="persentase[]"
                                            id="persen_dana_sosial" max="100"
                                            value="{{ $SHUDanaSosial?->persentase ?? 0 }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="nominal[]" id="nominal_dana_sosial"
                                            value="{{ $SHUDanaSosial?->nominal ?? 0 }}" readonly>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row justify-content-center">
                    @if (!$checkTahun)
                        <button type="submit" class="btn btn-primary">Submit</button>
                    @endif
                </div>
            </form>

            <div class="row mt-4">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Total Simpanan</th>
                                <th>SHU</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dataSHU as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['nama'] }}</td>
                                    <td>{{ 'Rp. ' . number_format($item['total_simpanan'], 0, ',', '.') }}</td>
                                    <td>{{ 'Rp. ' . number_format($item['shu'], 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- ./ Content -->
        @include('includes.admin.footer')
    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('backend/vendors/datepicker/daterangepicker.css') }}" type="text/css">
@endpush

@push('script')
    <script src="{{ asset('backend/vendors/datepicker/daterangepicker.js') }}"></script>
    <script>
        $(function() {
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

            $('#tanggal-pembagian').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true
            });

            $('#persen_cadangan_koperasi').on('keyup', function() {
                var persen = $(this).val();
                var jumlahSHU = $('#jumlahSHU').val();
                jumlahSHU = jumlahSHU.replace(/[^,\d]/g, '').toString();
                var nominal = (persen / 100) * jumlahSHU;
                $('#nominal_cadangan_koperasi').val(nominal);
            });

            $('#persen_anggota_koperasi').on('keyup', function() {
                var persen = $(this).val();
                var jumlahSHU = $('#jumlahSHU').val();
                jumlahSHU = jumlahSHU.replace(/[^,\d]/g, '').toString();
                var nominal = (persen / 100) * jumlahSHU;
                $('#nominal_anggota_koperasi').val(nominal);
            });

            $('#persen_dana_sosial').on('keyup', function() {
                var persen = $(this).val();
                var jumlahSHU = $('#jumlahSHU').val();
                jumlahSHU = jumlahSHU.replace(/[^,\d]/g, '').toString();
                var nominal = (persen / 100) * jumlahSHU;
                $('#nominal_dana_sosial').val(nominal);
            });

        });
    </script>
@endpush
