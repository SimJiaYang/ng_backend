<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plant;

class BiddingController extends Controller
{
    public function index()
    {
        return view('bidding.bidding');
    }

    public function insert()
    {
        $plant = Plant::where('status', 'bid')->get();
        return view('bidding.sub_screen.insert_bidding')
            ->with('plants', $plant);
    }
}
