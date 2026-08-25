# CraveSupply Codebase Guide

## Main directories

- `app/Models` — Eloquent models and database relationships.
- `app/Http/Controllers` — Request handling and page actions, grouped by feature.
- `app/Http/Requests` — Validation and authorization rules for submitted forms.
- `resources/views` — Blade templates. Shared page pieces live in `resources/views/layouts`.
- `resources/css` — Source CSS used by the frontend build.
- `public/css` — CSS served directly by the application, including shared layout styles.
- `routes` — URL definitions grouped by application area.
- `database/migrations` — Database table definitions and changes.
- `public/images` — Public image assets and placeholders.

## Request flow

1. A route in `routes/` maps the URL to a controller action.
2. The controller loads models and prepares view data.
3. A Blade view in `resources/views` renders the page.
4. Form validation belongs in `app/Http/Requests`, not inside the view.

## Product catalogue example

- `routes/product.php` defines catalogue, category, and product actions.
- `ProductDashboardController` prepares category and product data for the index page.
- `ProductRequest` validates product creation and editing.
- `resources/views/product/index.blade.php` renders the catalogue.
- `resources/views/product/edit.blade.php` renders the admin edit form.

## Shared frontend

- `resources/views/layouts/header.blade.php` contains the shared navigation and search behavior.
- `public/css/layout.css` contains shared header, footer, menu, and responsive layout rules.
- Page-specific styles should stay with the page until they are reused by multiple pages; shared styles belong in `layout.css`.
