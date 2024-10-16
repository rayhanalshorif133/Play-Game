<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link href="{{ asset('web_assets/dist/css/bootstrap.min.css') }}" rel="stylesheet">
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

    <link href="{{ asset('web_assets/css/leaderboard-more.css') }}" rel="stylesheet">
    <link href="{{ asset('web_assets/css/style.css') }}" rel="stylesheet">

    <link href="{{ asset('web_assets/css/custom_style.css') }}" rel="stylesheet">

    <link href="{{ asset('web_assets/css/responsive_style.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="https://scripts.pay.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />


    <title>
        @isset($title)
            {{ $title }} | Play
        @endisset
    </title>

    <style>
        .how-section1 {
            margin-top: -15%;
            padding: 10%;
        }

        body,
        .footer-body,
        .top-navbar {
            background: rgb(122,19,19);
        background: linear-gradient(90deg, rgba(122,19,19,1) 0%, rgba(227,150,150,1) 50%, rgba(122,19,19,1) 100%);
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

        .bg-white {
            background-color: white;
        }

        .w-full {
            width: 100%;
        }
    </style>

    @yield('head')
    @yield('styles')

</head>

<body>
    <div class="wrapper">
        @yield('content')
        @php
            $route = Route::currentRouteName();
        @endphp
        <footer id="footer-menu-panel">
            <div class="container-fluid mobile">
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

    <!--Start of Tawk.to Script-->
    {{-- <script type="text/javascript">
    document.createElement("test");
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/6638a3e207f59932ab3c7750/1ht6k0bsg';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script> --}}
    <!--End of Tawk.to Script-->
    <!-- Bootstrap core JavaScript
      ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    {{-- <script src="{{ asset('web_assets/js/main.js') }}"></script> --}}

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


        $(".togglePassword").click(function() {

            $(this).parent().find('input').attr('type', function(index, attr) {
                return attr == 'password' ? 'text' : 'password';
            });

            $(this).toggleClass('fa-eye-slash');
        });
    </script>

    @stack('scripts')
</body>

</html>
