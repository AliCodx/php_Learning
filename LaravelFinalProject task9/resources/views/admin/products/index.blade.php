@extends('layouts.admin', ['title' => 'Products'])

@push('styles')
<style>
    .products-card {
        overflow: hidden;
    }

    .products-table {
        margin-bottom: 0;
        min-width: 860px;
    }

    .products-table thead th {
        border-bottom: 0;
        background: #f8fafc;
        color: #5b6474;
        font-size: .78rem;
        font-weight: 800;
        letter-spacing: .08em;
        padding: 1rem 1.25rem;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .products-table tbody td {
        border-color: #edf1f7;
        padding: 1.1rem 1.25rem;
        vertical-align: middle;
    }

    .products-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .product-cell {
        display: flex;
        align-items: center;
        gap: 1rem;
        min-width: 260px;
    }

    .product-thumb-mini {
        width: 64px;
        height: 64px;
        border-radius: 18px;
        background: linear-gradient(135deg, #eef4ff, #f9efe2);
        object-fit: cover;
        flex-shrink: 0;
        box-shadow: inset 0 0 0 1px rgba(16, 36, 63, .06);
    }

    .product-meta {
        min-width: 0;
    }

    .product-name {
        font-weight: 700;
        color: #172033;
        margin-bottom: .2rem;
    }

    .product-sku {
        color: #7a8495;
        font-size: .9rem;
        word-break: break-word;
    }

    .category-chip,
    .status-chip {
        display: inline-flex;
        align-items: center;
        border-radius: 999px;
        font-size: .82rem;
        font-weight: 700;
        padding: .42rem .8rem;
        white-space: nowrap;
    }

    .category-chip {
        background: rgba(16, 36, 63, .06);
        color: #284264;
    }

    .status-chip.active {
        background: rgba(22, 101, 52, .12);
        color: #166534;
    }

    .status-chip.inactive {
        background: rgba(185, 28, 28, .1);
        color: #b91c1c;
    }

    .featured-note {
        display: block;
        color: #dd7a22;
        font-size: .78rem;
        font-weight: 700;
        margin-top: .25rem;
        text-transform: uppercase;
        letter-spacing: .06em;
    }

    .price-tag {
        font-weight: 800;
        color: #172033;
        white-space: nowrap;
    }

    .stock-pill {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 3.25rem;
        padding: .42rem .7rem;
        border-radius: 999px;
        background: #f3f6fb;
        color: #1b3559;
        font-weight: 700;
    }

    .product-actions {
        display: flex;
        justify-content: flex-end;
        gap: .55rem;
        flex-wrap: wrap;
    }

    .product-actions form {
        margin: 0;
    }

    @media (max-width: 991px) {
        .products-table thead th,
        .products-table tbody td {
            padding: .95rem 1rem;
        }

        .product-cell {
            gap: .8rem;
        }

        .product-thumb-mini {
            width: 56px;
            height: 56px;
            border-radius: 16px;
        }
    }
</style>
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h4 mb-1">Product Catalog</h2>
        <p class="text-muted mb-0">Add, edit, and maintain storefront inventory.</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="btn btn-dark">Add Product</a>
</div>

<div class="card card-clean products-card">
    <div class="card-body table-responsive">
        <table class="table align-middle products-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>
                            <div class="product-cell">
                                <img src="{{ $product->image_url ?: asset('images/products/women-fashion.jpg') }}" alt="{{ $product->name }}" class="product-thumb-mini">
                                <div class="product-meta">
                                    <div class="product-name">{{ $product->name }}</div>
                                    <div class="product-sku">{{ $product->sku }}</div>
                                    @if($product->is_featured)
                                        <span class="featured-note">Featured product</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td><span class="category-chip">{{ $product->category->name }}</span></td>
                        <td>
                            <span class="status-chip {{ $product->is_active ? 'active' : 'inactive' }}">
                                {{ $product->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td><span class="price-tag">Rs. {{ number_format($product->price, 2) }}</span></td>
                        <td><span class="stock-pill">{{ $product->stock }}</span></td>
                        <td class="text-end">
                            <div class="product-actions">
                                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $products->links() }}
    </div>
</div>
@endsection
