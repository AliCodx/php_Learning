@extends('layouts.admin', ['title' => 'Categories'])

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h4 mb-1">Category Management</h2>
        <p class="text-muted mb-0">Catalog hierarchy for the storefront.</p>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-dark">Add Category</a>
</div>

<div class="card card-clean">
    <div class="card-body table-responsive">
        <table class="table align-middle">
            <thead><tr><th>Name</th><th>Products</th><th>Status</th><th></th></tr></thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>
                            <div class="fw-semibold">{{ $category->name }}</div>
                            <div class="small text-muted">{{ $category->slug }}</div>
                        </td>
                        <td>{{ $category->products_count }}</td>
                        <td>{{ $category->is_active ? 'Active' : 'Inactive' }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $categories->links() }}
    </div>
</div>
@endsection
