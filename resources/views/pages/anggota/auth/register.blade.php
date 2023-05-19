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
            <div class="row text-left">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control mb-1" name="nama" placeholder="Nama"
                            value="{{ old('nama') }}">
                        <small class="text-danger">{{ $errors->first('nama') }}</small>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control mb-1" name="nim" placeholder="NIM"
                            value="{{ old('nim') }}">
                        <small class="text-danger">{{ $errors->first('nim') }}</small>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control mb-1" name="username" placeholder="Username"
                            value="{{ old('username') }}">
                        <small class="text-danger">{{ $errors->first('username') }}</small>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control mb-1" name="email" placeholder="Email"
                            value="{{ old('email') }}">
                        <small class="text-danger">{{ $errors->first('email') }}</small>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control mb-1" name="no_hp" placeholder="No. HP"
                            value="{{ old('no_hp') }}">
                        <small class="text-danger">{{ $errors->first('no_hp') }}</small>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control mb-1" name="nik" placeholder="NIK"
                            value="{{ old('nik') }}">
                        <small class="text-danger">{{ $errors->first('nik') }}</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group text-left">
                        <select class="form-control mb-1 select2" name="fakultas">
                            <option value="" {{ old('fakultas') == '' ? 'selected' : '' }}>Fakultas</option>
                            <option value="FKIP" {{ old('fakultas') == 'FKIP' ? 'selected' : '' }}>FKIP</option>
                            <option value="Ekonomi" {{ old('fakultas') == 'Ekonomi' ? 'selected' : '' }}>Ekonomi
                            <option value="Pertanian" {{ old('fakultas') == 'Pertanian' ? 'selected' : '' }}>Pertanian
                            <option value="Teknik" {{ old('fakultas') == 'Teknik' ? 'selected' : '' }}>Teknik</option>
                            <option value="Hukum" {{ old('fakultas') == 'Hukum' ? 'selected' : '' }}>Hukum</option>
                            <option value="FISIP" {{ old('fakultas') == 'FISIP' ? 'selected' : '' }}>FISIP</option>
                            <option value="Dokter" {{ old('fakultas') == 'Dokter' ? 'selected' : '' }}>Dokter</option>
                            <option value="MIPA" {{ old('fakultas') == 'MIPA' ? 'selected' : '' }}>MIPA</option>
                        </select>
                        <small class="text-danger">{{ $errors->first('fakultas') }}</small>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control mb-1" name="jurusan" placeholder="Jurusan"
                            value="{{ old('jurusan') }}">
                        <small class="text-danger">{{ $errors->first('jurusan') }}</small>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control mb-1" name="tempat_lahir" placeholder="Tempat Lahir"
                            value="{{ old('tempat_lahir') }}">
                        <small class="text-danger">{{ $errors->first('tempat_lahir') }}</small>
                    </div>
                    <div class="form-group">
                        <input type="text" id="daterangepicker" name="tanggal_lahir" class="form-control mb-1"
                            value="{{ old('tanggal_lahir') }}" placeholder="Tanggal Lahir">
                        <small class="text-danger">{{ $errors->first('tanggal_lahir') }}</small>
                    </div>
                    <div class="form-group text-left">
                        <select class="form-control mb-1 select2" name="jenis_kelamin">
                            <option value="" {{ old('jenis_kelamin') == '' ? 'selected' : '' }}>Jenis Kelamin
                            </option>
                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        <small class="text-danger">{{ $errors->first('jenis_kelamin') }}</small>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control mb-1" name="alamat" placeholder="Alamat"
                            value="{{ old('alamat') }}">
                        <small class="text-danger">{{ $errors->first('alamat') }}</small>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="password" class="form-control mb-1" name="password" placeholder="Password"
                            value="{{ old('password') }}">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control mb-1" name="password_confirmation"
                            placeholder="Confirmation Password" value="{{ old('password_confirmation') }}">
                        <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
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
    <script src="{{ asset('backend/vendors/input-mask/jquery.mask.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#daterangepicker').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true
            });

            $('input[name="nim"]').on('keyup', function() {
                var nim = $(this).val().replace(/\s/g, '');
                $(this).val(nim);
            });

            $('input[name="no_hp"]').mask('+62 999999999999');

            $('input[name="nik"]').on('keyup', function() {
                var nik = $(this).val().replace(/\s/g, '');
                $(this).val(nik);
            });

            $('input[name="nik"]').mask('9999999999999999');

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
        });
    </script>
@endpush
