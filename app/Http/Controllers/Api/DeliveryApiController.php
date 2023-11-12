<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Plant;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Carbon\Carbon;
use App\Models\Delivery;


class DeliveryApiController extends Controller
{
    public function index(Request $request)
    {
        $deliveries = Delivery::where("user_id", Auth::id());

        // Sort By 
        if ($request->sortBy && in_array(
            $request->sortBy,
            [
                'id', 'created_at', 'updated_at'
            ]
        )) {
            $sortBy = $request->sortBy;
        } else {
            $sortBy = 'updated_at';
        }

        if ($request->sortOrder && in_array(
            $request->sortOrder,
            [
                'asc', 'desc'
            ]
        )) {
            $sortOrder = $request->sortOrder;
        } else {
            $sortOrder = 'desc';
        }

        if ($request->limit) {
            $limit = $request->limit;
        } else {
            $limit = 10;
        }

        $deliveries = $deliveries->orderBy($sortBy, $sortOrder)->paginate($limit);

        return $this->success($deliveries);
    }
}
