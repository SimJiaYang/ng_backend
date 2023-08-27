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

        // Loop through the fetched plants and encode the image
        foreach ($ret['product'] as &$product) {
            if (!empty($product['image'])) {
                $product['image'] = Product::getImageUrlAttribute($product['image']);
            }
        }

        return $this->success($ret);
    }
}
