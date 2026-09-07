@extends('layouts.app')

@section('title', 'Sales - NexPOS')
@section('page-title', 'Sales')

@section('content')

<div class="nexpos-page">


    <div class="page-intro">

        <div>

            <span class="page-label">
                TRANSACTION HISTORY
            </span>

            <h2>
                Sales
            </h2>

            <p>
                View and manage completed sales transactions.
            </p>

        </div>


        <a
            href="{{ route('pos') }}"
            class="primary-button"
        >
            + New Sale
        </a>

    </div>


    <section class="dashboard-card">


        <form
            method="GET"
            action="{{ route('sales.index') }}"
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
                    placeholder="Search invoice number..."
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
                        <th>Invoice</th>
                        <th>Customer</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>

                </thead>


                <tbody>

                    @forelse($sales as $sale)

                        <tr>

                            <td>

                                <strong class="invoice-number">
                                    {{ $sale->invoice_number }}
                                </strong>

                            </td>


                            <td>
                                {{ $sale->customer->name ?? 'Walk-in Customer' }}
                            </td>


                            <td>

                                <span class="payment-badge">
                                    {{ ucfirst($sale->payment_method) }}
                                </span>

                            </td>


                            <td>

                                <span class="status-active">
                                    {{ ucfirst($sale->status) }}
                                </span>

                            </td>


                            <td>

                                <strong>
                                    ₱{{ number_format($sale->total, 2) }}
                                </strong>

                            </td>


                            <td>

                                <span class="date-small">
                                    {{ $sale->created_at->format('M d, Y') }}
                                </span>

                                <small class="time-small">
                                    {{ $sale->created_at->format('h:i A') }}
                                </small>

                            </td>


                            <td>

                                <a
                                    href="{{ route('sales.show', $sale) }}"
                                    class="action-edit"
                                >
                                    View
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="empty-table"
                            >

                                <div>
                                    🧾
                                </div>

                                <strong>
                                    No sales found
                                </strong>

                                <p>
                                    Completed transactions will appear here.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        @if($sales->hasPages())

            <div class="pagination-wrapper">
                {{ $sales->links() }}
            </div>

        @endif

    </section>

</div>

@endsection