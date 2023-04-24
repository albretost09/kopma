@extends('layouts.admin')

@section('content')
    <!-- Content body -->
    <div class="content-body">
        <!-- Content -->
        <div class="content ">

            <div class="page-header">
                <div>
                    <h3>Edit Anggota</h3>
                    <nav aria-label="breadcrumb" class="d-flex align-items-start">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href={{ route('pengurus.dashboard') }}>Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Anggota</li>
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
                                    <h6 class="card-title">Edit Anggota</h6>
                                    <form action="{{ route('pengurus.anggota.update', $anggota->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nama</label>
                                                    <input type="text" name="nama" class="form-control"
                                                        value="{{ $anggota->nama }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input type="text" name="username" class="form-control"
                                                        value="{{ $anggota->username }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" name="email" class="form-control"
                                                        value="{{ $anggota->email }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>NIM</label>
                                                    <input type="text" name="nim" class="form-control"
                                                        value="{{ $anggota->nim }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Fakultas</label>
                                                    <select class="form-control" name="fakultas">
                                                        <option
                                                            value="FKIP"{{ $anggota->fakultas == 'FKIP' ? ' selected' : '' }}>
                                                            FKIP</option>
                                                        <option
                                                            value="Ekonomi"{{ $anggota->fakultas == 'Ekonomi' ? ' selected' : '' }}>
                                                            Ekonomi</option>
                                                        <option
                                                            value="Pertanian"{{ $anggota->fakultas == 'Pertanian' ? ' selected' : '' }}>
                                                            Pertanian
                                                        </option>
                                                        <option
                                                            value="Teknik"{{ $anggota->fakultas == 'Teknik' ? ' selected' : '' }}>
                                                            Teknik</option>
                                                        <option
                                                            value="Hukum"{{ $anggota->fakultas == 'Hukum' ? ' selected' : '' }}>
                                                            Hukum</option>
                                                        <option
                                                            value="FISIP"{{ $anggota->fakultas == 'FISIP' ? ' selected' : '' }}>
                                                            FISIP</option>
                                                        <option
                                                            value="Dokter"{{ $anggota->fakultas == 'Dokter' ? ' selected' : '' }}>
                                                            Dokter</option>
                                                        <option
                                                            value="MIPA"{{ $anggota->fakultas == 'MIPA' ? ' selected' : '' }}>
                                                            MIPA</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>No. HP</label>
                                                    <input type="text" name="no_hp" id="no_hp" class="form-control"
                                                        value="{{ $anggota->no_hp }}">
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
