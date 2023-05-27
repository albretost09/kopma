<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{ $pengunduranDiri->pengguna->nama }}</td>
                    </tr>
                    <tr>
                        <td>NIM</td>
                        <td>:</td>
                        <td>{{ $pengunduranDiri->pengguna->nim }}</td>
                    </tr>
                    <tr>
                        <td>No HP</td>
                        <td>:</td>
                        <td>{{ $pengunduranDiri->pengguna->no_hp }}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td>
                            @if ($pengunduranDiri->status == 'MENUNGGU')
                                <span class="badge badge-warning">Menunggu</span>
                            @elseif($pengunduranDiri->status == 'DITERIMA')
                                <span class="badge badge-success">Berhasil</span>
                            @else
                                <span class="badge badge-danger">Gagal</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal Pengajuan</td>
                        <td>:</td>
                        <td>{{ $pengunduranDiri->tanggal_pengajuan->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <td>Alasan</td>
                        <td>:</td>
                        <td>{{ $pengunduranDiri->alasan }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

@if ($pengunduranDiri->status == 'MENUNGGU')
    <div class="row justify-content-center">
        <div class="col-4">
            <a href="{{ route('admin.validasi-pengunduran-diri.store', $pengunduranDiri->id) }}?status=DITERIMA"
                class="btn btn-success btn-block" onclick="return confirm('Apakah anda yakin?')">
                <i class="fa fa-check mr-2"></i> Terima
            </a>
        </div>
        <div class="col-4">
            <a href="{{ route('admin.validasi-pengunduran-diri.store', $pengunduranDiri->id) }}?status=DITOLAK"
                class="btn btn-danger btn-block" onclick="return confirm('Apakah anda yakin?')">
                <i class="fa fa-times mr-2"></i> Tolak
            </a>
        </div>
    </div>
@endif
