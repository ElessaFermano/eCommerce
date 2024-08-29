<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
       $reviews = Review::simplePaginate(5);
       $rev = Review::with('user')->where('product_id')->get();
       return view('review.index', compact('reviews', 'rev'));
    }

    public function store(Request $request)
    {
        $userId = $request->input('user_id');
        if (empty($userId)) {
            echo "<script>
                alert('Please log in first.');
                window.location.href = '/login'; 
            </script>";
            exit(); 
        }

        Review::create([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'comment' => $request->comment,
        ]);

        return redirect()->back();

    }

    public function show($id)
    {
        $product = Product::findorFail($id);
        $reviews = Review::with('user')->where('product_id', $id)->get();
        return view('review', compact('reviews', 'product'));
    }

    public function destroy(Review $review)
    {
        $review->delete();
         return redirect()->route('reviews.index');
    }
}
