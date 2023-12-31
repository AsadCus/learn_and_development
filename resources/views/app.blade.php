<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tes</title>
    <!-- Tailwind css  -->
    <link rel="stylesheet" href="{{ asset('dist/css/tailwind.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('dist/libs/boxicons/css/boxicons.min.css') }}"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-white border-b border-gray-300">
        <div class="flex items-center justify-between flex-wrap mx-auto max-w-screen-xl">
            <div class="flex items-center mx-2 py-3 md:py-0">
                <div class="flex items-center">
                    <button class="md:hidden mx-3">
                        <i class="text-2xl bx bx-menu"></i>
                    </button>
                    <a href="#" class="font-bold text-xl pr-6">Learn<span
                            class="text-gray-500 font-normal">'Dev</span></a>
                </div>
                <ul class="text-sm font-normal hidden md:flex">
                    <li class="mx-3 py-4 font-medium text-green-500 border-b-2 border-green-500">
                        <a href="#" class="inline-flex items-center">
                            <i class="bx bx-home mr-1"></i>
                            Home
                        </a>
                    </li>
                    <li class="mx-3 py-4 text-gray-600 hover:text-gray-900 inline-block relative text-left">
                        <a href="#" class="inline-flex text-sm items-center text-gray-600 dropdown-toggle"
                            data-dropdown="dropdownMenuDashboard">
                            <i class="bx bx-pie-chart-alt mr-1"></i>
                            <span>Dashboard</span>
                            <i class="bx bx-chevron-down ml-1"></i>
                        </a>

                        <div class="origin-top-right absolute right-0 mt-3 z-10 w-40 rounded-md shadow-lg hidden"
                            id="dropdownMenuDashboard">
                            <div class="rounded-md bg-white shadow-xs" role="menu" aria-orientation="vertical"
                                aria-labelledby="options-menu">
                                <div class="py-1">
                                    <a href="./../index.html"
                                        class="block px-3 py-2 text-sm leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Dashboard
                                        v1</a>
                                    <a href="#"
                                        class="block px-3 py-2 text-sm leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Dashboard
                                        v2</a>
                                    <a href="#"
                                        class="block px-3 py-2 text-sm leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Dashboard
                                        v3</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="mx-3 py-4 text-gray-600 hover:text-gray-900 relative inline-block text-left">
                        <a href="#" class="inline-flex items-center dropdown-toggle" data-dropdown="uiComponentMenu">
                            <i class="bx bx-outline mr-1"></i>
                            <span>UI Component</span>
                            <i class="bx bx-chevron-down ml-1"></i>
                        </a>

                        <div class="origin-top-right absolute right-0 mt-3 z-10 w-40 rounded-md shadow-lg hidden"
                            id="uiComponentMenu">
                            <div class="rounded-md bg-white shadow-xs" role="menu" aria-orientation="vertical"
                                aria-labelledby="options-menu">
                                <div class="py-1">
                                    <a href="./form.html"
                                        class="block px-3 py-2 text-sm leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Form</a>
                                    <a href="./card.html"
                                        class="block px-3 py-2 text-sm leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Card</a>
                                    <a href="#"
                                        class="block px-3 py-2 text-sm leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Chart</a>
                                    <a href="./button.html"
                                        class="block px-3 py-2 text-sm leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Buttons</a>
                                    <a href="#"
                                        class="block px-3 py-2 text-sm leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Dropdown</a>
                                    <a href="#"
                                        class="block px-3 py-2 text-sm leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Navbar</a>
                                    <a href="#"
                                        class="block px-3 py-2 text-sm leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Maps</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="mx-3 py-4 text-gray-600 hover:text-gray-900 relative inline-block text-left">
                        <a href="#" class="inline-flex items-center dropdown-toggle" data-dropdown="pagesNav">
                            <i class="bx bx-book mr-1"></i>
                            <span>Pages</span>
                            <i class="bx bx-chevron-down ml-1"></i>
                        </a>

                        <div class="origin-top-right absolute right-0 mt-3 z-10 w-40 rounded-md shadow-lg hidden"
                            id="pagesNav">
                            <div class="rounded-md bg-white shadow-xs" role="menu" aria-orientation="vertical"
                                aria-labelledby="options-menu">
                                <div class="py-1">
                                    <a href="#"
                                        class="block px-3 py-2 text-sm leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Login</a>
                                    <a href="#"
                                        class="block px-3 py-2 text-sm leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Register</a>
                                    <a href="#"
                                        class="block px-3 py-2 text-sm leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">User
                                        Profile</a>
                                    <a href="#"
                                        class="block px-3 py-2 text-sm leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">User
                                        Settings</a>
                                    <a href="#"
                                        class="block px-3 py-2 text-sm leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Blog</a>
                                    <a href="#"
                                        class="block px-3 py-2 text-sm leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Timeline</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="mx-3 py-4 text-gray-600 hover:text-gray-900 relative inline-block text-left">
                        <a href="#" class="inline-flex items-center dropdown-toggle" data-dropdown="layoutNav"><i
                                class="bx bx-dock-right mr-1"></i>
                            <span> Layout</span>
                            <i class="bx bx-chevron-down ml-1"></i></a>

                        <div class="origin-top-right absolute right-0 mt-3 z-10 w-40 rounded-md shadow-lg hidden"
                            id="layoutNav">
                            <div class="rounded-md bg-white shadow-xs" role="menu" aria-orientation="vertical"
                                aria-labelledby="options-menu">
                                <div class="py-1">
                                    <a href="#"
                                        class="block px-3 py-2 text-sm leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Vertical</a>
                                    <a href="#"
                                        class="block px-3 py-2 text-sm leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Vertical
                                        fluid</a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="flex items-center">
                <button class="mt-1 relative mx-2">
                    <i class="bx bx-bell text-xl text-gray-600"></i>
                    <span aria-hidden="true"
                        class="absolute top-0 right-0 inline-block w-3 h-3 transform translate-x-1 -translate-y-1 bg-red-600 border-2 border-white rounded-full dark:border-gray-800"></span>
                </button>

                <div class="inline-block relative text-left">
                    <a class="flex items-center mx-2 dropdown-toggle" href="" data-dropdown="dropDownMenu">
                        <img class="w-8 h-8 mr-3 rounded-full object-cover" src="{{ asset('dist/avatar/nis.png') }}"
                            alt="Avatar" />
                        <div class="mt-1 hidden md:block">
                            <div class="leading-3 text-sm text-gray-700">
                                Zero Black Coder
                            </div>
                            <small class="text-xs text-gray-500">Anggota DPR</small>
                        </div>
                    </a>

                    <div class="origin-top-right absolute right-0 mt-3 z-56 w-56 rounded-md shadow-lg hidden"
                        id="dropDownMenu">
                        <div class="rounded-md bg-white shadow-xs" role="menu" aria-orientation="vertical"
                            aria-labelledby="options-menu">
                            <div class="py-1">
                                <a href="#"
                                    class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900"
                                    role="menuitem">Settings</a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900"
                                    role="menuitem">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- End navbar -->

    <!-- Wrapper -->
    <div class="max-w-screen-xl mx-auto">
        <!-- Title -->
        <div class="mt-4 mx-2 md:flex justify-between items-center">
            <div class="">
                <h3 class="text-gray-600 text-sm">
                    <a href="" class="text-green-500">
                        <i class="bx bx-home mr-1"></i>
                        Home
                    </a>
                    / Dashboard v1
                </h3>

                <div>
                    <h1 class="text-2xl mt-1 font-medium">Performance Product</h1>
                </div>
            </div>

            <div class="md:pt-0 pt-4">
                <button
                    class="px-4 py-2 border text-sm mx-1 border-transparent rounded bg-green-500 text-white hover:bg-green-500 focus:outline-none focus:border-green-500 focus:shadow-outline-green active:bg-green-500 transition duration-150 ease-in-out inline-flex items-center">
                    <i class="bx bx-world text-white mr-2 text-base"></i>
                    Publish
                </button>
                <button
                    class="px-4 py-2 border text-sm mx-1 rounded bg-white hover:bg-gray-100 focus:outline-none focus:shadow-outline-white active:bg-white transition duration-150 ease-in-out inline-flex items-center">
                    <i class="bx bx-plus text-gray-700 mr-2 text-base"></i>
                    Create
                </button>
            </div>
        </div>
        <!-- End title -->

        <!-- Content -->
        <div class="mt-3 w-full">
            <!-- Content chart 1 -->
            <div class="flex flex-wrap mb-2">
                <div class="lg:w-1/4 md:w-1/2 w-full">
                    <div class="bg-white my-2 mx-2 border rounded-md flex-col flex h-40">
                        <div class="px-4 py-3 pb-0 flex-auto">
                            <div class="flex justify-between">
                                <div class="text-gray-600 text-sm">Total Revenue</div>
                                <div class="relative inline-block text-left text-sm">
                                    <a href="" class="inline-flex items-center text-gray-600 dropdown-toggle"
                                        data-dropdown="totalRevenueDropdown">
                                        <span>Last 30 days </span>
                                        <i class="inline-flex items-center bx bx-chevron-down ml-1"></i>
                                    </a>

                                    <div class="origin-top-right absolute right-0 mt-1 z-10 w-48 rounded-md shadow-lg hidden"
                                        id="totalRevenueDropdown">
                                        <div class="rounded-md bg-white shadow-xs" role="menu"
                                            aria-orientation="vertical" aria-labelledby="options-menu">
                                            <div class="py-1">
                                                <a href="#"
                                                    class="block px-3 py-1 leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Today</a>

                                                <a href="#"
                                                    class="block px-3 py-1 leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Last
                                                    7 days</a>

                                                <a href="#"
                                                    class="block px-3 py-1 leading-5 text-gray-600 bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Last
                                                    30 days</a>

                                                <a href="#"
                                                    class="block px-3 py-1 leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Last
                                                    60 days</a>

                                                <a href="#"
                                                    class="block px-3 py-1 leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Last
                                                    1 Year</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="text-3xl inline font-medium text-gray-700">
                                    $2,820
                                </div>
                                <span class="text-sm text-green-500">+4.61% <i class="bx bx-up-arrow-alt"></i></span>
                            </div>
                        </div>
                        <div id="chart-sparkline-1"></div>
                    </div>
                </div>
                <div class="lg:w-1/4 md:w-1/2 w-full">
                    <div class="bg-white my-2 mx-2 border rounded-md flex-col flex h-40">
                        <div class="px-4 py-3 pb-0 flex-auto">
                            <div class="pb-0 flex justify-between">
                                <div class="text-gray-600 text-sm">Sales Product</div>
                                <div class="relative inline-block text-left text-sm">
                                    <a href="" class="inline-flex items-center text-gray-600 dropdown-toggle"
                                        data-dropdown="salesProductDropdown">
                                        <span>Last 30 days </span>
                                        <i class="inline-flex items-center bx bx-chevron-down ml-1"></i>
                                    </a>

                                    <div class="origin-top-right absolute right-0 mt-1 z-10 w-48 rounded-md shadow-lg hidden"
                                        id="salesProductDropdown">
                                        <div class="rounded-md bg-white shadow-xs" role="menu"
                                            aria-orientation="vertical" aria-labelledby="options-menu">
                                            <div class="py-1">
                                                <a href="#"
                                                    class="block px-3 py-1 leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Today</a>

                                                <a href="#"
                                                    class="block px-3 py-1 leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Last
                                                    7 days</a>

                                                <a href="#"
                                                    class="block px-3 py-1 leading-5 text-gray-600 bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Last
                                                    30 days</a>

                                                <a href="#"
                                                    class="block px-3 py-1 leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Last
                                                    60 days</a>

                                                <a href="#"
                                                    class="block px-3 py-1 leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Last
                                                    1 Year</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-3xl inline font-medium text-gray-700">760</div>
                            <span class="text-sm text-green-500">+5.66% <i class="bx bx-up-arrow-alt"></i></span>
                        </div>
                        <div id="chart-sparkline-2" class="my-2 ml-1 mr-2"></div>
                    </div>
                </div>
                <div class="lg:w-1/4 md:w-1/2 w-full">
                    <div class="bg-white my-2 mx-2 border rounded-md flex-col flex h-40">
                        <div class="px-4 py-3 pb-0 flex-auto">
                            <div class="flex justify-between flex-auto">
                                <div class="text-gray-600 text-sm">User Activity</div>
                                <div class="relative inline-block text-left text-sm">
                                    <a href="" class="inline-flex items-center text-gray-600 dropdown-toggle"
                                        data-dropdown="userActifityDropDown">
                                        <span>Last 30 days </span>
                                        <i class="inline-flex items-center bx bx-chevron-down ml-1"></i>
                                    </a>

                                    <div class="origin-top-right absolute right-0 mt-1 z-10 w-48 rounded-md shadow-lg hidden"
                                        id="userActifityDropDown">
                                        <div class="rounded-md bg-white shadow-xs" role="menu"
                                            aria-orientation="vertical" aria-labelledby="options-menu">
                                            <div class="py-1">
                                                <a href="#"
                                                    class="block px-3 py-1 leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Today</a>

                                                <a href="#"
                                                    class="block px-3 py-1 leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Last
                                                    7 days</a>

                                                <a href="#"
                                                    class="block px-3 py-1 leading-5 text-gray-600 bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Last
                                                    30 days</a>

                                                <a href="#"
                                                    class="block px-3 py-1 leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Last
                                                    60 days</a>

                                                <a href="#"
                                                    class="block px-3 py-1 leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Last
                                                    1 Year</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-3xl inline font-medium text-gray-700">
                                2,169K
                            </div>
                            <span class="text-sm text-red-500">-23.24% <i class="bx bx-down-arrow-alt"></i></span>
                        </div>
                        <div id="chart-sparkline-3" class="my-2 mx-2"></div>
                    </div>
                </div>
                <div class="lg:w-1/4 md:w-1/2 w-full">
                    <div class="bg-white my-2 mx-2 border rounded-md flex-col flex h-40">
                        <div class="px-4 py-3 flex-auto">
                            <div class="pb-0 flex justify-between">
                                <div class="text-gray-600 text-sm">Feedback</div>
                                <div class="relative inline-block text-left text-sm">
                                    <a href="" class="inline-flex items-center text-gray-600 dropdown-toggle"
                                        data-dropdown="FeedbackDropdown">
                                        <span>Last 30 days </span>
                                        <i class="inline-flex items-center bx bx-chevron-down ml-1"></i>
                                    </a>

                                    <div class="origin-top-right absolute right-0 mt-1 z-10 w-48 rounded-md shadow-lg hidden"
                                        id="FeedbackDropdown">
                                        <div class="rounded-md bg-white shadow-xs" role="menu"
                                            aria-orientation="vertical" aria-labelledby="options-menu">
                                            <div class="py-1">
                                                <a href="#"
                                                    class="block px-3 py-1 leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Today</a>

                                                <a href="#"
                                                    class="block px-3 py-1 leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Last
                                                    7 days</a>

                                                <a href="#"
                                                    class="block px-3 py-1 leading-5 text-gray-600 bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Last
                                                    30 days</a>

                                                <a href="#"
                                                    class="block px-3 py-1 leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Last
                                                    60 days</a>

                                                <a href="#"
                                                    class="block px-3 py-1 leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Last
                                                    1 Year</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-3xl inline font-medium text-gray-700">456</div>
                        </div>
                        <div class="px-4 pb-6">
                            <div class="flex justify-between mb-2">
                                <div class="text-gray-700 text-sm">
                                    <b>83%</b> Good Feedback
                                </div>
                                <div>
                                    <span class="text-sm text-green-500">2.75% <i class="bx bx-up-arrow-alt"></i></span>
                                </div>
                            </div>
                            <div class="px-auto bg-gray-200">
                                <div class="bg-green-500 py-1" style="width: 83%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Content chart 1 -->

            <!-- Content chart 2 -->
            <div class="flex flex-wrap mb-2">
                <div class="md:w-2/3 w-full">
                    <div class="bg-white my-2 mx-2 border rounded-md px-2 py-4">
                        <div class="flex justify-between px-2">
                            <div>
                                <h1 class="text-2xl font-medium inline">1875</h1>
                                <span class="text-sm text-green-500">2.75% <i class="bx bx-up-arrow-alt"></i></span>
                                <div class="text-gray-700">Sales Product Categories</div>
                            </div>
                            <!--  -->
                            <div class="relative inline-block text-left text-base">
                                <a href="" class="inline-flex items-center text-gray-600 dropdown-toggle"
                                    data-dropdown="SalesCategoryDropdown">
                                    <span>Last 60 days </span>
                                    <i class="inline-flex items-center bx bx-chevron-down ml-1"></i>
                                </a>

                                <div class="origin-top-right absolute right-0 mt-1 z-10 w-48 rounded-md shadow-lg hidden"
                                    id="SalesCategoryDropdown">
                                    <div class="rounded-md bg-white shadow-xs" role="menu" aria-orientation="vertical"
                                        aria-labelledby="options-menu">
                                        <div class="py-1">
                                            <a href="#"
                                                class="block px-3 py-1 leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Today</a>

                                            <a href="#"
                                                class="block px-3 py-1 leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Last
                                                7 days</a>

                                            <a href="#"
                                                class="block px-3 py-1 leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Last
                                                30 days</a>

                                            <a href="#"
                                                class="block px-3 py-1 leading-5 text-gray-600 bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Last
                                                60 days</a>

                                            <a href="#"
                                                class="block px-3 py-1 leading-5 text-gray-600 hover:bg-gray-200 hover:text-gray-700 focus:outline-none focus:bg-gray-100 focus:text-gray-700">Last
                                                1 Year</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="chart-bar" class="flex-auto"></div>
                    </div>
                </div>
                <div class="md:w-1/3 w-full">
                    <div class="bg-white border rounded-md my-2 mx-2 no-scrollbar">
                        <div class="px-2 py-3">
                            <div class="text-gray-700 px-2 text-xl">
                                Top Sales by Country
                            </div>
                            <div id="chart-pie-1" class="flex-auto"></div>
                        </div>
                        <table class="w-full text-md bg-white rounded">
                            <tbody class="w-full">
                                <tr>
                                    <td class="px-4 py-1.5 text-gray-700 border-t w-8 border-gray-200">
                                        1
                                    </td>
                                    <td class="px-4 py-1.5 text-gray-700 border-t font-medium border-gray-200">
                                        USA
                                    </td>
                                    <td class="px-4 py-1.5 border-t border-gray-200 text-green-500 text-right">
                                        + 10% <i class="bx bx-up-arrow-alt ml-1"></i>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-1.5 text-gray-700 border-t w-8 border-gray-200">
                                        2
                                    </td>
                                    <td class="px-4 py-1.5 text-gray-700 border-t font-medium border-gray-200">
                                        India
                                    </td>
                                    <td class="px-4 py-1.5 border-t border-gray-200 text-red-500 text-right">
                                        - 12% <i class="bx bx-down-arrow-alt ml-1"></i>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-1.5 text-gray-700 border-t w-8 border-gray-200">
                                        3
                                    </td>
                                    <td class="px-4 py-1.5 text-gray-700 border-t font-medium border-gray-200">
                                        Japan
                                    </td>
                                    <td class="px-4 py-1.5 border-t border-gray-200 text-green-500 text-right">
                                        + 17% <i class="bx bx-up-arrow-alt ml-1"></i>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-1.5 text-gray-700 border-t w-8 border-gray-200">
                                        4
                                    </td>
                                    <td class="px-4 py-1.5 text-gray-700 border-t font-medium border-gray-200">
                                        Indonesia
                                    </td>
                                    <td class="px-4 py-1.5 border-t border-gray-200 text-green-500 text-right">
                                        + 11% <i class="bx bx-up-arrow-alt ml-1"></i>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End Content chart 2 -->
        </div>
        <!-- End Content -->
    </div>
    <!-- End wrapper -->

    <!-- Footer -->
    <div class="max-w-screen-xl mx-auto mb-4">
        <div class="mt-4 mx-2 flex justify-between items-center">
            <div class="text-gray-600">
                MIT License- Copyright (c) 2021
                <strong class="font-bold">Under-X</strong>
            </div>
        </div>
    </div>
    <!-- End footer -->

    <!-- Jquery plugin js -->
    <script src="{{ asset('dist/libs/jquery/jquery.slim.min.js') }}"></script>
    <!-- Apex chart plugins js -->
    <script src="{{ asset('dist/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('dist/js/jakarta-lte.min.js') }}"></script>

    <script>
      var options = {
        chart: {
          type: "area",
          fontFamily: "inherit",
          height: 50,
          sparkline: {
            enabled: true,
          },
        },
        dataLabels: {
          enabled: false,
        },

        fill: {
          opacity: 0.16,
          type: "solid",
        },
        stroke: {
          width: 2,
          lineCap: "round",
          curve: "smooth",
        },

        series: [
          {
            name: "Revenue",
            data: [
              31,
              37,
              39,
              62,
              51,
              35,
              41,
              35,
              27,
              27,
              53,
              61,
              27,
              54,
              43,
              19,
              46,
              39,
              62,
              51,
              66,
              70,
              82,
            ],
          },
        ],

        grid: {
          strokeDashArray: 4,
        },
        xaxis: {
          labels: {
            padding: 0,
          },
          tooltip: {
            enabled: false,
          },
          axisBorder: {
            show: false,
          },
          type: "datetime",
        },
        yaxis: {
          labels: {
            padding: 4,
          },
        },
        labels: [
          "2020-06-28",
          "2020-06-29",
          "2020-06-30",
          "2020-07-01",
          "2020-07-02",
          "2020-07-03",
          "2020-07-04",
          "2020-07-05",
          "2020-07-06",
          "2020-07-07",
          "2020-07-08",
          "2020-07-09",
          "2020-07-10",
          "2020-07-11",
          "2020-07-12",
          "2020-07-13",
          "2020-07-14",
          "2020-07-15",
          "2020-07-16",
          "2020-07-17",
          "2020-07-18",
          "2020-07-19",
          "2020-07-20",
        ],
        colors: ["#48bb78"],
        legend: {
          show: false,
        },
      };
      var chart1 = new ApexCharts(
        document.querySelector("#chart-sparkline-1"),
        options
      );
      chart1.render();

      var options2 = {
        chart: {
          type: "bar",
          fontFamily: "inherit",
          height: 50,
          sparkline: {
            enabled: true,
          },
        },
        dataLabels: {
          enabled: false,
        },
        fill: {
          opacity: 0.7,
          type: "solid",
        },
        stroke: {
          width: 1,
          lineCap: "round",
          curve: "smooth",
        },

        series: [
          {
            name: "Sales",
            data: [
              38,
              31,
              89,
              37,
              39,
              62,
              51,
              35,
              41,
              35,
              27,
              27,
              53,
              61,
              27,
              54,
              43,
              120,
              46,
              50,
              62,
              51,
              90,
              70,
              82,
            ],
          },
        ],

        grid: {
          strokeDashArray: 4,
        },
        xaxis: {
          labels: {
            padding: 0,
          },
          tooltip: {
            enabled: false,
          },
          axisBorder: {
            show: false,
          },
          type: "datetime",
        },
        yaxis: {
          labels: {
            padding: 4,
          },
        },
        labels: [
          "2020-06-28",
          "2020-06-29",
          "2020-06-30",
          "2020-07-01",
          "2020-07-02",
          "2020-07-03",
          "2020-07-04",
          "2020-07-05",
          "2020-07-06",
          "2020-07-07",
          "2020-07-08",
          "2020-07-09",
          "2020-07-10",
          "2020-07-11",
          "2020-07-12",
          "2020-07-13",
          "2020-07-14",
          "2020-07-15",
          "2020-07-16",
          "2020-07-17",
          "2020-07-18",
          "2020-07-19",
          "2020-07-20",
        ],
        colors: ["#48bb78"],
        legend: {
          show: false,
        },
      };
      var chart2 = new ApexCharts(
        document.querySelector("#chart-sparkline-2"),
        options2
      );
      chart2.render();

      var options3 = {
        chart: {
          type: "line",
          fontFamily: "inherit",
          height: 50,
          sparkline: {
            enabled: true,
          },
        },
        dataLabels: {
          enabled: false,
        },

        fill: {
          opacity: 0.7,
          type: "solid",
        },
        stroke: {
          width: [2, 1],
          dashArray: [0, 3],
          lineCap: "round",
          curve: "smooth",
        },

        series: [
          {
            name: "Last month",
            data: [
              31,
              37,
              39,
              62,
              51,
              35,
              14,
              35,
              27,
              27,
              21,
              61,
              27,
              54,
              43,
              120,
              46,
              50,
              62,
              121,
              90,
              70,
              82,
            ],
          },

          {
            name: "This month",
            data: [
              91,
              58,
              90,
              79,
              83,
              119,
              78,
              88,
              129,
              71,
              90,
              116,
              94,
              110,
              103,
              111,
              119,
              79,
              94,
              124,
              81,
              85,
              82,
            ],
          },
        ],

        grid: {
          strokeDashArray: 4,
        },
        xaxis: {
          labels: {
            padding: 0,
          },
          tooltip: {
            enabled: false,
          },
          axisBorder: {
            show: false,
          },
          type: "datetime",
        },
        yaxis: {
          labels: {
            padding: 4,
          },
        },
        labels: [
          "2020-06-28",
          "2020-06-29",
          "2020-06-30",
          "2020-07-01",
          "2020-07-02",
          "2020-07-03",
          "2020-07-04",
          "2020-07-05",
          "2020-07-06",
          "2020-07-07",
          "2020-07-08",
          "2020-07-09",
          "2020-07-10",
          "2020-07-11",
          "2020-07-12",
          "2020-07-13",
          "2020-07-14",
          "2020-07-15",
          "2020-07-16",
          "2020-07-17",
          "2020-07-18",
          "2020-07-19",
          "2020-07-20",
        ],
        colors: ["#48bb78"],
        legend: {
          show: false,
        },
      };
      var chart3 = new ApexCharts(
        document.querySelector("#chart-sparkline-3"),
        options3
      );
      chart3.render();

      // chart
      var options_bar = {
        series: [
          {
            name: "Admin Template",
            data: [
              91,
              58,
              90,
              79,
              83,
              119,
              78,
              88,
              129,
              71,
              90,
              116,
              94,
              110,
              103,
              111,
              119,
              79,
              94,
              124,
              81,
              85,
              82,
              79,
              94,
              124,
              119,
              79,
              94,
              124,
              81,
              90,
              116,
            ],
          },
          {
            name: "Themes Tailwindcss",
            data: [
              31,
              37,
              39,
              62,
              51,
              35,
              14,
              35,
              27,
              27,
              21,
              61,
              27,
              54,
              43,
              120,
              46,
              50,
              62,
              121,
              90,
              70,
              82,
              61,
              27,
              54,
              39,
              62,
              51,
              35,
              14,
              27,
              21,
              61,
            ],
          },
          {
            name: "Wordpress Themes",
            data: [
              31,
              37,
              39,
              62,
              51,
              35,
              41,
              35,
              27,
              27,
              53,
              61,
              27,
              54,
              43,
              120,
              46,
              50,
              62,
              51,
              90,
              70,
              82,
              90,
              70,
              82,
              35,
              27,
              27,
              53,
              61,
              53,
              61,
              27,
            ],
          },
        ],
        chart: {
          type: "bar",
          height: 350,
          stacked: true,
          toolbar: {
            show: false,
          },
          zoom: {
            enabled: false,
          },
        },
        responsive: [
          {
            breakpoint: 480,
            options: {
              legend: {
                position: "bottom",
                offsetX: -10,
                offsetY: 0,
              },
            },
          },
        ],
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: "50%",
          },
        },

        dataLabels: {
          enabled: false,
        },
        xaxis: {
          type: "datetime",
          categories: [
            "2020-06-28",
            "2020-06-29",
            "2020-06-30",
            "2020-07-01",
            "2020-07-02",
            "2020-07-03",
            "2020-07-04",
            "2020-07-05",
            "2020-07-06",
            "2020-07-07",
            "2020-07-08",
            "2020-07-09",
            "2020-07-10",
            "2020-07-11",
            "2020-07-12",
            "2020-07-13",
            "2020-07-14",
            "2020-07-15",
            "2020-07-16",
            "2020-07-17",
            "2020-07-18",
            "2020-07-19",
            "2020-07-20",
            "2020-07-21",
            "2020-07-22",
            "2020-07-23",
            "2020-07-24",
            "2020-07-25",
            "2020-07-26",
            "2020-07-27",
            "2020-07-28",
            "2020-07-29",
            "2020-07-30",
          ],
        },
        stroke: {
          show: true,
          width: 2,
          colors: ["transparent"],
        },
        fill: {
          opacity: 1,
        },
        legend: {
          position: "bottom",
        },
        // colors: ["#f6ad55","#4299e1","#48bb78"],
        colors: ["#48bb78", "#4299e1", "#fbd38d"],
      };

      var chart1 = new ApexCharts(
        document.querySelector("#chart-bar"),
        options_bar
      );
      chart1.render();

      var options_chart_2 = {
        series: [332, 185, 151, 87],
        chart: {
          type: "donut",
          width: "100%",
          height: 400,
        },
        plotOptions: {
          pie: {
            customScale: 0.85,
            donut: {
              size: "67%",
            },
          },
          stroke: {
            colors: undefined,
          },
        },
        colors: ["#2f855a", "#38a169", "#48bb78", "#68d391"],

        labels: ["USA", "India", "Japan", "Indonesia"],

        responsive: [
          {
            breakpoint: 480,
            options: {
              chart: {
                width: 200,
              },
              legend: {
                position: "bottom",
              },
            },
          },
        ],
      };

      var chart = new ApexCharts(
        document.querySelector("#chart-pie-1"),
        options_chart_2
      );
      chart.render();
    </script>
</body>

</html>
