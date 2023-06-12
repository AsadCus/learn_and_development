@extends('main')
@section('title')
<h3 class="text-gray-600 text-sm capitalize">
    <a href="" class="text-green-500">
        <i class="bx bx-home mr-1"></i>
        Profile
    </a>
    <a href="{{ route('profile.supervisor') }}" class="text-green-500">
        / {{ Auth::user()->name }}
    </a>
    <a href="{{ route('student.get.detail', ['id' => $student->id]) }}" class="text-green-500">
        / {{ $student->user->name }}
    </a>
    / create
</h3>
@endsection
@section('content')
<!-- Table -->
<div class="">
    <div class="bg-white border rounded mx-2 my-4">
        <div class="py-3 px-4 border-b flex justify-between items-center">
            <h2 class="text-lg font-medium text-gray-700">Scoring Form</h2>
        </div>
        <div class="p-3 text-gray-600">
            <form action="{{ route('score.post.store') }}" method="POST">
                @csrf
                <input type="hidden" name="student_id" value="{{ $student->id }}" required>
                @foreach ($scoreforms as $item)
                <div class="p-2 flex">
                    <label class="w-1/4 inline py-2 pr-4 text-right capitalize">{{ $item->form }}</label>
                    <div class="w-full">
                        <select name="value[]" id="" class="focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none w-full text-base placeholder-gray-400 border border-gray-300 rounded py-1.5 px-3 capitalize">
                            @foreach ($scorevalues->where('form_id', $item->id) as $item)
                                <option value="{{ $item->id }}">{{ $item->score_select_name }} - {{ $item->value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endforeach

                <div class="p-2 flex mt-2">
                    <label class="w-1/4 inline py-2 pr-4 text-right"></label>
                    <div class="w-full">
                        <button type="submit" class="px-4 py-2 text-sm border border-transparent rounded bg-green-500 text-white hover:bg-green-500 focus:outline-none focus:border-green-500 focus:shadow-outline-green active:bg-green-500 transition duration-150 ease-in-out inline-flex items-center">
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Table -->
@endsection