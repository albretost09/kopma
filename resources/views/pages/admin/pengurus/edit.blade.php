@extends('layouts.admin')

@section('content')
    <!-- Content body -->
    <div class="content-body">
        <!-- Content -->
        <div class="content ">

            <div class="page-header">
                <div>
                    <h3>Edit Pengurus</h3>
                    <nav aria-label="breadcrumb" class="d-flex align-items-start">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href={{ route('admin.dashboard') }}>Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Pengurus</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Edit Pengurus</h6>
                                    <form action="{{ route('admin.pengurus.update', $pengurus->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nama</label>
                                                    <input type="text" name="nama" class="form-control"
                                                        value="{{ $pengurus->nama }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input type="text" name="username" class="form-control"
                                                        value="{{ $pengurus->username }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" name="email" class="form-control"
                                                        value="{{ $pengurus->email }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>NIM</label>
                                                    <input type="text" name="nim" class="form-control"
                                                        value="{{ $pengurus->nim }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Fakultas</label>
                                                    <select class="form-control" name="fakultas">
                                                        <option
                                                            value="FKIP"{{ $pengurus->fakultas == 'FKIP' ? ' selected' : '' }}>
                                                            FKIP</option>
                                                        <option
                                                            value="Ekonomi"{{ $pengurus->fakultas == 'Ekonomi' ? ' selected' : '' }}>
                                                            Ekonomi</option>
                                                        <option
                                                            value="Pertanian"{{ $pengurus->fakultas == 'Pertanian' ? ' selected' : '' }}>
                                                            Pertanian
                                                        </option>
                                                        <option
                                                            value="Teknik"{{ $pengurus->fakultas == 'Teknik' ? ' selected' : '' }}>
                                                            Teknik</option>
                                                        <option
                                                            value="Hukum"{{ $pengurus->fakultas == 'Hukum' ? ' selected' : '' }}>
                                                            Hukum</option>
                                                        <option
                                                            value="FISIP"{{ $pengurus->fakultas == 'FISIP' ? ' selected' : '' }}>
                                                            FISIP</option>
                                                        <option
                                                            value="Dokter"{{ $pengurus->fakultas == 'Dokter' ? ' selected' : '' }}>
                                                            Dokter</option>
                                                        <option
                                                            value="MIPA"{{ $pengurus->fakultas == 'MIPA' ? ' selected' : '' }}>
                                                            MIPA</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>No. HP</label>
                                                    <input type="text" name="no_hp" id="no_hp" class="form-control"
                                                        value="{{ $pengurus->no_hp }}">
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary">Save</button>
                                    </form>
                                </div>
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
        $('input[name="daterangepicker"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true
        });
    </script>
@endpush
