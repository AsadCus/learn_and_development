@extends('main')

@section('title')
<h3 class="text-gray-600 text-sm capitalize">
    <a href="" class="text-green-500">
        <i class="bx bx-home mr-1"></i>
        Profile
    </a>
    / {{ Auth::user()->name }}
</h3>
@endsection

@section('content')
<div>
    <h1 class="text-2xl mt-1 ml-2 font-medium">Profile</h1>
</div>
<div class="flex flex-col md:flex-row">
    <div class="bg-white my-2 ml-2 border rounded-md p-4 w-auto md:w-1/4 h-72">
        <img src={{Auth::user()->image ? asset('profile/'.Auth::user()->image) : asset('dist/avatar/profile_default.png') }}
            class="h-36 mx-auto my-4">
        <p class="text-center text-lg font-medium capitalize"> {{Auth::user()->name}} </p>
        <p class="text-center text-base font-normal my-2 capitalize"> {{Auth::user()->supervisor->job_role}} </p>
    </div>
    <div class="w-auto md:w-3/4">
        <div class="bg-white my-2 ml-2 border rounded-md p-4 h-72">
            <p class="text-xl font-semibold mb-4">Info</p>
            <div class="flex flex-col md:flex-row">
                <div class="w-full">
                    <p class="text-base mb-2 font-medium"> NIK : <span class="font-normal">{{Auth::user()->supervisor->nik}}</span></p>
                    <p class="text-base mb-2 font-medium"> Divisi : <span class="font-normal capitalize">{{Auth::user()->supervisor->division}}</span></p>
                    <p class="text-base mb-2 font-medium"> Departemen : <span class="font-normal capitalize">{{Auth::user()->supervisor->department}}</span></p>
                    <p class="text-base mb-2 font-medium"> Phone : <span class="font-normal">{{Auth::user()->supervisor->phone}}</span></p>
                    <p class="text-base mb-2 font-medium"> Emergency Contact : <span class="font-normal">{{Auth::user()->supervisor->emergency_contact}}</span></p>
                    <p class="text-base mb-2 font-medium"> Status : <span class="font-medium capitalize {{Auth::user()->status == 'active' ? 'text-green-500' : 'text-slate-500'}}" >{{Auth::user()->supervisor->status}}</span></p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- attendance approve table per supervisor--}}
<!-- Table -->
<div class="bg-white m-2 mr-0 border rounded-md p-2">
    <div class="flex justify-between">
        <p class="text-2xl font-medium">Attendance Approval</p>
    </div>
    @if ($attendances->count() != 0)
    <div class="relative overflow-x-auto no-scrollbar sm:rounded-lg h-48 mt-2">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="w-full text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="p-2">
                        Student Name
                    </th>
                    <th scope="col" class="p-2">
                        Clock In
                    </th>
                    <th scope="col" class="p-2">
                        Clock Out
                    </th>
                    <th scope="col" class="p-2">
                        Activity
                    </th>
                    <th scope="col" class="p-2">
                        Work
                    </th>
                    <th scope="col" class="p-2">
                        Attendance
                    </th>
                    <th scope="col" class="p-2">
                        <span class="sr-only">Approve & Reject</span>
                    </th>
                </tr>
            </thead>
            <tbody class="w-full no-scrollbar">
                @foreach ($attendances as $item)
                <tr class="bg-white hover:bg-gray-50 w-full">
                    <th scope="row" class="p-2 font-medium text-gray-900 whitespace-nowrap capitalize">
                        <a class="hover:underline" href="{{Route('student.get.detail', $item->user_id)}}">{{ $item->user->name }}</a>
                    </th>
                    <td class="p-2">
                        {{ $item->clock_in }}
                    </td>
                    <td class="p-2">
                        {{ $item->clock_out ? $item->clock_out : '-' }}
                    </td>
                    <td class="p-2 capitalize max-w-xs truncate">
                        {{ $item->activity ? $item->activity : '-' }}
                    </td>
                    <td class="p-2">
                        {{ $item->work_type }}
                    </td>
                    <td class="p-2 capitalize">
                        {{ $item->attendance_type }}
                    </td>
                    <td class="p-2 text-right">
                        <button type="button" class="font-medium hover:underline bg-blue-400 text-white px-2 py-0.5 rounded" data-bs-toggle="modal" data-bs-target="#attendanceModal-{{$item->id}}"> View </button>
                    </td>
                </tr>
                {{-- modal --}}
                <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="attendanceModal-{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalScrollableLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-lg relative w-auto pointer-events-none">
                      <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                        <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                          <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalScrollableLabel">
                            Attendance
                          </h5>
                          <button type="button" class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-6 bg-slate-300">
                          <div class="w-full mb-6 mx-auto">
                              <div class="w-full flex-row sm:flex gap-4">
                                  <div class="w-1/3">
                                      <img class="rounded-lg border max-h-36 mx-auto" src="{{$item->user->image ? asset('profile/'.$item->user->image) : asset('dist/avatar/profile_default.png') }}" alt=""/>
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
                              <div class="w-full lg:w-1/2">
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
                              <a href="javascript:$('#form-reject-attendance-{{$item->id}}').submit();" class="font-medium bg-red-600 hover:underline text-white px-2 py-0.5 rounded mr-2">Reject</a>
                              <a href="javascript:$('#form-approve-attendance-{{$item->id}}').submit();" class="font-medium hover:underline bg-green-500 text-white px-2 py-0.5 rounded mr-2">Approve</a>
                        </div>
                        @endif
                      </div>
                </div>
                {{-- end modal --}}
                <form id="form-approve-attendance-{{$item->id}}" action="{{ route('profile.supervisor.approve.attendance.student', ['id' => $item->id]) }}" method="POST">
                    @method('put')
                    @csrf
                </form>
                <form id="form-reject-attendance-{{$item->id}}" action="{{ route('profile.supervisor.reject.attendance.student', ['id' => $item->id]) }}" method="POST">
                    @method('put')
                    @csrf
                </form>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="bg-white mt-2 mb-4 ml-2 flex-col flex h-48">
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
        <lottie-player src="https://assets9.lottiefiles.com/packages/lf20_hl5n0bwb.json"  background="transparent" speed="1" loop autoplay></lottie-player>
    </div>
    @endif
</div>
{{-- student card per supervisor--}}
<p class="text-2xl m-2 mr-0 font-medium">Students</p>
<!-- Cards -->
<div class="container pl-2 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2">
    @foreach ($students as $item)
    <div class="col-span-1 flex flex-col bg-white p-4 border rounded">
        <a href="{{Route('student.get.detail', $item->id)}}">
            <img class="rounded-3xl border mx-auto" src="{{$item->user->image ? asset('profile/'.$item->user->image) : asset('dist/avatar/profile_default.png') }}" alt=""/>
            <div class="py-2 border-b">
                <h2 class="font-medium text-gray-700 text-lg block leading-5 capitalize">{{ $item->user->name }}</h2>
                <span class="text-gray-500 text-sm capitalize">{{ $item->institute->name }}</span>            
            </div>
        </a>
        <div class="flex justify-between pt-2 text-sm">
            <div>
                <i class="bx bxs-user"></i>
                <span class="text-gray-600">{{ $item->supervisor->user->name }}</span>
            </div>
            <div>
                <i class='bx bxs-calendar'></i>
                <span class="text-gray-600">{{ $item->end_date->format('d M Y') }}</span>
            </div>
        </div>
      </div>
    @endforeach
</div>
<!-- Cards -->

{{-- modal --}}
@foreach($attendances as $item)

@endforeach
@endsection
