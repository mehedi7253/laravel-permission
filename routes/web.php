<?php

use App\Http\Controllers\BkashTokenizePaymentController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);



    Route::get('/bkash/payment', [BkashTokenizePaymentController::class,'index']);
    Route::get('/bkash/create-payment', [BkashTokenizePaymentController::class,'createPayment'])->name('bkash-create-payment');
    Route::get('/bkash/callback', [BkashTokenizePaymentController::class,'callBack'])->name('bkash-callBack');

    //search payment
    Route::get('/bkash/search/{trxID}', [BkashTokenizePaymentController::class,'searchTnx'])->name('bkash-serach');

    //refund payment routes
    Route::get('/bkash/refund', [BkashTokenizePaymentController::class,'refund'])->name('bkash-refund');
    Route::get('/bkash/refund/status', [BkashTokenizePaymentController::class,'refundStatus'])->name('bkash-refund-status');

    Route::get('/divisions', [LocationController::class, 'getDivisions']);
    Route::get('/divisions/{divisionId}/districts', [LocationController::class, 'getDistricts']);
    Route::get('/districts/{districtId}/upazilas', [LocationController::class, 'getUpazilas']);


    //
    Route::get('/location', [LocationController::class, 'index']);

});

