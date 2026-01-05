<div class="bg-white-700 pl-2 md:pl-10 w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block mt-2 lg:mt-2 z-10 border-yellow-500" id="nav-content" >

                        <ul class="list-reset lg:flex flex-1 items-center px-4 md:px-0">
                            @can('permissions.index')
                            <li class="mr-6 my-2 md:my-0">
                                <a href="{{ route('admin.permission.index') }}"
                                class="block py-1 md:py-3 pl-1 align-middle text-gray-800 no-underline hover:text-blue-600 border-b-2 hover:border-blue-600 {{ Request::is('admin/permission*') ? 'text-blue-600 border-blue-600' :  'text-white'}} ">
                                   <span class="pb-1 md:pb-0 text-sm">Permission</span>
                                </a>
                            </li>
                            @endcan
                            @can('roles.index')
                            <li class="mr-6 my-2 md:my-0">
                                <a href="{{ route('admin.role.index') }}"
                                class="block py-1 md:py-3 pl-1 align-middle text-gray-800 no-underline hover:text-blue-600 border-b-2 hover:border-blue-600 {{ Request::is('admin/role*') ? 'text-blue-600 border-blue-600' :  'text-white'}} ">
                                    <span class="pb-1 md:pb-0 text-sm">Roles</span>
                                </a>
                            </li>
                            @endcan
                         
                            @can('users.index')
                            <li class="mr-6 my-2 md:my-0">
                                <a href="{{ route('admin.user.index') }}"
                                class="block py-1 md:py-3 pl-1 align-middle text-gray-800 no-underline hover:text-blue-600 border-b-2 hover:border-blue-600 {{ Request::is('admin/user*') ? 'text-blue-600 border-blue-600' :  'text-white'}} ">
                                    <span class="pb-1 md:pb-0 text-sm">Users</span>
                                </a>
                            </li>
                            @endcan
                            @can('institutions.index')
                            <li class="mr-6 my-2 md:my-0">
                                <a href="{{ route('admin.institution.index') }}"
                                class="block py-1 md:py-3 pl-1 align-middle text-gray-800 no-underline hover:text-blue-600 border-b-2 hover:border-blue-600 {{ Request::is('admin/institution*') ? 'text-blue-600 border-blue-600' :  'text-white'}} ">
                                    <span class="pb-1 md:pb-0 text-sm">Institution</span>
                                </a>
                            </li>
                            @endcan
                            @can('merchants.index')
                            <li class="mr-6 my-2 md:my-0">
                                <a href="{{ route('admin.merchant.index') }}"
                                class="block py-1 md:py-3 pl-1 align-middle text-gray-800 no-underline hover:text-blue-600 border-b-2 hover:border-blue-600 {{ Request::is('admin/merchant*') ? 'text-blue-600 border-blue-600' :  'text-white'}} ">
                                    <span class="pb-1 md:pb-0 text-sm">Merchant</span>
                                </a>
                            </li>
                            @endcan
                            @can('students.index')
                            <li class="mr-6 my-2 md:my-0">
                                <a href="{{ route('admin.student.index') }}"
                                class="block py-1 md:py-3 pl-1 align-middle text-gray-800 no-underline hover:text-blue-600 border-b-2 hover:border-blue-600 {{ Request::is('admin/student*') ? 'text-blue-600 border-blue-600' :  'text-white'}} ">
                                    <span class="pb-1 md:pb-0 text-sm">Student</span>
                                </a>
                            </li>
                            @endcan
                            @can('degrees.index')
                            <li class="mr-6 my-2 md:my-0">
                                <a href="{{ route('admin.degree.index') }}"
                                class="block py-1 md:py-3 pl-1 align-middle text-gray-800 no-underline hover:text-blue-600 border-b-2 hover:border-blue-600 {{ Request::is('admin/degree*') ? 'text-blue-600 border-blue-600' :  'text-white'}} ">
                                    <span class="pb-1 md:pb-0 text-sm">Degree</span>
                                </a>
                            </li>
                            @endcan
                           
                            @can('transactionCategories.index')
                            <li class="mr-6 my-2 md:my-0">
                                <a href="{{ route('admin.transactionCategory.index') }}"
                                class="block py-1 md:py-3 pl-1 align-middle text-gray-800 no-underline hover:text-blue-600 border-b-2 hover:border-blue-600 {{ Request::is('admin/transactionCategory*') ? 'text-blue-600 border-blue-600' :  'text-white'}} ">
                                    <span class="pb-1 md:pb-0 text-sm">Transaction Category</span>
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
