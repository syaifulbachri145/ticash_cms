<div class="bg-white-700 pl-2 md:pl-10 w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block mt-2 lg:mt-2 z-10 border-yellow-500" id="nav-content" >

    <ul class="list-reset lg:flex flex-1 items-center px-4 md:px-0">

        @can('savings.index')
        <li class="mr-6 my-2 md:my-0">
            <a href="{{ route('admin.saving.index') }}"
            class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-blue-600 border-b-2 hover:border-blue-800 {{ Request::is('admin/saving*') ? 'text-blue-600 border-blue-600' :  'text-white'}} ">
               <span class="pb-1 md:pb-0 text-sm">tiSavings</span>
            </a>
        </li>
        @endcan    
       
        @can('gethers.index')
        <li class="mr-6 my-2 md:my-0">
            <a href="{{ route('admin.gether.index') }}"
            class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-blue-600 border-b-2 hover:border-blue-800 {{ Request::is('admin/gether*') ? 'text-blue-600 border-blue-600' :  'text-white'}} ">
               <span class="pb-1 md:pb-0 text-sm">tiGether</span>
            </a>
        </li>
        @endcan    
        @can('getherMembers.index')
        <li class="mr-6 my-2 md:my-0">
            <a href="{{ route('admin.member.index') }}"
            class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-blue-600 border-b-2 hover:border-blue-800 {{ Request::is('admin/member*') ? 'text-blue-600 border-blue-600' :  'text-white'}} ">
               <span class="pb-1 md:pb-0 text-sm">Member of Gether</span>
            </a>
        </li>
        @endcan    
       
                  
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
