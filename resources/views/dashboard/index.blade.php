@extends('layouts.app')

@section('title', 'Dashboard - NexPOS')
@section('page-title', 'Dashboard')

@section('content')

<div class="nexpos-page">

    {{-- INTRO --}}
    <div class="page-intro">

        <div>
            <span class="page-label">OVERVIEW</span>

            <h2>Dashboard</h2>

            <p>
                Here's what's happening with your business today.
            </p>
        </div>

    </div>


    {{-- STATISTICS --}}
    <div class="stats-grid">

        <div class="stat-card">

            <div class="stat-top">

                <div class="stat-icon blue">
                    ₱
                </div>

                <span class="stat-growth">
                    +12.8%
                </span>

            </div>

            <p>Today's Sales</p>

            <h3>₱54,987.00</h3>

        </div>


        <div class="stat-card">

            <div class="stat-top">

                <div class="stat-icon purple">
                    #
                </div>

            </div>

            <p>Transactions</p>

            <h3>128</h3>

        </div>


        <div class="stat-card">

            <div class="stat-top">

                <div class="stat-icon green">
                    +
                </div>

            </div>

            <p>Products</p>

            <h3>1,248</h3>

        </div>


        <div class="stat-card">

            <div class="stat-top">

                <div class="stat-icon orange">
                    !
                </div>

            </div>

            <p>Low Stock</p>

            <h3>12</h3>

        </div>

    </div>


    {{-- MAIN DASHBOARD --}}
    <div class="dashboard-grid">

        {{-- SALES OVERVIEW --}}
        <section class="dashboard-card">

            <div class="card-header">

                <div>
                    <h3>Sales Overview</h3>

                    <p>
                        Sales performance for the current period
                    </p>
                </div>

                <select class="period-select">
                    <option>This Year</option>
                    <option>This Month</option>
                    <option>This Week</option>
                </select>

            </div>


            <div class="sales-chart">

                @foreach ([35, 52, 42, 68, 58, 82, 72, 92, 76, 88, 65, 96] as $height)

                    <div class="chart-column">

                        <div
                            class="chart-bar"
                            style="height: {{ $height }}%"
                        ></div>

                    </div>

                @endforeach

            </div>


            <div class="chart-labels">

                @foreach ([
                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'May',
                    'Jun',
                    'Jul',
                    'Aug',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dec'
                ] as $month)

                    <span>{{ $month }}</span>

                @endforeach

            </div>

        </section>


        {{-- RECENT SALES --}}
        <section class="dashboard-card">

            <div class="card-header">

                <div>
                    <h3>Recent Sales</h3>

                    <p>
                        Latest completed transactions
                    </p>
                </div>

                <a
                    href="{{ route('pos') }}"
                    class="view-link"
                >
                    View POS
                </a>

            </div>


            <div class="recent-sales">

                @foreach ([
                    ['Laptop Pro', '₱42,999.00'],
                    ['Wireless Headset', '₱2,499.00'],
                    ['Gaming Mouse', '₱1,799.00'],
                    ['Mechanical Keyboard', '₱3,299.00']
                ] as $sale)

                    <div class="sale-row">

                        <div class="sale-product">

                            <div class="sale-icon">
                                📦
                            </div>

                            <div>

                                <strong>
                                    {{ $sale[0] }}
                                </strong>

                                <span>
                                    Completed sale
                                </span>

                            </div>

                        </div>

                        <strong class="sale-price">
                            {{ $sale[1] }}
                        </strong>

                    </div>

                @endforeach

            </div>

        </section>

    </div>


    {{-- QUICK ACTIONS --}}
    <section class="dashboard-card quick-actions">

        <div class="card-header">

            <div>
                <h3>Quick Actions</h3>

                <p>
                    Frequently used functions
                </p>
            </div>

        </div>


        <div class="quick-grid">

            <a
                href="{{ route('pos') }}"
                class="quick-action"
            >

                <span>🛒</span>

                <div>

                    <strong>New Sale</strong>

                    <small>
                        Start a new transaction
                    </small>

                </div>

            </a>


            <a
                href="#"
                class="quick-action"
            >

                <span>📦</span>

                <div>

                    <strong>Products</strong>

                    <small>
                        Manage your products
                    </small>

                </div>

            </a>


            <a
                href="#"
                class="quick-action"
            >

                <span>📊</span>

                <div>

                    <strong>Reports</strong>

                    <small>
                        View business reports
                    </small>

                </div>

            </a>

        </div>

    </section>

</div>

@endsection