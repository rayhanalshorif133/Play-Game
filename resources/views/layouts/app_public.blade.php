<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@200;300;400;500;600;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <!-- icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" /> -->

    <!-- Custom styles for this template -->
    <link href="{{ asset('web_assets/dist/animate/animate.min.css') }}" rel="stylesheet">

    <link href="{{ asset('web_assets/dist/ionicons/css/ionicons.css') }}" rel="stylesheet">
    <link href="{{ asset('web_assets/dist/owlcarousel/assets/owl.carousel.css') }}" rel="stylesheet">

    <link href="{{ asset('web_assets/css/style.css') }}" rel="stylesheet">

    <title>
        @isset($title)
            {{ $title }} | Play
        @endisset
    </title>

    <style>
        img {
            width: 100px;
            height: 100%;
        }

        .how-section1 {
            margin-top: -15%;
            padding: 10%;
        }

        body,
        .footer-body,
        .top-navbar {
            background-color: white
        }

        body.bodyDark,
        .containerDark,
        .topNavbar,
        .topmenubg,
        .footerbody {
            background-color: #121212;
        }

        #darkbutton p {

            padding: 0 0 0 6px;
            margin: 0px;
        }
    </style>

    @yield('head')
    @yield('styles')

</head>

<body>
    <div class="wrapper">
        <header>
            <section class="nav-top-item">
                <div id="nav-container">
                    <div class="bg"></div>
                    <div class="button " tabindex="0">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </div>
                    <div class="top-menu-bg">
                        <div id="nav-content" tabindex="0">
                            <ul class="navbar-nav bg-transparent fixed-top" id="sidebar-wrapper">
                                <li class="nav-item active">
                                    <a class="nav-link" href="#">
                                        &nbsp Home <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link darkmode" href="#" id="darkbutton"
                                        style="padding-left: 6px;">&nbsp Dark Mode</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">&nbsp About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">&nbsp FAQ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">&nbsp Terms & Conditions</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">&nbsp
                                        Logout</a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </ul>

                        </div>
                        <a class="navbar-brand text-left d-block " href="#" style="margin-left: 3.5%;">
                            <img src="{{ asset('web_assets/images/logo.png') }}" style="height: 40px; width: auto;"
                                alt="" title="">
                        </a>
                    </div>
                    <!-- top-menu-bg -->
                </div>
            </section>
            <div id="mobile-nav-panel">
                <nav class="navbar navbar-expand-lg navbar-light top-navbar">
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="#">
                        <img src="{{ asset('web_assets/images/logo.png') }}" style="height: 40px; width: auto;"
                            alt="" title="">
                    </a>
                    <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">
                                    &nbsp Home <span class="sr-only">(current)</span></a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#">&nbsp About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">&nbsp FAQ</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#">&nbsp Terms & Conditions</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">&nbsp Logout</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <!-- mobile-nav-panel -->
            <!-- ================= -->

            <!-- nav-bar-panel -->
        </header>

        @yield('content')


        @php
            $route = Route::currentRouteName();
        @endphp
        <footer id="footer-menu-panel">
            <div class="container-fluid">
                <div class="row">
                    <nav class="navbar-expand fixed-bottom">
                        <ul class="navbar footer-body">
                            <li class="nav-item">
                                <a class="nav-link  @if ($route == 'tournament.index') active @endif"
                                    aria-current="page" href="{{ route('tournament.index') }}">
                                    <i class="fas fa-trophy" style="font-size:20px"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if ($route == 'home') active @endif"
                                    href="{{ route('home') }}">
                                    <i class="fas fa-home fa-2x"></i>
                                </a>
                            </li>
                            </li>
                            <li class="nav-item">
                                @if (Auth::check())
                                    <a class="nav-link @if ($route == 'account.index') active @endif"
                                        aria-current="page" href="{{ route('account.index') }}">
                                        <i class="fas fa-user" style="font-size:20px"></i>
                                    </a>
                                @else
                                    <a class="nav-link @if ($route == 'public.login') active @endif"
                                        aria-current="page" href="{{ route('public.login') }}">
                                        <i class="fas fa-user" style="font-size:20px"></i>
                                    </a>
                                @endif
                            </li>
                        </ul>

                    </nav>
                </div>
            </div> 
        </footer>
    </div>
    <!-- Bootstrap core JavaScript
      ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('web_assets/dist/owlcarousel/owl.carousel.js') }}"></script>
    <script src="{{ asset('web_assets/dist/scrollreveal/scrollreveal.min.js') }}"></script>
    <script src="{{ asset('web_assets/js/main.js') }}"></script>

    <script>
        const body = document.querySelector('body');
        const button = document.querySelector('#darkbutton');

        const containerFluid = document.querySelector('.container-fluid');
        const footerbody = document.querySelector('.footer-body');
        const topNavbar = document.querySelector('.top-navbar');
        const topmenubg = document.querySelector('.top-menu-bg');
        // const topmenubg = document.querySelector('.top-menu-bg');

        function toggleDark() {

            if (body.classList.contains('bodyDark')) {

                body.classList.remove('bodyDark');
                containerFluid.classList.remove('containerDark');
                topNavbar.classList.remove('topNavbar');
                topmenubg.classList.remove('topmenubg');
                footerbody.classList.remove('footerbody');

                localStorage.setItem("theme", "light");

                button.innerHTML = "<p>Dark Mode<p>";

            } else {

                body.classList.add('bodyDark');
                containerFluid.classList.add('containerDark');
                topNavbar.classList.add('topNavbar');
                topmenubg.classList.add('topmenubg');
                footerbody.classList.add('footerbody');
                localStorage.setItem("theme", "bodyDark");
                button.innerHTML = "<p>Light Mode</p>";

            }

        }

        if (localStorage.getItem("theme") === "bodyDark") {

            body.classList.add('bodyDark');
            containerFluid.classList.add('containerDark');
            topNavbar.classList.add('topNavbar');
            topmenubg.classList.add('topmenubg');
            footerbody.classList.add('footerbody');

            button.innerHTML = "<p>Light Mode</p>";

        }

        document.querySelector('#darkbutton').addEventListener('click', toggleDark);
    </script>
</body>

</html>
