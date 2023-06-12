@extends('main')

@section('title')
<h3 class="text-gray-600 text-sm capitalize">
    <a href="" class="text-green-500">
        <i class="bx bx-home mr-1"></i>
        Profile
    </a>
    <a href="{{route('supervisor.get.index')}}" class="text-green-500">
        / Supervisor
    </a>
    / {{ $supervisor->user->name }}
</h3>
@endsection

@section('content')
<div>
    <h1 class="text-2xl mt-1 ml-2 font-medium">Profile</h1>
</div>
<div class="flex flex-col md:flex-row">
    <div class="bg-white my-2 ml-2 border rounded-md p-4 w-auto md:w-1/4 h-72">
        <img src={{$supervisor->user->image ? asset('profile/'.$supervisor->user->image) : asset('dist/avatar/profile_default.png') }}
            class="h-36 mx-auto my-4">
        <p class="text-center text-lg font-medium capitalize"> {{$supervisor->user->name}} </p>
        <p class="text-center text-base font-normal my-2 capitalize"> {{$supervisor->job_role}} </p>
    </div>
    <div class="w-auto md:w-3/4">
        <div class="bg-white my-2 ml-2 border rounded-md p-4 h-72">
            <p class="text-xl font-semibold mb-4">Info</p>
            <div class="flex flex-col md:flex-row">
                <div class="w-full">
                    <p class="text-base mb-2 font-medium"> NIK : <span class="font-normal">{{$supervisor->nik}}</span></p>
                    <p class="text-base mb-2 font-medium"> Divisi : <span class="font-normal capitalize">{{$supervisor->division}}</span></p>
                    <p class="text-base mb-2 font-medium"> Departemen : <span class="font-normal capitalize">{{$supervisor->department}}</span></p>
                    <p class="text-base mb-2 font-medium"> Phone : <span class="font-normal">{{$supervisor->phone}}</span></p>
                    <p class="text-base mb-2 font-medium"> Emergency Contact : <span class="font-normal">{{$supervisor->emergency_contact}}</span></p>
                    <p class="text-base mb-2 font-medium"> Status : <span class="font-medium {{$supervisor->user->status == 'active' ? 'text-green-500' : 'text-slate-500'}} capitalize"> {{$supervisor->user->status}} </span></p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-white my-2 ml-2 border rounded-md p-4">
    <div class="flex justify-between">
        <p class="text-2xl font-medium ml-2">Student</p>
        <input type="text" id="Input" onkeyup="myFunction()" placeholder="Search for Name" title="Type in a name" class="ml-2 border p-1 rounded">
    </div>
    <div class="relative overflow-x-auto no-scrollbar sm:rounded-lg h-48 mt-2">
        <table class="w-full text-sm text-left text-gray-500" id="Table">
            <thead class="w-full text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="p-2">
                        Name
                    </th>
                    <th scope="col" class="p-2">
                        institute
                    </th>
                    <th scope="col" class="p-2">
                        Major
                    </th>
                    <th scope="col" class="p-2">
                        Department
                    </th>
                    <th scope="col" class="p-2">
                        Job Role
                    </th>
                    <th scope="col" class="p-2">
                        End Date
                    </th>
                </tr>
            </thead>
            <tbody class="w-full">
                @foreach($students->where('supervisor_id', $supervisor->id) as $item)
                <tr class="bg-white hover:bg-gray-50">
                    <td scope="row" class="p-2 font-medium text-gray-900 whitespace-nowrap capitalize">
                        <a href="{{route('student.get.detail', $item->user->id)}}">{{ $item->user->name }}</a>
                    </td>
                    <td class="p-2">
                        {{ $item->institute_id ? $item->institute->name : '-'  }}
                    </td>
                    <td class="p-2">
                        {{ $item->major ? $item->major : '-' }}
                    </td>
                    <td class="p-2 capitalize">
                        {{ $item->division }}
                    </td>
                    <td class="p-2">
                        {{ $item->job_role }}
                    </td>
                    <td class="p-2 capitalize">
                        {{ $item->end_date->format('d F Y') }}
                    </td>
                </tr>
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
</div>
@endsection


@section('js')
<script src="{{ asset('view/searchFilter.js') }}"></script>
@endsection