<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest"></script>
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">

    <title>
        @isset($title)
            {{ $title }} | Play
        @endisset
    </title>
    @yield('head')
    @yield('styles')
</head>

<body>

    <div class="wrapper">
        @yield('content')
    </div>


    {{-- <footer class="mt-4">
        <div class="lottie_banner">
            <lottie-player class="lottie-player" src="{{ asset('images/banner.json') }}" background="transparent" speed="1" loop autoplay>
            </lottie-player>
        </div>
    </footer> --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>



    <script>
        const interval = 2000;
        $(() => {
            setInterval(() => {
                // location.reload();
            }, interval);
        });
    </script>
    @stack('scripts')
</body>

</html>
