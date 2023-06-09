@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <!-- Content -->
        <div class="content">

            <div class="page-header d-md-flex justify-content-between">
                <div>
                    <h3>Pengurus</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Pengurus</li>
                        </ol>
                    </nav>
                </div>
                <div class="mt-2 mt-md-0">
                    <a href="#modalTambahPengurus" class="btn btn-primary"
                        data-remote="{{ route('pengurus.pengurus.create') }}" data-toggle="modal"
                        data-target="#modalTambahPengurus" data-title="Tambah Pengurus">
                        Tambah Pengurus
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Pengurus</h6>
                            <div class="table-responsive">
                                <table id="managers" class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Pengurus</th>
                                            <th>Fakultas</th>
                                            <th>Email</th>
                                            <th>No. HP</th>
                                            <th>Status</th>
                                            <th class="text-right">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($pengurus as $p)
                                            <tr>
                                                <td>
                                                    {{ $loop->index + 1 }}
                                                </td>
                                                <td>
                                                    <div class="font-weight-bold">{{ $p->nim }}</div>
                                                    <span>{{ $p->nama }}</span>
                                                </td>
                                                <td>{{ $p->fakultas }}</td>
                                                <td>{{ $p->email }}</td>
                                                <td>{{ $p->no_hp }}</td>
                                                <td>
                                                    @if ($p->status == 'AKTIF')
                                                        <span class="badge badge-success">Aktif</span>
                                                    @elseif($p->status == 'NONAKTIF')
                                                        <span class="badge badge-danger">Tidak Aktif</span>
                                                    @else
                                                        <span class="badge badge-warning">Belum Aktif</span>
                                                    @endif
                                                </td>
                                                <td class="text-right">
                                                    <div class="dropdown">
                                                        <a href="#" data-toggle="dropdown" class="btn btn-floating"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <i class="ti-more-alt"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a href="#myModal" class="dropdown-item"
                                                                data-remote="{{ route('pengurus.pengurus.show', $p->id) }}"
                                                                data-toggle="modal" data-target="#myModal"
                                                                data-title="Detail Anggota">
                                                                Lihat Detail
                                                            </a>
                                                            <a href="#modalStatus" class="dropdown-item"
                                                                data-remote="{{ route('pengurus.pengurus.status', $p->id) }}"
                                                                data-toggle="modal" data-target="#modalStatus"
                                                                data-title="Ubah Status">
                                                                Ubah Status
                                                            </a>
                                                            <form action="{{ route('pengurus.pengurus.destroy', $p->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="dropdown-item text-danger">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">No data available in table</td>
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

        <div class="modal" id="modalTambahPengurus" tabindex="-1" role="dialog">
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

        <div class="modal" id="modalStatus" tabindex="-1" role="dialog">
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

@push('style')
    <link rel="stylesheet" href="{{ asset('backend/vendors/select2/css/select2.min.css') }}" type="text/css">
@endpush

@push('script')
    <script src="{{ asset('backend/vendors/select2/js/select2.min.js') }}"></script>
    <script>
        $(function() {
            var table = $('#managers').DataTable({
                'columnDefs': [{
                    "orderable": false,
                    "targets": [0, 6]
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

            jQuery(document).ready(function($) {
                $('#modalTambahPengurus').on('show.bs.modal', function(e) {
                    var button = $(e.relatedTarget);
                    var modal = $(this);
                    modal.find('.modal-body').load(button.data("remote"));
                    modal.find('.modal-title').html(button.data("title"));

                    setTimeout(() => {
                        $('.select2').select2({
                            placeholder: 'Pilih Anggota',
                            allowClear: true,
                        });
                    }, 250);
                });

                $('#myModal').on('show.bs.modal', function(e) {
                    var button = $(e.relatedTarget);
                    var modal = $(this);
                    modal.find('.modal-body').load(button.data("remote"));
                    modal.find('.modal-title').html(button.data("title"));
                });

                $('#modalStatus').on('show.bs.modal', function(e) {
                    var button = $(e.relatedTarget);
                    var modal = $(this);
                    modal.find('.modal-body').load(button.data("remote"));
                    modal.find('.modal-title').html(button.data("title"));
                });
            });
        });
    </script>
@endpush
