<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Shipping;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $userId = $request->input('user_id');
        if (empty($userId)) {
            echo "<script>
                alert('Please log in first.');
                window.location.href = '/login'; 
            </script>";
            exit(); 
        }
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

    public function viewCart(Request $request, $id)
    {
        
        $user_id = $request->input('user_id'); 
        $provinces = Shipping::all();
        $cartItems = Cart::where('user_id', $id)->with('product')->get();
        $total = 0;

        foreach($cartItems as $cartItem){
           $partial  =   $cartItem->product->price * $cartItem->quantity;
           $total += $partial;
        }
        
        return view('cart', compact('provinces','cartItems', 'total', 'user_id'));
    }

}
