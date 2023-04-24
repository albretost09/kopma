<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{ $permintaanPenarikan->simpanan->pengguna->nama }}</td>
                    </tr>
                    <tr>
                        <td>No HP</td>
                        <td>:</td>
                        <td>{{ $permintaanPenarikan->simpanan->pengguna->no_hp }}</td>
                    </tr>
                    <tr>
                        <td>Jumlah Penarikan</td>
                        <td>:</td>
                        <td>{{ 'Rp. ' . number_format($permintaanPenarikan->jumlah_penarikan, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td>
                            @if ($permintaanPenarikan->status == 'MENUNGGU')
                                <span class="badge badge-warning">Menunggu</span>
                            @elseif($permintaanPenarikan->status == 'DITERIMA')
                                <span class="badge badge-success">Berhasil</span>
                            @else
                                <span class="badge badge-danger">Gagal</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>:</td>
                        <td>{{ $permintaanPenarikan->created_at->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <td>Jenis Transaksi</td>
                        <td>:</td>
                        <td>{{ $permintaanPenarikan->jenis_transaksi }}</td>
                    </tr>
                    <tr>
                        <td>Bank Tujuan</td>
                        <td>:</td>
                        <td>{{ $permintaanPenarikan->bank_tujuan }}</td>
                    </tr>
                    <tr>
                        <td>Nomor Rekening</td>
                        <td>:</td>
                        <td>{{ $permintaanPenarikan->nomor_rekening }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-4">
        <a href="{{ route('admin.permintaan-penarikan.ubah-status', $permintaanPenarikan->id) }}?status=DITERIMA"
            class="btn btn-success btn-block">
            <i class="fa fa-check mr-2"></i> Terima
        </a>
    </div>
    <div class="col-4">
        <a href="{{ route('admin.permintaan-penarikan.ubah-status', $permintaanPenarikan->id) }}?status=DITOLAK"
            class="btn btn-danger btn-block">
            <i class="fa fa-times mr-2"></i> Tolak
        </a>
    </div>
</div>
