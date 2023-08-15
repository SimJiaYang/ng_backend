<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('category.category');
    }

    public function insertForm()
    {
        return view('category.sub_screen.insert_category');
    }

    public function store(Request $request)
    {
        $addCategory = Category::create([    //step 3 bind data//add on 
            'name' => $request->name,
            'type' => $request->type,
            'status' => "1",
        ]);
        if ($addCategory) {
            return redirect()->route('category.index'); // step 5 back to last page
        }
        return null; // step 5 back to last page       
    }
}
