<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Image;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('images')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $product = Product::create($validated);

        foreach ($request->file('images') as $image) {
            $path = $image->store('products', 'public');
            Image::create(['product_id' => $product->id, 'image_path' => $path]);
        }

        return redirect()->route('admin.products.index')->with('success', 'Product added successfully');
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $product->update($validated);

        if ($request->hasFile('images')) {
            foreach ($product->images as $img) {
                \Storage::delete('public/' . $img->image_path);
                $img->delete();
            }

            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                Image::create(['product_id' => $product->id, 'image_path' => $path]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        foreach ($product->images as $img) {
            \Storage::delete('public/' . $img->image_path);
            $img->delete();
        }

        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully');
    }
}

