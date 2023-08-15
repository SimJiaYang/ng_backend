<?php

namespace App\Http\Controllers;

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
}
