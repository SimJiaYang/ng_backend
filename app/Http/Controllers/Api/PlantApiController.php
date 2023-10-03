<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PlantApiController extends Controller
{
    // Pagination for plant
    public function plantList(Request $request)
    {
        $plants_query = Plant::leftjoin('category', 'category.id', 'plant.cat_id')
            ->where('plant.status', '1')
            ->where('plant.quantity', '>', '0')
            ->select('plant.*', 'category.name as category_name', 'plant.image as image');

        if ($request->limit) {
            $limit = $request->limit;
        } else {
            $limit = 8;
        }

        if ($request->noPagination) {
            $plants = $plants_query->get();
        } else {
            $plants = $plants_query->paginate($limit);
        }


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
