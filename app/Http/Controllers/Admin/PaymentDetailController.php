<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Institution;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Degree;
use App\Models\paymentDetail;
use App\Models\PaymentDetail as ModelsPaymentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use Illuminate\Container\Attributes\Auth;

class PaymentDetailController extends Controller
{
    public function middleware(): array
    {
        return [
            'auth',
            new Middleware('permission', paymentDetails: ['index']),
            new Middleware('permission', paymentDetails: ['create']),
            new Middleware('permission', paymentDetails: ['edit']),
            new Middleware('permission', paymentDetails: ['delete'])
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $access = auth()->user()->access->id;
        $institution_id = auth()->user()->institution_id;
      
        $publicPayments = Payment::where('institution_id',auth()->user()->institution_id)
        ->where('type','public')->get();

        $privatePayments = Payment::where('institution_id',auth()->user()->institution_id)
        ->where('type','private')->get();

        $degrees = Degree::where('institution_id',auth()->user()->institution_id)->get();


            $paymentDetails = PaymentDetail::latest()
            ->where('institution_id', $institution_id)
            //->where('user_id',auth()->user()->id)
            ->where('disable','no')->when(request()->q, function($paymentDetails) {
                $paymentDetails = $paymentDetails->where('payment_id', 'like', '%'. request()->q . '%');
            })->paginate(20);
    
            return view('admin.payment.paymentDetail.index', compact('paymentDetails','publicPayments','privatePayments','degrees'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

         $request->validate([
            //'payment_id'               => 'required|unique:payment_details,payment_id',
            //'payment_id'                => 'required',
        ]);

        $payment = Payment::where('id', $request->payment_id)->first();
       //dd($payment);

        if($request->type == 'all')
        {
            $users = User::where('access_id','5')->where('institution_id',auth()->user()->institution_id)->get();
            
            foreach ($users as $user)
            
            {
                 $paymentDetail = PaymentDetail::updateOrCreate([
                'user_id'                   => $user->id,
                'institution_id'            => $user->institution_id,
                'transaction_category_id'   => $payment->transaction_category_id,
                'payment_id'                => $payment->id,
                'degree_id'                 => $user->degree_id,
                'user_name'                 => $user->name,
                'amount'                    => $payment->amount,
                'description'               => $payment->title,   
                'sequence'                  => $payment->sequence,
                'is_tuition_fee'            => $payment->is_tuition_fee,
                'tuition_fee'               => $payment->tuition_fee,
                'eat'                       => $payment->eat,
                'laundry'                   => $payment->laundry,
                'year'                      => $payment->year,
                'paid'                      => '0',
                'unpaid'                    => $payment->sequence,
                'status'                    => 'active',
                'disable'                   => 'no'
            ]);
            
            }                            
          


        }
        elseif($request->type == 'degree')
        {
            $users = User::where('degree_id', $request->degree_id)->get();
            
            foreach ($users as $user)
            
            {
                 $paymentDetail = PaymentDetail::updateOrCreate([
                'user_id'                   => $user->id,
                'institution_id'            => $user->institution_id,
                'transaction_category_id'   => $payment->transaction_category_id,
                'payment_id'                => $payment->id,
                'degree_id'                 => $user->degree_id,
                'user_name'                 => $user->name,
                'amount'                    => $payment->amount,
                'description'               => $payment->title,   
                'sequence'                  => $payment->sequence,
                'is_tuition_fee'            => $payment->is_tuition_fee,
                'tuition_fee'               => $payment->tuition_fee,
                'eat'                       => $payment->eat,
                'laundry'                   => $payment->laundry,
                'year'                      => $payment->year,
                'paid'                      => '0',
                'unpaid'                    => $payment->sequence,
                'status'                    => 'active',
                'disable'                   => 'no'
            ]);
            
            }                
        }
        else
        {
            $user = User::where('nim', $request->nim)->first();
            //dd($user);
            
            $paymentDetail = PaymentDetail::updateOrCreate([
                'user_id'                   => $user->id,
                'institution_id'            => $user->institution_id,
                'transaction_category_id'   => $payment->transaction_category_id,
                'payment_id'                => $payment->id,
                'degree_id'                 => $user->degree_id,
                'user_name'                 => $user->name,
                'amount'                    => $payment->amount,
                'description'               => $payment->title,   
                'sequence'                  => $payment->sequence,
                'is_tuition_fee'            => $payment->is_tuition_fee,
                'tuition_fee'               => $payment->tuition_fee,
                'eat'                       => $payment->eat,
                'laundry'                   => $payment->laundry,
                'year'                      => $payment->year,
                'paid'                      => '0',
                'unpaid'                    => $payment->sequence,
                'status'                    => 'active',
                'disable'                   => 'no'
            ]);            
        }

          if($paymentDetail){
                    //redirect dengan pesan sukses
                    return redirect()->back()->with(['success' => 'Data Berhasil Diupdate!']);
                }else{
                    //redirect dengan pesan error
                    return redirect()->back()->with(['error' => 'Data Gagal Diupdate!']);
                }
        
    }

   
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $paymentDetail)
    {
        $user = User::where('id', Auth()->user()->id)->first();
        return view('admin.payment.paymentDetail.edit', compact('paymentDetail','user'));
       
    }

    /**
     * Update the specified resource in storage.
     */

    //proses update belum dipakai -------------------------------------------------------
    public function update(Request $request, Payment $paymentDetail)
    {
              

        $user = User::where('id',$request->user_id)->first();
        $institution = Institution::where('id', $user->institution_id)->first();
        $student = Student::where('user_id',$request->user_id)->first();
        
        //dd($student);
        //cek saldo

        if($user->balance < $request->amount){
            return redirect()->route('admin.paymentDetail.index')->with(['error' => 'Saldo tidak cukup!']);
        }

        else{

            $length = 5;
            $random = '';
            for ($i = 0; $i < $length; $i++) {
                $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
            }
    
            $trans_number = 'PM-'.Str::upper($random);
            //buat transaksi SV

            $createPayment = PaymentDetail::create([
                'institution_id'            => $user->institution_id,
                'user_id'                   => $user->id,
                'payment_id'                => $paymentDetail->id,
                'degree_id'                 => $student->id,
                'amount'                    => $paymentDetail->amount,
                'description'               => $paymentDetail->description,
                'status'                    => 'success',
                'disable'                   => 'no'
                ]);


        //update saldo user 
        $user_balance = $user->balance - $request->amount;
        $institution_balance = $institution->balance + $request->amount;
      

        $user->update([
            'balance' => $user_balance
        ]);
        
        //update saldo institution
        $institution->update([
            'balance'     => $institution_balance,
        ]);

        $transaction = Transaction::updateOrCreate([
            'trans_number'              => $trans_number,
            'institution_id'            => $user->institution_id,
            'user_id'                   => $user->id,
            'type'                      => 'credit',
            'transaction_category_id'   => '3', //payment category
            'destination_id'            => $user->id,
            'description'               => $paymentDetail->description, 
            'amount'                    => $paymentDetail->amount,
            'admin_fee'                 => '0',
            'shared_fee'                => '0',
            'status'                    => 'success',
        ]);
    
            if($institution){
                //redirect dengan pesan sukses
                return redirect()->route('admin.paymentDetail.index')->with(['success' => 'Data Berhasil Diupdate!']);
            }else{
                //redirect dengan pesan error
                return redirect()->route('admin.paymentDetail.index')->with(['error' => 'Data Gagal Diupdate!']);
            }

        }

    }  

    /**
     * Remove the specified resource from storage.
     */
   // public function destroy($id)
   // {
    //    $paymentDetail = PaymentDetail::where('id',$id)->first();
       
    //    $institution->update([
    //        'disable' => 'yes'
    //    ]);

    //    if($institution){
    //        return response()->json([
    //            'status' => 'success'
    //        ]);
    //    }else{
    //        return response()->json([
    //            'status' => 'error'
    //        ]);
    //    }
   // }
}
