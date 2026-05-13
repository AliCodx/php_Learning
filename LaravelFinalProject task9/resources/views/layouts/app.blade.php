<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }} | {{ $title ?? 'Storefront' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --brand: #0f6b5b; --brand-dark: #0b3d35; --accent: #d98934; --muted: #f4eee7; --ink: #1f2937; --surface: rgba(255,255,255,.88); --line: rgba(15,107,91,.08); --soft-shadow: 0 18px 50px rgba(31,41,55,.08); }
        body { font-family: 'Manrope', sans-serif; color: var(--ink); background:
            radial-gradient(circle at top left, rgba(217,137,52,.16), transparent 26%),
            radial-gradient(circle at top right, rgba(15,107,91,.18), transparent 24%),
            linear-gradient(180deg, #fffdf8 0%, #f3efe7 100%); }
        h1, h2, h3, h4, .display-font { font-family: 'Playfair Display', serif; }
        .navbar-brand { font-weight: 800; letter-spacing: .04em; }
        .navbar { backdrop-filter: blur(18px); background: rgba(255,255,255,.88) !important; }
        .btn-brand { background: var(--brand); color: #fff; border-color: var(--brand); }
        .btn-brand:hover { background: var(--brand-dark); color: #fff; border-color: var(--brand-dark); }
        .btn-accent { background: var(--accent); color: #fff; border-color: var(--accent); }
        .btn-accent:hover { background: #bc742a; color: #fff; border-color: #bc742a; }
        .section-card { background: var(--surface); border: 1px solid var(--line); border-radius: 28px; box-shadow: var(--soft-shadow); }
        .glass-strip { background: rgba(255,255,255,.55); border: 1px solid rgba(255,255,255,.6); box-shadow: 0 10px 30px rgba(31,41,55,.05); backdrop-filter: blur(12px); }
        .product-card { border: 0; border-radius: 28px; overflow: hidden; background: #fff; box-shadow: 0 16px 42px rgba(15,107,91,.1); height: 100%; transition: transform .25s ease, box-shadow .25s ease; }
        .product-card:hover { transform: translateY(-6px); box-shadow: 0 22px 46px rgba(15,107,91,.16); }
        .product-thumb { min-height: 240px; background: linear-gradient(135deg, #1c8f7a, #f0c088); display: flex; align-items: end; justify-content: start; padding: 1rem; color: white; font-weight: 700; background-size: cover; background-position: center; }
        .category-pill { border-radius: 999px; padding: .45rem .9rem; background: rgba(15,107,91,.08); color: var(--brand-dark); font-size: .92rem; font-weight: 700; }
        .status-badge { display: inline-flex; align-items: center; gap: .35rem; border-radius: 999px; padding: .35rem .8rem; font-size: .85rem; font-weight: 700; }
        .status-pending { background: #fff3cd; color: #7a5d00; }
        .status-processing { background: #dbeafe; color: #1d4ed8; }
        .status-shipped { background: #e0f2fe; color: #0369a1; }
        .status-delivered { background: #dcfce7; color: #166534; }
        .status-cancelled { background: #fee2e2; color: #b91c1c; }
        .footer-shell { background: var(--brand-dark); color: rgba(255,255,255,.86); }
        .metric-tile { border-radius: 24px; background: linear-gradient(160deg, rgba(255,255,255,.95), rgba(255,247,237,.88)); border: 1px solid rgba(15,107,91,.08); box-shadow: 0 12px 30px rgba(31,41,55,.06); }
        .cart-badge { min-width: 1.2rem; height: 1.2rem; display: inline-flex; align-items: center; justify-content: center; border-radius: 999px; background: var(--accent); color: #fff; font-size: .74rem; padding: 0 .32rem; }
        .trust-pill { border-radius: 999px; background: rgba(255,255,255,.18); color: #fff; padding: .55rem .85rem; border: 1px solid rgba(255,255,255,.22); }
        .spotlight-bg { background: linear-gradient(135deg, rgba(15,107,91,.08), rgba(217,137,52,.12)); }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
        <div class="container py-2">
            <a class="navbar-brand text-success" href="{{ route('home') }}">BazaarCraft PK</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('cart.index') }}">Cart <span class="cart-badge">{{ $cartCount ?? 0 }}</span></a></li>
                    @auth
                        <li class="nav-item"><a class="nav-link" href="{{ route('orders.mine') }}">My Orders</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('contact.create') }}">Contact</a></li>
                    @endauth
                    @auth
                        @if(auth()->user()->isAdmin())
                            <li class="nav-item"><a class="nav-link fw-semibold text-success" href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
                        @endif
                    @endauth
                </ul>
                <div class="d-flex gap-2 align-items-center">
                    @auth
                        <span class="small text-muted d-none d-lg-inline">{{ auth()->user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-dark btn-sm">Logout</button>
                        </form>
                    @else
                        <a class="btn btn-outline-dark btn-sm" href="{{ route('login') }}">Login</a>
                        <a class="btn btn-brand btn-sm" href="{{ route('register') }}">Signup</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <footer class="footer-shell py-5 mt-5">
        <div class="container d-flex flex-column flex-lg-row justify-content-between gap-3">
            <div>
                <h5 class="mb-2 display-font">BazaarCraft PK</h5>
                <p class="mb-2">Modern Pakistani ecommerce demo with storefront, cart checkout, admin operations, and customer management.</p>
                <p class="mb-0">We carry fashion, decor, beauty, kitchen, and mobile accessory products across multiple shopping categories.</p>
            </div>
            <div>
                <p class="mb-1 fw-semibold">Contact Details</p>
                <p class="mb-1">Phone: +92 300 1234567</p>
                <p class="mb-1">Email: support@bazaarcraft.pk</p>
                <p class="mb-0">Address: Main Boulevard, Gulberg III, Lahore, Pakistan</p>
            </div>
            <div class="text-lg-end">
                <p class="mb-1">Cash on delivery ready</p>
                <p class="mb-1">Cart, quick-buy orders, and customer-only support messaging</p>
                <p class="mb-0">Admin login shows the admin panel button directly in the header.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
