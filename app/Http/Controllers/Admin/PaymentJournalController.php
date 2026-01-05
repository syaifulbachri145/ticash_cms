<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransactionCategory;
use App\Models\Payment;
use App\Models\Degree;
use App\Models\Institution;
use App\Models\PaymentDetail;
use App\Models\PaymentJournal;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Container\Attributes\Auth;

class PaymentJournalController extends Controller
{
    public function middleware(): array
    {
        return [
            'auth',
            new Middleware('permission', payments: ['index']),
            new Middleware('permission', payments: ['create']),
            new Middleware('permission', payments: ['edit']),
            new Middleware('permission', payments: ['delete'])
        ];
    }
    /**
     * Display a listing of the resource.
     */
   public function index()
    {

        $access = auth()->user()->access->id;
        $institution_id = auth()->user()->institution_id;

        $transactionCategories = TransactionCategory::where('status','active')
        ->where('disable','no')
        ->where('is_hidden','no')
        ->get();

        $journal = PaymentJournal::where('transaction_category_id', request()->q)
                                    ->where('institution_id', Auth()->user()->institution_id)->latest()->first();

         if ($journal === null) {
                $saldo_journal = '0';
            }
        else{
                $saldo_journal = $journal->saldo;
        }
       

        if($access == '1'){
            $payments = PaymentJournal::where('disable','no')
            ->when(request()->q, function($payments) {
                $payments = $payments->where('transaction_category_id', 'like', '%'. request()->q . '%');
            })->paginate(10);
    
            return view('admin.payment.paymentJournal.index', compact('payments','transactionCategories','saldo_journal'));
        }        
        else{

            $payments = PaymentJournal::where('institution_id', $institution_id)
            ->where('disable','no')->when(request()->q, function($payments) {
                $payments = $payments->where('transaction_category_id', 'like', '%'. request()->q . '%');
            })->paginate(10);
    
            return view('admin.payment.paymentJournal.index', compact('payments','transactionCategories','saldo_journal'));
        }

       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'amount'                    => 'required',
            'description'               => 'required',
            'type'                      => 'required',
            'transaction_category_id'   => 'required',
        ]);

        //dd($request);

        $year = Carbon::now()->isoFormat('YYYY');
        $institution = Institution::where('id', Auth()->user()->institution_id)->first();

        $journal = PaymentJournal::where('transaction_category_id', $request->transaction_category_id)
                                    ->where('institution_id', Auth()->user()->institution_id)->latest()->first();

         if ($journal === null) {
                $saldo_journal = '0';
            }
        else{
                $saldo_journal = $journal->saldo;
        }
      
            //dd($saldo_journal);

        if($request->type == 'debit')
            {
                $debit = $request->amount;
                $credit = '0';
                $saldo = $saldo_journal + $request->amount; 
                $balance = $institution->balance + $request->amount;
            }else
            {
                $saldo = $saldo_journal - $request->amount; 
                $debit = '0';
                $credit = $request->amount;
                $balance = $institution->balance - $request->amount;
            }

        

        $paymentJournal = PaymentJournal::create([
            'institution_id'            => Auth()->user()->institution_id,
            'user_id'                   => Auth()->user()->id,
            //'payment_id'                => '0',
            'transaction_category_id'   => $request->transaction_category_id,
            'user_name'                 => Auth()->user()->name,
            'description'               => $request->description,
            'amount'                    => $request->amount,
            'debit'                     => $debit,
            'credit'                    => $credit,
            'saldo'                     => $saldo,
            'user_approve'              => Auth()->user()->name,
            'type'                      => $request->type,
            'year'                      => $year,
            'status'                    => 'active',
            'disable'                   => 'no',
        ]);

        //update balance institution
        $institution->update([
             'balance'                     => $balance,
        ]);

         if($paymentJournal){
                   //redirect dengan pesan sukses
                    return redirect()->back()->with(['success' => 'Data Berhasil Diupdate!']);
                }else{
                    //redirect dengan pesan error
                    return redirect()->back()->with(['error' => 'Data Gagal Diupdate!']);
                }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
