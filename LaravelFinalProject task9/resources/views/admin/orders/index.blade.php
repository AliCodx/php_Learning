@extends('layouts.admin', ['title' => 'Orders'])

@section('content')
<div class="card card-clean">
    <div class="card-body table-responsive">
        <table class="table align-middle">
            <thead><tr><th>Order</th><th>Customer</th><th>Total</th><th>Items</th><th>Status</th><th></th></tr></thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>
                            <div class="fw-semibold">{{ $order->order_number }}</div>
                            <div class="small text-muted">{{ optional($order->placed_at)->format('d M Y') }}</div>
                        </td>
                        <td>{{ $order->user->name }}</td>
                        <td>Rs. {{ number_format($order->total_amount, 2) }}</td>
                        <td>{{ $order->items->sum('quantity') }}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.orders.status', $order) }}" class="d-flex gap-2">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="form-select form-select-sm">
                                    @foreach($statuses as $status)
                                        <option value="{{ $status }}" @selected($order->status === $status)>{{ ucfirst($status) }}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-outline-dark btn-sm">Save</button>
                            </form>
                        </td>
                        <td class="text-end"><a href="{{ route('admin.orders.show', $order) }}" class="btn btn-outline-secondary btn-sm">View</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $orders->links() }}
    </div>
</div>
@endsection
