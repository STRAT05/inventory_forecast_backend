<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request) // Create a new product
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'average_weekly_sales' => 'nullable|numeric|min:0',
            'lead_time' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            // Put image in 'storage/app/public/products', get relative path
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath; // save as 'products/xxx.jpg'
        }

        $product = Product::create($validated);
        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product) // Show a specific product
    {
        return $product;
    }

    /**
     * Display the specified resource by name.
     */
    public function showByName($name) // Show product by name
    {
        $product = Product::where('name', $name)->firstOrFail();
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product) // Update a specific product
    {
        $validated = $request->validate([
            'name' => 'string|max:255',
            'description' => 'nullable|string',
            'price' => 'numeric|min:0',
            'stock' => 'integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'average_weekly_sales' => 'nullable|numeric|min:0',
            'lead_time' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public'); // Store new image
            $validated['image'] = $imagePath;
        }

        $product->update($validated);
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image) { // Delete associated image file
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();
        return response()->json(['message' => 'Product deleted successfully'], 200);
    }

    /**
     * Handle product purchase, updating stock and purchases count.
     */
    public function purchase(Product $product, Request $request)
    {
        $quantity = $request->input('quantity', 1);

        if ($product->stock < $quantity) {
            return response()->json(['message' => 'Insufficient stock'], 400);
        }

        $product->stock -= $quantity;
        $product->purchases += $quantity;
        $product->save();

        return response()->json(['message' => 'Purchase successful', 'product' => $product]);
    }
}
