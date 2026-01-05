<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;


class PermissionController extends Controller
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
        new Middleware('log', only: ['index'])
    ];
}



    /**
     * function index
     *
     * @return void
     */
    public function index()
    {
        $permissions = Permission::latest()->when(request()->q, function($permissions) {
            $permissions = $permissions->where('name', 'like', '%'. request()->q . '%');
        })->paginate(20);

        return view('admin.permission.index', compact('permissions'));
    }

    //isert new permission
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'guard_name'    => 'required'
        ]);

        $permission = Permission::create([
            'name'          => $request->name,
            'guard_name'    => $request->guard_name,
        ]);

        if($permission)
        {
            return redirect()->route('admin.permission.index')->with(['Success' => 'Data berhasil disimpan.']);
        }else{
            return redirect()->route('admin.permission.index')->with(['Error' => 'Data gagal disimpan']);
        }
    }

    //edit permission
    public function edit($id)
    {
        $permission = Permission::where('id', $id)->first();

        return view('admin.permission.edit', compact('permission'));

    }

    //updare permission
    public function update(Request $request, Permission $permission)
    //public function update(Request $request, Degree $degree)
    {
        $request->validate([
            'name'          => 'required',
            'guard_name'    => 'required'
        ]);

        //$permission = Permission::findOrFail($id);
        $permission = Permission::where('id',$permission->id)->first();

        //dd($permission);

        $permission->update([
            'name'          => $request->name,
            'guard_name'    => $request->guard_name,
        ]);

        if($permission){
            //redirect dengan pesan sukses
            return redirect()->route('admin.permission.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.permission.index')->with(['error' => 'Data Gagal Diupdate!']);
        }

    }

    //delete permission
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);

        $permission->delete();

        if($permission)
        {
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
