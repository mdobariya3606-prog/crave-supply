<?php

namespace App\Support\Cache;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class ProductCache
{
    public static function forgetProduct(Product $product, ?int $oldCategoryId = null): void
    {
        Cache::forget("product.{$product->id}");
        Cache::forget("product.{$product->id}.related");

        $categoryIds = collect([$oldCategoryId, $product->category_id])
            ->filter()
            ->unique();

        foreach ($categoryIds as $categoryId) {
            Cache::forget("category.{$categoryId}.products");

            Product::where('category_id', $categoryId)
                ->pluck('id')
                ->each(function (int $productId): void {
                    Cache::forget("product.{$productId}.related");
                });
        }

        Cache::forget('categories.all');
    }

    public static function forgetCategory(int $categoryId): void
    {
        Cache::forget('categories.all');
        Cache::forget("category.{$categoryId}.products");

        Product::where('category_id', $categoryId)
            ->pluck('id')
            ->each(function (int $productId): void {
                Cache::forget("product.{$productId}");
                Cache::forget("product.{$productId}.related");
            });
    }
}
