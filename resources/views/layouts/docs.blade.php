<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('partials.head')

<body>
    <div id="app">      
        <main class="mb-10">     
            @yield('content')
        </main>
      
    </div>
    @include('partials.scripts')
</body>
</html>