
@extends('layouts.app')

@section('title', 'Customers - NexPOS')
@section('page-title', 'Customers')

@section('content')

<div class="nexpos-page">


    <div class="page-intro">

        <div>

            <span class="page-label">
                CUSTOMER MANAGEMENT
            </span>

            <h2>
                Customers
            </h2>

            <p>
                Manage your customers and their purchase history.
            </p>

        </div>


        <a
            href="{{ route('customers.create') }}"
            class="primary-button"
        >
            + Add Customer
        </a>

    </div>


    @if(session('success'))

        <div class="alert-success">
            ✓ {{ session('success') }}
        </div>

    @endif


    <section class="dashboard-card">


        <form
            method="GET"
            action="{{ route('customers.index') }}"
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
                    placeholder="Search customers..."
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
                        <th>Customer</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Orders</th>
                        <th>Total Spent</th>
                        <th>Action</th>
                    </tr>

                </thead>


                <tbody>

                    @forelse($customers as $customer)

                        <tr>

                            <td>

                                <div class="table-product">

                                    <div class="customer-avatar">
                                        {{ strtoupper(substr($customer->name, 0, 1)) }}
                                    </div>

                                    <div>

                                        <strong>
                                            {{ $customer->name }}
                                        </strong>

                                        <small>
                                            Customer #{{ $customer->id }}
                                        </small>

                                    </div>

                                </div>

                            </td>


                            <td>
                                {{ $customer->email ?? '—' }}
                            </td>


                            <td>
                                {{ $customer->phone ?? '—' }}
                            </td>


                            <td>
                                {{ number_format($customer->total_orders) }}
                            </td>


                            <td>

                                <strong>
                                    ₱{{ number_format($customer->total_spent, 2) }}
                                </strong>

                            </td>


                            <td>

                                <div class="table-actions">

                                    <a
                                        href="{{ route('customers.edit', $customer) }}"
                                        class="action-edit"
                                    >
                                        Edit
                                    </a>


                                    <form
                                        method="POST"
                                        action="{{ route('customers.destroy', $customer) }}"
                                        onsubmit="return confirm('Delete this customer?')"
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
                                colspan="6"
                                class="empty-table"
                            >

                                <div>
                                    👥
                                </div>

                                <strong>
                                    No customers found
                                </strong>

                                <p>
                                    Add your first customer to get started.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        @if($customers->hasPages())

            <div class="pagination-wrapper">
                {{ $customers->links() }}
            </div>

        @endif

    </section>

</div>

@endsection
