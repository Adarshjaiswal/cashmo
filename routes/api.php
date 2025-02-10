<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MobileRechargeController;
use App\Http\Controllers\ProviderController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function () {
    Route::post('/mobile-recharge', [MobileRechargeController::class, 'recharge']);
   
    

});
Route::get('/mobile-recharge-providers', [MobileRechargeController::class, 'GetRechargeProviders']);
Route::get('/dth-recharge-providers', [MobileRechargeController::class, 'GetDthProviders']);

Route::get('/get-mrs-provider', [ProviderController::class, 'getProviderList']);
