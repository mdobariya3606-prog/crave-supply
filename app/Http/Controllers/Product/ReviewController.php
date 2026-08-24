<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ReviewRequest;
use App\Models\Product;

class ReviewController extends Controller
{
    public function store(ReviewRequest $request, Product $product)
    {
        $product->reviews()->updateOrCreate(
            ['user_id' => $request->user()->id],
            [...$request->validated(), 'is_approved' => true],
        );

        return back()->with('review_success', 'Thank you — your review has been added.');
    }
}
