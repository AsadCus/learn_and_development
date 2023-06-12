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
    / Edit
</h3>

<div>
    <h1 class="text-2xl mt-1 font-medium">Edit Data Student</h1>
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
            <form action="{{ route('student.put.update', $student->id) }}" method="POST">
                @csrf
                @method('put')
                <input type="hidden" name="role" value="student" required>
                <div class="p-2 flex-row sm:flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right">Name</label>
                    <div class="w-full">
                        <input
                            class="focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3"
                            type="text" name="name" placeholder="Enter Name" required value="{{ $student->user->name }}"/>
                    </div>
                </div>
                <div class="p-2 flex-row sm:flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right">Phone Number</label>
                    <div class="w-full">
                        <input
                            class="focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3"
                            type="text" name="phone" placeholder="Enter phone number" required value="{{ $student->phone }}"/>
                    </div>
                </div>
                <div class="p-2 flex-row sm:flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right">Emergency Contact</label>
                    <div class="w-full">
                        <input
                            class="focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3"
                            type="text" name="emergency_contact" placeholder="Enter phone number" value="{{ $student->emergency_contact }}"/>
                    </div>
                </div>
                <div class="p-2 flex-row sm:flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right">Address</label>
                    <div class="w-full">
                        <textarea
                            class="border-green-500 focus:ring-1 focus:ring-green-200 focus:outline-none w-full text-base placeholder-gray-400 border rounded py-1.5 px-3"
                            rows="3"
                            name="address"
                            placeholder="Enter address" 
                        >{{ $student->address }}</textarea>
                    </div>
                </div>
                <div class="p-2 flex-row sm:flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right">Supervisor</label>
                    <div class="w-full">
                        <select id="" name="supervisor_id" class="focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3 capitalize" required>
                            <option value="{{ $student->supervisor_id }}">{{ $student->supervisor->user->name }}</option>
                            @foreach ($supervisors as $item)
                            <option value="{{ $item->id }}">{{ $item->user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="p-2 flex-row sm:flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right">Division</label>
                    <div class="w-full">
                        <input
                            class="focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3 capitalize"
                            type="text" name="division" placeholder="Enter division" required value="{{ $student->division }}"/>
                    </div>
                </div>
                <div class="p-2 flex-row sm:flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right">Department</label>
                    <div class="w-full">
                        <input
                            class="focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3 capitalize"
                            type="text" name="department" placeholder="Enter department" required value="{{ $student->department }}"/>
                    </div>
                </div>
                <div class="p-2 flex-row sm:flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right">Job Role</label>
                    <div class="w-full">
                        <input
                            class="focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3 capitalize"
                            type="text" name="job_role" placeholder="Enter job role" required value="{{ $student->job_role }}"/>
                    </div>
                </div>
                <div class="p-2 flex-row sm:flex">                    
                    <label class="w-1/4 inline py-2 pr-4 text-right">Start and End Date</label>
                    <div class="w-full flex-row sm:flex">
                        <input class="focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none w-full text-base placeholder-gray-400 border border-gray-300 rounded-l py-1.5 px-3" type="date" name="start_date" placeholder="Start date" required value="{{ $student->start_date->format('Y-m-d') }}"/>
                        <input class="focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none w-full text-base placeholder-gray-400 border border-gray-300 rounded-r py-1.5 px-3" type="date" name="end_date" placeholder="End date" required value="{{ $student->end_date->format('Y-m-d') }}"/>
                    </div>
                </div>
                <div class="p-2 flex-row sm:flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right">institute</label>
                    <div class="w-full">
                        <select class="form-control select2 focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3 capitalize" name="institute_id" required>
                            <option selected="selected" value="{{$student->institute_id ? $student->institute_id : ''}}">{{$student->institute_id ? $student->institute->name : 'select institute'}}</option>
                            @foreach($institute->where('id', '!==', $student->institute_id) as $univ)
                            <option value="{{$univ->id}}">{{$univ->name}}</option> 
                            @endforeach 
                        </select>
                    </div>
                </div>
                <div class="p-2 flex-row sm:flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right">Major</label>
                    <div class="w-full">
                        <input
                            class="focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3 capitalize"
                            type="text" name="major" placeholder="Enter major" value="{{ $student->major }}"/>
                    </div>
                </div>
                <div class="p-2 flex-row sm:flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right">IPK</label>
                    <div class="w-full">
                        <input
                            class="focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3"
                            type="text" name="ipk" placeholder="Enter ipk" value="{{ $student->ipk }}"/>
                    </div>
                </div>
                <div class="p-2 flex-row sm:flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right">Status</label>
                    <div class="w-full mt-2">
                        <!-- Rounded switch -->
                        <input type="radio" id="radio-one" name="status" value="active" {{($student->user->status == "active") ? 'checked' : '' }}/>
                        <label for="radio-one">Active</label>
                        <input type="radio" id="radio-two" name="status" value="inactive" {{($student->user->status == "inactive") ? 'checked' : '' }}/>
                        <label for="radio-two">Inactive</label>
                    </div>
                </div>
                {{-- <div class="p-2 flex-row sm:flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right">CV</label>
                    <div class="w-full">
                        <input
                            class="focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3 capitalize"
                            type="file" name="cv" placeholder="Upload CV" value="{{ $student->cv }}"/>
                    </div>
                </div> --}}

                <div class="p-2 flex-row sm:flex mt-2">
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