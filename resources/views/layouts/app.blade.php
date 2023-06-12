<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
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
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Email
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" name="email" id="email" type="email" autocomplete="email" autofocus
                        required>
                    @error('email')
                    <span class="text-red-400 font-light" role="alert">
                        <strong>{{ $message }} </strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline form-control @error('password') is-invalid @enderror"
                        name="password" id="password" type="password" placeholder="Password"
                        autocomplete="current-password" required>
                    @error('password')
                    <span class="text-red-500 text-xs italic" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>

                <div class="flex items-center justify-between">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                        Sign In
                    </button>
                </div>

            </form>
        </div>
    </div>
    

</body>

</html>
