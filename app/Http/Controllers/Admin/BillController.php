<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Institution;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function middleware(): array
     {
         return [
             'auth',
             new Middleware('permission', bills: ['index']),
             new Middleware('permission', bills: ['create']),
             new Middleware('permission', bills: ['edit']),
             new Middleware('permission', bills: ['delete'])
         ];
     }

    public function index()
    {
        $access = auth()->user()->access->id;
        $institution = Institution::where('id', auth()->user()->institution_id)->first();

        //dd($institution->institution_code);

        $totalbill = Bill::where('institution_id',auth()->user()->institution_id)
        ->sum('amount');

        if($access == '1'){

            $bills = Bill::latest()->where('disable','no')->when(request()->q, function($bills) {
                $bills = $bills->where('created_at', 'like', '%'. request()->q . '%');
            })->paginate(10);
    
            return view('admin.bill.index', compact('bills','institution','totalbill'));

        }else{

            $bills = Bill::latest()
                        ->when(request()->q, function($bills) {
                $bills = $bills->where('created_at', 'like', '%'. request()->q . '%');
            })
            ->where('referral_code', $institution->institution_code)
            ->where('disable','no')
            ->orWhere('institution_id', $institution->id)

            ->paginate(10);

            //dd($bills);
    
            return view('admin.bill.index', compact('bills','institution','totalbill'));

        }
        
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'amount'               => 'required',
            'description'          => 'required',
            'bank_transfer'        => 'required',
            'account_name'         => 'required',
        ]); 


        $user = User::where('id', auth()->user()->id)->first();
        $institution = Institution::where('id', $user->institution_id)->first();

        //dd($request->amount);
        //dd($institution->profit);
        if($institution->invoice == '0')
        {
            return redirect()->route('admin.bill.index')->with(['error' => 'Invoice Rp.0']);

        }else{

            $bill = Bill::create([
                'user_id'           => $user->id,
                'institution_id'    => $user->institution_id,
                'referral_code'     => $institution->referral_code,
                'amount'            => $request->amount,
                'bank_transfer'     => $request->bank_transfer,
                'account_name'      => $request->account_name,
                'description'       => $request->description,
                'status'            => 'waiting',
                'disable'           => 'no'
            ]);
    
                   
            if($bill){
                //redirect dengan pesan sukses
                return redirect()->route('admin.bill.index')->with(['success' => 'Data Berhasil Disimpan!']);
            }else{
                //redirect dengan pesan error
                return redirect()->route('admin.bill.index')->with(['error' => 'Data Gagal Disimpan!']);
            }
        }       
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Bill $bill)
    {
      
        $institution = Institution::where('id', Auth()->user()->institution_id)->first();
        return view('admin.bill.edit', compact('bill','institution'));
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bill $bill)
    {
       
        $request->validate([
            'amount'               => 'required',
            'status'               => 'required',
        ]); 

        $institution = Institution::where('id', Auth()->user()->institution_id)->first();


        if($request->amount > $institution->balance){
            return redirect()->route('admin.bill.index')->with(['error' => 'Saldo tidak cukup!']);
        }

        else{

            $bill->update([
                'user_id'           => Auth()->user()->id,
                'amount'            => $request->amount,
                'referral_code'     => $institution->referral_code,
                'bank_transfer'     => $request->bank_transfer,
                'account_name'      => $request->account_name,
                'status'            => $request->status,
                'description'       => $request->description,
            ]);
    
            if($bill){
                //redirect dengan pesan sukses
                return redirect()->route('admin.bill.index')->with(['success' => 'Data Berhasil Disimpan!']);
            }else{
                //redirect dengan pesan error
                return redirect()->route('admin.bill.index')->with(['error' => 'Data Gagal Disimpan!']);
            }

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

        //dd($bill);

        $bill = Bill::where('id',$id)->first();
        $user = User::where('id', Auth()->user()->id)->first();
        $institution = Institution::where('id', $bill->institution_id)->first();
       
        if($bill->amount > $institution->invoice){
            return redirect()->route('admin.bill.index')->with(['error' => 'Saldo tidak cukup!']);
        }

        else{

            //update status bill
            $bill->update([
                'status'             => 'success',
            ]);

            //update saldo institusi
            $invoice = $institution->invoice - $bill->amount;

            $institution->update([
                'invoice'           => $invoice,
            ]);

            //buat transaksi
            $length = 5;
                $random = '';
                for ($i = 0; $i < $length; $i++) {
                    $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
                }
        
                $trans_number = 'BL-'.Str::upper($random);
                //buat transaksi SV

                $transaction = Transaction::updateOrCreate([
                'trans_number'              => $trans_number,
                'institution_id'            => $institution->id,
                'user_id'                   => $user->id,
                'type'                      => 'credit',
                'transaction_category_id'   => '6', //bill category
                'destination_id'            => $user->id,
                'description'               => $bill->description,  
                'amount'                    => $bill->amount,
                'admin_fee'                 => '0',
                'shared_fee'                => '0',
                'status'                    => 'success',
            ]);

            if($transaction){
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

}