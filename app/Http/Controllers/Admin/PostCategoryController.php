<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostCategoryController extends Controller
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
            new Middleware('permission', posts: ['index']),
            new Middleware('permission', posts: ['create']),
            new Middleware('permission', posts: ['edit']),
            new Middleware('permission', posts: ['delete'])
        ];
    }

    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = PostCategory::latest()->when(request()->q, function($categories) {
            $categories = $categories->where('name', 'like', '%'. request()->q . '%');
        })->paginate(10);

        return view('admin.postCategory.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:post_categories',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2000',
        ]);

        //dd($request);

        $image = $request->file('image');

        $image->storeAs('public/post_categories', $image->hashName());

        $category = PostCategory::create([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name'), '-'),
            'image'  => $image->hashName(),
        ]);

        if($category){
            //redirect dengan pesan sukses
            return redirect()->route('admin.postCategory.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.postCategory.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PostCategory $postCategory)
    {
        //dd($postCategory);
        return view('admin.postCategory.edit', compact('postCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostCategory $postCategory)
    {
        $this->validate($request, [
            'name' => 'required|unique:post_categories,name,'.$postCategory->id
        ]);

        $postCategory = PostCategory::where('id',$postCategory->id)->first();

        $image = $request->file('image');


        if($image== '')
        {
            $postCategory->update([
                'name' => $request->input('name'),
                'slug' => Str::slug($request->input('name'), '-')
            ]);
        }else{
            Storage::disk('local')->delete('public/post_categories/'.$postCategory->image);
            //insert new image
            $image->storeAs('public/post_categories', $image->hashName());
            $postCategory->update([
                'name'     => $request->name,
                'image'     => $image->hashName(),
                'slug'   => Str::slug($request->input('name'), '-')
            ]);

        }

        if($postCategory){
            //redirect dengan pesan sukses
            return redirect()->route('admin.postCategory.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.postCategory.index')->with(['error' => 'Data Gagal Diupdate!']);
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
        $postCategory = PostCategory::where('id',$id)->first();
        Storage::disk('local')->delete('public/post_categories/'.$postCategory->image);
        $postCategory->delete();

        if($postCategory){
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
