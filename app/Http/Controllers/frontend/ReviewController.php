<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create(Request $request)
    {
        $review = new Review();
        $review->product_id = $request['product_id'];
        $review->rating = $request['rating'];
        $review->review = $request['review'];
        $review->name = $request['name'];
        $review->email = $request['email'];
        $review->save();

        return redirect()->route('productDetail', ['id' => $review->product_id])
        ->with('success-message', 'Thanks for the feedback');
    }

}
