<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransactionCategory;
use App\Models\Payment;
use App\Models\Degree;
use App\Models\PaymentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

use Illuminate\Validation\Validator;

class PaymentController extends Controller
{
    public function middleware(): array
    {
        return [
            'auth',
            new Middleware('permission', payments: ['index']),
            new Middleware('permission', payments: ['create']),
            new Middleware('permission', payments: ['edit']),
            new Middleware('permission', payments: ['delete'])
        ];
    }

    /**
     * Display a listing of the resource.
     */
   public function index()
    {

        $access = auth()->user()->access->id;
        $institution_id = auth()->user()->institution_id;
        $transactionCategories = TransactionCategory::where('status','active')
        ->where('disable','no')
        ->where('is_hidden','no')
        ->get();

        //dd($TransactionCategories);
        //$now = Carbon::now()->isoFormat('YYYY-MM-DD');
       
        $paymentAmount = Payment::where('user_id',auth()->user()->id)
                        ->sum('amount');
        
        $degrees = Degree::where('institution_id',Auth()->user()->institution_id)->get();


        if($access == '1'){
            $payments = Payment::latest()
            ->where('disable','no')
            ->when(request()->q, function($payments) {
                $payments = $payments->where('title', 'like', '%'. request()->q . '%');
            })->paginate(10);
    
            return view('admin.payment.index', compact('payments','degrees','paymentAmount','transactionCategories'));

        }
        
        else{

            $payments = Payment::latest()
            ->where('institution_id', $institution_id)
            ->where('disable','no')->when(request()->q, function($payments) {
                $payments = $payments->where('title', 'like', '%'. request()->q . '%');
            })->paginate(10);
    
            return view('admin.payment.index', compact('payments','degrees','paymentAmount','transactionCategories'));
        }

       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {

         $request->validate([
            //'title'                     => 'required|unique:payments,title,'.Auth()->user()->institution_id,
             'title'                    => 'required',
            'amount'                    => 'required',
            'description'               => 'required',
            'is_tuition_fee'            => 'required',
            'type'                      => 'required',
            'sequence'                  => 'required',
            'year'                      => 'required',
            'transaction_category_id'   => 'required',
        ]);

       //jika SPP
       if ($request->is_tuition_fee == 'yes')
       {
            $payment = Payment::updateOrCreate([
                'user_id'                   => Auth()->user()->id,
                'institution_id'            => Auth()->user()->institution_id,
                'transaction_category_id'   => $request->transaction_category_id,
                'title'                     => $request->title,
                'amount'                    => $request->amount,
                'description'               => $request->description,   
                'type'                      => $request->type,
                'sequence'                  => $request->sequence,
                'is_tuition_fee'            => $request->is_tuition_fee,
                'tuition_fee'               => $request->tuition_fee,
                'eat'                       => $request->eat,
                'laundry'                   => $request->laundry,
                'year'                      => $request->year,
                'status'                    => 'active',
                'disable'                   => 'no'
            ]);
       }else{

         $payment = Payment::updateOrCreate([
                'user_id'                   => Auth()->user()->id,
                'institution_id'            => Auth()->user()->institution_id,
                'transaction_category_id'   => $request->transaction_category_id,
                'title'                     => $request->title,
                'amount'                    => $request->amount,
                'description'               => $request->description,   
                'type'                      => $request->type,
                'sequence'                  => $request->sequence,
                'is_tuition_fee'            => $request->is_tuition_fee,
                'tuition_fee'               => '0',
                'eat'                       => '0',
                'laundry'                   => '0',
                'year'                      => $request->year,
                'status'                    => 'active',
                'disable'                   => 'no'
            ]);

       }
                
                if($payment){
                    //redirect dengan pesan sukses
                    return redirect()->route('admin.payment.index')->with(['success' => 'Data Berhasil Diupdate!']);
                }else{
                    //redirect dengan pesan error
                    return redirect()->route('admin.payment.index')->with(['error' => 'Data Gagal Diupdate!']);
                }

       
    }  

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
       
        //mendapatkan data detail payment
      
        $transactionCategories = TransactionCategory::where('status','active')
        ->where('disable','no')
        ->where('is_hidden','no')
        ->get();

        return view('admin.payment.edit', compact('payment','transactionCategories'));
       
    }
   
   
    public function update(Request $request, Payment $payment)
    {
       
        $request->validate([
            'title'                     => 'required|unique:payments,title,'.$payment->id,
            'description'               => 'required',
            'amount'                    => 'required',
            'transaction_category_id'   => 'required',
            'type'                      => 'required',
            'sequence'                  => 'required',
            'is_tuition_fee'            => 'required',
        ]);  

      
          //jika SPP
       if ($request->is_tuition_fee == 'yes')
       {
                $payment->update([
                'transaction_category_id'   => $request->transaction_category_id,
                'title'                     => $request->title,
                'amount'                    => $request->amount,
                'description'               => $request->description,   
                'type'                      => $request->type,
                'sequence'                  => $request->sequence,
                'is_tuition_fee'            => $request->is_tuition_fee,
                'tuition_fee'               => $request->tuition_fee,
                'eat'                       => $request->eat,
                'laundry'                   => $request->laundry,
                'year'                      => $request->year,
                //'status'                    => $request->status,
            ]);

    //update ke tabel payment detail -----------------------------------------------------------

         
            PaymentDetail::where('payment_id',$payment->id)
                ->update([
                'transaction_category_id'   => $request->transaction_category_id,
                //'title'                     => $request->title,
                'amount'                    => $request->amount,
                'description'               => $request->description,   
                //'type'                      => $request->type,
                'degree_id'                 => $request->degree_id,
                'sequence'                  => $request->sequence,
                'is_tuition_fee'            => $request->is_tuition_fee,
                'tuition_fee'               => $request->tuition_fee,
                'eat'                       => $request->eat,
                'laundry'                   => $request->laundry,
                'year'                      => $request->year,
                //'status'                    => $request->status,
            ]);

       }else{

                $payment->update([
                'transaction_category_id'   => $request->transaction_category_id,
                'title'                     => $request->title,
                'amount'                    => $request->amount,
                'description'               => $request->description,   
                'type'                      => $request->type,
                'sequence'                  => $request->sequence,
                'is_tuition_fee'            => $request->is_tuition_fee,
                'tuition_fee'               => '0',
                'eat'                       => '0',
                'laundry'                   => '0',
                'year'                      => $request->year,
                //'status'                    => $request->status,


            ]);

    //update ke tabel payment detail -----------------------------------------------------------

           PaymentDetail::where('payment_id',$payment->id)
                ->update([
                'transaction_category_id'   => $request->transaction_category_id,
                //'title'                     => $request->title,
                'amount'                    => $request->amount,
                'description'               => $request->description,   
                //'type'                      => $request->type,
                'degree_id'                 => $request->degree_id,
                'sequence'                  => $request->sequence,
                'is_tuition_fee'            => $request->is_tuition_fee,
                'tuition_fee'               => '0',
                'eat'                       => '0',
                'laundry'                   => '0',
                'year'                      => $request->year,
                //'status'                    => $request->status,
            ]);

       }


        if($payment){
            //redirect dengan pesan sukses
            return redirect()->route('admin.payment.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.payment.index')->with(['error' => 'Data Gagal Diupdate!']);
        }   
    }  


     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment = Payment::where('id',$id)->first();
       
        //non aktifkan tabungan 
        $payment->update([
            //'balance' => '0',
            'disable' => 'yes'
        ]);

       
        if($payment){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }

}

