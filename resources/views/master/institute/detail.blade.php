@extends('main')
@section('title')
<h3 class="text-gray-600 text-sm">
    <a href="" class="text-green-500">
        <i class="bx bx-home mr-1"></i>
        Master
    </a>
    <a href="{{route('institute.get.index')}}" class="text-green-500">
        / Institute
    </a>
    / Detail
</h3>
@endsection
@section('content')
<div class="flex justify-between mx-2 my-2">
    <div>
        <h1 class="text-2xl mt-1 font-medium">Data Institute</h1>
    </div>
    
    {{-- <a class="px-4 py-2 text-sm border border-transparent rounded bg-green-500 text-white hover:bg-green-500 focus:outline-none focus:border-green-500 focus:shadow-outline-green active:bg-green-500 transition duration-150 ease-in-out inline-flex items-center font-semibold"
    href="{{ route('institute.create') }}">
        <i class="bx bx-plus mr-2 text-base"></i>
        Create
    </a> --}}
</div>

<div class="flex flex-col md:flex-row">
    <div class="bg-white my-2 ml-2 border rounded-md p-4 w-auto md:w-1/4 h-60">
        <img src={{asset('dist/images/Logo-institute.png') }} class="max-h-36 mx-auto my-4">{{--gambar random--}}
        <p class="text-center text-lg font-medium capitalize"> {{$institute->name}} </p>
    </div>
    <div class="w-auto md:w-3/4">
        <div class="bg-white my-2 ml-2 border rounded-md p-4 h-60">
            <div class="flex">
                <p class="text-xl font-semibold mb-4 items-center">Info</p>
                <a href="{{route('institute.edit', $institute->id)}}" class="ml-auto "><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square my-auto ml-auto hover:text-slate-300" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                    <path fill-rule="evenodd"d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                </svg></a>
            </div>
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/2 w-full">
                    <p class="text-base mb-2 font-medium"> Website : <span class="font-normal hover:underline"><a href="//{{$institute->website}}" target=”_blank”>{{ $institute->website ? $institute->website : '-' }}</a></span></p>
                    <p class="text-base mb-2 font-medium"> Phone : <span class="font-normal">{{$institute->phone}}</span></p>
                    <p class="text-base mb-2 font-medium"> Email : <span class="font-normal hover:underline"><a href="mailto:{{$institute->email}}">{{ $institute->email }}</a></span></p>
                    <p class="text-base mb-2 font-medium"> Address : <span class="font-normal capitalize"> {{$institute->address}} </span></p>
                </div>
                <div class="md:w-1/2 w-full">
                    <p class="text-base mb-2 font-medium"> Type : <span class="font-normal capitalize">{{$institute->type}}</span></p>
                    <p class="text-base mb-2 font-medium"> Accreditation : <span class="font-normal capitalize">{{$institute->accreditation}}</span></p>
                    <p class="text-base mb-2 font-medium"> Status :  <span class="font-medium {{$institute->status == 'active' ? 'text-green-500' : 'text-slate-500'}} capitalize"> {{$institute->status}} </span></p>
                </div>
            </div>
            
        </div>
    </div>
</div>

{{-- student card per supervisor--}}
<p class="text-2xl ml-2 my-4 font-medium ">Students</p>
<!-- Cards -->
<div class="container pl-2 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2">
    @foreach ($students->where('institute_id', $institute->id) as $item)
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
                <span class="text-gray-600"><a href="{{route('supervisor.get.detail', $item->supervisor->id)}}">{{ $item->supervisor->user->name }}</a></span>
            </div>
            <div>
                <i class='bx bxs-calendar'></i>
                <span class="text-gray-600">{{ $item->end_date->format('d M Y') }}</span>
            </div>
        </div>
      </div>
    @endforeach
</div>

@endsection