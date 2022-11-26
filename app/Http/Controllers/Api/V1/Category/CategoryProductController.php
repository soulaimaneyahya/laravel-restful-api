<?php

namespace App\Http\Controllers\Api\V1\Category;

use App\Models\Category;
use App\Http\Controllers\Controller;

class CategoryProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $products = $category->products;
        return $this->apiRepository->all($products);
    }
}
