<?php

namespace App\Http\Controllers\Seller;

use App\Models\Seller;
use App\Services\UserService;
use App\Http\Controllers\ApiController;

class SellerController extends ApiController
{
    public function __construct
    (
        private UserService $userService,
    )
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sellers = Seller::has('products')->get();
        return $this->userService->all($sellers);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function show(Seller $seller)
    {
        $seller = Seller::has('products')->findOrFail($seller->id);
        return $this->userService->find($seller);
    }
}
