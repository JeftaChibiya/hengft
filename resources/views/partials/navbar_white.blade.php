<nav role="navigation" aria-label="main navigation">
  <div class="container mx-auto px-5 sm:px-16"> 
    <div class="flex items-center justify-between flex-wrap bg-none py-6">
      <div class="flex items-center flex-no-shrink text-white mr-6">
          <a class="navbar-brand-item" href="{{ url('/') }}" data-turbolinks="false">
            <img src="/images/new_logo.svg" width="130px" alt="">
          </a> 
      </div>

    <div class="block sm:hidden">
        @guest
          <div class="hamburger-nav" onclick="openNav()">
            <span></span>
            <span></span>
            <span></span>
          </div>
        @else
        <div onclick="openNav()" class="inline-block text-sm px-4 py-2 no-underline leading-none text-black">            
          <vue-letter-avatar onclick="openNav()" name='{{ Auth::user()->name }}' size='40' :rounded=true />        
        </div>           
        @endif  
    </div>

    <div class="hidden w-full flex-grow lg:flex lg:items-center lg:w-auto">
      <div class="text-sm lg:flex-grow flex justify-center">
        <a href="{{ route('pre-match-tips') }}" class="text-center text-base font-medium font-sans no-underline block lg:inline-block text-gray-400 hover:text-gray-100 active:text-gray-100 mr-8">
          TIPS
        </a>
        <a href="{{ route('inplay-tips') }}" class="text-center text-base font-medium font-sans no-underline block lg:inline-block text-gray-400 hover:text-gray-100 mr-8">
          INPLAY
        </a>        
        <a href="{{ route('specials') }}" class="text-center text-base font-medium font-sans no-underline block lg:inline-block text-gray-400 hover:text-gray-100 mr-8">
          SPECIALS
        </a>
        </div>
        @guest
        <a href="{{ route('login') }} " class="inline-block text-center text-sm no-underline block mt-0 text-gray-400 hover:text-gray-200 mr-3">SIGN IN</a>
        @if(Route::has('register'))
        <a href="{{ route('register') }}" class="inline-block text-sm px-4 py-2 no-underline leading-none border rounded text-gray-100 border-white hover:text-gray-300 hover:border-gray-300 mt-4 lg:mt-0">JOIN</a>
        @endif
        @else
        <div class="block px-4 py-2"></div>        
        <div onclick="openNav()" class="block text-sm px-4 py-2">  
         <keep-alive>          
          <vue-letter-avatar onclick="openNav()" name='{{ Auth::user()->name }}' size='40' :rounded=true />        
         <keep-alive>
        </div>             
        @endif
      </div>
    </div>    
  </div>
</nav>