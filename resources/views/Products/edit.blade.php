@extends('layouts.app')

@section('title', 'Edit Product - NexPOS')
@section('page-title', 'Edit Product')

@section('content')

<div class="nexpos-page">

    <div class="page-intro">

        <div>
            <span class="page-label">PRODUCT MANAGEMENT</span>
            <h2>Edit Product</h2>
            <p>Update product information and inventory settings.</p>
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
            action="{{ route('products.update', $product) }}"
        >

            @csrf
            @method('PUT')


            <div class="form-grid">


                <div class="form-group">

                    <label>
                        Product Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $product->name) }}"
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
                        value="{{ old('sku', $product->sku) }}"
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
                        value="{{ old('category', $product->category) }}"
                    >

                </div>


                <div class="form-group">

                    <label>
                        Unit
                    </label>

                    <select name="unit">

                        @foreach(['piece','box','pack','kg','liter'] as $unit)

                            <option
                                value="{{ $unit }}"
                                @selected(old('unit', $product->unit) === $unit)
                            >
                                {{ ucfirst($unit) }}
                            </option>

                        @endforeach

                    </select>

                </div>


                <div class="form-group">

                    <label>
                        Price
                    </label>

                    <input
                        type="number"
                        name="price"
                        value="{{ old('price', $product->price) }}"
                        step="0.01"
                        min="0"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>
                        Stock
                    </label>

                    <input
                        type="number"
                        name="stock"
                        value="{{ old('stock', $product->stock) }}"
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
                        value="{{ old('low_stock_limit', $product->low_stock_limit) }}"
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
                    >{{ old('description', $product->description) }}</textarea>

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
                    Update Product
                </button>

            </div>

        </form>

    </section>

</div>

@endsection
