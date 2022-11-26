<?php

namespace App\Http\Controllers\Api\V1\Buyer;

use App\Models\Buyer;
use App\Http\Controllers\Controller;

class BuyerTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        $transactions = $buyer->transactions;
        return $this->apiRepository->all($transactions);
    }
}
