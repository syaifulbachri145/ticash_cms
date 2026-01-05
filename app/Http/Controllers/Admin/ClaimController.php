<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Institution;
use App\Models\User;
use App\Models\Claim;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ClaimController extends Controller
{
    public function middleware(): array
    {
        return [
            'auth',
            new Middleware('permission', claims: ['index']),
            new Middleware('permission', claims: ['create']),
            new Middleware('permission', claims: ['edit']),
            new Middleware('permission', claims: ['delete'])
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $access = auth()->user()->access->id;
        $institution = Institution::where('id', auth()->user()->institution_id)->first();

        if($access == '1')
        {
            $claims = Claim::latest()->where('disable','no')->when(request()->q, function($claims) {
                $claims = $claims->where('description', 'like', '%'. request()->q . '%');
            })->paginate(10);
           
            return view('admin.claim.index', compact('claims','institution'));

        }else{

            $claims = Claim::latest()->where('institution_id', $institution->id)
            ->where('disable','no')
            ->when(request()->q, function($claims) {
                $claims = $claims->where('description', 'like', '%'. request()->q . '%');
            })->paginate(10);
         
            return view('admin.claim.index', compact('claims','institution'));
        }

        
        
    }

    public function store(Request $request)
    {
      
        $request->validate([
            'amount'               => 'required',
            'description'          => 'required',
        ]); 

        $institution = Institution::where('id', Auth()->user()->institution_id)->first();

        $now = Carbon::now()->isoFormat('YYYY-MM-DD H:m:s');
        //dd($now);
        //cek balance

        if($request->amount > $institution->balance){
            return redirect()->route('admin.claim.index')->with(['error' => 'Saldo tidak cukup!']);
        }

        else{

            $claim = Claim::updateOrCreate([
                'user_id'           => Auth()->user()->id,
                'institution_id'    => $institution->id,
                'user_approved'      => '-',
                'amount'            => $request->amount,
                'description'       => $request->description,
                'request_date'      => $now,
                'status'            => 'waiting',
                'disable'           => 'no'
                               
            ]);
    
            if($claim){
                //redirect dengan pesan sukses
                return redirect()->route('admin.claim.index')->with(['success' => 'Data Berhasil Disimpan!']);
            }else{
                //redirect dengan pesan error
                return redirect()->route('admin.claim.index')->with(['error' => 'Data Gagal Disimpan!']);
            }

        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Claim $claim)
    {
      
        $institution = Institution::where('id', Auth()->user()->institution_id)->first();
        return view('admin.claim.edit', compact('claim','institution'));

       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, claim $claim)
    {
       
        $request->validate([
            'amount'               => 'required',
            'description'          => 'required',
            'status'               => 'required',
        ]); 

        $institution = Institution::where('id', Auth()->user()->institution_id)->first();

        $now = Carbon::now()->isoFormat('YYYY-MM-DD H:m:s');
        //dd($now);
        //cek balance

        if($request->amount > $institution->balance){
            return redirect()->route('admin.claim.index')->with(['error' => 'Saldo tidak cukup!']);
        }

        else{

            $claim->update([
                'user_id'           => Auth()->user()->id,
                'amount'            => $request->amount,
                'description'       => $request->description,
                'status'            => $request->status,
                'request_date'      => $now
                               
            ]);
    
            if($claim){
                //redirect dengan pesan sukses
                return redirect()->route('admin.claim.index')->with(['success' => 'Data Berhasil Disimpan!']);
            }else{
                //redirect dengan pesan error
                return redirect()->route('admin.claim.index')->with(['error' => 'Data Gagal Disimpan!']);
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

        $claim = Claim::where('id',$id)->first();
        $user = User::where('id', Auth()->user()->id)->first();
        $institution = Institution::where('id', Auth()->user()->institution_id)->first();

        $now = Carbon::now()->isoFormat('YYYY-MM-DD H:m:s');       

        if($claim->amount > $institution->balance){
            return redirect()->route('admin.claim.index')->with(['error' => 'Saldo tidak cukup!']);
        }

        else{

            //update status claim
            $claim->update([
                'user_approved'      => Auth()->user()->name,
                'status'             => 'approved',
                'approval_date'      => $now
            ]);

            //update saldo institusi
            $balance = $institution->balance - $claim->amount;
            $institution->update([
                'balance'           => $balance,
            ]);

            //buat transaksi
            $length = 5;
                $random = '';
                for ($i = 0; $i < $length; $i++) {
                    $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
                }
        
                $trans_number = 'CM-'.Str::upper($random);
                //buat transaksi SV

                $transaction = Transaction::updateOrCreate([
                'trans_number'              => $trans_number,
                'institution_id'            => $institution->id,
                'user_id'                   => $user->id,
                'type'                      => 'credit',
                'transaction_category_id'   => '5', //claim category
                'destination_id'            => $user->id,
                'description'               => $claim->description,  
                'amount'                    => $claim->amount,
                'admin_fee'                 => '0',
                'shared_fee'                => '0',
                'status'                    => 'success',
            ]);


            if($claim){
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
