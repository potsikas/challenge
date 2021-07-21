<html>
    <head>
        <title>@yield('title')</title>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

        <link rel="stylesheet" href="/css/bootstrap_5.min.css" />
    </head>
    <body>
        <div class="container mt-3 p-5">
            @yield('content')
        </div> 
          
        <script type="text/javascript" src="/js/bootstrap_5.bundle.min.js"></script>
    </body>
</html>
