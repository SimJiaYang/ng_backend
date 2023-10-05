<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
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

    public function index2()
    {
        $category = Category::where('status', '1')->paginate(5);
        return view('index')
            ->with('category', $category);
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
