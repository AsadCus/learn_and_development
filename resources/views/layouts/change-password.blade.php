<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Password</title>
    <link rel="icon" type="image/x-icon" href="{{asset('dist/images/favicon.ico')}}">
    <!-- Tailwind element  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
    <!-- Select2  -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Tailwind css  -->
    <link rel="stylesheet" href="{{ asset('dist/css/tailwind.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('dist/libs/boxicons/css/boxicons.min.css') }}"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50">
    <div class="mt-8 md:mt-20">
        <div class="w-11/12 md:w-8/12 lg:w-5/12 mt-4 mx-auto bg-white rounded border p-8">
            <div class="w-8/12 md:w-5/12 mx-auto">
                <img src="{{asset('dist/images/LND_logo.png')}}" class="mb-5 h-32 mx-auto">
            </div>
            <form action="{{ route('update-password') }}" method="POST">
                @csrf

                @if (session('status'))
                    <div class="bg-green-500 text-white p-4 rounded mb-3" role="alert">
                        {{ session('status') }}
                    </div>
                @elseif (session('error'))
                    <div class="bg-red-500 text-white p-4 rounded mb-3" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="mb-3">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="oldPasswordInput">Old Password</label>
                    <input name="old_password" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline form-control @error('old_password') is-invalid @enderror" id="oldPasswordInput" placeholder="Old Password">
                    <input type="checkbox" onclick="myFunction()" class="mr-2">Show Password
                    @error('old_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="newPasswordInput">New Password</label>
                    <input name="new_password" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline form-control @error('new_password') is-invalid @enderror" id="newPasswordInput" placeholder="New Password" >
                    <input type="checkbox" onclick="myFunction2()" class="mr-2">Show Password
                    @error('new_password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="confirmNewPasswordInput">Confirm New Password</label>
                    <input name="new_password_confirmation" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline form-control" id="confirmNewPasswordInput" placeholder="Confirm New Password">
                    <input type="checkbox" onclick="myFunction3()" class="mr-2">Show Password
                </div>

                <div class=" flex-row md:flex mt-8">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-4"
                        type="submit">
                        Submit
                    </button>
                    @if(Auth::user()->role == 'student')
                    <a href="{{route('profile.student.edit', Auth::user()->student_id)}}" class="bg-red-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Back to edit profile
                    </a>
                    @else
                    <a href="{{route('admin.get.edit')}}" class="bg-red-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Back to edit profile
                    </a>
                    @endif
                </div>

            </form>
        </div>
    </div>

    <script>
        function myFunction() {
            var x = document.getElementById("oldPasswordInput");
            if (x.type === "password") {
              x.type = "text";
            } else {
              x.type = "password";
            }
        }
        function myFunction2() {
            var x = document.getElementById("newPasswordInput");
            if (x.type === "password") {
              x.type = "text";
            } else {
              x.type = "password";
            }
        }
        function myFunction3() {
            var x = document.getElementById("confirmNewPasswordInput");
            if (x.type === "password") {
              x.type = "text";
            } else {
              x.type = "password";
            }
        }
    </script>
</body>

</html>
