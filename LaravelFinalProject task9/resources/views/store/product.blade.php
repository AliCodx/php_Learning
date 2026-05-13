@extends('layouts.app', ['title' => $product->name])

@section('content')
<div class="row g-4 align-items-start mb-5">
    <div class="col-lg-6">
        <div class="section-card p-3 p-lg-4">
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid rounded-5 w-100" style="max-height:560px; object-fit:cover;">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="section-card p-4 p-lg-5">
            <div class="d-flex flex-wrap gap-2 mb-3">
                <span class="category-pill">{{ $product->category->name }}</span>
                @if($product->is_featured)
                    <span class="category-pill">Featured product</span>
                @endif
            </div>
            <h1 class="display-font mt-1">{{ $product->name }}</h1>
            <p class="text-muted">{{ $product->description }}</p>
            <div class="row g-3 mb-4">
                <div class="col-sm-4"><div class="metric-tile p-3"><span class="small text-muted d-block">Price</span><strong class="fs-4">Rs. {{ number_format($product->price, 2) }}</strong></div></div>
                <div class="col-sm-4"><div class="metric-tile p-3"><span class="small text-muted d-block">Stock</span><strong class="fs-4">{{ $product->stock }}</strong></div></div>
                <div class="col-sm-4"><div class="metric-tile p-3"><span class="small text-muted d-block">SKU</span><strong class="fs-6">{{ $product->sku }}</strong></div></div>
            </div>

            @auth
                <div class="row g-3 mb-4">
                    <div class="col-md-5">
                        <form method="POST" action="{{ route('cart.add', $product) }}" class="row g-2">
                            @csrf
                            <div class="col-12">
                                <label class="form-label">Quantity for cart</label>
                                <input type="number" min="1" max="{{ $product->stock }}" name="quantity" value="1" class="form-control" required>
                            </div>
                            <div class="col-12 d-grid">
                                <button class="btn btn-brand" @disabled($product->stock < 1)>Add to Cart</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-7">
                        <div class="glass-strip rounded-4 p-3 h-100">
                            <div class="small text-uppercase text-muted mb-2">Why buy here</div>
                            <div class="fw-semibold mb-1">Fast demo checkout flow</div>
                            <p class="small text-muted mb-0">You can either add this item to the cart for a combined order or use the direct order form below for a single-product purchase.</p>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('products.buy', $product) }}" class="row g-3">
                    @csrf
                    <div class="col-md-4">
                        <label class="form-label">Quick order quantity</label>
                        <input type="number" min="1" max="{{ $product->stock }}" name="quantity" value="1" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Shipping address</label>
                        <input type="text" name="shipping_address" value="{{ old('shipping_address', auth()->user()->address) }}" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">City</label>
                        <input type="text" name="city" value="{{ old('city', auth()->user()->city) }}" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Payment</label>
                        <input type="text" class="form-control" value="Cash on Delivery" disabled>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Order notes</label>
                        <textarea name="notes" class="form-control" rows="4">{{ old('notes') }}</textarea>
                    </div>
                    <div class="col-12 d-grid">
                        <button class="btn btn-accent btn-lg" @disabled($product->stock < 1)>Place Quick Order</button>
                    </div>
                </form>
            @else
                <div class="alert alert-warning mb-0">Please <a href="{{ route('login') }}">login</a> to add this product to cart, place an order, or contact support.</div>
            @endauth
        </div>
    </div>
</div>

@if($relatedProducts->isNotEmpty())
    <section class="mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <h2 class="display-font mb-0">More from this category</h2>
            <a href="{{ route('cart.index') }}" class="btn btn-outline-dark">View Cart</a>
        </div>
        <div class="row g-4">
            @foreach($relatedProducts as $item)
                <div class="col-md-6 col-xl-3">
                    <div class="product-card">
                        <div class="product-thumb" style="background-image:url('{{ $item->image_url }}');"><span>{{ $item->category->name }}</span></div>
                        <div class="p-4">
                            <h3 class="h5">{{ $item->name }}</h3>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <strong>Rs. {{ number_format($item->price, 2) }}</strong>
                                <span class="small text-muted">{{ $item->stock }} left</span>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('products.show', $item->slug) }}" class="btn btn-outline-dark btn-sm flex-fill">View</a>
                                <form action="{{ route('cart.add', $item) }}" method="POST" class="flex-fill">
                                    @csrf
                                    <input type="hidden" name="quantity" value="1">
                                    <button class="btn btn-brand btn-sm w-100">Add</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endif
@endsection
