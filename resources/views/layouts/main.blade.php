<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('partials.main_head')

<body>
    <div id="app">
        @include('partials.sidenav')     
        <!-- signup reminder-->
        @include('partials.signup_reminder')          
        <!-- 1. rgb(45, 85, 151), rgb(23, 57, 147) linear-gradient(180deg,rgb(55, 81, 128) -->
        <div style="height: 100vh; background: linear-gradient(180deg, rgb(38, 76, 137), rgb(38, 69, 137))"> 
            @include('partials.navbar_white')
           <div class="mx-auto px-5 sm:px-16">
                @include('partials.home-banner')
           </div> 
        </div>

        <!-- #262e3e -->
        <main class="py-4" style="background-color: rgb(27, 45, 72)">
            @yield('content')
        </main>
        
         
        <!-- if any sesison messages exist -->
        <flash message="{{ session('flash') }}"></flash>      
        <!-- Welcome Back! You're now logged in -->

        @include('partials.footer')         
    </div>

    @include('partials.main_scripts')

</body>
</html>
