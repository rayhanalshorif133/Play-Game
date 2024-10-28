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
    <style>
        /* ----------------------- */
        .form-control {
            border: rgba(211, 65, 116, 1) solid 1px;
            border-radius: 10px;
        }

        .form-control:focus {
            border: rgba(211, 65, 116, 1) solid 1px;
            border-radius: 10px;
            box-shadow: none;
        }

        i#togglePassword {
            position: absolute;
            transform: translate(-17px, -26px);
            right: 0;
        }



    </style>
</head>

<div class="wrapper">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-50">
            <div class="col-xl-10 col-md-10">
                <div class="row g-0 justify-content-center">
                    <div class="col-lg-8 col-md-8 mt-5">
                        <h3 class="text-center mx-auto py-2">
                            Welcome to <span class="text-danger">Play</span>
                        </h3>
                        <form method="POST" action="{{ route('public.login') }}">
                            @csrf
                            @method('POST')
                            <!-- Email input -->
                            <div class=" mb-4">
                                <input type="text" id="form3Example3" class="form-control"
                                    placeholder="Mobile or Email address" name="email" />
                            </div>

                            <!-- Password input -->
                            <div class="mb-4 position-relative">
                                <input type="password" id="password" class="form-control position-relative"
                                    name="password" placeholder="Password" />
                                <i style="top:10px;right:10px"
                                    class="fa fa-eye position-absolute hidden-text px-2 cursor-pointer togglePassword"></i>
                            </div>
                            <button type="submit" class="btn btn-primary common-btn w-full py-2 mb-2">
                                Login
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>

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
</body>
