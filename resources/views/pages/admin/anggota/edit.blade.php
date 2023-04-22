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
                                <a href={{ route('admin.dashboard') }}>Home</a>
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
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" class="form-control" value="{{ $anggota->nama }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control" value="{{ $anggota->username }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Jenis Kelamin</label>
                                                <select class="form-control">
                                                    <option value="L"
                                                        {{ $anggota->jenis_kelamin == 'L' ? ' selected' : '' }}>Laki-laki
                                                    </option>
                                                    <option value="P"
                                                        {{ $anggota->jenis_kelamin == 'P' ? ' selected' : '' }}>Perempuan
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control" value="{{ $anggota->email }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Tempat Lahir</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $anggota->tempat_lahir }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Lahir</label>
                                                <input type="text" name="daterangepicker" class="form-control"
                                                    value="{{ $anggota->tanggal_lahir->format('d-m-y') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <input type="email" class="form-control" value="{{ $anggota->alamat }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Fakultas</label>
                                                <select class="form-control">
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
                                                <label>Role</label>
                                                <select class="form-control">
                                                    <option value="">All</option>
                                                    <option value="">Admin</option>
                                                    <option value="">User</option>
                                                    <option value="" selected>Staff</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select class="form-control">
                                                    <option value="">All</option>
                                                    <option value="" selected>Active</option>
                                                    <option value="">Blocked</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Department</label>
                                                <select class="form-control">
                                                    <option value="">All</option>
                                                    <option value="">Sales</option>
                                                    <option value="" selected>Development</option>
                                                    <option value="">Management</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary">Save</button>
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
