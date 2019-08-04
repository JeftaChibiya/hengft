<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Search Engine SEO -->
    <meta name="application-name" content="config('app.name')">    
    <meta name="description" content="@yield('description')"/>
    <meta name="googlebot" content="@yield('robottext')"/>
    <meta name="keywords" content="@yield('keywords')"/>       

    <!--Facebook Tags-->
    <meta property="fb:app_id" content="2401217510098115">
    <meta property="og:site_name" content="HengFT">
    <meta property="og:url" content="{{ request()->fullUrl() }}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="@yield('fb_title')"/>
    <meta property="og:description" content="@yield('fb_description')"/>
    <meta property="og:image" content="@yield('fb_image')"/>
    <meta property="article:author" content="HengFT"/>
    <meta property="og:locale" content="en_UK"/>

    <!--Twitter Tags-->
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:site" content="@yield('twitter_site')"/>
    <meta name="twitter:title" content="@yield('twitter_title')"/>
    <meta name="twitter:description" content="@yield('twitter_desc')"/>
    <meta name="twitter:image" content="@yield('twitter_img')"/>  

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Muli:400,600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans:400,500,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Hind:300,400,500,600,700&display=swap" rel="stylesheet">    
    
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}" data-turbolinks-track="true">    
    <script src="https://js.stripe.com/v3/"></script> 
    <script src="{{ mix('js/app.js') }}" defer></script>      

</head>