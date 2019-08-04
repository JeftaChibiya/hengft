<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('partials.app_head')

<body>

    <div id="app">
        <main style="background: linear-gradient(180deg, rgb(23, 57, 147), rgb(45, 85, 151)); height: 100vh">
            @yield('content')
        </main>      
    </div>

    @include('partials.app_scripts')

</body>
</html>
