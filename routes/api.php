<?php

//namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::group(['middleware' => 'auth:api'], function() {
    Route::get('/user', [App\Http\Controllers\Api\Account\AuthController::class, 'getUser'])->name('api.user.user');
});

//Auth
Route::post('/login', [App\Http\Controllers\Api\Account\AuthController::class, 'login'])->name('api.user.login');
Route::post('/register', [App\Http\Controllers\Api\Account\AuthController::class, 'register'])->name('api.user.register');
//Route::get('/user', [App\Http\Controllers\Api\Account\AuthController::class, 'getUser'])->name('api.user.user');

//Profile
Route::get('/profile', [App\Http\Controllers\Api\Account\ProfileController::class, 'user'])->middleware('auth:api');
Route::post('/profile', [App\Http\Controllers\Api\Account\ProfileController::class, 'updateProfile'])->middleware('auth:api');
Route::post('/bank', [App\Http\Controllers\Api\Account\ProfileController::class, 'updateBank'])->middleware('auth:api');
Route::post('/student', [App\Http\Controllers\Api\Account\StudentController::class, 'StudentRegister'])->middleware('auth:api');
Route::post('/address', [App\Http\Controllers\Api\Account\ProfileController::class, 'updateAddress'])->middleware('auth:api');
Route::post('/profile/password', [App\Http\Controllers\Api\Account\ProfileController::class, 'updatePassword'])->middleware('auth:api');

Route::get('/historyPages', [App\Http\Controllers\Api\Transaction\HistoryController::class, 'historyPage'])->middleware('auth:api');

//Dashboard
Route::get('/dashboard', [App\Http\Controllers\Api\Dashboard\DashboardController::class, 'index'])->middleware('auth:api');
Route::get('/userSearch', [App\Http\Controllers\Api\Dashboard\DashboardController::class, 'userSearch'])->middleware('auth:api');




//transaction ----------------------------------------------------------------------

//topup
Route::post('/topupVa', [App\Http\Controllers\Api\Transaction\TopupController::class, 'topupVA'])->middleware('auth:api');
Route::post('/topupBank', [App\Http\Controllers\Api\Transaction\TopupController::class, 'topupBank'])->middleware('auth:api');
Route::get('/topups', [App\Http\Controllers\Api\Transaction\TopupController::class, 'topups'])->middleware('auth:api');
Route::get('/processingTopups', [App\Http\Controllers\Api\Transaction\TopupController::class, 'processingTopups'])->middleware('auth:api');
Route::get('/topup/{id?}', [App\Http\Controllers\Api\Transaction\TopupController::class, 'show'])->middleware('auth:api');
Route::post('/topupConfirm', [App\Http\Controllers\Api\Transaction\TopupController::class, 'update'])->middleware('auth:api');
Route::post('/topupProcess', [App\Http\Controllers\Api\Transaction\TopupController::class, 'process'])->middleware('auth:api');


//Shop
Route::get('/merchants', [App\Http\Controllers\Api\Transaction\ShopController::class, 'merchants'])->middleware('auth:api');
Route::get('/merchant/{id?}', [App\Http\Controllers\Api\Transaction\ShopController::class, 'show'])->middleware('auth:api');
Route::post('/createShop', [App\Http\Controllers\Api\Transaction\ShopController::class, 'createShop'])->middleware('auth:api');

//transfer
Route::get('/sharingDes', [App\Http\Controllers\Api\Transaction\SharingController::class, 'sharingDestination'])->middleware('auth:api');
Route::post('/sharingDes', [App\Http\Controllers\Api\Transaction\SharingController::class, 'createSharingDes'])->middleware('auth:api');
Route::post('/createSharing', [App\Http\Controllers\Api\Transaction\SharingController::class, 'createSharing'])->middleware('auth:api');
Route::get('/sharing/{id?}', [App\Http\Controllers\Api\Transaction\SharingController::class, 'show'])->middleware('auth:api');


//withdrawal
Route::get('/withdrawals', [App\Http\Controllers\Api\Transaction\WithdrawalController::class, 'index'])->middleware('auth:api');
Route::post('/withdrawal', [App\Http\Controllers\Api\Transaction\WithdrawalController::class, 'store'])->middleware('auth:api');

//payment
Route::get('/payments', [App\Http\Controllers\Api\Transaction\PaymentController::class, 'payments'])->middleware('auth:api');
Route::get('/payment/{id?}', [App\Http\Controllers\Api\Transaction\PaymentController::class, 'show'])->middleware('auth:api');
Route::post('/createPayment', [App\Http\Controllers\Api\Transaction\PaymentController::class, 'createPayment'])->middleware('auth:api');

//saving
Route::get('/savings', [App\Http\Controllers\Api\Saving\SavingController::class, 'savings'])->middleware('auth:api');
Route::get('/saving/{id?}', [App\Http\Controllers\Api\Saving\SavingController::class, 'show'])->middleware('auth:api');
Route::post('/createSaving', [App\Http\Controllers\Api\Saving\SavingController::class, 'createSaving'])->middleware('auth:api');
Route::post('/storeSaving', [App\Http\Controllers\Api\Saving\SavingController::class, 'storeSaving'])->middleware('auth:api');
Route::post('/reedemSaving', [App\Http\Controllers\Api\Saving\SavingController::class, 'reedemSaving'])->middleware('auth:api');
Route::post('/updateSaving', [App\Http\Controllers\Api\Saving\SavingController::class, 'updateSaving'])->middleware('auth:api');
Route::post('/removeSaving', [App\Http\Controllers\Api\Saving\SavingController::class, 'removeSaving'])->middleware('auth:api');

//gether
Route::get('/gethers', [App\Http\Controllers\Api\Saving\GetherController::class, 'gethers'])->middleware('auth:api');
Route::get('/members/{id?}', [App\Http\Controllers\Api\Saving\GetherMemberController::class, 'members'])->middleware('auth:api');
Route::get('/gether/{id?}', [App\Http\Controllers\Api\Saving\GetherController::class, 'showGether'])->middleware('auth:api');
Route::get('/member/{id?}', [App\Http\Controllers\Api\Saving\GetherMemberController::class, 'showMember'])->middleware('auth:api');
Route::post('/createGether', [App\Http\Controllers\Api\Saving\GetherController::class, 'createGether'])->middleware('auth:api');
Route::post('/addMember', [App\Http\Controllers\Api\Saving\GetherMemberController::class, 'addMember'])->middleware('auth:api');
Route::get('/removeMember/{id?}', [App\Http\Controllers\Api\Saving\GetherController::class, 'removeMember'])->middleware('auth:api');
Route::post('/savingGether', [App\Http\Controllers\Api\Saving\GetherController::class, 'savingGether'])->middleware('auth:api');
Route::post('/savingMember', [App\Http\Controllers\Api\Saving\GetherMemberController::class, 'savingMember'])->middleware('auth:api');
Route::post('/reedemGether', [App\Http\Controllers\Api\Saving\GetherController::class, 'reedemGether'])->middleware('auth:api');
Route::post('/updateGether', [App\Http\Controllers\Api\Saving\GetherController::class, 'updateGether'])->middleware('auth:api');
Route::post('/removeGether', [App\Http\Controllers\Api\Saving\GetherController::class, 'removeGether'])->middleware('auth:api');



//Media
Route::get('/sliders', [App\Http\Controllers\Api\Media\SliderController::class, 'index'])->name('user.slider.index');

