<?php
namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
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
            new Middleware('permission', sliders: ['index']),
            new Middleware('permission', sliders: ['create']),
            new Middleware('permission', sliders: ['edit']),
            new Middleware('permission', sliders: ['delete'])
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::latest()->when(request()->q, function($sliders) {
            $sliders = $sliders->where('title', 'like', '%'. request()->q . '%');
        })->paginate(10);

        return view('admin.slider.index', compact('sliders'));
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
           
            'image'     => 'required|image',
            'title'       => 'required',
        ]); 

        //upload image
        $image = $request->file('image');
        $image->storeAs('sliders', $image->hashName());

        $slider = Slider::create([
            'image'     => $image->hashName(),
            'title'     => $request->title,
            'link'      => $request->link,

        ]);

        if($slider){
            //redirect dengan pesan sukses
            return redirect()->route('admin.slider.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.slider.index')->with(['error' => 'Data Gagal Disimpan!']);
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
        $slider = Slider::findOrFail($id);
        $image = Storage::disk('local')->delete('public/sliders/'.$slider->image);
        $slider->delete();

        if($slider){
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
