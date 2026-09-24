<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Untuk ditampilkan jika perlu
        return view('admin.admin-dashboard', compact('products'));
    }

    public function create()
    {
        return view('admin.create-product');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric',
            'image'       => 'required',
            'image.*'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Simpan gambar ke public/images
        $imageNames = [];                             // ← array untuk banyak gambar
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $img) {
                $imgName = time().'_'.$img->getClientOriginalName();
                $img->move(public_path('images'), $imgName);   // pindahkan file
                $imageNames[] = $imgName;                      // masukkan ke array
            }
        }

        // 3️⃣ Simpan produk ke database
        try {
            Product::create([
                'name'        => $request->name,
                'description' => $request->description,
                'image'       => json_encode($imageNames),     // WAJIB dalam JSON
                'price'       => $request->price,
            ]);

            return redirect()
                ->route('admin-dashboard')
                ->with('success', 'Produk berhasil ditambahkan!');
        } catch (\Throwable $e) {
            // logging biar tahu kalau ada error
            Log::error('Gagal menambah produk: '.$e->getMessage());

            return back()->withErrors('Gagal menambah produk. Silakan coba lagi.');
        }
    }
}
