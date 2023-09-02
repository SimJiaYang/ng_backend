<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PlantApiController extends Controller
{
    // Show Plant Info
    public function index()
    {

        $plants = Plant::leftjoin('category', 'category.id', 'plant.cat_id')
            ->where('plant.status', '1')
            ->where('plant.quantity', '>', '0')
            ->select('plant.*', 'category.name as category_name', 'plant.image as image')
            ->get();

        $ret['plant'] = $plants;

        return $this->success($ret);
    }

    public function show(Request $request)
    {
        $plants = Plant::where('plant.id', $request->id)
            ->where('plant.status', '1')
            ->where('plant.quantity', '>', '0')
            ->select('plant.*')
            ->first();

        if ($plants != null) {
            $ret['plant'] = $plants;
            return $this->success($ret);
        } else {
            return $this->fail('Plant not found');
        }
    }
}
