@extends ('layouts.app', ['title' => 'ticash | Transaction Category'])

@section('content')

        @include('navbar.master')


        <div id="main-content" class="w-full flex-1">

            <div class="flex flex-1 flex-wrap">

                <div class="w-full xl:w-1/3 p-6 xl:max-w-6xl">

                   <!--"Container" for the graphs"-->
                    <div class="max-w-sm lg:max-w-3xl xl:max-w-5xl">

                        <!--Graph Card-->

                        <div class="border-b p-3">
                            <h5 class="font-bold text-gray-600">Add New Category</h5>
                        </div>
                        <div class="p-3">

                            <div class="bg-white border rounded-3xl shadow-md">
                            <div class="p-1">
                        <form class="space-y-6 px-6 lg:px-8 pb-4 sm:pb-6 xl:pb-8" action="{{ route('admin.transactionCategory.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                                <div>
                                    <label for="coa_id" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">COA Id</label>
                                    <input type="text" name="coa_id" id="coa_id" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Category" required="">
                                    
                                    
                                    @error('coa_id')
                                        <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                            <div class="px-4 py-2">
                                                <p class="text-gray-600 text-sm">{{ $message }}</p>
                                            </div>
                                        </div>
                                    @enderror
                                </div>
                                <div>
                                    <label for="description" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Description</label>
                                    <input type="text" name="description" id="description" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Description" required="">
                                    @error('description')
                                        <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                            <div class="px-4 py-2">
                                                <p class="text-gray-600 text-sm">{{ $message }}</p>
                                            </div>
                                        </div>
                                    @enderror
                                </div>
                                  <div class="mr-2">
                                    <label for="is_hidden" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Hidden</label>
                                    <select name="is_hidden" id="is_hidden" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                        
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        
                                    </select>
                                </div> 

                            <div class="grid gap-1 grid-cols-2 grid-rows-1">
                               <div class="mr-2">
                                <button type="resset" class="w-full text-white bg-gray-600 hover:bg-yellow-500 focus:ring-4 focus:ring-gray-300 font-medium rounded-2xl text-sm px-5 py-2.5 text-center dark:bg-gray-500 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                    <i class="fas fa-redo mr-2"></i>Resset</button>
                               </div>
                               <div>
                                <button type="submit" class="w-full text-white bg-blue-800 hover:bg-blue-600 focus:ring-4 focus:ring-gray-300 font-medium rounded-2xl text-sm px-5 py-2.5 text-center dark:bg-gray-500 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
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

                <div class="w-full xl:w-2/3 p-6 xl:max-w-4xl border-l-1 border-gray-300">

                    


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
                                            <h5 class="font-bold text-gray-400"> <i class="	fas fa-film fa-fw mr-3"></i>Transaction Category</h5>
                                        </div>

                                        <div class="flex">

                                            <div class="relative pull-right pl-4 pr-8 md:pr-20">
                                                <form action="{{ route('admin.transactionCategory.index') }}" method="GET">
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
                                        <table class="w-full p-5 text-gray-700 text-sm">
                                            <thead class="bg-gray-200">
                                                <tr>
                                                    <th class="text-left text-gray-700 text-sm p-1">No</th>
                                                    <th class="text-left text-gray-700 text-sm p-1">Id</th>
                                                    <th class="text-left text-gray-700 text-sm p-1">Coa Id</th>
                                                    <th class="text-left text-gray-700 text-sm p-1">Description</th>
                                                    <th class="text-left text-gray-700 text-sm p-1">Is Hidden</th>
                                                    <th class="text-left text-gray-700 text-sm p-1">Status</th>
                                                    <th class="text-center text-gray-700 text-sm p-1">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody class="bg-gray-200">
                                            @forelse($transactionCategories as $no => $transactionCategory)
                                            <tr class="border bg-white">
                                                <th scope="row" class=" text-left p-1">{{ ++$no + ($transactionCategories->currentPage()-1) * $transactionCategories->perPage() }}</th>
                                                <td class=" text-left p-1">{{ $transactionCategory->id }}</td>
                                                <td class=" text-left p-1">{{ $transactionCategory->coa_id }}</td>
                                                <td class=" text-left p-1">{{ $transactionCategory->description }}</td>
                                                <td class=" text-left p-1">{{ $transactionCategory->is_hidden }}</td>
                                                <td class=" text-left p-1">{{ $transactionCategory->status }}</td>
                                                <td class="px-5 py-1 text-center">
                                                    @can('transactionCategories.edit')
                                                    <a href="{{ route('admin.transactionCategory.edit', $transactionCategory->id) }}" class="bg-gray-500 px-2 py-0.5 rounded shadow-sm text-xs text-white focus:outline-none">
                                                    <i class="fas fa-edit text-center"></i></a>
                                                    @endcan
                                                    @can('transactionCategories.delete')
                                                    <button onClick="destroy(this.id)" id="{{ $transactionCategory->id }}" class="bg-yellow-500 px-2 py-1 rounded shadow-sm text-xs text-white focus:outline-none fas fa-trash-alt"></button>
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
                                        @if ($transactionCategories->hasPages())
                                            <div class="bg-white p-3">
                                                {{ $transactionCategories->links('pagination::tailwind') }}
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
                    url: `/admin/transactionCategory/${id}`,
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
