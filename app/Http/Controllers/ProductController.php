<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**Product List */
    public function index()
    {
        return view('product.product');
    }

    public function insert()
    {
        return view('product.sub_screen.insert_product');
    }
}
