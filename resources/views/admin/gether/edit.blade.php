@extends ('layouts.app', ['title' => 'ticash | Gether'])

@section('content')

        <!-- Navbar -->
       @include('navbar.saving')
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
                                    <div class="p-4">
                                    <h5 class="text-gray-500"> 
                                    Gether Balance:  <strong>{{moneyFormat($getherBalance)}} </strong>
                                    </h5>
                               
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
                                <div>
                                   
                                 
                                    <form action="{{ route('admin.member.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="grid gap-1 grid-cols-2 grid-rows-1">
                                        <div>

                                        <input type="hidden" name="gether_id" id="gether_id" value="{{ old('gether_id', $gether->id) }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                        <select name="user_id" id="user_id" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                        @foreach ($users as $usr)
                                        <option value="{{ $usr->id}}"><strong>{{ $usr->name}}</strong> | {{ $usr->phone}}</option>
                                        @endforeach
                                        </select>
                                        </div>
                                        <div class="ml-4">
                                        <button data-modal-toggle="create-modal" class="text-white focus:outline-none bg-gray-600 hover:bg-gray-500 px-2 py-1 shadow-sm rounded-2xl">
                                        <i class="fas fa-plus"></i> Add Member
                                        </button>
                                        </div>                                    
                                   
                                    </form>

                                    </div>
                                </div>
                            </div>

                            <div class="w-full p-3">
                                <!--Table Card-->
                                <div class="bg-white border rounded shadow">
                                   
                                    <div class="p-5">
                                        <table class="w-full p-5 text-gray-700 text-sm">
                                            <thead class="bg-gray-200">
                                                <tr>
                                                    <th class="text-left text-gray-700 text-sm p-1">No</th>
                                                    <th class="text-left text-gray-700 text-sm p-1">Name</th>
                                                    <th class="text-left text-gray-700 text-sm p-1">Amount</th>
                                                    <th class="text-left text-gray-700 text-sm p-1">Status</th>
                                                    <th class="text-center text-gray-700 text-sm p-1">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody class="bg-gray-200">
                                            @forelse($getherMembers as $no => $member)
                                            <tr class="border bg-white">
                                                <th scope="row" class=" text-left p-1">{{ ++$no + ($getherMembers->currentPage()-1) * $getherMembers->perPage() }}</th>
                                                <td class=" text-left p-1">{{ $member->user->name }}</td>
                                                <td class=" text-left p-1">{{ moneyFormat ($member->amount) }}</td>
                                                <td class=" text-left p-1">{{ $member->status }}</td>
                                                <td class="px-5 py-1 text-center">

                                                    @can('getherMembers.delete')
                                                    <button onClick="destroy(this.id)" id="{{ $member->id }}" class="bg-yellow-500 px-2 py-1 rounded shadow-sm text-xs text-white focus:outline-none fas fa-trash-alt"></button>
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
                                        @if ($getherMembers->hasPages())
                                            <div class="bg-white p-3">
                                                {{ $getherMembers->links('pagination::tailwind') }}
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
                            <h5 class="font-bold text-gray-600">Gether</h5>
                        </div>
                        <div class="p-3">

                            <div class="bg-white border rounded shadow">
                            <div class="p-1">
                            <form class="space-y-6 px-6 lg:px-8 pb-4 sm:pb-6 xl:pb-8" action="{{ route('admin.gether.update', $gether->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                  

                    <div class="grid gap-1 grid-cols-1 grid-rows-1">
                        <div>
                        <img src="{{ $user->avatar }}" class="w-30 h-20 mr-4 rounded">
                        </div>
                    </div>
                    <div class="grid gap-1 grid-cols-2 grid-rows-1">
                        <div class="mr-2">
                        <input type="hidden" name="user_id" id="user_id" value="{{ old('user_id',$user->id) }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="id" required="">
                            <label for="name" class="text-md font-large text-gray-700 block mb-2 dark:text-gray-300">{{$user->name}}</label>
                        </div>
                        
                        <div class="mr-2">
                            <label for="balance" class="text-md font-large text-gray-700 block mb-2 dark:text-gray-300">Balance: <br> <strong>{{moneyFormat($user->balance)}}</strong></label>  
                        </div>
                    </div>
                  
                    <div class="grid gap-1 grid-cols-1 grid-rows-1">
                        <div class="mr-2">
                            <label for="amount" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Amount</label>
                            <input type="number" name="amount" id="amount" value="{{ old('amount') }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Amount" autoFocus required="">
                            @error('amount')
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
                            <label for="description" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Title</label>
                            <input type="text" name="description" id="description" value="{{ old('description', $gether->description) }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Amount" autoFocus required="">
                            @error('description')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>     
                        <div class="mr-2">
                            <label for="goal" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Goal</label>
                            <input type="text" name="goal" id="goal" value="{{ old('goal', $gether->goal) }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Amount" autoFocus required="">
                            @error('goal')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>     
                        <div class="mr-2">
                            <label for="deadline" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Deadline</label>
                            <input type="date" name="deadline" id="deadline" value="{{ old('deadline', $gether->deadline) }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Amount" autoFocus required="">
                            @error('deadline')
                                <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                    <div class="px-4 py-2">
                                        <p class="text-gray-600 text-sm">{{ $message }}</p>
                                    </div>
                                </div>
                            @enderror
                        </div>                     
                    </div>

                    </div>
                        <button type="submit" class="mt-5 w-full text-white bg-blue-800 hover:bg-blue-500 focus:ring-4 focus:ring-gray-300 font-medium text-sm px-5 py-2.5 text-center dark:bg-gray-500 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
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
                    url: `/admin/member/${id}`,
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
