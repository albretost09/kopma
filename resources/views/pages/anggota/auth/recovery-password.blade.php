@extends('layouts.default')

@section('content')
    <div class="form-wrapper">

        <!-- logo -->
        <div id="logo">
            <img src="{{ asset('backend/assets/media/image/dark-logo.png') }}" alt="image">
        </div>
        <!-- ./ logo -->


        <h5>Reset password</h5>

        <!-- form -->
        <form action="{{ route('recovery-password.send-email') }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Username or email" required autofocus>
            </div>
            <button class="btn btn-primary btn-block">Submit</button>
            <hr>
            <p class="text-muted">Take a different action.</p>
            <a href="register.html" class="btn btn-sm btn-outline-light mr-1">Register now!</a>
            or
            <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light ml-1">Login!</a>
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
                toastr.error("{{ session('error') }}");
            @endif
        });
    </script>
@endpush
