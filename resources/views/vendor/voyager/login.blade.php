<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" dir="{{ __('voyager::generic.is_rtl') == 'true' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="none" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="admin login">
    <title>Admin - {{ Voyager::setting("admin.title") }}</title>

    <link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}">  

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
</head>

    <body class="border-t-4 border-blue-400" style="height: 100vh; background: linear-gradient(180deg, rgb(38, 76, 137), rgb(38, 69, 137)); background-repeat: no-repeat">

    <div class="container mx-auto pt-48 px-5">
        <div class="flex flex-col justify-center items-center">
            <div class="w-full sm:w-1/3">
                <p class="text-xl font-bold text-gray-300 mb-10">Sign in below</p>

                <form action="{{ route('voyager.login') }}" method="POST">
                    {{ csrf_field() }}

                    <div class="mb-4">
                        <label class="block text-gray-400 text-sm font-bold mb-2" for="username">
                            Email Address
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" name="email" type="text" value="{{ old('email') }}" placeholder="Email Address">
                    </div>
                    <div class="mb-3">
                        <label class="block text-gray-400 text-sm font-bold mb-2" for="password">
                            Password
                        </label>
                        <input class="shadow appearance-none rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" name="password" placeholder="{{ __('voyager::generic.password') }}">
                    </div>

                    <div class="flex items-center mb-6">
                        <label class="block text-gray-400">
                            <input class="mr-2 leading-tight" type="checkbox" name="remember" value="1">
                            <span class="text-sm">
                                Remember me
                            </span>
                        </label>
                    </div>                

                    <div class="flex items-center justify-between mb-4">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                            Sign In
                        </button>
                    </div>   

                    @if(!$errors->isEmpty())
                        <div class="text-red-400 text-sm">
                            <ul class="list-unstyled">
                                @foreach($errors->all() as $err)
                                <li class="mb-2">{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif                

                </form>

            </div> 
        </div>
    </div>
    </body>
</html>
