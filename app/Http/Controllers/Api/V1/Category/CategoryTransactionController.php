<?php

namespace App\Http\Controllers\Api\V1\Category;

use App\Models\Category;
use App\Http\Controllers\Controller;

class CategoryTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $products = $category->products()
        ->whereHas('transactions')
        ->with('transactions')
        ->get()
        ->pluck('transactions')
        ->collapse()
        ->unique('id')
        ->values();

        return $this->apiRepository->all($products);
    }
}
