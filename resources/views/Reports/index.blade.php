@extends('layouts.app')

@section('title', 'Reports - NexPOS')
@section('page-title', 'Reports')

@section('content')

<div class="nexpos-page">

    <div class="page-intro">

        <div>

            <span class="page-label">
                BUSINESS ANALYTICS
            </span>

            <h2>
                Reports
            </h2>

            <p>
                Overview of your sales and inventory performance.
            </p>

        </div>

    </div>


    {{-- SALES STATISTICS --}}

    <div class="stats-grid">

        <div class="stat-card">

            <div class="stat-top">

                <div class="stat-icon green">
                    ₱
                </div>

            </div>

            <p>Total Sales</p>

            <h3>
                ₱{{ number_format($totalSales, 2) }}
            </h3>

        </div>


        <div class="stat-card">

            <div class="stat-top">

                <div class="stat-icon blue">
                    #
                </div>

            </div>

            <p>Total Transactions</p>

            <h3>
                {{ number_format($totalTransactions) }}
            </h3>

        </div>


        <div class="stat-card">

            <div class="stat-top">

                <div class="stat-icon orange">
                    ₱
                </div>

            </div>

            <p>Today's Sales</p>

            <h3>
                ₱{{ number_format($todaySales, 2) }}
            </h3>

        </div>


        <div class="stat-card">

            <div class="stat-top">

                <div class="stat-icon purple">
                    ₱
                </div>

            </div>

            <p>Average Sale</p>

            <h3>
                ₱{{ number_format($averageSale, 2) }}
            </h3>

        </div>

    </div>


    {{-- SECONDARY STATISTICS --}}

    <div class="dashboard-grid">

        <section class="dashboard-card">

            <div class="card-header">

                <div>

                    <h3>
                        Sales Summary
                    </h3>

                    <p>
                        Current sales performance
                    </p>

                </div>

            </div>


            <div class="detail-box">

                <span>
                    Today's Transactions
                </span>

                <strong>
                    {{ number_format($todayTransactions) }}
                </strong>


                <span>
                    Sales This Month
                </span>

                <strong>
                    ₱{{ number_format($monthlySales, 2) }}
                </strong>


                <span>
                    Total Transactions
                </span>

                <strong>
                    {{ number_format($totalTransactions) }}
                </strong>

            </div>

        </section>


        <section class="dashboard-card">

            <div class="card-header">

                <div>

                    <h3>
                        Inventory Summary
                    </h3>

                    <p>
                        Current inventory status
                    </p>

                </div>

            </div>


            <div class="detail-box">

                <span>
                    Total Products
                </span>

                <strong>
                    {{ number_format($totalProducts) }}
                </strong>


                <span>
                    Total Stock
                </span>

                <strong>
                    {{ number_format($totalStock) }}
                </strong>

            </div>

        </section>

    </div>


    {{-- RECENT SALES --}}

    <section class="dashboard-card">

        <div class="card-header">

            <div>

                <h3>
                    Recent Sales
                </h3>

                <p>
                    Latest completed transactions
                </p>

            </div>

            <a
                href="{{ route('sales.index') }}"
                class="secondary-button"
            >
                View All Sales
            </a>

        </div>


        <div class="table-wrapper">

            <table class="nexpos-table">

                <thead>

                    <tr>
                        <th>Invoice</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Paid</th>
                        <th>Change</th>
                        <th>Date</th>
                    </tr>

                </thead>


                <tbody>

                    @forelse($recentSales as $sale)

                        <tr>

                            <td>

                                <strong class="invoice-number">
                                    {{ $sale->invoice_no }}
                                </strong>

                            </td>


                            <td>
                                {{ $sale->customer->name ?? 'Walk-in Customer' }}
                            </td>


                            <td>

                                <strong>
                                    ₱{{ number_format($sale->total, 2) }}
                                </strong>

                            </td>


                            <td>
                                ₱{{ number_format($sale->paid, 2) }}
                            </td>


                            <td>
                                ₱{{ number_format($sale->change, 2) }}
                            </td>


                            <td>

                                <span class="date-small">
                                    {{ $sale->created_at->format('M d, Y') }}
                                </span>

                                <small class="time-small">
                                    {{ $sale->created_at->format('h:i A') }}
                                </small>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="empty-table"
                            >

                                <div>
                                    📊
                                </div>

                                <strong>
                                    No sales data available
                                </strong>

                                <p>
                                    Sales reports will appear here once transactions are recorded.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </section>

</div>

@endsection