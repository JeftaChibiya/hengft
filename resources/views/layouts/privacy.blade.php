<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('partials.app_head')

<body>
    <div id="app">    
        <main class="py-4 mb-10">
            @yield('content')
        </main>       
    </div>

    @include('partials.scripts')

</body>
</html>
