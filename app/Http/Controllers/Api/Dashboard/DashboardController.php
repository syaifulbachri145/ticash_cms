<?php

namespace App\Http\Controllers\Api\Dashboard;

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
    
    public function dashboard()
    {

        $user = User::where('id', Auth()->guard('api')->user()->id)->first();

        $saving = Saving::where('institution_id', $user->institution_id)->where('user_id', $user->id)->sum('balance');
        
        $gether = Gether::where('institution_id', $user->institution_id)->where('user_id', $user->id)->sum('balance');
        $payment = PaymentDetail::where('institution_id', $user->institution_id)->where('user_id', $user->id)->sum('amount'); 
        $shop = Transaction::where('institution_id', $user->institution_id)
        ->where('user_id', $user->id)->where('transaction_category_id', '8')->sum('amount');
        $sharing = Transaction::where('institution_id', $user->institution_id)
        ->where('user_id', $user->id)->where('transaction_category_id', '2')->sum('amount');

        return response()->json([
            'success' => true,
            'message'   => 'Dashboard',
            'saving' => $saving,
            'gether' => $gether,
            'payment' => $payment,
            'shop' => $shop,
            'sharing' => $sharing,
        ], 200);

    }

    public function index()
    {

        $user = User::whereId(auth()->guard('api')->user()->id)->first();
        $institution = Institution::where('id', $user->institution_id)->first();

       // $users = User::latest()
       // ->where('institution_id',$user->institution_id)->when(request()->q, function($users) {
       //     $users = $users->where('phone', 'like', '%'. request()->q . '%');
       // })->paginate(10);
       
            return response()->json([
                'success'        => true,
                'user'           => auth()->user(),
                'institution'    => $institution,
        //        'data'          => $users
            ], 200);
    }

    public function userSearch()
    {
        $user = User::whereId(auth()->guard('api')->user()->id)->first();

        $users = User::latest()
        ->where('institution_id',$user->institution_id)->when(request()->q, function($users) {
            $users = $users->where('phone', 'like', '%'. request()->q . '%');
        })->paginate(10);
       
            return response()->json([
                'success'        => true,
                'user'           => auth()->user(),
                'data'          => $users
            ], 200);
    }
   


}
