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
        return $this->userService->all(Seller::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function show(Seller $seller)
    {
        return $this->userService->find($seller);
    }
}
