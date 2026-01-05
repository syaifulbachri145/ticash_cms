<?php

namespace App\Http\Controllers\Api\Account;

use App\Models\User;
use App\Models\Student;
use App\Models\Degree;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
         //degrees
    public function degrees()
    {
        $degrees = Degree::where('institution_id',auth()->guard('api')->user()->institution_id)->first();
        //return with response JSON
        return response()->json([
            'success' => true,
            'message' => 'Data Degree',
            'data'    => $degrees,
        ], 200);
    }

    //student
        public function student()
    {
        $student = Student::where('user_id',auth()->guard('api')->user()->id)->first();
        //return with response JSON
        return response()->json([
            'success' => true,
            'message' => 'Data Student',
            'data'    => $student,
        ], 200);
    }

    //update/insert data student
    public function StudentRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'degree_id'     => 'required',
            'nim'           => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //get data profile
       // $user = User::whereId(auth()->guard('api')->user()->id)->first();

        //get data student
        $degree = Degree::where('id', $request->degree_id)->first();
        $user = User::whereId(auth()->guard('api')->user()->id)->first();
       // dd($degree->major);

        $student = Student::updateOrCreate([
                'institution_id' => auth()->guard('api')->user()->institution_id,
                'user_id'        => auth()->guard('api')->user()->id,
                'degree_id'      => $request->input('degree_id'),
                'nim'            => $request->input('nim'),
                'major'          => $degree->degree_name,
                'graduation'     => $user->graduation,
                'status'         => 'active',
                'disable'        => 'no',
               
            ]);

            $user->update([
                'nim'  => $request->nim,
                'degree_id' => $request->degree_id,
                'access_id' => '5'
            ]);

              //return with response JSON
              return response()->json([
                'success' => true,
                'message' => 'Data Student Berhasil Dibuat!',
                'data'    => $student,
            ], 201);

    }
}
