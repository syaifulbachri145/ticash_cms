<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\User;
use DB;

class UserReport implements FromCollection, WithHeadings 
{

    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
           
            'Institution',           
            'User',
            'Nim',
            //'Kelas',
            //'accesses',
            'Balance',
            'VA Number',
            'Phone',
            'Email',
            'Address',
            'Batas Transaksi',
            'Nominal',
            'Graduation',
            'Status',
          
        ];
    }
    public function collection()
    {
        //$date = date('Y-m-d');
        $institution_id = auth()->user()->institution_id;

        $users = DB::table('users')
            ->join('institutions', 'institutions.id', '=', 'users.institution_id')
           // ->join('accesses', 'accesses.id', '=', 'users.access_id')
            //->join('degrees', 'degrees.id', '=', 'users.degree_id')
            ->select('institutions.institution_name','users.name','users.nim',
            //'degrees.degree_name',
            'users.balance','users.va_number','users.phone','users.email','users.address','users.is_limit','users.limitation','users.graduation','users.status')
            ->where('users.institution_id', $institution_id)
            ->get();
      
        return $users ;

    }


}
