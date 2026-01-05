<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use App\Models\User;
use App\Models\Payment;
use App\Models\PaymentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;

class PaymentUserController extends Controller
{
    public function middleware(): array
    {
        return [
            'auth',
            new Middleware('permission', paymentUsers: ['index']),
            new Middleware('permission', paymentUsers: ['create']),
            new Middleware('permission', paymentUsers: ['edit']),
            new Middleware('permission', paymentUsers: ['delete'])
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if(Auth()->user()->access == '1'){

            $users = User::latest()->where('disable','no')->when(request()->q, function($users) {
                $users = $users->where('name', 'like', '%'. request()->q . '%');
            })->paginate(10);


            return view('admin.payment.paymentUser.index', compact('users'));

        }else{

            $users = User::latest()->where('institution_id', Auth()->user()->institution_id)           
            ->where('disable','no')->when(request()->q, function($users) {
                $users = $users->where('name', 'like', '%'. request()->q . '%');
            })->paginate(10);
    

            return view('admin.payment.paymentUser.index', compact('users'));
        }
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentDetail $paymentUser)
    {
        //dd($paymentUser);
        return view('admin.payment.paymentUser.show', compact('paymentUser'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $paymentUser)
    {

        //dd($paymentUser->name);
        $user = $paymentUser;

        $payments = PaymentDetail::where('user_id', $user->id)
        ->where('disable','no')
        ->when(request()->q, function($payments) {
            $payments = $payments->where('description', 'like', '%'. request()->q . '%');
        })->latest()->paginate(100);

      
        return view('admin.payment.paymentUser.edit', compact('payments'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, PaymentDetail $paymentUser)
    {
         $request->validate([
            //'title'                     => 'required|unique:payments,title,'.$payment->id,
            //'description'               => 'required',
            'amount'                    => 'required',
            //'transaction_category_id'   => 'required',
            //'type'                      => 'required',
            'paid'                      => 'required',
            //'unpaid'                    => 'required',
        ]); 

        //dd($paymentUser);

        $paid = $request->paid;
        $unpaid = $paymentUser->sequence - $paid;


        if($paymentUser->is_tuition_fee == 'yes')
        {
             $paymentUser->update([
                'amount'                    => $request->amount,
                'paid'                      => $paid,   
                'unpaid'                    => $unpaid,
                'tuition_fee'               => $request->tuition_fee,
                'eat'                       => $request->eat,
                'laundry'                   => $request->laundry,
            ]);
        }else{
              $paymentUser->update([
                'amount'                    => $request->amount,
                'paid'                      => $paid,   
                'unpaid'                    => $unpaid,
               
            ]);
        }

         if($paymentUser){
           
             return redirect()->route('admin.paymentUser.edit', $paymentUser->user_id)->with(['success' => 'Data Berhasil Diupdate!']);

        }else{
          
            return redirect()->route('admin.paymentUser.edit', $paymentUser->user_id)->with(['error' => 'Data Gagal Diupdate!']);
           
        }   
         

         



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
