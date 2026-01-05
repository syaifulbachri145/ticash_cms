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

class WithdrawalController extends Controller
{
    public function middleware(): array
    {
        return [
            'auth',
            new Middleware('permission', withdrawals: ['index']),
            new Middleware('permission', withdrawals: ['create']),
            new Middleware('permission', withdrawals: ['edit']),
            new Middleware('permission', withdrawals: ['delete'])
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
            $withdrawals = Transaction::latest()
            ->where('transaction_category_id','4')
            ->where('disable','no')
            ->when(request()->q, function($withdrawals) {
                $withdrawals = $withdrawals->where('trans_number', 'like', '%'. request()->q . '%');
            })->paginate(10);
    
            return view('admin.withdrawal.index', compact('withdrawals'));

        }elseif($access == '2')
        
        {
            $withdrawals = Transaction::latest()
            ->where('institution_id', $institution_id)
            ->where('transaction_category_id','4')
            ->where('disable','no')->when(request()->q, function($withdrawals) {
                $withdrawals = $withdrawals->where('trans_number', 'like', '%'. request()->q . '%');
            })->paginate(10);
    
            return view('admin.withdrawal.index', compact('withdrawals'));
        }else{
            $withdrawals = Transaction::latest()
            ->where('institution_id', $institution_id)
            ->where('user_id',auth()->user()->id)
            ->where('transaction_category_id','4')
            ->where('disable','no')->when(request()->q, function($withdrawals) {
                $withdrawals = $withdrawals->where('trans_number', 'like', '%'. request()->q . '%');
            })->paginate(10);
    
            return view('admin.withdrawal.index', compact('withdrawals'));
        }

       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
      
        $request->validate([
            'card_number'        => 'required',
        ]); 
       
        $user = User::where('card_number',$request->card_number)->first();
       
        if($user){
            //redirect dengan pesan sukses
            return view('admin.withdrawal.edit', compact('user'));
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.withdrawal.index')->with(['error' => 'Data tidak ditemukan!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
   
    public function update(Request $request, Transaction $user)
    {
       
        $request->validate([
            'amount'       => 'required',
            'description'   => 'required',
        ]); 

        //dd($request->user_id);

        $user = User::where('id',$request->user_id)->first();
        $institution = Institution::where('id',$user->institution_id)->first();

        //cek saldo

        if($request->amount > $user->balance){
            return redirect()->route('admin.withdrawal.index')->with(['error' => 'Saldo tidak cukup!']);
        }
        else{

            $length = 5;
            $random = '';
            for ($i = 0; $i < $length; $i++) {
                $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
            }
    
            $trans_number = 'WD-'.Str::upper($random);
        //buat transaksi WD
           $withdrawal = Transaction::updateOrCreate([
            'trans_number'              => $trans_number,
            'institution_id'            => $user->institution_id,
            'user_id'                   => $user->id,
            'type'                      => 'credit',
            'transaction_category_id'   => '4', //topup category
            'destination_id'            => $user->id,
            'description'               => $request->input('description'),  
            'amount'                    => $request->input('amount'),
            'admin_fee'                 => '0',
            'shared_fee'                => '0',
            'status'                    => 'success',
            'disable'                   => 'no'
        ]);

        //update saldo user 
        $saldo_user = $user->balance - $request->amount;
        $saldo_institution = $institution->balance + $request->amount;
        $user->update([
            'balance' => $saldo_user
        ]);
        
        //update saldo institution
        $institution->update([
            'balance' => $saldo_institution
        ]);
            
            if($withdrawal){
                //redirect dengan pesan sukses
                return redirect()->route('admin.withdrawal.index')->with(['success' => 'Data Berhasil Diupdate!']);
            }else{
                //redirect dengan pesan error
                return redirect()->route('admin.withdrawal.index')->with(['error' => 'Data Gagal Diupdate!']);
            }

        }


    }

    
  
}
