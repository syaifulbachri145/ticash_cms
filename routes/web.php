<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

/**
 * route for admin
 */

//group route with prefix "admin"
Route::prefix('admin')->group(function () {

    //group route with middleware "auth"
    Route::group(['middleware' => 'auth'], function() {

        //route dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');

        //Merchant
        Route::resource('/shop', ShopController::class, ['except' => 'show' ,'as' => 'admin']);
        
        //-----------------------------------------------------------------------------------------------------------
 
        
        //------ TRANSACTION ---------------------------------------------------------------------------------------

        //Topup
        Route::resource('/topup', TopupController::class, ['except' => 'show' ,'as' => 'admin']);
        //Transfer
        Route::resource('/transfer', TransferController::class, ['except' => 'show' ,'as' => 'admin']);
        //Withdrawal
        Route::resource('/withdrawal', WithdrawalController::class, ['except' => 'show' ,'as' => 'admin']);
        //History
        Route::resource('/history', HistoryController::class, ['except' => 'show' ,'as' => 'admin']);
      
        //Transaction
        Route::resource('/transactionCategory', TransactionCategoryController::class, ['except' => 'show' ,'as' => 'admin']);

        //------ SAVING ---------------------------------------------------------------------------------------------------

        //saving
        Route::resource('/saving', SavingController::class, ['except' => 'show' ,'as' => 'admin']);
        //gether
        Route::resource('/gether', GetherController::class, ['except' => 'show' ,'as' => 'admin']);
        //getherMember
        Route::resource('/member', GetherMemberController::class, ['except' => 'show' ,'as' => 'admin']);

        //------ MEDIA --------------------------------------------------------------------------------------------
        //tag
        //Route::resource('/tag', TagController::class, ['except' => ['show'] ,'as' => 'admin']);
        //post
        Route::resource('/posts', PostController::class, ['except' => 'show' ,'as' => 'admin']);
        //post categories
        Route::resource('/postCategory', PostCategoryController::class, ['except' => 'show' ,'as' => 'admin']);
        //event
        //Route::resource('/event', EventController::class, ['except' => 'show' ,'as' => 'admin']);
        //photo
        //Route::resource('/video', VideoController::class, ['except' => 'show' ,'as' => 'admin']);
        //slider
        Route::resource('/slider', SliderController::class, ['except' => 'show' ,'as' => 'admin']);

        //------- FINANCE ---------------------------------------------------------------------------------------------------
        //claim
        Route::resource('/claim', ClaimController::class, ['except' => 'show' ,'as' => 'admin']);
        //payment
        Route::resource('/payment', PaymentController::class, ['except' => 'show' ,'as' => 'admin']);

        Route::resource('/paymentUser', PaymentUserController::class, ['except' => 'create' ,'as' => 'admin']);
     
        Route::resource('/paymentDetail', PaymentDetailController::class, ['except' => 'show' ,'as' => 'admin']);

        Route::resource('/paymentJournal', PaymentJournalController::class, ['except' => 'show' ,'as' => 'admin']);
        //bill
        Route::resource('/bill', BillController::class, ['except' => 'show' ,'as' => 'admin']);
        //Transaction
        Route::resource('/reedem', ReedemController::class, ['except' => 'show' ,'as' => 'admin']);

        //------ MASTER --------------------------------------------------------------------------------------------

        //permissions
        Route::resource('/permission', PermissionController::class, ['except' => ['show'] ,'as' => 'admin']);
        //roles
        Route::resource('/role', RoleController::class, ['except' => ['show'] ,'as' => 'admin']);
        //users
        Route::resource('/user', UserController::class, ['except' => ['show'] ,'as' => 'admin']);
        //access
        Route::resource('/access', AccessController::class, ['except' => ['show'] ,'as' => 'admin']);
        //institution
        Route::resource('/institution', InstitutionController::class, ['except' => ['show'] ,'as' => 'admin']);
        //student
        Route::resource('/student', StudentController::class, ['except' => ['show'] ,'as' => 'admin']);
        //degree
        Route::resource('/degree', DegreeController::class, ['except' => ['show'] ,'as' => 'admin']);
        //merchant
        Route::resource('/merchant', MerchantController::class, ['except' => ['show'] ,'as' => 'admin']);
        //paymentCategory
        Route::resource('/paymentCategory', PaymentCategoryController::class, ['except' => 'show' ,'as' => 'admin']);
        
        
        //------ REEPORT -------------------------------------------------------------------------------------------
    
        Route::resource('/savingReport', Report\SavingReportController::class, ['as' => 'admin']);
        Route::resource('/getherReport', Report\GetherReportController::class, ['as' => 'admin']);
        Route::resource('/claimReport', Report\ClaimReportController::class, ['as' => 'admin']);
        Route::resource('/billReport', Report\BillReportController::class, ['as' => 'admin']);
        Route::resource('/paymentReport', Report\PaymentReportController::class, ['as' => 'admin']);
        Route::resource('/reedemReport', Report\ReedemReportController::class, ['as' => 'admin']);
        Route::resource('/userReport', Report\UserReportController::class, ['as' => 'admin']);
        Route::resource('/withdrawalReport', Report\WithdrawalReportController::class, ['as' => 'admin']);
        Route::resource('/merchantReport', Report\MerchantReportController::class, ['as' => 'admin']);
   
        //----- IMPORT ---------------------------------------------------------------------------------------------
        Route::resource('/userImport', Import\UserImportController::class, ['as' => 'admin']);
   
   
    });
});