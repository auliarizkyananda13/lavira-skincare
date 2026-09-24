<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'product'])->latest()->get();

        return view('admin.list-order', compact('orders'));
    }
}
 