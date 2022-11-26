<?php

namespace App\Http\Controllers\Api\V1\Buyer;

use App\Models\Buyer;
use App\Http\Controllers\Controller;

class BuyerCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        $categories = $buyer->transactions()
            ->with('product.categories')
                ->get()
                ->pluck('product.categories')
                ->collapse()
                ->unique('id')
            ->values();
        return $this->apiRepository->all($categories);
    }
}
