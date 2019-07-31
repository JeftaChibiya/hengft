<!DOCTYPE html>
<html>
<head>
  @include('partials.app_head')
</head>

<body>    
    <div id="app">
        @include('partials.sidenav')   
        <!-- signup reminder-->
        @include('partials.signup_reminder')      

        @yield('page_intro')

        <main>
            @yield('content')
        </main>

        @include('partials.footer')         
    </div>

    @include('partials.app_scripts')      

</body>
</html>