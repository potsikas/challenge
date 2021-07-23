<html>
    <head>
        <title>@yield('title')</title>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link rel="stylesheet" href="/css/bootstrap_5.min.css" />
        @yield('css')
    </head>
    <body>
        <div class="container mt-3 p-5">
            
            <div class="row mb-5 border-bottom pb-3">
                <div class="col-4 ">
                    <a href="/" class="h2 text-decoration-none text-dark link-dark">Spotawheel challenge</a>
                </div>
                <div class="col-4">
                    <div class="row justify-content-center">
                        <form action="/clients">
                            <button type="submit" class="btn btn-lg btn-primary col-8" {{ request()->is('clients*') ? 'disabled' : '' }} >
                                Clients
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row justify-content-center">
                        <form action="/payments">
                            <button type="submit" class="btn btn-lg btn-warning col-8" {{ request()->is('payments*') ? 'disabled' : '' }} >
                            Payments
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @if(Session::has('msg'))
                <div class="alert alert-{{session('msg.type')}} align-items-center alert-dismissible" role="alert" >
                    <div >
                        {{session('msg.message')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div> 
            @endif
            @yield('content')
        </div> 
          
        <script type="text/javascript" src="/js/bootstrap_5.bundle.min.js"></script>
        <script type="text/javascript" src="/js/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="/js/custom.js"></script>
        @yield('javascript')
    </body>
</html>