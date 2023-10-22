<?php

use App\Http\Controllers\Api\AdvertiseController;
use App\Http\Controllers\Api\Panel\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login' , [AuthController::class , 'login']);
Route::post('register' , [AuthController::class , 'register']);
Route::post('forgetPassword' , [AuthController::class , 'forgetPassword']);
Route::middleware('auth:api')->get('/user', function (Request $request) {
Route::post('governorates' , [AdvertiseController::class , 'governorates']);
Route::post('saleType' , [AdvertiseController::class , 'saleType']);
Route::post('buildingType' , [AdvertiseController::class , 'buildingType']);
Route::middleware('auth:api')->group(function () {
//    Route::
});
