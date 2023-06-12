@extends('main')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/htree.css') }}">
@endsection
@section('title')
    <h3 class="text-gray-600 text-md">
        <a href="" class="text-green-500">
            <i class="bx bx-home mr-1"></i>
            Home
        </a>
        / Dashboard
    </h3>

    {{-- <div>
    <h1 class="text-2xl mt-1 font-medium">Dashboard</h1>
</div> --}}
@endsection
@section('content')
    <div class="flex justify-between m-2 mr-0">
        <div>
            <h1 class="text-2xl mt-1 font-medium">Dashboard</h1>
        </div>
    </div>

    <!-- Content chart 1 -->
    <div class="flex flex-wrap h-40">
        <div class="md:w-2/4 w-full h-full">
            <div class="bg-white ml-2 border rounded-md h-full">
                <div class="px-3 py-2 flex-auto">
                    <div class="flex justify-between">
                        <div class="text-gray-600 text-xl">Active Student</div>
                        <input type="text" class="px-2 py-1 rounded border" name="daterange" />
                    </div>
                    <div class="mt-2">
                        <div class="text-3xl inline font-medium text-gray-700">
                            <a
                                href="{{ route('student.get.index', ['start_date' => 1, 'end_date' => 2]) }}">{{ $students->count() }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="md:w-2/4 w-full h-full">
            <div class="bg-white ml-2 border rounded-md h-full">
                <div class="px-3 py-2 h-full">
                    <div class="text-gray-600 text-lg">About To End</div>
                    <div class="mt-2 h-full">
                        <div class="text-3xl inline font-medium text-gray-700 h-full">
                            <div class="overflow-x-auto sm:rounded-lg h-3/4">
                                <table class="w-full text-sm text-left text-gray-500">
                                    <tbody>
                                        @foreach ($upcomingstudents as $item)
                                            <tr class="bg-white hover:bg-gray-50">
                                                <th scope="row"
                                                    class="p-2 font-medium text-gray-900 whitespace-nowrap capitalize">
                                                    <a class="hover:underline"
                                                        href="{{ Route('student.get.detail', $item->id) }}">{{ $item->user->name }}</a>
                                                </th>
                                                <td class="p-2 capitalize whitespace-nowrap ">
                                                    {{ $item->department }}
                                                </td>
                                                <td class="p-2 capitalize whitespace-nowrap">
                                                    {{ $item->division }}
                                                </td>
                                                <td class="p-2 whitespace-nowrap">
                                                    {{ $item->end_date->format('d-M-Y') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Content chart 1 -->

    <!-- Table -->
    <div class="bg-white m-2 mr-0 px-3 py-2 border rounded-md flex-col flex h-96">
        <p class="text-2xl font-medium">Score</p>
        <div class="relative overflow-x-auto no-scrollbar sm:rounded-lg py-3 pb-0">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-3 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-3 py-3">
                            Supervisor
                        </th>
                        <th scope="col" class="px-3 py-3">
                            institute
                        </th>
                        <th scope="col" class="px-3 py-3">
                            Department
                        </th>
                        <th scope="col" class="px-3 py-3">
                            Point
                        </th>
                        <th scope="col" class="px-3 py-3">
                            Score
                        </th>
                        <th scope="col" class="px-3 py-3">
                            Date
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($scores as $item)
                        <tr class="bg-white hover:bg-gray-50">
                            <th scope="row" class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap capitalize">
                                <a class="hover:underline"
                                    href="{{ Route('student.get.detail', $item->student->id) }}">{{ $item->student->user->name }}</a>
                            </th>
                            <td class="px-3 py-2 capitalize">
                                {{ $item->student->supervisor->user->name }}
                            </td>
                            <td class="px-3 py-2 capitalize whitespace-nowrap">
                                {{ $item->student->institute ? $item->student->institute->name : '-' }}
                            </td>
                            <td class="px-3 py-2 capitalize whitespace-nowrap">
                                {{ $item->student->department }}
                            </td>
                            <td class="px-3 py-2 capitalize whitespace-nowrap">
                                {{ $item->point }}
                            </td>
                            <td class="px-3 py-2 capitalize whitespace-nowrap font-medium text-gray-900">
                                {{ $item->score_grade }}
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap">
                                {{ $item->created_at->format('d-M-Y') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- End Table -->

    <div class="bg-white m-2 mr-0 px-3 py-2 border rounded-md flex-col flex">
        <div class="flex justify-between">
            <p class="text-2xl font-medium">Hirearchy</p>
            <input type="text" id="search-hirearchy" class="px-2 py-1 rounded border capitalize" name="name"
                placeholder="Start Point" />
        </div>
        {{-- <div class="relative overflow-x-auto no-scrollbar sm:rounded-lg py-3 pb-0"> --}}
        <div id="body-tree"></div>
        {{-- </div> --}}
    </div>
@endsection

@section('js')
    <script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>
    <script src="{{ asset('view/student.js') }}"></script>
    <script src="{{ asset('view/htree.js') }}"></script>
@endsection
