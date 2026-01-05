@extends ('layouts.app', ['title' => 'Article'])

@section('content')

        @include('navbar.media')

         
        <div id="main-content" class="w-full flex-1">

            <div class="flex flex-1 flex-wrap">

                <div class="w-full xl:w-3/4 p-6 xl:max-w-6xl">

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
                                            <h5 class="font-bold text-gray-400"> <i class="	fas fa-film fa-fw mr-3"></i>Article</h5>
                                        </div>
                                        
                                        <div class="flex">
                                            @can('post-categories.create')
                                            <button class="text-white focus:outline-none bg-gray-600 hover:bg-gray-500 px-2 py-1 shadow-sm rounded-md">
                                            <a href="{{ route('admin.posts.create') }}"><i class="fas fa-file-alt mr-2"></i>Add New Article</a>
                                            </button>
                                            @endcan
                                            <div class="relative pull-right pl-4 pr-8 md:pr-20">
                                                <form action="{{ route('admin.posts.index') }}" method="GET">
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
                                  
                                    <div class="p-5">
                                        <table class="w-full p-5 text-gray-700 text-sm">
                                            <thead class="bg-gray-200">
                                                <tr>
                                                    <th class="text-left text-gray-700 text-sm p-1">No</th>
                                                    <th class="text-left text-gray-700 text-sm p-1">Title</th>
                                                    <th class="text-left text-gray-700 text-sm p-1">Category</th>                                    
                                                    <th class="text-center text-gray-700 text-sm p-1">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody class="bg-gray-200">
                                            @forelse($posts as $no => $post)
                                            <tr class="border bg-white">
                                                <th scope="row" class=" text-left p-1">{{ ++$no + ($posts->currentPage()-1) * $posts->perPage() }}</th>
                                                <td class=" text-left p-1">{{ $post->title }}</td>
                                                <td class=" text-left p-1">{{ $post->category->name }}</td>
                                                <td class="px-5 py-1 text-center">
                                                    @can('posts.edit')
                                                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="bg-gray-500 px-2 py-0.5 rounded shadow-sm text-xs text-white focus:outline-none"> 
                                                    <i class="fas fa-edit text-center"></i></a>
                                                    @endcan
                                                    @can('posts.delete')
                                                    <button onClick="destroy(this.id)" id="{{ $post->id }}" class="bg-yellow-500 px-2 py-1 rounded shadow-sm text-xs text-white focus:outline-none fas fa-trash-alt"></button>
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
                                        @if ($posts->hasPages())
                                            <div class="bg-white p-3">
                                                {{ $posts->links('pagination::tailwind') }}
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

                <div class="w-full xl:w-1/4 p-6 xl:max-w-4xl border-l-1 border-gray-300">

                    <!--"Container" for the graphs"-->
                    <div class="max-w-sm lg:max-w-3xl xl:max-w-5xl">

                        <!--Graph Card-->

                        <div class="border-b p-3">
                            <h5 class="font-bold text-gray-600">List Menu</h5>
                        </div>
                        <div class="p-5">

                            
                            <div class="border-b mt-4">
                                @can('posts.index')
                                <a class="w-full text-gray-600 font-medium rounded-sm text-sm px-5 py-2.5 text-left dark:bg-gray-500" 
                                href="{{ route('admin.posts.index') }}"><i class="fas fa-file-alt mr-4"></i>Article</a>
                                @endcan
                            </div>

                            <div class="border-b mt-4">
                               
                                <a class="w-full text-gray-600 font-medium rounded-sm text-sm px-5 py-2.5 text-left dark:bg-gray-500" 
                                href="{{ route('admin.postCategory.index') }}"><i class="fas fa-file-alt mr-4"></i>Category</a>
                               
                            </div>

                            <div class="border-b mt-4">
                                @can('tags.index')
                                <a class="w-full text-gray-600 font-medium rounded-sm text-sm px-5 py-2.5 text-left dark:bg-gray-500" 
                                href="{{ route('admin.tag.index') }}"><i class="fas fa-file-alt mr-4"></i>Tag</a>
                                @endcan
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
                    url: `/admin/posts/${id}`,
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