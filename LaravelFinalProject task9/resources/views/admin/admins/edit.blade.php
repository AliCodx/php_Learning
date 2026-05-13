@extends('layouts.admin', ['title' => 'Edit Admin'])

@section('content')
<div class="card card-clean">
    <div class="card-body">
        <h2 class="h4 mb-4">Edit {{ $admin->name }}</h2>
        <form method="POST" action="{{ route('admin.admins.update', $admin) }}" class="row g-3">
            @csrf
            @method('PUT')
            <div class="col-md-6">
                <label class="form-label">Name</label>
                <input type="text" name="name" value="{{ old('name', $admin->name) }}" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email', $admin->email) }}" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $admin->phone) }}" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">City</label>
                <input type="text" name="city" value="{{ old('city', $admin->city) }}" class="form-control" required>
            </div>
            <div class="col-12">
                <label class="form-label">Address</label>
                <input type="text" name="address" value="{{ old('address', $admin->address) }}" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">New Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">Confirm New Password</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>
            <div class="col-12 form-check ms-1">
                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="adminActive" @checked(old('is_active', $admin->is_active))>
                <label class="form-check-label" for="adminActive">Admin account active</label>
            </div>
            <div class="col-12">
                <button class="btn btn-dark">Update Admin</button>
            </div>
        </form>
    </div>
</div>
@endsection
