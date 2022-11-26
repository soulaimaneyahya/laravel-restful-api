<?php

namespace App\Http\Controllers\Api\V1\Transaction;

use App\Models\Transaction;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->apiRepository->all(Transaction::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return $this->apiRepository->find($transaction);
    }
}
