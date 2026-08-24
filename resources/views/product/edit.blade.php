<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit {{ $product->name }} — CraveSupply</title>
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    @include('layouts.header')
    <main class="register-container">
        <section class="card" aria-labelledby="edit-product-title">
            <header class="card-header">
                <p class="brand-name">Product catalogue</p>
                <h1 id="edit-product-title">Edit product</h1>
                <p>Update the details, availability, and product images.</p>
            </header>
            @if ($errors->any())
            <div class="alert-error" role="alert">Please correct the highlighted fields and try again.</div>
            @endif
            <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="form-grid">
                    <div class="form-group"><label for="category_id">Category</label><select id="category_id"
                            name="category_id" required>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group"><label for="name">Product name</label><input id="name"
                            name="name" value="{{ old('name', $product->name) }}" required></div>
                    <div class="form-group"><label for="sku">SKU</label><input id="sku" name="sku"
                            value="{{ old('sku', $product->sku) }}"></div>
                    <div class="form-group"><label for="slug">Slug</label><input id="slug" name="slug"
                            value="{{ old('slug', $product->slug) }}" required></div>
                    <div class="form-group"><label for="price">Price</label><input id="price" name="price"
                            type="number" min="0" step="0.01" value="{{ old('price', $product->price) }}"
                            required></div>
                    <div class="form-group"><label for="stock">Stock quantity</label><input id="stock"
                            name="stock" type="number" min="0" value="{{ old('stock', $product->stock) }}"
                            required></div>
                    <div class="form-group full-width"><label for="description">Description</label>
                        <textarea id="description" name="description" rows="5">{{ old('description', $product->description) }}</textarea>
                    </div>
                    <div class="form-group full-width"><label for="images">Add product images</label><input
                            id="images" name="images[]" type="file" accept="image/jpeg,image/png,image/webp"
                            multiple><small>Up to 8 images per upload.</small></div>
                    @if ($product->productImages->isNotEmpty())
                    <div class="form-group full-width"><label>Current images — choose primary</label>
                        <div style="display:flex;gap:12px;flex-wrap:wrap">
                            @foreach ($product->productImages as $image)
                            <label style="width:120px"><img src="{{ asset('storage/' . $image->image_path) }}"
                                    style="width:120px;height:90px;object-fit:cover;border-radius:8px"><input
                                    type="radio" name="primary_image" value="{{ $image->id }}"
                                    @checked($image->is_primary)> Primary <button type="submit"
                                    form="delete-image-{{ $image->id }}"
                                    style="color:#991b1b">Remove</button></label>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    <div class="form-group full-width"><label class="remember-option" for="is_available"><input
                                id="is_available" name="is_available" type="checkbox" value="1"
                                @checked(old('is_available', $product->is_available))> Product is available for purchase</label></div>
                    <div class="full-width"><button type="submit" class="btn-submit">Save changes</button></div>
                </div>
            </form>
            @foreach ($product->productImages as $image)
            <form id="delete-image-{{ $image->id }}" action="{{ route('products.images.destroy', $image) }}"
                method="POST">@csrf @method('DELETE')</form>
            @endforeach
        </section>
    </main>
    @include('layouts.footer')
</body>

</html>
