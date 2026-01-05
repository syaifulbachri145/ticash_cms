<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class TopupController extends Controller
{
    public function middleware(): array
    {
        return [
            'auth',
            new Middleware('permission', transactions: ['index']),
            new Middleware('permission', transactions: ['create']),
            new Middleware('permission', transactions: ['edit']),
            new Middleware('permission', transactions: ['delete'])
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $access = auth()->user()->access->id;
        $institution_id = auth()->user()->institution_id;

        if($access == '1'){
            $topups = Transaction::latest()
            ->where('transaction_category_id','1')
            ->where('disable','no')->when(request()->q, function($topups) {
                $topups = $topups->where('trans_number', 'like', '%'. request()->q . '%');
            })->paginate(10);
    
            return view('admin.topup.index', compact('topups'));

        }else{

            $topups = Transaction::latest()
            ->where('institution_id', $institution_id)
            ->where('transaction_category_id','1')
            //->where('user_id',auth()->user()->id)
            ->where('disable','no')->when(request()->q, function($topups) {
                $topups = $topups->where('trans_number', 'like', '%'. request()->q . '%');
            })->paginate(10);
    
            return view('admin.topup.index', compact('topups'));
        }

       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
      
        $request->validate([
            'amount'        => 'required',
            'description'   => 'required',
        ]); 
       
        $user = User::where('id',auth()->user()->id)->first();
        $institution = Institution::where('id',$user->institution_id)->first();

        $length = 5;
        $random = '';
        for ($i = 0; $i < $length; $i++) {
            $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
        }

        $trans_number = 'TP-'.Str::upper($random);
        //dd($user);
        //dd ($request) ;

        $topup = Transaction::updateOrCreate([
            'trans_number'              => $trans_number,
            'institution_id'            => $user->institution_id,
            'user_id'                   => $user->id,
            'type'                      => 'debit',
            'transaction_category_id'   => '1', //topup category
            'destination_id'            => $user->id,
            'description'               => $request->input('description'),  
            'amount'                    => $request->input('amount'),
            'admin_fee'                 => $institution->admin_fee,
            'shared_fee'                => $institution->shared_fee,
            'status'                    => 'waiting',
            'disable'                   => 'no'
        ]);

        if($topup){
            //redirect dengan pesan sukses
            return redirect()->route('admin.topup.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.topup.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $topup)
    {

        return view('admin.topup.edit', compact('topup'));
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $topup)
    {
       
        $request->validate([
            'status'       => 'required',
          
        ]); 

       // dd($topup->id);
        $transaction = Transaction::where('id',$topup->id)->first();

            $transaction->update([
           
            'status'            => $request->input('status'),     
            ]);
        
        if($transaction){
            //redirect dengan pesan sukses
            return redirect()->route('admin.topup.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.topup.index')->with(['error' => 'Data Gagal Diupdate!']);
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
        $invoice = $institution->invoice + $transaction->admin_fee;

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
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
