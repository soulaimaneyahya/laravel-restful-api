<?php

namespace App\Http\Controllers\Api\V1\Transaction;

use App\Models\Transaction;
use App\Http\Controllers\Controller;

class TransactionCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Transaction $transaction)
    {
        $categories = $transaction->product->categories;
        return $this->apiRepository->all($categories);
    }
}
