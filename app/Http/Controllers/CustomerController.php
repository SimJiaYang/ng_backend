<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**Customer List */
    public function index()
    {
        $customer = User::where('type', 'user')->paginate(10);
        return view('customer.customer')->with("customers", $customer);
    }

    public function search(Request $request)
    {
        $keyword = $request->name;
        $customer = User::where('type', 'user')
            ->where('name', 'like', "%$keyword%")->paginate(10)->setPath('');
        $customer->appends(array(
            'name' => $keyword
        ));
        return view('customer.customer')->with("customers", $customer);
    }
}
