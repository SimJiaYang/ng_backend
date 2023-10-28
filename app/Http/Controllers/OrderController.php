<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**Order List */
    public function index()
    {
        $order = Order::select(
            "order.*",
        )->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('order.order')->with('orders', $order);
    }

    /**Filter order status*/
    public function filter(Request $request)
    {
        $order = Order::select(
            "order.*",
        )->where('status', $request->status)
            ->orderBy('created_at', 'desc')
            ->paginate(5)->setPath('');
        $order->appends(array(
            'name' => $request->status
        ));
        return view('order.order')->with('orders', $order);
    }

    public function search(Request $request)
    {
        $order = Order::select(
            "order.*",
        )->where('id', $request->id)
            ->orderBy('created_at', 'desc')
            ->paginate(5)->setPath('');
        $order->appends(array(
            'id' => $request->id
        ));
        return view('order.order')->with('orders', $order);
    }
}
