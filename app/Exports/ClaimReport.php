<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Claim;
use DB;

class ClaimReport implements FromCollection, WithHeadings 
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
            'Description',
            'Approval',
            'Request Date',
            'Approval Date',
        ];
    }
    public function collection()
    {
        //$date = date('Y-m-d');
        $institution_id = auth()->user()->institution_id;

        $claims = DB::table('claims')
            ->join('institutions', 'institutions.id', '=', 'claims.institution_id')
            ->join('users', 'users.id', '=', 'claims.user_id')
            ->select('institutions.institution_name', 'users.name', 'claims.amount','claims.description','claims.user_approved','request_date','approval_date')
            ->where('claims.institution_id', $institution_id)
            ->get();
      
        return $claims ;

    }


}
