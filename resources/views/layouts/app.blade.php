<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <!-- css -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.1/dist/alpine.min.js" defer></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
    <meta name="description" content="description here">
    <meta name="keywords" content="keywords,here">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,700,800" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">


    <style>
        .nunito {
            font-family: 'nunito', font-sans;
        }

        .border-b-1 {
            border-bottom-width: 1px;
        }

        .border-l-1 {
            border-left-width: 1px;
        }

        hover\:border-none:hover {
            border-style: none;
        }

        #sidebar {
            transition: ease-in-out all .3s;
            z-index: 9999;
        }

        #sidebar span {
            opacity: 0;
            position: absolute;
            transition: ease-in-out all .1s;
        }

        #sidebar:hover {
            width: 150px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            /*shadow-2xl*/
        }

        #sidebar:hover span {
            opacity: 1;
        }
    </style>
  <!-- jQuery -->
  <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>  

  <!-- sweet alert -->
  <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>  

</head>

<body class="flex h-screen bg-gray-50 font-sans">

    <!-- Side bar-->
    <div id="sidebar"  class=" scroll-py-0 h-screen w-16 menu bg-white text-white px-4 flex  nunito static fixed shadow">

        <div class="flex items-top justify-top mt-8 mb-20">
            <div class="flex items-top">
              <span class="text-gray-600 text-2xl mx-2 font-semibold text-lime-950 pr-3">  <img class="w-8 h-7 mr-2" src="{{ asset('assets/img/favicon.png') }}" alt="Avatar of User"> </span>
             
            </div>
        </div>

        <ul class="list-reset items-center justify-center mt-20">

            <li class="my-2 md:my-0">
                <a href="{{ route('admin.dashboard.index') }}"
                class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-blue-600 {{ Request::is('admin/dashboard*') ? 'text-blue-600' :  'text-gray-500' }}">
                    <i class="fas fa-tachometer-alt fa-fw mr-3"></i><span class="w-full inline-block pb-1 md:pb-0 text-sm">Dashboard</span>
                </a>
            </li>

            @if(auth()->user()->can('shops.index') || auth()->user()->can('reportMerchants.index') )
            <li class="my-2 md:my-0 ">
            <a href="{{route('admin.shop.index')}}"
                class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-blue-600 
                {{ Request::is('admin/shop*') ? 'text-blue-600' :  'text-gray-500' }} ||
                {{ Request::is('admin/reportMerchant*')? 'text-blue-600' :  'text-gray-500'}}">
                <i class="fas fa-shopping-bag fa-fw mr-3"></i><span class="w-full inline-block pb-1 md:pb-0 text-sm">Kantin</span>
                </a>
            </li>
            @endcan
           
            @if(auth()->user()->can('topups.index') || auth()->user()->can('withdrawals.index') || auth()->user()->can('histories.index'))
            <li class="my-2 md:my-0">
                <a href="{{route('admin.topup.index')}}"
                class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-blue-600 
                {{ Request::is('admin/topup*') ? 'text-blue-600' :  'text-gray-500' }} ||
                  {{ Request::is('admin/transfer*') ? 'text-blue-600' :  'text-gray-500' }} ||
                {{ Request::is('admin/withdrawal*') ? 'text-blue-600' :  'text-gray-500' }} ||
                {{ Request::is('admin/history*')? 'text-blue-600' :  'text-gray-500'}}">
                    <i class="fa fa-credit-card fa-fw mr-3"></i><span class="w-full inline-block pb-1 md:pb-0 text-sm">Transaksi</span>
                </a>
            </li>
            @endcan

            @if(auth()->user()->can('savings.index') || auth()->user()->can('gethers.index'))
            <li class="my-2 md:my-0">
                <a href="{{route('admin.saving.index')}}"
                class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-blue-600 
                {{ Request::is('admin/saving*') ? 'text-blue-600' :  'text-gray-500' }} ||
                {{ Request::is('admin/gether*')? 'text-blue-600' :  'text-gray-500'}}">
                    <i class="fa fa-wallet fa-fw mr-3"></i><span class="w-full inline-block pb-1 md:pb-0 text-sm">Tabungan</span>
                </a>
            </li>
            @endcan

            @if(auth()->user()->can('sliders.index') )
            <li class="my-2 md:my-0 ">
                <a href="{{ route('admin.slider.index') }}"
                class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-blue-600
             
                {{ Request::is('admin/slider*')? 'text-blue-600' :  'text-gray-500' }}">
                <i class="fas fa-film fa-fw mr-3"></i><span class="w-full inline-block pb-1 md:pb-0 text-sm">Media</span>
                </a>
            </li>
            @endif

            @if(auth()->user()->can('claims.index') || auth()->user()->can('payments.index')|| auth()->user()->can('bills.index')|| auth()->user()->can('reedems.index'))
            <li class="my-2 md:my-0 ">
                <a href="{{ route('admin.payment.index') }}"
                class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-blue-600 
                {{ Request::is('admin/claim*')? 'text-blue-600' :  'text-gray-500' }} ||  
                {{ Request::is('admin/payment*')? 'text-blue-600' :  'text-gray-500' }} || 
                {{ Request::is('admin/paymentDetail*')? 'text-blue-600' :  'text-gray-500' }} || 
                {{ Request::is('admin/bill*')? 'text-blue-600' :  'text-gray-500' }} ||          
                {{ Request::is('admin/reedem*')? 'text-blue-600' :  'text-gray-500' }} ">
                <i class="fas fa-wallet fa-fw mr-3"></i><span class="w-full inline-block pb-1 md:pb-0 text-sm">Keuangan</span>
                </a>
            </li>
            @endif

            @if(auth()->user()->can('roles.index') || auth()->user()->can('permissions.index') || auth()->user()->can('paymentCategories.index') ||auth()->user()->can('users.index'))
            <li class="my-2 md:my-0 ">
                <a href="{{ route('admin.user.index') }}"
                class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-blue-600
                {{ Request::is('admin/permission*')? 'text-blue-600' :  'text-gray-500' }} ||
                {{ Request::is('admin/role*')? 'text-blue-600' :  'text-gray-500' }} ||
                 {{ Request::is('admin/paymentCategory*')? 'text-blue-600' :  'text-gray-500' }} ||
                {{ Request::is('admin/user*')? 'text-blue-600' :  'text-gray-500' }} ">
                <i class="fas fa-server fa-fw mr-3"></i><span class="w-full inline-block pb-1 md:pb-0 text-sm">Setting  </span>
                </a>
            </li>
            @endif

        </ul>

    </div>

    <!-- end side bar -->

    <div class="flex flex-row flex-wrap flex-1 flex-grow content-start pl-16">

        <div class="h-40 lg:h-20 w-full flex flex-wrap">


            <!-- Navbar-->
            <nav id="header" class="bg-white fixed w-full z-10 top-0 shadow">


                <div class="w-full container mx-auto flex flex-wrap items-center mt-0 pt-3 pb-3 md:pb-0">

                    <!-- Logos -->

                    <div class="w-1/2 pl-10 md:pl-10">
                    <div class="flex relative inline-block float-left">

                        <div class="relative text-sm">
                            <button id="#" class="flex items-center focus:outline-none mr-3">
                                <img class="w-8 h-7 mr-2" src="{{ auth()->user()->institution->image }}" alt="Avatar of User">
                                <a class="text-white-600 text-base xl:text-2xl no-underline hover:no-underline" href="{{ route('admin.dashboard.index') }}">
                                {{ auth()->user()->institution->institution_name }}</a>
                            </button>
                        </div>

                     </div>
                    </div>
                    <!-- end logos -->

                    <!-- User Logedin-->

                    <div class="w-1/2 pr-20">
                        <div class="flex relative inline-block float-right">

                            <div class="relative text-sm">
                                <button id="userButton" class="flex items-center focus:outline-none mr-3">
                                    <img class="w-8 h-8 rounded-full mr-4" src="{{ auth()->user()->avatar }}" alt="Avatar of User"> 
                                   
                                    <span class="hidden md:inline-block text-gray-800">Hi, {{ auth()->user()->name }} </span>
                                    <svg class="pl-2 h-2" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 129 129">
                                        <g>
                                            <path d="m121.3,34.6c-1.6-1.6-4.2-1.6-5.8,0l-51,51.1-51.1-51.1c-1.6-1.6-4.2-1.6-5.8,0-1.6,1.6-1.6,4.2 0,5.8l53.9,53.9c0.8,0.8 1.8,1.2 2.9,1.2 1,0 2.1-0.4 2.9-1.2l53.9-53.9c1.7-1.6 1.7-4.2 0.1-5.8z" />
                                        </g>
                                    </svg>
                                </button>
                                <div id="userMenu" class="bg-white rounded shadow-md mt-2 absolute mt-12 top-0 right-0 min-w-full overflow-auto z-30 invisible">
                                    <ul class="list-reset">
                                        <li><a href="#" class="px-4 py-2 block text-gray-800 hover:bg-blue-400 no-underline hover:no-underline">My account</a></li>
                                        <li><a href="#" class="px-4 py-2 block text-gray-800 hover:bg-blue-400 no-underline hover:no-underline">Notifications</a></li>
                                        <li>
                                            <hr class="border-t mx-2 border-gray-400">
                                        </li>
                                        <li><a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                        class="px-4 py-2 block text-gray-800 hover:bg-blue-400 no-underline hover:no-underline">Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="block lg:hidden pr-15">
                                <button id="nav-toggle" class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600 hover:text-gray-900 hover:border-teal-500 appearance-none focus:outline-none">
                                    <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <title>Menu</title>
                                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                    </div>

                    <!-- end user logedin -->




     @yield('content')

    <script src="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
      <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<script>
    //sweetalert for success or error message
    @if(session()->has('success'))
        swal({
            type: "success",
            icon: "success",
            title: "BERHASIL!",
            text: "{{ session('success') }}",
            timer: 2000,
            showConfirmButton: false,
            showCancelButton: false,
            buttons: false,
        });
        @elseif(session()->has('error'))
        swal({
            type: "error",
            icon: "error",
            title: "GAGAL!",
            text: "{{ session('error') }}",
            timer: 2000,
            showConfirmButton: false,
            showCancelButton: false,
            buttons: false,
        });
        @endif
  </script>
    
    <script>
        /* Refer to https://gionkunz.github.io/chartist-js/examples.html for setting up the graphs */

        var mainChart = new Chartist.Line('#chart1', {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            series: [
                [1, 5, 2, 5, 4, 3],
                [2, 3, 4, 8, 1, 2],
                [5, 4, 3, 2, 1, 0.5]
            ]
        }, {
            low: 0,
            showArea: true,
            showPoint: false,
            fullWidth: true
        });

        mainChart.on('draw', function(data) {
            if (data.type === 'line' || data.type === 'area') {
                data.element.animate({
                    d: {
                        begin: 1000 * data.index,
                        dur: 1000,
                        from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
                        to: data.path.clone().stringify(),
                        easing: Chartist.Svg.Easing.easeOutQuint
                    }
                });
            }
        });

        var chartScatter = new Chartist.Line('#chart2', {
            labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
            series: [
                [12, 9, 7, 8, 5, 4, 6, 2, 3, 3, 4, 6],
                [4, 5, 3, 7, 3, 5, 5, 3, 4, 4, 5, 5],
                [5, 3, 4, 5, 6, 3, 3, 4, 5, 6, 3, 4],
                [3, 4, 5, 6, 7, 6, 4, 5, 6, 7, 6, 3]
            ]
        }, {
            low: 0
        });

        chartScatter.on('draw', function(data) {
            if (data.type === 'line' || data.type === 'area') {
                data.element.animate({
                    d: {
                        begin: 500 * data.index,
                        dur: 1000,
                        from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
                        to: data.path.clone().stringify(),
                        easing: Chartist.Svg.Easing.easeOutQuint
                    }
                });
            }
        });

        var chartBar = new Chartist.Bar('#chart3', {
            labels: ['Q1', 'Q2', 'Q3', 'Q4'],
            series: [
                [800000, 1200000, 1400000, 1300000],
                [200000, 400000, 500000, 300000],
                [100000, 200000, 400000, 600000]
            ]
        }, {
            stackBars: true,
            axisY: {
                labelInterpolationFnc: function(value) {
                    return (value / 1000) + 'k';
                }
            }
        })

        chartBar.on('draw', function(data) {
            if (data.type === 'bar') {
                data.element.attr({
                        style: 'stroke-width: 30px'
                    }),
                    data.element.animate({
                        y2: {
                            dur: '0.5s',
                            from: data.y1,
                            to: data.y2
                        }
                    });
            }
        });

        var chartPie = new Chartist.Pie('#chart4', {
            series: [10, 20, 50, 20, 5, 50, 15],
            labels: [1, 2, 3, 4, 5, 6, 7]
        }, {
            donut: true,
            showLabel: true
        });

        chartPie.on('draw', function(data) {
            if (data.type === 'slice') {
                var pathLength = data.element._node.getTotalLength();
                data.element.attr({
                    'stroke-dasharray': pathLength + 'px ' + pathLength + 'px'
                });

                var animationDefinition = {
                    'stroke-dashoffset': {
                        id: 'anim' + data.index,
                        dur: 200,
                        from: -pathLength + 'px',
                        to: '0px',
                        easing: Chartist.Svg.Easing.easeOutQuint,
                        fill: 'freeze'
                    }
                };

                if (data.index !== 0) {
                    animationDefinition['stroke-dashoffset'].begin = 'anim' + (data.index - 1) + '.end';
                }

                data.element.attr({
                    'stroke-dashoffset': -pathLength + 'px'
                });

                data.element.animate(animationDefinition, false);
            }
        });
    </script>

    <script>
        /*Toggle dropdown list*/
        /*https://gist.github.com/slavapas/593e8e50cf4cc16ac972afcbad4f70c8*/

        var userMenuDiv = document.getElementById("userMenu");
        var userMenu = document.getElementById("userButton");

        document.onclick = check;

        function check(e) {
            var target = (e && e.target) || (event && event.srcElement);

            //User Menu
            if (!checkParent(target, userMenuDiv)) {
                // click NOT on the menu
                if (checkParent(target, userMenu)) {
                    // click on the link
                    if (userMenuDiv.classList.contains("invisible")) {
                        userMenuDiv.classList.remove("invisible");
                    } else {
                        userMenuDiv.classList.add("invisible");
                    }
                } else {
                    // click both outside link and outside menu, hide menu
                    userMenuDiv.classList.add("invisible");
                }
            }

        }

        function checkParent(t, elm) {
            while (t.parentNode) {
                if (t == elm) {
                    return true;
                }
                t = t.parentNode;
            }
            return false;
        }
    </script>

</body>

</html>
