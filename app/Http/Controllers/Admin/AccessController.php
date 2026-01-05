<?php

namespace App\Http\Controllers\Admin;
use App\Models\Access;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccessController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:accesses.index|accesses.create|accesses.edit|accesses.delete']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accesses = Access::latest()
        ->where('disable','no')
        ->when(request()->q, function($accesses) {
            $accesses = $accesses->where('access_name', 'like', '%'. request()->q . '%');
        })->paginate(10);

        return view('admin.access.index', compact('accesses'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'access_name' => 'required|unique:accesses'
        ]);

        $access = Access::create([
            'access_name'           => $request->input('access_name'),
            'status'                => 'active',
            'disable'               => 'no'
        ]);

        if($access){
            //redirect dengan pesan sukses
            return redirect()->route('admin.access.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.access.index')->with(['error' => 'Data Gagal Disimpan!']);
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Access $access)
    {

        $accesses = Access::latest()
        ->where('disable','no')
        ->when(request()->q, function($accesses) {
            $accesses = $accesses->where('access_name', 'like', '%'. request()->q . '%');
        })->paginate(10);

        //dd($tag);
        return view('admin.access.edit', compact('access','accesses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, Tag $tag)
    public function update(Request $request, Access $access)
    {
        $this->validate($request, [
            'access_name' => 'required|unique:accesses,access_name,'.$access->id
        ]);

        $access = Access::findOrFail($access->id);
        $access->update([
            'access_name' => $request->input('access_name'),
        ]);

        if($access){
            //redirect dengan pesan sukses
            return redirect()->route('admin.access.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.access.index')->with(['error' => 'Data Gagal Diupdate!']);
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
        $access = Access::findOrFail($id);

        $access->update([
            'disable' =>'yes',
        ]);

        if($access){
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
