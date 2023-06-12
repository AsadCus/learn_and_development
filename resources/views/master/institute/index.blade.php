@extends('main')
@section('title')
<h3 class="text-gray-600 text-sm">
    <a href="" class="text-green-500">
        <i class="bx bx-home mr-1"></i>
        Master
    </a>
    / Institute
</h3>
@endsection
@section('content')
<div class="flex justify-between m-2 mr-0">
    <div>
        <h1 class="text-2xl mt-1 font-medium">Data Institute</h1>
    </div>
</div>

<!-- Table -->

<div class="flex-row md:flex justify-between m-2 mr-0">
    <div class="flex items-center">
        <input type="text" id="Input" onkeyup="myFunction()" placeholder="Search for Name" title="Type in a name" class="px-2 py-1 border rounded" {{$institute->count() != 0 ? '' : 'disabled'}}>
        <input type="text" class="px-2 py-1 rounded border ml-2" name="daterange"/>
    </div>
    
    
    <a class="px-4 py-2 text-sm border border-transparent rounded bg-green-500 text-white hover:bg-green-500 focus:outline-none focus:border-green-500 focus:shadow-outline-green active:bg-green-500 transition duration-150 ease-in-out inline-flex items-center font-semibold"
    href="{{ route('institute.create') }}">
        <i class="bx bx-plus mr-2 text-base"></i>
        Create
    </a>
</div>
@if($institute->count() != 0)
<div class="bg-white m-2 mr-0 border rounded-md flex-col flex h-96">
    <div class="relative overflow-x-auto sm:rounded-lg px-4 py-3 pb-0">
        <table class="w-full text-sm text-left text-gray-500 " id="Table">
            <thead class="w-full text-xs text-gray-700 uppercase bg-gray-50 cursor-default">
                <tr class="header">
                    <th scope="col" class="px-3 py-3 w-1/6 hover:underline cursor-default" onclick="sortTable('alfa', 0)" title="sort by name">
                        Name
                    </th>
                    <th scope="col" class="px-3 py-3 w-1/6 hover:underline cursor default" onclick="sortTable('alfa', 1)" title="sort by type">
                        Type
                    </th>
                    <th scope="col" class="px-3 py-3 w-1/6">
                        Email
                    </th>
                    <th scope="col" class="px-3 py-3 w-1/6">
                        Phone
                    </th>
                    <th scope="col" class="px-3 py-3 w-1/6">
                        Address
                    </th>
                    <th scope="col" class="px-3 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            <tbody class="w-full">
                @foreach ($institute as $item)
                <tr class="bg-white hover:bg-gray-50">
                    <td scope="row" class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap capitalize w-1/6">
                        <a href="{{route('institute.get.detail', $item->id)}}">{{ $item->name }}</a>
                    </td>
                    <td class="px-3 whitespace-nowrap capitalize w-1/6">
                        {{ $item->type == 'SM' ? 'SMA/SMK/MA' : $item->type }}
                    </td>
                    <td class="px-3 py-2 whitespace-nowrap capitalize w-1/6">
                        <a href="mailto:{{$item->email}}">{{ $item->email }}</a>
                    </td>
                    <td class="px-3 py-2 capitalize w-1/6">
                        {{ $item->phone }}
                    </td>
                    <td class="px-3 py-2 max-w-xs whitespace-nowrap truncate capitalize w-1/6 ">
                        {{ $item->address }}
                    </td>
                    <td class="px-3 py-2 text-right capitalize w-1/6">
                        <a href="{{ route('institute.edit', $item->id )  }}" class="font-medium bg-yellow-400 text-white hover:underline px-2 py-0.5 rounded" >Edit</a>
                    </td>
                </tr>
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
<!-- End Table -->

@endsection

@section('js')
<script src="{{ asset('view/searchFilter.js') }}"></script>
<script src="{{ asset('view/dateFilter.js') }}"></script>
@endsection