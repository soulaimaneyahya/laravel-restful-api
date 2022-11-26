<?php

namespace App\Http\Controllers\Api\V1\Seller;

use App\Models\Seller;
use App\Models\Product;
use App\Services\SellerService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class SellerProductController extends Controller
{
    public function __construct
    (
        private SellerService $sellerService
    )
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seller $seller)
    {
        $products = $seller->products;

        return $this->sellerService->all($products);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request, Seller $seller)
    {
        return $this->sellerService->store($request->validated(), $seller);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Seller $seller, Product $product)
    {
        return $this->sellerService->update($request->validated(), $seller, $product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller, Product $product)
    {
        return $this->sellerService->delete($seller, $product);
    }
}
