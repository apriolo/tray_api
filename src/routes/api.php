<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\SellerController;
use App\Http\Controllers\Api\SaleController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/sellers', [SellerController::class, 'store']);
Route::get('/sellers', [SellerController::class, 'index']);


Route::get('/sales/seller/{id}', [SaleController::class, 'salesBySeller'])->where('id', '[0-9]+');
Route::post('/sales', [SaleController::class, 'store']);

