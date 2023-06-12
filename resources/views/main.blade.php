<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LearnDev</title>
    <link rel="icon" type="image/x-icon" href="{{asset('dist/images/favicon.ico')}}">
    <!-- Tailwind element  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" /> --}}
    <link href="https://cdn.jsdelivr.net/npm/tw-elements@1.0.0-alpha13/dist/css/index.min.css" rel="stylesheet">
    <!-- Select2  -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Tailwind css  -->
    <link rel="stylesheet" href="{{ asset('dist/css/tailwind.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('dist/libs/boxicons/css/boxicons.min.css') }}"/>
    <!-- Dropzone  -->
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="{{ asset('dist/css/custom.dopzone.css') }}">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    @yield("css")
    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        .no-scrollbar {
            -ms-overflow-style: none;  /*IE and Edge*/
            scrollbar-width: none;  /*Firefox*/
        }

        /* width */
        ::-webkit-scrollbar {
          width: 0.4rem;
          height: 0.3rem
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
          background: #10B669; 
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
          background: #059669; 
        }

        body{
            background-image: url({{asset('dist/images/bg-pattern.png')}});
        }

        .no-scroll{
            position: ;
        }
    </style>
</head>

<body >
    <!-- Navbar -->
    <nav class="bg-white border-b border-gray-300">
        <div class="flex items-center justify-between flex-wrap mx-auto max-w-screen-xl">
            <div class="flex items-center mx-2 py-3 md:py-0">
                <div class="flex items-center">
                    @if (Auth::user()->role == 'admin')
                    <button class="md:hidden mx-3">
                        <i class="text-2xl bx bx-menu"></i>
                    </button>
                    <div class="items-center">
                        <a href="/" class="font-bold text-xl pr-6 inline-flex"><img src="{{asset('dist\images\LND_logo.png')}}" alt="" class="w-7 mx-1">Learn<span class="text-gray-500 font-normal">'Dev</span></a>
                    </div>
                    @endif
                    @if (Auth::user()->role == 'student')
                    <div class="items-center">
                        <a href="{{ route('profile.student') }}" class="font-bold text-xl pr-6 inline-flex"><img src="{{asset('dist\images\LND_logo.png')}}" alt="" class="w-7 mx-1">Learn<span class="text-gray-500 font-normal">'Dev</span></a>
                    </div>
                    @endif
                    @if (Auth::user()->role == 'supervisor')
                    <div class="items-center">
                        <a href="{{ route('profile.supervisor') }}" class="font-bold text-xl pr-6 inline-flex"><img src="{{asset('dist\images\LND_logo.png')}}" alt="" class="w-7 mx-1">Learn<span class="text-gray-500 font-normal">'Dev</span></a>
                    </div>
                    @endif
                </div>
                <ul class="text-sm font-normal hidden md:flex">
                    @if(Auth::user()->role == "admin")
                    <li class="mx-3 py-4 {{ request()->is('/*') ? 'border-b-2 text-green-500 font-medium' : '' }} border-green-500">
                        <a href="{{ route ('main')}}" class="inline-flex items-center">
                            <i class="bx bx-home mr-1"></i>
                            Home
                        </a>
                    </li>
                    @endif
                    @if(Auth::user()->role == 'admin')
                    <li class="mx-3 py-4 text-gray-600 hover:text-gray-600 inline-block relative text-left {{ request()->is('student*') || request()->is('supervisor*') || request()->is('attendance*') || request()->is('institute*') ? 'border-b-2 text-green-500 font-medium' : '' }} border-green-500">
                        <a href="#" class="inline-flex text-sm items-center dropdown-toggle"
                        data-dropdown="dropdownMenuDashboard">
                        <i class="bx bx-pie-chart-alt mr-1"></i>
                        <span>Master</span>
                        <i class="bx bx-chevron-down ml-1"></i>
                      </a>

                        <div class="origin-top-right absolute right-0 mt-3 z-10 w-40 rounded-md shadow-lg hidden"
                            id="dropdownMenuDashboard">
                            <div class="rounded-md bg-white shadow-xs" role="menu" aria-orientation="vertical"
                                aria-labelledby="options-menu">
                                <div class="py-1">
                                    <a href="{{ route('attendance.get.index') }}"
                                        class="block px-3 py-2 text-sm leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Attendance</a>
                                    <a href="{{ route('supervisor.get.index') }}"
                                        class="block px-3 py-2 text-sm leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Supervisor</a>
                                    <a href="{{ route('student.get.index') }}"
                                        class="block px-3 py-2 text-sm leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Student</a>
                                    <a href="{{ route('institute.get.index') }}"
                                        class="block px-3 py-2 text-sm leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Institute</a>
                                    <a href="{{ route('score.get.index') }}"
                                        class="block px-3 py-2 text-sm leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Score</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endif
                </ul>
            </div>

            <div class="flex items-center">
                {{-- <div class="inline-block relative">
                  <a class="mt-1 relative mx-2 flex items-center dropdown-toggle" href="" data-dropdown="dropDownNotif">
                      <i class="bx bx-bell text-xl text-gray-600"></i>
                      <span aria-hidden="true"
                          class="absolute top-0 right-0 inline-block w-3 h-3 transform translate-x-1 -translate-y-1 bg-red-600 border-2 border-white rounded-full dark:border-gray-800"></span>
                  </a>

                  <div class="origin-top-right absolute right-0 mt-3 z-56 w-56 rounded-md shadow-lg hidden" id="dropDownNotif">
                    <div class="rounded-md bg-white shadow-xs" role="menu" aria-orientation="vertical"
                            aria-labelledby="options-menu">
                            <div class="p-3">
                              INI NOTIF
                            </div>
                        </div>
                  </div>
                </div> --}}

                <div class="inline-block relative text-left">
                    <a class="flex items-center mx-2 dropdown-toggle" href="" data-dropdown="dropDownMenu">
                        <img class="w-8 h-8 mr-3 rounded-full object-cover" src="{{ Auth::user()->image ? asset('profile/'.Auth::user()->image) : asset('dist/avatar/profile_default.png') }}"
                            alt="Avatar" />
                        <div class="mt-1 hidden md:block">
                            <div class="leading-3 text-sm text-gray-700">
                                {{Auth::user()->name}}
                            </div>
                            <small class="text-xs text-gray-500">{{Auth::user()->role}}</small>
                        </div>
                    </a>

                    <div class="origin-top-right absolute right-0 mt-3 z-56 w-56 rounded-md shadow-lg hidden"
                        id="dropDownMenu">
                        <div class="rounded-md bg-white shadow-xs" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                            <div class="py-1">
                                @if(Auth::user()->role == 'admin')
                                <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900" href="{{route('admin.get.edit')}}" role="menuitem">Edit profile</a>
                                @endif
                                <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" role="menuitem">
                                    Logout
                                </a>
                                {{-- logout Form --}}
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- End navbar --> 

    <!-- Wrapper -->
    <div class="max-w-screen-xl mx-auto pr-2 md:pr-0">
        <!-- Title -->
        <div class="mt-4 mx-2 md:flex justify-between items-center">
            <div class="">
                @yield("title")
            </div>
        </div>
        <!-- End title -->

        <!-- Content -->
        <div class="mt-3 w-full">
            @yield("content")
        </div>
        <!-- End Content -->
    </div>
    <!-- End wrapper -->

    <!-- Jquery plugin js -->
    <script src="{{ asset('dist/libs/jquery/jquery.slim.min.js') }}"></script>
    <!-- Apex chart plugins js -->
    <script src="{{ asset('dist/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('dist/js/jakarta-lte.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/tw-elements@1.0.0-alpha13/dist/js/index.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    {{-- <script src="{{ asset('view/main.js') }}"></script> --}}
    <script type="text/javascript">
        var APP_URL = {!! json_encode(url('/')) !!};

        function capitalize(string) {
        return string.toLowerCase()
            .split(' ')
            .map((word) => word.charAt(0).toUpperCase() + word.slice(1))
            .join(' ');
        }

        function addOrUpdateURLParam (key, value) {
            const searchParams = new URLSearchParams(window.location.search)
            searchParams.set(key, value)
            const newRelativePathQuery = window.location.pathname + "?" + searchParams.toString()
            history.pushState(null, "", newRelativePathQuery)
        };
    </script>
    @yield('js')
</body>
