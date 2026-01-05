@extends ('layouts.app', ['title' => 'ticash | Payment'])

@section('content')

        <!-- Navbar -->
       @include('navbar.finance')
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
                                <h5 class="text-gray-500"> 

                                
                                </h5>
                               
                            </div>

                            <div class="flex">
                                @can('payments.create')
                                <button data-modal-toggle="create-modal" class="text-white focus:outline-none bg-gray-600 hover:bg-gray-500 px-2 py-1 shadow-sm rounded-2xl">
                                    <i class="fas fa-plus"></i> Add New
                                    </button>
                                @endcan
                                <div class="relative pull-right pl-4 pr-8 md:pr-20">
                                    <form action="{{ route('admin.payment.index') }}" method="GET">
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
                    <div class="bg-white border rounded-3xl shadow">

                    <div class="p-5">

                   
                    </div>

                      
                        <div class="p-5">
                            <table class="w-full p-5 text-gray-600 text-sm">
                                <thead class="bg-gray-200">
                                 
                                    <tr>
                                        <th class="text-left text-gray-600 text-sm p-1">No</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Institution</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Type</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Title</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Amount</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Sequence</th>
                                        <th class="text-center text-gray-600 text-sm p-1">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-gray-200">
                                @forelse($payments as $no => $payment)
                                <tr class="border bg-white">
                                    <th scope="row" class=" text-left p-1">{{ ++$no + ($payments->currentPage()-1) * $payments->perPage() }}</th>
                                    <td class=" text-left p-1">{{ $payment->institution->institution_name }}</td>
                                    <td class=" text-left p-1">{{ $payment->type}}</td>
                                    <td class=" text-left p-1">{{ $payment->title }}</td>
                                    <td class=" text-left p-1">{{ moneyFormat($payment->amount) }}</td>                                 
                                    <td class=" text-left p-1">{{ $payment->sequence }}</td>
                                    <td class="px-5 py-1 text-center">
                                  
                                        @can('payments.edit')
                                        <a href="{{ route('admin.payment.edit', $payment->id) }}" class="bg-gray-500 px-2 py-0.5 rounded shadow-sm text-xs text-white focus:outline-none">
                                        <i class="fas fa-edit text-center"></i></a>
                                        @endcan
                                        
                                        @can('payments.delete')
                                        <button onClick="destroy(this.id)" id="{{ $payment->id }}" class="bg-yellow-500 px-2 py-1 rounded shadow-sm text-xs text-white focus:outline-none fas fa-trash-alt"></button>
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
                            @if ($payments->hasPages())
                                <div class="bg-white p-3">
                                    {{ $payments->links('pagination::tailwind') }}
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
        <div class="flex flex-col w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-2xl border border-gray-300 shadow-xl">
            <!-- <div class="relative w-full max-w-md px-4 h-full md:h-auto"> -->
            <!-- Modal content -->
            <div class="bg-white rounded-2xl shadow relative dark:bg-gray-700">
                <div class="flex justify-end p-2 border-b">
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">Buat Biaya Baru</h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-2xl text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="create-modal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>
                <form class="space-y-6 px-6 lg:px-8 pb-4 sm:pb-6 xl:pb-8" action="{{ route('admin.payment.store')}}" method="POST" enctype="multipart/form-data">
                @csrf

                    <div class="grid gap-1 grid-cols-2 grid-rows-1">
                     <div class="mr-2">
                            <label for="title" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Nama Biaya</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Title" required="">
                            @error('title')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>           
                        <div class="mr-2">
                            <label for="amount" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Nominal</label>
                            <input type="number" name="amount" id="amount" value="{{ old('amount') }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Amount" required="">
                            @error('amount')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>           
                        
                        <div class="mr-2">
                            <label for="transaction_category_id" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">POS Kategori</label>
                            <select name="transaction_category_id" id="transaction_category_id" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                    @foreach ($transactionCategories as $transactionCategory)
                                    <option value="{{ $transactionCategory->id}}">{{ $transactionCategory->description}}</option>
                                    @endforeach
                            </select>
                        </div>   
                        <div class="mr-2">
                            <label for="type" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Tipe</label>
                            <select name="type" id="type" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                   
                                    <option value="public">Public</option>
                                    <option value="private">Private</option>
                                   
                            </select>
                        </div> 

                         <div class="mr-2">
                            <label for="year" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Tahun</label>
                            <select name="year" id="year" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                   
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                   
                            </select>
                        </div> 

                          <div class="mr-2">
                            <label for="sequence" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Sequence</label>
                            <select name="sequence" id="sequence" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                    <option value="1">1</option>
                                     <option value="2">2</option>
                                      <option value="3">3</option>
                                       <option value="4">4</option>
                                        <option value="5">5</option>
                                         <option value="6">6</option>
                                          <option value="7">7</option>
                                           <option value="8">8</option>
                                            <option value="9">9</option>
                                             <option value="10">10</option>
                                              <option value="11">11</option>
                                               <option value="12">12</option>
                                 
                            </select>
                        </div>    



                        <div class="mr-2">
                            <label for="degree_id" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Apakah SPP</label>
                           
                            <div>
                                <input type="radio" id="yes" name="is_tuition_fee" value="yes">
                                <label for="yes" class="mr-2">Ya</label> 

                                <input type="radio" id="no" name="is_tuition_fee" value="no">
                                <label for="no">Tidak</label>

                                <div class="show-only-if-yes-is-checked form-group row mt-2">

                                <label for="tuition_fee" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">SPP</label>
                                <input type="number" name="tuition_fee" id="tuition_fee" value="{{ old('tuition_fee') }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Biaya SPP">
                                

                                 <label for="eat" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Makan</label>
                                <input type="number" name="eat" id="eat" value="{{ old('eat') }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Biaya Makan">
                               

                                 <label for="laundry" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Laundry</label>
                                <input type="number" name="laundry" id="laundry" value="{{ old('laundry') }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Biaya Laundry">
                              

                            </div>
                        </div>

                        </div>    

                        
                    </div>
                    <div class="grid gap-1 grid-cols-1 grid-rows-1">
                        <div class="mr-2">
                            <label for="description" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Deskripsi</label>
                            <input type="text" name="description" id="description" value="{{ old('description') }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Description" required="">
                            @error('description')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>                       
                    </div>
                    
                    <button type="submit" class="w-full text-white bg-blue-800 hover:bg-blue-600 focus:ring-4 focus:ring-gray-300 font-medium rounded-2xl text-sm px-5 py-2.5 text-center dark:bg-gray-500 dark:hover:bg-gray-600 dark:focus:ring-gray-700">Save</button>
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-300">

                    </div>
                </form>
            </div>
        </div>
    </div>

<style>
.show-only-if-yes-is-checked {
  display: none;
}

#yes:checked ~ .show-only-if-yes-is-checked {
  display: block;
}
</style>

    <script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>

    <!-- End Modal Create -->

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
                    url: `/admin/payment/${id}`,
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
