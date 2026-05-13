<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    public function index()
    {
        return view('admin.customers.index');
    }

    public function data()
    {
        $query = User::query()
            ->where('role', 'customer')
            ->withCount('orders')
            ->withSum('orders', 'total_amount');

        return DataTables::eloquent($query)
            ->addColumn('status_badge', fn (User $user) => $user->is_active ? 'Active' : 'Inactive')
            ->editColumn('orders_sum_total_amount', fn (User $user) => 'Rs. ' . number_format((float) ($user->orders_sum_total_amount ?? 0), 2))
            ->editColumn('created_at', fn (User $user) => $user->created_at->format('d M Y'))
            ->toJson();
    }
}
