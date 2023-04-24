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
        <form action="{{ route('recovery-password.reset-password', $token) }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="form-group">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password" placeholder="Password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                    autocomplete="new-password" placeholder="Confirm Password">
            </div>
            <button class="btn btn-primary btn-block">Submit</button>
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
