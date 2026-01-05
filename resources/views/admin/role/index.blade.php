@extends ('layouts.app', ['title' => 'Permission - Admin'])

@section('content')


        <!-- Navbar -->
        @include('navbar.master')
        <!-- end Navbar -->

        <!--Graph Content -->
        <div id="main-content" class="w-full flex-1">

            <div class="flex flex-1 flex-wrap">

                <div class="w-full p-3">

                    <!--"Container" for the graphs"-->
                    <div class="max-w-full lg:max-w-3xl xl:max-w-5xl">

                        <!--Table Card-->
                        <div class="p-3">
                            <div class="p-4">
                                <h5 class="font-bold text-gray-400"> <i class="	fas fa-server fa-fw mr-3"></i>Role</h5>
                            </div>
                            
                            <div class="flex">
                                @can('roles.create')
                                <button data-modal-toggle="create-modal" class="text-white focus:outline-none bg-gray-600 hover:bg-gray-500 px-2 py-1 shadow-sm rounded-2xl">
                                    <a href="{{ route('admin.role.create') }}"><i class="fas fa-plus"></i> Add New</a>
                                    </button>
                                @endcan
                                <div class="relative pull-right pl-4 pr-8 md:pr-20">
                                    <form action="{{ route('admin.role.index') }}" method="GET">
                                    <input type="search" name="q" value="{{ request()->query('q') }}" placeholder="Search" class="w-full bg-white-700 text-sm text-gray-800 transition border focus:outline-none focus:border-gray-700 rounded-2xl py-1 px-7 pl-20 appearance-none leading-normal">
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
                            <table class="auto text-gray-600">
                                <thead class="bg-gray-200">
                                    <tr>
                                        <th class="text-left text-gray-600 text-sm p-1">No</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Role Name</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Permission</th>
                                        <th class="text-center text-gray-600 text-sm p-1">Action</th>
                                    </tr>
                                </thead>

                                <tbody class="bg-gray-200">
                                @forelse($roles as $no => $role)
                                <tr class="border bg-white">
                                    <th scope="row" class=" text-left p-1">{{ ++$no + ($roles->currentPage()-1) * $roles->perPage() }}</th>
                                    <td class=" text-left p-1">{{ $role->name }}</td>
                                    <td class=" text-left p-2">
                                        @foreach($role->getPermissionNames() as $permission)
                                            <button class="bg-indigo-100 px-2 py-1 rounded shadow-sm text-xs text-gray-900 focus:outline-none pb-2 mb-1 mt-1 mr-0.5 ml-0.5">{{ $permission }}</button>
                                        @endforeach
                                    </td>
                                    <td class="px-5 py-1 text-center">
                                        @can('roles.edit')
                                        <a href="{{ route('admin.role.edit', $role->id) }}" class="bg-gray-500 px-2 py-0.5 rounded shadow-sm text-xs text-white focus:outline-none"> 
                                        <i class="fas fa-edit text-center"></i></a>
                                        @endcan
                                        @can('roles.delete')
                                        <button onClick="destroy(this.id)" id="{{ $role->id }}" class="bg-yellow-500 px-2 py-1 rounded shadow-sm text-xs text-white focus:outline-none fas fa-trash-alt"></button>
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
                            @if ($roles->hasPages())
                                <div class="bg-white p-3">
                                    {{ $roles->links('pagination::tailwind') }}
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


    <!-- Modal Create Role -->
    <div id="role-modal" aria-hidden="true" class="hidden overflow-x-hidden overflow-y-auto fixed h-modal md:h-full top-4 left-0 right-0 md:inset-0 z-50 justify-center items-center">
        <div class="flex flex-col w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-lg border border-gray-300 shadow-xl">
            <!-- <div class="relative w-full max-w-md px-4 h-full md:h-auto"> -->
            <!-- Modal content -->
            <div class="bg-white rounded-lg shadow relative dark:bg-gray-700">
                <div class="flex justify-end p-2">
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="role-modal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                    </button>
                </div>
                <form class="space-y-6 px-6 lg:px-8 pb-4 sm:pb-6 xl:pb-8" action="{{ route('admin.role.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">Add Role Form</h3>
                    <div>
                        <label for="name" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Role Name</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="marketing" required="">
                        @error('name')
                            <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                <div class="px-4 py-2">
                                    <p class="text-gray-600 text-sm">{{ $message }}</p>
                                </div>
                            </div>
                        @enderror
                    </div>
                    <div>
                        <label for="permission" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Role Id Test</label>
                  <!--
                        @foreach ($permissions as $permission)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="check-{{ $permission->id }}">
                                <label class="form-check-label" for="check-{{ $permission->id }}">
                                    {{ $permission->name }}
                                </label>
                            </div>
                        @endforeach
-->
                    
                    </div>
                   
                    <button type="submit" class="w-full text-white bg-yellow-600 hover:bg-yellow-500 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-500 dark:hover:bg-gray-600 dark:focus:ring-gray-700">Save</button>
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                       
                    </div>
                </form>
            </div>
        </div>
    </div> 
    <script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>
    <!-- second modal -->

    <!-- End Modal -->

    <script>
    //ajax delete
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
                    url: `/admin/role/${id}`,
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