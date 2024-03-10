<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a list of the category.
     *
     * @return Response
     */
    public function index()
    {
        $category = Category::select(
            "category.*",
            "parent.name as parent",
        )->leftjoin(
            'category as parent',
            'parent.id',
            'category.parent_id'
        )->paginate(5);
        return view('category.index')
            ->with('category', $category);
    }

    /**
     * Show the form for creating a new category.
     *
     * @return Response
     */
    public function create()
    {
        // $category = Category::where('status', true)->get();
        $category = Category::all();
        return view('category.sub_screen.create_category')
            ->with('category', $category);
    }

    /**
     * Store a newly created category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $addCategory = Category::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'type' => $request->type,
            'parent_id' => $request->parent_id,
            'status' => true,
        ]);

        if ($addCategory) {
            Session::flash('success', "Category create successful!");
            return redirect()->route('category.index');
        }

        return null;
    }

    /**
     * Display the specified category.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $category = Category::where('id', $id)->first();
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $category = Category::select(
            "category.*",
            "parent.name as parent",
        )->leftjoin(
            'category as parent',
            'parent.id',
            'category.parent_id'
        )->where('category.id', $id)->get();
        $all_category = Category::all();
        return view('category.sub_screen.edit_category')
            ->with('category', $category)
            ->with('all_category', $all_category);
    }

    /**
     * Update the specified category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function update(Request $request)
    {
        $category = Category::where('id', $request->id)->first();
        $category->slug = $request->slug;
        $category->name = $request->name;
        $category->type = $request->type;
        $category->parent_id = $request->parent_id;
        $category->save();

        Session::flash('success', "Update successfully!!");
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified category from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $category = Category::where('id', $id)->first();
        // Hide category
        if ($category->status == true) {
            $category->status = false;
        } else {
            $category->status = true;
        }
        $category->save();
        Session::flash('success', "Update Category Status successfully!!");
        return redirect()->route('category.index');
    }

    /**
     * Search category
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function search(Request $request)
    {
        $query = $request->name;
        $keyword = $request->name;
        $category = Category::select(
            "category.*",
            "parent.name as parent",
        )->leftjoin(
            'category as parent',
            'parent.id',
            'category.parent_id'
        )->where('category.name', 'like', "%$keyword%")
            ->paginate(5);
        $category->appends(array(
            'name' => $query
        ));
        return view('category.index')
            ->with('category', $category);
    }
}
