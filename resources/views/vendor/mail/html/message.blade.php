@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])  
            <img src="https://www.dropbox.com/s/rbplqq3sjfzpqqx/heng_social.png?raw=1"
                 style="width: 160px" 
                 alt="{{ config('app.name') }}">
                 <!-- ![{{ config('app.name') }}]('https://www.dropbox.com/s/rbplqq3sjfzpqqx/heng_social.png?raw=1')                   -->
        @endcomponent
    @endslot

    {{-- Body --}}
    {{ $slot }}

    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
        If you have any questions, please visit our <a href="http://heng.com/support">Help</a> page for more info or contact us at 
        <span class="link_text">support@hengft.com</span> <br/>           
        HengFT Football Tips. This email has been sent to you as part of your membership with HengFT. 
        Please do not reply to this email as we’re unable to respond from this email address.
        @endcomponent
    @endslot
@endcomponent