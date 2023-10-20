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

class OrderApiController extends Controller
{
    public function show()
    {
    }

    public function create(Request $request)
    {
        // Validate the request
        $request->validate([
            'cart_list' => ['required', 'array'],
            'cart_list.*.id' => ['required', 'integer'],
            'cart_list.*.quantity' => ['required', 'integer'],
            'order_price' => ['required', 'numeric', 'min:0'],
        ]);

        // Now you can access the validated cart_list in your controller
        $cartList = $request->input('cart_list');
    }
}
