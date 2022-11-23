<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Buyer\BuyerController;
use App\Http\Controllers\Api\V1\Category\CategoryController;
use App\Http\Controllers\Api\V1\Product\ProductController;
use App\Http\Controllers\Api\V1\Seller\SellerController;
use App\Http\Controllers\Api\V1\Transaction\TransactionController;
use App\Http\Controllers\Api\V1\User\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

/**
 * Users
 */
Route::resource('users', UserController::class)->except(['create', 'edit']);

/**
 * Category
 */
Route::resource('categories', CategoryController::class)->except(['create', 'edit']);

/**
 * Product
 */
Route::resource('products', ProductController::class)->except(['create', 'edit']);

/**
 * Buyers
 */
Route::resource('buyers', BuyerController::class)->only(['index', 'show']);

/**
 * Sellers
 */
Route::resource('sellers', SellerController::class)->only(['index', 'show']);

/**
 * Transaction
 */
Route::resource('transactions', TransactionController::class)->only(['index', 'show']);
