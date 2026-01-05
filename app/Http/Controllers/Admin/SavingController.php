<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Saving;
use App\Models\Degree;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class SavingController extends Controller
{
    public function middleware(): array
    {
        return [
            'auth',
            new Middleware('permission', savings: ['index']),
            new Middleware('permission', savings: ['create']),
            new Middleware('permission', savings: ['edit']),
            new Middleware('permission', savings: ['delete'])
        ];
    }

    /**
     * Display a listing of the resource.
     */
   public function index()
    {

        $access = auth()->user()->access->id;
        $institution_id = auth()->user()->institution_id;
       
        $savingBalance = Saving::where('user_id',auth()->user()->id)
                        ->sum('balance');

        if($access == '1'){
            $savings = Saving::latest()
            ->where('user_id',auth()->user()->id)
            ->where('disable','no')
            ->when(request()->q, function($savings) {
                $savings = $savings
                 ->where('description', 'like', '%'. request()->q . '%')
                ->orWhere('user_name', 'like', '%'. request()->q . '%');
            })->paginate(10);
    
            return view('admin.saving.index', compact('savings','savingBalance','access'));

        }
        elseif($access == '2')
        {
            $savings = Saving::latest()
            ->where('institution_id', $institution_id)
            ->where('disable','no')->when(request()->q, function($savings) {
                $savings = $savings
                 ->where('description', 'like', '%'. request()->q . '%')
                ->orWhere('user_name', 'like', '%'. request()->q . '%');
            })->paginate(10);
    
            return view('admin.saving.index', compact('savings','savingBalance','access'));
        }
        elseif($access == '6')
        {
            $savings = Saving::latest()
            ->where('institution_id', $institution_id)
            ->where('disable','no')->when(request()->q, function($savings) {
                $savings = $savings
                ->where('description', 'like', '%'. request()->q . '%')
                ->orWhere('user_name', 'like', '%'. request()->q . '%')
                ->orWhere('degree_name', 'like', '%'. request()->q . '%');
            })->paginate(10);
    
            return view('admin.saving.index', compact('savings','savingBalance','access'));
        }


        else{

            $savings = Saving::latest()
            ->where('institution_id', $institution_id)
            ->where('user_id',auth()->user()->id)
            ->where('disable','no')->when(request()->q, function($savings) {
                $savings = $savings
                 ->where('description', 'like', '%'. request()->q . '%')
                ->orWhere('user_name', 'like', '%'. request()->q . '%');
            })->paginate(10);
    
            return view('admin.saving.index', compact('savings','savingBalance','access'));
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
       
        $saving = Saving::updateOrCreate([
            'user_id'                   => $user->id,
            'user_name'                 => $user->name,
            'degree_id'                 => $user->degree_id,
            'degree_name'               => $user->degree->degree_name,
            'institution_id'            => $user->institution_id,
            'balance'                   => '0',
            'description'               => $request->description,  
            'goal'                      => $request->goal, 
            'deadline'                  => $request->deadline, 
            'status'                    => 'active',
            'disable'                   => 'no'
        ]);
            
            if($saving){
                //redirect dengan pesan sukses
                return redirect()->route('admin.saving.index')->with(['success' => 'Data Berhasil Diupdate!']);
            }else{
                //redirect dengan pesan error
                return redirect()->route('admin.saving.index')->with(['error' => 'Data Gagal Diupdate!']);
            }

    }  

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Saving $saving)
    {
        $user = User::where('id',$saving->user_id)->first();

        return view('admin.saving.edit', compact('saving','user'));
       
    }
   
   
    public function update(Request $request, Saving $saving)
    {
       //proses saving -------------------------------------------

        $request->validate([
            'amount'       => 'required',
        ]); 

        $user = User::where('id',$request->user_id)->first();

        $degree_name = $user->degree->degree_name;

        //dd($degree_name);
       
        //cek saldo
        if($request->amount > $user->balance){
            return redirect()->route('admin.saving.index')->with(['error' => 'Saldo tidak cukup!']);
        }

        else{

            $length = 5;
            $random = '';
            for ($i = 0; $i < $length; $i++) {
                $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
            }
    
            $trans_number = 'SV-'.Str::upper($random);
            //buat transaksi SV

            $transaction = Transaction::updateOrCreate([
            'trans_number'              => $trans_number,
            'institution_id'            => $user->institution_id,
            'user_id'                   => $user->id,
            'type'                      => 'credit',
            'transaction_category_id'   => '7', //saving category
            'destination_id'            => $user->id,
            'description'               => 'Saving',  
            'amount'                    => $request->input('amount'),
            'admin_fee'                 => '0',
            'shared_fee'                => '0',
            'status'                    => 'success',
            'disable'                   => 'no'
        ]);

        //update saldo user 
        $user_balance = $user->balance - $request->amount;
        $saving_balance = $saving->balance + $request->amount;

        $user->update([
            'balance' => $user_balance
        ]);
        
        //update saldo institution
        $saving->update([
            'balance'     => $saving_balance,
            'description' => $request->description,
            'goal'        => $request->goal,
            'deadline'    => $request->deadline,
            'degree_id'   => $user->degree_id,
            'degree_name' => $degree_name, 
            'user_name'   => $user->name,
        ]);
            
            if($saving){
                //redirect dengan pesan sukses
                return redirect()->route('admin.saving.index')->with(['success' => 'Data Berhasil Diupdate!']);
            }else{
                //redirect dengan pesan error
                return redirect()->route('admin.saving.index')->with(['error' => 'Data Gagal Diupdate!']);
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

        //tarik tabungan/savings ---->> BELUM BISA DILAKUKAN

        $saving = Saving::where('id',$id)->first();
        $user = User::where('id', $saving->user_id)->first();
        $user_balance = $user->balance + $saving->balance;

        //buat transaksi
        $length = 5;
            $random = '';
            for ($i = 0; $i < $length; $i++) {
                $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
            }
    
            $trans_number = 'SV-'.Str::upper($random);
            //buat transaksi SV

            $transaction = Transaction::updateOrCreate([
            'trans_number'              => $trans_number,
            'institution_id'            => $user->institution_id,
            'user_id'                   => $user->id,
            'type'                      => 'debit',
            'transaction_category_id'   => '7', //saving category
            'destination_id'            => $user->id,
            'description'               => 'Collect Saving',  
            'amount'                    => $saving->balance,
            'admin_fee'                 => '0',
            'shared_fee'                => '0',
            'status'                    => 'success',
        ]);

         //update saldo user
         $user->update([
            'balance' => $user_balance,
        ]);
        //non aktifkan tabungan 
        $saving->update([
            'balance' => '0',
            //'disable' => 'yes'
        ]);
        
        if($saving){
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

