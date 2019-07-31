@extends('layouts.app')

@section('title', 'HengFT | Get Involved')
@section('description', 'Take part in our quizzes, polls and giveaways')
@section('robottext', 'all')
@section('keywords', 'Quizzes, polls, giveaways')

@section('content')

@section('page_intro')
    <div style="background-color: rgb(46, 58, 77)">
        @include('partials.navbar_white')
        <div class="pt-2 sm:pt-10 pb-10 flex flex-col items-center">            
            <div class="mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 24 24"><path fill="#27313f" d="M4 12c0-1.261-.926-2-1.652-2-.651 0-.875.35-1.141.615-.539.543-1.207.313-1.207-.565v-4.05h12v4.05c0 .932.575 1.357 1.109 1.357.332 0 .672-.156.953-.438.283-.296.389-.469.785-.469.471 0 1.153.534 1.153 1.5s-.682 1.5-1.152 1.5c-.396 0-.501-.173-.785-.468-.281-.283-.621-.438-.953-.438-.534 0-1.109.425-1.109 1.357v4.049h-4.051c-.877 0-1.108.666-.564 1.209.265.266.614.486.614 1.139 0 .724-.739 1.652-2 1.652-1.262 0-2-.928-2-1.652 0-.653.348-.874.613-1.139.547-.543.313-1.209-.562-1.209h-4.051v-4.05c0-.878.668-1.108 1.207-.565.266.265.489.615 1.141.615.726 0 1.652-.739 1.652-2zm12.613-7.209c.547.543.313 1.209-.562 1.209h-3.051v4.05c0 .533.137.442.454.109.245-.263.616-.659 1.394-.659 1.039 0 2.152 1.004 2.152 2.5s-1.113 2.5-2.152 2.5c-.777 0-1.148-.396-1.394-.659-.317-.331-.454-.425-.454.109v4.05h11v-12h-4.049c-.879 0-1.109-.666-.566-1.209.265-.266.615-.486.615-1.139 0-.724-.74-1.652-2-1.652-1.262 0-2 .928-2 1.652 0 .653.348.873.613 1.139z"/></svg>            
            </div>    
            <p class="text-center text-xl lg:text-2xl font-bold mb-2 text-gray-200">
                We hope these will keep you entertained
            </p>
            <p class="text-center text-lg sm:text-xl font-light mt-1 text-gray-200"> 
                Quizzes, Polls & Giveaways
            </p>
        </div>
    </div>
@stop

    <p class="text-center text-2xl sm:text-3xl font-bold mt-6 text-gray-500"> 
        Content coming soon
    </p>
<!-- Take our daily poll -->
<!-- Who will win -->

@endsection