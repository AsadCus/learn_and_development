@extends('main')

@section('title')
<h3 class="text-gray-600 text-sm">
    <a href="" class="text-green-500">
        <i class="bx bx-home mr-1"></i>
        profile
    </a>
    <a href="{{ route('profile.student') }}" class="text-green-500">
        / {{ Auth::user()->name }}
    </a>
    / Edit
</h3>
@endsection

@section('content')
<div>
    <h1 class="text-2xl mt-1 ml-2 font-medium">Edit Data Student</h1>
</div>
<!-- Form -->
<div class="">
    <div class="bg-white border rounded mx-2 my-4">
        <div class="py-3 px-4 border-b flex justify-between items-center">
            <h2 class="text-lg font-medium text-gray-700">Student Form</h2>
        </div>
        <div class="px-6 text-gray-600">
            <form action="{{ route( 'profile.student.update', $student->id ) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="p-2 flex-row sm:flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right">Full Name</label>
                    <div class="w-full">
                        <input class=" w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3 capitalize" type="text" name="name" placeholder="Enter fullname" value={{$student->user->name}} required />
                    </div>
                </div>
                <div class="p-2 flex-row sm:flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right">NIK</label>
                    <div class="w-full">
                        <input class=" w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3 capitalize" type="text" name="nik" placeholder="Enter fullname" value={{$student->nik}} required />
                    </div>
                </div>
                {{-- <div class="p-2 flex-row sm:flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right">Change Password</label>
                    <div class="w-full">
                        <input class=" w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3" type="password" name="password" value="{{$student->user->password}}" required />
                    </div>
                </div> --}}
                <div class="p-2 flex-row sm:flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right text-sm md:text-base">Major</label>
                    <div class="w-full">
                        <input class="focus:outline-none w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3 capitalize" type="text" name="major" placeholder="Enter major" value="{{ $student->major }}"/>
                    </div>
                </div>
                <div class="p-2 flex-row sm:flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right text-sm md:text-base">IPK</label>
                    <div class="w-full">
                        <input class=" focus:outline-none w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3" type="text" name="ipk" placeholder="Enter ipk" value="{{ $student->ipk }}"/>
                    </div>
                </div>
                <div class="p-2 flex-row sm:flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right text-sm md:text-base">Address</label>
                    <div class="w-full">
                        <input class="focus:outline-none w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3 capitalize" type="text" name="address" placeholder="Enter adress" value="{{ $student->address }}"/>
                    </div>
                </div>
                <div class="p-2 flex-row sm:flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right text-sm md:text-base">Phone Number</label>
                    <div class="w-full">
                        <input class=" w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3" type="text" name="phone" placeholder="Enter phone number" required value="{{ $student->phone }}"/>
                    </div>
                </div>
                <div class="p-2 flex-row sm:flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right text-sm md:text-base">Emergency Contact</label>
                    <div class="w-full">
                        <input class=" w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3" type="text" name="emergency_contact" placeholder="Enter phone number" value="{{ $student->emergency_contact }}"/>
                    </div>
                </div>
                {{-- photo --}}
                <div class="flex-row lg:flex mt-1 px-6">
                    <div class="w-full lg:w-2/5 flex justify-center">
                        <div>
                            <img src={{Auth::user()->image ? asset('profile/'.Auth::user()->image)  : asset('dist/avatar/profile_default.png') }} alt="{{Auth::user()->image}}" class="h-36 w-24 mx-auto my-4">
                            @if(Auth::user()->image)
                            <a class="text-sm text-slate-500 font-thin mx-auto" href="javascript:$('#form_delete').submit();">delete photo?</a>
                            @endif
                            <p class="font-extralight mx-auto"> {{ Auth::user()->image ? 'insert your photo' : 'this is an example photo'}}</p>
                        </div>
                    </div>
                        <div class="rounded-lg border bg-gray-50 w-full">
                            <div class="m-4">
                                <label for="file" class="drop-container w-full">
                                    <span class="text-base text-center font-medium">Upload photo (PNG, JPG, JPEG)</span>
                                    <span class="text-xs text-gray-500">max: 5 mb</span>
                                    {{-- <input type="file" name="document" required> --}}
                                    <input type="file" name="image" accept=".jpg, .jpeg, .png"/>
                                </label>
                            </div>
                        </div>
                </div>

                <div class="p-2 flex-row md:flex  mt-6">
                    <label class="w-1/6 inline py-2 pr-4 text-right"></label>
                    <div class="w-2/6 md:w-full">
                        <button class="bg-yellow-500 px-4 py-2 text-white rounded text-sm whitespace-nowrap mt-2">
                            <a href="{{route('change-password')}}" >Edit Password</a>
                        </button>
                        <button class="bg-red-500 p-2.5 text-white rounded text-sm whitespace-nowrap mt-2">
                            <a href="/" class="bg-red-500 p-2.5 text-white rounded text-sm">Back</a>
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm border border-transparent rounded bg-green-500 text-white transition duration-150 ease-in-out whitespace-nowrap mt-2">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Table -->

<form id="form_delete" action="{{ route('profile.delete.image', Auth::user()->id) }}" method="POST">
    @method('put')
    @csrf
</form>
@endsection

@section('js')
<script src="{{ asset('view/select2.js') }}"></script>
@endsection