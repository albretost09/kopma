@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <!-- Content -->
        <div class="content ">

            <div class="page-header d-md-flex justify-content-between">
                <div>
                    <h3>Simpanan</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Simpanan</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Simpanan</h6>
                            <div class="table-responsive">
                                <table id="members" class="table">
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
                                                                target="_blank" class="text-primary">Lihat File</a></small>
                                                    </td>
                                                @else
                                                    <td>{{ $s->jenis_transaksi }}</td>
                                                @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">No data available in table</td>
                                            </tr>
                                        @endforelse
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
            var table = $('#members').DataTable({
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
                toastr.danger("{{ session('error') }}");
            @endif
        });
    </script>
@endpush
