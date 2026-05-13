@extends('layouts.app', ['title' => 'Signup'])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="section-card p-4 p-lg-5">
            <p class="text-uppercase text-muted small mb-2">Join the store</p>
            <h1 class="display-font mb-4">Create your customer account</h1>
            <form method="POST" action="{{ route('register.store') }}" class="row g-3">
                @csrf
                <div class="col-md-6">
                    <label class="form-label">Full name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">City</label>
                    <input type="text" name="city" value="{{ old('city') }}" class="form-control" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" value="{{ old('address') }}" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Confirm password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
                <div class="col-12 d-grid">
                    <button class="btn btn-brand btn-lg">Create account</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
