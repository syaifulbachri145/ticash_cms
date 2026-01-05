<div class="bg-white-700 pl-2 md:pl-10 w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block mt-2 lg:mt-2 z-10 border-yellow-500" id="nav-content" >

    <ul class="list-reset lg:flex flex-1 items-center px-4 md:px-0">

        @can('topups.index')
        <li class="mr-6 my-2 md:my-0">
            <a href="{{ route('admin.topup.index') }}"
            class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-blue-600 border-b-2 hover:border-blue-800 {{ Request::is('admin/topup*') ? 'text-blue-600 border-blue-600' :  'text-white'}} ">
               <span class="pb-1 md:pb-0 text-sm">Topup</span>
            </a>
        </li>
        @endcan   
        <li class="mr-6 my-2 md:my-0">
            <a href="{{ route('admin.transfer.index') }}"
            class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-blue-600 border-b-2 hover:border-blue-800 {{ Request::is('admin/transfer*') ? 'text-blue-600 border-blue-600' :  'text-white'}} ">
               <span class="pb-1 md:pb-0 text-sm">tiSharing</span>
            </a>
        </li>
        @can('withdrawals.index')
        <li class="mr-6 my-2 md:my-0">
            <a href="{{ route('admin.withdrawal.index') }}"
            class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-blue-600 border-b-2 hover:border-blue-800 {{ Request::is('admin/withdrawal*') ? 'text-blue-600 border-blue-600' :  'text-white'}} ">
               <span class="pb-1 md:pb-0 text-sm">Withdrawal</span>
            </a>
        </li>
        @endcan    

        @if(Auth()->user()->access_id == '5')
        <li class="mr-6 my-2 md:my-0">
            <a href="{{ route('admin.paymentDetail.index') }}"
            class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-blue-600 border-b-2 hover:border-blue-800 {{ Request::is('admin/paymentDetail*') ? 'text-blue-600 border-blue-600' :  'text-white'}} ">
               <span class="pb-1 md:pb-0 text-sm">tiPayment</span>
            </a>
        </li>
        @endif

        <li class="mr-6 my-2 md:my-0">
            <a href="{{ route('admin.history.index') }}"
            class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-blue-600 border-b-2 hover:border-blue-800 {{ Request::is('admin/history*') ? 'text-blue-600 border-blue-600' :  'text-white'}} ">
               <span class="pb-1 md:pb-0 text-sm">History</span>
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
