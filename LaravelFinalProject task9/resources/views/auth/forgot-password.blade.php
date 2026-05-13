@extends('layouts.app', ['title' => 'Forgot Password'])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="section-card p-4 p-lg-5">
            <p class="text-uppercase text-muted small mb-2">Password help</p>
            <h1 class="display-font mb-3">Forgot your password?</h1>
            <p class="text-muted mb-4">Enter your account email and Laravel will create a reset link. In this demo setup, the mail may be written to the application log if SMTP is not configured.</p>
            <form method="POST" action="{{ route('password.email') }}" class="row g-3">
                @csrf
                <div class="col-12">
                    <label class="form-label">Email address</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                </div>
                <div class="col-12 d-grid">
                    <button class="btn btn-brand btn-lg">Send Reset Link</button>
                </div>
            </form>
            <p class="mt-4 mb-0"><a href="{{ route('login') }}">Back to login</a></p>
        </div>
    </div>
</div>
@endsection
