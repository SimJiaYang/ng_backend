<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    // Show Product Info
    public function productList(Request $request)
    {
        $product_query = Product::leftjoin('category', 'category.id', 'product.cat_id')
            ->where('product.status', '1')
            ->where('product.quantity', '>', '0')
            ->select('product.*', 'category.name as category_name', 'product.image as image');

        if ($request->limit) {
            $limit = $request->limit;
        } else {
            $limit = 8;
        }

        if ($request->noPagination) {
            $products = $product_query->get();
        } else {
            $products = $product_query->paginate($limit);
        }


        $ret['products'] = $products;

        return $this->success($ret);
    }
}
