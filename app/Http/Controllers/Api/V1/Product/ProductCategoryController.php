<?php

namespace App\Http\Controllers\Api\V1\Product;

use App\Models\Product;
use App\Models\Category;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategory;
use App\Http\Requests\UpdateCategory;

class ProductCategoryController extends Controller
{
    public function __construct
    (
        private CategoryService $categoryService
    )
    {
    }

    /**
     *
     * @param Product $product
     * @return void
     */
    public function index(Product $product)
    {
        $categories = $product->categories;
        return $this->categoryService->all($categories);
    }

    /**
     *
     * @param StoreCategory $request
     * @param Product $product
     * @return void
     */
    public function store(StoreCategory $request, Product $product)
    {
        return $this->categoryService->store($request->validated(), $product);
    }

    /**
     *
     * @param UpdateCategory $request
     * @param Product $product
     * @param Category $category
     * @return void
     */
    public function update(UpdateCategory $request,Product $product, Category $category)
    {
        return $this->categoryService->update($request->validated(), $product , $category);
    }

    /**
     *
     * @param Product $product
     * @param Category $category
     * @return void
     */
    public function destroy(Product $product, Category $category)
    {
        return $this->categoryService->delete($product, $category);
    }
}
