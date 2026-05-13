@extends('layouts.admin', ['title' => 'Order Details'])

@section('content')
<div class="row g-4">
    <div class="col-lg-4">
        <div class="card card-clean h-100">
            <div class="card-body">
                <h2 class="h5 mb-3">Order Summary</h2>
                <p class="mb-2"><strong>Order:</strong> {{ $order->order_number }}</p>
                <p class="mb-2"><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                <p class="mb-2"><strong>Payment:</strong> {{ ucwords(str_replace('_', ' ', $order->payment_status)) }}</p>
                <p class="mb-0"><strong>Total:</strong> Rs. {{ number_format($order->total_amount, 2) }}</p>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card card-clean h-100">
            <div class="card-body">
                <h2 class="h5 mb-3">Customer</h2>
                <p class="mb-2"><strong>Name:</strong> {{ $order->user->name }}</p>
                <p class="mb-2"><strong>Email:</strong> {{ $order->user->email }}</p>
                <p class="mb-2"><strong>Phone:</strong> {{ $order->user->phone }}</p>
                <p class="mb-0"><strong>City:</strong> {{ $order->city }}</p>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card card-clean h-100">
            <div class="card-body">
                <h2 class="h5 mb-3">Delivery</h2>
                <p class="mb-2"><strong>Address:</strong> {{ $order->shipping_address }}</p>
                <p class="mb-2"><strong>Placed:</strong> {{ optional($order->placed_at)->format('d M Y, h:i A') }}</p>
                <p class="mb-0"><strong>Notes:</strong> {{ $order->notes ?: 'No notes added' }}</p>
            </div>
        </div>
    </div>
</div>

<div class="card card-clean mt-4">
    <div class="card-body">
        <h2 class="h5 mb-3">Order Items</h2>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead><tr><th>Product</th><th>Qty</th><th>Unit Price</th><th>Line Total</th></tr></thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rs. {{ number_format($item->unit_price, 2) }}</td>
                            <td>Rs. {{ number_format($item->line_total, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
