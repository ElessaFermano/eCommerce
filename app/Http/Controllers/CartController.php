<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $userId = $request->input('user_id');
        $product = Product::findOrFail($id);

        $cartItem = Cart::where('user_id', $userId)
                         ->where('product_id', $product->id)
                         ->first();

        if ($cartItem) {
            $cartItem->quantity++;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $product->id,
                'quantity' => 1
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function cartCount(Request $request)
    {
        $userId = $request->input('user_id');
        $cartCount = Cart::where('user_id', $userId)->count();
dd($cartCount);
        return response()->json(['count' => $cartCount]);
    }

    public function viewCart(Request $request)
    {
        $userId = $request->input('user_id');
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();

        return view('cart', compact('cartItems'));
    }

    public function removeFromCart(Request $request, $id)
    {
        $userId = $request->input('user_id');

        $cartItem = Cart::where('user_id', $userId)
                         ->where('product_id', $id)
                         ->first();

        if ($cartItem) {
            $cartItem->delete();
        }

        return redirect()->back()->with('success', 'Product removed from cart successfully!');
    }
}
