<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit {{ $product->name }} — CraveSupply</title>
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <style>
        .field-error {
            display: block;
            margin-top: 6px;
            color: #b42318;
            font-size: 12px;
        }
    </style>
</head>

<body>
    @include ('layouts.header')
    <main class="register-container">
        <section class="card" aria-labelledby="edit-product-title">
            <header class="card-header">
                <p class="brand-name">Product catalogue</p>
                <h1 id="edit-product-title">Edit product</h1>
                <p>Update the details, availability, and product images.</p>
            </header>
            {{-- Product details are submitted together; validation messages stay beside their fields. --}}
            <form
                action="{{ route('products.update', $product) }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf
                @method ('PUT')
                <div class="form-grid">
                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <div class="input-wrapper">
                            <select
                                id="category_id"
                                name="category_id"
                                required
                            >
                                @foreach ($categories as $category)
                                    <option
                                        value="{{ $category->id }}"
                                        @selected (old('category_id', $product->category_id) == $category->id)
                                    >
                                        {{ $category->name }}
                                    </option>
                                @endforeach</select
                            ><svg class="input-icon" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M4 7h16M6 7v13h12V7M9 4h6l1 3H8l1-3Z" />
                                <path d="M9 11h6M9 15h6" />
                            </svg>
                        </div>
                        @error ('category_id')
                            <small class="field-error">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Product name</label>
                        <div class="input-wrapper">
                            <input
                                id="name"
                                name="name"
                                value="{{ old('name', $product->name) }}"
                                required
                            /><svg
                                class="input-icon"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path d="M4 5h16v14H4z" />
                                <path d="M8 9h8M8 13h6" />
                            </svg>
                        </div>
                        @error ('name')
                            <small class="field-error">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="sku">SKU</label>
                        <div class="input-wrapper">
                            <input
                                id="sku"
                                name="sku"
                                value="{{ old('sku', $product->sku) }}"
                            /><svg
                                class="input-icon"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path d="m4 7 5-3 11 6v6l-5 3L4 13V7Z" />
                                <path d="m8 8 8 5M8 12l4 2" />
                            </svg>
                        </div>
                        @error ('sku')
                            <small class="field-error">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <div class="input-wrapper">
                            <input
                                id="slug"
                                name="slug"
                                value="{{ old('slug', $product->slug) }}"
                                required
                            /><svg
                                class="input-icon"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path d="M10 13a5 5 0 0 0 7.1.1l2-2a5 5 0 0 0-7.1-7.1l-1.2 1.2" />
                                <path d="M14 11a5 5 0 0 0-7.1-.1l-2 2a5 5 0 0 0 7.1 7.1l1.2-1.2" />
                            </svg>
                        </div>
                        @error ('slug')
                            <small class="field-error">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <div class="input-wrapper">
                            <input
                                id="price"
                                name="price"
                                type="number"
                                min="0"
                                step="0.01"
                                value="{{ old('price', $product->price) }}"
                                required
                            /><svg
                                class="input-icon"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <circle cx="12" cy="12" r="8" />
                                <path
                                    d="M14.5 9.5c-.5-.7-1.3-1-2.5-1-1.3 0-2 .6-2 1.4 0 2.2 4.5 1 4.5 3.1 0 .9-.8 1.5-2.2 1.5-1.2 0-2-.4-2.6-1.1"
                                />
                                <path d="M12 7v10" />
                            </svg>
                        </div>
                        @error ('price')
                            <small class="field-error">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock quantity</label>
                        <div class="input-wrapper">
                            <input
                                id="stock"
                                name="stock"
                                type="number"
                                min="0"
                                value="{{ old('stock', $product->stock) }}"
                                required
                            /><svg
                                class="input-icon"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path d="M4 8h16v12H4zM4 8l4-4h8l4 4" />
                                <path d="M8 12h8M8 16h5" />
                            </svg>
                        </div>
                        @error ('stock')
                            <small class="field-error">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group full-width">
                        <label for="description">Description</label>
                        <div class="input-wrapper">
                            <textarea
                                id="description"
                                name="description"
                                rows="5"
                                >{{ old('description', $product->description) }}</textarea
                            ><svg
                                class="input-icon input-icon-top"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path d="M5 4h14v16H5z" />
                                <path d="M8 8h8M8 12h8M8 16h5" />
                            </svg>
                        </div>
                        @error ('description')
                            <small class="field-error">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group full-width">
                        <label for="images">Add product images</label
                        ><input
                            id="images"
                            name="images[]"
                            type="file"
                            accept="image/jpeg,image/png,image/webp"
                            multiple
                        /><small
                            >Up to 8 images per upload. Maximum 5 MB per
                            image.</small
                        ><small
                            id="images-size-error"
                            class="field-error"
                            role="alert"
                            hidden
                        ></small>
                        @error ('images')
                            <small class="field-error">{{ $message }}</small>
                        @enderror
                        @error ('images.*')
                            <small class="field-error">{{ $message }}</small>
                        @enderror
                    </div>
                    @if ($product->productImages->isNotEmpty())
                        <div class="form-group full-width">
                            <label>Current images — choose primary</label>
                            <div
                                style="
                                    display: flex;
                                    gap: 12px;
                                    flex-wrap: wrap;
                                "
                            >
                                @foreach ($product->productImages as $image)
                                    <label style="width: 120px"
                                        ><img
                                            src="{{ asset('storage/' . $image->image_path) }}"
                                            style="
                                                width: 120px;
                                                height: 90px;
                                                object-fit: cover;
                                                border-radius: 8px;
                                            "
                                        /><input
                                            type="radio"
                                            name="primary_image"
                                            value="{{ $image->id }}"
                                            @checked ($image->is_primary)
                                        />
                                        Primary
                                        <button
                                            type="submit"
                                            form="delete-image-{{ $image->id }}"
                                            style="color: #991b1b"
                                        >
                                            Remove
                                        </button></label
                                    >
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <div class="form-group full-width">
                        <label class="remember-option" for="is_available"
                            ><input
                                id="is_available"
                                name="is_available"
                                type="checkbox"
                                value="1"
                                @checked (old('is_available', $product->is_available))
                            />
                            Product is available for purchase</label
                        >
                    </div>
                    <div
                        class="full-width"
                        style="display: flex; gap: 10px; flex-wrap: wrap"
                    >
                        <button type="submit" class="btn-submit">
                            Save changes
                        </button>
                        <button
                            type="submit"
                            form="delete-product"
                            style="background: #a04338"
                            onclick="return confirm('Delete this product?');"
                        >
                            Delete product
                        </button>
                    </div>
                </div>
            </form>
            @foreach ($product->productImages as $image)
                <form
                    id="delete-image-{{ $image->id }}"
                    action="{{ route('products.images.destroy', $image) }}"
                    method="POST"
                >
                    @csrf
                    @method ('DELETE')
                </form>
            @endforeach
            <form
                id="delete-product"
                action="{{ route('products.destroy', $product) }}"
                method="POST"
            >
                @csrf
                @method ('DELETE')
            </form>
        </section>
    </main>
    @include ('layouts.footer')
    <script>
        (() => {
            const form = document.querySelector(
                'form[enctype="multipart/form-data"]',
            );
            const imageInput = document.getElementById("images");
            const sizeError = document.getElementById("images-size-error");
            const maxImageSize = 5 * 1024 * 1024;

            if (!form || !imageInput || !sizeError) return;

            const validateImageSizes = () => {
                const oversized = [...imageInput.files].filter(
                    (file) => file.size > maxImageSize,
                );
                sizeError.hidden = oversized.length === 0;
                sizeError.textContent = oversized.length
                    ? `${oversized.length} image${oversized.length === 1 ? "" : "s"} exceed the 5 MB limit. Please choose smaller files.`
                    : "";
                return oversized.length === 0;
            };

            imageInput.addEventListener("change", validateImageSizes);
            form.addEventListener("submit", (event) => {
                if (!validateImageSizes()) event.preventDefault();
            });
        })();
    </script>
</body>
</html>
