<?php

namespace App\Http\Controllers\Api\V1\Category;

use App\Models\Category;
use App\Http\Controllers\Controller;

class CategorySellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $sellers = $category->products()->with('seller')
        ->get()
        ->pluck('seller')
        ->unique('id')
        ->values();
        return $this->apiRepository->all($sellers);
    }
}
