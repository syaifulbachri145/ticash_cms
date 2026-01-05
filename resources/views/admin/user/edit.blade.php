@extends ('layouts.app', ['title' => 'User - Update'])

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
                        <h3 class="text-xl font-medium text-gray-900 dark:text-white">Edit User Form</h3>
                        </div>
                        <div class="p-5">
                        <form class="space-y-6 px-6 lg:px-8 pb-4 sm:pb-6 xl:pb-8" action="{{ route('admin.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="grid gap-1 grid-cols-3 grid-rows-1">
                            <div class="mr-2">
                                <label for="name" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Your Name" required="">
                                @error('name')
                                    <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                        <div class="px-4 py-2">
                                            <p class="text-gray-600 text-sm">{{ $message }}</p>
                                        </div>
                                    </div>
                                @enderror
                            </div>
                            <div class="mr-2">
                                <label for="image" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Image</label>
                                <input type="file" name="image" id="image" value="" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">

                            </div>

                              <div class="mr-2">
                                <label for="degree_id" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Class</label>
                                <select name="degree_id" id="degree_id" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                        
                                        @if($user->degree_id == '')
                                            <option value="{{ $user->degree_id}}">Pilih Kelas</option>
                                        @else
                                        <option value="{{ $user->degree_id}}">{{ $user->degree->degree_name}}</option>
                                        
                                        @endif
                                        
                                        @foreach ($degrees as $degree)
                                        <option value="{{ $degree->id}}">{{ $degree->degree_name}}</option>
                                        @endforeach
                                </select>
                            </div>
                           
                        </div>
                       

                        <div class="grid gap-1 grid-cols-3 grid-rows-1">
                            <div class="mr-2">
                                <label for="dob" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">DOB</label>
                                <input type="date" name="dob" value="{{ old('dob', $user->dob) }}" id="dob" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="email address" required="">
                                @error('dob')
                                    <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                        <div class="px-4 py-2">
                                            <p class="text-gray-600 text-sm">{{ $message }}</p>
                                        </div>
                                    </div>
                                @enderror
                            </div>
                          
                          @if(Auth()->user()->access_id == '1')
                            <div class="mr-2">
                                <label for="access_id" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Access</label>
                                <select name="access_id" id="access_id" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                        <option value="{{ $user->access_id}}">{{ $user->access->access_name}}</option>
                                        @foreach ($accesses as $access)
                                        <option value="{{ $access->id}}">{{ $access->access_name}}</option>
                                        @endforeach
                                </select>
                            </div>

                            @else
                             <input type="hidden" name="access_id" id="access_id" value="{{ old('access_id', $user->access_id) }}">
                          @endif
                            
                            <div class="mr-2">
                                <label for="phone" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Phone Number</label>
                                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Phone Number" required="">
                                @error('phone')
                                    <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                        <div class="px-4 py-2">
                                            <p class="text-gray-600 text-sm">{{ $message }}</p>
                                        </div>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="grid gap-1 grid-cols-3 grid-rows-1">
                            <div class="mr-2">
                            <label for="institution_id" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Institution</label>
                            <select name="institution_id" id="institution_id" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                    <option value="{{ $user->institution_id}}">{{ $user->institution->institution_name}}</option>
                                    @foreach ($institutions as $institution)
                                    <option value="{{ $institution->id}}">{{ $institution->institution_name}}</option>
                                    @endforeach
                            </select>
                            </div>
                            <div class="mr-2">
                                <label for="password" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Password</label>
                                <input type="password" name="password" value="{{ old('password') }}" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Insert Password">

                            </div>
                            <div class="mr-2">
                                <label for="password_confirmation" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Password Confirmation</label>
                                <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" id="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Passowrd Confirmation">
                            </div>
                           

                        </div>

                        <div class="grid gap-1 grid-cols-3 grid-rows-1">
                            <div class="mr-2">
                                <label for="va_number" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">VA Number</label>
                                <input type="number" name="va_number" value="{{ old('va_number', $user->va_number) }}" id="nik" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Address" required="">
                                @error('va_number')
                                    <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                        <div class="px-4 py-2">
                                            <p class="text-gray-600 text-sm">{{ $message }}</p>
                                        </div>
                                    </div>
                                @enderror
                            </div>

                            <div class="mr-2">
                                <label for="card_number" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Card Number</label>
                                <input type="number" name="card_number" value="{{ old('card_number', $user->card_number) }}" id="card_number" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Card Number" required="">
                                @error('card_number')
                                    <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                        <div class="px-4 py-2">
                                            <p class="text-gray-600 text-sm">{{ $message }}</p>
                                        </div>
                                    </div>
                                @enderror
                            </div>
                            <div class="mr-2">
                                <label for="pin_number" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">PIN</label>
                                <input type="password" name="pin_number" value="{{ old('pin_number', $user->pin_number) }}" id="pin_number" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="PIN" required="">
                                @error('pin_number')
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
                                <label for="address" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Address</label>
                                <input type="text" name="address" value="{{ old('address', $user->address) }}" id="nik" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Address" required="">
                                @error('address')
                                    <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                        <div class="px-4 py-2">
                                            <p class="text-gray-600 text-sm">{{ $message }}</p>
                                        </div>
                                    </div>
                                @enderror
                            </div>
                            <div class="mr-5">
                                <label for="status" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Status</label>
                                <select name="status" id="status" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                        <option value="{{ $user->status}}">{{ $user->status}}</option>
                                        <option value="active">active</option>
                                        <option value="non active">non active</option>
                                       
                                </select>
                            </div>
                           
                        </div>


                            @if(Auth()->user()->access_id == '1')
                                <div>
                                    <label for="permission" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Role Id Test</label>

                                    @foreach ($roles as $role)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="role[]" value="{{ $role->name }}" id="check-{{ $role->id }}"  {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="check-{{ $role->id }}">
                                                {{ $role->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

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
