<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BiddingController extends Controller
{
    public function index()
    {
        return view('bidding.bidding');
    }
}
