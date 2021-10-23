<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CoreController;
use App\Http\Controllers\InterfaceController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\AccountController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::post('/send-message', [HomeController::class, 'sendMessage']);
Route::post('/notify-admin', [HomeController::class, 'notifyAdmin']);



// Admin
Route::group(['middleware' => ['auth', 'verified']], function() {
  // Core
  Route::get('/admin', [CoreController::class, 'dashboard']);
  
  Route::get('/admin/core/message', [CoreController::class, 'showMessage']);
  
  Route::post('/admin/core/message/read', [CoreController::class, 'markAsRead']);
  Route::patch('/admin/core/message/notification', [CoreController::class, 'toggleNotification']);
  Route::delete('/admin/core/message/destroy', [CoreController::class, 'destroyMessage']);
  
  // Interface
  Route::get('/admin/interface/about', [InterfaceController::class, 'showAboutMe']);
  Route::post('/admin/interface/about/update', [InterfaceController::class, 'updateAboutMe']);
  
  Route::get('/admin/interface/contact', [InterfaceController::class, 'showMyContact']);
  Route::post('/admin/interface/contact/update', [InterfaceController::class, 'updateMyContact']);
  
  // Photo
  Route::get('/admin/photo/{section}', [PhotoController::class, 'show']);
  
  Route::post('/admin/photo/store', [PhotoController::class, 'store']);
  Route::put('/admin/photo/update', [PhotoController::class, 'update']);
  Route::delete('/admin/photo/destroy', [PhotoController::class, 'destroy']);

  // Account
  Route::get('/admin/account/change-username', [AccountController::class, 'showChangeUsernameForm']);
  Route::post('/admin/account/change-username', [AccountController::class, 'changeUsername']);

  Route::get('/admin/account/change-password', [AccountController::class, 'showChangePasswordForm']);
  Route::post('/admin/account/change-password', [AccountController::class, 'changePassword']);
});



// Authentication
Route::group(['middleware' => 'guest'], function() {
  Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
  Route::post('/login', [LoginController::class, 'login']);
  
  Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm']);
  Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail']);
  
  Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
  Route::post('/reset-password', [ResetPasswordController::class, 'reset']);
});

Route::group(['middleware' => 'auth'], function() {
  Route::get('/email/verify', [VerificationController::class, 'showVerification'])->name('verification.notice');
  Route::get('/email/verified', [VerificationController::class, 'showVerified']);
  Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
  
  Route::post('/email/resend', [VerificationController::class, 'resend']);
});

Route::get('/register', [RegisterController::class, 'showVerifyRegistrationForm']);
Route::post('/register/verify', [RegisterController::class, 'verifyRegistration']);

Route::get('/register/verified', [RegisterController::class, 'showRegistrationForm']);
Route::post('/register/verified', [RegisterController::class, 'register']);

Route::post('/logout', [LoginController::class, 'logout']);
