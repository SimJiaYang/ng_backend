<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**Customer List */
    public function index()
    {
        return view('customer.customer');
    }
}
