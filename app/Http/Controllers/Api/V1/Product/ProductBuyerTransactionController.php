<?php

namespace App\Http\Controllers\Api\V1\Product;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransaction;
use App\Models\Buyer;
use App\Services\TransactionService;

class ProductBuyerTransactionController extends Controller
{
    public function __construct(private TransactionService $transactionService)
    {        
    }

    public function store(StoreTransaction $request, Product $product, Buyer $buyer)
    {
        return $this->transactionService->store($request->validated(), $product, $buyer);
    }
}
