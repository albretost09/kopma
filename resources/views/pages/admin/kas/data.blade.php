<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="mt-3">Pemasukan</div>
                            </div>
                        </h6>
                        <div class="d-flex align-items-center mb-3">
                            <div>
                                <div class="avatar">
                                    <span class="avatar-title bg-success text-white rounded-pill">
                                        <i class="ti-wallet"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="font-weight-bold ml-1 font-size-20 ml-3 text-success">
                                {{ 'Rp. ' . number_format($jumlahMasuk, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="mt-3">Pengeluaran</div>
                            </div>
                        </h6>
                        <div class="d-flex align-items-center mb-3">
                            <div>
                                <div class="avatar">
                                    <span class="avatar-title bg-danger text-white rounded-pill">
                                        <i class="ti-wallet"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="font-weight-bold ml-1 font-size-20 ml-3 text-danger">
                                {{ 'Rp. ' . number_format($jumlahKeluar, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>Saldo</div>
                                <a href="{{ route('admin.kas.create') }}" class="btn btn-primary p-3 btn-rounded">
                                    <i class="ti-plus font-weight-bold"></i>
                                </a>
                            </div>
                        </h6>
                        <div class="d-flex align-items-center mb-3">
                            <div>
                                <div class="avatar">
                                    <span class="avatar-title bg-primary-bright text-primary rounded-pill">
                                        <i class="ti-wallet"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="font-weight-bold ml-1 font-size-20 ml-3">
                                {{ 'Rp. ' . number_format($saldoKas, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Kelola Kas</h6>
                <div class="table-responsive">
                    <table id="savings" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tgl. Transaksi</th>
                                <th>Jenis</th>
                                <th>No. Cek</th>
                                <th>Keterangan</th>
                                <th>Jumlah</th>
                                <th>Dibuat Oleh</th>
                                <th class="text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kas as $k)
                                <tr>
                                    <td>
                                        {{ $loop->index + 1 }}
                                    </td>
                                    <td>{{ $k->tanggal_dibuat }}</td>
                                    <td>{{ $k->jenis }}</td>
                                    <td>{{ $k->no_cek }}</td>
                                    <td>{{ $k->keterangan }}</td>
                                    @if ($k->jenis == 'Masuk')
                                        <td class="text-success">
                                            {{ 'Rp. ' . number_format($k->jumlah, 0, ',', '.') }}</td>
                                    @else
                                        <td class="text-danger">
                                            {{ 'Rp. ' . number_format($k->jumlah, 0, ',', '.') }}</td>
                                    @endif
                                    <td>{{ $k->dibuat_oleh }}</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a href="#" data-toggle="dropdown" class="btn btn-floating"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="ti-more-alt"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="{{ route('admin.kas.edit', $k->id) }}"
                                                    class="dropdown-item">Edit</a>
                                                <form action="{{ route('admin.kas.destroy', $k->id) }}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit"
                                                        class="dropdown-item text-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
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
