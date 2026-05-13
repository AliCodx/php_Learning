@extends('layouts.admin', ['title' => 'Admin Users'])

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h4 mb-1">Admin Management</h2>
        <p class="text-muted mb-0">Add new admins, update credentials, and manage active access.</p>
    </div>
    <a href="{{ route('admin.admins.create') }}" class="btn btn-dark">Add Admin</a>
</div>

<div class="card card-clean">
    <div class="card-body table-responsive">
        <table class="table align-middle">
            <thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>City</th><th>Status</th><th></th></tr></thead>
            <tbody>
                @foreach($admins as $admin)
                    <tr>
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>{{ $admin->phone }}</td>
                        <td>{{ $admin->city }}</td>
                        <td>{{ $admin->is_active ? 'Active' : 'Inactive' }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.admins.edit', $admin) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
                            @if($admin->id !== auth()->id())
                                <form action="{{ route('admin.admins.destroy', $admin) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $admins->links() }}
    </div>
</div>
@endsection
