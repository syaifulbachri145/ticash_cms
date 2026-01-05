@extends ('layouts.app', ['title' => 'Video'])

@section('content')

        @include('navbar.media')

         
        <div id="main-content" class="w-full flex-1">

            <div class="flex flex-1 flex-wrap">

                <div class="w-full xl:w-2/3 p-6 xl:max-w-6xl">

                    <!--"Container" for the graphs"-->
                    <div class="max-w-full lg:max-w-3xl xl:max-w-5xl">

                              <!-- Main Index -->
                    <div id="main-content" class="w-full flex-1">

                        <div class="flex flex-1 flex-wrap">

                            <div class="w-full p-3">

                                <!--"Container" for the graphs"-->
                                <div class="max-w-full lg:max-w-3xl xl:max-w-5xl">

                                    <!--Table Card-->
                                    <div class="p-3">
                                        <div class="p-4">
                                            <h5 class="font-bold text-gray-400"> <i class="	fas fa-film fa-fw mr-3"></i>Videos</h5>
                                        </div>
                                        
                                        <div class="flex">
                                           
                                            <div class="relative pull-right pl-4 pr-8 md:pr-20">
                                                <form action="{{ route('admin.video.index') }}" method="GET">
                                                <input type="search" name="q" value="{{ request()->query('q') }}" placeholder="Search" class="w-full bg-white-700 text-sm text-gray-800 transition border focus:outline-none focus:border-gray-700 rounded py-1 px-7 pl-20 appearance-none leading-normal">
                                                </form>
                                                <div class="absolute search-icon" style="top: 0.375rem;left: 1.75rem;">
                                                    <svg class="fill-current pointer-events-none text-gray-800 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                        <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path>
                                                    </svg>
                                                </div>
                                            </div>                              
                                        </div>

                                    </div>
                                    <!--/table Card-->

                                </div>

                            </div>
                    
                        <!--Divider-->
                        <hr class="border-b-2 border-gray-400 my-2 mx-2">

                        <div class="flex flex-row flex-wrap flex-grow mt-2">              
                            
                            <div class="w-full p-3">
                                <!--Table Card-->
                                <div class="bg-white border rounded shadow">
                                    <div class="border-b p-3">
                                        <h5 class="font-bold text-gray-700 text-sm">Table Photo</h5>
                                    </div>
                                    <div class="p-5">
                                        <table class="w-full p-5 text-gray-700 text-sm">
                                            <thead class="bg-gray-200">
                                                <tr>
                                                    <th class="text-left text-gray-700 text-sm p-1">No</th>
                                                    <th class="text-left text-gray-700 text-sm p-1">Title</th>
                                                    <th class="text-left text-gray-700 text-sm p-1">Video</th>                                    
                                                    <th class="text-center text-gray-700 text-sm p-1">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody class="bg-gray-200">
                                            @forelse($videos as $no => $video)
                                            <tr class="border bg-white">
                                                <th scope="row" class=" text-left p-1">{{ ++$no + ($videos->currentPage()-1) * $videos->perPage() }}</th>
                                                <td class=" text-left p-1">{{ $video->title }}</td>
                                                <td class=" text-left p-1"> <iframe width="300" height="150" src="{{ $video->embed }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></td> 
                                                <td class="px-5 py-1 text-center">
                                                   
                                                    @can('videos.delete')
                                                    <button onClick="destroy(this.id)" id="{{ $video->id }}" class="bg-yellow-500 px-2 py-1 rounded shadow-sm text-xs text-white focus:outline-none fas fa-trash-alt"></button>
                                                    @endcan
                                                </td>
                                            </tr>
                                            @empty
                                                <div class="bg-yellow-600 text-white text-center p-3 rounded-sm shadow-md">
                                                    Data Belum Tersedia!
                                                </div>
                                            @endforelse
                                            
                                            </tbody>
                                        </table>
                                        @if ($videos->hasPages())
                                            <div class="bg-white p-3">
                                                {{ $videos->links('pagination::tailwind') }}
                                            </div>
                                        @endif                         

                                    </div>
                                </div>
                                <!--/table Card-->
                            </div>
                        </div>

                        </div>

                        </div> 



                    </div>

                </div>

                <div class="w-full xl:w-1/3 p-6 xl:max-w-4xl border-l-1 border-gray-300">

                    <!--"Container" for the graphs"-->
                    <div class="max-w-sm lg:max-w-3xl xl:max-w-5xl">

                        <!--Graph Card-->

                        <div class="border-b p-3">
                            <h5 class="font-bold text-gray-600">Add New Video</h5>
                        </div>
                        <div class="p-3">
                           
                            <div class="bg-white border rounded shadow">
                            <div class="p-1">
                        <form class="space-y-6 px-6 lg:px-8 pb-4 sm:pb-6 xl:pb-8" action="{{ route('admin.video.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf                            
                                                          
                                <div>
                                    <label for="title" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Video Title</label>
                                    <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Video Title" required="">
                                    @error('title')
                                        <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                            <div class="px-4 py-2">
                                                <p class="text-gray-600 text-sm">{{ $message }}</p>
                                            </div>
                                        </div>
                                    @enderror
                                </div>

                                <div>
                                    <label for="embed" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Embed Youtube</label>
                        
                                    <input type="text" name="embed" id="embed" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Emmbed From Youtube" required="">
                                    @error('embed')
                                        <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                            <div class="px-4 py-2">
                                                <p class="text-gray-600 text-sm">{{ $message }}</p>
                                            </div>
                                        </div>
                                    @enderror                     
                                </div>                                                                                                                     
                              
                            
                            <div class="grid gap-1 grid-cols-2 grid-rows-1">                               
                               <div class="mr-2">
                                <button type="resset" class="w-full text-white bg-gray-600 hover:bg-yellow-500 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-500 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                    <i class="fas fa-redo mr-2"></i>Resset</button>
                               </div>
                               <div>
                                <button type="submit" class="w-full text-white bg-yellow-600 hover:bg-yellow-500 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-500 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                    <i class="fas fa-save mr-2"></i>Save</button>
                               </div>
                            </div>
                        </form>                       

                        </div>
                            </div>                        
                                                   
                        </div>

                        <!--/Graph Card-->

                                            
                    </div>

                </div>

                   


            </div>

        </div>



    </div>


    <script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>

    <script>
    //ajax crud
    
        $(document).ready(function () {

        get_tag_data()

        $.ajaxSetup({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });

          

        }); 

       

    //ajax delete odt
    function destroy(id) {
        var id = id;
        var token = $("meta[name='csrf-token']").attr("content");

        Swal.fire({
            title: 'Are You Sure?',
            text: "Do you really want to delete",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancel',
            confirmButtonText: 'Yes, Delete!',
        }).then((result) => {
            if (result.isConfirmed) {
                //ajax delete
                jQuery.ajax({
                    url: `/admin/video/${id}`,
                    data: {
                        "id": id,
                        "_token": token
                    },
                    type: 'DELETE',
                    success: function (response) {
                        if (response.status == "success") {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Data has been deleted.!',
                                showConfirmButton: false,
                                timer: 3000
                            }).then(function () {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed.!',
                                text: 'Data failed to delete.!',
                                showConfirmButton: false,
                                timer: 3000
                            }).then(function () {
                                location.reload();
                            });
                        }
                    }
                });
            }
        })
    }
</script>

@endsection