<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Order;
use App\Models\OrderDetailModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DeliveryController extends Controller
{

    public function updateDelivery(Request $request)
    {
        if ($request->status == 'ship') {
            $request->validate([
                'items' => ['required'],
            ]);
            $items = $request->items;

            $selectedItem = [];
            foreach ($items as $itemss) {
                $selectedItem[] = explode(',', $itemss);
            }

            $order = Order::where('id', $request->id)->first();
            $order_items = OrderDetailModel::where('order_id', $request->id)->get();

            if ($request->status == 'ship') {
                $delivery = Delivery::create([
                    'order_id' => $request->id,
                    'user_id' => $order->user_id,
                    'status' => $request->status,
                    'tracking_number' => $request->track_num,
                    'method' => $request->method,
                    'expected_date' => $request->expected_date
                ]);
            } else {
                $delivery = Delivery::where('order_id', $request->id)->update([
                    'status' => $request->status,
                    'tracking_number' => $request->track_num,
                    'method' => $request->method,
                    'expected_date' => $request->expected_date
                ]);
            }

            foreach ($order_items as $order_item) {
                foreach ($selectedItem as $selected) {
                    // Compare the id from $order_item and $selected
                    if ($order_item->id == $selected[0]) {
                        OrderDetailModel::where('id', $order_item->id)->update([
                            'remark' => true,
                            'delivery_id' => $delivery->id
                        ]);
                    }
                }
            }
        }



        // Delivery status
        if ($request->status == 'ship') {
            $isfull = true;
            $order_item = OrderDetailModel::where('order_id', $request->id)->get();
            foreach ($order_item as $item) {
                if ($item->ramark != null || $item->ramark == true) {
                    $isfull = false;
                    break;
                }
            }
            if ($isfull) {
                $order = Order::where('id', $request->id)->update([
                    'status' => 'receive',
                ]);
            } else {
                $order = Order::where('id', $request->id)->update([
                    'is_separate' => true,
                ]);
            }
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
