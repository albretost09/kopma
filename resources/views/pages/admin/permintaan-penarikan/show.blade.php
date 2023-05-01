<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body p-0">
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

@if ($permintaanPenarikan->status == 'MENUNGGU')
    <form action="{{ route('admin.permintaan-penarikan.ubah-status', $permintaanPenarikan->id) }}" method="post"
        enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="bukti">
                        <span>Bukti Transfer</span>
                    </label>
                    <input type="file" name="bukti" id="bukti" class="form-control" accept="image/*">
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-4 text-right">
                <label for="diterima">
                    <button type="submit" name="status" value="DITERIMA" id="diterima"
                        class="btn btn-success btn-block" onclick="return confirm('Apakah anda yakin?')">
                        <i class="fa fa-check mr-2"></i> Terima
                    </button>
                </label>
            </div>
            <div class="col-4 text-left">
                <label for="ditolak">
                    <button type="submit" name="status" value="DITOLAK" id="ditolak"
                        class="btn btn-danger btn-block" onclick="return confirm('Apakah anda yakin?')">
                        <i class="fa fa-times mr-2"></i> Tolak
                    </button>
            </div>
        </div>
    </form>
@endif
