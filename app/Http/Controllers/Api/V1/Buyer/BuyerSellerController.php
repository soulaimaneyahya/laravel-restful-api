<?php

namespace App\Http\Controllers\Api\V1\Buyer;

use App\Models\Buyer;
use App\Http\Controllers\Controller;

class BuyerSellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        $sellers = $buyer->transactions()
            ->with('product.seller')
            ->get()
            ->pluck('product.seller')
            ->unique('id')
            ->values();
        return $this->apiRepository->all($sellers);
    }
}
