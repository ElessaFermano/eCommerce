<?php 

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index( )
    {
        $items = Product::all();
        $byCategory = Product::with('category')->get();
        $cart = Cart::where('user_id', auth()->id())->count();

        return view('welcome', compact('items', 'byCategory', 'cart'));
    }
    public function customer(Request $request, $id)
    {
        $items = Product::all();
        $byCategory = Product::with('category')->get();
        $cart = Cart::where('user_id', $id)->count();

        return view('welcome', compact('items', 'byCategory', 'cart'));
    }
    
}
