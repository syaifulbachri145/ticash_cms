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

class GetherMemberController extends Controller
{
    public function members($id)
    {
  
        $gether = Gether::whereId($id)->first();
        $users = User::where('institution_id',$gether->institution_id)->get();

        $members = DB::table('gether_members')
            ->join('users', 'users.id', '=', 'gether_members.user_id')
            ->select('users.name','users.avatar', 'gether_members.amount','gether_members.updated_at','gether_members.id')
            ->where('gether_members.gether_id', $gether->id )
            ->where('gether_members.disable','no')->paginate(10);

        //$members = GetherMember::with('category.user')->whereRelation('category','user_id',2)->first();
      
        return response()->json([
            'success'       => true,
            'message'       => 'Detail Data Members',
            'data'          => $members,
            'users'         => $users,
           // 'getherBalance' => $getherBalance,
        ], 200);
      
    }


        //menampilkan gether Member
    public function showMember($id)
    {

        $member = DB::table('gether_members')
        ->join('users', 'users.id', '=', 'gether_members.user_id')
        ->join('gethers', 'gethers.id', '=', 'gether_members.gether_id')
        ->select('users.name','users.avatar','gethers.description', 'gethers.balance','gether_members.amount','gethers.goal','gethers.deadline','gether_members.id','gethers.updated_at','gethers.created_at',)
        ->where('gether_members.id', $id )->first();

        //$gether = GetherMember::whereId($id)->first();
      
        if($member) {

            return response()->json([
                'success' => true,
                'message'   => 'Detail Data Gether Member',
                'member' => $member
            ], 200);

        } else {

            return response()->json([
                'success' => false,
                'message'   => 'Data gether Tidak Ditemukan',
            ], 404);

        }
    }


    public function addMember(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'userId'       => 'required',  
            'getherId'       => 'required',  
        ]);

        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

       // dd($request->user_id);

        $gether = Gether::where('id', $request->getherId)->first();

       // dd($gether);
        $member = GetherMember::where('gether_id',$request->getherId)->where('user_id', $request->userId)->first();

        //dd($member);

        //cek apakah user id sudah ada di daftar member jika ya maka tidak akan di input
        if ($member)
      
        {
            return response()->json([
                'success' => false,
                'message' => 'Member Sudah Terdaftar'
            ]);

        }else{

          
            $gether = GetherMember::updateOrCreate([
                'user_id'                   => $request->userId,
                'institution_id'            => $gether->institution_id,
                'gether_id'                 => $request->getherId,
                'amount'                    => '0',
                'status'                    => 'active',
                'disable'                   => 'no'
            ]);
                
            if($gether){
                return response()->json([
                    'success' => true,
                    'message' => 'Member Berhasil ditambahkan',
                    'data'    => $gether,
                ], 201);
            }else{
                //redirect dengan pesan error
                return response()->json($validator->errors(), 400);
            }
            
        }
    }


        //saving gether by member
    public function savingMember(Request $request)
    {
              
        $validator = Validator::make($request->all(), [
            'amount'          => 'required',
            //'getherId'        => 'required',
            'memberId'       => 'required',       
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::whereId(auth()->guard('api')->user()->id)->first();
        $member = GetherMember::whereId($request->memberId)->first();
        $gether = Gether::whereId($member->gether_id)->first();
        

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
    
            $trans_number = 'GT-'.Str::upper($random);
            //buat transaksi SV

            $transaction = Transaction::updateOrCreate([
            'trans_number'              => $trans_number,
            'institution_id'            => $user->institution_id,
            'user_id'                   => $user->id,
            'type'                      => 'credit',
            'transaction_category_id'   => '9', //gether category
            'destination_id'            => $user->id,
            'description'               => 'Gether Member',  
            'amount'                    => $request->input('amount'),
            'admin_fee'                 => '0',
            'shared_fee'                => '0',
            'status'                    => 'success',
            'disable'                   => 'no',
        ]);

        //update saldo user 
        $user_balance = $user->balance - $request->amount;
        $gether_balance = $gether->balance + $request->amount;
        $amount = $member->amount + $request->amount;

        $user->update([
            'balance' => $user_balance
        ]);
        
        //update saldo institution
        $gether->update([
            'balance'     => $gether_balance,
        ]);

        $member->update([
            'amount'      => $amount
        ]);

        if($gether){
            return response()->json([
                'success'   => true,
                'message'   => 'Transfer Berhasil',
                'gether'    => $gether,
                'member'    => $member,
            ], 201);
        }else{
            //redirect dengan pesan error
            return response()->json($validator->errors(), 400);
        }

        }

    }  


}
