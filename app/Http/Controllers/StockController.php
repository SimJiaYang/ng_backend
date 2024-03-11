<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plant;

class StockController extends Controller
{
    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function editPlant($id)
    {
        $plant = Plant::where('id', $id)->get();
        if ($plant) {
            return view('plant.sub_screen.edit_stock')->with('plant', $plant);
        }
    }
}
