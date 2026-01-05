<?php

namespace App\Http\Controllers\Api\Saving;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Gether;
use App\Models\GetherMember;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Validator;

class GetherController extends Controller
{
    public function gethers()
    {
  
        $getherBalance = Gether::where('user_id',auth()->guard('api')->user()->id)
                        ->sum('balance');
        
        $gethers = Gether::latest()
            ->where('user_id',auth()->guard('api')->user()->id )
            ->where('disable','no')
            ->when(request()->q, function($gethers) {
                $gethers = $gethers->where('description', 'like', '%'. request()->q . '%');
            })->paginate(10);

            $members = DB::table('gether_members')
            ->join('gethers', 'gethers.id', '=', 'gether_members.gether_id')
            ->join('users', 'users.id', '=', 'gethers.user_id')
           
            ->select('users.name','users.avatar','gethers.description', 'gethers.balance','gether_members.amount','gethers.goal','gethers.deadline','gether_members.id','gethers.updated_at','gethers.created_at',)
            ->where('gether_members.user_id', auth()->guard('api')->user()->id )
            ->where('gether_members.disable','no')->paginate(10);

        return response()->json([
            'success'       => true,
            'message'       => 'Detail Data Gether',
            'data'          => $gethers,
            'members'       => $members,
            'getherBalance' => $getherBalance,
        ], 200);
      
    }



    //menampilkan detail gether
    public function showGether($id)
    {
        $gether = Gether::whereId($id)->first();

        // $members = Gether::whereId($id)->first();
         
        $members = GetherMember::latest()
            ->where('gether_id', $gether->id )
            ->where('disable','no')
            ->when(request()->q, function($members) {
                $members = $members->where('name', 'like', '%'. request()->q . '%');
            })->paginate(10);
        
        if($gether) {

            return response()->json([
                'success' => true,
                'message'   => 'Detail Data Gether',
                'gether' => $gether,
                'members' => $members
            ], 200);

        } else {

            return response()->json([
                'success' => false,
                'message'   => 'Data gether Tidak Ditemukan',
            ], 404);

        }
    }
  

//buat gether
    public function createGether(Request $request)
    {
       
        $request->validate([
            'description'    => 'required',
            'goal'           => 'required',
            'deadline'       => 'required',
        ]); 

        $user = User::whereId(auth()->guard('api')->user()->id)->first();

        $gether = Gether::updateOrCreate([
            'user_id'                   => $user->id,
            'user_name'                 => $user->name,
            'degree_name'               => $user->degree->degree_name,
            'degree_id'                 => $user->degree_id,
            'institution_id'            => $user->institution_id,
            'balance'                   => '0',
            'description'               => $request->description,  
            'goal'                      => $request->goal, 
            'deadline'                  => $request->deadline, 
            'status'                    => 'active',
            'disable'                   => 'no'
        ]);
            
        if($gether){
            return response()->json([
                'success' => true,
                'message' => 'Gether Berhasil Dibuat',
                'data'    => $gether,
            ], 201);
        }else{
            //redirect dengan pesan error
            return response()->json($validator->errors(), 400);
        }

    }  


    //hapus member
    public function removeMember($id)
    {
        $member = GetherMember::where('id',$id)->first();
       
        $member->update([
            'disable' => 'yes'
        ]);

        if($member){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
   

    //saving Gether
    public function savingGether(Request $request)
    {
              
        $validator = Validator::make($request->all(), [
            'amount'          => 'required',
            'getherId'       => 'required',
          
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::whereId(auth()->guard('api')->user()->id)->first();
        $gether = Gether::whereId($request->getherId)->first();
        
        //dd($payment->amount);
        //cek saldo

        if($request->amount > $user->balance){
            return response()->json([
                'success' => false,
                'message' => 'Saldo tidak cukup',
               // $this->response
            ]);
        }

        else{

            $length = 5;
            $random = '';
            for ($i = 0; $i < $length; $i++) {
                $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
            }
    
            $trans_number = 'GT-'.Str::upper($random);
            //buat transaksi SV

            $transaction = Transaction::updateOrCreate([
            'trans_number'              => $trans_number,
            'institution_id'            => $user->institution_id,
            'user_id'                   => $user->id,
            'type'                      => 'credit',
            'transaction_category_id'   => '9', //gether category
            'destination_id'            => $user->id,
            'description'               => 'Gether',  
            'amount'                    => $request->input('amount'),
            'admin_fee'                 => '0',
            'shared_fee'                => '0',
            'status'                    => 'success',
            'disable'                   => 'no',
        ]);

        //update saldo user 
        $user_balance = $user->balance - $request->amount;
        $gether_balance = $gether->balance + $request->amount;

        $user->update([
            'balance' => $user_balance
        ]);
        
        //update saldo institution
        $gether->update([
            'balance'     => $gether_balance,
            'user_name'   => $user->name,
            'degree_name' => $user->degree->degree_name,
            'degree_id'   => $user->degree_id,
        ]);

        if($gether){
            return response()->json([
                'success' => true,
                'message' => 'Saving Gether Berhasil',
                'data'    => $gether,
            ], 201);
        }else{
            //redirect dengan pesan error
            return response()->json($validator->errors(), 400);
        }

        }

    }      

    //tarik dana tabungan
    public function reedemGether(Request $request)
    {

        $validator = Validator::make($request->all(), [
          
            'getherId'       => 'required',
            'amount'         => 'required',
            
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $gether = Gether::where('id',$request->getherId)->first();
        $user = User::where('id', $gether->user_id)->first();

        if($request->amount > $gether->balance){
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
    
            $trans_number = 'GT-'.Str::upper($random);
            //buat transaksi SV

            $transaction = Transaction::updateOrCreate([
            'trans_number'              => $trans_number,
            'institution_id'            => $user->institution_id,
            'user_id'                   => $user->id,
            'type'                      => 'debit',
            'transaction_category_id'   => '9', //gether category
            'destination_id'            => $user->id,
            'description'               => 'Collect gether'. $gether->description,  
            'amount'                    => $request->amount,
            'admin_fee'                 => '0',
            'shared_fee'                => '0',
            'status'                    => 'success',
            'disable'                   => 'no',
        ]);

        $user_balance = $user->balance + $request->amount;
        $gether_balance = $gether->balance - $request->amount;
          //update saldo user
          $user->update([
            'balance' => $user_balance,
        ]);
        //non aktifkan tabungan 
        $gether->update([
            'balance' => $gether_balance,
            //'disable' => 'yes'
        ]);

        if($gether){
            return response()->json([
                'success' => true,
                'message' => 'Transfer Berhasil',
                'data'    => $gether,
            ], 201);
        }else{
            //redirect dengan pesan error
            return response()->json($validator->errors(), 400);
        }

        }       
    }


    //tarik dana tabungan
    public function updateGether(Request $request)
    {
        $validator = Validator::make($request->all(), [
          
            'description'       => 'required',
                     
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $gether = Gether::where('id',$request->id)->first();
       
       
            //update balance di gether
            $gether->update([
                'description' =>  $request->description,
                'goal' =>  $request->goal,
                'deadline' =>  $request->deadline,
            ]);
    
            if($gether){
                return response()->json([
                    'success' => true,
                    'message' => 'Transfer Berhasil',
                    'data'    => $gether,
                ], 201);
            }else{
                //redirect dengan pesan error
                return response()->json($validator->errors(), 400);
            }

        
    }

    public function removegether(Request $request)
    {
        $validator = Validator::make($request->all(), [
          
            'getherId'       => 'required',
                     
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $gether = gether::where('id',$request->getherId)->first();
        
        if($gether->balance > 0)
        {
            return response()->json([
                'success' => false,
                'message' => 'Masih ada saldo',
                $this->response
            ]);

        }else{
             //update balance di gether
             $gether->delete();
    
             if($gether){
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
