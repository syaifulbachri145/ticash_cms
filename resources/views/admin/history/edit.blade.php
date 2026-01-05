@extends ('layouts.app', ['title' => 'History - Update'])

@section('content')


        <!-- Navbar -->
        @include('navbar.transaction')
        <!-- end Navbar -->

        <!--Graph Content -->
        <div id="main-content" class="w-full flex-1">

            <div class="flex flex-col w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-lg shadow-xl mt-6">

            <div class="w-full p-3">
                    <!--Table Card-->
                    <div class="bg-white border rounded shadow">
                        <div class="border-b p-3">
                        <h3 class="text-xl font-medium text-gray-900 dark:text-white">Detail Transaction</h3>
                        </div>
                        <div class="p-5">
                                                                       
                    </div>
                    <div class="bg-white p-4">
                    <div class="grid gap-2 grid-cols-3 grid-rows-1">
                        <div>
                        <img src="{{ $history->user->avatar }}" class="w-30 h-20 mr-4 rounded">
                        </div>
                        <div >
                            <label for="shared_fee" class="text-md font-large text-gray-700 block mb-2 dark:text-gray-300">Balance <br>
                            <i class="text-lg font-large font-bold text-gray-600 block mb-2 dark:text-gray-300">{{ moneyFormat($history->user->balance) }}</i></label>  
                        </div>
                    </div>


                    <div class="grid gap-1 grid-cols-2 mt-4 mb-5 grid-rows-1">
                        <div class="mr-2">
                            <label for="shared_fee" class="text-md font-large text-gray-700 block mb-2 dark:text-gray-300">{{$history->user->name}}</label>
                        </div>
                        
                    </div>

                    <div class="grid gap-1 grid-cols-3 mb-5 grid-rows-1">
                        
                        <div class="mr-2">
                            <label for="shared_fee" class="text-md font-large text-gray-700 block mb-2 dark:text-gray-300">INV: {{$history->no_trans}}</label>
                        </div>
                        
                        <div class="mr-2">
                            <label for="shared_fee" class="text-md font-large text-gray-700 block mb-2 dark:text-gray-300">Amount: {{$history->amount}}</label>  
                        </div>
                        <div class="mr-2">
                            <label for="shared_fee" class="text-md font-large text-gray-700 block mb-2 dark:text-gray-300">Des: {{$history->description}}</label>  
                        </div>

                    </div>

                    <div class="grid gap-1 grid-cols-1 grid-rows-1">
                       
                        <a href="{{ route('admin.history.index') }}"
                        class="btn w-full text-white bg-blue-800 hover:bg-blue-500 focus:ring-4 focus:ring-gray-300 font-medium rounded-2xl text-sm px-5 py-2.5 text-center dark:bg-gray-500 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                        <span class="pb-1 md:pb-0 text-sm"><i class="fas fa-save mr-2"></i>Back</span>
                        </a>
                                               
                      
                    </div>
                    <!--/table Card-->
                    </div>
                </div>

            </div>

        </div>

   


@endsection
