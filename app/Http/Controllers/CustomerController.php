<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**Customer List */
    public function index()
    {
        $customer = User::where('type', 'user')->paginate(5);
        // $customer = User::where('type', 'user')->get();
        return view('customer.customer')->with("customer", $customer);
    }

    public function search(Request $request)
    {
        $keyword = $request->name;
        $customer = User::where('type', 'user')
            ->where('name', 'like', "%$keyword%")->paginate(5);
        return view('customer.customer')->with("customer", $customer);
    }
}
