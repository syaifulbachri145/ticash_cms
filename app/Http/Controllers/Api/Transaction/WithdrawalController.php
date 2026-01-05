<?php

namespace App\Http\Controllers\Api\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class WithdrawalController extends Controller
{
    public function index()
    {
       
        $user = User::whereId(auth()->guard('api')->user()->id)->first();
        $totalWithdrawal = Transaction::where('user_id',$user->id)->where('transaction_category_id', '4')->sum('amount');
       
            $withdrawals = Transaction::latest()
            ->where('user_id', $user->id)
            ->where('transaction_category_id', '4')
            ->where('disable','no')->when(request()->q, function($withdrawals) {
                $withdrawals = $withdrawals->where('description', 'like', '%'. request()->q . '%');
            })->paginate(10);
    
            return response()->json([
                'success' => true,
                'message'   => 'Detail Data Withdrawal',
                'withdrawals' => $withdrawals,
                'totalWithdrawal' => $totalWithdrawal
            ], 200);

    }
    public function createWithdrawal(Request $request)
    {
       
        $request->validate([
            'amount'       => 'required',
            //'description'   => 'required',
        ]); 

        //dd($request->user_id);

        $user = User::whereId(auth()->guard('api')->user()->id)->first();
        $institution = Institution::where('id',$user->institution_id)->first();

        //cek saldo

        if($request->amount > $user->balance){
            return response()->json([
                'success' => false,
                'message' => 'Saldo tidak cukup',
                $this->response
            ]);
        }
        else{

            $length = 5;
            $random = '';
            for ($i = 0; $i < $length; $i++) {
                $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
            }
    
            $trans_number = 'WD-'.Str::upper($random);
        //buat transaksi WD
           $withdrawal = Transaction::updateOrCreate([
            'trans_number'              => $trans_number,
            'institution_id'            => $user->institution_id,
            'user_id'                   => $user->id,
            'type'                      => 'credit',
            'transaction_category_id'   => '4', //topup category
            'destination_id'            => $user->id,
            'description'               => $request->input('description'),  
            'amount'                    => $request->input('amount'),
            'admin_fee'                 => '0',
            'shared_fee'                => '0',
            'status'                    => 'waiting',
            'disable'                   => 'no'
        ]);

        //update saldo user 
        $saldo_user = $user->balance - $request->amount;
        $saldo_institution = $institution->balance + $request->amount;
        $user->update([
            'balance' => $saldo_user
        ]);
        
        //update saldo institution
        $institution->update([
            'balance' => $saldo_institution
        ]);
            
        if($withdrawal){
            return response()->json([
                'success' => true,
                'message' => 'Withdrawal Berhasil',
                'data'    => $withdrawal,
            ], 201);
        }else{
            //redirect dengan pesan error
            return response()->json($validator->errors(), 400);
        }

        }


    }
}
