<?php

namespace App\Http\Controllers\Api\V1\Buyer;

use App\Models\Buyer;
use App\Http\Controllers\Controller;

class BuyerProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        $products = $buyer->transactions()
            ->with('product')
                ->get()
                ->pluck('product')
                ->unique('id')
            ->values();
        return $this->apiRepository->all($products);
    }
}
