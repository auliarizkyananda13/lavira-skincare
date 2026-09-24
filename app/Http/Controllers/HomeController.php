<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Mulai query model Product
        $query = Product::query();

        // Cek apakah user mengisi input pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            // Filter berdasarkan nama produk yang mirip dengan kata kunci
            $query->where('name', 'like', "%{$search}%");
        }

        // Ambil data produk hasil filter (atau semua jika tidak ada pencarian)
        $products = $query->get();

        // Kirim data ke view homepage
        return view('home', compact('products'));
    }
}