@extends ('layouts.app', ['title' => 'ticash | Dashboard'])

@section('content')


<!-- Navbar -->
<div class="bg-white-700 pl-2 md:pl-10 w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block mt-2 lg:mt-2 z-10 border-blue-600"
    id="nav-content">

    <ul class="list-reset lg:flex flex-1 items-center px-4 md:px-0">

        <li class="mr-6 my-2 md:my-0">
            <a href="#"
                class="block py-1 md:py-3 pl-1 align-middle text-blue-600 no-underline hover:text-blue-600 border-b-2 border-blue-600 hover:border-blue-600">
                <span class="pb-1 md:pb-0 text-sm">Dashboard</span>
            </a>
        </li>


    </ul>

    <div class="relative pull-right pl-4 pr-8 md:pr-20">
        <button class="text-white focus:outline-none bg-blue-600 hover:bg-blue-500 px-2 py-1 shadow-sm rounded-2xl">
        <i class="fas fa-wallet"></i> {{moneyFormat(Auth()->user()->balance)}}
        </button>
    </div>

    </div>

</div>
</nav>
</div>
<!-- end Navbar -->

<!--Graph Content -->
<div id="main-content" class="w-full flex-1">

    <div class="flex flex-1 flex-wrap">

        <div class="w-full xl:w-2/3 p-6 xl:max-w-6xl">

            <!--"Container" for the graphs"-->
            <div class="max-w-full lg:max-w-3xl xl:max-w-5xl">

                <!--Table Card-->
                <div class="p-3">
                    <div class="border-b p-3">
                        <h5 class="font-bold text-black">Transaksi</h5>
                    </div>
                </div>

                <div class="grid grid-cols-12 md:grid-cols-12 items-center gap-4">

                    <div class="col-span-6 md:col-span-6">
                        <div class="bg-white border rounded shadow">

                            <div class="p-5">
                                <h4 class="font-bold text-black">Profit</h4>
                                <h1> {{ moneyFormat($bill) }}</h1>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-6 md:col-span-6">
                        <div class="bg-white border rounded shadow">

                            <div class="p-5">
                                <h4 class="font-bold text-black">Invoice</h4>

                                    <h1> 
                                    {{ moneyFormat($invoice) }}</h1>                                

                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-12 md:grid-cols-12 items-center mt-3 gap-4">
                <div class="col-span-4 md:col-span-4">
                        <div class="bg-white border rounded-2xl shadow">

                            <div class="p-5">
                                <h4 class="font-bold text-black">Saldo User</h4>
                                <h1>{{ moneyFormat($userBalance) }}</h1>
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-4 md:col-span-4">
                        <div class="bg-white border rounded-2xl shadow">

                            <div class="p-5">
                                <h4 class="font-bold text-black">Saldo Institusi</h4>
                                <h1>{{ moneyFormat($institutionBalance) }}</h1>
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-4 md:col-span-4">
                        <div class="bg-white border rounded-2xl shadow">

                            <div class="p-5">
                                <h4 class="font-bold text-black">Total Saldo</h4>
                                <h1>{{ moneyFormat($allBalance) }}</h1>
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-4 md:col-span-4">
                        <div class="bg-white border rounded-2xl shadow">

                            <div class="p-5">
                                <h4 class="font-bold text-black">Claim</h4>
                                <h1>{{ moneyFormat($claim) }}</h1>
                                <p></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-4 md:col-span-4">
                        <div class="bg-white border rounded-2xl shadow">

                            <div class="p-5">
                                <h4 class="font-bold text-black">Sharing</h4>
                                <h1> {{ moneyFormat($profit) }}</h1>
                                <h3></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-4 md:col-span-4">
                        <div class="bg-white border rounded-2xl shadow">

                            <div class="p-5">
                                <h4 class="font-bold text-black">tiSavings</h4>
                                <h1> {{ moneyFormat($saving) }}</h1>
                                <h3></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-4 md:col-span-4">
                        <div class="bg-white border rounded-2xl shadow">

                            <div class="p-5">
                                <h4 class="font-bold text-black">tiGether</h4>
                                <h1> {{ moneyFormat($gether) }}</h1>
                                <h3></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-4 md:col-span-4">
                        <div class="bg-white border rounded-2xl shadow">

                            <div class="p-5">
                                <h4 class="font-bold text-black">tiPayment</h4>
                                <h1> {{ moneyFormat($payment) }}</h1>
                                <h3></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-4 md:col-span-4">
                        <div class="bg-white border rounded-2xl shadow">

                            <div class="p-5">
                                <h4 class="font-bold text-black">tiShopping</h4>
                                <h1> {{ moneyFormat($shop) }}</h1>
                                <h3></h3>
                            </div>
                        </div>
                    </div>

                </div>

                <!--/table Card-->

            </div>
        </div>

        <div class="w-full xl:w-1/3 p-6 xl:max-w-4xl border-l-1 border-gray-300">

            <!--"Container" for the graphs"-->
            <div class="max-w-sm lg:max-w-3xl xl:max-w-5xl">

                <!--Graph Card-->

                <div class="border-b p-3">
                    <h5 class="font-bold text-black">Pengguna</h5>
                </div>
                <div class="p-5">
                    <div class="bg-white border rounded shadow mt-4">
                        <div class="p-5">
                            <h4 class="font-bold text-black">Pengguna</h4>
                            <h1>{{$users}} Orang</h1> <br>
                            <hr><br>
                            <h4 class="font-bold text-black">Merchant</h4>
                            <h1>{{$merchants}} Merchant</h1><br>
                            <hr><br>
                        </div>
                    </div>

                </div>

                <!--/Graph Card-->


            </div>

        </div>

        <!--Divider-->
        <hr class="border-b-2 border-gray-400 my-2 mx-2">

     
    </div>

</div>

</div>

@endsection
