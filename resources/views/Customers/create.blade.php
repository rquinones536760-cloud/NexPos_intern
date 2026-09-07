@extends('layouts.app')

@section('title', 'Add Customer - NexPOS')
@section('page-title', 'Add Customer')

@section('content')

<div class="nexpos-page">

    <div class="page-intro">

        <div>
            <span class="page-label">
                CUSTOMER MANAGEMENT
            </span>

            <h2>
                Add Customer
            </h2>

            <p>
                Create a new customer profile.
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
            action="{{ route('customers.store') }}"
        >

            @csrf


            <div class="form-grid">


                <div class="form-group">

                    <label>
                        Full Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Juan Dela Cruz"
                        required
                    >

                    @error('name')
                        <small class="form-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                <div class="form-group">

                    <label>
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="customer@email.com"
                    >

                    @error('email')
                        <small class="form-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                <div class="form-group">

                    <label>
                        Phone
                    </label>

                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone') }}"
                        placeholder="09XXXXXXXXX"
                    >

                </div>


                <div class="form-group form-full">

                    <label>
                        Address
                    </label>

                    <textarea
                        name="address"
                        rows="5"
                        placeholder="Customer address..."
                    >{{ old('address') }}</textarea>

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
                    Save Customer
                </button>

            </div>

        </form>

    </section>

</div>

@endsection