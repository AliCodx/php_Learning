<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.orders.index', [
            'orders' => Order::with(['user', 'items'])->latest('placed_at')->paginate(12),
            'statuses' => ['pending', 'processing', 'shipped', 'delivered', 'cancelled'],
        ]);
    }

    public function show(Order $order)
    {
        return view('admin.orders.show', [
            'order' => $order->load(['user', 'items.product']),
        ]);
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,processing,shipped,delivered,cancelled'],
        ]);

        $order->update($validated);

        return redirect()->route('admin.orders.index')->with('success', 'Order status updated successfully.');
    }
}
