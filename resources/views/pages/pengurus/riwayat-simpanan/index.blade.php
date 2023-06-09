@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <!-- Content -->
        <div class="content ">

            <div class="page-header d-md-flex justify-content-between">
                <div>
                    <h3>Riwayat Simpanan</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Riwayat Simpanan</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Riwayat Simpanan</h6>
                            <div class="table-responsive">
                                <table id="histories" class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Transaksi</th>
                                            <th>Jumlah</th>
                                            <th>Jenis Simpanan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 0;
                                        @endphp
                                        @foreach ($simpanan as $s)
                                            @php
                                                $no++;
                                            @endphp
                                            <tr>
                                                <td>
                                                    {{ $no }}
                                                </td>
                                                <td>{{ $s->created_at->format('d-m-Y') }}</td>
                                                <td>
                                                    <div>Uang Masuk</div>
                                                    <div>{{ $s->jenis_simpanan }}</div>
                                                </td>
                                                <td>
                                                    <div>{{ 'Rp. ' . number_format($s->jumlah, 0, ',', '.') }}</div>
                                                    <div>
                                                        @if ($s->status == 'MENUNGGU')
                                                            <span class="badge badge-warning">Menunggu</span>
                                                        @elseif($s->status == 'DITERIMA')
                                                            <span class="badge badge-success">Berhasil</span>
                                                        @else
                                                            <span class="badge badge-danger">Gagal</span>
                                                        @endif
                                                    </div>
                                                </td>
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
                                            </tr>
                                        @endforeach

                                        @foreach ($riwayatPenarikan as $rp)
                                            @php
                                                $no++;
                                            @endphp
                                            <tr>
                                                <td>
                                                    {{ $no }}
                                                </td>
                                                <td>{{ $rp->created_at->format('d-m-Y') }}</td>
                                                <td>
                                                    <div>Uang Keluar</div>
                                                    @if ($rp->jenis_transaksi == 'Transfer')
                                                        <span>{{ $rp->jenis_transaksi }}</span>
                                                        @if ($rp->bukti_transfer != null)
                                                            <small><a href="{{ asset('storage/' . $rp->bukti_transfer) }}"
                                                                    target="_blank" class="text-primary">Lihat
                                                                    File</a></small>
                                                        @endif
                                                    @else
                                                        <div>{{ $rp->jenis_transaksi }}</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div>{{ 'Rp. ' . number_format($rp->jumlah_penarikan, 0, ',', '.') }}
                                                    </div>
                                                    <div>
                                                        @if ($rp->status == 'MENUNGGU')
                                                            <span class="badge badge-warning">Menunggu</span>
                                                        @elseif($rp->status == 'DITERIMA')
                                                            <span class="badge badge-success">Berhasil</span>
                                                        @else
                                                            <span class="badge badge-danger">Gagal</span>
                                                        @endif
                                                    </div>
                                                </td>
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
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
        $(function() {
            var table = $('#histories').DataTable({
                'columnDefs': [{
                    "orderable": false,
                    "targets": [0]
                }],
            });

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
        });
    </script>
@endpush
