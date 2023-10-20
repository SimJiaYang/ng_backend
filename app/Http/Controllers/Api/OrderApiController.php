<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetailModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Carbon\Carbon;

class OrderApiController extends Controller
{
    public function show()
    {
    }

    public function create(Request $request)
    {
        // Validate the request input
        $request->validate([
            'cart_list' => ['required', 'array'],
            'cart_list.*.id' => ['required', 'integer'],
            'cart_list.*.quantity' => ['required', 'integer'],
        ]);

        // Get the cart_list
        $cartValidation = $request->cart_list;

        $cartList = [];

        // Validate either the cart exist or not
        foreach ($cartValidation as $item) {
            $cartItem = Cart::where('id', $item['id'])
                ->where('is_purchase', false)
                ->first();
            if (!$cartItem) {
                return $this->fail('Cart ID: ' .  $item['id'] . ' not found');
            } else {
                $cartList[] = $cartItem;
            }
        }

        $total_order_price = 0;

        // Create the order
        $order = Order::create([
            'status' => '1',
            'date' => Carbon::now(),
            'total_amount' => $total_order_price,
            'user_id' => Auth::id(),
        ]);

        // Create the order detail
        foreach ($cartList as $item) {
            OrderDetailModel::create([
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'amount' => $item['price'] * $item['quantity'],
                'order_id' => $order->id,
                'product_id' => $item['product_id'] == null ? null : $item['product_id'],
                'plant_id' => $item['plant_id'] == null ? null : $item['plant_id'],
                'bidding_id' => $item['bidding_id'] == null ? null : $item['bidding_id'],
            ]);
            // Get the order price
            $total_order_price += $item['price'] * $item['quantity'];
            // Update the cart item to false
            $item->update([
                'is_purchase' => "true"
            ]);
        }

        // Update order price
        Order::where('id', $order->id)->update([
            'total_amount' => $total_order_price
        ]);

        return $this->success('Order created');
    }
}
