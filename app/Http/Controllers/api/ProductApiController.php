<?php

// namespace App\Http\Controllers\Api;

// use App\Http\Controllers\Controller;
// use App\Models\Product;
// use Illuminate\Http\Request;

// class ProductApiController extends Controller
// {
//     public function index()
//     {
//         $products = Product::all();
//         return response()->json($products);
//     }

//     public function show($id)
//     {
//         $product = Product::findOrFail($id);
//         return response()->json($product);
//     }

//     public function store(Request $request)
//     {
//         $validated = $request->validate([
//             'name' => 'required|string',
//             'release_date' => 'required|string',
//             'description' => 'nullable|string',
//             'price' => 'required|string',
//         ]);

//         $product = Product::create($validated);
//         return response()->json($product, 201);
//     }

//     public function update(Request $request, $id)
//     {
//         $validated = $request->validate([
//             'name' => 'required|string',
//             'release_date' => 'required|string',
//             'description' => 'nullable|string',
//             'price' => 'required|string',
//         ]);

//         $product = Product::findOrFail($id);
//         $product->update($validated);
//         return response()->json($product);
//     }

//     public function destroy($id)
//     {
//         Product::destroy($id);
//         return response()->json(null, 204);
//     }
// }
