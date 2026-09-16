@extends('layouts.app')

@section('title', 'Sales - NexPOS')
@section('page-title', 'Sales')

@section('content')

<div class="sales-page">

    {{-- HEADER --}}
    <div class="sales-header">

        <div class="sales-heading">

            <span class="sales-eyebrow">
                TRANSACTION HISTORY
            </span>

            <h1>
                Sales
            </h1>

            <p>
                View and manage your sales transactions.
            </p>

        </div>

        <a
            href="{{ route('pos') }}"
            class="sales-new-button"
        >
            <span>+</span>
            New Sale
        </a>

    </div>


    {{-- SALES CARD --}}
    <div class="sales-card">

        {{-- TOOLBAR --}}
        <div class="sales-toolbar">

            <form
                method="GET"
                action="{{ route('sales.index') }}"
                class="sales-search-form"
            >

                <div class="sales-search">

                    <span class="sales-search-icon">
                        ⌕
                    </span>

                    <input
                        type="search"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search invoice number..."
                    >

                    @if(request('search'))

                        <a
                            href="{{ route('sales.index') }}"
                            class="sales-clear"
                            title="Clear search"
                        >
                            ×
                        </a>

                    @endif

                </div>

                <button
                    type="submit"
                    class="sales-search-button"
                >
                    Search
                </button>

            </form>


            {{-- TRANSACTION COUNT --}}
            <div class="sales-count">

                <span>
                    Transactions
                </span>

                <strong>
                    {{ $sales->total() }}
                </strong>

            </div>

        </div>


        {{-- TABLE --}}
        <div class="sales-table-container">

            <table class="sales-table">

                <thead>

                    <tr>

                        <th>
                            Invoice
                        </th>

                        <th>
                            Customer
                        </th>

                        <th>
                            Payment
                        </th>

                        <th>
                            Status
                        </th>

                        <th>
                            Total
                        </th>

                        <th>
                            Date
                        </th>

                        <th class="sales-action-column">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($sales as $sale)

                        <tr>

                            {{-- INVOICE --}}
                            <td>

                                <div class="invoice-cell">

                                    <div class="invoice-icon">
                                        #
                                    </div>

                                    <div>

                                        <strong>
                                            {{ $sale->invoice_number }}
                                        </strong>

                                        <small>
                                            Transaction
                                        </small>

                                    </div>

                                </div>

                            </td>


                            {{-- CUSTOMER --}}
                            <td>

                                <div class="customer-cell">

                                    <span class="customer-avatar">
                                        {{ strtoupper(substr($sale->customer->name ?? 'W', 0, 1)) }}
                                    </span>

                                    <span>
                                        {{ $sale->customer->name ?? 'Walk-in Customer' }}
                                    </span>

                                </div>

                            </td>


                            {{-- PAYMENT --}}
                            <td>

                                <span class="payment-badge">

                                    @if(strtolower($sale->payment_method) === 'cash')
                                        Cash
                                    @elseif(strtolower($sale->payment_method) === 'card')
                                        Card
                                    @elseif(strtolower($sale->payment_method) === 'gcash')
                                        GCash
                                    @else
                                        {{ ucfirst($sale->payment_method) }}
                                    @endif

                                </span>

                            </td>


                            {{-- STATUS --}}
                            <td>

                                @if($sale->status === 'completed')

                                    <span class="sale-status completed">
                                        <span class="status-dot"></span>
                                        Completed
                                    </span>

                                @elseif($sale->status === 'pending')

                                    <span class="sale-status pending">
                                        <span class="status-dot"></span>
                                        Pending
                                    </span>

                                @else

                                    <span class="sale-status cancelled">
                                        <span class="status-dot"></span>
                                        {{ ucfirst($sale->status) }}
                                    </span>

                                @endif

                            </td>


                            {{-- TOTAL --}}
                            <td>

                                <strong class="sale-total">
                                    ₱{{ number_format($sale->total, 2) }}
                                </strong>

                            </td>


                            {{-- DATE --}}
                            <td>

                                <div class="sale-date">

                                    <strong>
                                        {{ $sale->created_at->format('M d, Y') }}
                                    </strong>

                                    <span>
                                        {{ $sale->created_at->format('h:i A') }}
                                    </span>

                                </div>

                            </td>


                            {{-- ACTION --}}
                            <td class="sales-action-column">

                                <a
                                    href="{{ route('sales.show', $sale) }}"
                                    class="sales-view-button"
                                >
                                    View
                                    <span>→</span>
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="sales-empty"
                            >

                                <div class="sales-empty-icon">
                                    🧾
                                </div>

                                <h3>
                                    No sales found
                                </h3>

                                @if(request('search'))

                                    <p>
                                        No transaction matches
                                        "{{ request('search') }}".
                                    </p>

                                    <a
                                        href="{{ route('sales.index') }}"
                                        class="sales-empty-link"
                                    >
                                        Clear Search
                                    </a>

                                @else

                                    <p>
                                        Completed transactions will appear here.
                                    </p>

                                    <a
                                        href="{{ route('pos') }}"
                                        class="sales-empty-link"
                                    >
                                        Create your first sale
                                    </a>

                                @endif

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        @if($sales->hasPages())

            <div class="sales-pagination">

                <div class="pagination-info">

                    Showing
                    <strong>
                        {{ $sales->firstItem() }}
                    </strong>

                    to

                    <strong>
                        {{ $sales->lastItem() }}
                    </strong>

                    of

                    <strong>
                        {{ $sales->total() }}
                    </strong>

                    transactions

                </div>

                <div>
                    {{ $sales->links() }}
                </div>

            </div>

        @endif

    </div>

</div>


<style>

/* ============================================================
   SALES PAGE
============================================================ */

.sales-page {
    width: 100%;
    max-width: 100%;
}


/* HEADER */

.sales-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 24px;
    margin-bottom: 24px;
}

.sales-heading {
    min-width: 0;
}

.sales-eyebrow {
    display: block;
    margin-bottom: 7px;
    color: #2563eb;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.12em;
}

.sales-heading h1 {
    margin: 0;
    color: #0f172a;
    font-size: 28px;
    line-height: 1.2;
    font-weight: 700;
}

.sales-heading p {
    margin: 7px 0 0;
    color: #64748b;
    font-size: 14px;
}


/* NEW SALE */

.sales-new-button {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 11px 17px;
    border-radius: 9px;
    background: #2563eb;
    color: #ffffff;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    white-space: nowrap;
    transition: 0.2s ease;
}

.sales-new-button:hover {
    background: #1d4ed8;
    transform: translateY(-1px);
}

.sales-new-button span {
    font-size: 18px;
    line-height: 1;
}


/* CARD */

.sales-card {
    width: 100%;
    overflow: hidden;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    box-shadow: 0 4px 16px rgba(15, 23, 42, 0.04);
}


/* TOOLBAR */

.sales-toolbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    padding: 18px 20px;
    border-bottom: 1px solid #e5e7eb;
}

.sales-search-form {
    display: flex;
    align-items: center;
    gap: 9px;
    flex: 1;
    max-width: 560px;
}

.sales-search {
    position: relative;
    display: flex;
    align-items: center;
    width: 100%;
}

.sales-search-icon {
    position: absolute;
    left: 13px;
    color: #94a3b8;
    font-size: 19px;
    pointer-events: none;
}

.sales-search input {
    width: 100%;
    height: 40px;
    box-sizing: border-box;
    padding: 0 38px 0 38px;
    border: 1px solid #dbe1e8;
    border-radius: 8px;
    background: #ffffff;
    color: #1e293b;
    font-size: 13px;
    outline: none;
    transition: 0.2s ease;
}

.sales-search input:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.08);
}

.sales-search input::placeholder {
    color: #94a3b8;
}

.sales-clear {
    position: absolute;
    right: 12px;
    color: #94a3b8;
    font-size: 20px;
    line-height: 1;
    text-decoration: none;
}

.sales-clear:hover {
    color: #334155;
}

.sales-search-button {
    height: 40px;
    padding: 0 17px;
    border: 0;
    border-radius: 8px;
    background: #f1f5f9;
    color: #334155;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.2s ease;
}

.sales-search-button:hover {
    background: #e2e8f0;
}

.sales-count {
    display: flex;
    align-items: center;
    gap: 9px;
    color: #64748b;
    font-size: 13px;
    white-space: nowrap;
}

.sales-count strong {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 28px;
    height: 28px;
    padding: 0 8px;
    border-radius: 7px;
    background: #eff6ff;
    color: #2563eb;
    font-size: 12px;
}


/* TABLE */

.sales-table-container {
    width: 100%;
    overflow-x: auto;
}

.sales-table {
    width: 100%;
    min-width: 900px;
    border-collapse: collapse;
}

.sales-table th {
    height: 48px;
    padding: 0 20px;
    background: #f8fafc;
    color: #64748b;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.04em;
    text-align: left;
    text-transform: uppercase;
    border-bottom: 1px solid #e5e7eb;
    white-space: nowrap;
}

.sales-table td {
    height: 68px;
    padding: 8px 20px;
    color: #334155;
    font-size: 13px;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: middle;
}

.sales-table tbody tr {
    transition: 0.15s ease;
}

.sales-table tbody tr:hover {
    background: #f8fafc;
}

.sales-table tbody tr:last-child td {
    border-bottom: 0;
}


/* INVOICE */

.invoice-cell {
    display: flex;
    align-items: center;
    gap: 11px;
}

.invoice-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    flex-shrink: 0;
    border-radius: 8px;
    background: #eff6ff;
    color: #2563eb;
    font-size: 12px;
    font-weight: 700;
}

.invoice-cell strong {
    display: block;
    color: #1e293b;
    font-size: 13px;
}

.invoice-cell small {
    display: block;
    margin-top: 2px;
    color: #94a3b8;
    font-size: 10px;
}


/* CUSTOMER */

.customer-cell {
    display: flex;
    align-items: center;
    gap: 9px;
    white-space: nowrap;
}

.customer-avatar {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 30px;
    height: 30px;
    flex-shrink: 0;
    border-radius: 50%;
    background: #f1f5f9;
    color: #64748b;
    font-size: 11px;
    font-weight: 700;
}


/* PAYMENT */

.payment-badge {
    display: inline-flex;
    align-items: center;
    padding: 5px 9px;
    border-radius: 6px;
    background: #f8fafc;
    color: #475569;
    font-size: 11px;
    font-weight: 600;
    border: 1px solid #e2e8f0;
}


/* STATUS */

.sale-status {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 11px;
    font-weight: 600;
}

.status-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
}

.sale-status.completed {
    color: #15803d;
}

.sale-status.completed .status-dot {
    background: #22c55e;
}

.sale-status.pending {
    color: #b45309;
}

.sale-status.pending .status-dot {
    background: #f59e0b;
}

.sale-status.cancelled {
    color: #dc2626;
}

.sale-status.cancelled .status-dot {
    background: #ef4444;
}


/* TOTAL */

.sale-total {
    color: #0f172a;
    font-size: 13px;
    white-space: nowrap;
}


/* DATE */

.sale-date strong {
    display: block;
    color: #334155;
    font-size: 12px;
    font-weight: 600;
}

.sale-date span {
    display: block;
    margin-top: 3px;
    color: #94a3b8;
    font-size: 10px;
}


/* VIEW BUTTON */

.sales-action-column {
    text-align: right !important;
}

.sales-view-button {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 7px 11px;
    border: 1px solid #dbeafe;
    border-radius: 7px;
    background: #eff6ff;
    color: #2563eb;
    font-size: 11px;
    font-weight: 600;
    text-decoration: none;
    transition: 0.2s ease;
}

.sales-view-button:hover {
    background: #dbeafe;
}

.sales-view-button span {
    font-size: 14px;
}


/* EMPTY */

.sales-empty {
    padding: 70px 20px !important;
    text-align: center;
}

.sales-empty-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 54px;
    height: 54px;
    margin: 0 auto 14px;
    border-radius: 12px;
    background: #f1f5f9;
    font-size: 23px;
}

.sales-empty h3 {
    margin: 0;
    color: #334155;
    font-size: 15px;
}

.sales-empty p {
    margin: 6px 0 14px;
    color: #94a3b8;
    font-size: 12px;
}

.sales-empty-link {
    color: #2563eb;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
}

.sales-empty-link:hover {
    text-decoration: underline;
}


/* PAGINATION */

.sales-pagination {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    padding: 16px 20px;
    border-top: 1px solid #e5e7eb;
}

.pagination-info {
    color: #94a3b8;
    font-size: 11px;
}

.pagination-info strong {
    color: #475569;
}


/* RESPONSIVE */

@media (max-width: 800px) {

    .sales-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .sales-toolbar {
        align-items: stretch;
        flex-direction: column;
    }

    .sales-search-form {
        max-width: none;
    }

    .sales-count {
        justify-content: space-between;
    }

    .sales-pagination {
        align-items: flex-start;
        flex-direction: column;
    }

}

@media (max-width: 520px) {

    .sales-search-form {
        flex-direction: column;
    }

    .sales-search-button {
        width: 100%;
    }

    .sales-new-button {
        width: 100%;
        justify-content: center;
    }

}

</style>

@endsection