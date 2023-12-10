<?php

namespace App\Http\Controllers;

use App\Models\Bidding;
use Illuminate\Http\Request;
use App\Models\Plant;
use Illuminate\Support\Facades\Session;

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

    public function store(Request $request)
    {
        $valid = $request->validate([
            'start_time' => 'required',
            'end_time' => 'required',
            'plant_id' => 'required',
            'int_amt' => 'required',
            'min_amt' => 'required',
        ]);

        if (!$valid) {
            Session::flash('error', 'unvailable price, please insert again');
            return redirect()->back();
        }

        $bidding = Bidding::create([
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'plant_id' => $request->plant_id,
            'intial_amt' => $request->int_amt,
            'highest_amt' => $request->int_amt,
            'min_amt' => $request->min_amt,
            'status' => '1',
        ]);

        if ($bidding->exists) {
            Session::flash('success', "Bidding create successful!");
            return redirect()->route('bidding.index');
        }

        return redirect()->back();
    }
}
