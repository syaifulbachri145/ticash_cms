<?php

namespace App\Http\Controllers\Api\Saving;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Saving;
use App\Models\Degree;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class SavingController extends Controller
{
    public function savings()
    {
       
        $user = User::whereId(auth()->guard('api')->user()->id)->first();
        $totalSaving = Saving::where('user_id',$user->id)->sum('balance');

        
            $savings = Saving::latest()
            ->where('user_id',$user->id)
            ->where('disable','no')->when(request()->q, function($savings) {
                $savings = $savings->where('description', 'like', '%'. request()->q . '%');
            })->paginate(10);
    
            return response()->json([
                'success' => true,
                'message'   => 'Detail Data Payments',
                'totalSaving' => $totalSaving,
                'data' => $savings,
               
            ], 200);

    }

    //payment detail
    public function show($id)
    {
        $saving = Saving::where('id', $id)->first();
      
        if($saving) {

            return response()->json([
                'success' => true,
                'message'   => 'Detail Data Saving',
                'saving' => $saving
            ], 200);

        } else {

            return response()->json([
                'success' => false,
                'message'   => 'Data Saving Tidak Ditemukan',
            ], 404);

        }
    }

    public function createSaving(Request $request)
    {
       
        $request->validate([
            'description'    => 'required',
            'goal'           => 'required',
            'deadline'       => 'required',
        ]); 

        $user = User::where('id', Auth()->guard('api')->user()->id)->first();

        $saving = Saving::updateOrCreate([
            'user_id'                   => $user->id,
            'user_name'                 => $user->name,
            'institution_id'            => $user->institution_id,
            'degree_id'                 => $user->degree_id,
            'degree_name'               => $user->degree->degree_name,
            'balance'                   => '0',
            'description'               => $request->description,  
            'goal'                      => $request->goal, 
            'deadline'                  => $request->deadline, 
            'status'                    => 'active',
            'disable'                   => 'no'
        ]);
            
        if($saving) {

            return response()->json([
                'success' => true,
                'message'   => 'Detail Data Saving',
                'saving' => $saving
            ], 200);

        } else {

            return response()->json([
                'success' => false,
                'message'   => 'Data Saving Tidak Ditemukan',
            ], 404);

        }

    }  

    public function storeSaving(Request $request)
    {
              
        $validator = Validator::make($request->all(), [
            'amount'          => 'required',
            'savingId'       => 'required',
            //'description'     => 'required',
       
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::whereId(auth()->guard('api')->user()->id)->first();
        $institution = Institution::where('id', $user->institution_id)->first();
        $saving = Saving::whereId($request->savingId)->first();
       

        if($user->balance < $request->amount){
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
    
            $trans_number = 'SV-'.Str::upper($random);
            //buat transaksi SV

            $transaction = Transaction::updateOrCreate([
            'trans_number'              => $trans_number,
            'institution_id'            => $user->institution_id,
            'user_id'                   => $user->id,
            'type'                      => 'credit',
            'transaction_category_id'   => '7', //saving category
            'destination_id'            => $user->id,
            'description'               => 'Saving '.$saving->description,  
            'amount'                    => $request->input('amount'),
            'admin_fee'                 => '0',
            'shared_fee'                => '0',
            'status'                    => 'success',
            'disable'                   => 'no',
        ]);

        //update saldo user 
        $user_balance = $user->balance - $request->amount;
        $saving_balance = $saving->balance + $request->amount;

        $user->update([
            'balance' => $user_balance
        ]);
        
        //update saldo institution
        $saving->update([
            'balance'     => $saving_balance,
            'user_name'   => $user->name,
            'degree_name' => $user->degree->degree_name,
            'degree_id'   => $user->degree_id,
           // 'goal'        => $request->goal,
           // 'deadline'    => $request->deadline
        ]);

        if($saving){
            return response()->json([
                'success' => true,
                'message' => 'Transfer Berhasil',
                'data'    => $saving,
            ], 201);
        }else{
            //redirect dengan pesan error
            return response()->json($validator->errors(), 400);
        }

        }

    }  

    //tarik dana tabungan
    public function reedemSaving(Request $request)
    {
        $validator = Validator::make($request->all(), [
          
            'savingId'       => 'required',
            'amount'         => 'required',
            
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $saving = Saving::where('id',$request->savingId)->first();
        $user = User::where('id', $saving->user_id)->first();

        if($request->amount > $saving->balance){
            return response()->json([
                'success' => false,
                'message' => 'Saldo tidak cukup',
                //$this->response
            ]);

        }else{

            //buat transaksi
            $length = 5;
                $random = '';
                for ($i = 0; $i < $length; $i++) {
                    $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
                }
        
                $trans_number = 'SV-'.Str::upper($random);
                //buat transaksi SV
    
                $transaction = Transaction::updateOrCreate([
                'trans_number'              => $trans_number,
                'institution_id'            => $user->institution_id,
                'user_id'                   => $user->id,
                'type'                      => 'debit',
                'transaction_category_id'   => '7', //saving category
                'destination_id'            => $user->id,
                'description'               => 'Tarik dana '.$saving->description,  
                'amount'                    => $request->amount,
                'admin_fee'                 => '0',
                'shared_fee'                => '0',
                'status'                    => 'success',
                'disable'                   => 'no',
            ]);

            $saving_balance = $saving->balance - $request->amount;
    
            $user_balance = $user->balance + $request->amount;

              //update saldo user
              $user->update([
                'balance' => $user_balance,
            ]);
            //update balance di saving
            $saving->update([
                'balance' =>  $saving_balance,
            ]);
    
            if($saving){
                return response()->json([
                    'success' => true,
                    'message' => 'Transfer Berhasil',
                    'data'    => $saving,
                ], 201);
            }else{
                //redirect dengan pesan error
                return response()->json($validator->errors(), 400);
            }

        }
    }

    //tarik dana tabungan
    public function updateSaving(Request $request)
    {
        $validator = Validator::make($request->all(), [
          
            'description'       => 'required',
                     
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $user = User::whereId(auth()->guard('api')->user()->id)->first();
        $saving = Saving::where('id',$request->id)->first();
       
       
            //update balance di saving
            $saving->update([
                'description' =>  $request->description,
                'goal'        =>  $request->goal,
                'deadline'    =>  $request->deadline,
                'degree_name' =>  $user->degree->degree_name,
                'degree_id'   =>  $user->degree_id,  
            ]);
    
            if($saving){
                return response()->json([
                    'success' => true,
                    'message' => 'Transfer Berhasil',
                    'data'    => $saving,
                ], 201);
            }else{
                //redirect dengan pesan error
                return response()->json($validator->errors(), 400);
            }

        
    }

    public function removeSaving(Request $request)
    {
        $validator = Validator::make($request->all(), [
          
            'savingId'       => 'required',
                     
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $saving = Saving::where('id',$request->savingId)->first();
        
        if($saving->balance > 0)
        {
            return response()->json([
                'success' => false,
                'message' => 'Masih ada saldo',
                $this->response
            ]);

        }else{
             //update balance di saving
             $saving->delete();
    
             if($saving){
                 return response()->json([
                     'success' => true,
                     'message' => 'Berhasil',
                 ], 201);
             }else{
                 //redirect dengan pesan error
                 return response()->json($validator->errors(), 400);
             }
        }
       
           

        
    }


}
