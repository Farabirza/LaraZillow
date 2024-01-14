<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ListingImageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\NotificationSeenController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\RealtorListingAcceptOfferController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/email/verify', [AuthController::class, 'verification'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function(EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('listing.index')->with('success', 'Email was verified!');
})->name('verification.verify')->middleware(['auth', 'signed']);
Route::post('/email/verication-notification', [AuthController::class, 'resend_verification'])->name('verification.send')->middleware(['auth', 'throttle:6,1']);

Route::get('/', function( ){
    return redirect('/listing');
});
Route::get('/show', [IndexController::class, 'show']);

Route::resource('/listing', ListingController::class)->except(['index', 'show', 'destroy'])->middleware('auth');
Route::resource('/listing', ListingController::class)->only(['index', 'show']);

Route::resource('listing.offer', OfferController::class)->only(['store'])->middleware('auth');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.store');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'register_store'])->name('register.store');
Route::delete('/logout', [AuthController::class, 'destroy'])->middleware('auth')->name('logout');

Route::prefix('realtor')
->name('realtor.')
->middleware(['auth', 'verified'])
->group(function() {
    Route::put('listing/{listing}/restore', [RealtorListingController::class, 'restore'])->withTrashed()->name('listing.restore');
    Route::resource('listing', RealtorListingController::class)->only(['index', 'destroy', 'show']);
    Route::resource('listing.image', ListingImageController::class)->only(['create', 'store', 'destroy']);
});

Route::put('/realtor/offer/{offer}/accept', RealtorListingAcceptOfferController::class)->name('realtor.offer.accept')->middleware('auth');

Route::resource('notification', NotificationController::class)->middleware('auth')->only(['index']);
Route::put('notification/{notification}/seen', NotificationSeenController::class)->name('notification.seen')->middleware('auth');