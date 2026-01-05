@extends ('layouts.app', ['title' => 'ticash | Withdrawal'])

@section('content')

        <!-- Navbar -->
       @include('navbar.transaction')
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
                                <h5 class="font-bold text-gray-400"> <i class="	fas fa-server fa-fw mr-3"></i>Withdrawal</h5>
                            </div>

                            <div class="flex">
                                @can('withdrawals.create')
                                <button data-modal-toggle="create-modal" class="text-white focus:outline-none bg-gray-600 hover:bg-gray-500 px-2 py-1 shadow-sm rounded-2xl">
                                    <i class="fas fa-plus"></i> Add New
                                    </button>
                                @endcan
                                <div class="relative pull-right pl-4 pr-8 md:pr-20">
                                    <form action="{{ route('admin.withdrawal.index') }}" method="GET">
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
                                        <th class="text-left text-gray-600 text-sm p-1">No</th>
                                        <th class="text-left text-gray-600 text-sm p-1">INV</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Institution</th>
                                        <th class="text-left text-gray-600 text-sm p-1">User</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Amount</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Transaction</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Description</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Status</th>
                                       
                                    </tr>
                                </thead>
                                <tbody class="bg-gray-200">
                                @forelse($withdrawals as $no => $withdrawal)
                                <tr class="border bg-white">
                                    <th scope="row" class=" text-left p-1">{{ ++$no + ($withdrawals->currentPage()-1) * $withdrawals->perPage() }}</th>
                                   
                                    <td class=" text-left p-1">{{ $withdrawal->trans_number }}</td>
                                    <td class=" text-left p-1">{{ $withdrawal->institution->institution_name }}</td>
                                    <td class=" text-left p-1">{{ $withdrawal->user->name }}</td>
                                    <td class=" text-left p-1">{{ moneyFormat($withdrawal->amount) }}</td>
                                    <td class=" text-left p-1">{{ $withdrawal->transaction_category->transaction_name }}</td>
                                    <td class=" text-left p-1">{{ $withdrawal->description }}</td>
                                    <td class=" text-left p-1">{{ $withdrawal->status }}</td>
                                    <td class="px-5 py-1 text-center">
                                </tr>
                                @empty
                                    <div class="bg-yellow-600 text-white text-center p-3 rounded-sm shadow-md">
                                        Data Belum Tersedia!
                                    </div>
                                @endforelse

                                </tbody>
                            </table>
                            @if ($withdrawals->hasPages())
                                <div class="bg-white p-3">
                                    {{ $withdrawals->links('pagination::tailwind') }}
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
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">Add Withdrawal Form</h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="create-modal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>




                <form class="space-y-6 px-6 lg:px-8 pb-4 sm:pb-6 xl:pb-8" action="{{ route('admin.withdrawal.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="grid gap-1 grid-cols-1 grid-rows-1">
                        <div class="mr-2">
                            <label for="s" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Card Number</label>
                            <input type="password" name="card_number" value="{{ old('card_number') }}" placeholder="Search" class="w-full bg-white-700 text-sm text-gray-800 transition border focus:outline-none focus:border-gray-700 rounded py-1 px-7 pl-20 appearance-none leading-normal">
                           
                            @error('s')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>
                                              
                    </div>

                    <button type="submit" class="w-full text-white bg-blue-800 hover:bg-blue-500 focus:ring-4 focus:ring-gray-300 font-medium rounded-2xl text-sm px-5 py-2.5 text-center dark:bg-gray-500 dark:hover:bg-gray-600 dark:focus:ring-gray-700">Search</button>
                  
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
                    url: `/admin/withdrawal/${id}`,
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
