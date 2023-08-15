<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**Order List */
    public function index()
    {
        return view('order.order');
    }
}
