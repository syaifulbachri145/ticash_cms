@extends ('layouts.app', ['title' => 'Topup - Update'])

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
                        <h3 class="text-xl font-medium text-gray-900 dark:text-white">Update Topup Form</h3>
                        </div>
                        <div class="p-5">
                        <form class="space-y-6 px-6 lg:px-8 pb-4 sm:pb-6 xl:pb-8" action="{{ route('admin.topup.update', $topup->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                                                  
                    </div>

                    <div class="grid gap-1 grid-cols-3 grid-rows-1">
                    <div class="mr-2">
                            <label for="shared_fee" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">{{$topup->user->name}}</label>
                           
                        </div>
                        
                        <div class="mr-2">
                            <label for="shared_fee" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">{{$topup->amount}}</label>
                           
                        </div>

                    </div>

                    <div class="grid gap-1 grid-cols-1 grid-rows-1">
                        
                        <div class="mr-2">
                                <label for="status" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Status</label>
                                <select name="status" id="status" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                        <option value="{{ $topup->status}}">{{ $topup->status}}</option>
                                        <option value="processing">Processing</option>
                                        <option value="pending">Pending</option>
                                       
                                </select>
                        </div>

                    </div>
                        <button type="submit" class="w-full text-white bg-yellow-600 hover:bg-yellow-500 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-500 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                        <i class="fas fa-save mr-2"></i>Update</button>
                        <div class="text-sm font-medium text-gray-500 dark:text-gray-300">

                        </div>
                        </form>

                        </div>
                    </div>
                    <!--/table Card-->
                </div>

            </div>

        </div>

    </div>


@endsection
