<?php

namespace App\Http\Controllers\Api\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use App\Models\User;
use App\Models\Sharing;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Validator;


class SharingController extends Controller
{

    //mencari atau menambah nomor destinasi Sharing tujuan berdasarkan nomor HP
    public function createSharingDes(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'phone_number'        => 'required',
         ]);
        
         //cari tujuan Sharing berdasarkan no hp
        $user = User::where('phone',$request->phone_number)->first();
        
        if($user){

            $sharing = Sharing::updateOrCreate([
                'user_id'                   => Auth()->user()->id,
                'institution_id'            => Auth()->user()->institution_id,
                'destination_id'            => $user->id,
                'status'                    => 'active',
                'disable'                   => 'no'
            ]);


            //redirect dengan pesan sukses
            return response()->json([
                'success' => true,
                'message' => 'User Destination',
                'data'    => $user,
                //'sharing'=> $sharing
            ], 201);

        }else{
            //redirect dengan pesan error
            return response()->json([
                'success' => false,
                'error'   => true,
                'message' => 'User Tidak ditemukan',
                'data'    => $user,
            ], 400);
        }
    }


    //menampilkan list Sharing destination
    public function sharingDestination()
    {
       
         //cari tujuan Sharing berdasarkan no hp
        $sharing = Sharing::where('user_id',Auth()->user()->id)->latest('updated_at')->first();
        $destination = User::whereId($sharing->destination_id)->first();

       // $destinations = Sharing::where('user_id',Auth()->user()->id)->get();


        $destinations = DB::table('sharings')
        ->join('users', 'users.id', '=', 'sharings.destination_id')
        ->select('users.name','users.avatar', 'users.phone', 'users.id')
        ->where('sharings.user_id',Auth()->user()->id )
        ->where('sharings.disable','no')->latest('sharings.updated_at')->paginate(10);
       
        if($destination){

          
            //redirect dengan pesan sukses
            return response()->json([
                'success' => true,
                'message' => 'User Destination',
                'destination'    => $destination,
                'data'      => $destinations
                
            ], 201);

        }else{
            //redirect dengan pesan error
            return response()->json([
                'success' => false,
                'error'   => true,
                'message' => 'Tidak ditemukan',
              //  'data'    => $user,
            ], 400);
        }
    }


    //detail sharing berdasarkan user id tujuan
        public function show($id)
    {
        $sharing = User::where('id', $id)->first();
      
        if($sharing) {

            return response()->json([
                'success' => true,
                'message' => 'Detail Data Sharing',
                'sharing' => $sharing
            ], 200);

        } else {

            return response()->json([
                'success' => false,
                'message'   => 'Data Saving Tidak Ditemukan',
            ], 404);

        }
    }

    //proses sharing
    public function createSharing(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'amount'              => 'required',
            //'description'         => 'required',
            'destinationId'       => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
 
        //dd($request->user_id);

        //$des = Sharing::whereId($request->destinationId)->first();
 
        $user = User::whereId(auth()->guard('api')->user()->id)->first();
 
        $destination = User::whereId($request->destinationId)->first();
 
       if($destination){
        if($request->amount > $user->balance){
            //return redirect()->route('admin.sharing.index')->with(['error' => 'Saldo tidak cukup!']);
            //return response()->json($validator->errors(), 400);
            return response()->json([
                'success' => false,
                'message' => 'Saldo tidak cukup',
                //$this->response
            ]);
        }
        else{
 
            $length = 3;
            $random = '';
            for ($i = 0; $i < $length; $i++) {
                $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
            }
    
            $trans_number = 'TF-'.Str::upper($random);

             //buat transaksi WD
           $sharing = Transaction::updateOrCreate([
            'trans_number'              => $trans_number,
            'institution_id'            => $user->institution_id,
            'user_id'                   => $user->id,
            'type'                      => 'credit',
            'transaction_category_id'   => '2', //sharing category
            'destination_id'            => $destination->id,
            'description'               => $request->input('description'),  
            'amount'                    => $request->input('amount'),
            'admin_fee'                 => '0',
            'shared_fee'                => '0',
            'status'                    => 'success',
            'disable'                   => 'no'
        ]);
 
        //update saldo user 
        $saldo_user = $user->balance - $request->amount;
        $saldo_destination = $destination->balance + $request->amount;

        //update saldo user
        $user->update([
            'balance' => $saldo_user
        ]);
        
        //update saldo institution
        $destination->update([
            'balance' => $saldo_destination
        ]);
            
            if($sharing){
                return response()->json([
                    'success' => true,
                    'message' => 'sharing Berhasil',
                    'data'    => $sharing,
                ], 201);
            }else{
                //redirect dengan pesan error
                return response()->json($validator->errors(), 400);
            }
 
        }

       }else{

        return response()->json([
            'success' => false,
            'message' => 'No HP Belum terdaftar',
            //$this->response
        ]);

       }
 
    }
}
