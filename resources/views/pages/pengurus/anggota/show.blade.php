<div class="card">
    <div class="card-body p-0">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="row mb-3">
                        <div class="col-md-4">Nama:</div>
                        <div class="col-md-8">{{ $anggota->nama }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">NIM:</div>
                        <div class="col-md-8">{{ $anggota->nim }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">Username:</div>
                        <div class="col-md-8">{{ $anggota->username }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">Email:</div>
                        <div class="col-md-8">{{ $anggota->email }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">No. HP:</div>
                        <div class="col-md-8">{{ $anggota->no_hp }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">NIK:</div>
                        <div class="col-md-8">{{ $anggota->nik }}</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row mb-3">
                        <div class="col-md-4">Fakultas:</div>
                        <div class="col-md-8">{{ $anggota->fakultas }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">Jurusan:</div>
                        <div class="col-md-8">{{ $anggota->jurusan }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">Tempat Lahir:</div>
                        <div class="col-md-8">{{ $anggota->tempat_lahir }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">Tanggal Lahir:</div>
                        <div class="col-md-8">{{ $anggota->tanggal_lahir->format('d F Y') }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">Jenis Kelamin:</div>
                        <div class="col-md-8">{{ $anggota->jenis_kelamin }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">Alamat:</div>
                        <div class="col-md-8">{{ $anggota->alamat }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
