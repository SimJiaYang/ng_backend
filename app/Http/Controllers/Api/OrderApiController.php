<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Plant;
use App\Models\Product;
use App\Models\OrderDetailModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Carbon\Carbon;

class OrderApiController extends Controller
{
    public function show(Request $request)
    {
        $query = Order::where('user_id', Auth::id());

        // If there are no matching orders, return fail
        if ($query->count() == 0) {
            return $this->fail('No orders yet.');
        }

        // pay
        // ship
        // receive
        // completed
        // cancelled
        if ($request->status != null) {
            $query = $query->where('status', $request->status);
            // If there are no matching orders, return fail
            if ($query->count() == 0) {
                return $this->fail('No ' . $request->status . ' orders yet.');
            }
        } else {
            return $this->fail('Some error occured.');
        }

        // Sort By 
        $sortBy = in_array($request->sortBy, ['id', 'created_at', 'updated_at'])
            ? $request->sortBy : 'created_at';
        $sortOrder = in_array($request->sortOrder, ['asc', 'desc'])
            ? $request->sortOrder : 'desc';
        $limit = $request->limit
            ? $request->limit : 3;

        $orders = $query->orderBy($sortBy, $sortOrder)
            ->paginate($limit);

        $ret['orders'] = $orders;

        return $this->success($ret);
    }

    public function order_detail(Request $request)
    {
        $query = OrderDetailModel::where('order_id', $request->id);

        // Sort By 
        $sortBy = in_array($request->sortBy, ['id', 'created_at', 'updated_at'])
            ? $request->sortBy : 'created_at';
        $sortOrder = in_array($request->sortOrder, ['asc', 'desc'])
            ? $request->sortOrder : 'asc';

        $ret = [];

        $order_item = $query->orderBy($sortBy, $sortOrder)->get();

        if ($order_item->count() == 0) {
            return $this->fail('Some error occur, Please try again later.');
        }

        foreach ($order_item as $item) {
            if (!is_null($item->plant_id)) {
                $plant = Plant::leftjoin('category', 'category.id', 'plant.cat_id')
                    ->where('plant.id',  $item->plant_id)
                    ->where('plant.status', '1')
                    ->where('plant.quantity', '>', '0')
                    ->select('plant.*', 'category.name as category_name', 'plant.image as image')
                    ->first();
                $ret['plant'][] = $plant;
            } else if (!is_null($item->product_id)) {
                $product = Product::leftjoin('category', 'category.id', 'product.cat_id')
                    ->where('product.id', $item->product_id)
                    ->where('product.status', '1')
                    ->where('product.quantity', '>', '0')
                    ->select('product.*', 'category.name as category_name', 'product.image as image')
                    ->first();
                $ret['product'][] = $product;
            }
        }

        $ret['order_item'] = $order_item;

        return $this->success($ret);
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
            'status' =>  $request->status ? $request->status : 'pay',
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

            // Minus the inventory of the product
            if (!is_null($item['plant_id'])) {
                $plant = Plant::where('id', $item['plant_id'])->first();
                $quantity = $item['quantity'];
                $plant->update([
                    'quantity' => $plant->quantity - $quantity
                ]);
            } else if (!is_null($item['product_id'])) {
                $product = Product::where('id', $item['product_id'])->first();
                $quantity = $item['quantity'];
                $product->update([
                    'quantity' => $product->quantity - $quantity
                ]);
            }

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

        $ret['order_id'] = $order->id;

        return $this->success($ret);
    }
}
