@extends('layouts.app', ['title' => 'Login'])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-5">
        <div class="section-card p-4 p-lg-5">
            <p class="text-uppercase text-muted small mb-2">Welcome back</p>
            <h1 class="display-font mb-4">Login to your account</h1>
            <form method="POST" action="{{ route('login.store') }}" class="row g-3">
                @csrf
                <div class="col-12">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="col-12 text-end">
                    <a href="{{ route('password.request') }}" class="small">Forgot password?</a>
                </div>
                <div class="col-12 form-check ms-1">
                    <input class="form-check-input" type="checkbox" name="remember" value="1" id="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
                <div class="col-12 d-grid">
                    <button class="btn btn-brand btn-lg">Login</button>
                </div>
            </form>
            <p class="mt-4 mb-0">New here? <a href="{{ route('register') }}">Create an account</a></p>
        </div>
    </div>
</div>
@endsection
