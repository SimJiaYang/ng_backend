<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use App\Models\Stock;

class PlantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plant = Plant::select(
            "plant.*",
            "category.name as cat_name",
        )->leftjoin('category', 'category.id', 'plant.category_id')
            ->paginate(5);
        return view('plant.index')
            ->with('plant', $plant);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::where('status', true)
            // ->where('parent_id', "!=", null)
            ->where('type', 'plant')->get();
        return view('plant.sub_screen.create_plant')
            ->with('category', $category);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Handle and Store Image
        $images = array();
        if ($request->hasFile('image')) {
            $files = $request->file('image');
            foreach ($files as $file) {
                $image_name = md5(rand(1000, 10000));
                $ext = strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name . '.' . $ext;
                $file->move(
                    public_path('/plant_image'),
                    $image_full_name
                );
                $images[] = $image_full_name;
            }
        } else {
            $images[] = 'no_plant.png';
        }

        // Encode Image
        $imageName = $this->img_encode($images);

        // Create Plant
        $addPlant = Plant::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'placement' => $request->placement, // 'placement' => 'indoor' or 'outdoor
            'temperature' => $request->temperature,
            'water_need' => $request->water,
            'sunlight_need' => $request->sunlight,
            'height' => $request->height,
            'size' => $request->size,
            'weight' => $request->weight,
            'origin' => $request->origin,
            'other' => $request->other,
            'pot_name' => $request->pot_name,
            'pot_size' => $request->pot_size,
            'experience' => $request->experience,
            'image' => $imageName,
            'category_id' => $request->category_id
        ]);

        // Create Stock Record
        if ($addPlant->exists) {
            $addStock = Stock::create([
                'plant_id' => $addPlant->id,
                'quantity' => $request->quantity,
                'reason' => $request->reason,
                'unit_price' => $request->price,
            ]);
        }

        if ($addPlant->exists && $addStock) {
            Session::flash('success', "Plant create successfully!!");
            return redirect()->route('plant.index');
        }
    }

    public function search(Request $request)
    {
        $query = $request->name;
        $keyword = $request->name;
        $plant = Plant::select(
            "plant.*",
            "category.name as cat_name",
        )->leftjoin('category', 'category.id', 'plant.cat_id')
            ->where('plant.name', 'like', "%$keyword%");
        $plant = $plant->paginate(5)->setPath('');
        $plant->appends(array(
            'name' => $query
        ));
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
                if ($plant->image != 'no_plant.png') {
                    File::delete($old_path);
                }
            }
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('/plant_image'), $imageName);
        } else {
            if ($plant->image == null) {
                $imageName = 'no_plant.png';
            } else {
                $imageName = $plant->image;
            }
        }

        $plant->name = $request->name;
        $plant->price = $request->price;
        $plant->description = $request->description;
        $plant->quantity = $request->quantity;
        $plant->sunlight_need = $request->sunlight;
        $plant->water_need = $request->water;
        $plant->mature_height = $request->height;
        $plant->status = $request->status;
        $plant->origin = $request->origin;
        $plant->image = $imageName;
        $plant->cat_id = $request->category_id;
        $plant->save();

        Session::flash('success', "Update Plant successfully!!");
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
        Session::flash('success', "Update Plant Status successfully!!");
        return redirect()->route('plant.index');
    }
}
