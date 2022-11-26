<?php

namespace App\Http\Controllers\Api\V1\Seller;

use App\Models\Seller;
use App\Http\Controllers\Controller;

class SellerCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seller $seller)
    {
        $categories = $seller->products()
            ->with('categories')
            ->get()
            ->pluck('categories')
            ->collapse()
            ->unique('id')
            ->values();

        return $this->apiRepository->all($categories);
    }
}
