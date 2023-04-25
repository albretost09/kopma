@extends('layouts.admin')

@section('content')
    <div class="content-body">
        <!-- Content -->
        <div class="content ">

            <div class="page-header d-md-flex justify-content-between">
                <div>
                    <h3>Laporan</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Laporan</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fa fa-file-pdf-o fa-4x"></i>
                            <h3 class="mt-3">Laporan Simpanan</h3>
                            <a href="#" class="btn btn-primary">Cetak</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fa fa-file-pdf-o fa-4x"></i>
                            <h3 class="mt-3">Laporan Kas</h3>
                            <a href="#" class="btn btn-primary">Cetak</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fa fa-file-pdf-o fa-4x"></i>
                            <h3 class="mt-3">Laporan SHU</h3>
                            <form action="{{ route('admin.laporan-shu') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Cetak</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
