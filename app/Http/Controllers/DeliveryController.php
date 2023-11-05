<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DeliveryController extends Controller
{

    public function updateDelivery(Request $request)
    {
        $delivery = Delivery::where('order_id', $request->id)->update([
            'status' => $request->status,
            'tracking_number' => $request->track_num,
            'method' => $request->method,
            'expected_date' => $request->expected_date
        ]);

        // Delivery status
        if ($request->status == 'ship') {
            $order = Order::where('id', $request->id)->update([
                'status' => 'receive',
            ]);
        } else if ($request->status == 'delivered') {
            $delivery = Delivery::where('order_id', $request->id)->first();

            if ($request->hasFile('image_proof')) {
                $old_path = public_path('delivery_prove/' . $delivery->prv_img);
                if (File::exists($old_path)) {
                    if ($delivery->prv_img != 'no_delivery.png') {
                        File::delete($old_path);
                    }
                }
                $imageName = time() . '.' . $request->file('image_proof')->getClientOriginalExtension();
                $request->file('image_proof')->move(public_path('/delivery_prove'), $imageName);
            } else {
                $imageName = 'no_delivery.png';
            }

            Delivery::where('order_id', $request->id)->update([
                'prv_img' => $imageName
            ]);

            $order = Order::where('id', $request->id)->update([
                'status' => 'completed',
            ]);
        }


        return redirect()->route('order.index');
    }
}
