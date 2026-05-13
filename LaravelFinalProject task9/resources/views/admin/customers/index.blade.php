@extends('layouts.admin', ['title' => 'Customer Records'])

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')
<div class="card card-clean">
    <div class="card-body">
        <h2 class="h4 mb-3">Customers via Yajra DataTables</h2>
        <div class="table-responsive">
            <table id="customers-table" class="table table-striped align-middle w-100">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>City</th>
                        <th>Orders</th>
                        <th>Total Spend</th>
                        <th>Status</th>
                        <th>Joined</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
<script>
    $('#customers-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('admin.customers.data') }}',
        columns: [
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'city', name: 'city'},
            {data: 'orders_count', name: 'orders_count'},
            {data: 'orders_sum_total_amount', name: 'orders_sum_total_amount'},
            {data: 'status_badge', name: 'is_active'},
            {data: 'created_at', name: 'created_at'}
        ]
    });
</script>
@endpush
