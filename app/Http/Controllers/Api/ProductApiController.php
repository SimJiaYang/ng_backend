<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Http\Controllers\Controller;

class ProductApiController extends Controller
{
    // Show Product Info
    public function index()
    {
        $products = Product::leftjoin('category', 'category.id', 'product.cat_id')
            ->where('product.status', '1')
            ->where('product.quantity', '>', '0')
            ->select('product.*', 'category.name as category_name', 'product.image as image')
            ->get();

        $ret['product'] = $products;

        return $this->success($ret);
    }
}
