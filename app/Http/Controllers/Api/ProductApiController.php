<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    public function product()
    {
        $product = Product::leftjoin('category', 'category.id', 'product.cat_id')
            ->where('product.status', '1')
            ->where('product.quantity', '>', '0')
            ->select('product.*', 'category.name as category_name', 'product.image as image')
            ->get();

        if ($product->count() == 0) {
            return $this->fail('No product data available');
        }

        $ret['products'] = $product;
        return $this->success($ret);
    }

    // Show Product Info
    public function productList(Request $request)
    {
        $product_query = Product::leftjoin('category', 'category.id', 'product.cat_id')
            ->where('product.status', '1')
            ->where('product.quantity', '>', '0')
            ->select('product.*', 'category.name as category_name', 'product.image as image');

        // Search by product name
        if ($request->keyword) {
            $product_query = $product_query->where('product.name', 'like', '%' . $request->keyword . '%');
        }

        // Search by category
        if ($request->category) {
            $product_query =  $product_query->whereHas(
                'category',
                function ($query) use ($request) {
                    $query->where('category.name', $request->category);
                }
            );
        }

        // If result is impty, return fail
        if ($product_query->count() == 0) {
            return $this->fail('Product no found');
        }

        // Sort By 
        if ($request->sortBy && in_array(
            $request->sortBy,
            [
                'id', 'created_at'
            ]
        )) {
            $sortBy = $request->sortBy;
        } else {
            $sortBy = 'id';
        }

        if ($request->sortOrder && in_array(
            $request->sortOrder,
            [
                'asc', 'desc'
            ]
        )) {
            $sortOrder = $request->sortOrder;
        } else {
            $sortOrder = 'asc';
        }

        if ($request->limit) {
            $limit = $request->limit;
        } else {
            $limit = 8;
        }


        $products = $product_query->orderBy(
            $sortBy,
            $sortOrder
        )->paginate($limit);

        $ret['products'] = $products;

        return $this->success($ret);
    }

    public function getCategory()
    {
        $category =  Category::where('type', 'product')
            ->where('status', '1')->get();
        if ($category->count() == 0) {
            return $this->fail('No category data available');
        }
        $ret['category'] = $category;
        return $this->success($ret);
    }
}
