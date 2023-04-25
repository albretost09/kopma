@extends('layouts.default')

@section('content')
    <div class="form-wrapper">

        <!-- logo -->
        <div id="logo">
            <img src="{{ asset('backend/assets/media/image/dark-logo.png') }}" alt="image">
        </div>
        <!-- ./ logo -->


        <h5>Sign in</h5>

        <!-- form -->
        <form action="{{ route('pengawas.login') }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="form-group d-flex justify-content-between">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="remember" class="custom-control-input" checked="" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">Remember me</label>
                </div>
                <a href="{{ route('pengawas.recovery-password.index') }}">Reset password</a>
            </div>
            <button class="btn btn-primary btn-block">Sign in</button>
        </form>
        <!-- ./ form -->
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
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

            @if (session()->has('errors'))
                toastr.error("{{ session('errors')->first('username') }}");
            @endif
        });
    </script>
@endpush
