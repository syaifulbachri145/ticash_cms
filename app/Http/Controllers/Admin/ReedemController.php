<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Reedem;
use App\Models\Institution;
use App\Models\Transaction;
use App\Models\User;
use App\Models\PaymentJournal;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class ReedemController extends Controller
{
   /**
     * Display a listing of the resource.
     */

     public function middleware(): array
     {
         return [
             'auth',
             new Middleware('permission', reedems: ['index']),
             new Middleware('permission', reedems: ['create']),
             new Middleware('permission', reedems: ['edit']),
             new Middleware('permission', reedems: ['delete'])
         ];
     }

    public function index()
    {
        $access = auth()->user()->access->id;
        $institution = Institution::where('id', auth()->user()->institution_id)->first();
        $journal = PaymentJournal::where('institution_id',auth()->user()->institution_id)
        ->where('transaction_category_id','10')->latest()->first();

        if ($journal === null) {
                $totalReedem = '0';
            }
        else{
                $totalReedem = $journal->saldo;
        }

        
        if($access == '1'){

            $reedems = PaymentJournal::latest()->where('disable','no')->where('transaction_category_id','10')->when(request()->q, function($reedems) {
                $reedems = $reedems->where('created_at', 'like', '%'. request()->q . '%');
            })->paginate(10);
    
            return view('admin.reedem.index', compact('reedems','institution','totalReedem'));

        }else{

            $reedems = Reedem::latest()
            ->where('institution_id', $institution->id)
            ->where('transaction_category_id','10')->where('disable','no')->when(request()->q, function($reedems) {
                $reedems = $reedems->where('created_at', 'like', '%'. request()->q . '%');
            })->paginate(10);

            //dd($reedems);
    
            return view('admin.reedem.index', compact('reedems','institution','totalReedem'));

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

        $user = User::where('id', auth()->user()->id)->first();


        $institution = Institution::where('id', $user->institution_id)->first();

        $year = Carbon::now()->isoFormat('YYYY');
        $institution = Institution::where('id', Auth()->user()->institution_id)->first();

        $journal = PaymentJournal::where('transaction_category_id', '10')
                                    ->where('institution_id', Auth()->user()->institution_id)->latest()->first();

         if ($journal === null) {
                $saldo_journal = '0';
            }
        else{
                $saldo_journal = $journal->saldo;
        }
      
            //dd($saldo_journal);


        //dd($institution->profit);
        if($institution->profit == '0')
        {
            return redirect()->route('admin.reedem.index')->with(['error' => 'Saldo Institusi 0']);

        }else{


             $saldo = $saldo_journal + $institution->profit; 

             $paymentJournal = PaymentJournal::create([
            'institution_id'            => Auth()->user()->institution_id,
            'user_id'                   => Auth()->user()->id,
            //'payment_id'                => '0',
            'transaction_category_id'   => '10',
            'user_name'                 => Auth()->user()->name,
            'description'               => 'Biaya Admin',
            'amount'                    => $institution->profit,
            'debit'                     => $institution->profit,
            'credit'                    => '0',
            'saldo'                     => $saldo,
            'user_approve'              => Auth()->user()->name,
            'type'                      => 'debit',
            'year'                      => $year,
            'status'                    => 'active',
            'disable'                   => 'no',
        ]);
    
            $balance = $institution->balance + $institution->profit;
             $institution->update([
                'balance'       => $balance,
                'profit'        => '0'
            ]);          
          
               
            if($paymentJournal){
                //redirect dengan pesan sukses
                return redirect()->route('admin.reedem.index')->with(['success' => 'Data Berhasil Disimpan!']);
            }else{
                //redirect dengan pesan error
                return redirect()->route('admin.reedem.index')->with(['error' => 'Data Gagal Disimpan!']);
            }
        }       
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}