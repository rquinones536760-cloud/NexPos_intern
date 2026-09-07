@extends('layouts.app')

@section('title', 'Add Product - NexPOS')
@section('page-title', 'Add Product')

@section('content')

<div class="nexpos-page">

    <div class="page-intro">

        <div>
            <span class="page-label">PRODUCT MANAGEMENT</span>
            <h2>Add Product</h2>
            <p>Create a new product for your inventory.</p>
        </div>

        <a
            href="{{ route('products.index') }}"
            class="secondary-button"
        >
            ← Back
        </a>

    </div>


    <section class="dashboard-card form-card">

        <form
            method="POST"
            action="{{ route('products.store') }}"
        >

            @csrf


            <div class="form-grid">


                <div class="form-group">

                    <label>
                        Product Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="e.g. Wireless Headset"
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
                        SKU
                    </label>

                    <input
                        type="text"
                        name="sku"
                        value="{{ old('sku') }}"
                        placeholder="e.g. WH-001"
                        required
                    >

                    @error('sku')
                        <small class="form-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                <div class="form-group">

                    <label>
                        Category
                    </label>

                    <input
                        type="text"
                        name="category"
                        value="{{ old('category') }}"
                        placeholder="e.g. Electronics"
                    >

                </div>


                <div class="form-group">

                    <label>
                        Unit
                    </label>

                    <select name="unit">

                        <option value="piece">
                            Piece
                        </option>

                        <option value="box">
                            Box
                        </option>

                        <option value="pack">
                            Pack
                        </option>

                        <option value="kg">
                            Kilogram
                        </option>

                        <option value="liter">
                            Liter
                        </option>

                    </select>

                </div>


                <div class="form-group">

                    <label>
                        Price
                    </label>

                    <input
                        type="number"
                        name="price"
                        value="{{ old('price') }}"
                        step="0.01"
                        min="0"
                        placeholder="0.00"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>
                        Initial Stock
                    </label>

                    <input
                        type="number"
                        name="stock"
                        value="{{ old('stock', 0) }}"
                        min="0"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>
                        Low Stock Limit
                    </label>

                    <input
                        type="number"
                        name="low_stock_limit"
                        value="{{ old('low_stock_limit', 5) }}"
                        min="0"
                        required
                    >

                </div>


                <div class="form-group form-full">

                    <label>
                        Description
                    </label>

                    <textarea
                        name="description"
                        rows="5"
                        placeholder="Product description..."
                    >{{ old('description') }}</textarea>

                </div>


            </div>


            <div class="form-footer">

                <a
                    href="{{ route('products.index') }}"
                    class="secondary-button"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="primary-button"
                >
                    Save Product
                </button>

            </div>

        </form>

    </section>

</div>

@endsection