@extends('layouts.admin', ['title' => 'Create Product'])

@push('styles')
<style>
    .product-editor-shell {
        display: grid;
        grid-template-columns: minmax(0, 1.75fr) minmax(280px, .95fr);
        gap: 1.5rem;
    }

    .editor-card,
    .preview-card {
        border: 0;
        border-radius: 28px;
        box-shadow: 0 16px 42px rgba(16, 36, 63, .08);
    }

    .editor-card .card-body,
    .preview-card .card-body {
        padding: 1.75rem;
    }

    .editor-intro {
        margin-bottom: 1.5rem;
    }

    .editor-intro p,
    .panel-copy {
        color: #6b7280;
        margin-bottom: 0;
    }

    .field-panel {
        border: 1px solid #e9edf5;
        border-radius: 22px;
        padding: 1.25rem;
        background: linear-gradient(180deg, #ffffff, #fbfcfe);
    }

    .field-panel + .field-panel {
        margin-top: 1rem;
    }

    .panel-title {
        font-size: 1rem;
        font-weight: 800;
        color: #172033;
        margin-bottom: .25rem;
    }

    .field-label {
        color: #31425d;
        font-weight: 700;
        margin-bottom: .45rem;
    }

    .field-control {
        border-radius: 16px;
        border-color: #dbe3ef;
        padding: .8rem .95rem;
    }

    .field-control:focus {
        border-color: #dd7a22;
        box-shadow: 0 0 0 .2rem rgba(221, 122, 34, .14);
    }

    .toggle-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: .9rem;
    }

    .toggle-card {
        display: flex;
        gap: .85rem;
        align-items: flex-start;
        border: 1px solid #e7ebf3;
        border-radius: 20px;
        padding: 1rem;
        background: #fff;
    }

    .toggle-card .form-check-input {
        float: none;
        margin: .25rem 0 0;
    }

    .toggle-card .form-check-label {
        font-weight: 700;
        color: #172033;
    }

    .toggle-card p {
        color: #6b7280;
        font-size: .92rem;
        margin: .2rem 0 0;
    }

    .preview-card {
        background: linear-gradient(180deg, #132844, #1d3b62);
        color: #eef4ff;
        position: sticky;
        top: 1.25rem;
    }

    .preview-eyebrow {
        font-size: .78rem;
        font-weight: 800;
        letter-spacing: .08em;
        opacity: .78;
        text-transform: uppercase;
    }

    .preview-image {
        width: 100%;
        height: 220px;
        border-radius: 22px;
        object-fit: cover;
        background: rgba(255, 255, 255, .08);
        border: 1px solid rgba(255, 255, 255, .1);
        margin: 1rem 0 1.25rem;
    }

    .preview-meta {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: .75rem;
        margin-top: 1.25rem;
    }

    .preview-metric {
        background: rgba(255, 255, 255, .08);
        border: 1px solid rgba(255, 255, 255, .08);
        border-radius: 18px;
        padding: .9rem 1rem;
    }

    .preview-metric span {
        display: block;
        font-size: .78rem;
        letter-spacing: .05em;
        opacity: .7;
        text-transform: uppercase;
    }

    .preview-metric strong {
        display: block;
        font-size: 1rem;
        margin-top: .2rem;
    }

    .preview-badge {
        display: inline-flex;
        align-items: center;
        border-radius: 999px;
        padding: .45rem .8rem;
        background: rgba(255, 255, 255, .12);
        font-size: .82rem;
        font-weight: 700;
    }

    .editor-actions {
        display: flex;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
        margin-top: 1.5rem;
    }

    @media (max-width: 991px) {
        .product-editor-shell {
            grid-template-columns: 1fr;
        }

        .preview-card {
            position: static;
        }
    }

    @media (max-width: 575px) {
        .toggle-grid,
        .preview-meta,
        .editor-actions {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h2 class="h4 mb-1">Add Product</h2>
        <p class="text-muted mb-0">Create a polished catalog entry with storefront-ready details.</p>
    </div>
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Back to Products</a>
</div>

<form method="POST" action="{{ route('admin.products.store') }}">
    @csrf

    <div class="product-editor-shell">
        <div class="card editor-card">
            <div class="card-body">
                <div class="editor-intro">
                    <h3 class="h5 mb-2">Product Details</h3>
                    <p>Fill in the core product information first, then fine-tune visibility and merchandising options.</p>
                </div>

                <div class="field-panel">
                    <div class="panel-title">Catalog Placement</div>
                    <p class="panel-copy mb-3">Choose where this item belongs and how customers will identify it.</p>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label field-label">Category</label>
                            <select name="category_id" class="form-select field-control" required>
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label field-label">Product Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control field-control" required>
                        </div>
                    </div>
                </div>

                <div class="field-panel">
                    <div class="panel-title">Pricing and Inventory</div>
                    <p class="panel-copy mb-3">Set the sell price and available stock before publishing the product.</p>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label field-label">Price</label>
                            <input type="number" step="0.01" min="1" name="price" value="{{ old('price') }}" class="form-control field-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label field-label">Stock</label>
                            <input type="number" min="0" name="stock" value="{{ old('stock') }}" class="form-control field-control" required>
                        </div>
                    </div>
                </div>

                <div class="field-panel">
                    <div class="panel-title">Media and Description</div>
                    <p class="panel-copy mb-3">Use a local image path or hosted image URL, then add a clear product summary.</p>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label field-label">Image URL</label>
                            <input type="text" name="image_url" value="{{ old('image_url') }}" class="form-control field-control" placeholder="/images/products/women-fashion.jpg">
                            <div class="form-text">You can use local paths like <code>/images/products/women-fashion.jpg</code>.</div>
                        </div>
                        <div class="col-12">
                            <label class="form-label field-label">Description</label>
                            <textarea name="description" rows="6" class="form-control field-control">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="field-panel">
                    <div class="panel-title">Visibility</div>
                    <p class="panel-copy mb-3">Control whether this product appears on the homepage and storefront.</p>
                    <div class="toggle-grid">
                        <label class="toggle-card">
                            <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="featured" @checked(old('is_featured'))>
                            <span>
                                <span class="form-check-label">Feature on homepage</span>
                                <p>Highlight this item in featured merchandising areas.</p>
                            </span>
                        </label>
                        <label class="toggle-card">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="active" @checked(old('is_active', true))>
                            <span>
                                <span class="form-check-label">Available for sale</span>
                                <p>Allow customers to discover and purchase this product.</p>
                            </span>
                        </label>
                    </div>
                </div>

                <div class="editor-actions">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    <button class="btn btn-dark px-4">Save Product</button>
                </div>
            </div>
        </div>

        <aside class="card preview-card">
            <div class="card-body">
                <div class="preview-eyebrow">Live Summary</div>
                <h3 class="h4 mt-2 mb-2">{{ old('name', 'New product draft') }}</h3>
                <p class="mb-0 opacity-75">{{ old('description', 'Your product description will appear here once you add it to the form.') }}</p>

                <img
                    src="{{ old('image_url', asset('images/products/women-fashion.jpg')) }}"
                    alt="Product preview"
                    class="preview-image"
                >

                <span class="preview-badge">{{ old('category_id') ? $categories->firstWhere('id', (int) old('category_id'))?->name : 'Category not selected' }}</span>

                <div class="preview-meta">
                    <div class="preview-metric">
                        <span>Price</span>
                        <strong>{{ old('price') ? 'Rs. ' . number_format((float) old('price'), 2) : 'Not set' }}</strong>
                    </div>
                    <div class="preview-metric">
                        <span>Stock</span>
                        <strong>{{ old('stock', 'Not set') }}</strong>
                    </div>
                    <div class="preview-metric">
                        <span>Featured</span>
                        <strong>{{ old('is_featured') ? 'Yes' : 'No' }}</strong>
                    </div>
                    <div class="preview-metric">
                        <span>Status</span>
                        <strong>{{ old('is_active', true) ? 'Active' : 'Inactive' }}</strong>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</form>
@endsection
