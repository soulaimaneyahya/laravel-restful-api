<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Buyer\BuyerController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Transaction\TransactionController;
use App\Http\Controllers\User\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

/**
 * Buyers
 */
Route::resource('buyers', BuyerController::class)->only(['index', 'show']);

/**
 * Sellers
 */
Route::resource('sellers', SellerController::class)->only(['index', 'show']);


/**
 * Users
 */
Route::resource('users', UserController::class)->only(['index', 'show']);


/**
 * Category
 */
Route::resource('categories', CategoryController::class)->only(['index', 'show']);

/**
 * Product
 */
Route::resource('products', ProductController::class)->only(['index', 'show']);

/**
 * Transaction
 */
Route::resource('transactions', TransactionController::class)->only(['index', 'show']);
