@extends('layouts.admin')

@section('content')
    <!-- Content body -->
    <div class="content-body">
        <!-- Content -->
        <div class="content ">

            <div class="page-header">
                <div>
                    <h3>Tambah Pengurus</h3>
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
                                    <h6 class="card-title">Tambah Pengurus</h6>
                                    <form action="{{ route('admin.pengurus.store') }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Nama</label>
                                                    <input type="text" name="nama" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input type="text" name="username" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" name="email" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>NIM</label>
                                                    <input type="text" name="nim" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Fakultas</label>
                                                    <select class="form-control" name="fakultas">
                                                        <option value="FKIP">FKIP</option>
                                                        <option value="Ekonomi">Ekonomi</option>
                                                        <option value="Pertanian">Pertanian</option>
                                                        <option value="Teknik">Teknik</option>
                                                        <option value="Hukum">Hukum</option>
                                                        <option value="FISIP">FISIP</option>
                                                        <option value="Dokter">Dokter</option>
                                                        <option value="MIPA">MIPA</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>No. HP</label>
                                                    <input type="text" name="no_hp" id="no_hp"
                                                        class="form-control">
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
