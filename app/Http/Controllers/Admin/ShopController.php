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

class ShopController extends Controller
{
    public function middleware(): array
    {
        return [
            'auth',
            new Middleware('permission', shops: ['index']),
            new Middleware('permission', shops: ['create']),
            new Middleware('permission', shops: ['edit']),
            new Middleware('permission', shops: ['delete'])
        ];
    }

    /**
     * Display a listing of the resource.
     */
   public function index()
    {

        //$user = User::where('id', auth()->user()->access->id);
        $access = auth()->user()->access->id;
        $institution_id = auth()->user()->institution_id;

        $now = Carbon::now()->isoFormat('YYYY-MM-DD');
        
        //dd($today);

        $transToday = Transaction::where('destination_id',auth()->user()->id)
            ->where('transaction_category_id','8')
            ->where('created_at', 'like', '%'. $now . '%')->sum('amount');

        //dd($transToday);


        if($access == '1'){
            $shops = Transaction::latest()
            ->where('transaction_category_id','8')
            ->where('destination_id',auth()->user()->id)
            ->where('disable','no')
            ->when(request()->q, function($shops) {
                $shops = $shops->where('trans_number', 'like', '%'. request()->q . '%');
            })->paginate(10);
    
            return view('admin.shop.index', compact('shops','transToday'));

        }
        elseif($access == '2')
        {
            $shops = Transaction::latest()
            ->where('institution_id', $institution_id)
            ->where('transaction_category_id','8')
            ->where('disable','no')->when(request()->q, function($shops) {
                $shops = $shops->where('trans_number', 'like', '%'. request()->q . '%');
            })->paginate(10);
    
            return view('admin.shop.index', compact('shops','transToday'));
        }
        else{

            $shops = Transaction::latest()
            ->where('institution_id', $institution_id)
            ->where('destination_id',auth()->user()->id)
            ->where('transaction_category_id','8')
            ->where('disable','no')->when(request()->q, function($shops) {
                $shops = $shops->where('trans_number', 'like', '%'. request()->q . '%');
            })->paginate(10);
    
            return view('admin.shop.index', compact('shops','transToday'));
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
            return view('admin.shop.edit', compact('user'));
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.shop.index')->with(['error' => 'Data tidak ditemukan!']);
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
        ]); 

        $user = User::where('id',$request->user_id)->first();
        //merchant
        $merchant = User::where('id', Auth()->user()->id)->first();

        //cek saldo
          if( $request->amount > $user->balance){
              return redirect()->route('admin.shop.index')->with(['error' => 'Saldo tidak cukup!']);      
          }

        //cek is limit
          if ($user->is_limit == 'yes'){

            //cek transaksi shop today
            $now = Carbon::now()->isoFormat('YYYY-MM-DD');
                    $trans_now = Transaction::where('user_id',$user->id)
                    ->where('transaction_category_id','8')
                    ->where('created_at', 'like', '%'. $now . '%')
                    ->sum('amount');

                    $trans_amount = $trans_now + $request->amount;

                     //cek limit transaksi
                    if($trans_amount > $user->limitation){
                         return redirect()->route('admin.shop.index')->with(['error' => 'sudah mencapai batas limit transaksi!']);
                    }
          }

          //create transaksi
                    $length = 5;
                    $random = '';
                    for ($i = 0; $i < $length; $i++) {
                        $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
                    }
            
                    $trans_number = 'SP-'.Str::upper($random);
                    //buat transaksi WD
                    $shop = Transaction::updateOrCreate([
                    'trans_number'              => $trans_number,
                    'institution_id'            => $user->institution_id,
                    'user_id'                   => $user->id,
                    'type'                      => 'credit',
                    'transaction_category_id'   => '8', //topup category
                    'destination_id'            => $merchant->id,
                    'description'               => 'Shop',  
                    'amount'                    => $request->input('amount'),
                    'admin_fee'                 => '0',
                    'shared_fee'                => '0',
                    'status'                    => 'success',
                    'disable'                   => 'no'
                    ]);

                    //update saldo user 
                    $saldo_user = $user->balance - $request->amount;
                    $saldo_merchant = $merchant->balance + $request->amount;

                    $user->update([
                        'balance' => $saldo_user
                    ]);
                    
                    //update saldo institution
                    $merchant->update([
                        'balance' => $saldo_merchant
                    ]);  
                    
                     if($shop){
                        //redirect dengan pesan sukses
                        return redirect()->route('admin.shop.index')->with(['success' => 'Data Berhasil Diupdate!']);
                    }else{
                        //redirect dengan pesan error
                        return redirect()->route('admin.shop.index')->with(['error' => 'Data Gagal Diupdate!']);
                    }
                    
    }  
}
