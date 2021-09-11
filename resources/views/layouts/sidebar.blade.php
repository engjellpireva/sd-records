<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/0669de81bc.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .sidebar {
            background: #1d1919;
        }
        #logo {
            padding: 50px;
        }
        #logo:hover {
            background: #242e37;
        }
    </style>

</head>
<body>
    <div class="container-fluid p-0 d-md-flex">
        <div class="sidebar col-12 col-md-2 min-vh-100 p-0">
            <a href="{{ route('home') }}">
                <img src="{{ asset('/storage/images/logo3.png') }}" id="logo" class="img-fluid" alt="">
            </a>
            @auth
            <ul class="list-unstyled px-2">
                <li class="list-item border-bottom py-2 border-secondary">
                    <p class="text-white fw-bold fs-6 my-auto">
                        @role('Supervisor')
                        Supervisor {{ Auth::user()->name }}
                        @elserole('Administrator')
                        Administrator {{ Auth::user()->name }}
                        @else
                        Deputy Sheriff {{ Auth::user()->name }}
                        @endrole
                    </p>
                    <div class="d-flex flex-column">
                        @hasrole('Supervisor|Administrator')
                        <a href="/admin" class="text-decoration-none {{ request()->is('admin*') ? 'text-warning' : 'text-secondary' }}">Administration Panel</a>
                        @endhasrole
                        <a href="/warrants/mine" class="text-decoration-none {{ request()->is('warrants/mine') ? 'text-warning' : 'text-secondary' }}">My Warrants</a>
                        <a href="{{ route('logout') }}" class="text-decoration-none text-secondary" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"}>Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        </div>
                </li>
                <li class="list-item border-bottom py-2 border-secondary">
                    <a data-bs-toggle="collapse" class="d-flex justify-content-between text-decoration-none {{ request()->is('warrants/arrest/*') ? 'text-warning' : 'text-white' }} fw-bold fs-6" href="#arrestWarrants" role="button" aria-expanded="false" aria-controls="arrestWarrants">
                        Arrest Warrants
                        <i class="fas my-auto fa-caret-down"></i>
                    </a>
                    <div class="collapse" id="arrestWarrants">
                        <span class="d-flex flex-column">
                            <a href="/warrants/arrest/create" class="text-decoration-none {{'warrants/arrest/create' === request()->path() ? 'text-warning' : 'text-secondary' }}">Create Warrant</a>
                            <a href="/warrants/arrest/pending" class="text-decoration-none {{'warrants/arrest/pending' === request()->path() ? 'text-warning' : 'text-secondary' }}">Warrant Applications</a>
                            <a href="/warrants/arrest/open" class="text-decoration-none {{'warrants/arrest/open' === request()->path() ? 'text-warning' : 'text-secondary' }}">Open Warrants</a>
                            <a href="/warrants/arrest/closed" class="text-decoration-none {{'warrants/arrest/closed' === request()->path() ? 'text-warning' : 'text-secondary' }}">Closed Warrants</a>
                        </span>
                    </div>
                </li>
                <li class="list-item border-bottom py-2 border-secondary">
                    <a data-bs-toggle="collapse" class="d-flex justify-content-between text-decoration-none text-white {{ request()->is('warrants/search/*') ? 'text-warning' : 'text-white' }} fw-bold fs-6" href="#searchWarrants" role="button" aria-expanded="false" aria-controls="searchWarrants">
                        Search Warrants
                        <i class="fas my-auto fa-caret-down"></i>
                    </a>
                    <div class="collapse" id="searchWarrants">
                        <span class="d-flex flex-column">
                            <a href="/warrants/search/create" class="text-decoration-none {{'warrants/search/create' === request()->path() ? 'text-warning' : 'text-secondary' }}">Create Warrant</a>
                            <a href="/warrants/search/pending" class="text-decoration-none {{'warrants/search/pending' === request()->path() ? 'text-warning' : 'text-secondary' }}">Warrant Applications</a>
                            <a href="/warrants/search/open" class="text-decoration-none {{'warrants/search/open' === request()->path() ? 'text-warning' : 'text-secondary' }}">Open Warrants</a>
                            <a href="/warrants/search/closed" class="text-decoration-none {{'warrants/search/closed' === request()->path() ? 'text-warning' : 'text-secondary' }}">Closed Warrants</a>
                        </span>
                    </div>
                </li>
                <li class="list-item border-bottom py-2 border-secondary">
                    <a data-bs-toggle="collapse" class="d-flex justify-content-between text-decoration-none text-white fw-bold fs-6" href="#individuals" role="button" aria-expanded="false" aria-controls="individuals">
                        Individuals
                        <i class="fas my-auto fa-caret-down"></i>
                    </a>
                    <div class="collapse" id="individuals">
                        <span class="d-flex flex-column">
                            <a href="#" class="text-decoration-none text-secondary">Create Individual</a>
                            <a href="#" class="text-decoration-none text-secondary">View Individuals</a>
                        </span>
                    </div>
                </li>
                @hasrole('Administrator')
                <li class="list-item border-bottom py-2 border-secondary">
                    <a href="/logs" class="{{'logs' == request()->path() ? 'text-warning' : 'text-white' }} text-decoration-none fw-bold fs-6">Logs</a>
                </li>
                @endhasrole
                <li class="list-item border-bottom py-2 border-secondary">
                    <a href="/changelog" class="{{'changelog' == request()->path() ? 'text-warning' : 'text-white' }} text-decoration-none fw-bold fs-6">Changelog</a>
                </li>
            </ul>
            @else
            <ul class="list-unstyled px-2">
                <li class="list-item border-bottom border-secondary py-2 text-white">
                    <a href="{{ route('login') }}" class="fw-bold fs-6 text-decoration-none {{ request()->is('login') ? 'text-warning' : 'text-secondary' }}">Login</a>
                </li>   
            </ul>
            @endauth
        </div>
        @yield('content')
    </div>

</body>
</html>