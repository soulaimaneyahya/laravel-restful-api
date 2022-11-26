<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\User\UserController;

use App\Http\Controllers\Api\V1\Buyer\BuyerController;
use App\Http\Controllers\Api\V1\Buyer\BuyerSellerController;
use App\Http\Controllers\Api\V1\Buyer\BuyerProductController;
use App\Http\Controllers\Api\V1\Buyer\BuyerCategoryController;
use App\Http\Controllers\Api\V1\Buyer\BuyerTransactionController;

use App\Http\Controllers\Api\V1\Seller\SellerController;
use App\Http\Controllers\Api\V1\Seller\SellerProductController;
use App\Http\Controllers\Api\V1\Seller\SellerBuyerController;
use App\Http\Controllers\Api\V1\Seller\SellerCategoryController;
use App\Http\Controllers\Api\V1\Seller\SellerTransactionController;


use App\Http\Controllers\Api\V1\Product\ProductController;


use App\Http\Controllers\Api\V1\Category\CategoryController;
use App\Http\Controllers\Api\V1\Category\CategoryBuyerController;
use App\Http\Controllers\Api\V1\Category\CategorySellerController;
use App\Http\Controllers\Api\V1\Category\CategoryProductController;
use App\Http\Controllers\Api\V1\Category\CategoryTransactionController;
use App\Http\Controllers\Api\V1\Product\ProductBuyerController;
use App\Http\Controllers\Api\V1\Product\ProductBuyerTransactionController;
use App\Http\Controllers\Api\V1\Product\ProductCategoryController;
use App\Http\Controllers\Api\V1\Product\ProductTransactiosController;
use App\Http\Controllers\Api\V1\Transaction\TransactionController;
use App\Http\Controllers\Api\V1\Transaction\TransactionSellerController;
use App\Http\Controllers\Api\V1\Transaction\TransactionCategoryController;

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
Route::resource('categories.products', CategoryProductController::class)->only(['index']);
Route::resource('categories.sellers', CategorySellerController::class)->only(['index']);
Route::resource('categories.transactions', CategoryTransactionController::class)->only(['index']);
Route::resource('categories.buyers', CategoryBuyerController::class)->only(['index']);

/**
 * Product
 */
Route::resource('products', ProductController::class)->only(['index', 'show']);
Route::resource('products.transactions', ProductTransactiosController::class)->only(['index']);
Route::resource('products.categories', ProductCategoryController::class)->only(['index', 'store', 'update', 'destroy']);
Route::resource('products.buyers', ProductBuyerController::class)->only(['index']);
Route::resource('products.buyers.transactions', ProductBuyerTransactionController::class)->only(['store']);

/**
 * Buyers
 */
Route::resource('buyers', BuyerController::class)->only(['index', 'show']);
Route::resource('buyers.transactions', BuyerTransactionController::class)->only(['index']);
Route::resource('buyers.products', BuyerProductController::class)->only(['index']);
Route::resource('buyers.sellers', BuyerSellerController::class)->only(['index']);
Route::resource('buyers.categories', BuyerCategoryController::class)->only(['index']);

/**
 * Sellers
 */
Route::resource('sellers', SellerController::class)->only(['index', 'show']);
Route::resource('sellers.transactions', SellerTransactionController::class)->only(['index']);
Route::resource('sellers.products', SellerProductController::class)->only(['index', 'store', 'update', 'destroy']);
Route::resource('sellers.buyers', SellerBuyerController::class)->only(['index']);
Route::resource('sellers.categories', SellerCategoryController::class)->only(['index']);

/**
 * Transaction
 */
Route::resource('transactions', TransactionController::class)->only(['index', 'show']);
Route::resource('transactions.categories', TransactionCategoryController::class)->only(['index']);
Route::resource('transactions.sellers', TransactionSellerController::class)->only(['index']);
