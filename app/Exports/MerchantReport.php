<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Merchant;
use DB;
use Carbon\Carbon;

class MerchantReport implements FromCollection, WithHeadings 
{

    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
           
            'INV',           
            'User',
            'Amount',
            'Status',
            'Date',
        ];
    }
    public function collection()
    {
        $now = Carbon::now()->isoFormat('YYYY-MM-DD');
        //$date = date('Y-m-d');
        $institution_id = auth()->user()->institution_id;

        $transactions = DB::table('transactions')
            ->join('institutions', 'institutions.id', '=', 'transactions.institution_id')
            ->join('users', 'users.id', '=', 'transactions.user_id')
            ->select('transactions.trans_number', 'users.name', 'transactions.amount','transactions.status','transactions.created_at')
            
            ->where('transactions.institution_id', $institution_id)
            ->where('transactions.transaction_category_id', '8')
            ->where('transactions.created_at', 'like', '%'. $now . '%')
            ->get();
      
        return $transactions ;

    }


}
