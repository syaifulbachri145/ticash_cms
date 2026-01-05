<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Gether;
use DB;

class GetherReport implements FromCollection, WithHeadings 
{

    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
           
            'Institution',           
            'User',
            'Balance',
            'Description',
        ];
    }
    public function collection()
    {
        //$date = date('Y-m-d');
        $institution_id = auth()->user()->institution_id;

        $gethers = DB::table('gethers')
            ->join('institutions', 'institutions.id', '=', 'gethers.institution_id')
            ->join('users', 'users.id', '=', 'gethers.user_id')
            ->select('institutions.institution_name', 'users.name', 'gethers.balance','gethers.description')
            ->where('gethers.institution_id', $institution_id)
            ->get();
      
        return $gethers ;

    }


}
