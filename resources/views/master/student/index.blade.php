@extends('main')
@section('title')
    <h3 class="text-gray-600 text-sm">
        <a href="" class="text-green-500">
            <i class="bx bx-home mr-1"></i>
            Master
        </a>
        / Student
    </h3>
@endsection
@section('content')
    <div class="flex justify-between m-2 mr-0">
        <div>
            <h1 class="text-2xl mt-1 font-medium">Data Student</h1>
        </div>
    </div>

    <!-- Table -->

    <div class="flex-row md:flex justify-between m-2 mr-0">
        <div class="flex items-center">
            <input type="text" id="Input" onkeyup="myFunctionStudent()" placeholder="Search for Student / Supervisor" title="Type in a student / supervisor name" class="px-2 py-1 border rounded w-52" {{ $students->count() != 0 ? '' : 'disabled' }}>
            <input type="text" class="px-2 py-1 rounded border ml-2" name="daterange" />
            <div class="dropdown px-2 py-1 ml-2 border rounded bg-white">
                <a class="dropdown-toggle"
                    href="#" type="button"  data-bs-toggle="dropdown" aria-expanded="false">
                    Filter
                </a>
                <ul class="dropdown-menu min-w-max absolute hidden bg-white text-base py-1 list-none rounded shadow-md border">
                    <li>
                        <div class="flex dropdown-item py-2 px-4 font-normal w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100">
                            <input type="checkbox" name="status" id="active" class="mr-1">
                            <div class="text-sm">Active</div>
                        </div>
                    </li>
                    <li>
                        <div class="flex dropdown-item py-2 px-4 font-normal w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100">
                            <input type="checkbox" name="status" id="inactive" class="mr-1">
                            <div class="text-sm">Inactive</div>
                        </div>
                    </li>
                    <hr class="h-0 my-1 border border-solid border-t-0 border-gray-700 opacity-25" />
                    <li class="py-2 px-4 text-center">
                      <button class="dropdown-item text-sm font-medium block w-full whitespace-nowrap bg-transparent text-gray-700 hover:bg-gray-100" id="applySortFilter">Apply</button>
                    </li>
                </ul>
            </div>
        </div>

        <a class="px-4 py-2 text-sm border border-transparent rounded bg-green-500 text-white hover:bg-green-500 focus:outline-none focus:border-green-500 focus:shadow-outline-green active:bg-green-500 transition duration-150 ease-in-out inline-flex items-center font-semibold"
            href="{{ route('student.create') }}">
            <i class="bx bx-plus mr-2 text-base"></i>
            Create
        </a>
    </div>

    @if ($students->count() != 0)
        <div class="bg-white m-2 mr-0 border rounded-md flex-col flex px-5 py-3 h-96">
            <div class="relative overflow-x-auto sm:rounded-lg pb-0 ">
                <table class="w-full text-sm text-left text-gray-500" id="Table">
                    <thead class="w-full text-xs text-gray-700 uppercase bg-gray-50 cursor-default">
                        <tr>
                            <th scope="col" class="px-3 py-3 text-left hover:underline" onclick="sortTable('alfa', 0)" title="sort by name">Name</th>
                            <th scope="col" class="px-3 py-3 text-left hover:underline" onclick="sortTable('alfa', 1)" title="sort by institute">institute</th>
                            <th scope="col" class="px-3 py-3 text-left hover:underline" onclick="sortTable('alfa', 2)" title="sort by supervsior">Supervisor</th>
                            <th scope="col" class="px-3 py-3 text-left hover:underline" onclick="sortTable('alfa', 3)" title="sort by department">Department</th>
                            <th scope="col" class="px-3 py-3 text-left hover:underline" onclick="sortTable('alfa', 4)" title="sort by job role">Job Role</th>
                            <th scope="col" class="px-3 py-3 text-left hover:underline" onclick="sortTable('alfa', 5)" title="sort by end date">End Date</th>
                            <th scope="col" class="px-3 py-3 hover:underline" onclick="sortTable('alfa', 6)" title="sort by status">status</th>
                            <th scope="col" class="px-3 py-3 text-left hover:underline"><span class="sr-only">Edit</span></th>
                        </tr>
                    </thead>
                    <tbody class="w-full">
                        @foreach ($students as $item)
                            <tr class="bg-white hover:bg-gray-50">
                                <td scope="row" class="px-3 py-2 font-medium text-gray-900 whitespace-nowrap capitalize">
                                    <a class="hover:underline" href="{{ Route('student.get.detail', $item->id) }}">{{ $item->user->name }}</a>
                                </td>
                                <td class="px-3 py-2 capitalize whitespace-nowrap">
                                    {{ $item->institute_id ? $item->institute->name : '-' }}
                                </td>
                                <td class="px-3 py-2 capitalize whitespace-nowrap">
                                    {{ $item->supervisor->user->name }}
                                </td>
                                <td class="px-3 py-2 capitalize whitespace-nowrap">
                                    {{ $item->department }}
                                </td>
                                <td class="px-3 py-2 capitalize whitespace-nowrap">
                                    {{ $item->job_role }}
                                </td>
                                <td class="px-3 py-2 whitespace-nowrap">
                                    {{ $item->end_date->format('d-M-Y') }}
                                </td>
                                @if ($item->user->status == 'active')
                                    <td class="px-3 py-2 capitalize font-medium text-green-500">
                                        {{ $item->user->status }}
                                    </td>
                                @else 
                                    <td class="px-3 py-2 capitalize font-medium text-red-600">
                                        {{ $item->user->status }}
                                    </td>
                                @endif
                            
                                <td class="px-3 py-2 text-right whitespace-nowrap">
                                    <a href="{{ route('student.edit', ['id' => $item->id]) }}"
                                        class="font-medium bg-yellow-400 text-white hover:underline px-2 py-0.5 rounded">Edit</a>
                                    {{-- <a href="javascript:$('#form-inactive-{{$item->id }}').submit();"
                                class="font-medium bg-red-600 text-white hover:underline px-2 py-0.5
                                rounded">Inactive</a> --}}
                                    {{-- <a href="{{ route('student.edit', ['id' => $item->id ]) }}"
                                class="font-medium text-yellow-400 hover:underline">Edit</a>
                                <a href="javascript:$('#form-inactive-{{ $item->id }}').submit();"
                                    class="font-medium text-red-600 hover:underline">Inactive</a> --}}
                                </td>
                            </tr>
                            <form id="form-inactive-{{ $item->id }}"
                                action="{{ route('student.put.status', ['id' => $item->id]) }}" method="POST">
                                @method('put')
                                @csrf
                            </form>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{-- <div class="ml-2">
    {{ $students->links() }}
    </div> --}}
    @else
        <div class="bg-white m-2 mr-0 rounded-md h-96">
            <div class="flex flex-col items-center">
                <div class="w-80">
                    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                    <lottie-player src="https://assets9.lottiefiles.com/packages/lf20_hl5n0bwb.json"
                        background="transparent" speed="1" loop autoplay></lottie-player>
                </div>
                <p class="text-center mt-3 text-lg">Oops, Nothing Here</p>
            </div>
        </div>
    @endif
    <!-- End Table -->
@endsection

@section('js')
    <script src="{{ asset('view/searchFilter.js') }}"></script>
    <script src="{{ asset('view/sortFilter.js') }}"></script>
    <script src="{{ asset('view/student.js') }}"></script>
@endsection
