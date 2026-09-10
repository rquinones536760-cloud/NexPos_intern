@extends('layouts.app')

@section('title', 'Dashboard - NexPOS')
@section('page-title', 'Dashboard')

@section('content')

<div class="nexpos-page dashboard-page">

    {{-- PAGE INTRO --}}
    <div class="page-intro dashboard-intro">

        <div>
            <span class="page-label">OVERVIEW</span>

            <h2>
                Good morning, welcome back.
            </h2>

            <p>
                Here's what's happening with your business today.
            </p>
        </div>

        <a
            href="{{ route('pos') }}"
            class="dashboard-new-sale"
        >
            <span>＋</span>
            New Sale
        </a>

    </div>


    {{-- STAT CARDS --}}
    <div class="stats-grid">

        {{-- TOTAL PRODUCTS --}}
        <div class="stat-card stat-green">

            <div class="stat-top">

                <div class="stat-icon green">
                    +
                </div>

            </div>

            <div class="stat-content">

                <p>
                    Products
                </p>

                <h3>
                    {{ number_format($totalProducts) }}
                </h3>

            </div>

            <div class="stat-footer">

                <span>
                    Active products
                </span>

            </div>

        </div>


        {{-- LOW STOCK --}}
        <div class="stat-card stat-orange">

            <div class="stat-top">

                <div class="stat-icon orange">
                    !
                </div>

            </div>

            <div class="stat-content">

                <p>
                    Low Stock
                </p>

                <h3>
                    {{ number_format($lowStockProducts) }}
                </h3>

            </div>

            <div class="stat-footer">

                <span>
                    Needs attention
                </span>

            </div>

        </div>


        {{-- OUT OF STOCK --}}
        <div class="stat-card stat-purple">

            <div class="stat-top">

                <div class="stat-icon purple">
                    #
                </div>

            </div>

            <div class="stat-content">

                <p>
                    Out of Stock
                </p>

                <h3>
                    {{ number_format($outOfStockProducts) }}
                </h3>

            </div>

            <div class="stat-footer">

                <span>
                    Products unavailable
                </span>

            </div>

        </div>


        {{-- TODAY'S SALES --}}
        <div class="stat-card stat-blue">

            <div class="stat-top">

                <div class="stat-icon blue">
                    ₱
                </div>

            </div>

            <div class="stat-content">

                <p>
                    Today's Sales
                </p>

                <h3>
                    ₱{{ number_format($todaySales, 2) }}
                </h3>

            </div>

            <div class="stat-footer">

                <span>
                    No sales recorded yet
                </span>

            </div>

        </div>

    </div>


    {{-- DASHBOARD MAIN GRID --}}
    <div class="dashboard-grid">


        {{-- RECENT PRODUCTS --}}
        <section class="dashboard-card recent-sales-card">

            <div class="card-header">

                <div>

                    <span class="card-eyebrow">
                        INVENTORY
                    </span>

                    <h3>
                        Recent Products
                    </h3>

                    <p>
                        Recently added products to your inventory.
                    </p>

                </div>

                <a
                    href="{{ route('products.index') }}"
                    class="view-link"
                >
                    View all
                    <span>→</span>
                </a>

            </div>


            <div class="recent-sales">

                @forelse($products as $product)

                    <div class="sale-row">

                        <div class="sale-product">

                            {{-- PRODUCT IMAGE --}}
                            <div class="sale-icon product-image-small">

                                @if($product->image)

                                    <img
                                        src="{{ asset('storage/' . $product->image) }}"
                                        alt="{{ $product->name }}"
                                    >

                                @else

                                    <span>
                                        📦
                                    </span>

                                @endif

                            </div>


                            {{-- PRODUCT DETAILS --}}
                            <div class="sale-product-info">

                                <strong>
                                    {{ $product->name }}
                                </strong>

                                <span>
                                    {{ $product->category ?? 'Uncategorized' }}
                                    ·
                                    {{ $product->stock }} in stock
                                </span>

                            </div>

                        </div>


                        {{-- PRICE --}}
                        <strong class="sale-price">

                            ₱{{ number_format($product->price, 2) }}

                        </strong>

                    </div>

                @empty

                    <div class="dashboard-empty">

                        <div>
                            📦
                        </div>

                        <strong>
                            No products yet
                        </strong>

                        <span>
                            Add your first product to see it here.
                        </span>

                    </div>

                @endforelse

            </div>


            @if($products->count() > 0)

                <div class="recent-sales-footer">

                    <span>
                        Showing your latest {{ $products->count() }} products
                    </span>

                </div>

            @endif

        </section>


        {{-- INVENTORY SUMMARY --}}
        <section class="dashboard-card">

            <div class="card-header">

                <div>

                    <span class="card-eyebrow">
                        INVENTORY STATUS
                    </span>

                    <h3>
                        Stock Summary
                    </h3>

                    <p>
                        Current inventory availability.
                    </p>

                </div>

            </div>


            <div class="inventory-summary">

                {{-- IN STOCK --}}
                <div class="inventory-summary-row">

                    <div class="inventory-summary-label">

                        <span class="summary-dot summary-good"></span>

                        <span>
                            In Stock
                        </span>

                    </div>

                    <strong>
                        {{ number_format(
                            $totalProducts
                            - $lowStockProducts
                            - $outOfStockProducts
                        ) }}
                    </strong>

                </div>


                {{-- LOW STOCK --}}
                <div class="inventory-summary-row">

                    <div class="inventory-summary-label">

                        <span class="summary-dot summary-warning"></span>

                        <span>
                            Low Stock
                        </span>

                    </div>

                    <strong>
                        {{ number_format($lowStockProducts) }}
                    </strong>

                </div>


                {{-- OUT OF STOCK --}}
                <div class="inventory-summary-row">

                    <div class="inventory-summary-label">

                        <span class="summary-dot summary-danger"></span>

                        <span>
                            Out of Stock
                        </span>

                    </div>

                    <strong>
                        {{ number_format($outOfStockProducts) }}
                    </strong>

                </div>

            </div>


            <a
                href="{{ route('inventory.index') }}"
                class="inventory-summary-button"
            >
                Manage Inventory
                <span>→</span>
            </a>

        </section>

    </div>


    {{-- QUICK ACTIONS --}}
    <section class="dashboard-card quick-actions">

        <div class="card-header">

            <div>

                <span class="card-eyebrow">
                    SHORTCUTS
                </span>

                <h3>
                    Quick Actions
                </h3>

                <p>
                    Frequently used functions.
                </p>

            </div>

        </div>


        <div class="quick-grid">


            {{-- NEW SALE --}}
            <a
                href="{{ route('pos') }}"
                class="quick-action"
            >

                <span class="quick-action-icon blue">
                    ＋
                </span>

                <div>

                    <strong>
                        New Sale
                    </strong>

                    <small>
                        Start a new transaction
                    </small>

                </div>

                <span class="quick-arrow">
                    →
                </span>

            </a>


            {{-- PRODUCTS --}}
            <a
                href="{{ route('products.index') }}"
                class="quick-action"
            >

                <span class="quick-action-icon green">
                    ▦
                </span>

                <div>

                    <strong>
                        Products
                    </strong>

                    <small>
                        Manage your products
                    </small>

                </div>

                <span class="quick-arrow">
                    →
                </span>

            </a>


            {{-- REPORTS --}}
            <a
                href="{{ route('reports.index') }}"
                class="quick-action"
            >

                <span class="quick-action-icon purple">
                    ◫
                </span>

                <div>

                    <strong>
                        Reports
                    </strong>

                    <small>
                        View business reports
                    </small>

                </div>

                <span class="quick-arrow">
                    →
                </span>

            </a>

        </div>

    </section>

</div>


{{-- DASHBOARD IMAGE / SUMMARY STYLES --}}
<style>

.product-image-small {
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

.product-image-small img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.dashboard-empty {
    min-height: 180px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    gap: 6px;
}

.dashboard-empty > div {
    font-size: 32px;
    margin-bottom: 5px;
}

.dashboard-empty strong {
    color: #f8fafc;
    font-size: 14px;
}

.dashboard-empty span {
    color: #64748b;
    font-size: 12px;
}

.inventory-summary {
    display: flex;
    flex-direction: column;
    gap: 18px;
    margin-top: 10px;
}

.inventory-summary-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    padding-bottom: 16px;
    border-bottom: 1px solid rgba(148, 163, 184, 0.08);
}

.inventory-summary-row:last-child {
    padding-bottom: 0;
    border-bottom: 0;
}

.inventory-summary-label {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #cbd5e1;
    font-size: 13px;
}

.inventory-summary-row strong {
    color: #f8fafc;
    font-size: 16px;
}

.summary-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    display: inline-block;
}

.summary-good {
    background: #22c55e;
}

.summary-warning {
    background: #f59e0b;
}

.summary-danger {
    background: #ef4444;
}

.inventory-summary-button {
    margin-top: 25px;
    width: 100%;
    min-height: 44px;
    padding: 0 15px;
    box-sizing: border-box;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border: 1px solid rgba(148, 163, 184, 0.12);
    border-radius: 10px;
    background: rgba(15, 23, 42, 0.55);
    color: #cbd5e1;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    transition: 0.2s ease;
}

.inventory-summary-button:hover {
    border-color: rgba(99, 102, 241, 0.35);
    color: #fff;
    background: rgba(30, 41, 59, 0.8);
}

</style>

@endsection