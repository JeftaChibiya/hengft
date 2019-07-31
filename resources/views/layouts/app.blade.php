<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('partials.app_head')

<body>
    <div id="app">
        @include('partials.sidenav') 
        <!-- signup reminder-->
        @include('partials.signup_reminder')      

        <main class="mb-10">
            @yield('page_intro')        
            @yield('content')
        </main>      

        <!-- if any sesison messages exist -->
        <flash message="{{ session('flash') }}"></flash>         

        @include('partials.footer')         
    </div>

    @include('partials.app_scripts')

</body>
</html>
