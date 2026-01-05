<?php

namespace App\Http\Controllers\Api\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Payment;
use App\Models\PaymentDetail;
use App\Models\PaymentJournal;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;


class PaymentController extends Controller
{
    public function payments()
    {
       
        $user = User::whereId(auth()->guard('api')->user()->id)->first();
        

       //list payment type public
         $payments = PaymentDetail::where('user_id', $user->id)
        ->where('disable','no')
        ->when(request()->q, function($payments) {
            $payments = $payments->where('description', 'like', '%'. request()->q . '%');
        })->latest()->paginate(100);

         
            return response()->json([
                'success' => true,
                'message'   => 'Detail Data Payments',
                'data' => $payments,
               
            ], 200);

    }

    //payment detail
    public function show($id)
    {
        $payment = PaymentDetail::where('id', $id)->first();

        $sisaPayment = $payment->unpaid;

        if($payment->is_tuition_fee == 'yes')
        {
        $detailPayments = PaymentJournal::where('user_id', auth()->guard('api')->user()->id)
        ->where('payment_id', $payment->payment_id)
        ->where('transaction_category_id','12')
        ->where('disable','no')->paginate(12);
        }
        else{
//menampilkan jurnal
        $detailPayments = PaymentJournal::where('user_id', auth()->guard('api')->user()->id)
        ->where('payment_id', $payment->payment_id)
        ->where('disable','no')->paginate(12);
        }

        

      
        if($payment) {

            return response()->json([
                'success' => true,
                'message'   => 'Detail Data Payment',
                'detailPayments' => $detailPayments,
                'payment' => $payment,
                'sequence' => $sisaPayment,
            ], 200);

        } else {

            return response()->json([
                'success' => false,
                'message'   => 'Data Payment Tidak Ditemukan',
            ], 404);

        }
    }

    public function createPayment(Request $request)
    {
              
        $validator = Validator::make($request->all(), [
           // 'amount'            => 'required',
            'paymentId'        => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }


        $user = User::whereId(auth()->guard('api')->user()->id)->first();
        $institution = Institution::where('id', $user->institution_id)->first();        
        $payment = PaymentDetail::where('id',$request->paymentId)->where('user_id',$user->id)->first();


        //dd($payment);
        //cek saldo user
        if($user->balance < $payment->amount){
            return response()->json([
                'success' => false,
                'message' => 'Saldo tidak cukup',
                $this->response
            ]);
        }

        $year = Carbon::now()->isoFormat('YYYY');

        
            //create ke jurnal payment --------------------------------------------------------------------

            //jika jenis bayar SPP

            if($payment->is_tuition_fee =='yes'){
                //saldo makan
                $eatJournal = PaymentJournal::where('transaction_category_id', '13')
                                ->where('institution_id', $payment->institution_id)->latest()->first();
                
                if ($eatJournal === null) {
                        $eatSaldo = '0' + $payment->eat;
                    }
                else{
                        $eatSaldo = $eatJournal->saldo + $payment->eat;
                }

                $paymentJournal = PaymentJournal::create([
                'institution_id'            => $user->institution_id,
                'user_id'                   => $user->id,
                'payment_id'                => $payment->payment_id,
                'transaction_category_id'   => '13',
                'user_name'                 => $user->name,
                'description'               => $payment->description,
                'amount'                    => $payment->amount, 
                'debit'                     => $payment->eat,
                'credit'                    => '0',
                'saldo'                     => $eatSaldo,
                'user_approve'              => Auth()->user()->name,
                'type'                      => 'debit',
                'year'                      => $year,
                'status'                    => 'active',
                'disable'                   => 'no',
                ]);

                //saldo spp
                $tuitionJournal = PaymentJournal::where('transaction_category_id', '12')
                                ->where('institution_id', $payment->institution_id)->latest()->first();

                if ($tuitionJournal === null) {
                        $tuitionSaldo = '0' + $payment->tuition_fee;
                    }
                else{
                        $tuitionSaldo = $tuitionJournal->saldo + $payment->tuition_fee;
                }

                $paymentJournal = PaymentJournal::create([
                'institution_id'            => $user->institution_id,
                'user_id'                   => $user->id,
                'payment_id'                => $payment->payment_id,
                'transaction_category_id'   => '12',
                'user_name'                 => $user->name,
                'description'               => $payment->description,
                'amount'                    => $payment->amount, 
                'debit'                     => $payment->tuition_fee,
                'credit'                    => '0',
                'saldo'                     => $tuitionSaldo,
                'user_approve'              => Auth()->user()->name,
                'type'                      => 'debit',
                'year'                      => $year,
                'status'                    => 'active',
                'disable'                   => 'no',
                ]);

                //saldo laundry
                $laundryJournal = PaymentJournal::where('transaction_category_id', '19')
                                ->where('institution_id', $payment->institution_id)->latest()->first();

                if ($laundryJournal === null) {
                        $laundrySaldo = '0' + $payment->laundry;
                    }
                else{
                        $laundrySaldo = $laundryJournal->saldo + $payment->laundry;
                }

                $paymentJournal = PaymentJournal::create([
                'institution_id'            => $user->institution_id,
                'user_id'                   => $user->id,
                'payment_id'                => $payment->payment_id,
                'transaction_category_id'   => '19',
                'user_name'                 => $user->name,
                'description'               => $payment->description,
                'amount'                    => $payment->amount, 
                'debit'                     => $payment->laundry,
                'credit'                    => '0',
                'saldo'                     => $laundrySaldo,
                'user_approve'              => Auth()->user()->name,
                'type'                      => 'debit',
                'year'                      => $year,
                'status'                    => 'active',
                'disable'                   => 'no',
                ]);
            }
            
            else{

                //cari saldo jurnal terakhir berdasarkan transaction_category_id
                $journal = PaymentJournal::where('transaction_category_id', $payment->transaction_category_id)
                                ->where('institution_id', $payment->institution_id)->latest()->first();

            
                if ($journal === null) {
                        $saldo = '0' + $payment->amount;
                    }
                else{
                        $saldo = $journal->saldo + $payment->amount;
                    }

                $paymentJournal = PaymentJournal::create([
                'institution_id'            => $user->institution_id,
                'user_id'                   => $user->id,
                'payment_id'                => $payment->payment_id,
                'transaction_category_id'   => $payment->transaction_category_id,
                'user_name'                 => $user->name,
                'description'               => $payment->description,
                'amount'                    => $payment->amount, 
                'debit'                     => $payment->amount,
                'credit'                    => '0',
                'saldo'                     => $saldo,
                'user_approve'              => Auth()->user()->name,
                'type'                      => 'debit',
                'year'                      => $year,
                'status'                    => 'active',
                'disable'                   => 'no',
            ]);

            }
            
           


        //update saldo user 
        $user_balance = $user->balance - $payment->amount;
        $institution_balance = $institution->balance + $payment->amount;    

        $user->update([
            'balance' => $user_balance
        ]);
        
        //update saldo institution
        $institution->update([
            'balance'     => $institution_balance,
        ]);

        //update Paid di tabel payment detail
        $paid = $payment->paid + 1;
        $unpaid = $payment->unpaid - 1;

        $payment->update([
            'paid'  => $paid,
            'unpaid' => $unpaid,
        ]);

        //create history ke tabel transaksi
         $length = 5;
            $random = '';
            for ($i = 0; $i < $length; $i++) {
                $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
            }
    
            $trans_number = 'PM-'.Str::upper($random);
            //buat transaksi SV
        $transaction = Transaction::create([
            'trans_number'              => $trans_number,
            'institution_id'            => $user->institution_id,
            'user_id'                   => $user->id,
            'type'                      => 'credit',
            'transaction_category_id'   => '3', //payment category
            'destination_id'            => $user->id,
            'description'               => $payment->description, 
            'amount'                    => $payment->amount,
            'admin_fee'                 => '0',
            'shared_fee'                => '0',
            'status'                    => 'success',
            'disable'                   => 'no'
        ]);
    
        if($transaction){
            return response()->json([
                'success' => true,
                'message' => 'Transfer Berhasil',
                'data'    => $transaction,
            ], 201);
        }else{
            //redirect dengan pesan error
            return response()->json($validator->errors(), 400);
        }

        

    }  


}
