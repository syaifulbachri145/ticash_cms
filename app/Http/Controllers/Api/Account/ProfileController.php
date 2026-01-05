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


class ProfileController extends Controller
{
    //profile user
    public function user()
    {
        $degrees = Degree::where('institution_id',auth()->guard('api')->user()->institution_id)->get();


        //return with response JSON
        return response()->json([
            'success' => true,
            'message' => 'Data Profile',
            'data'    => auth()->guard('api')->user(),
            'degrees'  => $degrees,
        ], 200);
    }

    // update profile
    public function updateProfile(Request $request)
    {
        
         $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'phone'         => 'required',
            //'pin_number'    => 'required',
            //'dob'           => 'required',
            'graduation' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //get data profile
        $user = User::whereId(auth()->guard('api')->user()->id)->first();
       // $student = Student::where('user_id',auth()->guard('api')->user()->id)->first();
        //update with upload image
        if($request->file('avatar')) {

            //hapus image lama
            Storage::disk('public')->delete('users/'.basename($user->avatar));

            //upload image baru
            $image = $request->file('avatar');
            $image->storeAs('users', $image->hashName(), 'public');

            
            $user->update([
                'name'                => $request->name,
                'avatar'              => $image->hashName(),
                'dob'                 => $request->dob,
                'phone'               => $request->phone,
                'pin_number'          => $request->pin_number,
                'is_limit'            => $request->is_limit,
                'limitation'          => $request->limitation,
                'graduation'          => $request->graduation,
                            
            ]);

        //    $student->update([
         //       'graduation'     => $user->graduation,        
          //  ]);

        }

        //update without image
            $user->update([
                'name'                => $request->name,
                'dob'                 => $request->dob,
                'phone'               => $request->phone,
                'pin_number'          => $request->pin_number,
                'is_limit'            => $request->is_limit,
                'limitation'          => $request->limitation,
                'graduation'          => $request->graduation,                            
            ]);
           //  $student->update([
           //     'graduation'     => $user->graduation,        
            //]);

            //return with response JSON
            return response()->json([
                'success' => true,
                'message' => 'Data Profile Berhasil Diupdate!',
                'data'    => $user,
            ], 201);

    }

    /**
     * updatePassword
     *
     * @param  mixed $request
     * @return void
     */
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::whereId(auth()->guard('api')->user()->id)->first();
        $user->update([
            'password'  => Hash::make($request->password)
        ]);


        //return with response JSON
        return response()->json([
            'success' => true,
            'message' => 'Password Berhasil Diupdate!',
            'data'    => $user,
        ], 201);
    }

        //update Bank
    public function updateBank(Request $request)
    {
        
        //get data profile
        $user = User::whereId(auth()->guard('api')->user()->id)->first();
       
            $user->update([
                'bank_transfer'  => $request->bank_transfer,
                'account_number' => $request->account_number,
                'account_name'   => $request->account_name,
            ]);

            //return with response JSON
            return response()->json([
                'success' => true,
                'message' => 'Data Profile Berhasil Diupdate!',
                'data'    => $user,
            ], 201);

    }

   
   




    
}
