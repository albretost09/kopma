<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{ $simpanan->pengguna->nama }}</td>
                    </tr>
                    <tr>
                        <td>No HP</td>
                        <td>:</td>
                        <td>{{ $simpanan->pengguna->no_hp }}</td>
                    </tr>
                    <tr>
                        <td>Jumlah</td>
                        <td>:</td>
                        <td>{{ 'Rp. ' . number_format($simpanan->jumlah, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td>
                            @if ($simpanan->status == 'MENUNGGU')
                                <span class="badge badge-warning">Menunggu</span>
                            @elseif($simpanan->status == 'DITERIMA')
                                <span class="badge badge-success">Berhasil</span>
                            @else
                                <span class="badge badge-danger">Gagal</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>:</td>
                        <td>{{ $simpanan->created_at->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <td>Jenis Transaksi</td>
                        <td>:</td>
                        <td>{{ $simpanan->jenis_transaksi }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right">
                            Divalidasi oleh: {{ $simpanan->disetujui_oleh }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

@if ($simpanan->status == 'MENUNGGU')
    <div class="row justify-content-center">
        <div class="col-4">
            <a href="{{ route('pengurus.simpanan.ubah-status', $simpanan->id) }}?status=DITERIMA"
                class="btn btn-success btn-block" onclick="return confirm('Apakah anda yakin?')">
                <i class="fa fa-check mr-2"></i> Terima
            </a>
        </div>
        <div class="col-4">
            <a href="{{ route('pengurus.simpanan.ubah-status', $simpanan->id) }}?status=DITOLAK"
                class="btn btn-danger btn-block" onclick="return confirm('Apakah anda yakin?')">
                <i class="fa fa-times mr-2"></i> Tolak
            </a>
        </div>
    </div>
@endif
