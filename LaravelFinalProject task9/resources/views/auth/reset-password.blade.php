@extends('layouts.app', ['title' => 'Reset Password'])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="section-card p-4 p-lg-5">
            <p class="text-uppercase text-muted small mb-2">Secure access</p>
            <h1 class="display-font mb-4">Create a new password</h1>
            <form method="POST" action="{{ route('password.update') }}" class="row g-3">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="col-12">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email', $email) }}" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">New password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Confirm password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
                <div class="col-12 d-grid">
                    <button class="btn btn-brand btn-lg">Reset Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
