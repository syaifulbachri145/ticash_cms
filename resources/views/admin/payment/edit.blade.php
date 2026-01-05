@extends ('layouts.app', ['title' => 'ticash | Payment'])

@section('content')

        <!-- Navbar -->
       @include('navbar.finance')
        <!-- end Navbar -->

        <!--Graph Content -->
        <div id="main-content" class="w-full flex-1">

            <div class="flex flex-col w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-xl shadow-xl mt-6">

                <form class="space-y-6 px-6 lg:px-8 pb-4 sm:pb-6 xl:pb-8" action="{{ route('admin.payment.update', $payment->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="w-full p-3">
                    <!--Table Card-->
                    <div class="bg-white border rounded-xl shadow">
                        <div class="border-b p-3">
                        <h3 class="text-xl font-medium text-gray-900 dark:text-white">Edit Biaya</h3>
                        </div>
                        <div class="p-5">
                       
                         <div class="grid gap-1 grid-cols-2 grid-rows-1">
                     <div class="mr-2">
                            <label for="title" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Nama Biaya</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $payment->title) }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Title" required="">
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
                            <input type="number" name="amount" id="amount" value="{{ old('amount', $payment->amount) }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Amount" required="">
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
                                    <option value="{{ $payment->transaction_category_id}}">{{ $payment->transaction_category->description}}</option>
                                    @foreach ($transactionCategories as $transactionCategory)
                                    <option value="{{ $transactionCategory->id}}">{{ $transactionCategory->description}}</option>
                                    @endforeach
                            </select>
                        </div>   
                        <div class="mr-2">
                            <label for="type" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Tipe</label>
                            <select name="type" id="type" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                    <option value="{{ $payment->type}}">{{ $payment->type}}</option>
                                    <option value="public">Public</option>
                                    <option value="private">Private</option>
                                   
                            </select>
                        </div> 

                         <div class="mr-2">
                            <label for="year" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Tahun</label>
                            <select name="year" id="year" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                   <option value="{{ $payment->year}}">{{ $payment->year}}</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                   
                            </select>
                        </div> 

                          <div class="mr-2">
                            <label for="sequence" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Sequence</label>
                            <select name="sequence" id="sequence" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
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
                            <label for="is_tuition_fee" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Apakah SPP</label>
                           
                            <div>
                                <input type="radio" id="yes" name="is_tuition_fee" value="yes"  {{ old('yes', $payment->is_tuition_fee) == 'yes' ? 'checked' : '' }}>
                                <label for="yes" class="mr-2">Ya</label> 

                                <input type="radio" id="no" name="is_tuition_fee" value="no" {{ old('no', $payment->is_tuition_fee) == 'no' ? 'checked' : '' }}>
                                <label for="no">Tidak</label>

                                <div class="show-only-if-yes-is-checked form-group row mt-2">

                                <label for="tuition_fee" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">SPP</label>
                                <input type="number" name="tuition_fee" id="tuition_fee" value="{{ old('tuition_fee', $payment->tuition_fee) }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Biaya SPP">
                                

                                 <label for="eat" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Makan</label>
                                <input type="number" name="eat" id="eat" value="{{ old('eat', $payment->eat) }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Biaya Makan">
                               

                                 <label for="laundry" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Laundry</label>
                                <input type="number" name="laundry" id="laundry" value="{{ old('laundry', $payment->laundry) }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Biaya Laundry">
                              

                            </div>
                        </div>

                        </div>    

                        
                    </div>
                    <div class="grid gap-1 grid-cols-1 grid-rows-1">
                        <div class="mr-2">
                            <label for="description" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Deskripsi</label>
                            <input type="text" name="description" id="description" value="{{ old('description',$payment->description) }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-2xl focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Description" required="">
                            @error('description')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>                       
                    </div>
                    
                  
                    </div>
                        
                    </div>
                    </div>
                  
                        <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                        <button type="submit" class="w-full text-white bg-blue-800 hover:bg-blue-500 focus:ring-4 focus:ring-gray-300 font-medium rounded-2xl text-sm px-5 py-2.5 text-center dark:bg-gray-500 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                        <i class="fas fa-save mr-2"></i>Update</button>
                        </div>
                       

                        </div>
                    </div>
                    <!--/table Card-->
                    
                     </form>
                </div>

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



@endsection
