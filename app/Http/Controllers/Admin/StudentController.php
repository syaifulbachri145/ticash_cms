<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use App\Models\Degree;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function middleware(): array
    {
        return [
            'auth',
            new Middleware('permission', students: ['index']),
            new Middleware('permission', students: ['create']),
            new Middleware('permission', students: ['edit']),
            new Middleware('permission', students: ['delete'])
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $access = auth()->user()->access->id;
        $institution_id = auth()->user()->institution_id;

        if($access == '1')
        {
            $students = Student::latest()->where('disable','no')->when(request()->q, function($students) {
                $students = $students->where('nim', 'like', '%'. request()->q . '%');
            })->paginate(10);
            $users= User::where('disable','no')->get();
            $degrees= Degree::where('disable','no')->get();
            return view('admin.student.index', compact('students','users','degrees'));

        }else{

            $students = Student::latest()->where('institution_id', $institution_id)
            ->where('disable','no')
            ->when(request()->q, function($students) {
                $students = $students->where('nim', 'like', '%'. request()->q . '%');
            })->paginate(10);
            $users= User::where('disable','no')->where('institution_id', $institution_id)->get();
            $degrees= Degree::where('disable','no')->where('institution_id', $institution_id)->get();
            return view('admin.student.index', compact('students','users','degrees'));
        }

        
        
    }

    public function store(Request $request)
    {
      
        $request->validate([
            'nim'               => 'required',
            'major'             => 'required',
            'graduation'        => 'required',
            'degree_id'         => 'required',
            'user_id'           => 'required',
        ]); 

        $user = User::where('id', $request->user_id)->first();

        $student = Student::where('user_id', $user->id)->first();

       
        //cek apakah degree_name sudah ada di tabel degree jika tidak maka tidak akan di input
        if ($student == null)
        {
            //dd($request->user_id);
            $student = student::updateOrCreate([
                'user_id'           => $request->user_id,
                'institution_id'    => $user->institution_id,
                'degree_id'         => $request->degree_id,
                'nim'               => $request->input('nim'),
                'major'             => $request->input('major'),
                'graduation'        => $request->input('graduation'),
                'status'            => 'active',
                'disable'                   => 'no'
                
            ]);
    
            if($student){
                //redirect dengan pesan sukses
                return redirect()->route('admin.student.index')->with(['success' => 'Data Berhasil Disimpan!']);
            }else{
                //redirect dengan pesan error
                return redirect()->route('admin.student.index')->with(['error' => 'Data Gagal Disimpan!']);
            }
        }else{
                return redirect()->route('admin.student.index')->with(['success' => 'User Alredy Exist!']);
        }

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $institution_id = auth()->user()->institution_id;

        $users= User::where('disable','no')->where('institution_id', $institution_id)->get();
        $degrees= Degree::where('disable','no')->where('institution_id', $institution_id)->get();

        return view('admin.student.edit', compact('student','users','degrees'));

       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, student $student)
    {
       
        $request->validate([
            'nim'               => 'required',
            'major'             => 'required',
            'graduation'        => 'required',
            'degree_id'         => 'required',
            'user_id'           => 'required',
        ]); 

        $user = User::where('id', $request->user_id)->first();
        $student = student::where('id',$student->id)->first();

        $student->update([
            'user_id'           => $request->user_id,
            'institution_id'    => $user->institution_id,
            'degree_id'         => $request->degree_id,
            'nim'               => $request->input('nim'),
            'major'             => $request->input('major'),
            'graduation'        => $request->input('graduation'),    
            'status'            => $request->status,    
        ]);    
      
        if($student){
            //redirect dengan pesan sukses
            return redirect()->route('admin.student.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.student.index')->with(['error' => 'Data Gagal Diupdate!']);
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
        $student = Student::findOrFail($id);
       
        //dd($student);
        $student->update([
            'disable'      => 'yes'
        ]);

        //$student->delete();


        if($student){
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
