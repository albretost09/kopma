@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <!-- Content -->
        <div class="content">
            <div class="page-header">
                <div>
                    <h3>Laporan SHU</h3>
                    <nav aria-label="breadcrumb" class="d-flex align-items-start">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href={{ route('pengawas.dashboard') }}>Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Laporan SHU</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <form action="{{ route('pengawas.laporan-shu.cetak-pdf') }}" target="_blank" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-10">
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
