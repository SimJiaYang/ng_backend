<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function home()
    {
        if (!Auth::check()) {
            return redirect()->back();
        }
        if (Auth::user()->type == "admin") {
            return view('home');
        } else {
            return view('unauthorized.user');
        }


        return redirect()->back();
    }
}
