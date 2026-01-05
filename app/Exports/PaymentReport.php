<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Payment;
use App\Models\PaymentDetail;
use DB;

class PaymentReport implements FromCollection, WithHeadings 
{

    protected $start_date,$end_date,$payment_id;

    public function __construct(String $start_date, String $end_date, String $payment_id) {

        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->payment_id = $payment_id;
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
           
            'Nama', 
            'NIM',          
            'Kelas',
            'Jumlah',
            'Status',
            'Tanggal',
        ];
    }
    public function collection()
    {
        //$date = date('Y-m-d');
        $institution_id = auth()->user()->institution_id;

        
        $payments = DB::table('payment_details')
            ->join('degrees', 'degrees.id', '=', 'payment_details.degree_id')
            ->join('users', 'users.id', '=', 'payment_details.user_id')
            ->select('payment_details.user_name', 
            'users.nim',
            'degrees.degree_name', 
            'payment_details.amount','payment_details.status','payment_details.created_at')
            ->where('payment_details.institution_id', $institution_id)
            ->where('payment_details.payment_id', $this->payment_id)
            //->whereBetween('payments.created_at', [$this->start_date, $this->end_date])
            ->get();
      
        return $payments ;

    }


}
