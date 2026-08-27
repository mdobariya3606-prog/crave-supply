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
                <p>{{ $category ? 'Update the information for this category.' : 'Create a clear grouping for your products.' }}
                </p>
            </header>
            @if (session('error'))
            <div class="alert-error" role="alert">{{ session('error') }}</div>
            @endif
            <form action="{{ $category ? route('categories.update', $category) : route('categories.add') }}"
                method="POST">
                @csrf
                @if ($category)
                @method('PUT')
                @endif
                <div class="login-fields">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name">Category name <span class="required">*</span></label>

                        {{-- category name --}}
                        <div class="input-wrapper"><input id="name" name="name" type="text"
                                value="{{ old('name', $category?->name) }}" maxlength="255" required
                                placeholder="Beverages"><svg class="input-icon" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M4 5h16v14H4z" />
                                <path d="M8 9h8M8 13h6" />
                            </svg></div>
                        @error('name')
                        <div class="error-text is-visible"><span>{{ $message }}</span></div>
                        @enderror
                    </div>
                    <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                        <label for="slug">Slug <span class="required">*</span></label>

                        {{-- slug --}}
                        <div class="input-wrapper"><input id="slug" name="slug" type="text"
                                value="{{ old('slug', $category?->slug) }}" maxlength="255" required
                                placeholder="beverages"><svg class="input-icon" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M10 13a5 5 0 0 0 7.1.1l2-2a5 5 0 0 0-7.1-7.1l-1.2 1.2" />
                                <path d="M14 11a5 5 0 0 0-7.1-.1l-2 2a5 5 0 0 0 7.1 7.1l1.2-1.2" />
                            </svg></div>
                        @error('slug')
                        <div class="error-text is-visible"><span>{{ $message }}</span></div>
                        @enderror
                    </div>
                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description">Description</label>

                        {{-- description --}}
                        <div class="input-wrapper"><textarea id="description" name="description"
                                placeholder="A short description">{{ old('description', $category?->description) }}</textarea><svg
                                class="input-icon input-icon-top" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M5 4h14v16H5z" />
                                <path d="M8 8h8M8 12h8M8 16h5" />
                            </svg></div>
                        @error('description')
                        <div class="error-text is-visible"><span>{{ $message }}</span></div>
                        @enderror
                    </div>
                    <button type="submit"
                        class="btn-submit">{{ $category ? 'Update category' : 'Add category' }}</button>
                </div>
            </form>

            @if($category->products()->count() === 0)
            <form
                action="{{ route('categories.destroy', $category) }}"
                method="POST">
                @csrf
                @method('DELETE')

                <div class="full-width" style="display:flex;gap:10px;flex-wrap:wrap">
                    <button type="submit"
                        onclick="return confirm('Delete this category?')">
                        Delete category
                    </button>
                </div>

            </form>
            @endif
        </section>
    </main>
    @include('layouts.footer')
</body>

</html>