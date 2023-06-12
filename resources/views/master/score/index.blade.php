@extends('main')
@section('title')
<h3 class="text-gray-600 text-md">
    <a href="" class="text-green-500">
        <i class="bx bx-home mr-1"></i>
        Master
    </a>
    / Score
</h3>
@endsection
@section('content')
<div class="flex justify-between m-2 mr-0">
    <div>
        <h1 class="text-2xl mt-1 font-medium">Data Score Student</h1>
    </div>
</div>

<div class="flex justify-between m-2 mr-0">
    <input type="text" id="Input" onkeyup="myFunction()" placeholder="Search for Name" title="Type in a name" class="px-2 py-1 border rounded" {{$scores->count() != 0 ? '' : 'disabled'}}>
</div>

@if ($scores->count() != 0)
<div class="bg-white m-2 mr-0 border rounded-md flex-col flex">
    <div class="relative overflow-x-auto no-scrollbar sm:rounded-lg px-4 py-3 pb-0">
        <table class="w-full text-sm text-left text-gray-500" id="Table">
            <thead class="w-full text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-3 py-3 text-left">
                        Student Name
                    </th>
                    <th scope="col" class="px-3 py-3 text-left">
                        Scoring By?
                    </th>
                    <th scope="col" class="px-3 py-3 text-left">
                        Point
                    </th>
                    <th scope="col" class="px-3 py-3 text-left">
                        Score Grade
                    </th>
                    <th scope="col" class="px-3 py-3 text-left">
                        Date
                    </th>
                    {{-- <th scope="col" class="px-3 py-3 text-left">
                        <span class="sr-only">View</span>
                    </th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($scores as $item)
                <tr class="bg-white hover:bg-gray-50">
                    <td class="px-3 py-2 font-medium text-gray-900 capitalize">
                        <a class="hover:underline" href="{{Route('student.get.detail', $item->student_id)}}">{{ $item->student->user->name }}</a>
                    </td>
                    <td class="px-3 py-2">
                        {{ $item->user->name }}
                    </td>
                    <td class="px-3 py-2">
                        {{ $item->point }}
                    </td>
                    <td class="px-3 py-2 font-medium">
                        {{ $item->score_grade }}
                    </td>
                    <td class="px-3 py-2">
                        {{ $item->created_at->format('d-M-Y') }}
                    </td>
                    {{-- <td class="px-3 py-2 text-right">
                        <button type="button" class="font-medium text-green-500 " data-bs-toggle="modal" data-bs-target="#attendanceModal{{ $item->id }}"> View </button>
                    </td> --}}
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@else  
<div class="bg-white m-2 mr-0 rounded-md h-48">
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <lottie-player src="https://assets9.lottiefiles.com/packages/lf20_hl5n0bwb.json"  background="transparent" speed="1" loop autoplay></lottie-player>
    <p class="text-center mt-3 text-lg">oops, nothing here</p> 
</div>
@endif

<div class="flex justify-between m-2 mr-0">
    <div>
        <h1 class="text-2xl mt-1 font-medium">Master</h1>
    </div>
</div>

<div class="flex justify-between m-2 mr-0">
    <input type="text" id="Input" onkeyup="myFunction()" placeholder="Search for Name" title="Type in a name" class="px-2 py-1 border rounded" {{$scores->count() != 0 ? '' : 'disabled'}}>

    <a class="px-4 py-2 text-sm border border-transparent rounded bg-green-500 text-white hover:bg-green-500 focus:outline-none focus:border-green-500 focus:shadow-outline-green active:bg-green-500 transition duration-150 ease-in-out inline-flex items-center font-semibold"
    href="">
        <i class="bx bx-plus mr-2 text-base"></i>
        Create
    </a>
</div>

<div class="bg-white m-2 mr-0 border rounded-md flex-col flex">
    <div class="relative overflow-x-auto no-scrollbar sm:rounded-lg px-4 py-3 pb-0">
        <table class="w-full text-sm text-left text-gray-500" id="Table">
            <thead class="w-full text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-3 py-3 text-left">
                        Form
                    </th>
                    <th scope="col" class="px-3 py-3 text-left">
                        Scoring Type
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($formscores as $item)
                <tr class="bg-white hover:bg-gray-50">
                    <td class="px-3 py-2 capitalize">
                        {{ $item->form }}
                    </td>
                    <td class="px-3 py-2 capitalize">
                        {{ $item->score_type->scoring_type }}
                    </td>
                    {{-- <td class="px-3 py-2 text-right">
                        <button type="button" class="font-medium text-green-500 " data-bs-toggle="modal" data-bs-target="#attendanceModal{{ $item->id }}"> View </button>
                    </td> --}}
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- modal --}}

@endsection

@section('js')
<script src="{{ asset('view/searchFilter.js') }}"></script>
@endsection