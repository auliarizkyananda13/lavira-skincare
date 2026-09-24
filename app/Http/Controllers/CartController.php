<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::with('product')
            ->where('user_id', auth()->id())
            ->get();

        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function store(Request $request, $productId)
    {
        $quantity = $request->input('quantity', 1);

        $existing = CartItem::where('user_id', auth()->id())
            ->where('product_id', $productId)
            ->first();

        if ($existing) {
            $existing->increment('quantity', $quantity);
        } else {
            CartItem::create([
                'user_id' => auth()->id(),
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produk ditambahkan ke keranjang!');
    }

    public function update(Request $request, $id)
    {
        $item = CartItem::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        $qty = max(1, (int) $request->input('quantity', 1));
        $item->update(['quantity' => $qty]);

        return redirect()->route('cart.index');
    }

    public function destroy($id)
    {
        CartItem::where('id', $id)->where('user_id', auth()->id())->delete();
        return redirect()->route('cart.index')->with('success', 'Produk dihapus dari keranjang.');
    }
}