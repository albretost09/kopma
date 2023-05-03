@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <!-- Content -->
        <div class="content ">

            <div class="page-header d-md-flex justify-content-between">
                <div>
                    <h3>Permintaan Penarikan</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Permintaan Penarikan</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-5">
                                <h5>Permintaan Penarikan</h5>
                                <div>
                                    <a href="{{ route('admin.permintaan-penarikan.create') }}" class="btn btn-primary">Tarik
                                        Simpanan</a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="members" class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Pengguna</th>
                                            <th>Tanggal</th>
                                            <th>Jumlah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($permintaanPenarikan as $p)
                                            <tr>
                                                <td>
                                                    {{ $loop->index + 1 }}
                                                </td>
                                                <td>
                                                    <div class="font-weight-bold">{{ $p->simpanan->pengguna?->nama }}</div>
                                                    <div>{{ $p->simpanan->pengguna?->no_hp }}</div>
                                                </td>
                                                <td>{{ $p->created_at->format('d-m-Y') }}</td>
                                                <td>
                                                    <div>{{ 'Rp. ' . number_format($p->jumlah_penarikan, 0, ',', '.') }}
                                                    </div>
                                                    <div>
                                                        @if ($p->status == 'MENUNGGU')
                                                            <span class="badge badge-warning">Menunggu</span>
                                                        @elseif($p->status == 'DITERIMA')
                                                            <span class="badge badge-success">Berhasil</span>
                                                        @else
                                                            <span class="badge badge-danger">Gagal</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" data-toggle="dropdown" class="btn btn-floating"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <i class="ti-more-alt"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a href="#myModal" class="dropdown-item"
                                                                data-remote="{{ route('admin.permintaan-penarikan.show', $p->id) }}"
                                                                data-toggle="modal" data-target="#myModal"
                                                                data-title="Permintaan Penarikan Simpanan">
                                                                Detail Penarikan
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No data available in table</td>
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

        <div class="modal" id="myModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <i class="fa fa-spinner fa-spin"></i>
                    </div>
                </div>
            </div>
        </div>

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

            jQuery(document).ready(function($) {
                $('#myModal').on('show.bs.modal', function(e) {
                    var button = $(e.relatedTarget);
                    var modal = $(this);
                    modal.find('.modal-body').load(button.data("remote"));
                    modal.find('.modal-title').html(button.data("title"));
                });
            });

        });
    </script>
@endpush
