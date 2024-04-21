<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/custom/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/custom/responsive.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />

    <title>
        @isset($title)
            {{ $title }} | Play
        @endisset
    </title>

    @yield('head')
    @yield('styles')
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm nav_custom_bg">
        <div class="container">
            <a class="navbar-brand text-white" href="{{route('home')}}">
                <div class="flex justify-content item-center">
                    <img src="{{ asset('images/logo.png') }}" alt="logo" class="img-fluid" width="100">
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fa-solid fa-bars text-white"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="#">Home</a>
                    </li>
                </ul>
                <div class="d-flex">
                    @if(Auth::check())
                        <a>
                            <i class="fa fa-user text-white me-2"></i> {{auth()->user()->msisdn}}
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bx bx-power-off me-2"></i>
                            <span class="align-middle">Log Out</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @else
                    <a href="{{route('public.login')}}" class="btn btn-outline-white px-2" type="button">Login</a>
                    @endif

                </div>
            </div>
        </div>
    </nav>

    <div class="container my-4">
        @yield('content')
    </div>

    <footer class="fixed mobile_footer bottom-0 bg-footer w-full">
        <div class="flex justify-content-between footer_container">
            <div class="@isset($title) @if ($title == 'Game') active @endif @endisset">
                <a href="#">
                    <i class="fa-solid fa-home"></i>
                </a>
                <p>Game</p>
            </div>
            <div class="@isset($title) @if ($title == 'Tournament') active @endif @endisset">

                <a href="#">
                    <i class="fa-solid fa-home"></i>
                </a>
                <p>Tournament</p>
            </div>
            <div class="@isset($title) @if ($title == 'Home') active @endif @endisset">
                <a href="{{route('home')}}">
                    <i class="fa-solid fa-home"></i>
                </a>
                <p>Home</p>
            </div>
            <div class="@isset($title) @if ($title == 'Winner') active @endif @endisset">
                <a href="#">
                    <i class="fa-solid fa-home"></i>
                </a>
                <p>Winner</p>
            </div>
            <div class="@isset($title) @if ($title == 'Leaderboard') active @endif @endisset">
                <a href="{{route('public.leaderboard')}}">
                    <i class="fa-solid fa-home"></i>
                </a>
                <p>Leaderboard</p>
            </div>
        </div>
    </footer>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


    <script src="{{ asset('assets/custom/script.js') }}"></script>
</body>

</html>
