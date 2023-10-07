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
    public function add(Request $request)
    {
        $user = Auth::user();

        // If null, return
        if (
            $request->plantID == null &&
            $request->productID == null
        ) {
            return $this->fail('Invalid request');
        }

        // Check plant
        if ($request->plantID) {
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

        // Check product
        if ($request->productID) {
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
        if ($request->plantID) {
            $cartPlant = Cart::firstOrNew(['plant_id' => $request->plantID, 'user_id' => Auth::id(), 'is_purchase' => "false"]);
            // If cart exists, update quantity
            if ($cartPlant->exists) {
                $cartPlant->quantity = $request->quantity;
                $cartPlant->price = $request->price ? $request->price : $plant->price * $request->quantity;
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
                    'price' => $request->price ? $request->price : $plant->price * $request->quantity,
                ]);
                // Debug Print
                $ret['plant_cart_new'] = $newCart;
            }
        }

        // Add to the cart for product
        if ($request->productID) {
            $cart = Cart::firstOrNew(['product_id' => $request->productID, 'user_id' => Auth::id(), 'is_purchase' => "false"]);

            // If cart exists, update quantity
            if ($cart->exists) {
                $cart->quantity = $request->quantity;
                $cart->price =  $request->price ? $request->price : $product->price * $request->quantity;
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
                    'price' =>  $request->price ? $request->price : $product->price * $request->quantity,
                ]);
                // Debug Print
                $ret['product_cart_new'] = $newCart;
            }
        }

        return $this->success(
            $ret
        );
    }
}
