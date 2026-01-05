@extends ('layouts.app', ['title' => 'ticash | Payment'])

@section('content')

        <!-- Navbar -->
       @include('navbar.finance')
        <!-- end Navbar -->

        <!--Graph Content -->
        <div id="main-content" class="w-full flex-1">

            <div class="flex flex-col w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-xl shadow-xl mt-6">

                <form class="space-y-6 px-6 lg:px-8 pb-4 sm:pb-6 xl:pb-8" action="{{ route('admin.paymentUser.update', $paymentUser->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="w-full p-3">
                    <!--Table Card-->
                    <div class="bg-white border rounded-3xl shadow">
                        <div class="border-b p-3">
                        <h3 class="text-xl font-medium text-gray-900 dark:text-white">Edit Tagihan</h3>
                        </div>
                        <div class="p-5">
                       
                         <div class="grid gap-1 grid-cols-2 grid-rows-1">
                    <div class="grid gap-1 grid-cols-1 grid-rows-1">
                        <div class="mr-2">
                            <label for="description" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Biaya</label>
                            <input type="text" name="description" id="description" value="{{ old('description',$paymentUser->description) }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Description" required="">
                            @error('description')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>                       
                    </div>        
                        <div class="mr-2">
                            <label for="amount" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Nominal</label>
                            <input type="number" name="amount" id="amount" value="{{ old('amount', $paymentUser->amount) }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Amount" required="">
                            @error('amount')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>  

                          <div class="mr-2">
                            <label for="paid" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Jumlah Bayar</label>
                            <input type="number" name="paid" id="paid" value="{{ old('paid', $paymentUser->paid) }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Amount" required="">
                            @error('paid')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>  

                        @if($paymentUser->is_tuition_fee == 'yes')
                         <div class="mr-2">
                             <label for="tuition_fee" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">SPP</label>
                                <input type="number" name="tuition_fee" id="tuition_fee" value="{{ old('tuition_fee', $paymentUser->tuition_fee) }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Biaya SPP">
                         </div>       
                        <div class="mr-2">
                                 <label for="eat" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Makan</label>
                                <input type="number" name="eat" id="eat" value="{{ old('eat', $paymentUser->eat) }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Biaya Makan">
                        </div>                                
                        <div class="mr-2">
                                 <label for="laundry" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Laundry</label>
                                <input type="number" name="laundry" id="laundry" value="{{ old('laundry', $paymentUser->laundry) }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Biaya Laundry">
                        </div>                            
                        @endif       
                        
                     
                      
                        </div>    

                        
                    </div>
                   
                    
                  
                    </div>
                     
                    </div>
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                        <button type="submit" class="w-full text-white bg-blue-800 hover:bg-blue-500 focus:ring-4 focus:ring-gray-300 font-medium rounded-3xl text-sm px-5 py-2.5 text-center dark:bg-gray-500 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                        <i class="fas fa-save mr-2"></i>Update</button>
                        </div>
                    </div>
                  
                      
                       

                        </div>
                    </div>
                    <!--/table Card-->
                    
                     </form>
                </div>

            </div>

        </div>

    </div>

@endsection
