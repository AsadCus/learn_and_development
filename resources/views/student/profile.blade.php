@extends('main')

@section('title')
<h3 class="text-gray-600 text-sm">
    <a href="" class="text-green-500">
        <i class="bx bx-home mr-1"></i>
        Profile
    </a>
    / {{ Auth::user()->name }}
</h3>
@endsection

@section('content')
<div class="flex justify-between ml-2 mt-2">
    <div>
        <h1 class="text-2xl font-medium">Data Student</h1>
    </div>

    {{-- <a class="px-4 py-2 text-sm border border-transparent rounded bg-green-500 text-white hover:bg-green-500 focus:outline-none focus:border-green-500 focus:shadow-outline-green active:bg-green-500 transition duration-150 ease-in-out inline-flex items-center font-semibold"
    href="{{ route('student.create') }}">
    <i class="bx bx-plus mr-2 text-base"></i>
    Create
    </a> --}}
</div>
@foreach($profiles as $profile)
<div class="flex flex-col md:flex-row">
    <div class="bg-white my-2 ml-2 border rounded-md p-4 w-auto md:w-1/4 h-96">
        <a href="{{ route('profile.student.edit', Auth::user()->student_id) }}" class="hover:text-slate-500">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-pencil-square my-auto ml-auto hover:text-slate-300" viewBox="0 0 16 16">
                <path
                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                <path fill-rule="evenodd"
                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
            </svg>
        </a>
        <img src={{Auth::user()->image ? asset('profile/'.Auth::user()->image)  : asset('dist/avatar/profile_default.png') }}
            alt="{{Auth::user()->image}}" class="h-36 w-24 mx-auto my-4 rounded-sm">
        <p class="text-center text-lg font-medium capitalize"> {{Auth::user()->name}} </p>
        <p class="text-center text-base font-normal my-2 capitalize"> {{$profile->student->job_role}} </p>
        <p class="text-center text-base font-nromal my-2"> {{$profile->student->phone}} </p>
        <div class="rounded border p-2 mt-5">
            <div class="flex">
                <p class="my-auto font-bold w-2/12">CV</p>
                @if($profile->student->cv)
                <a href="{{asset('files/'.$profile->student->cv)}}" class="px-3 truncate w-8/12"
                    target="_blank">{{$profile->student->cv}}</a>
                    <button class="ml-4 outline-none"  data-bs-toggle="modal" data-bs-target="#deleteCV-{{$profile->student->id}}-Modal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-file-earmark-excel" viewBox="0 0 16 16">
                            <path
                                d="M5.884 6.68a.5.5 0 1 0-.768.64L7.349 10l-2.233 2.68a.5.5 0 0 0 .768.64L8 10.781l2.116 2.54a.5.5 0 0 0 .768-.641L8.651 10l2.233-2.68a.5.5 0 0 0-.768-.64L8 9.219l-2.116-2.54z" />
                            <path
                                d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                        </svg>
                    </button>
                    {{-- confirm modal --}}
                    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="deleteCV-{{$profile->student->id}}-Modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-relative w-auto pointer-events-none">
                            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                                <div
                                    class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                                    <p class="text-2xl font-medium leading-normal text-gray-800" id="exampleModalLabel">
                                        Are You Sure?
                                    </p>
                                </div>
                                <div class="modal-body items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                                    <p class="text-sm">this action <span class="font-medium">can't be canceled</span> when click delete button <br> (please check again)</p>
                                    <div class="mt-4 flex">
                                        <button type="button" class="inline-block px-4 py-2 bg-gray-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-600 hover:shadow-lg focus:bg-gray-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-700 active:shadow-lg transition duration-150 ease-in-out" data-bs-dismiss="modal">Cancel</button>
                                        <form action="{{route('profile.student.del.cv', Auth::user()->student_id)}}" method="POST">
                                            @method('put')
                                            @csrf
                                            <button type="submit" class="inline-block px-4 py-2 bg-red-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md transition duration-150 ease-in-out ml-1">Delete</button>
                                            <button type="submit">
                                                
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- confirm modal --}}
                <form action="{{route('profile.student.del.cv', Auth::user()->student_id)}}" method="POST">
                    @method('put')
                    @csrf
                    <button type="submit">
                        
                    </button>
                </form>
                @else
                <button href="" class="ml-auto my-auto" data-bs-toggle="modal"
                    data-bs-target="#editCVModal{{ Auth::user()->student_id }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path
                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd"
                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                    </svg>
                </button>
                @endif
            </div>
        </div>
    </div>
    <div class="w-auto md:w-3/4">
        <div class="bg-white my-2 ml-2 border rounded-md p-4">
            <p class="text-xl font-semibold mb-4">Info</p>
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/2 w-full">
                    <p class="text-base mb-2 font-medium"> Institute : <span class="font-normal capitalize">
                            {{$profile->student->institute->name}} </span> </p>
                    <p class="text-base mb-2 font-medium"> Major : <span class="font-normal capitalize">
                            {{$profile->student->major}} </span></p>
                    <p class="text-base mb-2 font-medium"> IPK : <span class="font-normal"> {{$profile->student->ipk}}
                        </span></p>
                    <p class="text-base mb-2 font-medium"> Emergency Contact : <span class="font-normal">
                            {{$profile->student->emergency_contact}} </span></p>
                </div>
                <div class="md:w-1/2 w-full">
                    <p class="text-base mb-2 font-medium"> Division : <span class="font-normal capitalize">
                            {{$profile->student->division}} </span></p>
                    <p class="text-base mb-2 font-medium"> Departement : <span class="font-normal capitalize">
                            {{$profile->student->department}} </span></p>
                    @if(Auth::user()->role == "student")
                    <p class="text-base mb-2 font-medium"> PIC : <span class="font-normal capitalize"> {{$PIC}} </span>
                    </p>
                    <p class="text-base mb-2 font-medium"> End Date: <span class="font-normal capitalize">
                            {{$profile->student->end_date->format('d F Y')}} </span></p>
                    @endif
                </div>
            </div>
        </div>
        <div class="bg-white my-2 ml-2 border overflow-hidden rounded-md max-h-48 p-3">
            <div class="flex justify-between mb-1">
                <p class="text-xl font-semibold mb-4">File</p>
                <button data-bs-toggle="modal" data-bs-target="#uploadDocModal"
                    class="px-2 py-0 text-xs md:text-base rounded bg-green-500 text-white hover:bg-green-500  inline-flex items-center font-semibold">
                    Upload Document
                </button>
            </div>
            <div class="max-h-24 overflow-hidden overflow-y-scroll">
                <div class="flex flex-wrap gap-2">
                    @foreach($document->where('student_id', Auth::user()->student_id) as $item)
                    <div class="rounded border px-3 py-2  max-h flex">
                        <div class="flex truncate ...">
                            <a href="{{asset('files/'.$item->document)}}" target="_blank">
                                <p class="my-auto capitalize font-bold  ">{{$item->type }} <span
                                        class="font-normal">{{$item->document}}</span></p>
                            </a>
                        </div>
                        <button class="ml-2"  data-bs-toggle="modal" data-bs-target="#deleteDoc-{{$item->id}}-Modal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-file-earmark-excel my-auto ml-auto" viewBox="0 0 16 16">
                                    <path
                                        d="M5.884 6.68a.5.5 0 1 0-.768.64L7.349 10l-2.233 2.68a.5.5 0 0 0 .768.64L8 10.781l2.116 2.54a.5.5 0 0 0 .768-.641L8.651 10l2.233-2.68a.5.5 0 0 0-.768-.64L8 9.219l-2.116-2.54z" />
                                    <path
                                        d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                                </svg>
                        </button>
                        {{-- confirm modal --}}
                        <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="deleteDoc-{{$item->id}}-Modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-relative w-auto pointer-events-none">
                                <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                                    <div
                                        class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                                        <p class="text-2xl font-medium leading-normal text-gray-800" id="exampleModalLabel">
                                            Are You Sure?
                                        </p>
                                    </div>
                                    <div class="modal-body items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                                        <p class="text-sm">this action <span class="font-medium">can't be canceled</span> when click delete button <br> (please check again)</p>
                                        <div class="mt-4 flex">
                                            <button type="button" class="inline-block px-4 py-2 bg-gray-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-600 hover:shadow-lg focus:bg-gray-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-700 active:shadow-lg transition duration-150 ease-in-out" data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{route('student.destroy.doc', $item->id)}}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="inline-block px-4 py-2 bg-red-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md transition duration-150 ease-in-out ml-1">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- confirm modal --}}
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<div class="flex flex-col md:flex-row">
    <div class="bg-white my-2 ml-2 border rounded-md flex-col flex justify-between p-4 md:w-1/4">
        <p class="text-xl font-semibold mb-4">Attendance</p>

        <div class="mx-auto">
            <p>{{ $today->format('l, d M Y') }}</p>
        </div>

        <div id="MyClockDisplay" class="clock mx-auto my-3 text-3xl" onload="showTime()"></div>

        {{-- button --}}
        @if($attendance == null)
        <div class="mx-auto">
            <button data-bs-toggle="modal" data-bs-target="#clockInModal" class="bg-green-500 px-6 lg:px-9 rounded-md py-2">
                <span class="text-white text-lg lg:text-2xl">Clock In</span>
            </button>
        </div>
        @endif

        @if ($attendance != null)
            @if ($attendance->clock_out != null)
            <div class="mx-auto">
                <button data-bs-toggle="modal" data-bs-target="#afterClockOutModal" class="bg-yellow-500 px-6 lg:px-10 rounded-md py-2 " type="button">
                    <span class="text-white text-lg lg:text-2xl">View</span>
                </button>
            </div>
            @else
            <div class="mx-auto">
                <button data-bs-toggle="modal" data-bs-target="#clockOutModal" class="bg-red-500 px-6 lg:px-10 rounded-md py-2"
                    type="button">
                    <span class="text-white text-lg lg:text-xl">Clock Out</span>
                </button>
            </div>
            @endif
        @endif
    </div>
    <div class="w-auto md:w-3/4 bg-white my-2 ml-2 border rounded-md p-4 pb-0">
        <div class="flex justify-between">
            <p class="text-xl font-semibold">Log Attendance</p>
            <input type="text" class="px-2 py-1 rounded border ml-2" name="daterange"/>
        </div>
        <div class="overflow-x-scroll relative rounded h-44 mb-3">
            <table class="w-full text-sm text-gray-500 ">
                <thead class="w-full text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="p-2 whitespace-nowrap w-1/5 text-left">
                            Date
                        </th>
                        <th scope="col" class="p-2 whitespace-nowrap w-1/5 text-left">
                            Clock In
                        </th>
                        <th scope="col" class="p-2 whitespace-nowrap w-1/5 text-left">
                            Clock Out
                        </th>
                        <th scope="col" class="p-2 whitespace-nowrap w-1/5 text-left">
                            Working Hour
                        </th>
                        <th scope="col" class="p-2 w-1/5 text-left">
                            Attendance
                        </th>
                    </tr>
                </thead>
                <tbody class="w-full" class="w-full overflow-auto">
                    @foreach ($indexattendance->where('user_id', Auth::user()->id)->sortByDesc('clock_in') as $item)
                    <tr class="bg-white hover:bg-gray-50">
                        <td class="px-3 py-2 whitespace-nowrap w-1/5 text-left">
                            {{ $item->clock_in->format('d M Y') }}
                        </td>
                        <td class="px-3 py-2 whitespace-nowrap w-1/5 text-left">
                            {{ $item->clock_in->format('H:i:s') }}
                        </td>
                        <td class="px-3 py-2 whitespace-nowrap w-1/5 text-left">
                            {{ $item->clock_out ? $item->clock_out->format('H:i:s') : '' }}
                        </td>
                        <td class="px-3 py-2 capitalize whitespace-nowrap w-1/5 text-left">
                            {{ $item->working_hour ? $item->working_hour->format('H:i:s') : '' }}
                        </td>
                        <td class="px-3 py-2 capitalize w-1/5 text-left">
                            {{ $item->attendance_type }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- modal edit cv --}}
<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="editCVModal{{ Auth::user()->student_id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-relative w-auto pointer-events-none">
        <div
            class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
            <div
                class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLabel">
                    upload CV
                </h5>
                <button type="button"
                    class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                <form action="{{route('profile.student.put.cv', Auth::user()->student_id)}}"
                    enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="flex-row lg:flex mt-2">
                        <div class="rounded-lg border bg-gray-50 w-full">
                            <div class="m-4">
                                <label for="file" class="drop-container">
                                    <span class="drop-title">Upload CV (PDF only)</span>
                                    <span class="text-xs text-gray-500">max: 5 mb</span>
                                    <input type="file" name="cv" accept=".pdf" required />
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="submit"
                            class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-500 hover:shadow-lg focus:bg-green-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out ml-1">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- modal clock in --}}
<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="clockInModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog relative w-auto pointer-events-none">
        <div
            class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
            <div
                class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLabel">
                    Clock In
                </h5>
                <button type="button"
                    class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('profile.student.put.clockin') }}" method="POST" id="clockInForm">
                @csrf
                <div class="modal-body relative p-4">
                    <div class="flex gap-6">

                            <label class="card w-96">
                                <input type="radio" id="WFH" name="work_type" value="WFO" class="radio" required checked>
                                <span class="plan-details">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor"
                                        class="bi bi-building-fill-check mb-4" viewBox="0 0 16 16">
                                        <path
                                            d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514Z" />
                                        <path
                                            d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v7.256A4.493 4.493 0 0 0 12.5 8a4.493 4.493 0 0 0-3.59 1.787A.498.498 0 0 0 9 9.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .39-.187A4.476 4.476 0 0 0 8.027 12H6.5a.5.5 0 0 0-.5.5V16H3a1 1 0 0 1-1-1V1Zm2 1.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5Zm3 0v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5Zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1ZM4 5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5ZM7.5 5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm2.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5ZM4.5 8a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Z" />
                                    </svg>
                                    <span class="text-green-500 font-bold text-2xl md:text-4xl">WFO</span>
                                    <span class="text-xs">Work From Office</span>
                                </span>
                            </label>
                            <label class="card w-96">
                                <input type="radio" id="WFH" name="work_type" value="WFH" class="radio" required>
                                <span class="plan-details" aria-hidden="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor"
                                        class="bi bi-house-check mb-4" viewBox="0 0 16 16">
                                        <path
                                            d="M7.293 1.5a1 1 0 0 1 1.414 0L11 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l2.354 2.353a.5.5 0 0 1-.708.708L8 2.207l-5 5V13.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 1 0 1h-4A1.5 1.5 0 0 1 2 13.5V8.207l-.646.647a.5.5 0 1 1-.708-.708L7.293 1.5Z" />
                                        <path
                                            d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.707l.547.547 1.17-1.951a.5.5 0 1 1 .858.514Z" />
                                    </svg>
                                    <span class="text-green-500 font-bold text-2xl md:text-4xl">WFH</span>
                                    <span class="text-xs">Work From Home</span>
                                </span>
                            </label>

                    </div>
                    <input type="text" name="user_id" value="{{Auth::id()}}" hidden>
                    <input type="text" name="attendance_type" value="pending" hidden>
                </div>
            </form>
            <div
                class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                <button type="button"
                    class="inline-block px-6 py-2.5 bg-red-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-500 hover:shadow-lg focus:bg-red-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-700 active:shadow-lg transition duration-150 ease-in-out"
                    data-bs-dismiss="modal">Cancel</button>
                <button type="button"
                    class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-500 hover:shadow-lg focus:bg-green-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out ml-1"
                    data-bs-toggle="modal" data-bs-target="#confimModal"> Clock In </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="confimModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog relative w-auto pointer-events-none">
        <div
            class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
            <div class="modal-body relative p-4">
                <p class="text-2xl "> Are You Sure? </p>
            </div>
            <div
                class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                <button type="button"
                    class="inline-block px-6 py-2.5 bg-red-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md transition duration-150 ease-in-out"
                    data-bs-toggle="modal" data-bs-target="#clockInModal">Cancel</button>
                <a href="javascript:$('#clockInForm').submit();"
                    class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md transition duration-150 ease-in-out ml-1">Clock
                    In</a>
            </div>
        </div>
    </div>
</div>

{{-- modal clock out --}}
@if ($attendance != null)
<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="clockOutModal" tabindex="-1" aria-labelledby="clockOutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg relative w-auto pointer-events-none">
        <div
            class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
            <div
                class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLabel">Clock
                    Out Form</h5>
            </div>
            <form action="{{ route('profile.student.put.clockout', ['id' => $attendance->id]) }}" method="POST"
                id="clock-out-form" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="modal-body relative p-4">
                    <input type="hidden" name="attendance_type" value="pending">
                    <div class="py-3">
                        <label for="">Activity</label>
                        <input type="text" name="activity"
                            class="p-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full"
                            required>
                    </div>
                    <div class="py-3 ">
                        <label for="">Attachement</label>
                        <br>
                        <input type="file" name="attachment"
                            class=" mt-2 w-full p-2 text-sm font-normal text-gray-700 bg-white" required>
                    </div>
                    <div class="py-3">
                        <label for="">Note</label>
                        <textarea name="notes" placeholder="Optional a note..." rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>
                </div>
                <div
                    class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                    <button type="button"
                        class="px-6 py-2.5 bg-gray-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-600 hover:shadow-lg focus:bg-gray-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-700 active:shadow-lg transition duration-150 ease-in-out"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit"
                        class="px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-500 hover:shadow-lg focus:bg-green-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out ml-1">Clock
                        Out</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if ($attendance != null)
@if ($attendance->clock_out != null)
{{-- modal after clockout --}}
<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="afterClockOutModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog relative w-auto pointer-events-none">
        <div
            class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
            <div
                class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLabel">
                    Attendance
                </h5>
                <button type="button"
                    class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body relative p-4">
                <p>Date : {{ $attendance->clock_in->format('l, d F Y') }}</p>
                <p>Clock In : {{ $attendance->clock_in->format('H:i:s A') }} </p>
                <p>Clock Out : {{ $attendance->clock_out->format('H:i:s A') }}</p>
                <p>Working Hour : {{ $attendance->working_hour->format('H:i:s') }}</p>
            </div>
        </div>
    </div>
</div>
@endif
@endif

{{-- modal upload files --}}
<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="uploadDocModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-relative w-auto pointer-events-none">
        <div
            class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
            <div
                class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLabel">
                    upload Document
                </h5>
                <button type="button"
                    class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                <form action="{{ Route('student.post.doc') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="flex-row lg:flex mt-2">
                        <div class="rounded-lg border bg-gray-50 w-full">
                            <div class="m-4">
                                <label for="file" class="drop-container">
                                    <span class="drop-title">Upload document (PDF, DOC, PPT)</span>
                                    <span class="text-xs text-gray-500">max: 5 mb</span>
                                    {{-- <input type="file" name="document" required> --}}
                                    <input type="file" name="document"
                                        accept=".pdf, .ppt, .pptx, .pps, .ppsx, .doc, .docx, .xml,application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                                        required />
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 flex-row sm:flex">
                        <label class="w-1/5 inline py-2 pr-4 text-right">Name</label>
                        <div class="w-full">
                            <input
                                class="focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none w-full text-base placeholder-gray-400 place-content-stretch border border-gray-300 rounded py-1.5 px-3"
                                type="text" name="type" placeholder="Enter document name (eg. graduation letter)"
                                required />
                        </div>
                    </div>
                    <input type="hidden" name="student_id" value="{{Auth::user()->student_id}}">
                    <div class="mt-2">
                        <button type="submit"
                            class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-500 hover:shadow-lg focus:bg-green-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out ml-1">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('dist/css/attendanceForm.css') }}">
@endsection

@section('js')
<script src="{{ asset('view/profile.js') }}"></script>
<script src="{{ asset('view/attendance.js') }}"></script>
@endsection
