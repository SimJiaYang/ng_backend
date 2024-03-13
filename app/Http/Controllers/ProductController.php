<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use App\Models\Stock;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::select(
            "product.*",
            "category.name as cat_name",
        )->leftjoin('category', 'category.id', 'product.category_id')
            ->paginate(5);
        return view('product.index')
            ->with('product', $product);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::where('status', true)
            ->where('type', 'product')->get();
        return view('product.sub_screen.create_product')
            ->with('category', $category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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

        // Create product
        $addProduct = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'other' => $request->other,
            'weight' => $request->weight,
            'size' => $request->size,
            'material' => $request->material,
            'length' => $request->length,
            'quantity' => $request->quantity,
            'image' => $imageName,
            'category_id' => $request->category_id
        ]);

        if ($addProduct->exists) {
            $addStock = Stock::create([
                'product_id' => $addProduct->id,
                'quantity' => $request->quantity,
                'reason' => $request->reason,
                'unit_price' => $request->price,
            ]);
        }

        if ($addProduct->exists  && $addStock->exists) {
            Session::flash('success', "Product create successfully!!");
            return redirect()->route('product.index');
        }
    }

    public function edit($id)
    {
        $category = Category::where('status', true)
            ->where('type', 'product')->get();
        $product = Product::select(
            "product.*",
            "category.name as cat_name",
        )->leftjoin('category', 'category.id', 'product.cat_id')
            ->where('product.id', $id)
            ->get();
        return view('product.sub_screen.edit_product')
            ->with('product', $product)
            ->with('category', $category);;
    }

    public function update(Request $request)
    {
        $product = Product::where('id', $request->id)->first();

        //Handle Photo
        if ($request->hasFile('image')) {
            $old_path = public_path('product_image/' . $product->image);
            if (File::exists($old_path)) {
                if ($product->image != 'no_product.png') {
                    File::delete($old_path);
                }
            }
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('/product_image'), $imageName);
        } else {
            if ($product->image == null) {
                $imageName = 'no_product.png';
            } else {
                $imageName = $product->image;
            }
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->status = $request->status;
        $product->image = $imageName;
        $product->cat_id = $request->category_id;
        $product->save();

        Session::flash('success', "Update Product successfully!!");
        return redirect()->route('product.index');
    }

    public function delete($id)
    {
        $product = Product::where('id', $id)->first();
        if ($product->status == "1") {
            $product->status = "0";
        } else {
            $product->status = "1";
        }
        $product->save();
        Session::flash('success', "Update Product Status successfully!!");
        return redirect()->route('product.index');
    }

    public function search(Request $request)
    {
        $query = $request->name;
        $keyword = $request->name;
        $product = Product::select(
            "product.*",
            "category.name as cat_name",
        )->leftjoin('category', 'category.id', 'product.cat_id')
            ->where('product.name', 'like', "%$keyword%")
            ->paginate(5)->setPath('');
        $product->appends(array(
            'name' => $query
        ));
        return view('product.index')
            ->with('product', $product);;
    }
}
