<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plant;
use App\Models\Stock;

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

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePlant(Request $request)
    {
        $plant = Plant::where('id', $request->id)->first();
        $bool = $request->operation == "Add" ? true : false;
        if ($plant) {
            // Create new stock
            $new_stock = Stock::create([
                'plant_id' => $request->id,
                'quantity' => $bool == true ? $request->stock_quantity : -$request->stock_quantity,
                'reason' => $request->reason,
                'unit_price' => $request->price,
            ]);

            // Update stock
            if ($new_stock->exists) {
                $plant->quantity += $bool == true ? $request->stock_quantity  : -$request->stock_quantity;
                $plant->save();
            }

            // Redirect to plant index
            if ($new_stock->exists && $plant->exists) {
                return redirect()->route('plant.index');
            }
        }
    }
}
