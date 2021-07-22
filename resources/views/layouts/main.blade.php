<html>
    <head>
        <title>@yield('title')</title>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

        <link rel="stylesheet" href="/css/bootstrap_5.min.css" />
    </head>
    <body>
        <div class="container mt-3 p-5">
            @if(Session::has('msg'))
                <div class="alert alert-{{session('msg.type')}} d-flex align-items-center alert-dismissible" role="alert" id="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg>
                    <div >
                        {{session('msg.message')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            <div class="row mb-5">
                <div class="col-12 border-bottom">
                    <a href="/" class="h1 text-decoration-none text-dark link-dark">Spotawheel challenge</a>
                </div>
            </div>
            @yield('content')
        </div> 
          
        <script type="text/javascript" src="/js/bootstrap_5.bundle.min.js"></script>
        <script type="text/javascript" src="/js/jquery-3.6.0.min.js"></script>
        @yield('javascript')
    </body>
</html>
