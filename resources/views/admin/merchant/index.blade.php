@extends ('layouts.app', ['title' => 'Merchant - Admin'])

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
                                <h5 class="font-bold text-gray-400"> <i class="	fas fa-server fa-fw mr-3"></i>Merchant</h5>
                            </div>

                            <div class="flex">
                                @can('merchants.create')
                                <button data-modal-toggle="create-modal" class="text-white focus:outline-none bg-gray-600 hover:bg-gray-500 px-2 py-1 shadow-sm rounded-2xl">
                                    <i class="fas fa-plus"></i> Add New
                                    </button>
                                @endcan
                                <div class="relative pull-right pl-4 pr-8 md:pr-20">
                                    <form action="{{ route('admin.merchant.index') }}" method="GET">
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
                            <table class="w-full p-5 text-gray-600 text-sm">
                                <thead class="bg-gray-200">
                                    <tr>
                                      
                                        <th class="text-left text-gray-600 text-sm p-1">Banner</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Merchant</th>
                                        <th class="text-left text-gray-600 text-sm p-1">User</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Description</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Status</th>
                                        <th class="text-center text-gray-600 text-sm p-1">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-gray-200">
                                @forelse($merchants as $no => $merchant)
                                <tr class="border bg-white">
                                    
                                    <td class=" text-left p-1">
                                        <img src="{{ $merchant->banner }}" class="w-8 h-8 mr-4 rounded" style="width: 35%">
                                    </td>
                                    <td class=" text-left p-1">{{ $merchant->merchant_name }}</td>
                                    <td class=" text-left p-1">{{ $merchant->user->name }}</td>
                                    <td class=" text-left p-1">{{ $merchant->description }}</td>
                                    <td class=" text-left p-1">{{ $merchant->status }}</td>
                                    <td class="px-5 py-1 text-center">
                                  
                                        @can('merchants.edit')
                                        <a href="{{ route('admin.merchant.edit', $merchant->id) }}" class="bg-gray-500 px-2 py-0.5 rounded shadow-sm text-xs text-white focus:outline-none">
                                        <i class="fas fa-edit text-center"></i></a>
                                        @endcan
                                        
                                        @can('merchants.delete')
                                        <button onClick="destroy(this.id)" id="{{ $merchant->id }}" class="bg-yellow-500 px-2 py-1 rounded shadow-sm text-xs text-white focus:outline-none fas fa-trash-alt"></button>
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
                            @if ($merchants->hasPages())
                                <div class="bg-white p-3">
                                    {{ $merchants->links('pagination::tailwind') }}
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


    <!-- Modal Create -->
    <div id="create-modal" aria-hidden="true" class="hidden overflow-x-hidden overflow-y-auto fixed h-modal md:h-full top-4 left-0 right-0 md:inset-0 z-50 justify-center items-center">
        <div class="flex flex-col w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-lg border border-gray-300 shadow-xl">
            <!-- <div class="relative w-full max-w-md px-4 h-full md:h-auto"> -->
            <!-- Modal content -->
            <div class="bg-white rounded-lg shadow relative dark:bg-gray-700">
                <div class="flex justify-end p-2 border-b">
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">Add Institution Form</h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="create-modal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>
                <form class="space-y-6 px-6 lg:px-8 pb-4 sm:pb-6 xl:pb-8" action="{{ route('admin.merchant.store')}}" method="POST" enctype="multipart/form-data">
                @csrf

                    <div class="grid gap-1 grid-cols-3 grid-rows-1">
                        <div class="mr-2">
                            <label for="merchant_name" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Merchant Name</label>
                            <input type="text" name="merchant_name" id="merchant_name" value="{{ old('merchant_name') }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Merchant Name" required="">
                            @error('merchant_name')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>
                        <div class="mr-2">
                            <label for="user_id" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">User</label>
                            <select name="user_id" id="user_id" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id}}">{{ $user->name}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="mr-2">
                            <label for="image" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Image</label>
                            <input type="file" name="image" id="image" value="" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Your Name">
                           
                        </div>
                       
                    </div>

                    <div class="grid gap-1 grid-cols-2 grid-rows-1">
                    <div class="mr-2">
                            <label for="no_ktp" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">No KTP</label>
                            <input type="number" name="no_ktp" value="{{ old('no_ktp') }}" id="no_ktp" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="No KTP" required="">
                            @error('no_ktp')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>
                        <div class="mr-2">
                            <label for="description" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Description</label>
                            <input type="text" name="description" value="{{ old('description') }}" id="description" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Description" required="">
                            @error('description')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>

                    </div>



                    <button type="submit" class="w-full text-white bg-blue-800 hover:bg-blue-500 focus:ring-4 focus:ring-gray-300 font-medium rounded-2xl text-sm px-5 py-2.5 text-center dark:bg-gray-500 dark:hover:bg-gray-600 dark:focus:ring-gray-700">Save</button>
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-300">

                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>

    <!-- End Modal Create -->

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
                    url: `/admin/merchant/${id}`,
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
