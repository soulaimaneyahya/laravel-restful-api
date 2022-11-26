<?php

namespace App\Http\Controllers\Api\V1\Seller;

use App\Models\Seller;
use App\Http\Controllers\Controller;

class SellerTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seller $seller)
    {
        $buyers = $seller->products()
            ->whereHas('transactions')
            ->with('transactions')
            ->get()
            ->pluck('transactions')
            ->collapse()
            ->unique('id')
            ->values();

        return $this->apiRepository->all($buyers);
    }
}
