<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Simpanan</h6>
                <div class="table-responsive">
                    <table id="savings" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Penyetor</th>
                                <th>Tanggal</th>
                                <th>Jumlah</th>
                                <th>Jenis Simpanan</th>
                                <th>Jenis Transaksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($simpanan as $s)
                                <tr>
                                    <td>
                                        {{ $loop->index + 1 }}
                                    </td>
                                    <td>
                                        <div class="font-weight-bold">{{ $s->pengguna?->nama }}</div>
                                        <div>{{ $s->pengguna?->nim }}</div>
                                    </td>
                                    <td>{{ $s->created_at->format('d-m-Y') }}</td>
                                    <td>{{ 'Rp. ' . number_format($s->jumlah, 0, ',', '.') }}
                                    <td>{{ $s->jenis_simpanan }}</td>
                                    @if ($s->jenis_transaksi == 'Transfer')
                                        <td>
                                            <span>{{ $s->jenis_transaksi }}</span>
                                            <small><a href="{{ asset('storage/' . $s->bukti_transaksi) }}"
                                                    target="_blank" class="text-primary">Lihat
                                                    File</a></small>
                                        </td>
                                    @else
                                        <td>{{ $s->jenis_transaksi }}</td>
                                    @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No data available in table</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
