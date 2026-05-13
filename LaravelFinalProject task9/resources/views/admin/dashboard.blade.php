@extends('layouts.admin', ['title' => 'Dashboard'])

@section('content')
<div class="row g-4 mb-4">
    @foreach($stats as $label => $value)
        <div class="col-md-6 col-xl-3">
            <div class="card card-clean metric-card h-100">
                <div class="card-body">
                    <div class="text-uppercase small text-muted">{{ str_replace('_', ' ', $label) }}</div>
                    <div class="display-6 fw-bold">{{ in_array($label, ['sales']) ? 'Rs. ' . number_format($value, 2) : $value }}</div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="row g-4 mb-4">
    <div class="col-xl-8">
        <div class="card card-clean">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <h2 class="h5 mb-0">Sales Analytics</h2>
                    <span class="small text-muted">Last {{ $monthlySales->count() }} recorded periods</span>
                </div>
                <canvas id="salesChart" height="120"></canvas>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card card-clean h-100">
            <div class="card-body">
                <h2 class="h5 mb-3">Quick Actions</h2>
                <div class="d-grid gap-2">
                    @foreach($quickActions as $action)
                        <a href="{{ $action['route'] }}" class="btn btn-outline-dark">{{ $action['label'] }}</a>
                    @endforeach
                </div>
                <hr>
                <h3 class="h6 mb-3">Order Status Mix</h3>
                @foreach($statusBreakdown as $status => $total)
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span>{{ ucfirst($status) }}</span>
                        <strong>{{ $total }}</strong>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-xl-6">
        <div class="card card-clean h-100">
            <div class="card-body">
                <h2 class="h5 mb-3">Top Selling Products</h2>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead><tr><th>Product</th><th>Units</th><th>Revenue</th></tr></thead>
                        <tbody>
                            @foreach($topProducts as $product)
                                <tr>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->units_sold }}</td>
                                    <td>Rs. {{ number_format($product->revenue, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card card-clean h-100">
            <div class="card-body">
                <h2 class="h5 mb-3">Top Customers by Spend</h2>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead><tr><th>Customer</th><th>Orders</th><th>Total Spend</th></tr></thead>
                        <tbody>
                            @foreach($topCustomers as $customer)
                                <tr>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->orders_count }}</td>
                                    <td>Rs. {{ number_format((float) $customer->orders_sum_total_amount, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-xl-8">
        <div class="card card-clean">
            <div class="card-body">
                <h2 class="h5 mb-3">Recent Orders</h2>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead><tr><th>Order</th><th>Customer</th><th>Total</th><th>Status</th></tr></thead>
                        <tbody>
                            @foreach($recentOrders as $order)
                                <tr>
                                    <td><a href="{{ route('admin.orders.show', $order) }}">{{ $order->order_number }}</a></td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>Rs. {{ number_format($order->total_amount, 2) }}</td>
                                    <td><span class="badge text-bg-secondary">{{ ucfirst($order->status) }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card card-clean">
            <div class="card-body">
                <h2 class="h5 mb-3">Low Stock Products</h2>
                @forelse($lowStockProducts as $product)
                    <div class="border rounded-4 p-3 mb-2">
                        <div class="fw-semibold">{{ $product->name }}</div>
                        <div class="small text-muted">{{ $product->category->name }}</div>
                        <div class="small">Remaining stock: {{ $product->stock }}</div>
                    </div>
                @empty
                    <p class="text-muted mb-0">No low-stock items.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const salesLabels = @json($monthlySales->pluck('month_label'));
    const salesValues = @json($monthlySales->pluck('total_sales'));

    new Chart(document.getElementById('salesChart'), {
        type: 'line',
        data: {
            labels: salesLabels,
            datasets: [{
                label: 'Sales',
                data: salesValues,
                borderColor: '#dd7a22',
                backgroundColor: 'rgba(221, 122, 34, 0.18)',
                tension: 0.35,
                fill: true
            }]
        },
        options: {
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    ticks: {
                        callback: (value) => 'Rs. ' + value
                    }
                }
            }
        }
    });
</script>
@endpush
