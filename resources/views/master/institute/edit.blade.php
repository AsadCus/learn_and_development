@extends('main')
@section('title')
<h3 class="text-gray-600 text-sm">
    <a href="" class="text-green-500">
        <i class="bx bx-home mr-1"></i>
        Master
    </a>
    <a href="{{ route('institute.get.index') }}" class="text-green-500">
        / Institute
    </a>
    / Edit
</h3>

<div>
    <h1 class="text-2xl mt-1 font-medium">Edit Data Institute</h1>
</div>
@endsection
@section('content')
<!-- Form -->
<div class="">
    <div class="bg-white border rounded mx-2 my-4">
        <div class="py-3 px-4 border-b flex justify-between items-center">
            <h2 class="text-lg font-medium text-gray-700">institute Form</h2>
        </div>
        <div class="p-3 text-gray-600">
            <form action="{{ route('institute.put.update', $institute->id) }}" method="POST">
                @csrf
                @method('put')
                <div class="p-2 flex-row sm:flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right">Name</label>
                    <div class="w-full">
                        <input class="focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3 capitalize" type="text" name="name" value="{{$institute->name}}" placeholder="Enter institute name" required />
                    </div>
                </div>
                <div class="p-2 flex-row sm:flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right">Type</label>
                    <div class="w-full">
                        <select name="type" class="focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3 capitalize" required>
                            <option selected >{{$institute->type}}</option>
                            <option value="universitas">Universitas</option>
                            <option value="institut">Institut</option>
                            <option value="sekolah tinggi">Sekolah Tinggi</option>
                            <option value="politeknik">Politeknik</option>
                            <option value="akademi">Akademi</option>
                            <option value="SM">SMA/SMK/MA</option>
                        </select>
                    </div>
                </div>
                <div class="p-2 flex-row sm:flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right">Accreditation</label>
                    <div class="w-full">
                        <input class="focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3" type="text" value="{{$institute->accreditation}}" name="accreditation" placeholder="Enter accreditation" required/>
                    </div>
                </div>
                <div class="p-2 flex-row sm:flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right">Website</label>
                    <div class="w-full">
                        <input class="focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3" type="text" value="{{$institute->website}}" name="website" placeholder="Enter Institute Website (optional)" />
                    </div>
                </div>
                <div class="p-2 flex-row sm:flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right">Institute Email</label>
                    <div class="w-full">
                        <input class="focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3 " type="email" value="{{$institute->email}}" name="email" placeholder="Enter email" required />
                    </div>
                </div>
                <div class="p-2 flex-row sm:flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right">phone</label>
                    <div class="w-full">
                        <input class="focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3" type="text" value="{{$institute->phone}}" name="phone" placeholder="Enter phone (optional)" />
                    </div>
                </div>
                <input type="hidden" name="status" value="active">
                <div class="p-2 flex-row sm:flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right">address</label>
                    <div class="w-full">
                        <textarea name="address" placeholder="Enter institute address" rows="3" class="block p-2.5 w-full bg-gray-50 rounded-lg border border-gray-300">{{$institute->address}}</textarea>
                    </div>
                </div>
                <div class="p-2 flex-row sm:flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right">Status</label>
                    <div class="w-full mt-2">
                        <!-- Rounded switch -->
                        <input type="radio" id="radio-one" name="status" value="active" {{($institute->status == "active") ? 'checked' : '' }}/>
                        <label for="radio-one">Active</label>
                        <input type="radio" id="radio-two" name="status" value="inactive" {{($institute->status == "inactive") ? 'checked' : '' }}/>
                        <label for="radio-two">Inactive</label>
                    </div>
                </div>
                <div class="p-2 flex-row sm:flex mt-2">
                    <label class="w-1/4 inline py-2 pr-4 text-right"></label>
                    <div class="w-full">
                        <button class="px-4 py-2 text-sm border border-transparent rounded bg-green-500 text-white hover:bg-green-500 focus:outline-none focus:border-green-500 focus:shadow-outline-green active:bg-green-500 transition duration-150 ease-in-out inline-flex items-center" type="submit">
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