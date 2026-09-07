@extends('layouts.app')

@section('title', 'Inventory - NexPOS')
@section('page-title', 'Inventory')

@section('content')

<div class="nexpos-page">


    <div class="page-intro">

        <div>
            <span class="page-label">STOCK CONTROL</span>
            <h2>Inventory</h2>
            <p>Monitor your stock levels and inventory value.</p>
        </div>

        <a
            href="{{ route('products.create') }}"
            class="primary-button"
        >
            + Add Product
        </a>

    </div>


    @if(session('success'))

        <div class="alert-success">
            ✓ {{ session('success') }}
        </div>

    @endif


    {{-- INVENTORY STATS --}}

    <div class="stats-grid">


        <div class="stat-card">

            <div class="stat-top">

                <div class="stat-icon blue">
                    #
                </div>

            </div>

            <p>Total Products</p>

            <h3>
                {{ number_format($totalProducts) }}
            </h3>

        </div>


        <div class="stat-card">

            <div class="stat-top">

                <div class="stat-icon green">
                    +
                </div>

            </div>

            <p>Total Stock</p>

            <h3>
                {{ number_format($totalStock) }}
            </h3>

        </div>


        <div class="stat-card">

            <div class="stat-top">

                <div class="stat-icon orange">
                    !
                </div>

            </div>

            <p>Low Stock</p>

            <h3>
                {{ number_format($lowStock) }}
            </h3>

        </div>


        <div class="stat-card">

            <div class="stat-top">

                <div class="stat-icon purple">
                    ×
                </div>

            </div>

            <p>Out of Stock</p>

            <h3>
                {{ number_format($outOfStock) }}
            </h3>

        </div>

    </div>


    {{-- INVENTORY TABLE --}}

    <section class="dashboard-card">

        <div class="card-header">

            <div>

                <h3>
                    Stock Overview
                </h3>

                <p>
                    Current product inventory
                </p>

            </div>

        </div>


        <form
            method="GET"
            action="{{ route('inventory.index') }}"
            class="table-toolbar"
        >

            <div class="search-wrapper">

                <span class="search-icon">
                    ⌕
                </span>

                <input
                    type="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search product or SKU..."
                >

            </div>

            <button
                type="submit"
                class="secondary-button"
            >
                Search
            </button>

        </form>


        <div class="table-wrapper">

            <table class="nexpos-table">

                <thead>

                    <tr>
                        <th>Product</th>
                        <th>SKU</th>
                        <th>Price</th>
                        <th>Current Stock</th>
                        <th>Stock Status</th>
                        <th>Update</th>
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
                                            {{ $product->category ?? 'No category' }}
                                        </small>

                                    </div>

                                </div>

                            </td>


                            <td>
                                {{ $product->sku }}
                            </td>


                            <td>
                                ₱{{ number_format($product->price, 2) }}
                            </td>


                            <td>

                                <strong
                                    class="
                                        {{ $product->stock == 0
                                            ? 'text-danger'
                                            : ($product->isLowStock()
                                                ? 'text-warning'
                                                : 'text-success') }}
                                    "
                                >
                                    {{ number_format($product->stock) }}
                                </strong>

                                {{ $product->unit }}

                            </td>


                            <td>

                                @if($product->stock == 0)

                                    <span class="stock-danger">
                                        Out of Stock
                                    </span>

                                @elseif($product->isLowStock())

                                    <span class="stock-warning">
                                        Low Stock
                                    </span>

                                @else

                                    <span class="stock-good">
                                        In Stock
                                    </span>

                                @endif

                            </td>


                            <td>

                                <form
                                    method="POST"
                                    action="{{ route('inventory.stock', $product) }}"
                                    class="stock-form"
                                >

                                    @csrf
                                    @method('PATCH')

                                    <input
                                        type="number"
                                        name="quantity"
                                        value="{{ $product->stock }}"
                                        min="0"
                                    >

                                    <button
                                        type="submit"
                                        class="action-edit"
                                    >
                                        Update
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="empty-table"
                            >

                                <div>
                                    📦
                                </div>

                                <strong>
                                    No inventory found
                                </strong>

                                <p>
                                    Add products to start managing inventory.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        @if($products->hasPages())

            <div class="pagination-wrapper">
                {{ $products->links() }}
            </div>

        @endif

    </section>

</div>

@endsection
