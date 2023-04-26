@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <!-- Content -->
        <div class="content">
            <div class="page-header">
                <div>
                    <h3>Laporan Kas</h3>
                    <nav aria-label="breadcrumb" class="d-flex align-items-start">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href={{ route('admin.dashboard') }}>Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Laporan Kas</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <form action="{{ route('admin.laporan-kas.cetak-pdf') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <select class="form-control" name="bulan" id="bulan">
                                <option value="">Pilih Bulan</option>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="number" class="form-control" name="tahun" id="tahun" min="1901"
                                max="2099" placeholder="{{ date('Y') }}" />
                            @if ($errors->has('tahun'))
                                <span class="text-danger">Tahun tidak boleh kosong</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-block">Cetak</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $('#tahun').on('input', function() {
            if (this.value.length > 4)
                this.value = this.value.slice(0, 4);
        });
    </script>
@endpush
