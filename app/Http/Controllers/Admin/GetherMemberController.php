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
use DB;
use Carbon\Carbon;

class GetherMemberController extends Controller
{
    public function middleware(): array
    {
        return [
            'auth',
            new Middleware('permission', getherMembers: ['index']),
            new Middleware('permission', getherMembers: ['create']),
            new Middleware('permission', getherMembers: ['edit']),
            new Middleware('permission', getherMembers: ['delete'])
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
      
        $getherBalance = GetherMember::where('user_id',auth()->user()->id)
                        ->sum('amount');
        

        if($access == '1'){

            //$members = GetherMember::latest()
            //->where('user_id',auth()->user()->id)
            //->where('disable','no')
            //->when(request()->q, function($members) {
            //    $members = $members->where('gether_id', 'like', '%'. request()->q . '%');
            //})->paginate(10);

            $members = DB::table('gether_members')
            ->join('users', 'users.id', '=', 'gether_members.user_id')
            ->join('gethers', 'gethers.id', '=', 'gether_members.gether_id')
            ->select('users.name','users.avatar','gethers.description', 'gethers.balance','gether_members.amount','gethers.goal','gethers.deadline','gether_members.id','gethers.updated_at','gethers.created_at',)
            //->where('gether_members.gether_id', $gether->id )
            ->where('gether_members.disable','no')->paginate(10);

           
            return view('admin.gether.member.index', compact('members','getherBalance'));

        }else{

            $members = GetherMember::latest()
            ->where('institution_id', $institution_id)
            ->where('user_id',auth()->user()->id)
            ->where('disable','no')->when(request()->q, function($members) {
                $members = $members->where('gether_id', 'like', '%'. request()->q . '%');
            })->paginate(10);
    
            return view('admin.gether.member.index', compact('members','getherBalance'));
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


        $request->validate([
            'user_id'       => 'required',
           
        ]); 

        //dd($request->user_id);

        $gether = Gether::where('id', $request->gether_id)->first();

        $member = GetherMember::where('gether_id', $gether->id)->first();

        //dd($member);

        //cek apakah user id sudah ada di daftar member jika ya maka tidak akan di input
        if ($request->user_id == $member->user_id)
      
        {
            return redirect()->back()->with('failed', 'Member alredy axist');
        }else{

          
            $gether = GetherMember::updateOrCreate([
                'user_id'                   => $request->user_id,
                'institution_id'            => $gether->institution_id,
                'gether_id'                 => $gether->id,
                'amount'                    => '0',
                'status'                    => 'active',
                'disable'                   => 'no'
            ]);
                
                if($gether){
                    //redirect dengan pesan sukses
                    return redirect()->back()->with('success', 'Member added successfuly');
                }else{
                    //redirect dengan pesan error
                    return redirect()->back()->with('failed', 'Member added Failed');
                }
            
        }

       

        
    }

   
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GetherMember $member)
    {
        $user = User::where('id',$member->user_id)->first();
        $getherBalance = Gether::where('id',$member->gether_id)
        ->sum('balance');
       
        return view('admin.gether.member.edit', compact('member','user','getherBalance'));
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GetherMember $member)
    {
       
        $request->validate([
            'amount'       => 'required',
        ]); 

        $user = User::where('id',$request->user_id)->first();
        $gether = Gether::where('id', $member->gether_id)->first();
        
        //cek saldo

        if($request->amount > $user->balance){
            return redirect()->route('admin.gether.member.index')->with(['error' => 'Saldo tidak cukup!']);
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
        $amount = $member->amount + $request->amount;

        $user->update([
            'balance' => $user_balance
        ]);
        
        //update saldo institution
        $gether->update([
            'balance'     => $gether_balance,
        ]);

        $member->update([
            'amount'      => $amount
        ]);

            if($gether){
                //redirect dengan pesan sukses
                return redirect()->route('admin.member.index')->with(['success' => 'Data Berhasil Diupdate!']);
            }else{
                //redirect dengan pesan error
                return redirect()->route('admin.member.index')->with(['error' => 'Data Gagal Diupdate!']);
            }

        }

    }  

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $member = GetherMember::where('id',$id)->first();
       
        $member->update([
            'disable' => 'yes'
        ]);

        if($member){
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
