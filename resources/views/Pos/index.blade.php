@extends('layouts.app')

@section('title', 'Point of Sale - NexPOS')
@section('page-title', 'Point of Sale')

@section('content')

<div class="pos-page">

    {{-- =========================
         POS HEADER
    ========================== --}}
    <div class="pos-header">

        <div>
            <h2>Point of Sale</h2>
            <p>Select products and complete your transaction.</p>
        </div>

        <div class="pos-actions">

            <button
                type="button"
                class="pos-action-btn"
                id="scanButton"
            >
                📷 Scan
            </button>

        </div>

    </div>


    {{-- =========================
         MAIN POS AREA
    ========================== --}}
    <div class="pos-layout">

        {{-- PRODUCTS --}}
        <section class="products-panel">

            <div class="products-toolbar">

                <div class="search-box">

                    <span>⌕</span>

                    <input
                        type="text"
                        id="productSearch"
                        placeholder="Search product..."
                        autocomplete="off"
                    >

                </div>

            </div>


            {{-- CATEGORIES --}}
            <div class="category-list">

                <button
                    type="button"
                    class="category-btn active"
                    data-category="all"
                >
                    All
                </button>

                <button
                    type="button"
                    class="category-btn"
                    data-category="food"
                >
                    Food
                </button>

                <button
                    type="button"
                    class="category-btn"
                    data-category="drink"
                >
                    Drinks
                </button>

                <button
                    type="button"
                    class="category-btn"
                    data-category="other"
                >
                    Other
                </button>

            </div>


            {{-- PRODUCT GRID --}}
            <div
                class="product-grid"
                id="productGrid"
            >

                @forelse (\App\Models\Product::all() as $product)

                    <div
                        class="product-card"
                        data-id="{{ $product->id }}"
                        data-name="{{ strtolower($product->name) }}"
                        data-price="{{ $product->price }}"
                        data-category="{{ strtolower($product->category ?? 'other') }}"
                        data-stock="{{ $product->stock }}"
                    >

                        <div class="product-image">

                            @if ($product->image)

                                <img
                                    src="{{ asset('storage/' . $product->image) }}"
                                    alt="{{ $product->name }}"
                                >

                            @else

                                <span>📦</span>

                            @endif

                        </div>


                        <div class="product-info">

                            <h3>
                                {{ $product->name }}
                            </h3>

                            <p class="product-category">
                                {{ $product->category ?: 'General' }}
                            </p>


                            <div class="product-bottom">

                                <strong>
                                    ₱{{ number_format($product->price, 2) }}
                                </strong>

                                <span
                                    class="stock-text {{ $product->stock <= 0 ? 'out-stock' : '' }}"
                                >
                                    {{ $product->stock }} stock
                                </span>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="empty-products">

                        <div>📦</div>

                        <h3>No products available</h3>

                        <p>
                            Add products first to start selling.
                        </p>

                    </div>

                @endforelse

            </div>

        </section>


        {{-- =========================
             CART
        ========================== --}}
        <aside class="cart-panel">

            <div class="cart-header">

                <div>

                    <h2>Current Order</h2>

                    <p id="cartCount">
                        0 items
                    </p>

                </div>


                <button
                    type="button"
                    id="clearCartButton"
                    class="clear-cart-btn"
                >
                    Clear
                </button>

            </div>


            {{-- CART ITEMS --}}
            <div
                class="cart-items"
                id="cartItems"
            >

                <div class="empty-cart">

                    <div class="empty-cart-icon">
                        🛒
                    </div>

                    <h3>Your cart is empty</h3>

                    <p>
                        Select a product to add it to the order.
                    </p>

                </div>

            </div>


            {{-- CART SUMMARY --}}
            <div class="cart-summary">

                <div class="summary-row">

                    <span>
                        Subtotal
                    </span>

                    <strong id="cartSubtotal">
                        ₱0.00
                    </strong>

                </div>


                <div class="summary-row">

                    <span>
                        Tax (12%)
                    </span>

                    <strong id="cartTax">
                        ₱0.00
                    </strong>

                </div>


                <div class="summary-row total-row">

                    <span>
                        Total
                    </span>

                    <strong id="cartTotal">
                        ₱0.00
                    </strong>

                </div>

            </div>


            {{-- =========================
                 PAYMENT
            ========================== --}}
            <div class="payment-section">

                <h3>
                    Payment Method
                </h3>


                <div class="payment-methods">

                    <button
                        type="button"
                        class="payment-btn active"
                        data-payment="cash"
                    >
                        💵
                        <span>Cash</span>
                    </button>


                    <button
                        type="button"
                        class="payment-btn"
                        data-payment="card"
                    >
                        💳
                        <span>Card</span>
                    </button>


                    <button
                        type="button"
                        class="payment-btn"
                        data-payment="gcash"
                    >
                        📱
                        <span>GCash</span>
                    </button>

                </div>

            </div>


            {{-- =========================
                 GCASH DETAILS
            ========================== --}}
            <div
                class="gcash-details"
                id="gcashDetails"
                hidden
            >

                <div class="gcash-title">

                    <div class="gcash-icon">
                        📱
                    </div>

                    <div>

                        <strong>
                            GCash Payment
                        </strong>

                        <span>
                            Provide a reference ID or payment proof.
                        </span>

                    </div>

                </div>


                {{-- REFERENCE ID --}}
                <div class="gcash-field">

                    <label for="paymentReference">
                        GCash Reference ID
                    </label>

                    <input
                        type="text"
                        id="paymentReference"
                        placeholder="Enter reference ID"
                        maxlength="100"
                        autocomplete="off"
                    >

                    <small>
                        Example: 123456789012
                    </small>

                </div>


                <div class="gcash-or">
                    <span>OR</span>
                </div>


                {{-- PAYMENT PROOF --}}
                <div class="gcash-field">

                    <label for="paymentProof">
                        Payment Proof
                    </label>


                    <label
                        for="paymentProof"
                        class="proof-upload"
                        id="proofUploadBox"
                    >

                        <div class="proof-upload-icon">
                            🖼
                        </div>

                        <strong>
                            Upload Screenshot
                        </strong>

                        <span>
                            JPG, PNG or WEBP · Max 5MB
                        </span>

                    </label>


                    <input
                        type="file"
                        id="paymentProof"
                        accept="image/jpeg,image/png,image/webp"
                        hidden
                    >


                    {{-- IMAGE PREVIEW --}}
                    <div
                        class="proof-preview"
                        id="proofPreview"
                        hidden
                    >

                        <img
                            id="proofPreviewImage"
                            src=""
                            alt="GCash payment proof"
                        >


                        <div class="proof-preview-info">

                            <strong>
                                Payment proof selected
                            </strong>

                            <button
                                type="button"
                                id="removeProofButton"
                            >
                                Remove
                            </button>

                        </div>

                    </div>

                </div>


                <p class="gcash-note">
                    You only need to provide one:
                    <strong>Reference ID</strong> or
                    <strong>Payment Proof</strong>.
                </p>

            </div>


            {{-- CHECKOUT --}}
            <button
                type="button"
                id="checkoutButton"
                class="checkout-btn"
                disabled
            >
                Complete Sale
            </button>

        </aside>

    </div>

</div>


{{-- =========================
     RECEIPT MODAL
========================== --}}
<div
    id="invoiceModal"
    class="invoice-modal"
    aria-hidden="true"
>

    <div class="invoice-overlay"></div>


    <div class="invoice-box">

        <button
            type="button"
            id="closeInvoiceButton"
            class="invoice-close"
        >
            ×
        </button>


        <div class="invoice-header">

            <div class="invoice-logo">

                <img
                    src="{{ asset('images/NexPOSLogo.png') }}"
                    alt="NexPOS"
                >

            </div>


            <h2>
                Sale Completed
            </h2>


            <p>
                Thank you for your purchase.
            </p>

        </div>


        <div class="invoice-details">

            <div>

                <span>
                    Invoice
                </span>

                <strong id="invoiceNumber">
                    -
                </strong>

            </div>


            <div>

                <span>
                    Date
                </span>

                <strong id="invoiceDate">
                    -
                </strong>

            </div>


            <div>

                <span>
                    Payment
                </span>

                <strong id="invoicePayment">
                    -
                </strong>

            </div>

        </div>


        {{-- GCASH RECEIPT DETAILS --}}
        <div
            class="invoice-payment-proof"
            id="invoicePaymentProof"
            hidden
        >

            <div>

                <span>
                    GCash Reference
                </span>

                <strong id="invoiceReference">
                    -
                </strong>

            </div>


            <div
                id="invoiceProofContainer"
                hidden
            >

                <span>
                    Payment Proof
                </span>

                <img
                    id="invoiceProofImage"
                    src=""
                    alt="GCash payment proof"
                >

            </div>

        </div>


        <div class="invoice-items">

            <div class="invoice-items-header">

                <span>
                    Product
                </span>

                <span>
                    Qty
                </span>

                <span>
                    Total
                </span>

            </div>


            <div id="invoiceItems"></div>

        </div>


        <div class="invoice-summary">

            <div class="invoice-summary-row">

                <span>
                    Subtotal
                </span>

                <strong id="invoiceSubtotal">
                    ₱0.00
                </strong>

            </div>


            <div class="invoice-summary-row">

                <span>
                    Tax
                </span>

                <strong id="invoiceTax">
                    ₱0.00
                </strong>

            </div>


            <div class="invoice-summary-row invoice-total">

                <span>
                    Total
                </span>

                <strong id="invoiceTotal">
                    ₱0.00
                </strong>

            </div>

        </div>


        <div class="invoice-actions">

            <button
                type="button"
                id="printInvoiceButton"
                class="invoice-print-btn"
            >
                🖨 Print Receipt
            </button>


            <button
                type="button"
                id="doneInvoiceButton"
                class="invoice-done-btn"
            >
                Done
            </button>

        </div>

    </div>

</div>


{{-- =========================
     CHECKOUT ERROR
========================== --}}
<div
    id="checkoutError"
    class="checkout-error"
>

    <span>!</span>

    <span id="checkoutErrorMessage"></span>

</div>


<style>

/* ============================================================
   POS PAGE
============================================================ */

.pos-page {
    width: 100%;
}


/* ============================================================
   HEADER
============================================================ */

.pos-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 24px;
}

.pos-header h2 {
    margin: 0 0 5px;
    font-size: 24px;
    color: #111827;
}

.pos-header p {
    margin: 0;
    color: #6b7280;
    font-size: 14px;
}

.pos-action-btn {
    border: 1px solid #dbe2ea;
    background: #ffffff;
    color: #374151;
    padding: 10px 16px;
    border-radius: 9px;
    cursor: pointer;
    font-weight: 600;
}

.pos-action-btn:hover {
    background: #f8fafc;
}


/* ============================================================
   LAYOUT
============================================================ */

.pos-layout {
    display: grid;
    grid-template-columns:
        minmax(0, 1fr)
        390px;

    gap: 22px;

    align-items: start;
}


/* ============================================================
   PRODUCTS
============================================================ */

.products-panel {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    padding: 22px;
    min-width: 0;
}

.products-toolbar {
    margin-bottom: 18px;
}

.search-box {
    height: 46px;
    border: 1px solid #dbe2ea;
    border-radius: 9px;
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 0 14px;
    background: #ffffff;
}

.search-box span {
    color: #6b7280;
    font-size: 22px;
}

.search-box input {
    border: 0;
    outline: 0;
    width: 100%;
    font-size: 14px;
    color: #111827;
    background: transparent;
}


/* ============================================================
   CATEGORIES
============================================================ */

.category-list {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    margin-bottom: 20px;
}

.category-btn {
    border: 1px solid #dbe2ea;
    background: #ffffff;
    color: #4b5563;
    border-radius: 8px;
    padding: 8px 15px;
    cursor: pointer;
    font-size: 13px;
    font-weight: 600;
}

.category-btn:hover {
    background: #f3f6fa;
}

.category-btn.active {
    background: #2563eb;
    color: #ffffff;
    border-color: #2563eb;
}


/* ============================================================
   PRODUCT GRID
============================================================ */

.product-grid {
    display: grid;
    grid-template-columns:
        repeat(
            auto-fill,
            minmax(170px, 1fr)
        );

    gap: 14px;
}

.product-card {
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 12px;
    cursor: pointer;
    background: #ffffff;
    transition: 0.18s ease;
}

.product-card:hover {
    border-color: #2563eb;
    transform: translateY(-2px);
    box-shadow:
        0 8px 22px
        rgba(15, 23, 42, 0.08);
}

.product-image {
    height: 125px;
    border-radius: 9px;
    background: #f3f6fa;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    margin-bottom: 12px;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.product-image span {
    font-size: 38px;
}

.product-info h3 {
    margin: 0 0 5px;
    font-size: 15px;
    color: #111827;
}

.product-category {
    margin: 0 0 12px;
    color: #6b7280;
    font-size: 12px;
}

.product-bottom {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
}

.product-bottom strong {
    color: #2563eb;
    font-size: 14px;
}

.stock-text {
    font-size: 11px;
    color: #64748b;
}

.stock-text.out-stock {
    color: #dc2626;
    font-weight: 700;
}

.empty-products {
    grid-column: 1 / -1;
    text-align: center;
    padding: 70px 20px;
    color: #6b7280;
}


/* ============================================================
   CART
============================================================ */

.cart-panel {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    overflow: hidden;
    position: sticky;
    top: 20px;
}

.cart-header {
    padding: 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid #eef0f3;
}

.cart-header h2 {
    margin: 0 0 4px;
    font-size: 18px;
    color: #111827;
}

.cart-header p {
    margin: 0;
    color: #6b7280;
    font-size: 12px;
}

.clear-cart-btn {
    border: 0;
    background: #fef2f2;
    color: #dc2626;
    border-radius: 7px;
    padding: 7px 11px;
    cursor: pointer;
    font-size: 12px;
    font-weight: 600;
}


/* ============================================================
   CART ITEMS
============================================================ */

.cart-items {
    padding: 14px;
    max-height: 370px;
    overflow-y: auto;
}

.empty-cart {
    text-align: center;
    padding: 45px 15px;
    color: #6b7280;
}

.empty-cart-icon {
    font-size: 38px;
    margin-bottom: 10px;
}

.empty-cart h3 {
    margin: 0 0 5px;
    color: #374151;
    font-size: 15px;
}

.empty-cart p {
    margin: 0;
    font-size: 12px;
}

.cart-item {
    display: grid;
    grid-template-columns: 1fr auto;
    gap: 10px;
    padding: 13px 5px;
    border-bottom: 1px solid #eef0f3;
}

.cart-item:last-child {
    border-bottom: 0;
}

.cart-item-name {
    margin: 0 0 4px;
    color: #111827;
    font-size: 14px;
    font-weight: 700;
}

.cart-item-price {
    margin: 0;
    color: #6b7280;
    font-size: 12px;
}

.cart-item-total {
    color: #111827;
    font-size: 13px;
    font-weight: 700;
    text-align: right;
}

.quantity-controls {
    display: flex;
    align-items: center;
    gap: 6px;
    margin-top: 9px;
}

.quantity-btn {
    width: 25px;
    height: 25px;
    border: 1px solid #dbe2ea;
    background: #ffffff;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 700;
}

.quantity-value {
    min-width: 22px;
    text-align: center;
    font-size: 12px;
    font-weight: 700;
}

.remove-item {
    border: 0;
    background: transparent;
    color: #ef4444;
    cursor: pointer;
    font-size: 11px;
    padding: 0;
    margin-left: 5px;
}


/* ============================================================
   SUMMARY
============================================================ */

.cart-summary {
    padding: 18px 20px;
    border-top: 1px solid #eef0f3;
}

.summary-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 11px;
    font-size: 13px;
    color: #6b7280;
}

.summary-row strong {
    color: #374151;
}

.total-row {
    border-top: 1px solid #e5e7eb;
    padding-top: 15px;
    margin-top: 14px;
    margin-bottom: 0;
    color: #111827;
    font-size: 16px;
}

.total-row strong {
    color: #2563eb;
    font-size: 20px;
}


/* ============================================================
   PAYMENT
============================================================ */

.payment-section {
    padding: 18px 20px;
    border-top: 1px solid #eef0f3;
}

.payment-section h3 {
    margin: 0 0 12px;
    font-size: 13px;
    color: #374151;
}

.payment-methods {
    display: grid;
    grid-template-columns:
        repeat(3, 1fr);

    gap: 8px;
}

.payment-btn {
    border: 1px solid #dbe2ea;
    background: #ffffff;
    border-radius: 8px;
    padding: 10px 6px;
    cursor: pointer;
    color: #4b5563;
    font-size: 11px;
    font-weight: 600;
}

.payment-btn span {
    display: block;
    margin-top: 4px;
}

.payment-btn.active {
    border-color: #2563eb;
    background: #eff6ff;
    color: #2563eb;
}


/* ============================================================
   GCASH DETAILS
============================================================ */

.gcash-details {
    padding: 16px 20px;
    border-top: 1px solid #eef0f3;
    background: #f8fbff;
}

.gcash-title {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-bottom: 16px;
}

.gcash-icon {
    width: 34px;
    height: 34px;
    border-radius: 8px;
    background: #eff6ff;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.gcash-title strong {
    display: block;
    color: #111827;
    font-size: 13px;
    margin-bottom: 3px;
}

.gcash-title span {
    display: block;
    color: #6b7280;
    font-size: 11px;
    line-height: 1.4;
}

.gcash-field {
    margin-bottom: 13px;
}

.gcash-field label {
    display: block;
    margin-bottom: 6px;
    color: #374151;
    font-size: 12px;
    font-weight: 700;
}

.gcash-field input[type="text"] {
    width: 100%;
    height: 40px;
    border: 1px solid #dbe2ea;
    border-radius: 8px;
    padding: 0 11px;
    outline: none;
    background: #ffffff;
    color: #111827;
    font-size: 12px;
    box-sizing: border-box;
}

.gcash-field input[type="text"]:focus {
    border-color: #2563eb;
    box-shadow:
        0 0 0 3px
        rgba(37, 99, 235, 0.08);
}

.gcash-field small {
    display: block;
    margin-top: 5px;
    color: #9ca3af;
    font-size: 10px;
}

.gcash-or {
    display: flex;
    align-items: center;
    gap: 8px;
    margin: 13px 0;
    color: #9ca3af;
    font-size: 10px;
    font-weight: 700;
}

.gcash-or::before,
.gcash-or::after {
    content: "";
    height: 1px;
    background: #dbe2ea;
    flex: 1;
}

.proof-upload {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 95px;
    border: 1px dashed #bfdbfe;
    border-radius: 9px;
    background: #ffffff;
    cursor: pointer;
    text-align: center;
    transition: 0.18s ease;
}

.proof-upload:hover {
    border-color: #2563eb;
    background: #eff6ff;
}

.proof-upload-icon {
    font-size: 24px;
    margin-bottom: 5px;
}

.proof-upload strong {
    color: #374151;
    font-size: 11px;
}

.proof-upload span {
    color: #9ca3af;
    font-size: 9px;
    margin-top: 3px;
}

.proof-preview {
    margin-top: 10px;
    border: 1px solid #dbe2ea;
    border-radius: 9px;
    background: #ffffff;
    padding: 8px;
}

.proof-preview img {
    display: block;
    width: 100%;
    max-height: 150px;
    object-fit: contain;
    border-radius: 6px;
    background: #f3f4f6;
}

.proof-preview-info {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    margin-top: 8px;
}

.proof-preview-info strong {
    font-size: 10px;
    color: #374151;
}

.proof-preview-info button {
    border: 0;
    background: #fef2f2;
    color: #dc2626;
    border-radius: 6px;
    padding: 5px 8px;
    font-size: 10px;
    cursor: pointer;
    font-weight: 700;
}

.gcash-note {
    margin: 3px 0 0;
    color: #64748b;
    font-size: 10px;
    line-height: 1.5;
}

.gcash-note strong {
    color: #374151;
}


/* ============================================================
   CHECKOUT
============================================================ */

.checkout-btn {
    width: calc(100% - 40px);
    margin: 0 20px 20px;
    border: 0;
    border-radius: 9px;
    background: #2563eb;
    color: #ffffff;
    padding: 14px;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
}

.checkout-btn:hover {
    background: #1d4ed8;
}

.checkout-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}


/* ============================================================
   ERROR
============================================================ */

.checkout-error {
    position: fixed;
    right: 24px;
    bottom: 24px;
    z-index: 5000;
    display: none;
    align-items: center;
    gap: 9px;
    background: #fff1f2;
    border: 1px solid #fecdd3;
    color: #be123c;
    padding: 12px 16px;
    border-radius: 9px;
    box-shadow:
        0 8px 30px
        rgba(0, 0, 0, 0.12);
    font-size: 13px;
    max-width: 360px;
}

.checkout-error.show {
    display: flex;
}


/* ============================================================
   INVOICE MODAL
============================================================ */

.invoice-modal {
    position: fixed;
    inset: 0;
    z-index: 4000;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.invoice-modal.show {
    display: flex;
}

.invoice-overlay {
    position: absolute;
    inset: 0;
    background: rgba(15, 23, 42, 0.55);
    backdrop-filter: blur(3px);
}

.invoice-box {
    position: relative;
    z-index: 1;
    width: 100%;
    max-width: 470px;
    max-height: 90vh;
    overflow-y: auto;
    background: #ffffff;
    border-radius: 16px;
    box-shadow:
        0 25px 70px
        rgba(15, 23, 42, 0.25);
    padding: 26px;
}

.invoice-close {
    position: absolute;
    top: 12px;
    right: 14px;
    width: 34px;
    height: 34px;
    border: 0;
    border-radius: 50%;
    background: #f3f4f6;
    color: #4b5563;
    font-size: 22px;
    cursor: pointer;
}

.invoice-header {
    text-align: center;
    padding: 5px 25px 20px;
    border-bottom: 1px dashed #d1d5db;
}

.invoice-logo img {
    width: 110px;
    max-height: 55px;
    object-fit: contain;
    margin-bottom: 8px;
}

.invoice-header h2 {
    margin: 0 0 5px;
    color: #111827;
    font-size: 21px;
}

.invoice-header p {
    margin: 0;
    color: #6b7280;
    font-size: 12px;
}


/* ============================================================
   INVOICE DETAILS
============================================================ */

.invoice-details {
    display: grid;
    grid-template-columns:
        repeat(3, 1fr);

    gap: 12px;
    padding: 18px 0;
    border-bottom: 1px dashed #d1d5db;
}

.invoice-details span {
    display: block;
    color: #9ca3af;
    font-size: 10px;
    margin-bottom: 4px;
    text-transform: uppercase;
}

.invoice-details strong {
    display: block;
    color: #374151;
    font-size: 11px;
    word-break: break-word;
}


/* ============================================================
   INVOICE PAYMENT PROOF
============================================================ */

.invoice-payment-proof {
    padding: 14px 0;
    border-bottom: 1px dashed #d1d5db;
}

.invoice-payment-proof > div {
    margin-bottom: 10px;
}

.invoice-payment-proof > div:last-child {
    margin-bottom: 0;
}

.invoice-payment-proof span {
    display: block;
    color: #9ca3af;
    font-size: 10px;
    text-transform: uppercase;
    margin-bottom: 4px;
}

.invoice-payment-proof strong {
    display: block;
    color: #374151;
    font-size: 11px;
    word-break: break-word;
}

.invoice-payment-proof img {
    display: block;
    width: 100%;
    max-height: 180px;
    object-fit: contain;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    background: #f8fafc;
}


/* ============================================================
   INVOICE ITEMS
============================================================ */

.invoice-items {
    padding: 16px 0;
    border-bottom: 1px dashed #d1d5db;
}

.invoice-items-header,
.invoice-item-row {
    display: grid;
    grid-template-columns:
        minmax(0, 1fr)
        45px
        80px;

    gap: 10px;
    align-items: center;
}

.invoice-items-header {
    padding-bottom: 8px;
    color: #9ca3af;
    font-size: 10px;
    text-transform: uppercase;
}

.invoice-items-header span:nth-child(2),
.invoice-items-header span:nth-child(3) {
    text-align: right;
}

.invoice-item-row {
    padding: 8px 0;
    color: #374151;
    font-size: 12px;
}

.invoice-item-row span:nth-child(2),
.invoice-item-row span:nth-child(3) {
    text-align: right;
}


/* ============================================================
   INVOICE SUMMARY
============================================================ */

.invoice-summary {
    padding: 16px 0;
}

.invoice-summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #6b7280;
    font-size: 13px;
    margin-bottom: 9px;
}

.invoice-summary-row strong {
    color: #374151;
}

.invoice-total {
    border-top: 1px solid #e5e7eb;
    padding-top: 13px;
    margin-top: 13px;
    margin-bottom: 0;
    color: #111827;
    font-size: 16px;
}

.invoice-total strong {
    color: #2563eb;
    font-size: 20px;
}


/* ============================================================
   INVOICE BUTTONS
============================================================ */

.invoice-actions {
    display: grid;
    grid-template-columns:
        1fr 1fr;

    gap: 10px;
}

.invoice-actions button {
    border: 0;
    border-radius: 8px;
    padding: 12px;
    cursor: pointer;
    font-weight: 700;
    font-size: 13px;
}

.invoice-print-btn {
    background: #f3f4f6;
    color: #374151;
}

.invoice-done-btn {
    background: #2563eb;
    color: #ffffff;
}


/* ============================================================
   RESPONSIVE
============================================================ */

@media (max-width: 1100px) {

    .pos-layout {
        grid-template-columns: 1fr;
    }

    .cart-panel {
        position: static;
    }

}


@media (max-width: 700px) {

    .pos-header {
        align-items: flex-start;
    }

    .products-panel {
        padding: 15px;
    }

    .product-grid {
        grid-template-columns:
            repeat(
                2,
                minmax(0, 1fr)
            );
    }

    .product-image {
        height: 105px;
    }

    .invoice-box {
        padding: 20px;
    }

}


@media (max-width: 450px) {

    .pos-header {
        flex-direction: column;
    }

    .product-grid {
        grid-template-columns:
            1fr 1fr;

        gap: 8px;
    }

    .payment-methods {
        grid-template-columns: 1fr;
    }

    .invoice-details {
        grid-template-columns: 1fr;
    }

    .invoice-actions {
        grid-template-columns: 1fr;
    }

}

</style>


<script>

document.addEventListener(
    "DOMContentLoaded",
    function () {

        /* ====================================================
           DATA
        ==================================================== */

        let cart = [];

        let selectedPayment = "cash";


        /* ====================================================
           ELEMENTS
        ==================================================== */

        const productCards =
            document.querySelectorAll(
                ".product-card"
            );

        const productSearch =
            document.getElementById(
                "productSearch"
            );

        const categoryButtons =
            document.querySelectorAll(
                ".category-btn"
            );

        const cartItems =
            document.getElementById(
                "cartItems"
            );

        const cartCount =
            document.getElementById(
                "cartCount"
            );

        const cartSubtotal =
            document.getElementById(
                "cartSubtotal"
            );

        const cartTax =
            document.getElementById(
                "cartTax"
            );

        const cartTotal =
            document.getElementById(
                "cartTotal"
            );

        const clearCartButton =
            document.getElementById(
                "clearCartButton"
            );

        const checkoutButton =
            document.getElementById(
                "checkoutButton"
            );

        const paymentButtons =
            document.querySelectorAll(
                ".payment-btn"
            );


        /* ====================================================
           GCASH ELEMENTS
        ==================================================== */

        const gcashDetails =
            document.getElementById(
                "gcashDetails"
            );

        const paymentReference =
            document.getElementById(
                "paymentReference"
            );

        const paymentProof =
            document.getElementById(
                "paymentProof"
            );

        const proofPreview =
            document.getElementById(
                "proofPreview"
            );

        const proofPreviewImage =
            document.getElementById(
                "proofPreviewImage"
            );

        const removeProofButton =
            document.getElementById(
                "removeProofButton"
            );


        /* ====================================================
           INVOICE
        ==================================================== */

        const invoiceModal =
            document.getElementById(
                "invoiceModal"
            );

        const closeInvoiceButton =
            document.getElementById(
                "closeInvoiceButton"
            );

        const doneInvoiceButton =
            document.getElementById(
                "doneInvoiceButton"
            );

        const printInvoiceButton =
            document.getElementById(
                "printInvoiceButton"
            );


        /* ====================================================
           ERROR
        ==================================================== */

        const checkoutError =
            document.getElementById(
                "checkoutError"
            );

        const checkoutErrorMessage =
            document.getElementById(
                "checkoutErrorMessage"
            );


        /* ====================================================
           HELPERS
        ==================================================== */

        function money(value) {

            return "₱" +
                Number(value).toLocaleString(
                    "en-PH",
                    {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }
                );

        }


        function escapeHtml(value) {

            const div =
                document.createElement(
                    "div"
                );

            div.textContent = value;

            return div.innerHTML;

        }


        function showCheckoutError(message) {

            checkoutErrorMessage.textContent =
                message;

            checkoutError.classList.add(
                "show"
            );


            setTimeout(
                function () {

                    checkoutError.classList.remove(
                        "show"
                    );

                },
                4000
            );

        }


        /* ====================================================
           PAYMENT UI
        ==================================================== */

        function updatePaymentUI() {

            const isGcash =
                selectedPayment === "gcash";


            if (gcashDetails) {

                gcashDetails.hidden =
                    !isGcash;

            }


            if (!isGcash) {

                clearGcashDetails();

            }

        }


        function clearGcashDetails() {

            if (paymentReference) {

                paymentReference.value =
                    "";

            }


            if (paymentProof) {

                paymentProof.value =
                    "";

            }


            if (proofPreview) {

                proofPreview.hidden =
                    true;

            }


            if (proofPreviewImage) {

                proofPreviewImage.src =
                    "";

            }

        }


        /* ====================================================
           PROOF IMAGE PREVIEW
        ==================================================== */

        if (paymentProof) {

            paymentProof.addEventListener(
                "change",
                function () {

                    const file =
                        paymentProof.files[0];


                    if (!file) {

                        return;

                    }


                    if (
                        !file.type.startsWith(
                            "image/"
                        )
                    ) {

                        paymentProof.value =
                            "";

                        showCheckoutError(
                            "Please select an image file."
                        );

                        return;

                    }


                    if (
                        file.size >
                        5 * 1024 * 1024
                    ) {

                        paymentProof.value =
                            "";

                        showCheckoutError(
                            "Payment proof must be 5MB or smaller."
                        );

                        return;

                    }


                    const reader =
                        new FileReader();


                    reader.onload =
                        function (event) {

                            proofPreviewImage.src =
                                event.target.result;

                            proofPreview.hidden =
                                false;

                        };


                    reader.readAsDataURL(
                        file
                    );

                }
            );

        }


        /* ====================================================
           REMOVE PROOF
        ==================================================== */

        if (removeProofButton) {

            removeProofButton.addEventListener(
                "click",
                function () {

                    clearGcashDetails();

                }
            );

        }


        /* ====================================================
           ADD PRODUCT
        ==================================================== */

        function addProduct(card) {

            const id =
                Number(
                    card.dataset.id
                );

            const displayName =
                card
                    .querySelector("h3")
                    .textContent
                    .trim();

            const searchName =
                card.dataset.name ||
                "";

            const price =
                Number(
                    card.dataset.price
                );

            const stock =
                Number(
                    card.dataset.stock
                );


            if (stock <= 0) {

                showCheckoutError(
                    displayName +
                    " is out of stock."
                );

                return;

            }


            const existing =
                cart.find(
                    function (item) {

                        return item.id === id;

                    }
                );


            if (existing) {

                if (
                    existing.quantity >=
                    stock
                ) {

                    showCheckoutError(
                        "No more stock available for " +
                        displayName +
                        "."
                    );

                    return;

                }


                existing.quantity++;

            } else {

                cart.push({

                    id: id,

                    name: displayName,

                    searchName:
                        searchName,

                    price: price,

                    stock: stock,

                    quantity: 1

                });

            }


            renderCart();

        }


        /* ====================================================
           REMOVE PRODUCT
        ==================================================== */

        function removeProduct(id) {

            cart =
                cart.filter(
                    function (item) {

                        return item.id !== id;

                    }
                );


            renderCart();

        }


        /* ====================================================
           CHANGE QUANTITY
        ==================================================== */

        function changeQuantity(
            id,
            amount
        ) {

            const item =
                cart.find(
                    function (item) {

                        return item.id === id;

                    }
                );


            if (!item) {

                return;

            }


            const newQuantity =
                item.quantity +
                amount;


            if (newQuantity <= 0) {

                removeProduct(id);

                return;

            }


            if (
                newQuantity >
                item.stock
            ) {

                showCheckoutError(
                    "Only " +
                    item.stock +
                    " stock available for " +
                    item.name +
                    "."
                );

                return;

            }


            item.quantity =
                newQuantity;


            renderCart();

        }


        /* ====================================================
           RENDER CART
        ==================================================== */

        function renderCart() {

            if (cart.length === 0) {

                cartItems.innerHTML = `

                    <div class="empty-cart">

                        <div class="empty-cart-icon">
                            🛒
                        </div>

                        <h3>
                            Your cart is empty
                        </h3>

                        <p>
                            Select a product to add it to the order.
                        </p>

                    </div>

                `;


                cartCount.textContent =
                    "0 items";

                cartSubtotal.textContent =
                    "₱0.00";

                cartTax.textContent =
                    "₱0.00";

                cartTotal.textContent =
                    "₱0.00";

                checkoutButton.disabled =
                    true;

                return;

            }


            let subtotal = 0;

            let totalQuantity = 0;


            cartItems.innerHTML =
                "";


            cart.forEach(
                function (item) {

                    const itemTotal =
                        item.price *
                        item.quantity;


                    subtotal +=
                        itemTotal;


                    totalQuantity +=
                        item.quantity;


                    const row =
                        document.createElement(
                            "div"
                        );


                    row.className =
                        "cart-item";


                    row.innerHTML = `

                        <div>

                            <p class="cart-item-name">
                                ${escapeHtml(item.name)}
                            </p>

                            <p class="cart-item-price">
                                ${money(item.price)} each
                            </p>


                            <div class="quantity-controls">

                                <button
                                    type="button"
                                    class="quantity-btn decrease"
                                    data-id="${item.id}"
                                >
                                    −
                                </button>


                                <span class="quantity-value">
                                    ${item.quantity}
                                </span>


                                <button
                                    type="button"
                                    class="quantity-btn increase"
                                    data-id="${item.id}"
                                >
                                    +
                                </button>


                                <button
                                    type="button"
                                    class="remove-item"
                                    data-id="${item.id}"
                                >
                                    Remove
                                </button>

                            </div>

                        </div>


                        <div>

                            <div class="cart-item-total">
                                ${money(itemTotal)}
                            </div>

                        </div>

                    `;


                    cartItems.appendChild(
                        row
                    );

                }
            );


            const tax =
                subtotal * 0.12;


            const total =
                subtotal + tax;


            cartCount.textContent =
                totalQuantity +
                (
                    totalQuantity === 1
                        ? " item"
                        : " items"
                );


            cartSubtotal.textContent =
                money(subtotal);


            cartTax.textContent =
                money(tax);


            cartTotal.textContent =
                money(total);


            checkoutButton.disabled =
                false;


            /* QUANTITY BUTTONS */

            cartItems
                .querySelectorAll(
                    ".decrease"
                )
                .forEach(
                    function (button) {

                        button.addEventListener(
                            "click",
                            function () {

                                changeQuantity(
                                    Number(
                                        button.dataset.id
                                    ),
                                    -1
                                );

                            }
                        );

                    }
                );


            cartItems
                .querySelectorAll(
                    ".increase"
                )
                .forEach(
                    function (button) {

                        button.addEventListener(
                            "click",
                            function () {

                                changeQuantity(
                                    Number(
                                        button.dataset.id
                                    ),
                                    1
                                );

                            }
                        );

                    }
                );


            cartItems
                .querySelectorAll(
                    ".remove-item"
                )
                .forEach(
                    function (button) {

                        button.addEventListener(
                            "click",
                            function () {

                                removeProduct(
                                    Number(
                                        button.dataset.id
                                    )
                                );

                            }
                        );

                    }
                );

        }


        /* ====================================================
           PRODUCT CLICK
        ==================================================== */

        productCards.forEach(
            function (card) {

                card.addEventListener(
                    "click",
                    function () {

                        addProduct(card);

                    }
                );

            }
        );


        /* ====================================================
           SEARCH
        ==================================================== */

        let activeCategory =
            "all";


        function filterProducts() {

            const search =
                productSearch.value
                    .toLowerCase()
                    .trim();


            productCards.forEach(
                function (card) {

                    const name =
                        card.dataset.name ||
                        "";

                    const category =
                        card.dataset.category ||
                        "other";


                    const matchesSearch =
                        name.includes(
                            search
                        );


                    const matchesCategory =
                        activeCategory ===
                            "all" ||
                        category ===
                            activeCategory;


                    card.style.display =
                        matchesSearch &&
                        matchesCategory
                            ? ""
                            : "none";

                }
            );

        }


        productSearch.addEventListener(
            "input",
            filterProducts
        );


        /* ====================================================
           CATEGORY FILTER
        ==================================================== */

        categoryButtons.forEach(
            function (button) {

                button.addEventListener(
                    "click",
                    function () {

                        categoryButtons.forEach(
                            function (btn) {

                                btn.classList.remove(
                                    "active"
                                );

                            }
                        );


                        button.classList.add(
                            "active"
                        );


                        activeCategory =
                            button.dataset.category;


                        filterProducts();

                    }
                );

            }
        );


        /* ====================================================
           PAYMENT METHOD
        ==================================================== */

        paymentButtons.forEach(
            function (button) {

                button.addEventListener(
                    "click",
                    function () {

                        paymentButtons.forEach(
                            function (btn) {

                                btn.classList.remove(
                                    "active"
                                );

                            }
                        );


                        button.classList.add(
                            "active"
                        );


                        selectedPayment =
                            button.dataset.payment;


                        updatePaymentUI();

                    }
                );

            }
        );


        /* ====================================================
           CLEAR CART
        ==================================================== */

        clearCartButton.addEventListener(
            "click",
            function () {

                cart = [];

                renderCart();

            }
        );


        /* ====================================================
           CHECKOUT
        ==================================================== */

        checkoutButton.addEventListener(
            "click",
            async function () {

                if (cart.length === 0) {

                    showCheckoutError(
                        "Your cart is empty."
                    );

                    return;

                }


                /*
                |--------------------------------------------------------------------------
                | GCASH VALIDATION
                |--------------------------------------------------------------------------
                */

                if (
                    selectedPayment ===
                    "gcash"
                ) {

                    const reference =
                        paymentReference
                            .value
                            .trim();


                    const proof =
                        paymentProof.files[0];


                    if (
                        !reference &&
                        !proof
                    ) {

                        showCheckoutError(
                            "Please provide a GCash reference ID or payment proof."
                        );

                        return;

                    }

                }


                checkoutButton.disabled =
                    true;


                checkoutButton.textContent =
                    "Processing...";


                try {

                    /*
                    |--------------------------------------------------------------------------
                    | FORM DATA
                    |--------------------------------------------------------------------------
                    */

                    const formData =
                        new FormData();


                    formData.append(
                        "payment_method",
                        selectedPayment
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | GCASH REFERENCE
                    |--------------------------------------------------------------------------
                    */

                    if (
                        selectedPayment ===
                        "gcash"
                    ) {

                        const reference =
                            paymentReference
                                .value
                                .trim();


                        if (reference) {

                            formData.append(
                                "payment_reference",
                                reference
                            );

                        }


                        if (
                            paymentProof.files.length >
                            0
                        ) {

                            formData.append(
                                "payment_proof",
                                paymentProof.files[0]
                            );

                        }

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | CART ITEMS
                    |--------------------------------------------------------------------------
                    */

                    cart.forEach(
                        function (
                            item,
                            index
                        ) {

                            formData.append(
                                `items[${index}][product_id]`,
                                item.id
                            );


                            formData.append(
                                `items[${index}][quantity]`,
                                item.quantity
                            );

                        }
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | SEND TO LARAVEL
                    |--------------------------------------------------------------------------
                    */

                    const response =
                        await fetch(
                            '{{ route("sales.store") }}',
                            {

                                method:
                                    "POST",

                                headers: {

                                    "X-CSRF-TOKEN":
                                        document
                                            .querySelector(
                                                'meta[name="csrf-token"]'
                                            )
                                            .getAttribute(
                                                "content"
                                            ),

                                    "Accept":
                                        "application/json"

                                },

                                body:
                                    formData

                            }
                        );


                    const data =
                        await response.json();


                    /*
                    |--------------------------------------------------------------------------
                    | CHECK RESPONSE
                    |--------------------------------------------------------------------------
                    */

                    if (
                        !response.ok ||
                        !data.success
                    ) {

                        throw new Error(
                            data.message ||
                            "Unable to complete the sale."
                        );

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | UPDATE STOCK
                    |--------------------------------------------------------------------------
                    */

                    cart.forEach(
                        function (
                            cartItem
                        ) {

                            const card =
                                document.querySelector(
                                    `.product-card[data-id="${cartItem.id}"]`
                                );


                            if (!card) {

                                return;

                            }


                            const newStock =
                                Number(
                                    card.dataset.stock
                                ) -
                                cartItem.quantity;


                            card.dataset.stock =
                                Math.max(
                                    newStock,
                                    0
                                );


                            const stockText =
                                card.querySelector(
                                    ".stock-text"
                                );


                            if (stockText) {

                                stockText.textContent =
                                    Math.max(
                                        newStock,
                                        0
                                    ) +
                                    " stock";


                                if (
                                    newStock <=
                                    0
                                ) {

                                    stockText.classList.add(
                                        "out-stock"
                                    );

                                }

                            }

                        }
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | CLEAR CART
                    |--------------------------------------------------------------------------
                    */

                    cart = [];


                    clearGcashDetails();


                    renderCart();


                    /*
                    |--------------------------------------------------------------------------
                    | SHOW INVOICE
                    |--------------------------------------------------------------------------
                    */

                    showInvoice(
                        data
                    );


                } catch (error) {

                    console.error(
                        "Checkout error:",
                        error
                    );


                    showCheckoutError(
                        error.message ||
                        "Something went wrong while completing the sale."
                    );


                } finally {

                    checkoutButton.disabled =
                        cart.length === 0;


                    checkoutButton.textContent =
                        "Complete Sale";

                }

            }
        );


        /* ====================================================
           SHOW INVOICE
        ==================================================== */

        function showInvoice(data) {

            document.getElementById(
                "invoiceNumber"
            ).textContent =
                data.invoice_number ||
                "-";


            document.getElementById(
                "invoiceDate"
            ).textContent =
                data.date ||
                "-";


            document.getElementById(
                "invoicePayment"
            ).textContent =
                formatPayment(
                    data.payment_method
                );


            /*
            |--------------------------------------------------------------------------
            | GCASH INFORMATION
            |--------------------------------------------------------------------------
            */

            const invoicePaymentProof =
                document.getElementById(
                    "invoicePaymentProof"
                );


            const invoiceReference =
                document.getElementById(
                    "invoiceReference"
                );


            const invoiceProofContainer =
                document.getElementById(
                    "invoiceProofContainer"
                );


            const invoiceProofImage =
                document.getElementById(
                    "invoiceProofImage"
                );


            if (
                data.payment_method ===
                "gcash"
            ) {

                invoicePaymentProof.hidden =
                    false;


                invoiceReference.textContent =
                    data.payment_reference ||
                    "Not provided";


                if (
                    data.payment_proof
                ) {

                    invoiceProofContainer.hidden =
                        false;


                    invoiceProofImage.src =
                        data.payment_proof;

                } else {

                    invoiceProofContainer.hidden =
                        true;


                    invoiceProofImage.src =
                        "";

                }

            } else {

                invoicePaymentProof.hidden =
                    true;

                invoiceReference.textContent =
                    "-";

                invoiceProofContainer.hidden =
                    true;

                invoiceProofImage.src =
                    "";

            }


            /*
            |--------------------------------------------------------------------------
            | INVOICE ITEMS
            |--------------------------------------------------------------------------
            */

            const invoiceItems =
                document.getElementById(
                    "invoiceItems"
                );


            invoiceItems.innerHTML =
                "";


            if (
                Array.isArray(
                    data.items
                )
            ) {

                data.items.forEach(
                    function (item) {

                        const row =
                            document.createElement(
                                "div"
                            );


                        row.className =
                            "invoice-item-row";


                        row.innerHTML = `

                            <span>
                                ${escapeHtml(
                                    item.product_name
                                )}
                            </span>

                            <span>
                                ${item.quantity}
                            </span>

                            <span>
                                ${money(
                                    item.subtotal
                                )}
                            </span>

                        `;


                        invoiceItems.appendChild(
                            row
                        );

                    }
                );

            }


            /*
            |--------------------------------------------------------------------------
            | INVOICE TOTALS
            |--------------------------------------------------------------------------
            */

            document.getElementById(
                "invoiceSubtotal"
            ).textContent =
                money(
                    data.subtotal ||
                    0
                );


            document.getElementById(
                "invoiceTax"
            ).textContent =
                money(
                    data.tax ||
                    0
                );


            document.getElementById(
                "invoiceTotal"
            ).textContent =
                money(
                    data.total ||
                    0
                );


            /*
            |--------------------------------------------------------------------------
            | OPEN MODAL
            |--------------------------------------------------------------------------
            */

            invoiceModal.classList.add(
                "show"
            );


            invoiceModal.setAttribute(
                "aria-hidden",
                "false"
            );

        }


        /* ====================================================
           PAYMENT NAME
        ==================================================== */

        function formatPayment(payment) {

            if (!payment) {

                return "-";

            }


            return (
                payment
                    .charAt(0)
                    .toUpperCase() +
                payment.slice(1)
            );

        }


        /* ====================================================
           CLOSE INVOICE
        ==================================================== */

        function closeInvoice() {

            invoiceModal.classList.remove(
                "show"
            );


            invoiceModal.setAttribute(
                "aria-hidden",
                "true"
            );

        }


        closeInvoiceButton.addEventListener(
            "click",
            closeInvoice
        );


        doneInvoiceButton.addEventListener(
            "click",
            closeInvoice
        );


        document
            .querySelector(
                ".invoice-overlay"
            )
            .addEventListener(
                "click",
                closeInvoice
            );


        /* ====================================================
           PRINT RECEIPT
        ==================================================== */

        printInvoiceButton.addEventListener(
            "click",
            function () {

                const receipt =
                    document.querySelector(
                        ".invoice-box"
                    );


                const printWindow =
                    window.open(
                        "",
                        "_blank",
                        "width=500,height=700"
                    );


                if (!printWindow) {

                    showCheckoutError(
                        "Please allow pop-ups to print the receipt."
                    );

                    return;

                }


                printWindow.document.write(`

                    <!DOCTYPE html>

                    <html>

                    <head>

                        <title>
                            NexPOS Receipt
                        </title>

                        <style>

                            body {
                                font-family:
                                    Arial,
                                    sans-serif;

                                padding: 25px;

                                color:
                                    #111827;
                            }

                            .receipt {
                                max-width:
                                    400px;

                                margin:
                                    auto;
                            }

                            .invoice-actions,
                            .invoice-close {
                                display:
                                    none !important;
                            }

                        </style>

                    </head>

                    <body>

                        <div class="receipt">

                            ${receipt.innerHTML}

                        </div>

                    </body>

                    </html>

                `);


                printWindow.document.close();

                printWindow.focus();


                setTimeout(
                    function () {

                        printWindow.print();

                        printWindow.close();

                    },
                    300
                );

            }
        );


        /* ====================================================
           SCAN BUTTON
        ==================================================== */

        const scanButton =
            document.getElementById(
                "scanButton"
            );


        if (scanButton) {

            scanButton.addEventListener(
                "click",
                function () {

                    productSearch.focus();

                }
            );

        }


        /* ====================================================
           INITIAL STATE
        ==================================================== */

        updatePaymentUI();

        renderCart();

        filterProducts();

    }
);

</script>

@endsection