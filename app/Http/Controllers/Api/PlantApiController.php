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

        // Loop through the fetched plants and encode the image
        foreach ($ret['plant'] as &$plant) {
            if (!empty($plant['image'])) {
                $plant['image'] = Plant::getImageUrlAttribute($plant['image']);
            }
        }

        return $this->success($ret);
    }
}
