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
                <div class="mt-2 mt-md-0">
                    <div class="dropdown">
                        <a href="#" class="btn btn-success dropdown-toggle" title="Filter"
                            data-toggle="dropdown">Filters</a>
                        <div class="dropdown-menu dropdown-menu-big p-4 dropdown-menu-right">
                            <div class="form-group">
                                <label>Jenis Simpanan</label>
                                <select class="form-control" name="jenis_simpanan" id="jenis_simpanan">
                                    <option value="">Select</option>
                                    <option value="Pokok">Simpanan Pokok</option>
                                    <option value="Wajib">Simpanan Wajib</option>
                                    <option value="Sukarela">Simpanan Sukarela</option>
                                </select>
                            </div>
                            <button type="button" class="btn btn-primary" id="get_result">Get Results</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="konten">
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

            // Get the results based on selected filters
            $('#get_result').on('click', function(e) {
                e.preventDefault();
                var jenis_simpanan = $('#jenis_simpanan').val();

                $.ajax({
                    url: "{{ route('admin.simpanan.data') }}",
                    type: "GET",
                    data: {
                        jenis_simpanan: jenis_simpanan,
                    },
                    success: function(data) {
                        // Replace the current table content with the new one
                        $('.konten').html(data);
                        $('#savings').DataTable();
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
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
