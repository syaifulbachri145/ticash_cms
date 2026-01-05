<?php

namespace App\Http\Controllers\Api\Account;

use App\Models\User;
use App\Models\Institution;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
     /**
     * __construct
     *
     * @return void
     */
   

    /**
     * register
     *
     * @param  mixed $request
     * @return void
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'              => 'required|string|max:255',
            'email'             => 'required|email|unique:users',
            'password'          => 'required|confirmed',
            'phone'             => 'required|unique:users',
            //'va_number'         => 'required|unique:users',
            'institution_code'  => 'required',
            'pin_number'          => 'required',
            'graduation'        => 'required',
           
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $institution = Institution::where('institution_code', $request->institution_code)->first();

        //dd($institution);

        if($institution){

            //va number
          $random       =   rand(1000,9999);

               
            $va_number = '112025'.$random;

           // dd($no_va);

            $user = User::create([
                'institution_id'=> $institution->id,
                'access_id'     => '4',
                'name'          => $request->name,
                'email'         => $request->email,
                'password'      => Hash::make($request->password),
                'phone'         => $request->phone,
                'balance'       => '0',
                'va_number'     => $va_number,
                'pin_number'    => $request->pin_number,
                'status'        => 'active',
                'is_limit'      => 'no',
                'limitation'    => '0',
                'graduation'    => $request->graduation,
                'disable'       => 'no',
                'status'        => 'active'
                
            ]);
    
            $token = JWTAuth::fromUser($user);
    
            if($user) {
                return response()->json([
                    'success' => true,
                    'user'    => $user,
                    'token'   => $token
                ], 201);
            }
    
            return response()->json([
                'success' => false,
            ], 409);

        }else{

            return response()->json([
                'success' => false,
                'message' => 'Institusi blm terdaftar',
                //$this->response
            ]);

           // return response()->json($validator->errors(), 400);
        }
        
    }

    /**
     * login
     *
     * @param  mixed $request
     * @return void
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $credentials = $request->only('email', 'password');

        if(!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Email or Password is incorrect'
            ], 401);
        }
        return response()->json([
            'success' => true,
            'user'    => auth()->guard('api')->user(),  
            'token'   => $token   
        ], 201);
    }

    /**
     * getUser
     *
     * @return void
     */
    public function getUser()
    {
        return response()->json([
            'success' => true,
            'user'    => auth()->user()
        ], 200);
    }
}

