<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TransactionCategory;
use App\Models\User;
use App\Models\Institution;
use Spatie\Permission\Models\Role;
//use Illuminate\Validation\Validator;

class TransactionCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function middleware(): array
     {
         return [
             'auth',
             new Middleware('permission', transactionCategories: ['index']),
             new Middleware('permission', transactionCategories: ['create']),
             new Middleware('permission', transactionCategories: ['edit']),
             new Middleware('permission', transactionCategories: ['delete'])
         ];
     }
     
    public function index()
    {
        $access = auth()->user()->access->id;
        $institution_id = auth()->user()->institution_id;

        if($access == '1'){

            $transactionCategories = TransactionCategory::latest()->where('disable','no')->when(request()->q, function($transactionCategories) {
                $transactionCategories = $transactionCategories->where('description', 'like', '%'. request()->q . '%');
            })->paginate(10);
    
            return view('admin.transactionCategory.index', compact('transactionCategories'));

        }else{

            $transactionCategories = TransactionCategory::latest()
            ->where('disable','no')->when(request()->q, function($transactionCategories) {
                $transactionCategories = $transactionCategories->where('description', 'like', '%'. request()->q . '%');
            })->paginate(10);

            //dd($transactionCategories);
    
            return view('admin.transactionCategory.index', compact('transactionCategories'));

        }
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
         $request->validate([
            'coa_id'        => 'required|unique:transaction_categories,coa_id',
            'description'   => 'required|unique:transaction_categories,description',
            'is_hidden'     => 'required',
        ]);

       
        $transactionCategories = TransactionCategory::where('description', $request->description)
        ->where('coa_id', $request->coa_id)->first();

       
        $transactionCategories = TransactionCategory::create([
                'coa_id'                => $request->input('coa_id'),
                'description'           => $request->input('description'),
                'is_hidden'             => $request->input('is_hidden'),
                'status'                => 'active',
                'disable'               => 'no'
                
            ]);
    
            if($transactionCategories){
                //redirect dengan pesan sukses
                return redirect()->route('admin.transactionCategory.index')->with(['success' => 'Data Berhasil Disimpan!']);
            }else{
                //redirect dengan pesan error
                return redirect()->route('admin.transactionCategory.index')->with(['error' => 'Data Gagal Disimpan!']);
            }
        
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TransactionCategory $transactionCategory)
    {
        //dd($TransactionCategory);
        return view('admin.transactionCategory.edit', compact('transactionCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransactionCategory $transactionCategory)
    {
        $request->validate([
            'description' => 'required|unique:transaction_categories,description,'.$transactionCategory->id,
            'coa_id' => 'required|unique:transaction_categories,coa_id,'.$transactionCategory->id
        ]);

        $transactionCategory = TransactionCategory::where('id',$transactionCategory->id)->first();

        $transactionCategory->update([
            'coa_id'        => $request->coa_id,
            'description'   => $request->description,
            'is_hidden'     => $request->is_hidden,
            'status'        => $request->status,
        ]);

        
        if($transactionCategory){
            //redirect dengan pesan sukses
            return redirect()->route('admin.transactionCategory.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.transactionCategory.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transactionCategory = TransactionCategory::where('id',$id)->first();
     
        $transactionCategory->update([
            'disable' => 'yes'
            //'TransactionCategory_name' => 'TI Semester 4'
        ]);

        if($transactionCategory){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }

}
