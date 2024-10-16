<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


    <script>
        const interval = 4000;
        $(() => {
            setInterval(() => {
                // location.reload();
            }, interval);
        });
    </script>
</body>

</html>
