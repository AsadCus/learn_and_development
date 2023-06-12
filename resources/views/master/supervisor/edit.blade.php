@extends('main')
@section('title')
<h3 class="text-gray-600 text-sm">
    <a href="" class="text-green-500">
        <i class="bx bx-home mr-1"></i>
        Master
    </a>
    <a href="{{ route('supervisor.get.index') }}" class="text-green-500">
        / Supervisor
    </a>
    / Edit
</h3>

<div>
    <h1 class="text-2xl mt-1 font-medium">Edit Data Supervisor</h1>
</div>
@endsection
@section('content')
<!-- Form -->
<div class="">
    <div class="bg-white border rounded mx-2 my-4">
        <div class="py-3 px-4 border-b flex justify-between items-center">
            <h2 class="text-lg font-medium text-gray-700">Supervisor Form</h2>
        </div>
        <div class="p-3 text-gray-600">
            <form action="{{ route('supervisor.put.update', $supervisor->id) }}" method="POST">
                @csrf
                @method('put')
                <div class="p-2 flex-row sm:flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right">Name</label>
                    <div class="w-full">
                        <input
                            class="focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3"
                            type="text" name="name" placeholder="Enter Name" required value=" {{ $supervisor->user->name }}"/>
                    </div>
                </div>
                <div class="p-2 flex-row sm:flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right">Phone Number</label>
                    <div class="w-full">
                        <input
                            class="focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3"
                            type="text" name="phone" placeholder="Enter phone number" required value=" {{ $supervisor->phone }}"/>
                    </div>
                </div>
                <div class="p-2 flex-row sm:flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right">Emergency Contact</label>
                    <div class="w-full">
                        <input
                            class="focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3"
                            type="text" name="emergency_contact" placeholder="Enter phone number" value=" {{ $supervisor->emergency_contact }}"/>
                    </div>
                </div>
                <div class="p-2 flex-row sm:flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right">Division</label>
                    <div class="w-full">
                        <input
                            class="focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3 capitalize"
                            type="text" name="division" placeholder="Enter division" required value="{{ $supervisor->division }}"/>
                    </div>
                </div>
                <div class="p-2 flex-row sm:flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right">Department</label>
                    <div class="w-full">
                        <input
                            class="focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3 capitalize"
                            type="text" name="department" placeholder="Enter department" required value="{{ $supervisor->department }}"/>
                    </div>
                </div>
                <div class="p-2 flex-row sm:flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right">Job Role</label>
                    <div class="w-full">
                        <input
                            class="focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3 capitalize"
                            type="text" name="job_role" placeholder="Enter job role" required value="{{ $supervisor->job_role }}"/>
                    </div>
                </div>
                <div class="p-2 flex-row sm:flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right">Status</label>
                    <div class="w-full mt-2">
                        <!-- Rounded switch -->
                        <input type="radio" id="radio-one" name="status" value="active" {{($supervisor->user->status == "active") ? 'checked' : '' }}/>
                        <label for="radio-one">Active</label>
                        <input type="radio" id="radio-two" name="status" value="inactive" {{($supervisor->user->status == "inactive") ? 'checked' : '' }}/>
                        <label for="radio-two">Inactive</label>
                    </div>
                </div>
                <div class="p-2 flex-row sm:flex mt-2">
                    <label class="w-1/4 inline py-2 pr-4 text-right"></label>
                    <div class="w-full">
                        <button
                            class="px-4 py-2 text-sm border border-transparent rounded bg-green-500 text-white hover:bg-green-500 focus:outline-none focus:border-green-500 focus:shadow-outline-green active:bg-green-500 transition duration-150 ease-in-out inline-flex items-center" type="submit">
                            {{-- <i class="bx bx-world text-white mr-2 text-base"></i> --}}
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Table -->
@endsection