<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Saving;
use DB;

class SavingReport implements FromCollection, WithHeadings 
{

    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
           
            'Institution',  
            'Description',         
            'User',
            'Class',
            'Balance',
            'Last Saving',
            
         
        ];
    }
    public function collection()
    {
        //$date = date('Y-m-d');
        $institution_id = auth()->user()->institution_id;

        $savings = DB::table('savings')
            ->join('degrees', 'degrees.id', '=', 'savings.degree_id')
            ->join('institutions', 'institutions.id', '=', 'savings.institution_id')
            ->join('users', 'users.id', '=', 'savings.user_id')
            
            ->select(
                'institutions.institution_name',
                'savings.description', 
                'users.name',
                'degrees.degree_name', 
                'savings.balance',
                'savings.updated_at')
            ->where('savings.institution_id', $institution_id)
            ->get();
      
        return $savings ;

    }


}
