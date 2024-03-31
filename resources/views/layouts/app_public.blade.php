<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/custom/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />

    <title>
        @isset($title)
            {{ $title }} | Play
        @endisset
    </title>

    @yield('styles')
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm nav_custom_bg">
        <div class="container">
            <a class="navbar-brand text-white" href="#">
                <div class="flex justify-content item-center">
                    <img src="{{ asset('images/icon.png') }}" alt="logo" class="img-fluid" width="40">
                    {{-- <i class="fa-solid fa-play fa-fw fs-2"></i> --}}
                    <span class="flex justify-content item-center fw-bolder">Play</span>
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
                <form class="d-flex">
                    <button class="btn btn-outline-white px-2" type="submit">Login</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container my-4">
        @yield('content')
    </div>

    <footer class="fixed bottom-0 bg-footer w-full">
        <div class="flex justify-content-between footer_container">
            <div>
                <a href="#">
                    <i class="fa-solid fa-home"></i>

                </a>
                <p>Game</p>
            </div>
            <div>

                <a href="#">
                    <i class="fa-solid fa-home"></i>
                </a>
                <p>Tournament</p>
            </div>
            <div>
                <a href="#">
                    <i class="fa-solid fa-home"></i>
                </a>
                <p>Home</p>
            </div>
            <div class="active">
                <a href="#">
                    <i class="fa-solid fa-home"></i>
                </a>
                <p>Winner</p>
            </div>
            <div>
                <a href="#">
                    <i class="fa-solid fa-home"></i>
                </a>
                <p>Leaderboard</p>
            </div>
        </div>
    </footer>

    <!-- Optional JavaScript; choose one of the two! -->

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
</body>

</html>
