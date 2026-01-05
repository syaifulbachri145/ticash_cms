@extends ('layouts.app', ['title' => 'ticash | Members'])

@section('content')

        <!-- Navbar -->
       @include('navbar.saving')
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
                                Your Saving:  <strong>{{moneyFormat($getherBalance)}} </strong>
                                </h5>
                               
                            </div>

                            <div class="flex">
                               
                                <div class="relative pull-right pl-4 pr-8 md:pr-20">
                                    <form action="{{ route('admin.member.index') }}" method="GET">
                                    <input type="search" name="q" value="{{ request()->query('q') }}" placeholder="Search" class="w-full bg-white-700 text-sm text-gray-800 transition border focus:outline-none focus:border-gray-700 rounded-2xl py-1 px-7 pl-20 appearance-none leading-normal">
                                    </form>
                                    <div class="absolute search-icon" style="top: 0.375rem;left: 1.75rem;">
                                        <svg class="fill-current pointer-events-none text-gray-800 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path>
                                        </svg>
                                    </div>
                                </div>
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
                                        <th class="text-left text-gray-600 text-sm p-1">Title</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Created</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Goal</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Balance</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Saving</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Deadline</th>
                                        <th class="text-left text-gray-600 text-sm p-1">Last member</th>
                                        <th class="text-center text-gray-600 text-sm p-1">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-gray-200">
                                @forelse($members as $no => $member)
                                <tr class="border bg-white">
                                    <th scope="row" class=" text-left p-1">{{ ++$no + ($members->currentPage()-1) * $members->perPage() }}</th>
                                    <td class=" text-left p-1">{{ $member->description }}</td>
                                    <td class=" text-left p-1">{{ $member->name }}</td>
                                    <td class=" text-left p-1">{{ $member->goal }}</td>
                                    <td class=" text-left p-1">{{ moneyFormat($member->balance) }}</td>
                                    <td class=" text-left p-1">{{ moneyFormat($member->amount) }}</td>
                                    <td class=" text-left p-1">{{ $member->deadline }}</td>
                                    <td class=" text-left p-1">{{ $member->updated_at }}</td>
                                    <td class="px-5 py-1 text-center">
                                  
                                        @can('getherMembers.edit')
                                        <a href="{{ route('admin.member.edit', $member->id) }}" class="bg-gray-500 px-2 py-0.5 rounded shadow-sm text-xs text-white focus:outline-none">
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
                            @if ($members->hasPages())
                                <div class="bg-white p-3">
                                    {{ $members->links('pagination::tailwind') }}
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

@endsection
