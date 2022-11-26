<?php

namespace App\Http\Controllers\Api\V1\Transaction;

use App\Models\Transaction;
use App\Http\Controllers\Controller;

class TransactionSellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Transaction $transaction)
    {
        $seller = $transaction->product->seller;
        return $this->apiRepository->find($seller);
    }
}
