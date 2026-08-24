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
                        <div class="input-wrapper">
                            <select id="category_id" name="category_id" required>
                                <option value="">Select a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <svg class="input-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 7h16M6 7v13h12V7M9 4h6l1 3H8l1-3Z"/><path d="M9 11h6M9 15h6"/></svg>
                        </div>
                        @error('category_id')<div class="error-text is-visible"><span>{{ $message }}</span></div>@enderror
                    </div>

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name">Product name <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <input id="name" name="name" type="text" value="{{ old('name') }}" maxlength="255"
                                required placeholder="Premium coffee beans">
                            <svg class="input-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 5h16v14H4z"/><path d="M8 9h8M8 13h6"/></svg>
                        </div>
                        @error('name')<div class="error-text is-visible"><span>{{ $message }}</span></div>@enderror
                    </div>

                    <div class="form-group{{ $errors->has('sku') ? ' has-error' : '' }}">
                        <label for="sku">SKU</label>
                        <div class="input-wrapper">
                            <input id="sku" name="sku" type="text" value="{{ old('sku') }}" maxlength="255"
                                placeholder="COF-001">
                            <svg class="input-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="m4 7 5-3 11 6v6l-5 3L4 13V7Z"/><path d="m8 8 8 5M8 12l4 2"/></svg>
                        </div>
                        @error('sku')<div class="error-text is-visible"><span>{{ $message }}</span></div>@enderror
                    </div>

                    <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                        <label for="slug">Slug <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <input id="slug" name="slug" type="text" value="{{ old('slug') }}" maxlength="255"
                                required placeholder="premium-coffee-beans">
                            <svg class="input-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M10 13a5 5 0 0 0 7.1.1l2-2a5 5 0 0 0-7.1-7.1l-1.2 1.2"/><path d="M14 11a5 5 0 0 0-7.1-.1l-2 2a5 5 0 0 0 7.1 7.1l1.2-1.2"/></svg>
                        </div>
                        @error('slug')<div class="error-text is-visible"><span>{{ $message }}</span></div>@enderror
                    </div>

                    <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                        <label for="price">Price <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <input id="price" name="price" type="number" value="{{ old('price') }}" min="0"
                                step="0.01" required placeholder="0.00">
                            <svg class="input-icon" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="8"/><path d="M14.5 9.5c-.5-.7-1.3-1-2.5-1-1.3 0-2 .6-2 1.4 0 2.2 4.5 1 4.5 3.1 0 .9-.8 1.5-2.2 1.5-1.2 0-2-.4-2.6-1.1"/><path d="M12 7v10"/></svg>
                        </div>
                        @error('price')<div class="error-text is-visible"><span>{{ $message }}</span></div>@enderror
                    </div>

                    <div class="form-group{{ $errors->has('stock') ? ' has-error' : '' }}">
                        <label for="stock">Stock quantity <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <input id="stock" name="stock" type="number" value="{{ old('stock', 0) }}" min="0"
                                step="1" required>
                            <svg class="input-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 8h16v12H4zM4 8l4-4h8l4 4"/><path d="M8 12h8M8 16h5"/></svg>
                        </div>
                        @error('stock')<div class="error-text is-visible"><span>{{ $message }}</span></div>@enderror
                    </div>

                    <div class="form-group full-width{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description">Description</label>
                        <div class="input-wrapper">
                            <textarea id="description" name="description" rows="5"
                                placeholder="Describe the product...">{{ old('description') }}</textarea>
                            <svg class="input-icon input-icon-top" viewBox="0 0 24 24" aria-hidden="true"><path d="M5 4h14v16H5z"/><path d="M8 8h8M8 12h8M8 16h5"/></svg>
                        </div>
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
