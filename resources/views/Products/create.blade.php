@extends('layouts.app')

@section('title', 'Add Product - NexPOS')
@section('page-title', 'Add Product')

@section('content')

<div class="nexpos-page">

    {{-- PAGE HEADER --}}
    <div class="page-intro">

        <div>
            <span class="page-label">PRODUCT MANAGEMENT</span>
            <h2>Add Product</h2>
            <p>Create a new product for your inventory.</p>
        </div>

        <a href="{{ route('products.index') }}" class="secondary-button">
            ← Back
        </a>

    </div>


    {{-- FORM CARD --}}
    <section class="dashboard-card form-card">

        <form
            method="POST"
            action="{{ route('products.store') }}"
            enctype="multipart/form-data"
        >

            @csrf

            <div class="form-grid">

                {{-- PRODUCT IMAGE --}}
                <div class="form-group form-full">

                    <label>Product Image</label>

                    <div
                        class="product-image-upload"
                        id="productImageUpload"
                    >

                        <input
                            type="file"
                            name="image"
                            id="productImage"
                            accept="image/jpeg,image/png,image/webp"
                            hidden
                        >

                        {{-- UPLOAD PLACEHOLDER --}}
                        <div
                            class="image-upload-placeholder"
                            id="imageUploadPlaceholder"
                        >

                            <div class="image-upload-icon">
                                +
                            </div>

                            <strong>
                                Upload Product Image
                            </strong>

                            <span>
                                Click to browse or drag and drop
                            </span>

                            <small>
                                JPG, PNG or WEBP · Maximum 2MB
                            </small>

                        </div>


                        {{-- IMAGE PREVIEW --}}
                        <div
                            class="image-preview-wrapper"
                            id="imagePreviewWrapper"
                            hidden
                        >

                            <img
                                id="imagePreview"
                                src=""
                                alt="Product preview"
                            >

                            <div class="image-preview-actions">

                                <button
                                    type="button"
                                    id="changeImageButton"
                                    class="image-action-button"
                                >
                                    Change Image
                                </button>

                                <button
                                    type="button"
                                    id="removeImageButton"
                                    class="image-action-button danger"
                                >
                                    Remove
                                </button>

                            </div>

                        </div>

                    </div>

                    @error('image')
                        <small class="form-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- PRODUCT NAME --}}
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


                {{-- SKU --}}
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


                {{-- BARCODE --}}
                <div class="form-group">

                    <label>
                        Barcode
                    </label>

                    <input
                        type="text"
                        name="barcode"
                        value="{{ old('barcode') }}"
                        placeholder="Optional barcode"
                    >

                </div>


                {{-- CATEGORY --}}
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


                {{-- UNIT --}}
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


                {{-- PRICE --}}
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

                    @error('price')
                        <small class="form-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- COST --}}
                <div class="form-group">

                    <label>
                        Cost
                    </label>

                    <input
                        type="number"
                        name="cost"
                        value="{{ old('cost', 0) }}"
                        step="0.01"
                        min="0"
                        placeholder="0.00"
                    >

                </div>


                {{-- INITIAL STOCK --}}
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


                {{-- LOW STOCK LIMIT --}}
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


                {{-- DESCRIPTION --}}
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


            {{-- FORM FOOTER --}}
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


{{-- IMAGE PREVIEW SCRIPT --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const uploadArea = document.getElementById('productImageUpload');
    const fileInput = document.getElementById('productImage');

    const placeholder = document.getElementById(
        'imageUploadPlaceholder'
    );

    const previewWrapper = document.getElementById(
        'imagePreviewWrapper'
    );

    const preview = document.getElementById('imagePreview');

    const changeButton = document.getElementById(
        'changeImageButton'
    );

    const removeButton = document.getElementById(
        'removeImageButton'
    );


    function showPreview(file) {

        if (!file) {
            return;
        }

        const allowedTypes = [
            'image/jpeg',
            'image/png',
            'image/webp'
        ];

        if (!allowedTypes.includes(file.type)) {

            alert('Please select a JPG, PNG, or WEBP image.');

            fileInput.value = '';

            return;
        }


        if (file.size > 2 * 1024 * 1024) {

            alert('Image size must not exceed 2MB.');

            fileInput.value = '';

            return;
        }


        const reader = new FileReader();

        reader.onload = function (event) {

            preview.src = event.target.result;

            placeholder.hidden = true;
            previewWrapper.hidden = false;

        };

        reader.readAsDataURL(file);
    }


    uploadArea.addEventListener('click', function (event) {

        if (
            event.target.closest('#changeImageButton') ||
            event.target.closest('#removeImageButton')
        ) {
            return;
        }

        fileInput.click();

    });


    fileInput.addEventListener('change', function () {

        const file = this.files[0];

        showPreview(file);

    });


    changeButton.addEventListener('click', function (event) {

        event.stopPropagation();

        fileInput.click();

    });


    removeButton.addEventListener('click', function (event) {

        event.stopPropagation();

        fileInput.value = '';

        preview.src = '';

        previewWrapper.hidden = true;
        placeholder.hidden = false;

    });


    /*
    |--------------------------------------------------------------------------
    | Drag & Drop
    |--------------------------------------------------------------------------
    */

    uploadArea.addEventListener('dragover', function (event) {

        event.preventDefault();

        uploadArea.classList.add('dragging');

    });


    uploadArea.addEventListener('dragleave', function () {

        uploadArea.classList.remove('dragging');

    });


    uploadArea.addEventListener('drop', function (event) {

        event.preventDefault();

        uploadArea.classList.remove('dragging');

        const file = event.dataTransfer.files[0];

        if (!file) {
            return;
        }

        fileInput.files = event.dataTransfer.files;

        showPreview(file);

    });

});
</script>

@endsection