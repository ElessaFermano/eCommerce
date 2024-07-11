<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
{
    $products = Product::all();
    return view('product.index', compact('products'));
}

    public function create()
    {
        return view('product.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
            'stock' => 'required|integer',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images');
            $validated['image'] = $path;
        }

        Product::create($validated);

        return redirect()->route('products.create')->with('success', 'Product added successfully.');
    }
}
