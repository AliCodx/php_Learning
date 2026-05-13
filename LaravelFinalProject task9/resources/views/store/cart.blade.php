@extends('layouts.app', ['title' => 'Shopping Cart'])

@section('content')
<section class="mb-4">
    <div class="section-card p-4 p-lg-5">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <p class="text-uppercase small text-muted mb-2">Basket overview</p>
                <h1 class="display-font mb-0">Your Shopping Cart</h1>
            </div>
            <a href="{{ route('home') }}" class="btn btn-outline-dark">Continue Shopping</a>
        </div>
    </div>
</section>

<div class="row g-4 align-items-start">
    <div class="col-xl-8">
        <div class="section-card p-4">
            @forelse($cartItems as $item)
                <div class="row g-3 align-items-center border-bottom py-3">
                    <div class="col-md-2">
                        <img src="{{ $item['image_url'] }}" alt="{{ $item['name'] }}" class="img-fluid rounded-4 w-100" style="height:110px; object-fit:cover;">
                    </div>
                    <div class="col-md-4">
                        <div class="small text-muted">{{ $item['category'] }}</div>
                        <h2 class="h5 mb-1">{{ $item['name'] }}</h2>
                        <div class="small text-muted">{{ $item['sku'] }}</div>
                    </div>
                    <div class="col-md-3">
                        <form action="{{ route('cart.update', $item['product_id']) }}" method="POST" class="d-flex gap-2">
                            @csrf
                            @method('PATCH')
                            <input type="number" name="quantity" min="1" max="{{ $item['stock'] }}" value="{{ $item['quantity'] }}" class="form-control">
                            <button class="btn btn-outline-dark">Update</button>
                        </form>
                    </div>
                    <div class="col-md-2 text-md-end">
                        <strong>Rs. {{ number_format($item['price'] * $item['quantity'], 2) }}</strong>
                    </div>
                    <div class="col-md-1 text-md-end">
                        <form action="{{ route('cart.remove', $item['product_id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm">X</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-5">
                    <h2 class="display-font h3 mb-3">Your cart is empty</h2>
                    <p class="text-muted mb-4">Add products from the homepage or product detail page to begin checkout.</p>
                    <a href="{{ route('home') }}" class="btn btn-brand">Browse Products</a>
                </div>
            @endforelse
        </div>
    </div>

    <div class="col-xl-4">
        <div class="section-card p-4">
            <p class="text-uppercase small text-muted mb-2">Order summary</p>
            <h2 class="display-font h3 mb-4">Checkout Panel</h2>
            <div class="d-flex justify-content-between mb-2"><span>Subtotal</span><strong>Rs. {{ number_format($subtotal, 2) }}</strong></div>
            <div class="d-flex justify-content-between mb-2"><span>Shipping</span><strong>Rs. {{ number_format($shipping, 2) }}</strong></div>
            <div class="d-flex justify-content-between border-top pt-3 mt-3 mb-4"><span>Total</span><strong class="fs-5">Rs. {{ number_format($total, 2) }}</strong></div>

            @if($cartItems->isNotEmpty())
                @auth
                    <form method="POST" action="{{ route('cart.checkout') }}" class="row g-3">
                        @csrf
                        <div class="col-12">
                            <label class="form-label">Shipping address</label>
                            <input type="text" name="shipping_address" value="{{ old('shipping_address', auth()->user()->address) }}" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">City</label>
                            <input type="text" name="city" value="{{ old('city', auth()->user()->city) }}" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Notes</label>
                            <textarea name="notes" rows="4" class="form-control">{{ old('notes') }}</textarea>
                        </div>
                        <div class="col-12 d-grid">
                            <button class="btn btn-brand btn-lg">Place Cart Order</button>
                        </div>
                    </form>
                @else
                    <div class="alert alert-warning mb-0">
                        Please <a href="{{ route('login') }}">login</a> or <a href="{{ route('register') }}">signup</a> to checkout your cart.
                    </div>
                @endauth
            @endif
        </div>
    </div>
</div>
@endsection
