@extends('layouts.default')

@section('content')
    <div class="form-wrapper w-75">

        <!-- logo -->
        <div id="logo">
            <img src="{{ asset('backend/assets/media/image/dark-logo.png') }}" alt="image">
        </div>
        <!-- ./ logo -->


        <h5>Create account</h5>

        <!-- form -->
        <form action="{{ route('register.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="nama" placeholder="Nama">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="nim" placeholder="NIM">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="no_hp" placeholder="No. HP">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" name="nik" placeholder="NIK">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <select class="form-control select2" name="fakultas">
                            <option value="">Fakultas</option>
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
                        <input type="text" class="form-control" name="jurusan" placeholder="Jurusan">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir">
                    </div>
                    <div class="form-group">
                        <input type="text" id="daterangepicker" name="tanggal_lahir" class="form-control">
                    </div>
                    <div class="form-group">
                        <select class="form-control select2" name="jenis_kelamin">
                            <option value="">Jenis Kelamin</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="alamat" placeholder="Alamat">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password_confirmation"
                            placeholder="Confirmation Password">
                    </div>
                </div>
            </div>
            <button class="btn btn-primary btn-block">Register</button>
            <hr>
            <p class="text-muted">Already have an account?</p>
            <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Sign in!</a>
        </form>
        <!-- ./ form -->
    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('backend/vendors/datepicker/daterangepicker.css') }}" type="text/css">
@endpush

@push('script')
    <script src="{{ asset('backend/vendors/datepicker/daterangepicker.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#daterangepicker').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true
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
                toastr.danger("{{ session('error') }}");
            @endif

            @if (session()->has('errors'))
                toastr.error("{{ session('errors')->first('username') }}");
            @endif
        });
    </script>
@endpush
