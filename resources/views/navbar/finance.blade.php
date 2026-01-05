<!-- Navbar -->
<div class="bg-white-700 pl-2 md:pl-10 w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block mt-2 lg:mt-2 z-10 border-yellow-500" id="nav-content" >

                        <ul class="list-reset lg:flex flex-1 items-center px-4 md:px-0">
                           
                           
                            @can('payments.index')
                            <li class="mr-6 my-2 md:my-0">
                                <a href="{{route('admin.payment.index')}}"
                                class="block py-1 md:py-3 pl-1 align-middle text-gray-800 no-underline hover:text-blue-600 border-b-2 hover:border-blue-600 {{ Request::is('admin/payment*') ? 'text-blue-600 border-blue-600' :  'text-white'}} ">
                                   <span class="pb-1 md:pb-0 text-sm">Biaya</span>
                                </a>
                            </li>
                            @endcan
                             @can('paymentDetails.index')
                            <li class="mr-6 my-2 md:my-0">
                                <a href="{{route('admin.paymentDetail.index')}}"
                                class="block py-1 md:py-3 pl-1 align-middle text-gray-800 no-underline hover:text-blue-600 border-b-2 hover:border-blue-600 {{ Request::is('admin/paymentDetail*') ? 'text-blue-600 border-blue-600' :  'text-white'}} ">
                                   <span class="pb-1 md:pb-0 text-sm">Tagihan</span>
                                </a>
                            </li>
                            @endcan
                            
                             @can('paymentUsers.index')
                            <li class="mr-6 my-2 md:my-0">
                                <a href="{{route('admin.paymentUser.index')}}"
                                class="block py-1 md:py-3 pl-1 align-middle text-gray-800 no-underline hover:text-blue-600 border-b-2 hover:border-blue-600 {{ Request::is('admin/paymentUser*') ? 'text-blue-600 border-blue-600' :  'text-white'}} ">
                                   <span class="pb-1 md:pb-0 text-sm">Daftar Tagihan</span>
                                </a>
                            </li>
                            @endcan

                              @can('paymentJournals.index')
                            <li class="mr-6 my-2 md:my-0">
                                <a href="{{route('admin.paymentJournal.index')}}"
                                class="block py-1 md:py-3 pl-1 align-middle text-gray-800 no-underline hover:text-blue-600 border-b-2 hover:border-blue-600 {{ Request::is('admin/paymentJournal*') ? 'text-blue-600 border-blue-600' :  'text-white'}} ">
                                   <span class="pb-1 md:pb-0 text-sm">Jurnal</span>
                                </a>
                            </li>
                            @endcan

                            @can('reedems.index')
                            <li class="mr-6 my-2 md:my-0">
                                <a href="{{route('admin.reedem.index')}}"
                                class="block py-1 md:py-3 pl-1 align-middle text-gray-800 no-underline hover:text-blue-600 border-b-2 hover:border-blue-600 {{ Request::is('admin/reedem*') ? 'text-blue-600 border-blue-600' :  'text-white'}} ">
                                   <span class="pb-1 md:pb-0 text-sm">Profit</span>
                                </a>
                            </li>
                            @endcan

                            
                            @can('bills.index')
                            <li class="mr-6 my-2 md:my-0">
                                <a href="{{route('admin.bill.index')}}"
                                class="block py-1 md:py-3 pl-1 align-middle text-gray-800 no-underline hover:text-blue-600 border-b-2 hover:border-blue-600 {{ Request::is('admin/bill*') ? 'text-blue-600 border-blue-600' :  'text-white'}} ">
                                   <span class="pb-1 md:pb-0 text-sm">Lisensi</span>
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
        <!-- end Navbar -->
