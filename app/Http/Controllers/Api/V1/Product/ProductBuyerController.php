<?php

namespace App\Http\Controllers\Api\V1\Product;

use App\Models\Product;
use App\Http\Controllers\Controller;

class ProductBuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $buyers = $product->transactions()
            ->with('buyer')
            ->get()
            ->pluck('buyer')
            ->unique('id')
            ->values();

        return $this->apiRepository->all($buyers);
    }
}
