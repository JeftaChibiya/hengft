<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('partials.app_head')

<body style="background: linear-gradient(180deg, rgb(23, 57, 147), rgb(45, 85, 151)); height: 100vh">

    <div id="app">
        <main>
            @yield('content')
        </main>      

    <!-- if any sesison messages exist -->
    <notice message="{{ session('flash') }}"></notice>          
    </div>   

    @include('partials.app_scripts')

</body>
</html>
