<?php

use App\Http\Controllers\Api\Advertise\AdvertiseController;
use App\Http\Controllers\Api\Advertise\AssetsController;
use App\Http\Controllers\Api\AssetsController as MainAssetController;
use App\Http\Controllers\Api\Panel\AuthController;
use App\Http\Controllers\Api\Panel\NotificationController;
use App\Http\Controllers\Api\Panel\ProfileController;
use App\Http\Controllers\Api\Panel\subscriptionController;
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
    Route::post('favorites' , [AdvertiseController::class , 'favorites']);
    Route::post('notifications' , [NotificationController::class , 'notifications']);
    Route::post('notifications/delete' , [NotificationController::class , 'notificationsDelete']);
    Route::post('notifications/view' , [NotificationController::class , 'notificationsView']);
    Route::post('messages' , [NotificationController::class , 'messages']);
    Route::post('messages/delete' , [NotificationController::class , 'messagesDelete']);
    Route::post('messages/view' , [NotificationController::class , 'messagesView']);
    Route::post('adDetails/messages' , [NotificationController::class , 'messagesAdd']);
    Route::post('updatePassword' , [ProfileController::class , 'updatePassword']);
    Route::post('profile' , [ProfileController::class , 'profile']);
    Route::post('profile/delete' , [ProfileController::class , 'delete']);
    Route::post('editProfile' , [ProfileController::class , 'editProfile']);
    Route::post('subscription/list' , [subscriptionController::class , 'list']);
    Route::post('subscription/payAsGo' , [subscriptionController::class , 'payAsGo']);
    Route::post('subscription/package' , [subscriptionController::class , 'package']);
    Route::post('invoices' , [subscriptionController::class , 'invoices']);
    Route::post('my-ads/list' , [AdvertiseController::class , 'myAds']);
    Route::post('my-ads/expired' , [AdvertiseController::class , 'myExpiredAds']);
    Route::post('my-ads/delete' , [AdvertiseController::class , 'delete']);
    Route::post('my-ads/detail' , [AdvertiseController::class , 'myAdDetails']);
    Route::post('my-ads/edit' , [AdvertiseController::class , 'myAdEdit']);
    Route::post('my-ads/delete-image' , [AdvertiseController::class , 'myAdDeleteImage']);
    Route::post('my-ads/upgrade' , [AdvertiseController::class , 'upgrade']);
    Route::post('my-ads/create' , [AdvertiseController::class , 'create']);
});
