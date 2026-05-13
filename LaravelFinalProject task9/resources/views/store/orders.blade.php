@extends('layouts.app', ['title' => 'My Orders'])

@section('content')
<div class="section-card p-4 p-lg-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <p class="text-uppercase small text-muted mb-2">Customer area</p>
            <h1 class="display-font mb-0">My Orders</h1>
        </div>
        <a href="{{ route('home') }}" class="btn btn-outline-dark">Continue shopping</a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Order</th>
                    <th>Items</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Placed</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>
                            <div class="fw-semibold">{{ $order->order_number }}</div>
                            <div class="small text-muted">{{ $order->city }}</div>
                        </td>
                        <td>
                            @foreach($order->items as $item)
                                <div>{{ $item->product_name }} x {{ $item->quantity }}</div>
                            @endforeach
                        </td>
                        <td>Rs. {{ number_format($order->total_amount, 2) }}</td>
                        <td><span class="status-badge status-{{ $order->status }}">{{ ucfirst($order->status) }}</span></td>
                        <td>{{ optional($order->placed_at)->format('d M Y, h:i A') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center py-4 text-muted">No orders yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
