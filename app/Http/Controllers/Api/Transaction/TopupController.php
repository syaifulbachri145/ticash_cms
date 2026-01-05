<?php

namespace App\Http\Controllers\Api\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;



class TopupController extends Controller
{
    public function topupVA(Request $request)
    {
        
          $validator = Validator::make($request->all(), [
            'BILL'     => 'required',
            'VANO'     => 'required',
         ]);
 
         if ($validator->fails()) {
             return response()->json($validator->errors(), 400);
         }

       
        $user = User::where('va_number',  $request->input('VANO'))->first();
        $institution = Institution::where('id',$user->institution_id)->first();
      //  $payment = Payment::whereId($request->payment_id)->first();

        $length = 5;
        $random = '';
        for ($i = 0; $i < $length; $i++) {
            $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
        }

        $trans_number = 'TP-'.Str::upper($random);      

        //biaya admin (profit + invoice)
        $admin_fee = $institution->shared_fee + $institution->admin_fee;
        //amount setelah dipotong admin
        $amount = $request->input('BILL') - $admin_fee;
        //jumlah topup - biaya admin
        $balance = $user->balance + $amount;
        

        //variabel profit & invoice 
        $profit = $institution->profit + $institution->shared_fee;
        $invoice = $institution->profit + $institution->admin_fee;

        //update user balance
            $user->update([
            'balance'           => $balance,  
            ]);
        //update balance instituiton & invoice
            $institution->update([
                'profit'       => $profit,
                'invoice'      => $invoice,
            ]);
      
    
            $topup = Transaction::updateOrCreate([
                'trans_number'              => $trans_number,
                'institution_id'            => $user->institution_id,
                'user_id'                   => $user->id,
                'type'                      => 'debit',
                'transaction_category_id'   => '1', //topup category
                'destination_id'            => $user->id,
                'description'               => 'Topup Saldo',  
                'amount'                    => $request->input('BILL'),
                'admin_fee'                 => $institution->admin_fee,
                'shared_fee'                => $institution->shared_fee,
                'status'                    => 'success',
                'disable'                   => 'no'
            ]);
    

            if($topup){
                return response()->json([
                    'success' => true,
                    'message' => 'Topup Berhasil',
                    'data'    => $topup,
                ], 201);
            }else{
                //redirect dengan pesan error
                return response()->json($validator->errors(), 400);
            }
    }

    public function topupBank(Request $request)
    {
        
         $validator = Validator::make($request->all(), [
            'amount'        => 'required',
         ]);
 
         if ($validator->fails()) {
             return response()->json($validator->errors(), 400);
         }
       
        $user = User::where('id',auth()->user()->id)->first();
        $institution = Institution::where('id',$user->institution_id)->first();

        $length = 5;
        $random = '';
        for ($i = 0; $i < $length; $i++) {
            $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
        }

        $trans_number = 'TP-'.Str::upper($random);
        //menghitung 3 digit unik
        $randomNumber = random_int(100, 999); 

        $amount = $request->input('amount') + $randomNumber;

        $topup = Transaction::updateOrCreate([
            'trans_number'              => $trans_number,
            'institution_id'            => $user->institution_id,
            'user_id'                   => $user->id,
            'type'                      => 'debit',
            'transaction_category_id'   => '1', //topup category
            'destination_id'            => $user->id,
            'description'               => 'Topup Via Transfer Bank',  
            'amount'                    => $amount,
            'admin_fee'                 => $institution->admin_fee,
            'shared_fee'                => $institution->shared_fee,
            'status'                    => 'waiting',
            'disable'                   => 'no'
        ]);
    

            if($topup){
                return response()->json([
                    'success' => true,
                    'message' => 'Topup Berhasil',
                    'data'    => $topup,
                ], 201);
            }else{
                //redirect dengan pesan error
                return response()->json($validator->errors(), 400);
            }
    }

    //menampilkan list topups
    public function topups()
    {
       

        //jika login sebagai admin maka akan menampilkan semua data topup

        if (Auth()->user()->access_id == '6')
        {
        $topup = Transaction::where('institution_id',Auth()->user()->institution_id)
                              ->where('transaction_category_id','1')
                              ->where('status','processing')
                              ->latest('updated_at')->first();

        $topups = Transaction::where('institution_id',Auth()->user()->institution_id)
                              ->where('transaction_category_id','1')
                              ->where('status','processing')
                              ->latest('updated_at')->paginate(10);
        }
        
        //jika login selain admin hanya muncul data topup personalnya
        else
        {
        $topup = Transaction::where('user_id',Auth()->user()->id)
                              ->where('transaction_category_id','1')
                              ->where('status','waiting')
                              ->latest('updated_at')->first();

        $topups = Transaction::where('user_id',Auth()->user()->id)
                              ->where('transaction_category_id','1')
                              ->where('status','waiting')
                              ->latest('updated_at')->paginate(10);
        }

                           
       
        if($topup){

          
            //redirect dengan pesan sukses
            return response()->json([
                'success' => true,
                'message' => 'User Destination',
                'topup'   => $topup,
                'data'    => $topups
                
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

    public function processingTopups()
    {
       
        $topups = Transaction::where('institution_id',Auth()->user()->institution_id)
                              ->where('transaction_category_id','1')
                              ->where('status','processing')
                              ->latest('updated_at')->paginate(10);                    
       
        if($topups){
          
            //redirect dengan pesan sukses
            return response()->json([
                'success' => true,
                'message' => 'Data Topups',
                'data'    => $topups
                
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

    public function show($id)
    {
        $topup = Transaction::whereId($id)->first();
      
        if($topup) {

            return response()->json([
                'success' => true,
                'message' => 'Detail Data Topup',
                'topup' => $topup
            ], 200);

        } else {

            return response()->json([
                'success' => false,
                'message'   => 'Data Topup Tidak Ditemukan',
            ], 404);

        }
    }

    public function update(Request $request)
    {
       
        $request->validate([
            'transactionId'       => 'required',
          
        ]); 

        $transaction = Transaction::where('id',$request->transactionId)->first();

        //https://api.telegram.org/bot{TOKEN}/sendMessage?chat_id={chat_id}&text={message}
        //$token="7714136352:AAEOhaXLAoDLWGVOM5-SPHWCxwPdBzORsCE";
        //$chatId="-1093960986";

       // https://api.telegram.org/bot{TOKEN}/sendMessage?chat_id={chat_id}&text={message}

       // $baseURL = "//https://api.telegram.org/";
       // $baseURL."bot".$token."/sendMessage?chat_id=".$chatId."&text=New Topup From Ticash";

            $transaction->update([
            'status'            => 'processing',     
            ]);
        
        if($transaction){
                return response()->json([
                    'success' => true,
                    'message' => 'Konfirmasi Berhasil',
                    'data'    => $transaction,
                ], 201);
            }else{
                //redirect dengan pesan error
                return response()->json($validator->errors(), 400);
            }
    }

    public function process(Request $request)
    {

         $request->validate([
            'transactionId'       => 'required',
          
        ]); 

        $id = $request->transactionId;

        $transaction = Transaction::where('id',$id)->first();
        $user = User::where('id', $transaction->destination_id)->first();
        $institution = Institution::where('id',$user->institution_id)->first();

        //biaya admin (profit + invoice)
        $admin_fee = $transaction->shared_fee + $transaction->admin_fee;
        //amount setelah dipotong admin
        $amount = $transaction->amount - $admin_fee;
        //jumlah topup - biaya admin
        $balance = $user->balance + $amount;
        

        //variabel profit & invoice 
        $profit = $institution->profit + $transaction->shared_fee;
        $invoice = $institution->profit + $transaction->admin_fee;

        //update user balance
            $user->update([
            'balance'           => $balance,  
            ]);
        //update balance instituiton & invoice
            $institution->update([
                'profit'       => $profit,
                'invoice'      => $invoice,
            ]);
        //update status transaction
            $transaction->update([
            'amount'           => $amount,
            'status'           => 'success',     
            ]);
    

        if($transaction){
                return response()->json([
                    'success' => true,
                    'message' => 'Topup Berhasil',
                    'data'    => $transaction,
                ], 201);
            }else{
                //redirect dengan pesan error
                return response()->json($validator->errors(), 400);
            }
    }

}
