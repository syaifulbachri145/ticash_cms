<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function middleware(): array
    {
        return [
            'auth',
            new Middleware('permission', institutions: ['index']),
            new Middleware('permission', institutions: ['create']),
            new Middleware('permission', institutions: ['edit']),
            new Middleware('permission', institutions: ['delete'])
        ];
    }

    public function index()
    {
        $institutions = Institution::latest()->where('disable','no')->when(request()->q, function($institutions) {
            $institutions = $institutions->where('institution_name', 'like', '%'. request()->q . '%');
        })->paginate(10);

      

        //$institutions = Institution::latest()->get();
       // dd($institutions);

        return view('admin.institution.index', compact('institutions'));
        
    }

    public function store(Request $request)
    {
      
        $request->validate([
            'image'              => 'image|mimes:jpeg,jpg,png|max:2000',
            'institution_name'  => 'required',
            'email'             => 'required|email|unique:institutions',
            'contact'           => 'required',
            'address'           => 'required',
            'admin_fee'         => 'required',
            'shared_fee'        => 'required',
            'referral_code'     => 'required',
        ]); 

       
        $year = Carbon::now()->isoFormat('Y');
        $date = Carbon::now()->isoFormat('M');

        $int = Institution::count()+1;

        $institution_code = $int.$date.$year;

        //dd($institution_code);
        
        //upload image
        $image = $request->file('image');
        //dd($image);
        $image->storeAs('institutions', $image->hashName());

        
        //dd ($request) ;

        $institution = Institution::updateOrCreate([
            'institution_code'  => $institution_code,
            'referral_code'     => $request->input('referral_code'),
            'image'             => $image->hashName(),
            'institution_name'  => $request->input('institution_name'),
            'email'             => $request->input('email'),
            'address'           => $request->input('address'),
            'contact'           => $request->input('contact'),
            'admin_fee'         => $request->input('admin_fee'),
            'shared_fee'        => $request->input('shared_fee'),     
            'bank_transfer'     => $request->input('bank_transfer'),
            'account_number'    => $request->input('account_number'),
            'account_name'      => $request->input('account_name'),
            'chat_id'           => $request->input('chat_id'),     
            'balance'           => '0',
            'profit'            => '0',
            'invoice'           => '0',       
            'status'            => 'active',
            'disable'           => 'no'       
        ]);

        if($institution){
            //redirect dengan pesan sukses
            return redirect()->route('admin.institution.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.institution.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Institution $institution)
    {
        //$institution = Institution::latest()->get();
          
        return view('admin.institution.edit', compact('institution'));

       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Institution $institution)
    {
       
        $request->validate([
           
            'institution_name'  => 'required',
            'email'             => 'required|email|unique:institutions,email,'.$institution->id,
            'contact'           => 'required',
            'address'           => 'required',
            'admin_fee'         => 'required',
            'shared_fee'        => 'required',
            'referral_code'     => 'required',
        ]); 

        $image = $request->file('image');

        $institution = Institution::where('id',$institution->id)->first();

        //jika tidak upload gambar
        if($image == ''){
          
                $institution->update([
                'institution_name'  => $request->input('institution_name'),
                'referral_code'     => $request->input('referral_code'),
                'email'             => $request->input('email'),
                'address'           => $request->input('address'),
                'contact'           => $request->input('contact'),
                'admin_fee'         => $request->input('admin_fee'),
                'shared_fee'        => $request->input('shared_fee'),                  
                'status'            => $request->input('status'),    
                'bank_transfer'     => $request->input('bank_transfer'),
                'account_number'    => $request->input('account_number'),
                'account_name'      => $request->input('account_name'),
                'chat_id'           => $request->input('chat_id'),      
                ]);    

        }else{
            //hapus image lama

            Storage::disk('public')->delete('institutions/'.basename($institution->image));
             
            $image->storeAs('institutions', $image->hashName());



                $institution->update([
                'image'              => $image->hashName(),
                'referral_code'     => $request->input('referral_code'),
                'institution_name'  => $request->input('institution_name'),
                'email'             => $request->input('email'),
                'address'           => $request->input('address'),
                'contact'           => $request->input('contact'),
                'admin_fee'         => $request->input('admin_fee'),
                'shared_fee'        => $request->input('shared_fee'), 
                'bank_transfer'     => $request->input('bank_transfer'),
                'account_number'    => $request->input('account_number'),
                'account_name'      => $request->input('account_name'),
                'chat_id'           => $request->input('chat_id'),      
                'status'            => $request->input('status'),        
                ]);
        }

      
        if($institution){
            //redirect dengan pesan sukses
            return redirect()->route('admin.institution.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.institution.index')->with(['error' => 'Data Gagal Diupdate!']);
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
        $institution = Institution::where('id',$id)->first();
        Storage::disk('public')->delete('institutions/'.basename($institution->image));
     
        $institution->update([
            'disable' => 'yes'
        ]);

        if($institution){
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
