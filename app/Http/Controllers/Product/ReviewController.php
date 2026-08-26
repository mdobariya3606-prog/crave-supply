<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ReviewRequest;
use App\Models\Product;

use App\Models\Review;

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

    public function toggleVisibility(Review $review)
    {
        $review->update([
            'is_approved' => !$review->is_approved,
        ]);

        if (request()->expectsJson() || request()->ajax()) {
            return response()->json([
                'success' => true,
                'is_approved' => (bool) $review->is_approved,
                'message' => 'Review visibility updated.',
            ]);
        }

        $status = $review->is_approved ? 'visible' : 'hidden';

        return back()->with('review_success', "Review status updated: marked as {$status}.");
    }
}
