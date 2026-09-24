<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::findOrFail($id);
        if (is_string($product->image)) {
            $product->image = json_decode($product->image);
        }

        $relatedProducts = Product::where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('product.detail', compact('product', 'relatedProducts'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');

        $products = Product::where('name', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->get();

        return view('product.search', compact('products', 'query'));
    }
}