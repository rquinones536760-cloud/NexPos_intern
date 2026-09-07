@extends('layouts.app')

@section('title', 'Edit Customer - NexPOS')
@section('page-title', 'Edit Customer')

@section('content')

<div class="nexpos-page">

    <div class="page-intro">

        <div>
            <span class="page-label">
                CUSTOMER MANAGEMENT
            </span>

            <h2>
                Edit Customer
            </h2>

            <p>
                Update customer information.
            </p>

        </div>


        <a
            href="{{ route('customers.index') }}"
            class="secondary-button"
        >
            ← Back
        </a>

    </div>


    <section class="dashboard-card form-card">

        <form
            method="POST"
            action="{{ route('customers.update', $customer) }}"
        >

            @csrf
            @method('PUT')


            <div class="form-grid">


                <div class="form-group">

                    <label>
                        Full Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $customer->name) }}"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', $customer->email) }}"
                    >

                </div>


                <div class="form-group">

                    <label>
                        Phone
                    </label>

                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone', $customer->phone) }}"
                    >

                </div>


                <div class="form-group form-full">

                    <label>
                        Address
                    </label>

                    <textarea
                        name="address"
                        rows="5"
                    >{{ old('address', $customer->address) }}</textarea>

                </div>


            </div>


            <div class="form-footer">

                <a
                    href="{{ route('customers.index') }}"
                    class="secondary-button"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="primary-button"
                >
                    Update Customer
                </button>

            </div>

        </form>

    </section>

</div>

@endsection
