<?php 

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $items = Product::all();
        $category = Category::all();
        $inventories = Inventory::all();
        $cart = 0;

        return view('welcome', compact('items', 'category', 'cart'));
    }
    public function customer(Request $request, $id)
    {
        $items = Product::all();
        $category = Category::all();
        $cart = Cart::where('user_id', $id)->count();

        return view('welcome', compact('items', 'category', 'cart'));
    }
    
}
