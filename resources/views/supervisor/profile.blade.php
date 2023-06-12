@extends('main')
@section('title')
<h3 class="text-gray-600 text-sm capitalize">
    @if(Auth::user()->role === 'admin')
    <a href="{{route('student.get.index')}}" class="text-green-500">
        <i class="bx bx-home mr-1"></i>
        Master
    </a>
    <a href="{{ route('student.get.index') }}" class="text-green-500">
        / Student
    </a>
    @endif
    @if(Auth::user()->role === 'supervisor')
    <a href="" class="text-green-500">
        <i class="bx bx-home mr-1"></i>
        Profile
    </a>
    <a href="{{ route('profile.supervisor') }}" class="text-green-500">
        / {{ Auth::user()->name }}
    </a>
    @endif
    / {{ $student->user->name }}
</h3>
@endsection
@section('content')
<div class="flex justify-between my-2">
  <div>
      <h1 class="text-2xl mx-2 font-medium">Student Profile</h1>
  </div>
  
  <form action="{{ route('export.absen') }}" method="get">
    @csrf
    <input type="text" class="px-4 py-2 rounded border" name="daterange"/>
    <input type="text" class="px-4 py-2 rounded border" name="user_id" value="{{ $student->user->id }}" hidden/>
    <button class="px-4 py-2 text-sm border border-transparent rounded bg-green-500 text-white hover:bg-green-500 focus:outline-none focus:border-green-500 focus:shadow-outline-green active:bg-green-500 transition duration-150 ease-in-out inline-flex items-center font-semibold">
        Export Attendance
    </button>
  </form>
</div>
{{-- profile --}}
<div class="flex flex-col md:flex-row">
    <div class="bg-white mb-2 ml-2 border rounded-md p-4 w-auto md:w-1/4 h-72">
        <img src={{$student->user->image ? asset('profile/'.$student->user->image)  : asset('dist/avatar/profile_default.png') }} class="h-36 mx-auto my-4">
        <p class="text-center text-lg font-medium"> {{$student->user->name}} </p>
        <p class="text-center text-base font-normal my-2 capitalize"> {{$student->job_role}} </p>
    </div>
    <div class="w-auto md:w-3/4">
        <div class="bg-white mb-2 ml-2 border rounded-md p-4 h-72">
            <div class="flex">
                <p class="text-xl font-semibold mb-4">Info</p>
                @if(Auth::user()->role == "admin")  
                <a href="{{ route ('student.edit', $student->id ) }}" class="ml-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                      </svg>
                </a>
                @endif
            </div>
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/2 w-full">
                    <p class="text-base mb-2 font-medium"> Universitas : <span class="font-normal capitalize"> {{$student->institute->name}} </span> </p>
                    <p class="text-base mb-2 font-medium"> Jurusan : <span class="font-normal capitalize"> {{$student->major}} </span></p>
                    <p class="text-base mb-2 font-medium"> IPK : <span class="font-normal"> {{$student->ipk}} </span></p>
                    <p class="text-base mb-2 font-medium"> Emergency Contact : <span class="font-normal"> {{$student->emergency_contact}} </span></p>
                    <p class="text-base mb-2 font-medium"> Phone : <span class="font-medium"> {{$student->phone}} </span></p>
                </div>
                <div class="md:w-1/2 w-full">
                    <p class="text-base mb-2 font-medium"> Divisi : <span class="font-normal capitalize"> {{$student->division}} </span></p>
                    <p class="text-base mb-2 font-medium"> Departemen : <span class="font-normal capitalize"> {{$student->department}} </span></p>
                    <p class="text-base mb-2 font-medium"> Start Date: <span class="font-normal capitalize"> {{$student->start_date->format('d F Y')}} </span></p>
                    <p class="text-base mb-2 font-medium"> End Date: <span class="font-normal capitalize"> {{$student->end_date->format('d F Y')}} </span></p>
                    <p class="text-base mb-2 font-medium"> Status : <span class="font-medium {{$student->user->status == 'active' ? 'text-green-500' : 'text-gray-400'}} capitalize"> {{$student->user->status}} </span></p>
                </div>
            </div>
            <div class="mt-2">
                <div class="rounded border p-2 mt-3">
                    <div class="flex">
                        <p class="my-auto font-bold w-1/12">CV</p>
                        <a href="{{asset('files/'.$student->cv)}}" target="_blank" class="px-3 truncate">{{$student->cv}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @endforeach --}}
{{-- track record per user --}}

<div class="flex flex-col md:flex-row">
  <div class="bg-white my-2 ml-2 border rounded-md p-4 w-auto md:w-1/2">
    <div class="flex justify-between">
        <p class="text-2xl font-medium">Score</p>
        <a class="text-sm px-2 p-1 border border-transparent rounded bg-green-500 text-white hover:bg-green-500 focus:outline-none focus:border-green-500 focus:shadow-outline-green active:bg-green-500 transition duration-150 ease-in-out inline-flex items-center font-semibold" href="{{ route('student.get.create.score', ['id' => $student->id]) }}">
            {{-- <i class="bx bx-plus mr-2 text-base"></i> --}}
            Scoring
        </a>
    </div>
    <div class="grid grid-cols-3 relative overflow-x-auto no-scrollbar h-44 mt-2 gap-2">
        @foreach ($scores as $key => $item)
        <div class="w-full">
            <div class="bg-white border rounded-md flex-col flex py-3 px-3">
                <div class="flex-auto">
                    <div class="flex justify-between">
                        <div class="text-gray-600 text-sm font-bold capitalize">{{ $item['scoring_type'] }}</div>
                        <div class="relative inline-block text-left text-sm">
                            <p class="inline-flex items-center text-gray-600 dropdown-toggle"><span>{{ $item['created_at']->format('M Y') }}</span></p>
                        </div>
                    </div>
                </div>
                <div class="flex justify-between mt-3">
                    <div class="text-gray-700 text-sm capitalize">
                        Point : <span class="font-semibold">{{ $item['point'] }}</span> 
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
  </div>
  <div class="bg-white my-2 ml-2 border rounded-md p-4 w-auto md:w-1/2">
    <div class="flex justify-between">
        <p class="text-2xl font-medium">Log Attendance</p>
        <input type="text" class="px-2 py-1 rounded border ml-2" name="daterange"/>
    </div>
    <div class="relative overflow-x-auto no-scrollbar sm:rounded-lg h-44 mt-2">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="w-fulltext-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="p-2 w-3/12">
                        Clock In
                    </th>
                    <th scope="col" class="p-2 w-3/12">
                        Clock Out
                    </th>
                    <th scope="col" class="p-2 w-2/12">
                        Activity
                    </th>
                    <th scope="col" class="p-2 w-1/12">
                        Work
                    </th>
                    <th scope="col" class="p-2 w-2/12">
                        Attendance
                    </th>
                    <th scope="col" class="p-2 w-1/12">
                        <span class="sr-only">View</span>
                    </th>
                </tr>
            </thead>
            <tbody class="w-full">
                @foreach ($attendance as $item)
                <tr class="bg-white hover:bg-gray-50">
                    <td class="p-2 w-3/12">
                        {{ $item->clock_in }}
                    </td>
                    <td class="p-2 w-3/12">
                        {{ $item->clock_out }}
                    </td>
                    <td class="p-2 capitalize w-2/12">
                        {{ $item->activity }}
                    </td>
                    <td class="p-2 w-1/12">
                        {{ $item->work_type }}
                    </td>
                    <td class="p-2 capitalize w-2/12">
                        {{ $item->attendance_type }}
                    </td>
                    <td class="p-2 text-right w-1/12">
                        <button type="button" class="font-medium text-green-500 " data-bs-toggle="modal" data-bs-target="#attendanceModal{{ $item->id }}"> View </button>
                    </td>
                    {{-- modal attendance --}}
                    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
                        id="attendanceModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalScrollableLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-lg relative w-auto pointer-events-none">
                            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                                <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                                    <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalScrollableLabel">
                                        {{ $item->clock_in->format('l, d F Y') }}
                                    </h5>
                                    <button type="button"
                                        class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-6">
                                    <div class="w-full mb-6 mx-auto">
                                        <div class="w-full flex-row sm:flex gap-3">
                                            <div class="w-1/3">
                                                <img class="rounded-lg border h-36 mx-auto" src="{{$item->user->image ? asset('profile/'.$item->user->image) : asset('dist/avatar/profile_default.png') }}" alt=""/>
                                            </div>
                                            <div class="mt-6 w-2/3">
                                                <p class="text-base font-medium mb-2 ">{{$item->user->name}}</p>
                                                <p class="text-sm font-normal mb-2 ">{{ $item->user->student->institute_id ? $item->user->student->institute->name : '-'  }}</p>
                                                <p class="text-sm font-normal mb-2">{{$item->user->student->job_role}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-row sm:flex gap-6">
                                        <div class="w-full lg:w-1/2">
                                            <p class="text-base font-medium mb-2">Clock In<br> <span class="font-normal">{{ $item->clock_in->format('H.i') }}&nbsp;WIB</span></p>
                                            <p class="text-base font-medium mb-2">Clock Out<br> <span class=" font-normal">{{ $item->clock_out ? $item->clock_out->format('H.i') : '-' }}&nbsp;WIB</span></p>
                                            <p class="text-base font-medium mb-2">Working Hour<br> <span class=" font-normal">{{ $item->working_hour ? $item->working_hour->format('H.i') : '-' }}&nbsp;Hour</span></p>
                                            <p class="font-medium mb-2">Working Type<br> <span class="font-normal">{{$item->work_type ? $item->work_type : '-'}}</span></p>
                                        </div>
                                        <div class="w-full lg:w-1/2 max-">
                                            <p class="font-medium mb-2">Attendance Type<br> <span class="font-normal">{{$item->attendance_type ? $item->attendance_type : '-'}}</span></p>
                                            <p class="font-medium">Activity<br> 
                                            <div class="rounded p-1 overflow-y-scroll w-10/12 max-h-36 mb-2">
                                                <span class="font-normal">{{$item->activity ? $item->activity : '-'}}</span></p>
                                            </div>
                                            <p class="font-medium">Notes<br> 
                                            <div class="rounded p-1 overflow-y-scroll w-10/12 max-h-36 mb-2">
                                                <span class="font-normal">{{$item->notes ? $item->notes : '-'}}</span></p>
                                            </div>
                                            <p class="font-medium">Attachemnt<br> 
                                            <div class="rounded border p-1 overflow-hidden truncate w-10/12 mb-2">
                                                <div class="px-2 overflow-x-scroll no-scrollbar">
                                                    <span class="font-normal text-ellipsis"><a href="{{asset('attachment/'.$item->attachment)}}" target="_blanc" class="hover:underline">{{$item->attachment ? $item->attachment : '-'}}</a></span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($item->attendance_type === 'pending')
                                <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                                    <a href="javascript:$('#form-reject-attendance-{{$item->id}}').submit();"
                                        class="font-medium bg-red-600 hover:underline text-white px-2 py-0.5 rounded mr-2">Reject</a>
                                    <a href="javascript:$('#form-approve-attendance-{{$item->id}}').submit();"
                                        class="font-medium hover:underline bg-green-500 text-white px-2 py-0.5 rounded mr-2">Approve</a>
                                    </div>
                                    @endif
                            </div>
                        </div>
                    </div>
                    {{-- end modal attendance --}}
                    <form id="form-approve-attendance-{{$item->id}}"
                        action="{{ route('profile.supervisor.approve.attendance.student', ['id' => $item->id]) }}"
                        method="POST">
                        @method('put')
                        @csrf
                    </form>
                    <form id="form-reject-attendance-{{$item->id}}"
                        action="{{ route('profile.supervisor.reject.attendance.student', ['id' => $item->id]) }}"
                        method="POST">
                        @method('put')
                        @csrf
                    </form>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  </div>
</div>
<div class="bg-white rounded border p-4 ml-2 mt-2 mb-5">
    <div class="flex justify-between">
        <p class="text-2xl font-medium">Documents</p>
        <button data-bs-toggle="modal" data-bs-target="#uploadDocModal" class="px-4 py-2 text-sm rounded bg-green-500 text-white hover:bg-green-500  transition duration-150 ease-in-out inline-flex items-center font-semibold">
            Upload Document
        </button>
    </div>
    <div class="overflow-x-scroll">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="w-full text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="p-2 ">
                        Document
                    </th>
                    <th scope="col" class="p-2">
                        Type
                    </th>
                    <th scope="col" class="p-2">
                        Upload Time
                    </th>
                    <th scope="col" class="p-2">
                        <span class="sr-only">View</span>
                    </th>
                </tr>
            </thead>
            <tbody class="w-full">
                @foreach ($document->where('student_id', $student->id) as $item)
                <tr class="bg-white hover:bg-gray-50">
                    <td class="p-2 w-7/12 whitespace-nowrap truncate">
                        {{ $item->document }}
                    </td>
                    <td class="p-2">
                        {{ $item->type }}
                    </td>
                    <td class="p-2">
                        {{ $item->created_at->format('d F Y H:i A') }}
                    </td>
                    <td class="p-2 center ">
                        <a href="{{ asset('files/'.$item->document) }}" target="_blank" class="font-medium text-green-500 mr-2"> View </a>
                        <a href="javascript:$('#form-doc-del').submit();" class="font-medium text-red-500"> Delete </a>
                        <form action="{{ route('student.destroy.doc', $item->id) }}" method="POST" id="form-doc-del">
                            @method('delete')
                            @csrf
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- modal upload files --}}
<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="uploadDocModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-relative w-auto pointer-events-none">
        <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
            <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLabel">
                    Upload  Document
                </h5>
                <button type="button" class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                    <input type="file" name="document" accept=".pdf, .ppt, .pptx, .pps, .ppsx, .doc, .docx, .xml,application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document" required/>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 flex-row sm:flex">
                        <label class="w-1/5 inline py-2 pr-4 text-right">Name</label>
                        <div class="w-full">
                            <input class="focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none w-full text-base placeholder-gray-400 place-content-stretch border border-gray-300 rounded py-1.5 px-3" type="text" name="type" placeholder="Enter document name (eg. graduation letter)" required/>
                        </div>
                    </div>
                            <input type="hidden" name="student_id" value="{{$student->id}}">
                    <div class="mt-2">
                        <button type="submit" class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-500 hover:shadow-lg focus:bg-green-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out ml-1">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('view/supervisor.js') }}"></script>
<script src="{{ asset('view/attendance.js') }}"></script>
@endsection