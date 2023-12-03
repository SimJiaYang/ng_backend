<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Plant;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CustomApiController extends Controller
{
    public function index()
    {
        return $this->success();
    }

    // Add and update
    public function add(Request $request)
    {
        // Validate the request input
        $request->validate([
            'cart_list' => ['required', 'array'],
            'cart_list.*.quantity' => ['required', 'integer'],
        ]);

        $ret = [];

        $filename =  'cdr1_demo.mp4';

        $filePath = asset("/custom_plant/$filename");

        $ret["URL"] = $filePath;

        return $this->success(
            $ret,
            200
        );
    }
}
