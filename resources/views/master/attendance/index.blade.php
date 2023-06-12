@extends('main')
@section('title')
<h3 class="text-gray-600 text-md">
    <a href="" class="text-green-500">
        <i class="bx bx-home mr-1"></i>
        Master
    </a>
    / Attendance
</h3>
@endsection
@section('content')
<div class="flex justify-between m-2 mr-0">
    <div>
        <h1 class="text-2xl mt-1 font-medium">Data Attendance Student</h1>
    </div>
</div>

{{-- <a class="px-4 py-2 text-sm mx-2 my-2 border border-transparent rounded bg-green-500 text-white hover:bg-green-500 focus:outline-none focus:border-green-500 focus:shadow-outline-green active:bg-green-500 transition duration-150 ease-in-out inline-flex items-center m-1 font-semibold"
href="{{ route('attendance.create') }}">
<i class="bx bx-plus mr-2 text-base"></i>
Create
</a> --}}

<!-- Table -->

<div class="flex justify-between m-2 mr-0 items-center">
    <div class="flex items-center">
        <input type="text" id="Input" onkeyup="myFunction()" placeholder="Search for Name" title="Type in a name" class="px-2 py-1 border rounded" {{$attendances->count() != 0 ? '' : 'disabled'}}>
        <input type="text" class="px-2 py-1 rounded border ml-2" name="daterange" />
        <div class="dropdown-attendance px-2 py-1 ml-2 border rounded bg-white">
            <a class="dropdown-toggle" href="#" type="button"  data-bs-toggle="dropdown" aria-expanded="false">
                Filter
            </a>
            <ul class="dropdown-menu min-w-max absolute hidden bg-white text-base py-1 list-none rounded shadow-md border">
                <li>
                    <div class="flex dropdown-item py-2 px-4 font-normal w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100">
                        <input type="checkbox" name="status" id="pending" class="mr-1">
                        <div class="text-sm">Pending</div>
                    </div>
                </li>
                <li>
                    <div class="flex dropdown-item py-2 px-4 font-normal w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100">
                        <input type="checkbox" name="status" id="reject" class="mr-1">
                        <div class="text-sm">Reject</div>
                    </div>
                </li>
                <li>
                    <div class="flex dropdown-item py-2 px-4 font-normal w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100">
                        <input type="checkbox" name="status" id="present" class="mr-1">
                        <div class="text-sm">Present</div>
                    </div>
                </li>
                <hr class="h-0 my-1 border border-solid border-t-0 border-gray-700 opacity-25" />
                <li class="py-2 px-4 text-center">
                  <button class="dropdown-item text-sm font-medium block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100" id="applySortFilterAttendance">Apply</button>
                </li>
            </ul>
        </div>
    </div>
</div>

@if ($attendances->count() != 0)
<div class="bg-white m-2 mr-0 border rounded-md flex-col flex h-96 py-3">
    <div class="sm:rounded-lg px-4 py-3 pb-0">
        <table class="w-full text-sm text-left text-gray-500">
            
        </table>
    </div>
    <div class="relative overflow-x-auto sm:rounded-lg px-4 pb-0">
        <table class="w-full text-sm text-left text-gray-500" id="Table">
            <thead class="w-full text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-3 py-3 text-left w-2/12">
                        Student Name
                    </th>
                    <th scope="col" class="px-3 py-3 text-left w-2/12">
                        Clock In
                    </th>
                    <th scope="col" class="px-3 py-3 text-left w-2/12">
                        Clock Out
                    </th>
                    <th scope="col" class="px-3 py-3 text-left w-1/12">
                        Total
                    </th>
                    <th scope="col" class="px-3 py-3 text-left w-2/12">
                        Activity
                    </th>
                    <th scope="col" class="px-3 py-3 text-left w-1/12">
                        Work
                    </th>
                    <th scope="col" class="px-3 py-3 text-left w-1/12">
                        Attendance
                    </th>
                    <th scope="col" class="px-3 py-3 text-left w-1/12">
                        <span class="sr-only">View</span>
                    </th>
                </tr>
            </thead>
            <tbody class="w-full">
                @foreach ($attendances->sortByDesc('id') as $item)
                <tr class="bg-white hover:bg-gray-50">
                    <td class="px-3 py-2 font-medium text-gray-900 capitalize">
                        <a class="hover:underline" href="{{Route('student.get.detail', $item->user->student->id)}}">{{ $item->user->name }}</a>
                    </td>
                    <td class="px-3 py-2 w-2/12">
                        {{ $item->clock_in->format('d M Y H:i:s') }}
                    </td>
                    <td class="px-3 py-2 w-2/12">
                        {{ $item->clock_out ? $item->clock_out->format('d M Y H:i:s') : '' }}
                    </td>
                    <td class="px-3 py-2 w-1/12">
                        {{ $item->working_hour ? $item->working_hour->format('H:i:s') : '' }}
                    </td>
                    <td class="px-3 py-2 capitalize max-w-xs truncate w-2/12">
                        {{ $item->activity }}
                    </td>
                    <td class="px-3 py-2 w-1/12">
                        {{ $item->work_type }}
                    </td>
                    <td class="px-3 py-2 capitalize w-1/12">
                        {{ $item->attendance_type }}
                    </td>
                    <td class="px-3 py-2 text-right w-1/12">
                        <button type="button" class="font-medium text-green-500 " data-bs-toggle="modal"
                            data-bs-target="#attendanceModal{{ $item->id }}"> View </button>
                    </td>
                </tr>
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
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@else  
<div class="bg-white m-2 mr-0 rounded-md h-96">
    <div class="flex flex-col items-center">
        <div class="w-80">
            <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
            <lottie-player src="https://assets9.lottiefiles.com/packages/lf20_hl5n0bwb.json"  background="transparent" speed="1" loop autoplay></lottie-player>
        </div>
        <p class="text-center mt-3 text-lg">Oops, Nothing Here</p> 
    </div>
</div>
@endif

{{-- modal --}}
@foreach($attendances as $item)
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
@endforeach
@endsection

@section('js')
<script src="{{ asset('view/searchFilter.js') }}"></script>
<script src="{{ asset('view/sortFilter.js') }}"></script>
<script src="{{ asset('view/attendance.js') }}"></script>
@endsection
