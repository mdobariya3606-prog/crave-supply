<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add product — CraveSupply</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    @include('layouts.header')
    <main class="register-container">
        <section class="card" aria-labelledby="add-product-title">
            <header class="card-header">
                <div class="brand-mark" aria-hidden="true">CS</div>
                <p class="brand-name">Product catalogue</p>
                <h1 id="add-product-title">Add a product</h1>
                <p>Enter the product details below to add it to your catalogue.</p>
            </header>

            @if (session('success'))
                <div class="form-status alert-success" role="status">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert-error" role="alert">Please correct the highlighted fields and try again.</div>
            @endif

            <form action="{{ route('products.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-grid">
                    <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                        <label for="category_id">Category <span class="required">*</span></label>
                        <select id="category_id" name="category_id" required>
                            <option value="">Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')<div class="error-text is-visible"><span>{{ $message }}</span></div>@enderror
                    </div>

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name">Product name <span class="required">*</span></label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" maxlength="255"
                            required placeholder="Premium coffee beans">
                        @error('name')<div class="error-text is-visible"><span>{{ $message }}</span></div>@enderror
                    </div>

                    <div class="form-group{{ $errors->has('sku') ? ' has-error' : '' }}">
                        <label for="sku">SKU</label>
                        <input id="sku" name="sku" type="text" value="{{ old('sku') }}" maxlength="255"
                            placeholder="COF-001">
                        @error('sku')<div class="error-text is-visible"><span>{{ $message }}</span></div>@enderror
                    </div>

                    <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                        <label for="slug">Slug <span class="required">*</span></label>
                        <input id="slug" name="slug" type="text" value="{{ old('slug') }}" maxlength="255"
                            required placeholder="premium-coffee-beans">
                        @error('slug')<div class="error-text is-visible"><span>{{ $message }}</span></div>@enderror
                    </div>

                    <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                        <label for="price">Price <span class="required">*</span></label>
                        <input id="price" name="price" type="number" value="{{ old('price') }}" min="0"
                            step="0.01" required placeholder="0.00">
                        @error('price')<div class="error-text is-visible"><span>{{ $message }}</span></div>@enderror
                    </div>

                    <div class="form-group{{ $errors->has('stock') ? ' has-error' : '' }}">
                        <label for="stock">Stock quantity <span class="required">*</span></label>
                        <input id="stock" name="stock" type="number" value="{{ old('stock', 0) }}" min="0"
                            step="1" required>
                        @error('stock')<div class="error-text is-visible"><span>{{ $message }}</span></div>@enderror
                    </div>

                    <div class="form-group full-width{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" rows="5"
                            placeholder="Describe the product...">{{ old('description') }}</textarea>
                        @error('description')<div class="error-text is-visible"><span>{{ $message }}</span></div>@enderror
                    </div>

                    <div class="form-group full-width{{ $errors->has('images') ? ' has-error' : '' }}">
                        <label for="images">Product images</label>
                        <input id="images" name="images[]" type="file" accept="image/jpeg,image/png,image/webp" multiple>
                        <small>Upload up to 8 images. The first image becomes the primary image.</small>
                        @error('images')<div class="error-text is-visible"><span>{{ $message }}</span></div>@enderror
                        @error('images.*')<div class="error-text is-visible"><span>{{ $message }}</span></div>@enderror
                    </div>

                    <div class="form-group full-width">
                        <label class="remember-option" for="is_available">
                            <input id="is_available" name="is_available" type="checkbox" value="1"
                                @checked(old('is_available', true))>
                            Product is available for purchase
                        </label>
                    </div>

                    <div class="full-width">
                        <button type="submit" class="btn-submit">Add product</button>
                    </div>
                </div>
            </form>
        </section>
    </main>
    @include('layouts.footer')
</body>

</html>
