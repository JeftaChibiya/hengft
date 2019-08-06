@guest
<div class="bg-blue-blue_special">
    <div class="container mx-auto flex items-center justify-center py-3 px-5 sm:px-24">              
        @if(Route::has('register'))
        <a href="{{ route('register') }} ">
            <button class="flex items-center bg-blue-blue_special_light hover:bg-blue-blue_special_lighter text-blue-100 font-bold p-3 px-4 rounded-full" style="transition: .5s">
                <span class="mr-6">Try HengFT free for 3 - 5 days</span>
                <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/></svg>                
            </button>             
        </a>
        @endif     
    </div>          
</div>
@endif