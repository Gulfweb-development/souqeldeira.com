<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthCompany\LoginController;
use App\Http\Controllers\AuthCompany\RegisterController;
use App\Http\Controllers\AuthCompany\ResetPasswordController;
use App\Http\Controllers\AuthCompany\ForgotPasswordController;
use App\Http\Controllers\AuthCompany\ConfirmPasswordController;


// Route::prefix('company')->name('company.')->group(function () {

//     // AUTH LINKS START
//     Route::get('/register',[RegisterController::class, 'showRegistrationForm'])->name('register');
//     Route::post('/register',[RegisterController::class, 'register'])->name('register.submit');
//     Route::get('/login',[LoginController::class, 'showLoginForm'])->name('login');
//     Route::post('/login',[LoginController::class,'login'])->name('login.submit');
//     Route::post('/password/email',[ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
//     Route::get('/password/confirm',[ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
//     Route::post('/password/confirm',[ConfirmPasswordController::class, 'confirm'])->name('password.confirm.submit');
//     Route::get('/password/reset/{token}',[ResetPasswordController::class, 'showResetForm'])->name('password.reset');
//     Route::get('/password/reset',[ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
//     Route::post('/password/reset',[ResetPasswordController::class, 'reset'])->name('password.update');

//     // AUTH LINKS END
//     Route::get('/dashboard', function () {
//         // return 'DASHBOARD OF COMPANY GUARDL ';
//         return view('homeCompany');
//     });
// });
//  END COMPANY PREFIX
