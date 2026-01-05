@extends ('layouts.app', ['title' => 'ticash | Payment'])

@section('content')

        <!-- Navbar -->
       @include('navbar.finance')
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
                                <h5 class="text-gray-500"> 

                                
                                </h5>
                               
                            </div>

                            <div class="flex">
                               
                              
                                    
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

                   
                    </div>

                      
                        <div class="p-5">
                            <table class="w-full p-5 text-gray-600 text-sm">
                                <thead class="bg-gray-200">
                                 
                                    <tr>
                                        <th class="text-left text-gray-600 text-sm p-1">No</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Institution</th>
                                        
                                        <th class="text-left text-gray-600 text-sm p-1">Biaya</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Amount</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Sequence</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Bayar</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Sisa</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Status</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody class="bg-gray-200">
                                @forelse($payments as $no => $payment)
                                <tr class="border bg-white">
                                    <th scope="row" class=" text-left p-1">{{ ++$no + ($payments->currentPage()-1) * $payments->perPage() }}</th>
                                    <td class=" text-left p-1">{{ $payment->institution->institution_name }}</td>
                                    
                                    <td class=" text-left p-1">{{ $payment->description }}</td>
                                    <td class=" text-left p-1">{{ moneyFormat($payment->amount) }}</td>
                                    <td class=" text-left p-1">{{ $payment->sequence }}</td>
                                    <td class=" text-left p-1">{{ $payment->paid }}</td>
                                    @if($payment->unpaid == '0')
                                        <td class=" text-left text-green p-1">Lunas</td>
                                    @else
                                    <td class=" text-left p-1">{{ $payment->unpaid }}</td>
                                    @endif
                                    <td class=" text-left p-1">{{ $payment->status }}</td>
                                   
                                    <td class="px-5 py-1 text-center">
                                  
                                        @can('payments.edit')
                                        <a href="{{ route('admin.paymentUser.show', $payment->id) }}" class="bg-gray-500 px-2 py-0.5 rounded shadow-sm text-xs text-white focus:outline-none">
                                        <i class="fas fa-edit text-center"></i></a>
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
                            @if ($payments->hasPages())
                                <div class="bg-white p-3">
                                    {{ $payments->links('pagination::tailwind') }}
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


   
    <script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>

    <!-- End Modal Create -->

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
                    url: `/admin/payment/${id}`,
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
