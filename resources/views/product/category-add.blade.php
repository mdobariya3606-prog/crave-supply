<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category ? 'Edit category' : 'Add category' }} — CraveSupply</title>
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    @include('layouts.header')
    <main class="register-container">
        <section class="card" aria-labelledby="add-category-title">
            <header class="card-header">
                <div class="brand-mark" aria-hidden="true">CS</div>
                <p class="brand-name">Catalogue management</p>
                <h1 id="add-category-title">{{ $category ? 'Edit category' : 'Add a category' }}</h1>
                <p>{{ $category ? 'Update the information for this category.' : 'Create a clear grouping for your products.' }}</p>
            </header>
            @if ($errors->any())
                <div class="alert-error" role="alert">Please correct the highlighted fields and try again.</div>
            @endif
            <form action="{{ $category ? route('categories.update', $category) : route('categories.add') }}" method="POST">
                @csrf
                @if ($category)
                    @method('PUT')
                @endif
                <div class="login-fields">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name">Category name <span class="required">*</span></label>

                        {{-- category name --}}
                        <input id="name" name="name" type="text" value="{{ old('name', $category?->name) }}" maxlength="255"
                            required placeholder="Beverages">
                        @error('name')
                            <div class="error-text is-visible"><span>{{ $message }}</span></div>
                        @enderror
                    </div>
                    <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                        <label for="slug">Slug <span class="required">*</span></label>

                        {{-- slug --}}
                        <input id="slug" name="slug" type="text" value="{{ old('slug', $category?->slug) }}" maxlength="255"
                            required placeholder="beverages">
                        @error('slug')
                            <div class="error-text is-visible"><span>{{ $message }}</span></div>
                        @enderror
                    </div>
                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description">Description</label>

                        {{-- description --}}
                        <textarea id="description" name="description" placeholder="A short description">{{ old('description', $category?->description) }}</textarea>
                        @error('description')
                            <div class="error-text is-visible"><span>{{ $message }}</span></div>
                        @enderror
                    </div>
                    <button type="submit" class="btn-submit">{{ $category ? 'Update category' : 'Add category' }}</button>
                </div>
            </form>
        </section>
    </main>
    @include('layouts.footer')
</body>

</html>
