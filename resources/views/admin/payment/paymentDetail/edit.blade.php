@extends ('layouts.app', ['title' => 'ticash | Payment'])

@section('content')

        <!-- Navbar -->
       @include('navbar.finance')
        <!-- end Navbar -->


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
                                            <div class="p-2">
                                            <h5 class="text-gray-600"> 
                                            Total Payment: 
                                            </h5>
                                                 <hr class="border-b-0.5 border-gray-300 my-2 mx-2">

                                    <form action="{{ route('admin.paymentReport.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="flex">                           
                                        <div class="relative pull-right mt-1 pr-8 md:pr-5">
                                            <label for="title" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Start Date</label>
                                            <input type="date" name="start_date" placeholder="Date" class="w-full bg-white-700 text-sm text-gray-800 transition border focus:outline-none focus:border-gray-700 rounded-2xl py-1 px-7 pl-20 appearance-none leading-normal">                                   
                                        </div>
                                        <div class="relative pull-right mt-1 pr-8 md:pr-5">
                                            <label for="title" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">End Date</label>
                                            <input type="date" name="end_date" placeholder="Date" class="w-full bg-white-700 text-sm text-gray-800 transition border focus:outline-none focus:border-gray-700 rounded-2xl py-1 px-7 pl-20 appearance-none leading-normal">
                                            <input type="hidden" name="payment_id" value="{{ $payment->id}}"  placeholder="Date" class="w-full bg-white-700 text-sm text-gray-800 transition border focus:outline-none focus:border-gray-700 rounded-2xl py-1 px-7 pl-20 appearance-none leading-normal">                                   
                                        </div>
                                        <div class="relative pull-right mt-1 pr-8 md:pr-5">
                                        <br>
                                        <button data-modal-toggle="create-modal" class="text-white focus:outline-none bg-yellow-600 hover:bg-yellow-500 px-2 py-1 shadow-sm rounded-2xl">
                                            <i class="fas fa-save"></i> Export
                                            </button>
                                            </div>
                                    </div>                         
                                    </form>
                                        
                                </div>

                                <div class="flex">
                               
                               
                            </div>

                            </div>
                                    <!--/table Card-->

                        </div>

                    </div>

                        <!--Divider-->
                        <hr class="border-b-2 border-gray-400 my-2 mx-2">

                       
                        <div class="flex flex-row flex-wrap flex-grow">
                           
                            <div class="w-full p-3">
                                <!--Table Card-->
                                <div class="bg-white border rounded shadow">
                                   
                                    <div class="p-5">
                                        <table class="w-full p-5 text-gray-700 text-sm">
                                            <thead class="bg-gray-200">
                                                <tr>
                                                    <th class="text-left text-gray-700 text-sm p-1">No</th>
                                                    <th class="text-left text-gray-700 text-sm p-1">Class</th>
                                                    <th class="text-left text-gray-700 text-sm p-1">Name</th>
                                                    <th class="text-left text-gray-700 text-sm p-1">Amount</th>
                                                    <th class="text-left text-gray-700 text-sm p-1">Status</th>
                                                    <th class="text-center text-gray-700 text-sm p-1">Date</th>
                                                </tr>
                                            </thead>

                                            <tbody class="bg-gray-200">
                                            @forelse($PaymentDetails as $no => $paymentDetail)
                                            <tr class="border bg-white">
                                                <th scope="row" class=" text-left p-1">{{ ++$no + ($PaymentDetails->currentPage()-1) * $PaymentDetails->perPage() }}</th>
                                                <td class=" text-left p-1">{{ $paymentDetail->degree->degree_name }}</td>
                                                <td class=" text-left p-1">{{ $paymentDetail->user->name }}</td>
                                                <td class=" text-left p-1">{{ moneyFormat ($paymentDetail->amount) }}</td>
                                                <td class=" text-left p-1">{{ $paymentDetail->status }}</td>
                                                <td class=" text-left p-1">{{ $paymentDetail->created_at }}</td>
                                            </tr>
                                            @empty
                                                <div class="bg-yellow-600 text-white text-center p-3 rounded-sm shadow-md">
                                                    Data Belum Tersedia!
                                                </div>
                                            @endforelse

                                            </tbody>
                                        </table>
                                        @if ($PaymentDetails->hasPages())
                                            <div class="bg-white p-3">
                                                {{ $PaymentDetails->links('pagination::tailwind') }}
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
                            <h5 class="font-bold text-gray-600">Payment</h5>
                        </div>
                        <div class="p-3">

                            <div class="bg-white border rounded shadow">
                            <div class="p-1">
                            <form class="space-y-6 px-6 lg:px-8 pb-4 sm:pb-6 xl:pb-8" action="{{ route('admin.payment.update', $payment->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                                   
                    <div class="grid gap-1 grid-cols-1 grid-rows-1">
                    <div class="mr-2">
                            <label for="title" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $payment->title) }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Title" autoFocus required="">
                            @error('title')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>  
                                          
                    </div>

                                              

                    <div class="grid gap-1 grid-cols-2 grid-rows-1">
                      <div class="mr-2">
                            <label for="transaction_category_id" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">POS Category</label>
                            <select name="transaction_category_id" id="transaction_category_id" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                    <option value="{{ $payment->transaction_category_id}}">{{ $payment->transaction_category->description}}</option>
                                    @foreach ($transactionCategories as $transactionCategory)
                                    <option value="{{ $transactionCategory->id}}">{{ $transactionCategory->description}}</option>
                                    @endforeach
                            </select>
                        </div>   
                           
                        <div class="mr-2">
                            <label for="amount" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Amount</label>
                            <input type="number" name="amount" id="amount" value="{{ old('amount', $payment->amount) }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Amount" autoFocus required="">
                            @error('amount')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>   
                        <div class="mr-2">
                            <label for="type" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Type</label>
                            <select name="type" id="type" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                    <option value="{{ $payment->type}}">{{ $payment->type}}</option>
                                    <option value="public">Public</option>
                                    <option value="private">Private</option>
                                   
                            </select>
                        </div> 
                       

                          <div class="mr-2">
                            <label for="sequence" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Sequence</label>
                            <select name="sequence" id="sequence" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                    
                                    <option value="{{ $payment->sequence}}">{{ $payment->sequence}}</option>
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
                            <label for="deadline" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Deadline</label>
                            <input type="date" name="deadline" id="deadline" value="{{ old('deadline', $payment->deadline) }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Amount" autoFocus required="">
                            @error('deadline')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>                     
                    </div>

                    <div class="grid gap-1 grid-cols-1 grid-rows-1">
                    <div class="mr-2">
                            <label for="description" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Description</label>
                            <input type="text" name="description" id="description" value="{{ old('description', $payment->description) }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Description" autoFocus required="">
                            @error('description')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>  
                                          
                    </div>

                    </div>
                        <button type="submit" class="mt-2 w-full text-white bg-blue-800 hover:bg-blue-500 focus:ring-4 focus:ring-gray-300 font-medium text-sm px-5 py-2.5 text-center dark:bg-gray-500 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                        <i class="fas fa-save mr-2"></i>Save</button>
                        <div class="text-sm font-medium text-gray-500 dark:text-gray-300">

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
                    url: `/admin/slider/${id}`,
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
