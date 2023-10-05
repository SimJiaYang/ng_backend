<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PlantController extends Controller
{
    /**Plant List */
    public function index()
    {
        $plant = Plant::select(
            "plant.*",
            "category.name as cat_name",
        )->leftjoin('category', 'category.id', 'plant.cat_id')
            ->where('plant.quantity', '>', '0')
            ->paginate(5);
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
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('/plant_image'), $imageName);
        } else {
            $imageName = 'no_plant.png';
        }

        // Create product
        $addProduct = Plant::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'sunlight_need' => $request->sunlight,
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
            ->paginate(5);
        return view('plant.plant')
            ->with('plant', $plant);;
    }

    public function edit($id)
    {
        $category = Category::where('status', '1')
            ->where('type', 'plant')->get();
        $plant = Plant::select(
            "plant.*",
            "category.name as cat_name",
        )->leftjoin('category', 'category.id', 'plant.cat_id')
            ->where('plant.id', $id)
            ->get();
        return view('plant.sub_screen.edit_plant')
            ->with('plant', $plant)
            ->with('category', $category);;
    }

    //Update
    public function update(Request $request)
    {
        $plant = Plant::where('id', $request->id)->first();

        //Handle Photo
        if ($request->hasFile('image')) {
            $old_path = public_path('plant_image/' . $plant->image);
            if (File::exists($old_path)) {
                File::delete($old_path);
            }
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('/plant_image'), $imageName);
        } else {
            $imageName = 'no_plant.png';
        }

        $plant->name = $request->name;
        $plant->price = $request->price;
        $plant->description = $request->description;
        $plant->quantity = $request->quantity;
        $plant->sunlight_need = $request->sunlight;
        $plant->water_need = $request->water;
        $plant->mature_height = $request->height;
        $plant->origin = $request->origin;
        $plant->status = "1";
        $plant->image = $imageName;
        $plant->cat_id = $request->category_id;
        $plant->save();

        return redirect()->route('plant.index');
    }

    public function delete($id)
    {
        $plant = Plant::where('id', $id)->first();
        if ($plant->status == "1") {
            $plant->status = "0";
        } else {
            $plant->status = "1";
        }

        $plant->save();
        return redirect()->route('plant.index');
    }
}
