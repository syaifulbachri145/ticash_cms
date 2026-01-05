<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Reedem;
use DB;

class ReedemReport implements FromCollection, WithHeadings 
{

    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
           
            'User',
            'Balance',
            'Status',
            'Date',
        ];
    }
    public function collection()
    {
        //$date = date('Y-m-d');
        $institution_id = auth()->user()->institution_id;

        $reedems = DB::table('reedems')
            ->join('institutions', 'institutions.id', '=', 'reedems.institution_id')
            ->join('users', 'users.id', '=', 'reedems.user_id')
            ->select( 'users.name', 'reedems.amount','reedems.status','reedems.created_at')
            ->where('reedems.institution_id', $institution_id)
            ->get();
      
        return $reedems ;

    }


}
