<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plant;
use Illuminate\Http\Request;


class PlantApiController extends Controller
{
    // Show Plant Info
    public function index()
    {
        $ret['plant'] = Plant::leftjoin('category', 'category.id', 'plant.cat_id')
            ->where('plant.status', '1')
            ->where('plant.quantity', '>', '0')
            ->select('plant.*', 'category.name')
            ->get();
        return $this->success($ret);
    }
}
