<?php

namespace App\Http\Controllers\Api\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function historyPage()
    {
       
        $user = User::whereId(auth()->guard('api')->user()->id)->first();
      
    

        $histories = Transaction::where('user_id', $user->id)->latest()->take(5)->get();

        return response()->json([
            'success'   => true,
            'message'   => 'List Data Histories',
            'data'      => $histories,
        ], 200);

    }

    public function histories()
    {
       
        $user = User::whereId(auth()->guard('api')->user()->id)->first();
      
        $histories = Transaction::where('disable','no')
        ->where('user_id',$user->id)
        ->latest()->paginate(15);

        return response()->json([
            'success'   => true,
            'message'   => 'List Data Histories',
            'data'      => $histories,
           
        ], 200);

    }
}
