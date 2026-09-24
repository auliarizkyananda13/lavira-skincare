<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();
        $product = Product::findOrFail($request->product_id);

        $order = new Order();
        $order->user_id = $user->id;
        $order->product_id = $product->id;
        $order->location_description = $user->location_description;
        $order->phone_number = $user->phone_number;
        $order->price = $product->price;
        $order->save();

        $images = json_decode($product->image, true);

        session()->flash('ordered_items', [
            [
                'name' => $product->name,
                'quantity' => 1,
                'image' => $images[0] ?? 'default.png',
                'subtotal' => $product->price,
            ]
        ]);
        session()->flash('ordered_total', $product->price);

        return redirect()->route('order.success');
    }

    public function storeFromCart(Request $request)
    {
        $user = Auth::user();

        $cartItems = CartItem::with('product')
            ->where('user_id', $user->id)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index');
        }

        $orderedItems = [];

        foreach ($cartItems as $item) {
            $order = new Order();
            $order->user_id = $user->id;
            $order->product_id = $item->product_id;
            $order->location_description = $request->location_description;
            $order->phone_number = $request->phone_number;
            $order->price = $item->product->price * $item->quantity;
            $order->save();

            $orderedItems[] = [
                'name' => $item->product->name,
                'quantity' => $item->quantity,
                'image' => json_decode($item->product->image, true)[0] ?? 'default.png',
                'subtotal' => $item->quantity * $item->product->price,
            ];
        }

        $total = collect($orderedItems)->sum('subtotal');

        CartItem::where('user_id', $user->id)->delete();

        session()->flash('ordered_items', $orderedItems);
        session()->flash('ordered_total', $total);

        return redirect()->route('order.success');
    }
}