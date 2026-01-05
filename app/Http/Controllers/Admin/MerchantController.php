<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Merchant;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;

class MerchantController extends Controller
{
    public function middleware(): array
    {
        return [
            'auth',
            new Middleware('permission', merchants: ['index']),
            new Middleware('permission', merchants: ['create']),
            new Middleware('permission', merchants: ['edit']),
            new Middleware('permission', merchants: ['delete'])
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $access = auth()->user()->access->id;
        $institution_id = auth()->user()->institution_id;

        if($access == '1'){
            $merchants = Merchant::latest()
            ->where('disable','no')->when(request()->q, function($merchants) {
                $merchants = $merchants->where('merchant_name', 'like', '%'. request()->q . '%');
            })->paginate(10);
    
            $users = User::where('disable','no')->where('institution_id', $institution_id)->get();
    
            return view('admin.merchant.index', compact('merchants','users'));

        }else{

            $merchants = Merchant::latest()
            ->where('institution_id', $institution_id)
            ->where('disable','no')->when(request()->q, function($merchants) {
                $merchants = $merchants->where('merchant_name', 'like', '%'. request()->q . '%');
            })->paginate(10);
    
            $users = User::where('disable','no')->where('institution_id', $institution_id)->get();
    
            return view('admin.merchant.index', compact('merchants','users'));


        }

       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
      
        $request->validate([
            'image'             => 'image|mimes:jpeg,jpg,png|max:2000',
            'user_id'           => 'required',
            'merchant_name'     => 'required',
            'no_ktp'            => 'required',
            'description'       => 'required',
           
        ]); 

        $user = User::where('id',$request->user_id)->first();

        $merchant = Merchant::where('user_id', $user->id)->first();
       
        //cek apakah degree_name sudah ada di tabel degree jika tidak maka tidak akan di input
        if ($merchant == null)
        {
            //upload image
            $image = $request->file('image');
            $image->storeAs('merchants', $image->hashName());

            $merchant = Merchant::updateOrCreate([
                'banner'            => $image->hashName(),
                'institution_id'    => $user->institution_id,
                'user_id'           => $request->input('user_id'),
                'merchant_name'     => $request->input('merchant_name'),
                'no_ktp'            => $request->input('no_ktp'),
                'description'       => $request->input('description'),  
                'status'            => 'active',
                'disable'           => 'no'
            ]);

            if($merchant){
                //redirect dengan pesan sukses
                return redirect()->route('admin.merchant.index')->with(['success' => 'Data Berhasil Disimpan!']);
            }else{
                //redirect dengan pesan error
                return redirect()->route('admin.merchant.index')->with(['error' => 'Data Gagal Disimpan!']);
            }

        }
        else{
                return redirect()->route('admin.merchant.index')->with(['error' => 'Merchant Alredy Exist!']);
        }

        
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Merchant $merchant)
    {
        $institution_id = auth()->user()->institution_id;

        $users = User::latest()->where('institution_id', $institution_id)->get();
        return view('admin.merchant.edit', compact('merchant','users'));

       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Merchant $merchant)
    {
       
        $request->validate([
            'merchant_name'     => 'required',
            'no_ktp'            => 'required',
            'description'       => 'required',
        ]); 

        $image = $request->file('image');

        $merchant = Merchant::where('id',$merchant->id)->first();

        //jika tidak upload gambar
        if($image == ''){
          
                $merchant->update([
                    'merchant_name'     => $request->input('merchant_name'),
                    'no_ktp'            => $request->input('no_ktp'),
                    'description'       => $request->input('description'),    
                    'status'            => $request->input('status'),     
                ]);    

        }else{
            //hapus image lama

            Storage::disk('public')->delete('merchants/'.basename($merchant->banner));
             
            $image->storeAs('merchants', $image->hashName());
            
                $merchant->update([
                'banner'            => $image->hashName(),
                'merchant_name'     => $request->input('merchant_name'),
                'no_ktp'            => $request->input('no_ktp'),
                'description'       => $request->input('description'),  
                'status'            => $request->input('status'),     
                ]);
        }

      
        if($merchant){
            //redirect dengan pesan sukses
            return redirect()->route('admin.merchant.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.merchant.index')->with(['error' => 'Data Gagal Diupdate!']);
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

        $merchant = Merchant::where('id',$id)->first();

        Storage::disk('public')->delete('merchants/'.basename($merchant->banner));
        
        //dd($merchant);
        $merchant->update([
            'disable'      => 'yes'
        ]);

        if($merchant){
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
