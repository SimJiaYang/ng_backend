<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Plant;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Carbon\Carbon;

class CartApiController extends Controller
{
    public function show(Request $request)
    {
        $cart = Cart::where('user_id', Auth::id())
            ->where('is_purchase', "false");
        // $cart = Cart::where('user_id', $request->id)
        //     ->where('is_purchase', "false");

        // If result is impty, return fail
        if ($cart->count() == 0) {
            return $this->fail('Not item add to the cart yet.');
        }

        $ret = [];
        $ret['plant'] = [];
        $ret['product'] = [];

        // Sort By 
        if ($request->sortBy && in_array(
            $request->sortBy,
            [
                'id', 'created_at', 'updated_at'
            ]
        )) {
            $sortBy = $request->sortBy;
        } else {
            $sortBy = 'updated_at';
        }

        if ($request->sortOrder && in_array(
            $request->sortOrder,
            [
                'asc', 'desc'
            ]
        )) {
            $sortOrder = $request->sortOrder;
        } else {
            $sortOrder = 'desc';
        }

        if ($request->limit) {
            $limit = $request->limit;
        } else {
            $limit = 5;
        }

        $cart = $cart->orderBy(
            $sortBy,
            $sortOrder
        )->paginate($limit);

        $cart_item = $cart;
        foreach ($cart_item as $carts) {
            // Get related information
            if (!is_null($carts->plant_id)) {
                $plant = Plant::find($carts->plant_id);
                $ret['plant'][] = $plant;
            } else if (!is_null($carts->product_id)) {
                $product = Product::find($carts->product_id);
                $ret['product'][] = $product;
            }
        }

        $ret['cart'] = $cart;

        return $this->success(
            $ret
        );
    }

    // Add and update
    public function add(Request $request)
    {
        $user = Auth::user();

        // If null, return
        if (
            ($request->plantID == null &&
                $request->productID == null)
        ) {
            return $this->fail('Invalid request');
        }

        // Check plant
        if ($request->plantID != "null") {
            $plant = Plant::find($request->plantID);
            if ($plant->quantity == 0) {
                return $this->fail('Plant out of stock');
            }
            $request->validate([
                'plantID' => ['required', 'string', 'max:255'],
                'quantity' => 'required|numeric|min:1|max:' . $plant->quantity,
            ]);
            // Debug Print
            $ret['plant'] = $plant;
        }

        if ($request->productID != "null") {
            $product = Product::find($request->productID);
            if ($product->quantity == 0) {
                return $this->fail('Product out of stock');
            }
            $request->validate([
                'productID' => ['required', 'string', 'max:255'],
                'quantity' => 'required|numeric|min:1|max:' . $product->quantity,
            ]);
            // Debug Print
            $ret['product'] = $product;
        }

        // Add to the cart for plant
        if ($request->plantID != "null") {
            $cartPlant = Cart::firstOrNew(['plant_id' => $request->plantID, 'user_id' => Auth::id(), 'is_purchase' => "false"]);
            // If cart exists, update quantity
            if ($cartPlant->exists) {
                // Add quantity based on the old quantity
                $cartPlant->quantity += $request->quantity;
                $cartPlant->price = $plant->price * $cartPlant->quantity;
                $cartPlant->save();
                // Debug Print
                $ret['plant_cart_old'] = $cartPlant;
            } else {
                $newCart = Cart::create([
                    'quantity' => $request->quantity,
                    'plant_id' => $request->plantID,
                    'user_id' => Auth::id(),
                    'date_added' => Carbon::today(),
                    'is_purchase' => "false",
                    'price' => $plant->price * $request->quantity,
                ]);
                // Debug Print
                $ret['plant_cart_new'] = $newCart;
            }
        }

        // Add to the cart for product
        if ($request->productID != "null") {
            $cart = Cart::firstOrNew(['product_id' => $request->productID, 'user_id' => Auth::id(), 'is_purchase' => "false"]);

            // If cart exists, update quantity
            if ($cart->exists) {
                $cart->quantity += $request->quantity;
                $cart->price = $product->price * $cartPlant->quantity;;
                $cart->save();
                // Debug Print
                $ret['product_cart_old'] = $cart;
            } else {
                $newCart = Cart::create([
                    'quantity' => $request->quantity,
                    'product_id' => $request->productID,
                    'user_id' => Auth::id(),
                    'date_added' => Carbon::today(),
                    'is_purchase' => "false",
                    'price' => $product->price * $request->quantity,
                ]);
                // Debug Print
                $ret['product_cart_new'] = $newCart;
            }
        }

        return $this->success(
            $ret
        );
    }

    public function delete(Request $request)
    {
        //Delete the cart
        $deleteCart = Cart::where('user_id', Auth::id())
            ->where('is_purchase', "false")
            ->where('id', $request->id);
        if ($deleteCart->exists()) {
            $deleteCart->delete();
        } else {
            return $this->fail('Invalid request');
        }
        return $this->success();
    }

    public function update(Request $request)
    {
        // Validate the request
        $request->validate([
            'id' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'numeric', 'min:1']
        ]);

        // Update the cart
        $updateCart =
            Cart::where('id', $request->id)
            ->where('user_id', Auth::id())
            ->where('is_purchase', "false")
            ->first();

        if ($updateCart) {
            // Get related information
            if (!is_null($updateCart->plant_id)) {
                $plant = Plant::find($updateCart->plant_id);
                $total_price = $plant->price * $request->quantity;
            } else if (!is_null($updateCart->product_id)) {
                $product = Product::find($updateCart->product_id);
                $total_price = $product->price * $request->quantity;
            }
            $updateCart->update([
                'quantity' => $request->quantity,
                'price' => $total_price
            ]);
        } else {
            return $this->fail('Invalid request');
        }

        return $this->success();
    }
}
