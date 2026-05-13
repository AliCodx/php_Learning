@extends('layouts.admin', ['title' => 'Create Category'])

@section('content')
<div class="card card-clean">
    <div class="card-body">
        <h2 class="h4 mb-4">Add Category</h2>
        <form method="POST" action="{{ route('admin.categories.store') }}" class="row g-3">
            @csrf
            <div class="col-12">
                <label class="form-label">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
            </div>
            <div class="col-12">
                <label class="form-label">Description</label>
                <textarea name="description" rows="5" class="form-control">{{ old('description') }}</textarea>
            </div>
            <div class="col-12 form-check ms-1">
                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive" checked>
                <label class="form-check-label" for="isActive">Active category</label>
            </div>
            <div class="col-12">
                <button class="btn btn-dark">Save Category</button>
            </div>
        </form>
    </div>
</div>
@endsection
