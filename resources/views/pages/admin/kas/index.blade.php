@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <!-- Content -->
        <div class="content ">

            <div class="page-header d-md-flex justify-content-between">
                <div>
                    <h3>Kelola Kas</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Kelola Kas</li>
                        </ol>
                    </nav>
                </div>
                <div class="mt-2 mt-md-0">
                    <div class="dropdown">
                        <a href="#" class="btn btn-success dropdown-toggle" title="Filter"
                            data-toggle="dropdown">Filters</a>
                        <div class="dropdown-menu dropdown-menu-big p-4 dropdown-menu-right">
                            <div class="form-group">
                                <label>Bulan</label>
                                <select class="form-control" name="bulan" id="bulan">
                                    <option value="">Select</option>
                                    <option value="01">Januari</option>
                                    <option value="02">Februari</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tahun</label>
                                <input type="number" class="form-control" id="tahun" name="tahun" min="1901"
                                    max="2099" />
                            </div>
                            <div class="form-group">
                                <label>Jenis Kas</label>
                                <select class="form-control" name="jenis_kas" id="jenis_kas">
                                    <option value="">Select</option>
                                    <option value="Masuk">Pemasukan</option>
                                    <option value="Keluar">Pengeluaran</option>
                                </select>
                            </div>
                            <button type="button" class="btn btn-primary" id="get_result">Get Results</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="konten">
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
                                                <a href="{{ route('admin.kas.create') }}"
                                                    class="btn btn-primary p-3 btn-rounded">
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
                                                            <a href="#" data-toggle="dropdown"
                                                                class="btn btn-floating" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="ti-more-alt"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="{{ route('admin.kas.edit', $k->id) }}"
                                                                    class="dropdown-item">Edit</a>
                                                                <form action="{{ route('admin.kas.destroy', $k->id) }}"
                                                                    method="post">
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
                                                {{-- <tr>
                                                    <td colspan="6" class="text-center">No data available in table</td>
                                                </tr> --}}
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
            $('#savings').DataTable();

            // Get the results based on selected filters
            $('#get_result').on('click', function(e) {
                e.preventDefault();
                var bulan = $('#bulan').val();
                var tahun = $('#tahun').val();
                var jenis_kas = $('#jenis_kas').val();

                $.ajax({
                    url: "{{ route('admin.kas.data') }}",
                    type: "GET",
                    data: {
                        bulan: bulan,
                        tahun: tahun,
                        jenis_kas: jenis_kas,
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

            $('#tahun').on('input', function() {
                if (this.value.length > 4) {
                    this.value = this.value.slice(0, 4);
                }
            });

            @if (session()->has('success'))
                toastr.success("{{ session('success') }}");
            @endif

            @if (session()->has('error'))
                toastr.error("{{ session('error') }}");
            @endif
        });
    </script>
@endpush
