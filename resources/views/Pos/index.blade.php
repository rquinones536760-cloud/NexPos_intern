@extends('layouts.app')

@section('title', 'Point of Sale - NexPOS')
@section('page-title', 'Point of Sale')

@section('content')

@php

    $products = [

        [
            'name' => 'Laptop Pro',
            'price' => 42999,
            'category' => 'electronics',
            'icon' => '💻',
            'stock' => 12
        ],

        [
            'name' => 'Wireless Headset',
            'price' => 2499,
            'category' => 'accessories',
            'icon' => '🎧',
            'stock' => 24
        ],

        [
            'name' => 'Mechanical Keyboard',
            'price' => 3299,
            'category' => 'accessories',
            'icon' => '⌨️',
            'stock' => 18
        ],

        [
            'name' => 'Gaming Mouse',
            'price' => 1799,
            'category' => 'accessories',
            'icon' => '🖱️',
            'stock' => 31
        ],

        [
            'name' => 'Smartphone',
            'price' => 18999,
            'category' => 'electronics',
            'icon' => '📱',
            'stock' => 8
        ],

        [
            'name' => '24" Monitor',
            'price' => 9499,
            'category' => 'electronics',
            'icon' => '🖥️',
            'stock' => 15
        ],

        [
            'name' => 'Office Chair',
            'price' => 5499,
            'category' => 'office',
            'icon' => '🪑',
            'stock' => 9
        ],

        [
            'name' => 'USB Flash Drive',
            'price' => 599,
            'category' => 'accessories',
            'icon' => '💾',
            'stock' => 42
        ],

        [
            'name' => 'Printer',
            'price' => 7999,
            'category' => 'office',
            'icon' => '🖨️',
            'stock' => 6
        ],

    ];

@endphp


<div class="nexpos-page">


    {{-- =====================================================
         PAGE INTRO
    ====================================================== --}}

    <div class="page-intro pos-intro">

        <div>

            <span class="page-label">
                CHECKOUT
            </span>

            <h2>
                Create a New Sale
            </h2>

            <p>
                Select a product to add it to the current transaction.
            </p>

        </div>


        <div class="register-status">

            <span>
                Register #01
            </span>

            <span class="open-status">

                <i></i>

                Open

            </span>

        </div>

    </div>


    {{-- =====================================================
         POS CONTAINER
    ====================================================== --}}

    <div class="pos-container">


        {{-- =================================================
             SEARCH TOOLBAR
        ================================================== --}}

        <div class="pos-toolbar">

            <div class="search-wrapper">

                <span class="search-icon">
                    ⌕
                </span>

                <input
                    id="productSearch"
                    type="search"
                    placeholder="Search products..."
                    autocomplete="off"
                >

            </div>


            <button
                type="button"
                class="secondary-button"
                id="scanButton"
            >

                <span>
                    ▦
                </span>

                Scan Barcode

            </button>

        </div>


        {{-- =================================================
             CATEGORIES
        ================================================== --}}

        <div class="categories">

            <button
                type="button"
                class="category-btn active"
                data-category="all"
            >
                All Products
            </button>


            <button
                type="button"
                class="category-btn"
                data-category="electronics"
            >
                Electronics
            </button>


            <button
                type="button"
                class="category-btn"
                data-category="accessories"
            >
                Accessories
            </button>


            <button
                type="button"
                class="category-btn"
                data-category="office"
            >
                Office
            </button>

        </div>


        {{-- =================================================
             POS BODY
        ================================================== --}}

        <div class="pos-body">


            {{-- =================================================
                 PRODUCTS
            ================================================== --}}

            <section class="products-area">

                <div class="section-header">

                    <div>

                        <h3>
                            Products
                        </h3>

                        <p>
                            Click a product to add it to the cart.
                        </p>

                    </div>


                    <span id="productCount">
                        {{ count($products) }} products
                    </span>

                </div>


                <div
                    id="productGrid"
                    class="product-grid"
                >

                    @foreach ($products as $product)

                        <button
                            type="button"
                            class="product-card"

                            data-name="{{ $product['name'] }}"
                            data-price="{{ $product['price'] }}"
                            data-category="{{ $product['category'] }}"
                            data-stock="{{ $product['stock'] }}"
                        >

                            <div class="product-image">
                                {{ $product['icon'] }}
                            </div>


                            <div class="product-details">

                                <strong>
                                    {{ $product['name'] }}
                                </strong>


                                <div class="product-bottom">

                                    <span class="product-price">

                                        ₱{{ number_format(
                                            $product['price'],
                                            2
                                        ) }}

                                    </span>


                                    <small>
                                        {{ $product['stock'] }}
                                        in stock
                                    </small>

                                </div>

                            </div>

                        </button>

                    @endforeach

                </div>


                {{-- No products --}}
                <div
                    id="noProducts"
                    class="no-products"
                    hidden
                >

                    <div>
                        ⌕
                    </div>

                    <strong>
                        No products found
                    </strong>

                    <p>
                        Try another search or category.
                    </p>

                </div>

            </section>


            {{-- =================================================
                 CART
            ================================================== --}}

            <aside class="cart-area">


                {{-- Cart Header --}}
                <div class="cart-header">

                    <div>

                        <span>
                            CURRENT ORDER
                        </span>

                        <h3>
                            Cart
                        </h3>

                    </div>


                    <span
                        id="cartCount"
                        class="cart-count"
                    >
                        0 Items
                    </span>

                </div>


                {{-- Cart Items --}}
                <div
                    id="cartItems"
                    class="cart-items"
                >

                    <div
                        id="emptyCart"
                        class="empty-cart"
                    >

                        <div>
                            🛒
                        </div>

                        <strong>
                            Your cart is empty
                        </strong>

                        <p>
                            Select a product to begin a sale.
                        </p>

                    </div>

                </div>


                {{-- Totals --}}
                <div class="cart-totals">

                    <div>

                        <span>
                            Subtotal
                        </span>

                        <strong id="subtotal">
                            ₱0.00
                        </strong>

                    </div>


                    <div>

                        <span>
                            Tax (12%)
                        </span>

                        <strong id="tax">
                            ₱0.00
                        </strong>

                    </div>


                    <div class="total-row">

                        <span>
                            Total
                        </span>

                        <strong id="total">
                            ₱0.00
                        </strong>

                    </div>

                </div>


                {{-- Payment --}}
                <div class="payment-section">

                    <p>
                        Payment Method
                    </p>


                    <div class="payment-methods">

                        <button
                            type="button"
                            class="payment-method active"
                            data-payment="cash"
                        >
                            Cash
                        </button>


                        <button
                            type="button"
                            class="payment-method"
                            data-payment="card"
                        >
                            Card
                        </button>


                        <button
                            type="button"
                            class="payment-method"
                            data-payment="gcash"
                        >
                            GCash
                        </button>

                    </div>

                </div>


                {{-- Checkout --}}
                <button
                    id="checkoutButton"
                    type="button"
                    class="checkout-button"
                    disabled
                >
                    Complete Sale
                </button>


                {{-- Cart Actions --}}
                <div class="cart-actions">

                    <button
                        type="button"
                        class="secondary-action"
                        id="holdButton"
                    >
                        Hold Order
                    </button>


                    <button
                        type="button"
                        class="secondary-action"
                        id="clearButton"
                    >
                        Clear Cart
                    </button>

                </div>

            </aside>

        </div>

    </div>

</div>

@endsection