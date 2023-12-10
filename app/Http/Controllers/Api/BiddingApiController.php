<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bidding;
use DateTime;
use Carbon\Carbon;

class BiddingApiController extends Controller
{
	/**
	 * Display a listing of the resource.
	 * @param string $limit
	 * @return Pagination 
	 * List of Bidding
	 */
	public function index(Request $request)
	{
		$datetime = Carbon::now()->toDateTimeString();
		$bidding_query = Bidding::leftjoin('plant', 'plant.id', 'bidding.plant_id')
			->leftjoin('category', 'category.id', 'plant.cat_id')
			->select(
				'bidding.*',
				'plant.*',
				'plant.id as plant_id',
				'bidding.id as bidding_id',
				'category.name as category_name'
			)
			->where('bidding.status', '1')
			// ->where('start_time', '<=', $date)
			->where('end_time', '>=', $datetime);

		// Pagination Limit
		if ($request->limit) {
			$limit = $request->limit;
		} else {
			$limit = 8;
		}

		// Sort By 
		if ($request->sortBy && in_array(
			$request->sortBy,
			[
				'bidding.id', 'bidding.created_at'
			]
		)) {
			$sortBy = $request->sortBy;
		} else {
			$sortBy = 'bidding.id';
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

		// Pagination
		$bidding = $bidding_query->orderBy(
			$sortBy,
			$sortOrder
		)->paginate($limit);


		$ret['bidding'] = $bidding;
		return $this->success($ret);
	}
}
