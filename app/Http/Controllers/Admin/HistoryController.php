<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;


class HistoryController extends Controller
{
    public function middleware(): array
    {
        return [
            'auth',
            new Middleware('permission', histories: ['index']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $access = auth()->user()->access_id;
        //dd($access);
        $institution_id = auth()->user()->institution_id;

        if($access == '1'){
            $histories = Transaction::latest()
            ->where('disable','no')
            ->when(request()->q, function($histories) {
                $histories = $histories->where('trans_number', 'like', '%'. request()->q . '%');
            })->paginate(10);
    
            return view('admin.history.index', compact('histories'));

        }
        elseif($access == '2')
        {
            $histories = Transaction::latest()
            ->where('institution_id', $institution_id)
            ->where('disable','no')->when(request()->q, function($histories) {
                $histories = $histories->where('trans_number', 'like', '%'. request()->q . '%');
            })->paginate(10);
    
            return view('admin.history.index', compact('histories'));
        }
        else{

            $histories = Transaction::latest()
            ->where('institution_id', $institution_id)
            ->where('user_id',auth()->user()->id)
            ->where('disable','no')->when(request()->q, function($histories) {
                $histories = $histories->where('trans_number', 'like', '%'. request()->q . '%');
            })->paginate(10);
    
            return view('admin.history.index', compact('histories'));
        }

       
    }

    public function edit(Transaction $history)
    {
        return view('admin.history.edit', compact('history'));
       
    }


}