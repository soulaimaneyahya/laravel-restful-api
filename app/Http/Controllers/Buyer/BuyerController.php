<?php

namespace App\Http\Controllers\Buyer;

use App\Models\Buyer;
use App\Services\UserService;
use App\Http\Controllers\ApiController;

class BuyerController extends ApiController
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
        return $this->userService->all(Buyer::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function show(Buyer $buyer)
    {
        return $this->userService->find($buyer);
    }
}
