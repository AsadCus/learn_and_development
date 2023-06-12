@extends('main')
@section('title')
<h3 class="text-gray-600 text-sm">
    <a href="" class="text-green-500">
        <i class="bx bx-home mr-1"></i>
        Master
    </a>
    / Supervisor
</h3>
@endsection
@section('content')
<div class="flex justify-between m-2 mr-0">
    <div>
        <h1 class="text-2xl mt-1 font-medium">Data Supervisor</h1>
    </div>
</div>

<!-- Table -->

<div class="flex-row md:flex justify-between m-2 mr-0">
    <div class="flex items-center">
        <input type="text" id="Input" onkeyup="myFunction()" placeholder="Search for Name" title="Type in a name" class="px-2 py-1 border rounded" {{$supervisors->count() != 0 ? '' : 'disabled'}}>
        <input type="text" class="px-2 py-1 rounded border ml-2" name="daterange"/>
    </div>
    
    <a class="px-4 py-2 text-sm border border-transparent rounded bg-green-500 text-white hover:bg-green-500 focus:outline-none focus:border-green-500 focus:shadow-outline-green active:bg-green-500 transition duration-150 ease-in-out inline-flex items-center font-semibold"
    href="{{ route('supervisor.create') }}">
        <i class="bx bx-plus mr-2 text-base"></i>
        Create
    </a>
</div>
@if($supervisors->count() != 0)
<div class="bg-white m-2 mr-0 border rounded-md flex-col flex h-96 py-3">
    <div class="relative overflow-x-auto sm:rounded-lg px-4 pb-0">
        <table class="w-full text-sm text-left text-gray-500" id="Table">
            <thead class="w-full text-xs text-gray-700 uppercase bg-gray-50 cursor-default">
                <tr class="header">
                    <th scope="col" class="px-1 py-3 w-2/12">
                        Name
                    </th>
                    <th scope="col" class="px-1 py-3 w-1/12">
                        Phone
                    </th>
                    <th scope="col" class="px-1 py-3 w-1/12">
                        Department
                    </th>
                    <th scope="col" class="px-1 py-3 w-3/12">
                        Division
                    </th>
                    <th scope="col" class="px-1 py-3 w-2/12">
                        Job Role
                    </th>
                    <th scope="col" class="px-1 py-3 hover:underline w-1/12" onclick="sortTable('alfa', 7)" title="sort by status">
                        status
                    </th>
                    <th scope="col" class="px-3 py-3 w-1/12">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            <tbody class="w-full">
                @foreach ($supervisors as $item)
                <tr class="bg-white hover:bg-gray-50">
                    <td scope="row" class="px-1 py-2 font-medium text-gray-900 whitespace-nowrap capitalize2">
                        <a href="{{ route ('supervisor.get.detail', $item->id) }}">{{ $item->user->name }}</a>
                    </td>
                    <td class="px-3 py-2 truncate">
                        {{ $item->phone }}
                    </td>
                    <td class="px-1 py-2 capitalize">
                        {{ $item->department }}
                    </td>
                    <td class="px-1 py-2 capitalize">
                        {{ $item->division }}
                    </td>
                    <td class="px-1 py-2 capitalize">
                        {{ $item->job_role }}
                    </td>
                    <td class="px-1 py-2 capitalize {{ $item->user->status == 'active' ? 'text-green-500 font-medium' : 'text-red-500 font-medium' }}">
                        {{ $item->user->status }}
                    </td>
                    <td class="py-2 text-right">
                        <a href="{{ route('supervisor.edit', ['id' => $item->id]) }}" class="font-medium bg-yellow-400 text-white hover:underline px-1 py-0.5 rounded">Edit</a>
                        <a href="javascript:$('#form-inactive-{{ $item->id }}').submit();" class="{{ $item->user->status == 'active' ? 'bg-red-500 font-medium' : 'bg-green-500 font-medium' }} text-white hover:underline px-1 py-0.5 rounded">
                            {{ $item->user->status == 'active' ? 'Deact' : 'Activate' }}
                        </a>
                    </td>
                </tr>
                <form id="form-inactive-{{ $item->id }}" action="{{ route('supervisor.put.status', ['id' => $item->id ]) }}" method="POST">
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

<!-- End Table -->

@endsection

@section('js')
<script src="{{ asset('view/searchFilter.js') }}"></script>
<script src="{{ asset('view/dateFilter.js') }}"></script>
@endsection