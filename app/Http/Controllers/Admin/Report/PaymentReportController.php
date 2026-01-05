<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PaymentReport;

class PaymentReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Excel::download(new PaymentReport, 'Payment-Report.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $payment_id = $request->payment_id;
        //dd($date);

        return Excel::download(new PaymentReport ($request->start_date, $request->end_date, $request->payment_id), 'Payment-Report.xlsx');
       
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
