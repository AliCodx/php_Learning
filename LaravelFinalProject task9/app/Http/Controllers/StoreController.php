<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    public function home()
    {
        $featuredProducts = Product::with('category')
            ->where('is_active', true)
            ->where('is_featured', true)
            ->latest()
            ->take(8)
            ->get();

        return view('store.home', [
            'featuredProducts' => $featuredProducts,
            'newArrivals' => Product::with('category')
                ->where('is_active', true)
                ->latest()
                ->take(4)
                ->get(),
            'categories' => Category::where('is_active', true)
                ->withCount(['products' => fn ($query) => $query->where('is_active', true)])
                ->orderBy('name')
                ->get(),
            'categorySections' => Category::where('is_active', true)
                ->with(['products' => fn ($query) => $query->where('is_active', true)->latest()->take(4)])
                ->orderBy('name')
                ->get(),
            'latestOrders' => Order::with('user')
                ->latest('placed_at')
                ->take(6)
                ->get(),
            'storeStats' => [
                'featured' => $featuredProducts->count(),
                'categories' => Category::where('is_active', true)->count(),
                'products' => Product::where('is_active', true)->count(),
                'customers' => User::where('role', 'customer')->count(),
            ],
        ]);
    }

    public function show(Product $product)
    {
        abort_unless($product->is_active, 404);

        return view('store.product', [
            'product' => $product->load('category'),
            'relatedProducts' => Product::with('category')
                ->where('category_id', $product->category_id)
                ->where('id', '!=', $product->id)
                ->where('is_active', true)
                ->take(4)
                ->get(),
        ]);
    }

    public function buyNow(Request $request, Product $product)
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
            'shipping_address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:120'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        if (! $product->is_active || $product->stock < $validated['quantity']) {
            return back()->withErrors([
                'quantity' => 'This product does not have enough stock for the requested quantity.',
            ]);
        }

        $this->createOrder(
            $request->user(),
            [[
                'product' => $product,
                'quantity' => $validated['quantity'],
            ]],
            $validated['shipping_address'],
            $validated['city'],
            $validated['notes'] ?? null,
        );

        return redirect()->route('orders.mine')->with('success', 'Your order has been placed successfully.');
    }

    public function cart()
    {
        $cart = collect(session('cart', []));
        $subtotal = $cart->sum(fn ($item) => $item['price'] * $item['quantity']);
        $shipping = $cart->isEmpty() ? 0 : 250;

        return view('store.cart', [
            'cartItems' => $cart,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $subtotal + $shipping,
        ]);
    }

    public function addToCart(Request $request, Product $product)
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        if (! $product->is_active || $product->stock < $validated['quantity']) {
            return back()->withErrors([
                'quantity' => 'This product is unavailable in that quantity.',
            ]);
        }

        $cart = session('cart', []);
        $existingQuantity = $cart[$product->id]['quantity'] ?? 0;
        $newQuantity = $existingQuantity + $validated['quantity'];

        if ($product->stock < $newQuantity) {
            return back()->withErrors([
                'quantity' => 'Requested quantity exceeds available stock.',
            ]);
        }

        $cart[$product->id] = [
            'product_id' => $product->id,
            'name' => $product->name,
            'slug' => $product->slug,
            'sku' => $product->sku,
            'price' => (float) $product->price,
            'quantity' => $newQuantity,
            'stock' => $product->stock,
            'image_url' => $product->image_url,
            'category' => $product->category->name,
        ];

        session(['cart' => $cart]);

        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully.');
    }

    public function updateCart(Request $request, Product $product)
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $cart = session('cart', []);

        if (! isset($cart[$product->id])) {
            return redirect()->route('cart.index');
        }

        if ($product->stock < $validated['quantity']) {
            return back()->withErrors([
                'quantity' => 'Requested quantity exceeds available stock.',
            ]);
        }

        $cart[$product->id]['quantity'] = $validated['quantity'];
        session(['cart' => $cart]);

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully.');
    }

    public function removeFromCart(Product $product)
    {
        $cart = session('cart', []);
        unset($cart[$product->id]);
        session(['cart' => $cart]);

        return redirect()->route('cart.index')->with('success', 'Product removed from cart.');
    }

    public function checkoutCart(Request $request)
    {
        $validated = $request->validate([
            'shipping_address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:120'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $cartItems = collect(session('cart', []));

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->withErrors([
                'cart' => 'Your cart is empty.',
            ]);
        }

        $invalidItem = $cartItems->first(function ($item) {
            $product = Product::find($item['product_id']);

            return ! $product || ! $product->is_active || $product->stock < $item['quantity'];
        });

        if ($invalidItem) {
            return redirect()->route('cart.index')->withErrors([
                'cart' => 'One or more cart products are no longer available in the selected quantity.',
            ]);
        }

        $items = $cartItems->map(function ($item) {
            $product = Product::findOrFail($item['product_id']);
            return [
                'product' => $product,
                'quantity' => $item['quantity'],
            ];
        })->values()->all();

        $this->createOrder(
            $request->user(),
            $items,
            $validated['shipping_address'],
            $validated['city'],
            $validated['notes'] ?? null,
        );

        session()->forget('cart');

        return redirect()->route('orders.mine')->with('success', 'Cart checked out successfully and order placed.');
    }

    public function orders(Request $request)
    {
        return view('store.orders', [
            'orders' => $request->user()
                ->orders()
                ->with('items.product')
                ->latest('placed_at')
                ->get(),
        ]);
    }

    private function createOrder($user, array $items, string $shippingAddress, string $city, ?string $notes): void
    {
        DB::transaction(function () use ($user, $items, $shippingAddress, $city, $notes): void {
            $subtotal = collect($items)->sum(fn ($item) => $item['product']->price * $item['quantity']);
            $shipping = 250;

            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => 'ORD-' . now()->format('Ymd') . '-' . Str::upper(Str::random(6)),
                'subtotal' => $subtotal,
                'shipping_amount' => $shipping,
                'total_amount' => $subtotal + $shipping,
                'status' => 'pending',
                'payment_status' => 'cash_on_delivery',
                'shipping_address' => $shippingAddress,
                'city' => $city,
                'notes' => $notes,
                'placed_at' => now(),
            ]);

            foreach ($items as $item) {
                $product = $item['product'];
                $quantity = $item['quantity'];
                $lineTotal = $product->price * $quantity;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'quantity' => $quantity,
                    'unit_price' => $product->price,
                    'line_total' => $lineTotal,
                ]);

                $product->decrement('stock', $quantity);
            }
        });
    }
}
