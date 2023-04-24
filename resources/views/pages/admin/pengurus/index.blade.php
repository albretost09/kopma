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
                    <a href="{{ route('admin.pengurus.create') }}" class="btn btn-primary">
                        <span>Tambah Pengurus</span>
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
                                                <td class="text-right">
                                                    <div class="dropdown">
                                                        <a href="#" data-toggle="dropdown" class="btn btn-floating"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <i class="ti-more-alt"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a href="{{ route('admin.pengurus.edit', $p->id) }}"
                                                                class="dropdown-item">Edit</a>
                                                            <form action="{{ route('admin.pengurus.destroy', $p->id) }}"
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
        <!-- ./ Content -->

        @include('includes.admin.footer')
    </div>
@endsection

@push('script')
    <script>
        $(function() {
            var table = $('#managers').DataTable({
                'columnDefs': [{
                    "orderable": false,
                    "targets": [0, 5]
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
