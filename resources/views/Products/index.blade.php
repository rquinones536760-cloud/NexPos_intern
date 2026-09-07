@extends('layouts.app')

@section('title', 'Products - NexPOS')
@section('page-title', 'Products')

@section('content')

<div class="nexpos-page">

    <div class="page-intro">
        <div>
            <span class="page-label">PRODUCT MANAGEMENT</span>
            <h2>Products</h2>
            <p>Manage your products, pricing, categories, and stock.</p>
        </div>

        <a href="{{ route('products.create') }}" class="primary-button">
            + Add Product
        </a>
    </div>


    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="alert-success">
            ✓ {{ session('success') }}
        </div>
    @endif


    {{-- SEARCH --}}
    <section class="dashboard-card">

        <form method="GET" action="{{ route('products.index') }}" class="table-toolbar">

            <div class="search-wrapper">
                <span class="search-icon">⌕</span>

                <input
                    type="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search products..."
                >
            </div>

            <button type="submit" class="secondary-button">
                Search
            </button>

        </form>


        {{-- PRODUCT TABLE --}}
        <div class="table-wrapper">

            <table class="nexpos-table">

                <thead>
                    <tr>
                        <th>Product</th>
                        <th>SKU</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($products as $product)

                        <tr>

                            <td>
                                <div class="table-product">
                                    <div class="table-product-icon">
                                        📦
                                    </div>

                                    <div>
                                        <strong>
                                            {{ $product->name }}
                                        </strong>

                                        <small>
                                            {{ $product->unit }}
                                        </small>
                                    </div>
                                </div>
                            </td>


                            <td>
                                <span class="sku">
                                    {{ $product->sku }}
                                </span>
                            </td>


                            <td>
                                {{ $product->category ?? 'Uncategorized' }}
                            </td>


                            <td>
                                <strong>
                                    ₱{{ number_format($product->price, 2) }}
                                </strong>
                            </td>


                            <td>

                                @if($product->stock == 0)

                                    <span class="stock-danger">
                                        Out of stock
                                    </span>

                                @elseif($product->isLowStock())

                                    <span class="stock-warning">
                                        {{ $product->stock }}
                                    </span>

                                @else

                                    <span class="stock-good">
                                        {{ $product->stock }}
                                    </span>

                                @endif

                            </td>


                            <td>

                                @if($product->is_active)

                                    <span class="status-active">
                                        Active
                                    </span>

                                @else

                                    <span class="status-inactive">
                                        Inactive
                                    </span>

                                @endif

                            </td>


                            <td>

                                <div class="table-actions">

                                    <a
                                        href="{{ route('products.edit', $product) }}"
                                        class="action-edit"
                                    >
                                        Edit
                                    </a>


                                    <form
                                        method="POST"
                                        action="{{ route('products.destroy', $product) }}"
                                        onsubmit="return confirm('Delete this product?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="action-delete"
                                        >
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="empty-table"
                            >
                                <div>
                                    📦
                                </div>

                                <strong>
                                    No products found
                                </strong>

                                <p>
                                    Add your first product to get started.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        @if($products->hasPages())

            <div class="pagination-wrapper">
                {{ $products->links() }}
            </div>

        @endif

    </section>

</div>

@endsection

