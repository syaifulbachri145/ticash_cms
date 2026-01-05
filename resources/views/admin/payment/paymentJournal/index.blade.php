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
                                    <i class="fas fa-plus"></i> Buat Jurnal
                                    </button>
                                @endcan
                                                                    
                            </div>


                           
                           <div class="flex mt-4">

                                    <form action="{{ route('admin.paymentJournal.index') }}" method="GET">

                                    <div class="grid gap-1 grid-cols-3 grid-rows-1">
                                    
                                    <div class="mr-2">
                                    <select name="q" id="transaction_category_id" class="bg-gray-50 border border-gray-300 text-gray-800 p-2 sm:text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                             <option value=""> - Cari berdasarkan POS Transaksi - </option>
                                            @foreach ($transactionCategories as $transactionCategory)
                                            <option value="{{ $transactionCategory->id}}">{{ $transactionCategory->description}}</option>
                                            @endforeach
                                    </select>
                                    </div>


                                    <div class="mr-2">
                                     <button type="submit" class="text-white bg-blue-800 hover:bg-blue-500 focus:ring-4 focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-2.5 text-center dark:bg-gray-500 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                      <svg class="fill-current pointer-events-none text-white w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path>
                                        </svg>
                            
                                     </button>
                                     </div>
                  
                                    </div>
                                    </form>

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

                    <div class="p-2 ml-3">
                    @if($saldo_journal == '0')
                        
                    @else
                      <h5 class="text-gray-500"> 
                              Saldo:  <strong>{{moneyFormat($saldo_journal)}} </strong>
                      </h5>
                      <hr class="mt-2">
                    @endif
                        
                   
                    </div>

                      
                        <div class="p-5">
                           <table class="w-full rounded-3xl p-5 text-gray-600 text-sm">
                                <thead class="bg-gray-200">
                                    
                                    <tr>
                                        <th class="text-left text-gray-600 text-sm p-1">No</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Institution</th>
                                        <th class="text-left text-gray-600 text-sm p-1">POS</th>
                                        <th class="text-left text-gray-600 text-sm p-1">User</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Deskripsi</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Debit</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Credit</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Saldo</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Transaksi</th>
                                        <th class="text-center text-gray-600 text-sm p-1">Action</th>
                                    </tr>
                                </thead>

                                <tbody class="bg-gray-200">
                                @forelse($payments as $no => $payment)
                                <tr class="border bg-white">
                                    <th scope="row" class=" text-left p-1">{{ ++$no + ($payments->currentPage()-1) * $payments->perPage() }}</th>
                                    <td class=" text-left p-1">{{ $payment->institution->institution_name }}</td>
                                    <td class=" text-left p-1">{{ $payment->transaction_category->description }}</td>
                                    <td class=" text-left p-1">{{ $payment->user_name }}</td>
                                    <td class=" text-left p-1">{{ $payment->description }}</td>
                                    <td class=" text-left p-1">{{ moneyFormat($payment->debit) }}</td>
                                    <td class=" text-left p-1">{{ moneyFormat($payment->credit) }}</td>
                                    <td class=" text-left p-1">{{ moneyFormat($payment->saldo) }}</td>
                                    <td class=" text-left p-1">{{ $payment->created_at }}</td>
                                    <td class="px-5 py-1 text-center">
                                  
                                        @can('paymentJournals.edit')
                                        <a href="{{ route('admin.paymentJournal.edit', $payment->id) }}" class="bg-gray-500 px-2 py-0.5 rounded shadow-sm text-xs text-white focus:outline-none">
                                        <i class="fas fa-edit text-center"></i></a>
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

      <!-- Modal Create Role -->
    <div id="create-modal" aria-hidden="true" class="hidden overflow-x-hidden overflow-y-auto fixed h-modal md:h-full top-4 left-0 right-0 md:inset-0 z-50 justify-center items-center">
        <div class="flex flex-col w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-2xl border border-gray-300 shadow-xl">
            <!-- <div class="relative w-full max-w-md px-4 h-full md:h-auto"> -->
            <!-- Modal content -->
            <div class="bg-white rounded-2xl shadow relative dark:bg-gray-700">
                <div class="flex justify-end p-2 border-b">
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">Buat Jurnal Baru</h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-2xl text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="create-modal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>
                <form class="space-y-6 px-6 lg:px-8 pb-4 sm:pb-6 xl:pb-8" action="{{ route('admin.paymentJournal.store')}}" method="POST" enctype="multipart/form-data">
                @csrf

                    <div class="grid gap-1 grid-cols-1 grid-rows-1">

                    <div class="mr-2">
                            <label for="description" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Deskripsi</label>
                            <input type="text" name="description" id="description" value="{{ old('description') }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Deskripsi" required="">
                            @error('description')
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
                                   
                                    <option value="debit">Pemasukan</option>
                                    <option value="credit">Pengeluaran</option>
                                   
                            </select>
                        </div> 


                    </div>
                  
                   

                    <button type="submit" class="w-full text-white bg-blue-800 hover:bg-blue-500 focus:ring-4 focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-2.5 text-center dark:bg-gray-500 dark:hover:bg-gray-600 dark:focus:ring-gray-700">Save</button>
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-300">

                    </div>
                    </div>
                </form>
           
        </div>
    </div>

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
