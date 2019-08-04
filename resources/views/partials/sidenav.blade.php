
<div id="mySidenav" class="flex flex-col justify-end justify-between sidenav h-screen fixed right-0 z-10 overflow-hidden text-center">
    <a href="javascript:void(0)" class="no-underline text-white absolute top-0 right-0 mt-10 mr-10 text-2xl" onclick="closeNav()"> <i class="fas fa-times fa-2x"></i> </a>
    <div class="flex flex-col justify-center items-center h-full">   
      @if(Auth::user())
       <div class="inline-block mb-8 mt-4 lg:mt-0">      
        <vue-letter-avatar name='{{ Auth::user()->name }}' size='40' :rounded=true />
       </div>    
      @endif     
        <a class="mb-4 p-2 no-underline text-3xl text-white font-bold uppercase" href="/tips">Tips</a>
        <a class="mb-4 p-2 no-underline text-3xl text-white font-bold uppercase" href="/inplay">Inplay</a>
        <a class="mb-4 p-2 no-underline text-3xl text-white font-bold uppercase" href="/specials">SPECIALS</a>
      @if(Auth::user())       
        <a class="mb-4 p-2 no-underline text-3xl text-white font-bold uppercase" href="/settings">settings</a>           
      @endif           
    </div>

    @guest
      <a href="{{ route('login') }} " class="mx-8 p-2 no-underline text-3xl text-white font-bold uppercase">SIGN IN</a>   
       @if(Route::has('register'))
       <a class="m-8 p-2 no-underline text-3xl text-white font-bold uppercase border rounded-full" href="{{ route('register') }}">JOIN</a> 
       @endif
       @else
       <div class="flex flex-col items-center justify-center">
            <a class="m-8 w-3/4 sm:w-1/3 lg:w-1/4 p-2 no-underline text-3xl text-white font-bold uppercase border rounded-full" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('logout') }}
            </a>  
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>         
       </div>           
       @endif         
    <!-- <a class="m-8 mb-1 p-2 no-underline text-3xl text-white font-bold uppercase border rounded-full" href="{{ route('login') }}">SIGN IN</a>   -->    
</div>