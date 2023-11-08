<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Order;
use App\Models\OrderDetailModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use function PHPUnit\Framework\isNull;

class DeliveryController extends Controller
{
    public function index()
    {
        $delivery = Delivery::orderBy('created_at', 'desc')->paginate(10);
        return view('delivery.delivery')->with('delivery', $delivery);
    }

    public function search(Request $request)
    {
        $query = $request->name;
        $keyword = $request->name;
        $delivery = Delivery::where("tracking_number", 'like', "%$keyword%")
            ->paginate(5);
        $delivery->appends(array(
            'keyword' => $query
        ));
        return view('delivery.delivery')
            ->with('delivery', $delivery);
    }

    public function detail($id)
    {
        $delivery = Delivery::where('id', $id)->get();
        // dd($delivery);
        return view('delivery.sub_screen.edit_delivery_screen')
            ->with('deliver', $delivery);
    }

    public function updateDelivery(Request $request)
    {
        $items = $request->items;
        $order = Order::where('id', $request->order_id)->first();

        // Create new delivery for new item
        if ($items != null) {
            // Create New Delivery
            $delivery = Delivery::create([
                'order_id' => $request->order_id,
                'user_id' => $order->user_id,
                'status' => $request->status,
                'tracking_number' => $request->track_num,
                'method' => $request->method,
                'expected_date' => $request->expected_date
            ]);

            // Update Order Item has been delivered
            $selectedItem = [];
            foreach ($items as $itemss) {
                $selectedItem[] = explode(',', $itemss);
            }
            $order_items = OrderDetailModel::where('order_id', $request->order_id)->get();

            foreach ($order_items as $order_item) {
                for ($val = 0; $val < count($selectedItem[0]); $val++) {
                    $selected = $selectedItem[0][$val];
                    // Compare the id from $order_item and $selected
                    if ($selected == $order_item->id) {
                        OrderDetailModel::where('id', $order_item->id)->update([
                            'remark' => true,
                            'delivery_id' => $delivery->id
                        ]);
                    }
                }
            }

            // Update Order Status 
            $isfull = true;
            $order_item = OrderDetailModel::where('order_id', $request->order_id)->get();

            foreach ($order_item as $item) {
                if ($item->remark != true) {
                    $isfull = false;
                    break;
                }
            }

            if ($isfull == true) {
                $order->status = 'receive';
                $order->save();
            } else {
                $order->is_separate = true;
                $order->save();
            }
        }

        // Update the Shipping Detail but not set it to delivered
        if ($request->status == 'ship' && $request->id != null) {
            $delivery = Delivery::where('id', $request->id);
            $delivery->status = 'ship';
            $delivery->tracking_number = $request->track_num;
            $delivery->method = $request->method;
            $delivery->expected_date = $request->expected_date;
            $delivery->save();
        }

        // Delivery arrived
        if ($request->hasFile('image_proof')) {
            // Get delivery
            $delivery = Delivery::where('id', $request->id)->first();

            // Get delivery image prove
            $old_path = public_path('delivery_prove/' . $delivery->prv_img);
            if (File::exists($old_path)) {
                if ($delivery->prv_img != 'no_delivery.png') {
                    File::delete($old_path);
                }
            }
            $imageName = time() . '.' . $request->file('image_proof')->getClientOriginalExtension();
            $request->file('image_proof')->move(public_path('/delivery_prove'), $imageName);

            // Update delivery
            $delivery->prv_img = $imageName;
            $delivery->status = 'delivered';
            $delivery->save();

            // Update order
            $order->status = 'completed';
        }

        return redirect()->route('order.index');
    }
}
