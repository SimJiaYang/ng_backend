<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Order;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{

    public function updateDelivery(Request $request)
    {
        $delivery = Delivery::where('order_id', $request->id)->update([
            'status' => $request->status,
            'tracking_number' => $request->track_num,
            'method' => $request->method,
        ]);

        $orders = Order::where('id', $request->id)->update([
            'status' => 'receive',
        ]);

        return redirect()->route('order.index');
    }
}
