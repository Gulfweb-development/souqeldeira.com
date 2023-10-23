<?php

use App\Http\Controllers\Api\Advertise\AdvertiseController;
use App\Http\Controllers\Api\Advertise\AssetsController;
use App\Http\Controllers\Api\AssetsController as MainAssetController;
use App\Http\Controllers\Api\Panel\AuthController;
use App\Http\Controllers\Api\Panel\NotificationController;
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
Route::post('home' , [AssetsController::class , 'home']);
Route::post('governorates' , [AssetsController::class , 'governorates']);
Route::post('saleType' , [AssetsController::class , 'saleType']);
Route::post('buildingType' , [AssetsController::class , 'buildingType']);
Route::post('search' , [AdvertiseController::class , 'search']);
Route::post('adDetails' , [AdvertiseController::class , 'adDetails']);
Route::post('viewAdd' , [AdvertiseController::class , 'viewAdd']);
Route::post('offices' , [AssetsController::class , 'offices']);
Route::post('contactUs' , [MainAssetController::class , 'contactUs']);
Route::post('settings' , [MainAssetController::class , 'settings']);
Route::post('terms' , [MainAssetController::class , 'terms']);
Route::middleware('auth:api')->group(function () {
    Route::post('addToFavorite' , [AdvertiseController::class , 'addToFavorite']);
    Route::post('notifications' , [NotificationController::class , 'notifications']);
    Route::post('notifications/delete' , [NotificationController::class , 'notificationsDelete']);
});
