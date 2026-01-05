@extends ('layouts.app', ['title' => 'User - Admin'])

@section('content')

        <!-- Navbar -->
       @include('navbar.master')
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
                                @can('users.create')
                                <button data-modal-toggle="create-modal" class="text-blue-800 text-md focus:outline-none bg-white hover:bg-gray-100 px-2 py-0.5 shadow-sm rounded-2xl">
                                    <i class="fas fa-plus"></i> Add New User
                                    </button>
                                @endcan
                            </div>

                            <div class="flex">
                               
                                <div class="relative pull-right pl-4 pr-8 md:pr-20">
                                    <form action="{{ route('admin.user.index') }}" method="GET">
                                    <input type="search" name="q" value="{{ request()->query('q') }}" placeholder="Search" class="w-full bg-white-700 text-sm text-gray-800 transition border focus:outline-none focus:border-gray-700 rounded-2xl py-1 px-7 pl-20 appearance-none leading-normal">
                                    </form>
                                    
                                    <div class="absolute search-icon" style="top: 0.375rem;left: 1.75rem;">
                                        <svg class="fill-current pointer-events-none text-gray-800 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path>
                                        </svg>
                                    </div>
                                </div>



                                <form action="{{ route('admin.userImport.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                    
                                    <input type="file" name="file" class="bg-gray-50 border border-gray-300 rounded-lg">

                                    <button class="text-white ml-3 focus:outline-none bg-gray-600 hover:bg-gray-500 px-2 py-0.5 shadow-sm rounded-2xl">
                                    <i class="fas fa-file"></i> Import
                                    </button>
                               
                                </form>

                                 <a class="ml-3 text-white focus:outline-none bg-yellow-600 hover:bg-yellow-500 px-2 py-0.5 shadow-sm rounded-2xl" href="{{ route('admin.userReport.index') }}">
                                 <i class="fa fa-download"></i> Export</a>


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
                    <div class="bg-white border rounded shadow">
                      
                        <div class="p-5">
                            <table class="w-full p-5 text-gray-600 text-sm">
                                <thead class="bg-gray-200">
                                    
                                    <tr>
                                        <th class="text-left text-gray-600 text-sm p-1">No</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Institution</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Image</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Name</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Balance</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Email</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Role</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Status</th>
                                        <th class="text-center text-gray-600 text-sm p-1">Action</th>
                                    </tr>
                                </thead>

                                <tbody class="bg-gray-200">
                                @forelse($users as $no => $user)
                                <tr class="border bg-white">
                                    <th scope="row" class=" text-left p-1">{{ ++$no + ($users->currentPage()-1) * $users->perPage() }}</th>
                                    <td class=" text-left p-1">{{ $user->institution->institution_name }}</td>
                                    <td class=" text-left p-1">
                                        <img src="{{ $user->avatar }}" class="w-8 h-8 mr-4 rounded" style="width: 35%">
                                    </td>
                                    <td class=" text-left p-1">{{ $user->name }}</td>
                                    <td class=" text-left p-1">{{ moneyFormat($user->balance) }}</td>
                                    <td class=" text-left p-1">{{ $user->email }}</td>
                                    <td class=" text-left p-2">
                                        @if(!empty($user->getRoleNames()))
                                            @foreach($user->getRoleNames() as $role)
                                                <label class="badge badge-success">{{ $role }}</label>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class=" text-left p-1">{{ $user->status }}</td>
                                    <td class="px-5 py-1 text-center">
                                  
                                        @can('users.edit')
                                        <a href="{{ route('admin.user.edit', $user->id) }}" class="bg-gray-500 px-2 py-0.5 rounded shadow-sm text-xs text-white focus:outline-none">
                                        <i class="fas fa-edit text-center"></i></a>
                                        @endcan
                                        
                                        @can('users.delete')
                                        <button onClick="destroy(this.id)" id="{{ $user->id }}" class="bg-yellow-500 px-2 py-1 rounded shadow-sm text-xs text-white focus:outline-none fas fa-trash-alt"></button>
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
                            @if ($users->hasPages())
                                <div class="bg-white p-3">
                                    {{ $users->links('pagination::tailwind') }}
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
        <div class="flex flex-col w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-lg border border-gray-300 shadow-xl">
            <!-- <div class="relative w-full max-w-md px-4 h-full md:h-auto"> -->
            <!-- Modal content -->
            <div class="bg-white rounded-lg shadow relative dark:bg-gray-700">
                <div class="flex justify-end p-2 border-b">
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">Add User Form</h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="create-modal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>
                <form class="space-y-6 px-6 lg:px-8 pb-4 sm:pb-6 xl:pb-8" action="{{ route('admin.user.store')}}" method="POST" enctype="multipart/form-data">
                @csrf

                    <div class="grid gap-1 grid-cols-3 grid-rows-1">
                        <div class="mr-2">
                            <label for="name" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Your Name" required="">
                            @error('name')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>
                        <div class="mr-2">
                            <label for="institution_id" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Institution</label>
                            <select name="institution_id" id="institution_id" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                    @foreach ($institutions as $institution)
                                    <option value="{{ $institution->id}}">{{ $institution->institution_name}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="mr-2">
                            <label for="image" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Image</label>
                            <input type="file" name="image" id="image" value="" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Your Name" required="">
                            @error('image')
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
                            <label for="dob" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">DOB</label>
                            <input type="date" name="dob" value="{{ old('dob') }}" id="dob" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="email address" required="">
                            @error('dob')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>
                        <div class="mr-2">
                            <label for="access_id" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Access</label>
                            <select name="access_id" id="access_id" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                    @foreach ($accesses as $access)
                                    <option value="{{ $access->id}}">{{ $access->access_name}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="mr-2">
                            <label for="phone" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Phone Number</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Phone Number" required="">
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
                            <label for="email" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="email address" required="">
                            @error('email')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>
                        <div class="mr-2">
                            <label for="password" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Password</label>
                            <input type="password" name="password" value="{{ old('password') }}" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Insert Password" required="">
                            @error('password')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>
                        <div class="mr-2">
                            <label for="password_confirmation" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Password Confirmation</label>
                            <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" id="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Passowrd Confirmation" required="">
                            @error('password_confirmation')
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
                                <label for="va_number" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">VA Number</label>
                                <input type="number" name="va_number" value="{{ old('va_number') }}" id="va_number" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="va Number" required="">
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
                                <input type="number" name="card_number" value="{{ old('card_number') }}" id="card_number" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Card Number" required="">
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
                                <input type="password" name="pin_number" value="{{ old('pin_number') }}" id="pin_number" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="PIN" required="">
                                @error('pin_number')
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
                            <label for="address" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Address</label>
                            <input type="text" name="address" value="{{ old('address') }}" id="nik" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Address" required="">
                            @error('nik')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>
                    </div>

                   

                    <button type="submit" class="w-full text-white bg-blue-800 hover:bg-blue-500 focus:ring-4 focus:ring-gray-300 font-medium rounded-2xl text-sm px-5 py-2.5 text-center dark:bg-gray-500 dark:hover:bg-gray-600 dark:focus:ring-gray-700">Save</button>
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-300">

                    </div>
                    </div>
                </form>
           
        </div>
    </div>
    <script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>

    <!-- End Modal Create -->

<script>
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    /*  When user click add user button */
    $('#create-new-user').click(function () {
        $('#btn-save').val("create-user");
        $('#userForm').trigger("reset");
        $('#userCrudModal').html("Add New User");
        $('#ajax-crud-modal').modal('show');
    });

   /* When click edit user */
    $('body').on('click', '#edit-user', function () {
      var user_id = $(this).data('id');
      $.get('ajax-crud/' + user_id +'/edit', function (data) {
         $('#userCrudModal').html("Edit User");
          $('#btn-save').val("edit-user");
          $('#ajax-crud-modal').modal('show');
          $('#user_id').val(data.id);
          $('#name').val(data.name);
          $('#email').val(data.email);
      })
   });

   //delete user login
    $('body').on('click', '.delete-user', function () {
        var user_id = $(this).data("id");
        confirm("Are You sure want to delete !");

        $.ajax({
            type: "DELETE",
            url: "{{ url('ajax-crud')}}"+'/'+user_id,
            success: function (data) {
                $("#user_id_" + user_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
  });

 if ($("#userForm").length > 0) {
      $("#userForm").validate({

     submitHandler: function(form) {

      var actionType = $('#btn-save').val();
      $('#btn-save').html('Sending..');

      $.ajax({
          data: $('#userForm').serialize(),
          url: "https://www.tutsmake.com/laravel-example/ajax-crud/store",
          type: "POST",
          dataType: 'json',
          success: function (data) {
              var user = '<tr id="user_id_' + data.id + '"><td>' + data.id + '</td><td>' + data.name + '</td><td>' + data.email + '</td>';
              user += '<td><a href="javascript:void(0)" id="edit-user" data-id="' + data.id + '" class="btn btn-info">Edit</a></td>';
              user += '<td><a href="javascript:void(0)" id="delete-user" data-id="' + data.id + '" class="btn btn-danger delete-user">Delete</a></td></tr>';


              if (actionType == "create-user") {
                  $('#users-crud').prepend(user);
              } else {
                  $("#user_id_" + data.id).replaceWith(user);
              }

              $('#userForm').trigger("reset");
              $('#ajax-crud-modal').modal('hide');
              $('#btn-save').html('Save Changes');

          },
          error: function (data) {
              console.log('Error:', data);
              $('#btn-save').html('Save Changes');
          }
      });
    }
  })
}


</script>
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
                    url: `/admin/user/${id}`,
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
