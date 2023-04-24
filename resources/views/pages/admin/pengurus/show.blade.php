<div class="card">
    <div class="card-body p-0">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="row mb-3">
                        <div class="col-md-4">Nama:</div>
                        <div class="col-md-8">{{ $pengurus->nama }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">NIM:</div>
                        <div class="col-md-8">{{ $pengurus->nim }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">Username:</div>
                        <div class="col-md-8">{{ $pengurus->username }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">Email:</div>
                        <div class="col-md-8">{{ $pengurus->email }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">No. HP:</div>
                        <div class="col-md-8">{{ $pengurus->no_hp }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">NIK:</div>
                        <div class="col-md-8">{{ $pengurus->nik }}</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row mb-3">
                        <div class="col-md-4">Fakultas:</div>
                        <div class="col-md-8">{{ $pengurus->fakultas }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">Jurusan:</div>
                        <div class="col-md-8">{{ $pengurus->jurusan }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">Tempat Lahir:</div>
                        <div class="col-md-8">{{ $pengurus->tempat_lahir }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">Tanggal Lahir:</div>
                        <div class="col-md-8">{{ $pengurus->tanggal_lahir->format('d F Y') }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">Jenis Kelamin:</div>
                        <div class="col-md-8">{{ $pengurus->jenis_kelamin }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">Alamat:</div>
                        <div class="col-md-8">{{ $pengurus->alamat }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
