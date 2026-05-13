@extends('layouts.admin', ['title' => 'Edit Category'])

@section('content')
<div class="card card-clean">
    <div class="card-body">
        <h2 class="h4 mb-4">Edit {{ $category->name }}</h2>
        <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="row g-3">
            @csrf
            @method('PUT')
            <div class="col-12">
                <label class="form-label">Name</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" class="form-control" required>
            </div>
            <div class="col-12">
                <label class="form-label">Description</label>
                <textarea name="description" rows="5" class="form-control">{{ old('description', $category->description) }}</textarea>
            </div>
            <div class="col-12 form-check ms-1">
                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive" @checked(old('is_active', $category->is_active))>
                <label class="form-check-label" for="isActive">Active category</label>
            </div>
            <div class="col-12">
                <button class="btn btn-dark">Update Category</button>
            </div>
        </form>
    </div>
</div>
@endsection
