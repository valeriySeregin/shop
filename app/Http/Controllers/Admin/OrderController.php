<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = Order::where('status', 1)->paginate(20);
        return view('auth.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('auth.orders.show', compact('order'));
    }
}
