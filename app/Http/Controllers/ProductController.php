<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductForm;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\ImageUploader;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::all();
        return view('product.index', compact('products', 'categories'));
    }

    public function store(ProductRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('products', $filename, 'public');
            $validated['image'] = $path;
        }

        $validated['created_by'] = auth()->id();

        Product::create($validated);

        return redirect()->back()->with('success', 'Product added successfully!');
    }


    public function update(ProductRequest $request)
    {
        try {
            $validated = $request->validated();

            $product = Product::findOrFail($request->id);

            if ($request->hasFile('image')) {
                $filename = time() . '_' . $request->file('image')->getClientOriginalName();
                $path = $request->file('image')->storeAs('products', $filename, 'public');
                $validated['image'] = $path;
            } else {
                $validated['image'] = $product->image;
            }

            $product->update([
                'name' => $validated['name'],
                'category_id' => $validated['category_id'],
                'cost_price' => $validated['cost_price'],
                'sell_price' => $validated['sell_price'],
                'stock_qty' => $validated['stock_qty'],
                'barcode' => $validated['barcode'] ?? $product->barcode,
                'image' => $validated['image'],
            ]);

            return redirect()->back()->with('success', 'Product updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Failed to update product: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update product. Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();

            return redirect()->back()->with('success', 'Product deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to delete product: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete product. Please try again.');
        }
    }
}
