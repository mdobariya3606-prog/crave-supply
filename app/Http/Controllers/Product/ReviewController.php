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
            $product = $review->product;
            $approvedReviews = $product->reviews()->where('is_approved', true)->get();
            $count = $approvedReviews->count();
            $avgFloat = $count ? (float) $approvedReviews->avg('rating') : 0.0;
            $formattedAvg = $count ? number_format($avgFloat, 1) : '—';
            $avgInt = (int) round($avgFloat);
            $stars = str_repeat('★', $avgInt) . str_repeat('☆', 5 - $avgInt);

            return response()->json([
                'success' => true,
                'is_approved' => (bool) $review->is_approved,
                'message' => 'Review visibility updated.',
                'approved_count' => $count,
                'formatted_avg' => $formattedAvg,
                'stars' => $stars,
                'note' => $count . ' verified review' . ($count === 1 ? '' : 's') . ' shared so far.',
                'top_summary' => $formattedAvg . ' from ' . $count . ' review' . ($count === 1 ? '' : 's'),
            ]);
        }

        $status = $review->is_approved ? 'visible' : 'hidden';

        return back()->with('review_success', "Review status updated: marked as {$status}.");
    }
}
