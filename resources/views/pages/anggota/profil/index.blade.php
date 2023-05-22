@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <!-- Content -->
        <div class="content">
            <div class="page-header">
                <div>
                    <h3>Settings</h3>
                    <nav aria-label="breadcrumb" class="d-flex align-items-start">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href={{ route('dashboard') }}>Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Settings</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="nav nav-pills flex-column" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <a class="nav-item nav-link {{ $errors->has('*password') ? '' : 'active'  }}" id="v-pills-home-tab" data-toggle="pill"
                                    href="#v-pills-home" role="tab" aria-controls="v-pills-home"
                                    aria-selected="true">Your
                                    Profile</a>
                                <a class="nav-item nav-link {{ $errors->has('*password') ? 'active' : ''  }}" id="v-pills-profile-tab" data-toggle="pill"
                                    href="#v-pills-profile" role="tab" aria-controls="v-pills-profile"
                                    aria-selected="false">Password</a>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show {{ $errors->has('*password') ? '' : 'active'  }}" id="v-pills-home" role="tabpanel"
                                    aria-labelledby="v-pills-home-tab">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">Your Profile</h6>
                                            <form action="{{ route('anggota.profil.ubah-profil') }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Nama</label>
                                                            <input type="text" class="form-control" name="nama"
                                                                value="{{ old('nama') ?? auth()->user()->nama }}">
                                                            @if ($errors->has('nama'))
                                                                <span
                                                                    class="text-danger">{{ $errors->first('nama') }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Username</label>
                                                            <input type="text" class="form-control" name="username"
                                                                value="{{ old('username') ?? auth()->user()->username }}">
                                                            @if ($errors->has('username'))
                                                                <span
                                                                    class="text-danger">{{ $errors->first('username') }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input type="email" class="form-control" name="email"
                                                                value="{{ old('email') ?? auth()->user()->email }}">
                                                            @if ($errors->has('email'))
                                                                <span
                                                                    class="text-danger">{{ $errors->first('email') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Fakultas</label>
                                                            <select class="form-control" name="fakultas">
                                                                <option
                                                                    value="FKIP"{{ old('fakultas') == 'FKIP' ? ' selected' : (auth()->user()->fakultas == 'FKIP' ? ' selected' : '') }}>
                                                                    FKIP</option>
                                                                <option
                                                                    value="Ekonomi"{{ old('fakultas') == 'Ekonomi' ? ' selected' : (auth()->user()->fakultas == 'Ekonomi' ? ' selected' : '') }}>
                                                                    Ekonomi</option>
                                                                <option
                                                                    value="Pertanian"{{ old('fakultas') == 'Pertanian' ? ' selected' : (auth()->user()->fakultas == 'Pertanian' ? ' selected' : '') }}>
                                                                    Pertanian
                                                                </option>
                                                                <option
                                                                    value="Teknik"{{ old('fakultas') == 'Teknik' ? ' selected' : (auth()->user()->fakultas == 'Teknik' ? ' selected' : '') }}>
                                                                    Teknik</option>
                                                                <option
                                                                    value="Hukum"{{ old('fakultas') == 'Hukum' ? ' selected' : (auth()->user()->fakultas == 'Hukum' ? ' selected' : '') }}>
                                                                    Hukum</option>
                                                                <option
                                                                    value="FISIP"{{ old('fakultas') == 'FISIP' ? ' selected' : (auth()->user()->fakultas == 'FISIP' ? ' selected' : '') }}>
                                                                    FISIP</option>
                                                                <option
                                                                    value="Dokter"{{ old('fakultas') == 'Dokter' ? ' selected' : (auth()->user()->fakultas == 'Dokter' ? ' selected' : '') }}>
                                                                    Dokter</option>
                                                                <option
                                                                    value="MIPA"{{ old('fakultas') == 'MIPA' ? ' selected' : (auth()->user()->fakultas == 'MIPA' ? ' selected' : '') }}>
                                                                    MIPA</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Jurusan</label>
                                                            <input type="text" class="form-control" name="jurusan"
                                                                value="{{ old('jurusan') ?? auth()->user()->jurusan }}">
                                                            @if ($errors->has('jurusan'))
                                                                <span
                                                                    class="text-danger">{{ $errors->first('jurusan') }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label>NIM</label>
                                                            <input type="text" class="form-control" name="nim"
                                                                value="{{ old('nim') ?? auth()->user()->nim }}">
                                                            @if ($errors->has('nim'))
                                                                <span
                                                                    class="text-danger">{{ $errors->first('nim') }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label>NIK</label>
                                                            <input type="number" class="form-control" name="nik"
                                                                value="{{ old('nik') ?? auth()->user()->nik }}">
                                                            @if ($errors->has('nik'))
                                                                <span
                                                                    class="text-danger">{{ $errors->first('nik') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary">Save</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">Contact</h6>
                                            <form action="{{ route('anggota.profil.ubah-profil') }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Tempat Lahir</label>
                                                            <input type="text" class="form-control"
                                                                name="tempat_lahir"
                                                                value="{{ auth()->user()->tempat_lahir }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tanggal Lahir</label>
                                                            <input type="text" class="form-control"
                                                                name="tanggal_lahir"
                                                                value="{{ auth()->user()->tanggal_lahir->format('d-m-Y') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <p>Jenis Kelamin</p>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="customRadio1"
                                                                    name="jenis_kelamin" class="custom-control-input"
                                                                    value="L"{{ auth()->user()->jenis_kelamin == 'Laki-laki' ? ' checked' : '' }}>
                                                                <label class="custom-control-label"
                                                                    for="customRadio1">Laki-laki</label>
                                                            </div>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="customRadio2"
                                                                    name="jenis_kelamin" class="custom-control-input"
                                                                    value="P"{{ auth()->user()->jenis_kelamin == 'Perempuan' ? ' checked' : '' }}>
                                                                <label class="custom-control-label"
                                                                    for="customRadio2">Perempuan</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>No. HP</label>
                                                            <input type="text" class="form-control" name="no_hp"
                                                                value="{{ auth()->user()->no_hp }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Alamat</label>
                                                            <input type="text" class="form-control" name="alamat"
                                                                value="{{ auth()->user()->alamat }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary">Save</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade show {{ $errors->has('*password') ? 'active' : ''  }}" id="v-pills-profile" role="tabpanel"
                                    aria-labelledby="v-pills-profile-tab">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">Password</h6>
                                            <form action="{{ route('anggota.profil.ubah-password') }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Old Password</label>
                                                            <input type="password" class="form-control"
                                                                name="old_password">
                                                            @if ($errors->has('old_password'))
                                                                <span
                                                                    class="text-danger">{{ $errors->first('old_password') }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label>New Password</label>
                                                            <input type="password" class="form-control" name="password">
                                                            @if ($errors->has('password'))
                                                                <span
                                                                    class="text-danger">{{ $errors->first('password') }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label>New Password Repeat</label>
                                                            <input type="password" class="form-control"
                                                                name="password_confirmation">
                                                            @if ($errors->has('password_confirmation'))
                                                                <span
                                                                    class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                                            @endif
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
            </div>
        </div>
        <!-- ./ Content -->
        @include('includes.admin.footer')
    </div>
@endsection

@push('script')
    <script>
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
