<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
    $categories = Category::all(); // Fetch all categories
    return view('product.create', compact('categories')); // Pass categories to the view
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Product added successfully.');
    }
    
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all(); // Fetch all categories
        return view('product.edit', compact('product', 'categories')); // Pass categories to the view
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);
    
        $product = Product::findOrFail($id);
        $product->category_id = $request->input('category_id');
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
    
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $product->image = $path;
        }
    
        $product->save();
    
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }
    public function destroy(Product $product)
    {
         $product->delete();
         return redirect()->route('products.index');
    }
    
}