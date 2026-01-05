<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Bill;
use DB;

class BillReport implements FromCollection, WithHeadings 
{

    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
           
            'Institution',           
            'User',
            'Amount',
            'Bank',
            'Account',
            'Description',
            'Status',
        ];
    }
    public function collection()
    {
        //$date = date('Y-m-d');
        $institution_id = auth()->user()->institution_id;

        $bills = DB::table('bills')
            ->join('institutions', 'institutions.id', '=', 'bills.institution_id')
            ->join('users', 'users.id', '=', 'bills.user_id')
            ->select('institutions.institution_name', 'users.name', 'bills.amount','bills.bank_transfer','bills.account_name','bills.description','bills.status')
            ->where('bills.institution_id', $institution_id)
            ->get();
      
        return $bills ;

    }


}
