@extends ('layouts.app', ['title' => 'Institution - Update'])

@section('content')


        <!-- Navbar -->
        @include('navbar.master')
        <!-- end Navbar -->

        <!--Graph Content -->
        <div id="main-content" class="w-full flex-1">

            <div class="flex flex-col w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-lg shadow-xl mt-6">

                <div class="w-full p-3">
                    <!--Table Card-->
                    <div class="bg-white border rounded shadow">
                        <div class="border-b p-3">
                        <h3 class="text-xl font-medium text-gray-900 dark:text-white">Edit Merchant Form</h3>
                        </div>
                        <div class="p-5">
                        <form class="space-y-6 px-6 lg:px-8 pb-4 sm:pb-6 xl:pb-8" action="{{ route('admin.merchant.update', $merchant->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                        <div class="grid gap-1 grid-cols-3 grid-rows-1">
                        <div class="mr-2">
                            <label for="merchant_name" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Merchant Name</label>
                            <input type="text" name="merchant_name" id="merchant_name" value="{{ old('merchant_name',$merchant->merchant_name) }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Merchant Name" required="">
                            @error('merchant_name')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>
                        <div class="mr-2">
                            <label for="user_id" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">User</label>
                            <select name="user_id" id="user_id" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                    <option value="{{ $merchant->user->id}}">{{ $merchant->user->name}}</option> 
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id}}">{{ $user->name}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="mr-2">
                            <label for="image" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Image</label>
                            <input type="file" name="image" id="image" value="" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Your Name">
                           
                        </div>
                       
                    </div>

                    <div class="grid gap-1 grid-cols-3 grid-rows-1">
                    <div class="mr-2">
                            <label for="no_ktp" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">No KTP</label>
                            <input type="number" name="no_ktp" value="{{ old('no_ktp',$merchant->no_ktp) }}" id="no_ktp" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="No KTP" required="">
                            @error('no_ktp')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>
                        <div class="mr-2">
                            <label for="description" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Description</label>
                            <input type="text" name="description" value="{{ old('description',$merchant->description)}}" id="description" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Description" required="">
                            @error('description')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>
                        <div class="mr-2">
                                <label for="status" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Access</label>
                                <select name="status" id="status" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                        <option value="{{ $merchant->status}}">{{ $merchant->status}}</option>
                                        <option value="active">active</option>
                                        <option value="non active">non active</option>
                                       
                                </select>
                        </div>

                    </div>


                    <button type="submit" class="w-full text-white bg-blue-800 hover:bg-blue-500 focus:ring-4 focus:ring-gray-300 font-medium rounded-2xl text-sm px-5 py-2.5 text-center dark:bg-gray-500 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
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



    <!-- End Modal -->

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
                    url: `/admin/role/${id}`,
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
