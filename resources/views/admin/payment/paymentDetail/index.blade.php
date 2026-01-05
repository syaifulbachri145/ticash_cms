@extends ('layouts.app', ['title' => 'ticash | Transaction Category'])

@section('content')

        @include('navbar.finance')


        <div id="main-content" class="w-full flex-1">

            <div class="flex flex-1 flex-wrap">

                <div class="w-full xl:w-1/3 p-6 xl:max-w-6xl">

                   <!--"Container" for the graphs"-->
                    <div class="max-w-sm lg:max-w-3xl xl:max-w-5xl">

                        <!--Graph Card-->

                        <div class="border-b p-3">
                            <h5 class="font-bold text-gray-600">Buat Tagihan</h5>
                        </div>
                            <div class="p-3">

                                <div class="bg-white border rounded-3xl shadow-md">
                                    <div class="p-1">
                                    <div class="flex p-2 border-b">
                                        <h3 class="text-md font-medium text-gray-500 dark:text-white">Tagihan Semua</h3>
                                        
                                    </div>
                                    <form class="space-y-6 px-6 lg:px-8 pb-4 sm:pb-6 xl:pb-8" action="{{ route('admin.paymentDetail.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                            <div class="mr-2">
                                                <label for="payment_id" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Biaya</label>
                                                <select name="payment_id" id="payment_id" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                                        @foreach ($publicPayments as $payment)
                                                        <option value="{{ $payment->id}}">{{ $payment->title}}</option>
                                                        @endforeach
                                                </select>

                                                 <input type="hidden" name="type" value="all">
                                            </div>   
                                           
                                        <div class="grid gap-1 grid-cols-2 grid-rows-1">
                                        
                                        <div>
                                            <button type="submit" class="w-full text-white bg-blue-800 hover:bg-blue-600 focus:ring-4 focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-2.5 text-center dark:bg-gray-500 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                                <i class="fas fa-save mr-2"></i>Buat Tagihan</button>
                                        </div>
                                        </div>
                                    </form>

                                <!-- Tagihan Per Kelas -->
                                    <div class="flex p-2 border-b">
                                        <h3 class="text-md font-medium text-gray-500 dark:text-white">Tagihan Per Kelas</h3>      
                                    </div>

                                      <form class="space-y-6 px-6 lg:px-8 pb-4 sm:pb-6 xl:pb-8" action="{{ route('admin.paymentDetail.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                            <div class="mr-2">
                                                <label for="payment_id" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Biaya</label>
                                                <select name="payment_id" id="payment_id" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                                        @foreach ($privatePayments as $payment)
                                                        <option value="{{ $payment->id}}">{{ $payment->title}}</option>
                                                        @endforeach
                                                </select>
                                            </div>   
                                            <div class="mr-2">
                                                <label for="degree_id" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Kelas</label>
                                                <select name="degree_id" id="degree_id" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                                        @foreach ($degrees as $degree)
                                                        <option value="{{ $degree->id}}">{{ $degree->degree_name}}</option>
                                                        @endforeach
                                                </select>

                                                 <input type="hidden" name="type" value="degree">
                                            </div>     
                                            

                                        <div class="grid gap-1 grid-cols-2 grid-rows-1">
                                        
                                        <div>
                                            <button type="submit" class="w-full text-white bg-blue-800 hover:bg-blue-600 focus:ring-4 focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-2.5 text-center dark:bg-gray-500 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                                <i class="fas fa-save mr-2"></i>Buat Tagihan</button>
                                        </div>
                                        </div>
                                    </form>

                                <!-- Tagihan Per Siswa -->
                                      <div class="flex p-2 border-b">
                                        <h3 class="text-md font-medium text-gray-500 dark:text-white">Tagihan Per Siswa</h3>      
                                    </div>

                                      <form class="space-y-6 px-6 lg:px-8 pb-4 sm:pb-6 xl:pb-8" action="{{ route('admin.paymentDetail.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                            <div class="mr-2">
                                                <label for="payment_id" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Biaya</label>
                                                <select name="payment_id" id="payment_id" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                                        @foreach ($privatePayments as $payment)
                                                        <option value="{{ $payment->id}}">{{ $payment->title}}</option>
                                                        @endforeach
                                                </select>
                                            </div>   
                                            <div class="mr-2">
                                                <label for="nim" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">NIS</label>
                                                <input type="number" name="nim" id="nim" value="{{ old('nim') }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="NIS" required="">
                                                <input type="hidden" name="type" value="student">
                                                @error('nim')
                                                    <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                                        <div class="px-4 py-2">
                                                            <p class="text-gray-600 text-sm">{{ $message }}</p>
                                                        </div>
                                                    </div>
                                                @enderror
                                            </div>   
                                            

                                        <div class="grid gap-1 grid-cols-2 grid-rows-1">
                                        
                                        <div>
                                            <button type="submit" class="w-full text-white bg-blue-800 hover:bg-blue-600 focus:ring-4 focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-2.5 text-center dark:bg-gray-500 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                                <i class="fas fa-save mr-2"></i>Buat Tagihan</button>
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
                                            <h5 class="font-bold text-gray-400"> <i class="	fas fa-film fa-fw mr-3"></i>Daftar Tagihan</h5>
                                        </div>

                                        <div class="flex">

                                            <div class="relative pull-right pl-4 pr-8 md:pr-20">
                                                <form action="{{ route('admin.paymentDetail.index') }}" method="GET">
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
                            
                            <table class="w-full p-5 text-gray-600 text-sm">
                                    <thead class="bg-gray-200">
                                        <tr>
                                            <th class="text-left text-gray-600 text-sm p-1">No</th>
                                            <th class="text-left text-gray-600 text-sm p-1">Biaya</th>
                                            <th class="text-left text-gray-600 text-sm p-1">Nominal</th>
                                            <th class="text-left text-gray-600 text-sm p-1">Siswa</th>
                                            <th class="text-left text-gray-600 text-sm p-1">Kelas</th>
                                            <th class="text-left text-gray-600 text-sm p-1">Status</th>
                                            <th class="text-left text-gray-600 text-sm p-1">Date</th>
                                        
                                        </tr>
                                    </thead>
                                    <tbody class="bg-gray-200">
                                    @forelse($paymentDetails as $no => $paymentDetail)
                                    <tr class="border bg-white">
                                        <th scope="row" class=" text-left p-1">{{ ++$no + ($paymentDetails->currentPage()-1) * $paymentDetails->perPage() }}</th>
                                        <td class=" text-left p-1">{{ $paymentDetail->description }}</td>
                                        <td class=" text-left p-1">{{ moneyFormat($paymentDetail->amount) }}</td>
                                        <td class=" text-left p-1">{{ $paymentDetail->user->name }}</td>
                                        <td class=" text-left p-1">{{ $paymentDetail->degree->degree_name }}</td>
                                        <td class=" text-left p-1">{{ $paymentDetail->status }}</td>
                                        <td class=" text-left p-1">{{ $paymentDetail->created_at }}</td>
                                        <td class="px-5 py-1 text-center">                                    
                                        
                                        </td>

                                    </tr>
                                    @empty
                                        <div class="bg-yellow-600 text-white text-center p-3 rounded-sm shadow-md">
                                            Data Belum Tersedia!
                                        </div>
                                    @endforelse

                                    </tbody>
                                </table>
                            @if ($paymentDetails->hasPages())
                                <div class="bg-white p-3">
                                    {{ $paymentDetails->links('pagination::tailwind') }}
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
