<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Access;
use App\Models\User;
use App\Models\Degree;
use App\Models\Institution;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use Validator;
//use Redirect,Response;

class UserController extends Controller
{
    /**
     * __construct
     *
     * @return void
     */
    public function middleware(): array
    {
        return [
            'auth',
            new Middleware('permission', users: ['index']),
            new Middleware('permission', users: ['create']),
            new Middleware('permission', users: ['edit']),
            new Middleware('permission', users: ['delete'])
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $access = auth()->user()->access->id;
        $institution_id = auth()->user()->institution_id;

        

        //dd($request->q);

        if($access == '1'){

            $users = User::latest()->where('disable','no')->when(request()->q, function($users) {
                $users = $users->where('name', 'like', '%'. request()->q . '%');
            })->paginate(10);

           // dd($users);
    
            $roles = Role::latest()->get();
            $accesses = Access::latest()->get();
            $institutions = Institution::where('disable','no')->get();
            
    
            return view('admin.user.index', compact('users','roles','accesses','institutions'));

        }else{

            $users = User::latest()->where('institution_id', $institution_id)           
            ->where('disable','no')->when(request()->q, function($users) {
                $users = $users->where('name', 'like', '%'. request()->q . '%');
            })->paginate(10);
    
            $roles = Role::latest()->get();
            $accesses = Access::latest()->get();
            $institutions = Institution::where('id', $institution_id)           
            ->where('disable','no')->get();

           
    
            return view('admin.user.index', compact('users','roles','accesses','institutions'));
        }

        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::latest()->get();
        $access = auth()->user()->access->id;
        $institution_id = auth()->user()->institution_id;

        if($access == '1'){
            $institutions = Institution::latest()->get();
        }else{
            $institutions = Institution::where('id', $institution_id)           
            ->where('disable','no')->get();
        }


        //dd($institutions);
        return view('admin.user.create', compact('roles','institutions'));
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
            'image'             => 'image|mimes:jpeg,jpg,png|max:2000',
            'name'              => 'required',
            'email'             => 'required|unique:users,email',
            'password'          => 'required|confirmed',
            'phone'             => 'required|unique:users',
            'address'           => 'required',
            'access_id'         => 'required',
            'institution_id'    => 'required',
            'va_number'         => 'required|unique:users,va_number',
            'card_number'       => 'required|unique:users,card_number',
            'pin_number'        => 'required',
        ]); 

        //dd($request);

        
        //upload image
        $image = $request->file('image');
        //dd($image);
        $image->storeAs('users', $image->hashName());

        //dd ($request) ;

        $user = User::updateOrCreate([
            'name'          => $request->input('name'),
            'email'         => $request->input('email'),
            'password'      => bcrypt($request->input('password')),
            'avatar'        => $image->hashName(),
            'phone'         => $request->input('phone'),
            'address'       => $request->input('address'),
            'dob'           => $request->input('dob'),
            'access_id'     => $request->input('access_id'),
            'institution_id'=> $request->input('institution_id'),
            'va_number'     => $request->input('va_number'),
            'card_number'   => $request->input('card_number'),
            'pin_number'    => $request->input('pin_number'),
            'is_limit'      => 'no',
            'limitation'    => '0',
            'balance'       => '0',
            'status'        => 'active',
            'disable'       => 'no'     
              
        ]);

        //assign role
        $user->assignRole($request->input('role'));

        if($user){
            //redirect dengan pesan sukses
            return redirect()->route('admin.user.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.user.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $accesses = Access::latest()->get();
        $degrees = Degree::where('institution_id', $user->institution_id)->get();
         $institutions = Institution::where('disable','no')->get();
        $roles = Role::latest()->get();

        
       
        //dd($degrees);
        return view('admin.user.edit', compact('user', 'roles','accesses','degrees','institutions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
                     
            'va_number'        => 'required|unique:users,va_number,'.$user->id,
        ]); 

        $role = $request->input('role');

       // dd($role);

        $image = $request->file('image');

        $user = User::where('id',$user->id)->first();

        //jika tidak upload gambar
        if($image == ''){
            if($request->input('password') == "") {
                $user->update([
                    'name'          => $request->input('name'),
                    'nim'           => $request->input('nim'),
                    'degree_id'     => $request->input('degree_id'),
                    'institution_id'=> $request->input('institution_id'),
                    'phone'         => $request->input('phone'),
                    'address'       => $request->input('address'),
                    'dob'           => $request->input('dob'),
                    'access_id'     => $request->input('access_id'),
                    'va_number'     => $request->input('va_number'),
                    'status'        => $request->status,  
                    'card_number'   => $request->input('card_number'),
                    'pin_number'    => $request->input('pin_number'),
                    'is_limit'      => $request->input('is_limit'),
                    'limitation'    => $request->input('limitation'),
                ]);
            } else {
                $user->update([
                    'name'          => $request->input('name'),
                    'nim'           => $request->input('nim'),
                    'degree_id'     => $request->input('degree_id'),
                    'institution_id'=> $request->input('institution_id'),
                    'password'      => bcrypt($request->input('password')),
                    'access_id'     => $request->input('access_id'),
                    'phone'         => $request->input('phone'),
                    'address'       => $request->input('address'),
                    'dob'           => $request->input('dob'),
                    'va_number'     => $request->input('va_number'),
                    'status'        => $request->status,   
                    'card_number'   => $request->input('card_number'),
                    'pin_number'    => $request->input('pin_number'),
                    'is_limit'      => $request->input('is_limit'),
                    'limitation'    => $request->input('limitation'),
                ]);
            }

        }else{
            //hapus image lama
            Storage::disk('public')->delete('users/'.basename($user->avatar));
            //dd($image);
            $image->storeAs('users', $image->hashName());
         
            if($request->input('password') == "") {
                
                $user->update([
                    'name'          => $request->input('name'),
                    'nim'           => $request->input('nim'),
                    'degree_id'     => $request->input('degree_id'),
                    'institution_id'=> $request->input('institution_id'),
                    'avatar'         => $image->hashName(),
                    'phone'         => $request->input('phone'),
                    'address'       => $request->input('address'),
                    'dob'           => $request->input('dob'),
                    'access_id'     => $request->input('access_id'),
                    'va_number'     => $request->input('va_number'),
                    'status'        => $request->status,
                    'card_number'   => $request->input('card_number'),
                    'pin_number'    => $request->input('pin_number'),
                    'is_limit'      => $request->input('is_limit'),
                    'limitation'    => $request->input('limitation'),
                ]);
            } else {
                
                $user->update([
                    'name'          => $request->input('name'),
                    'nim'           => $request->input('nim'),
                    'degree_id'     => $request->input('degree_id'),
                    'institution_id'=> $request->input('institution_id'),
                    'password'      => bcrypt($request->input('password')),
                    'avatar'         => $image->hashName(),
                    'phone'         => $request->input('phone'),
                    'address'       => $request->input('address'),
                    'dob'           => $request->input('dob'),
                    'access_id'     => $request->input('access_id'),
                    'va_number'     => $request->input('va_number'),
                    'status'        => $request->status,
                    'card_number'   => $request->input('card_number'),
                    'pin_number'    => $request->input('pin_number'), 
                    'is_limit'      => $request->input('is_limit'),
                    'limitation'    => $request->input('limitation'),  
                ]);
            }

        }

        //assign role
        $user->syncRoles($request->input('role'));

        if($user){
            //redirect dengan pesan sukses
            return redirect()->route('admin.user.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.user.index')->with(['error' => 'Data Gagal Diupdate!']);
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
        $user = User::where('id',$id)->first();
        Storage::disk('public')->delete('users/'.basename($user->avatar));
     
        $user->update([
            'disable' => 'yes'
        ]);

        if($user){
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
