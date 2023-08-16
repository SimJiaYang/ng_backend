<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Plant;
use Illuminate\Http\Request;

class PlantController extends Controller
{
    /**Plant List */
    public function index()
    {
        $plant = Plant::select(
            "plant.*",
            "category.name as cat_name",
        )->leftjoin('category', 'category.id', 'plant.cat_id')
            ->where('plant.status', '1')
            ->where('plant.quantity', '>', '0')
            ->paginate(2);
        return view('plant.plant')
            ->with('plant', $plant);
    }

    public function insert()
    {
        $category = Category::where('status', '1')
            ->where('type', 'plant')->get();
        return view('plant.sub_screen.insert_plant')
            ->with('category', $category);
    }

    public function store(Request $request)
    {
        //Handle Photo
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->move('plant_image', $image->getClientOriginalName());   //images is the location                
            $imageName = $image->getClientOriginalName();
        } else {
            $imageName = "no_plant.png";
        }

        // Create product
        $addProduct = Plant::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'sunglight_need' => $request->sunlight,
            'water_need' => $request->water,
            'mature_height' => $request->height,
            'origin' => $request->origin,
            'status' => "1",
            'image' => $imageName,
            'cat_id' => $request->category_id
        ]);

        if ($addProduct->exists) {
            return redirect()->route('plant.index');
        }
    }

    public function search(Request $request)
    {
        $keyword = $request->name;
        $plant = Plant::select(
            "plant.*",
            "category.name as cat_name",
        )->leftjoin('category', 'category.id', 'plant.cat_id')
            ->where('plant.name', 'like', "%$keyword%")
            ->where('plant.quantity', '>', '0')
            ->where('plant.status', '1')
            ->paginate(2);
        return view('plant.plant')
            ->with('plant', $plant);;
    }
}
