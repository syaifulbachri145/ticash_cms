<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Gether;
use App\Models\GetherMember;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class GetherController extends Controller
{
    public function middleware(): array
    {
        return [
            'auth',
            new Middleware('permission', gethers: ['index']),
            new Middleware('permission', gethers: ['create']),
            new Middleware('permission', gethers: ['edit']),
            new Middleware('permission', gethers: ['delete'])
        ];
    }

    /**
     * Display a listing of the resource.
     */
   public function index()
    {

        $access = auth()->user()->access->id;
        $institution_id = auth()->user()->institution_id;

        //$now = Carbon::now()->isoFormat('YYYY-MM-DD');
       
        $getherBalance = Gether::where('user_id',auth()->user()->id)
                        ->sum('balance');
        

        if($access == '1'){
            $gethers = Gether::latest()
            ->where('disable','no')
            ->when(request()->q, function($gethers) {
                $gethers = $gethers
                  ->where('description', 'like', '%'. request()->q . '%')
                ->orWhere('user_name', 'like', '%'. request()->q . '%')
                ->orWhere('degree_name', 'like', '%'. request()->q . '%');
            })->paginate(10);
    
            //dd($gethers);

            return view('admin.gether.index', compact('gethers','getherBalance'));

        }
        elseif($access == '2')
        {
            $gethers = Gether::latest()
            ->where('institution_id', $institution_id)
            ->where('disable','no')->when(request()->q, function($gethers) {
                $gethers = $gethers
                ->where('description', 'like', '%'. request()->q . '%')
                ->orWhere('user_name', 'like', '%'. request()->q . '%')
                ->orWhere('degree_name', 'like', '%'. request()->q . '%');
            })->paginate(10);
    
            return view('admin.gether.index', compact('gethers','getherBalance'));
        }

         elseif($access == '6')
        {
            $gethers = Gether::latest()
            ->where('institution_id', $institution_id)
            ->where('disable','no')->when(request()->q, function($gethers) {
                $gethers = $gethers
                ->where('description', 'like', '%'. request()->q . '%')
                ->orWhere('user_name', 'like', '%'. request()->q . '%')
                ->orWhere('degree_name', 'like', '%'. request()->q . '%');
            })->paginate(10);
    
            return view('admin.gether.index', compact('gethers','getherBalance'));
        }
        
        else{

            $gethers = Gether::latest()
            ->where('institution_id', $institution_id)
            ->where('user_id',auth()->user()->id)
            ->where('disable','no')->when(request()->q, function($gethers) {
                $gethers = $gethers
                ->where('description', 'like', '%'. request()->q . '%')
                ->orWhere('user_name', 'like', '%'. request()->q . '%')
                ->orWhere('degree_name', 'like', '%'. request()->q . '%');
            })->paginate(10);
    
            return view('admin.gether.index', compact('gethers','getherBalance'));
        }

       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
       
        $request->validate([
            'description'       => 'required',
        ]); 

        $user = User::where('id', Auth()->user()->id)->first();

        $gether = Gether::updateOrCreate([
            'user_id'                   => $user->id,
            'user_name'                 => $user->name,
            'degree_name'               => $user->degree->degree_name,
            'degree_id'                 => $user->degree_id,
            'institution_id'            => $user->institution_id,
            'balance'                   => '0',
            'description'               => $request->description,  
            'goal'                      => $request->goal, 
            'deadline'                  => $request->deadline, 
            'status'                    => 'active',
            'disable'                   => 'no'
        ]);
            
            if($gether){
                //redirect dengan pesan sukses
                return redirect()->route('admin.gether.index')->with(['success' => 'Data Berhasil Diupdate!']);
            }else{
                //redirect dengan pesan error
                return redirect()->route('admin.gether.index')->with(['error' => 'Data Gagal Diupdate!']);
            }

    }  

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Gether $gether)
    {
        $user = User::where('id',$gether->user_id)->first();
        $getherBalance = Gether::where('user_id',auth()->user()->id)
        ->sum('balance');
        //dd($user->institution_id);
        $users = User::where('institution_id', $user->institution_id)->get();
        //dd($users);

        $getherMembers = GetherMember::where('gether_id', $gether->id)
        ->where('disable','no')
        ->latest()->paginate(10);

        return view('admin.gether.edit', compact('gether','user','users','getherMembers','getherBalance'));
       
    }
   
   
    public function update(Request $request, Gether $gether)
    {
       
        $request->validate([
            'amount'       => 'required',
        ]); 

        $user = User::where('id',$request->user_id)->first();
        //$gether = gether::where('user_id', $user->id)->first();
        //cek saldo

        if($request->amount > $user->balance){
            return redirect()->route('admin.gether.index')->with(['error' => 'Saldo tidak cukup!']);
        }

        else{

            $length = 5;
            $random = '';
            for ($i = 0; $i < $length; $i++) {
                $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
            }
    
            $trans_number = 'GT-'.Str::upper($random);
            //buat transaksi SV

            $transaction = Transaction::updateOrCreate([
            'trans_number'              => $trans_number,
            'institution_id'            => $user->institution_id,
            'user_id'                   => $user->id,
            'type'                      => 'credit',
            'transaction_category_id'   => '9', //gether category
            'destination_id'            => $user->id,
            'description'               => 'Tabungan Bersama',  
            'amount'                    => $request->input('amount'),
            'admin_fee'                 => '0',
            'shared_fee'                => '0',
            'status'                    => 'success',
        ]);

        //update saldo user 
        $user_balance = $user->balance - $request->amount;
        $gether_balance = $gether->balance + $request->amount;

        $user->update([
            'balance' => $user_balance
        ]);
        
        //update saldo institution
        $gether->update([
            'balance'     => $gether_balance,
            'description' => $request->description,
            'goal'        => $request->goal,
            'deadline'    => $request->deadline,
            'user_name'   => $user->name,
            'degree_name' => $user->degree->degree_name,
            'degree_id'   => $user->degree_id,
        ]);
            
            if($gether){
                //redirect dengan pesan sukses
                return redirect()->route('admin.gether.index')->with(['success' => 'Data Berhasil Diupdate!']);
            }else{
                //redirect dengan pesan error
                return redirect()->route('admin.gether.index')->with(['error' => 'Data Gagal Diupdate!']);
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
        $gether = Gether::where('id',$id)->first();
        $getherMember = GetherMember::where('gether_id',$gether->id)->latest();
        $user = User::where('id', $gether->user_id)->first();
        $user_balance = $user->balance + $gether->balance;

          //buat transaksi
          $length = 5;
          $random = '';
          for ($i = 0; $i < $length; $i++) {
              $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
          }
  
          $trans_number = 'GT-'.Str::upper($random);
          //buat transaksi SV

          $transaction = Transaction::updateOrCreate([
          'trans_number'              => $trans_number,
          'institution_id'            => $user->institution_id,
          'user_id'                   => $user->id,
          'type'                      => 'debit',
          'transaction_category_id'   => '7', //gether category
          'destination_id'            => $user->id,
          'description'               => 'Collect Gether',  
          'amount'                    => $gether->balance,
          'admin_fee'                 => '0',
          'shared_fee'                => '0',
          'status'                    => 'success',
      ]);

        //update saldo user
        $user->update([
            'balance' => $user_balance,
        ]);
        //non aktifkan tabungan 
        $gether->update([
            'balance' => '0',
            //'disable' => 'yes'
        ]);

        $getherMember->update([
            'amount' => '0',
            //'disable' => 'yes'
        ]);

        if($gether){
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

