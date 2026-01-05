<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Institution;
use App\Models\User;
use App\Models\Merchant;
use App\Models\Payment;
use App\Models\Saving;
use App\Models\Gether;
use App\Models\Bill;
use App\Models\Claim;
use App\Models\PaymentDetail;
use App\Models\Transaction;
use Carbon\Carbon;

class DashboardController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        
        $user = User::where('id', Auth()->user()->id)->first();
      
        

        if($user->access_id == '1'){
            //admin

            $userBalance = User::sum('balance');
            $institutionBalance = Institution::sum('balance');
            

            $users = User::count();
            $institutions = Institution::count();
            $students = Student::count();
            $merchants = Merchant::count();
            $bill = Bill::where('status', 'success')->sum('amount');
            $invoice = Institution::sum('invoice');
            $profit = Institution::sum('profit');
            $claim = Claim::where('status', 'approved')->sum('amount');
            $saving = Saving::sum('balance');
            $gether = Gether::sum('balance');
            $payment = Transaction::where('transaction_category_id', '3')->sum('amount');
            $shop = Transaction::where('transaction_category_id', '8')->sum('amount');

            $allBalance = $userBalance +  $institutionBalance + $saving + $gether;

            return view('admin.dashboard.admin', 
            compact('users','userBalance','institutionBalance','allBalance','payment', 'institutions','shop', 'students','merchants','bill','invoice','profit','claim','saving','gether'));

        }
        elseif($user->access_id == '2')
        {
            //institution

            $userBalance = User::where('institution_id', $user->institution_id)->sum('balance');
            $institutionBalance = Institution::where('id', $user->institution_id)->sum('balance');
            $allBalance = $userBalance +  $institutionBalance;

            $users = User::where('institution_id', $user->institution_id)->count();
            
            $students = Student::where('institution_id', $user->institution_id)->count();
            $merchants = Merchant::where('institution_id', $user->institution_id)->count();
            $bill = Bill::where('institution_id', $user->institution_id)->where('status', 'success')->sum('amount');
            $invoice = Institution::where('id', $user->institution_id)->sum('invoice');
            $profit = Institution::where('id', $user->institution_id)->sum('profit');
            $claim = Claim::where('institution_id', $user->institution_id)->where('status', 'approved')->sum('amount');
            $saving = Saving::where('institution_id', $user->institution_id)->sum('balance');
            $gether = Gether::where('institution_id', $user->institution_id)->sum('balance');
            //$payment = PaymentDetail::where('institution_id', $user->institution_id)->sum('amount');
            $payment = Transaction::where('institution_id', $user->institution_id)->where('transaction_category_id', '3')->sum('amount');
            $shop = Transaction::where('institution_id', $user->institution_id)->where('transaction_category_id', '8')->sum('amount');

            return view('admin.dashboard.institution', 
            compact('users','payment','userBalance','institutionBalance','allBalance', 'shop', 'students','merchants','bill','invoice','profit','claim','saving','gether'));

        }

        elseif($user->access_id == '6')
        {
            //admin

            $userBalance = User::where('institution_id', $user->institution_id)->sum('balance');
            $institutionBalance = Institution::where('id', $user->institution_id)->sum('balance');
            $allBalance = $userBalance +  $institutionBalance;

            $users = User::where('institution_id', $user->institution_id)->count();
            
            $students = Student::where('institution_id', $user->institution_id)->count();
            $merchants = Merchant::where('institution_id', $user->institution_id)->count();
            $bill = Bill::where('institution_id', $user->institution_id)->where('status', 'success')->sum('amount');
            $invoice = Institution::where('id', $user->institution_id)->sum('invoice');
            $profit = Institution::where('id', $user->institution_id)->sum('profit');
            $claim = Claim::where('institution_id', $user->institution_id)->where('status', 'approved')->sum('amount');
            $saving = Saving::where('institution_id', $user->institution_id)->sum('balance');
            $gether = Gether::where('institution_id', $user->institution_id)->sum('balance');
            $payment = Transaction::where('institution_id', $user->institution_id)->where('transaction_category_id', '3')->sum('amount');
            $shop = Transaction::where('institution_id', $user->institution_id)->where('transaction_category_id', '8')->sum('amount');

            return view('admin.dashboard.institution', 
            compact('users','payment','userBalance','institutionBalance','allBalance', 'shop', 'students','merchants','bill','invoice','profit','claim','saving','gether'));

        }

        elseif($user->access_id == '3')
        {
            //merchant
            $now = Carbon::now()->isoFormat('YYYY-MM-DD');
            $month = Carbon::now()->isoFormat('YYYY-MM');

            $transToday = Transaction::where('destination_id',auth()->user()->id)
            ->where('transaction_category_id','8')
            ->where('created_at', 'like', '%'. $now . '%')->sum('amount');

            $transMonth = Transaction::where('destination_id',auth()->user()->id)
            ->where('transaction_category_id','8')
            ->where('created_at', 'like', '%'. $month . '%')->sum('amount');

             $saving = Saving::where('institution_id', $user->institution_id)->where('user_id', $user->id)->sum('balance');
             $gether = Gether::where('institution_id', $user->institution_id)->where('user_id', $user->id)->sum('balance');
             $sharing = Transaction::where('institution_id', $user->institution_id)
             ->where('user_id', $user->id)->where('transaction_category_id', '2')->sum('amount');
 
             return view('admin.dashboard.merchant', 
             compact('gether','saving','sharing','user','transToday','transMonth'));
 
        }
        else
        {
            //student
           
             $saving = Saving::where('institution_id', $user->institution_id)->where('user_id', $user->id)->sum('balance');
             $gether = Gether::where('institution_id', $user->institution_id)->where('user_id', $user->id)->sum('balance');
             $payment = PaymentDetail::where('institution_id', $user->institution_id)->where('user_id', $user->id)->sum('amount'); 
             $shop = Transaction::where('institution_id', $user->institution_id)
             ->where('user_id', $user->id)->where('transaction_category_id', '8')->sum('amount');
             $sharing = Transaction::where('institution_id', $user->institution_id)
             ->where('user_id', $user->id)->where('transaction_category_id', '2')->sum('amount');
 
             return view('admin.dashboard.student', 
             compact('payment', 'shop', 'gether','saving','sharing','user'));

        }
        
        

    }
}