@extends('layouts.app')
@section('title', 'Sale Details - NexPOS')
@section('page-title', 'Sale Details')

@section('content')

<div class="nexpos-page">


    <div class="page-intro">

        <div>

            <span class="page-label">
                TRANSACTION
            </span>

            <h2>
                {{ $sale->invoice_number }}
            </h2>

            <p>
                Sale completed on
                {{ $sale->created_at->format('F d, Y h:i A') }}
            </p>

        </div>


        <a
            href="{{ route('sales.index') }}"
            class="secondary-button"
        >
            ← Back to Sales
        </a>

    </div>


    <div class="dashboard-grid">


        {{-- CUSTOMER --}}

        <section class="dashboard-card">

            <div class="card-header">

                <div>

                    <h3>
                        Customer
                    </h3>

                    <p>
                        Customer information
                    </p>

                </div>

            </div>


            <div class="detail-box">

                <strong>
                    {{ $sale->customer->name ?? 'Walk-in Customer' }}
                </strong>

                @if($sale->customer)

                    <span>
                        {{ $sale->customer->email ?? 'No email' }}
                    </span>

                    <span>
                        {{ $sale->customer->phone ?? 'No phone' }}
                    </span>

                @endif

            </div>

        </section>


        {{-- PAYMENT --}}

        <section class="dashboard-card">

            <div class="card-header">

                <div>

                    <h3>
                        Payment
                    </h3>

                    <p>
                        Transaction payment details
                    </p>

                </div>

            </div>


            <div class="detail-box">

                <span>
                    Payment Method
                </span>

                <strong>
                    {{ ucfirst($sale->payment_method) }}
                </strong>

                <span>
                    Status
                </span>

                <strong class="text-success">
                    {{ ucfirst($sale->status) }}
                </strong>

            </div>

        </section>


    </div>


    {{-- ITEMS --}}

    <section class="dashboard-card">


        <div class="card-header">

            <div>

                <h3>
                    Purchased Items
                </h3>

                <p>
                    Products included in this transaction
                </p>

            </div>

        </div>


        <div class="table-wrapper">

            <table class="nexpos-table">

                <thead>

                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>

                </thead>


                <tbody>

                    @foreach($sale->items as $item)

                        <tr>

                            <td>

                                <strong>
                                    {{ $item->product_name }}
                                </strong>

                            </td>


                            <td>
                                {{ $item->quantity }}
                            </td>


                            <td>
                                ₱{{ number_format($item->price, 2) }}
                            </td>


                            <td>

                                <strong>
                                    ₱{{ number_format($item->subtotal, 2) }}
                                </strong>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>


        {{-- TOTALS --}}

        <div class="sale-summary">

            <div>
                <span>Subtotal</span>
                <strong>
                    ₱{{ number_format($sale->subtotal, 2) }}
                </strong>
            </div>


            <div>
                <span>Tax</span>
                <strong>
                    ₱{{ number_format($sale->tax, 2) }}
                </strong>
            </div>


            <div class="sale-total">
                <span>Total</span>
                <strong>
                    ₱{{ number_format($sale->total, 2) }}
                </strong>
            </div>

        </div>

    </section>

</div>

@endsection