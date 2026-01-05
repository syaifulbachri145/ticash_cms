@extends ('layouts.app', ['title' => 'Transaction Category'])

@section('content')


        <!-- Navbar -->
        @include('navbar.master')
        <!-- end Navbar -->

        <!--Graph Content -->
        <div id="main-content" class="w-full flex-1">

            <div class="flex flex-col w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-xl shadow-xl mt-6">

                <form class="space-y-6 px-6 lg:px-8 pb-4 sm:pb-6 xl:pb-8" action="{{ route('admin.transactionCategory.update', $transactionCategory->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                <div class="w-full p-3">
                    <!--Table Card-->
                    <div class="bg-white border rounded-xl shadow">
                        <div class="border-b p-3">
                        <h3 class="text-xl font-medium text-gray-900 dark:text-white">Edit Transaction Category Form</h3>
                        </div>
                        <div class="p-5">
                       
                        <div class="grid gap-1 grid-cols-2 grid-rows-1">
                         <div class="mr-7">
                            <label for="coa_id" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">COA Id</label>
                            <input type="text" name="coa_id" id="coa_id" value="{{ old('coa_id',$transactionCategory->coa_id) }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="coa_id" required="">
                            @error('coa_id')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>
                        <div class="mr-7">
                            <label for="description" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Description</label>
                            <input type="text" name="description" id="description" value="{{ old('description',$transactionCategory->description) }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Description" required="">
                            @error('description')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>
                         <div class="mr-5">
                                <label for="is_hidden" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Hidden</label>
                                <select name="is_hidden" id="is_hidden" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                        <option value="{{ $transactionCategory->is_hidden}}">{{ $transactionCategory->is_hidden}}</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                       
                                </select>
                        </div>
                        <div class="mr-5">
                                <label for="status" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Status</label>
                                <select name="status" id="status" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                        <option value="{{ $transactionCategory->status}}">{{ $transactionCategory->status}}</option>
                                        <option value="active">active</option>
                                        <option value="non active">non active</option>
                                       
                                </select>
                        </div>

                    </div>
                    </div>
                  
                        <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                       
                        </div>
                       

                        </div>
                    </div>
                    <!--/table Card-->
                     <button type="submit" class="w-full text-white bg-blue-800 hover:bg-blue-500 focus:ring-4 focus:ring-gray-300 font-medium rounded-2xl text-sm px-5 py-2.5 text-center dark:bg-gray-500 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                        <i class="fas fa-save mr-2"></i>Update</button>
                     </form>
                </div>

            </div>

        </div>

    </div>





@endsection
