<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Degree;
use App\Models\User;
use Spatie\Permission\Models\Role;

class DegreeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function middleware(): array
     {
         return [
             'auth',
             new Middleware('permission', degrees: ['index']),
             new Middleware('permission', degrees: ['create']),
             new Middleware('permission', degrees: ['edit']),
             new Middleware('permission', degrees: ['delete'])
         ];
     }

    public function index()
    {
        $access = auth()->user()->access->id;
        $institution_id = auth()->user()->institution_id;

        if($access == '1'){

            $degrees = Degree::latest()->where('disable','no')->when(request()->q, function($degrees) {
                $degrees = $degrees->where('degree_name', 'like', '%'. request()->q . '%');
            })->paginate(10);
    
            return view('admin.degree.index', compact('degrees'));

        }else{

            $degrees = Degree::latest()->where('institution_id', $institution_id)->where('disable','no')->when(request()->q, function($degrees) {
                $degrees = $degrees->where('degree_name', 'like', '%'. request()->q . '%');
            })->paginate(10);
    
            return view('admin.degree.index', compact('degrees'));

        }
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.degree.create');
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
            'degree_name' => 'required',
        ]);

        //dd($request->input('degree_name'));

        $user = User::where('id', auth()->user()->id)->first();

        $degree = Degree::where('degree_name', $request->degree_name)
        ->where('institution_id', $user->institution_id)->first();

       
        //cek apakah degree_name sudah ada di tabel degree jika tidak maka tidak akan di input
        if ($degree == null)
      
        {
            $degree = Degree::create([
                'institution_id'    => $user->institution_id,
                'degree_name'        => $request->input('degree_name'),
                'status'                => 'active',
                'disable'               => 'no'
            ]);
    
            if($degree){
                //redirect dengan pesan sukses
                return redirect()->route('admin.degree.index')->with(['success' => 'Data Berhasil Disimpan!']);
            }else{
                //redirect dengan pesan error
                return redirect()->route('admin.degree.index')->with(['error' => 'Data Gagal Disimpan!']);
            }
           
        }
        else{

           // dd($request->degree_name);
            return redirect()->back()->with('failed', 'Class alredy axist');

            
        
        }
        
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Degree $degree)
    {

       


        //dd($degree);
        return view('admin.degree.edit', compact('degree'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Degree $degree)
    {
        $request->validate([
            'degree_name' => 'required|unique:degrees,degree_name,'.$degree->id
        ]);

        $degree = Degree::where('id',$degree->id)->first();

        $degree->update([
            'degree_name'     => $request->degree_name,
            'status'     => $request->status,
        ]);

        
        if($degree){
            //redirect dengan pesan sukses
            return redirect()->route('admin.degree.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.degree.index')->with(['error' => 'Data Gagal Diupdate!']);
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
        $degree = degree::where('id',$id)->first();
     
        $degree->update([
            'disable' => 'yes'
            //'degree_name' => 'TI Semester 4'
        ]);

        if($degree){
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
