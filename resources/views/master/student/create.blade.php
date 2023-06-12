@extends('main')
@section('title')
<h3 class="text-gray-600 text-sm">
    <a href="" class="text-green-500">
        <i class="bx bx-home mr-1"></i>
        Master
    </a>
    <a href="{{ route('student.get.index') }}" class="text-green-500">
        / Student
    </a>
    / Create
</h3>

<div>
    <h1 class="text-2xl mt-1 font-medium">Add Data Student</h1>
</div>
@endsection
@section('content')
<!-- Form -->
<div class="">
    <div class="bg-white border rounded mx-2 my-4">
        <div class="py-3 px-4 border-b flex justify-between items-center">
            <h2 class="text-lg font-medium text-gray-700">Student Form</h2>
        </div>
        <div class="p-3 text-gray-600">
            <form action="{{ route('student.post.store') }}" method="POST">
                @csrf
                <div class="p-2 flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right">Full Name</label>
                    <div class="w-full">
                        <input
                            class="focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3 capitalize"
                            type="text" name="name" placeholder="Enter fullname" required />
                    </div>
                </div>
                <div class="p-2 flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right">Email</label>
                    <div class="w-full">
                        <input
                            class="focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3"
                            type="email" name="email" placeholder="Enter email" required />
                            <span class="text-sm text-green-500">Use this "@learnDev" </span>
                    </div>
                </div>
                <div class="p-2 flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right">Password</label>
                    <div class="w-full">
                        <input
                            class="focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3"
                            type="password" name="password" placeholder="Enter password" required value="12345678" />
                        <span class="text-sm text-green-500">Default password is "12345678"</span>
                    </div>
                </div>
                <input type="hidden" name="role" value="student" required>
                <div class="p-2 flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right">Phone Number</label>
                    <div class="w-full">
                        <input
                            class="focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3"
                            type="text" name="phone" placeholder="Enter phone number" required />
                    </div>
                </div>
                <div class="p-2 flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right">Supervisor</label>
                    <div class="w-full">
                        <select id="select2" name="supervisor_id" class="focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3 capitalize" required>
                            @foreach ($supervisors as $item)
                            <option value="{{ $item->id }}">{{ $item->user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="p-2 flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right">Division</label>
                    <div class="w-full">
                        <input
                            class="focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3 capitalize"
                            type="text" name="division" placeholder="Enter division" required />
                    </div>
                </div>
                <div class="p-2 flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right">Department</label>
                    <div class="w-full">
                        <input
                            class="focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3 capitalize"
                            type="text" name="department" placeholder="Enter department" required />
                    </div>
                </div>
                <div class="p-2 flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right">Job Role</label>
                    <div class="w-full">
                        <input
                            class="focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3 capitalize"
                            type="text" name="job_role" placeholder="Enter job role" required />
                    </div>
                </div>
                <div class="p-2 flex">                    
                    <label class="w-1/4 inline py-2 pr-4 text-right">Start and End Date</label>
                    <div class="w-full flex">
                        <input class="focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none w-full text-base placeholder-gray-400 border border-gray-300 rounded-l py-1.5 px-3" type="date" name="start_date" placeholder="Start date" required />
                        <input class="focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none w-full text-base placeholder-gray-400 border border-gray-300 rounded-r py-1.5 px-3" type="date" name="end_date" placeholder="End date" required />
                    </div>
                </div>

                <div class="p-2 flex mt-2">
                    <label class="w-1/4 inline py-2 pr-4 text-right"></label>
                    <div class="w-full">
                        <button class="px-4 py-2 text-sm border border-transparent rounded bg-green-500 text-white hover:bg-green-500 focus:outline-none focus:border-green-500 focus:shadow-outline-green active:bg-green-500 transition duration-150 ease-in-out inline-flex items-center" type="submit">
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

@section('js')
<script src="{{ asset('view/select2.js') }}"></script>
@endsection