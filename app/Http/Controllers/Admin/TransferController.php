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


class TransferController extends Controller
{
    public function middleware(): array
    {
        return [
            'auth',
            new Middleware('permission', transfers: ['index']),
            new Middleware('permission', transfers: ['create']),
            new Middleware('permission', transfers: ['edit']),
            new Middleware('permission', transfers: ['delete'])
        ];
    }

  public function index()
   {

       $access = auth()->user()->access->id;
       $institution_id = auth()->user()->institution_id;

       if($access == '1'){
           $transfers = Transaction::latest()
           ->where('transaction_category_id','2')
           ->where('disable','no')
           ->when(request()->q, function($transfers) {
               $transfers = $transfers->where('trans_number', 'like', '%'. request()->q . '%');
           })->paginate(10);
   
           return view('admin.transfer.index', compact('transfers'));

       }elseif($access == '2')
        {
            $transfers = Transaction::latest()
            ->where('institution_id', $institution_id)
            ->where('transaction_category_id','2')
            ->where('disable','no')->when(request()->q, function($transfers) {
                $transfers = $transfers->where('trans_number', 'like', '%'. request()->q . '%');
            })->paginate(10);
    
            return view('admin.transfer.index', compact('transfers'));
        }
       else{

           $transfers = Transaction::latest()
           ->where('user_id',auth()->user()->id)
           ->where('transaction_category_id','2')
           ->where('disable','no')->when(request()->q, function($transfers) {
               $transfers = $transfers->where('trans_number', 'like', '%'. request()->q . '%');
           })->paginate(10);
   
           return view('admin.transfer.index', compact('transfers'));
       }

      
   }

   /**
    * Show the form for creating a new resource.
    */
   public function store(Request $request)
   {
     
       $request->validate([
           'phone_number'        => 'required',
       ]); 
      
       $user = User::where('phone',$request->phone_number)->first();
      
       if($user){
           //redirect dengan pesan sukses
           return view('admin.transfer.edit', compact('user'));
       }else{
           //redirect dengan pesan error
           return redirect()->route('admin.transfer.index')->with(['error' => 'Data tidak ditemukan!']);
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

       $user = User::where('id', Auth()->user()->id)->first();

       $destination = User::where('id', $request->user_id)->first();

       //dd($destination->name);

       //cek saldo

       if($request->amount > $user->balance){
           return redirect()->route('admin.transfer.index')->with(['error' => 'Saldo tidak cukup!']);
       }
       else{

           $length = 5;
           $random = '';
           for ($i = 0; $i < $length; $i++) {
               $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
           }
   
           $trans_number = 'TF-'.Str::upper($random);
            //buat transaksi WD
          $transfer = Transaction::updateOrCreate([
           'trans_number'              => $trans_number,
           'institution_id'            => $user->institution_id,
           'user_id'                   => $request->user_id,
           'type'                      => 'credit',
           'transaction_category_id'   => '2', //transfer category
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
       $user->update([
           'balance' => $saldo_user
       ]);
       
       //update saldo institution
       $destination->update([
           'balance' => $saldo_destination
       ]);
           
           if($transfer){
               //redirect dengan pesan sukses
               return redirect()->route('admin.transfer.index')->with(['success' => 'Data Berhasil Diupdate!']);
           }else{
               //redirect dengan pesan error
               return redirect()->route('admin.transfer.index')->with(['error' => 'Data Gagal Diupdate!']);
           }

       }


   }
}
