@extends('layouts.app', ['title' => 'Home'])

@push('styles')
<style>
    .hero-slider { position: relative; min-height: 76vh; border-radius: 36px; overflow: hidden; box-shadow: 0 30px 80px rgba(11,61,53,.2); }
    .hero-slide { position: absolute; inset: 0; opacity: 0; transition: opacity .8s ease; background-size: cover; background-position: center; }
    .hero-slide.active { opacity: 1; }
    .hero-overlay { position: absolute; inset: 0; background: linear-gradient(90deg, rgba(11,61,53,.85), rgba(11,61,53,.25)); }
    .hero-content { position: relative; z-index: 2; color: #fff; padding: 4rem 3rem; max-width: 720px; }
    .slider-dots { position: absolute; bottom: 24px; left: 48px; z-index: 3; display: flex; gap: .6rem; }
    .slider-dot { width: 14px; height: 14px; border-radius: 50%; border: 0; background: rgba(255,255,255,.45); }
    .slider-dot.active { background: #fff; transform: scale(1.15); }
    .hero-metrics { position: absolute; right: 28px; bottom: 28px; z-index: 4; max-width: 420px; }
    .arrival-card { border-radius: 28px; background: linear-gradient(145deg, rgba(255,255,255,.97), rgba(243,247,244,.92)); }
</style>
@endpush

@section('content')
<section class="hero-slider mb-5">
    @php
        $slides = [
            ['image' => asset('images/slides/slide-1.svg'), 'title' => 'Pakistani style, modern storefront rhythm', 'copy' => 'Curated home living, fashion accessories, beauty picks, and gifting items arranged like a real ecommerce landing page.'],
            ['image' => asset('images/slides/slide-2.svg'), 'title' => 'Featured deals with bold visual storytelling', 'copy' => 'Large-format hero backgrounds, clear calls to action, and product discovery blocks built for an ecommerce first impression.'],
            ['image' => asset('images/slides/slide-3.svg'), 'title' => 'Admin-ready catalog and order operations', 'copy' => 'Behind the storefront sits a practical admin hierarchy for catalog, sales, customers, and support workflows.'],
        ];
    @endphp

    @foreach($slides as $index => $slide)
        <div class="hero-slide {{ $index === 0 ? 'active' : '' }}" style="background-image:url('{{ $slide['image'] }}')" data-slide>
            <div class="hero-overlay"></div>
        </div>
    @endforeach

    <div class="hero-content">
        <div class="d-flex flex-wrap gap-2 mb-3">
            <span class="trust-pill">Cash on delivery</span>
            <span class="trust-pill">Cart checkout</span>
            <span class="trust-pill">Admin managed</span>
        </div>
        <p class="text-uppercase small fw-bold text-warning">Laravel Ecommerce Experience</p>
        <h1 class="display-3 mb-3">A sharper storefront with cart flow, rich visuals, and admin-ready ecommerce structure.</h1>
        <p class="lead mb-4">Browse curated catalog sections, add products to cart, place quick orders, and explore a storefront designed to feel more premium and alive.</p>
        <div class="d-flex gap-3 flex-wrap">
            <a href="#featured-products" class="btn btn-accent btn-lg">Shop Featured</a>
            <a href="{{ route('cart.index') }}" class="btn btn-outline-light btn-lg">Open Cart</a>
        </div>
    </div>

    <div class="hero-metrics glass-strip rounded-5 p-4 d-none d-lg-block">
        <div class="row g-3">
            <div class="col-6">
                <div class="metric-tile p-3 h-100">
                    <div class="small text-muted text-uppercase">Products</div>
                    <div class="fs-3 fw-bold">{{ $storeStats['products'] }}</div>
                </div>
            </div>
            <div class="col-6">
                <div class="metric-tile p-3 h-100">
                    <div class="small text-muted text-uppercase">Customers</div>
                    <div class="fs-3 fw-bold">{{ $storeStats['customers'] }}</div>
                </div>
            </div>
            <div class="col-6">
                <div class="metric-tile p-3 h-100">
                    <div class="small text-muted text-uppercase">Categories</div>
                    <div class="fs-3 fw-bold">{{ $storeStats['categories'] }}</div>
                </div>
            </div>
            <div class="col-6">
                <div class="metric-tile p-3 h-100">
                    <div class="small text-muted text-uppercase">Featured</div>
                    <div class="fs-3 fw-bold">{{ $storeStats['featured'] }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="slider-dots">
        @foreach($slides as $index => $slide)
            <button type="button" class="slider-dot {{ $index === 0 ? 'active' : '' }}" data-dot></button>
        @endforeach
    </div>
</section>

<section class="row g-4 mb-5">
    <div class="col-lg-8">
        <div class="section-card spotlight-bg p-4 h-100">
            <p class="text-uppercase small text-muted mb-2">Shop by category</p>
            <h2 class="display-font mb-4">Popular aisles for your storefront</h2>
            <div class="row g-3">
                @foreach($categories as $category)
                    <div class="col-md-6">
                        <div class="glass-strip rounded-4 p-3 h-100 d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-semibold">{{ $category->name }}</div>
                                <div class="small text-muted">{{ $category->products_count }} active products</div>
                            </div>
                            <span class="category-pill">Featured aisle</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="section-card p-4 h-100">
            <p class="text-uppercase small text-muted mb-2">Recent order pulse</p>
            <h2 class="display-font mb-4">Fresh activity</h2>
            @foreach($latestOrders as $order)
                <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                    <div>
                        <div class="fw-semibold">{{ $order->order_number }}</div>
                        <div class="small text-muted">{{ $order->user->name }}</div>
                    </div>
                    <span class="status-badge status-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <p class="text-uppercase small text-muted mb-2">New arrivals</p>
            <h2 class="display-font mb-0">Latest additions to the catalog</h2>
        </div>
        <span class="text-muted">Designed to feel closer to a real storefront landing page</span>
    </div>
    <div class="row g-4">
        @foreach($newArrivals as $product)
            <div class="col-md-6 col-xl-3">
                <div class="arrival-card section-card p-3 h-100">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid rounded-4 w-100 mb-3" style="height:220px; object-fit:cover;">
                    <div class="small text-muted">{{ $product->category->name }}</div>
                    <h3 class="h5 mt-2">{{ $product->name }}</h3>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <strong>Rs. {{ number_format($product->price, 2) }}</strong>
                        <a href="{{ route('products.show', $product->slug) }}" class="btn btn-outline-dark btn-sm">Discover</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

<section class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <p class="text-uppercase small text-muted mb-2">Product categories</p>
            <h2 class="display-font mb-0">See what kinds of products we sell</h2>
        </div>
        <span class="text-muted">Each section below highlights a different product type.</span>
    </div>

    @foreach($categorySections as $category)
        @if($category->products->isNotEmpty())
            <div class="section-card p-4 p-lg-5 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                    <div>
                        <div class="small text-uppercase text-muted">{{ $category->products_count ?? $category->products->count() }} products</div>
                        <h3 class="display-font mb-1">{{ $category->name }}</h3>
                        <p class="text-muted mb-0">{{ $category->description }}</p>
                    </div>
                    <span class="category-pill">Category Collection</span>
                </div>
                <div class="row g-4">
                    @foreach($category->products as $product)
                        <div class="col-md-6 col-xl-3">
                            <div class="product-card">
                                <div class="product-thumb" style="background-image:url('{{ $product->image_url }}');">
                                    <span class="badge bg-light text-dark">{{ $category->name }}</span>
                                </div>
                                <div class="p-4">
                                    <h4 class="h5">{{ $product->name }}</h4>
                                    <p class="small text-muted">{{ \Illuminate\Support\Str::limit($product->description, 75) }}</p>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <strong>Rs. {{ number_format($product->price, 2) }}</strong>
                                        <span class="small text-muted">{{ $product->stock }} stock</span>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('products.show', $product->slug) }}" class="btn btn-outline-dark btn-sm flex-fill">View</a>
                                        <form action="{{ route('cart.add', $product) }}" method="POST" class="flex-fill">
                                            @csrf
                                            <input type="hidden" name="quantity" value="1">
                                            <button class="btn btn-brand btn-sm w-100" @disabled($product->stock < 1)>Add</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach
</section>

<section id="featured-products">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <p class="text-uppercase small text-muted mb-2">Featured products</p>
            <h2 class="display-font mb-0">Store-ready product grid</h2>
        </div>
        <span class="text-muted">Add to cart or go directly to product detail</span>
    </div>

    <div class="row g-4">
        @foreach($featuredProducts as $product)
            <div class="col-md-6 col-xl-3">
                <div class="product-card">
                    <div class="product-thumb" style="background-image:url('{{ $product->image_url }}');">
                        <span class="badge bg-light text-dark">{{ $product->category->name }}</span>
                    </div>
                    <div class="p-4">
                        <div class="small text-muted mb-2">{{ $product->sku }}</div>
                        <h3 class="h5">{{ $product->name }}</h3>
                        <p class="text-muted small">{{ \Illuminate\Support\Str::limit($product->description, 90) }}</p>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <strong>Rs. {{ number_format($product->price, 2) }}</strong>
                            <span class="small text-muted">{{ $product->stock }} in stock</span>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('products.show', $product->slug) }}" class="btn btn-outline-dark btn-sm flex-fill">View</a>
                            <form action="{{ route('cart.add', $product) }}" method="POST" class="flex-fill">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button class="btn btn-brand btn-sm w-100" @disabled($product->stock < 1)>Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endsection

@push('scripts')
<script>
    const slides = document.querySelectorAll('[data-slide]');
    const dots = document.querySelectorAll('[data-dot]');
    let currentSlide = 0;

    function setSlide(index) {
        slides.forEach((slide, i) => slide.classList.toggle('active', i === index));
        dots.forEach((dot, i) => dot.classList.toggle('active', i === index));
        currentSlide = index;
    }

    dots.forEach((dot, index) => dot.addEventListener('click', () => setSlide(index)));

    if (slides.length > 1) {
        setInterval(() => setSlide((currentSlide + 1) % slides.length), 4500);
    }
</script>
@endpush
