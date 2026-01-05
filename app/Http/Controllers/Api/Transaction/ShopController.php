<?php

namespace App\Http\Controllers\Api\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use App\Models\Merchant;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;


class ShopController extends Controller
{
    //merchants
    public function merchants()
    {
        
        $merchants = Merchant::where('institution_id',auth()->guard('api')->user()->institution_id)->get();
        
        if($merchants){
            //redirect dengan pesan sukses
            return response()->json([
                'success' => true,
                'message' => 'Merchants',
                'data'    => $merchants,
            ], 201);

        }else{
            //redirect dengan pesan error
            return response()->json($validator->errors(), 400);
        }
    }

    public function show($id)
    {
        $merchant = Merchant::where('id', $id)->first();
      
        if($merchant) {

            return response()->json([
                'success' => true,
                'message'   => 'Detail Data merchant',
                'merchant' => $merchant
            ], 200);

        } else {

            return response()->json([
                'success' => false,
                'message'   => 'Data merchant Tidak Ditemukan',
            ], 404);

        }
    }
    //shop

    public function createShop(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'amount'        => 'required',
            'merchantId'       => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //merchant
        $merchant = Merchant::where('id',$request->merchantId)->first();
        //merchant destination
        $userDes = User::whereId($merchant->user_id)->first();

        //user 
        $user = User::whereId(auth()->guard('api')->user()->id)->first();

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
    
            $trans_number = 'SP-'.Str::upper($random);
        //buat transaksi WD
           $shop = Transaction::updateOrCreate([
            'trans_number'              => $trans_number,
            'institution_id'            => $user->institution_id,
            'user_id'                   => $user->id,
            'type'                      => 'credit',
            'transaction_category_id'   => '8', //shop category
            'destination_id'            => $merchant->user_id,
            'description'               => $merchant->merchant_name,
            'amount'                    => $request->input('amount'),
            'admin_fee'                 => '0',
            'shared_fee'                => '0',
            'status'                    => 'success',
            'disable'                   => 'no'
        ]);

        //update saldo user 
        $saldo_user = $user->balance - $request->amount;
        $saldo_merchant = $userDes->balance + $request->amount;

        $user->update([
            'balance' => $saldo_user
        ]);
        
        //update saldo institution
        $userDes->update([
            'balance' => $saldo_merchant
        ]);
            
            if($shop){
                return response()->json([
                    'success' => true,
                    'message' => 'Pembayaran Berhasil',
                    'data'    => $shop,
                ], 201);
            }else{
                //redirect dengan pesan error
                return response()->json($validator->errors(), 400);
            }

        }

    }  
}
