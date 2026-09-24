<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class PaymentController extends Controller
{
    public function show($id)
    {
        $user = Auth::user();
        $product = Product::findOrFail($id);

        return view('payment', compact('user', 'product'));
    }

    public function checkoutCart()
    {
        $user = Auth::user();

        $cartItems = \App\Models\CartItem::with('product')
            ->where('user_id', $user->id)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('success', 'Keranjang kamu masih kosong.');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        return view('payment-cart', compact('user', 'cartItems', 'total'));
    }
}