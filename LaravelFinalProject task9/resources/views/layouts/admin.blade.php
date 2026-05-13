<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }} | {{ $title ?? 'Admin' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --admin-bg: #f5f7fb; --sidebar: #10243f; --sidebar-soft: #1b3559; --sidebar-text: #e6eef9; --accent: #dd7a22; }
        body { font-family: 'Manrope', sans-serif; background: var(--admin-bg); color: #172033; }
        .admin-shell { min-height: 100vh; display: grid; grid-template-columns: 280px 1fr; }
        .sidebar { background: linear-gradient(180deg, var(--sidebar), var(--sidebar-soft)); color: var(--sidebar-text); padding: 2rem 1.25rem; }
        .sidebar a { color: var(--sidebar-text); text-decoration: none; display: block; padding: .7rem .9rem; border-radius: 14px; margin-bottom: .35rem; }
        .sidebar a:hover, .sidebar a.active { background: rgba(255,255,255,.1); }
        .section-label { font-size: .78rem; letter-spacing: .12em; text-transform: uppercase; opacity: .7; margin: 1.2rem 0 .8rem; }
        .topbar { background: #fff; border-bottom: 1px solid #e5e7eb; padding: 1rem 1.75rem; }
        .content-area { padding: 1.75rem; }
        .card-clean { border: 0; border-radius: 24px; box-shadow: 0 16px 42px rgba(16,36,63,.08); }
        .metric-card { background: linear-gradient(135deg, #ffffff, #eef5ff); }
        .pagination { margin-top: 1.25rem; }
        .pagination svg {
            width: 1rem;
            height: 1rem;
        }
        .pagination .page-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .35rem;
        }
        @media (max-width: 991px) { .admin-shell { grid-template-columns: 1fr; } .sidebar { position: static; } }
    </style>
    @stack('styles')
</head>
<body>
    <div class="admin-shell">
        <aside class="sidebar">
            <a href="{{ route('home') }}" class="fw-bold fs-4 mb-4">BazaarCraft Admin</a>
            <div class="section-label">Overview</div>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
            <div class="section-label">Catalog</div>
            <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">Categories</a>
            <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">Products</a>
            <div class="section-label">Sales</div>
            <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">Orders</a>
            <div class="section-label">Administration</div>
            <a href="{{ route('admin.admins.index') }}" class="{{ request()->routeIs('admin.admins.*') ? 'active' : '' }}">Admin Users</a>
            <div class="section-label">Customers</div>
            <a href="{{ route('admin.customers.index') }}" class="{{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">Customer Records</a>
            <div class="section-label">Support</div>
            <a href="{{ route('admin.messages.index') }}" class="{{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">Contact Messages</a>
        </aside>

        <div>
            <div class="topbar d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div>
                    <div class="text-muted small">Signed in as {{ auth()->user()->name }}</div>
                    <h1 class="h4 mb-0">{{ $title ?? 'Admin Dashboard' }}</h1>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm">View Store</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-dark btn-sm">Logout</button>
                    </form>
                </div>
            </div>

            <main class="content-area">
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
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
