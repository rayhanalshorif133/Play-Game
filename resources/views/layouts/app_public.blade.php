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
    @stack('scripts')
    <script>
        var insertUserModal = new bootstrap.Modal(document.getElementById('insertUserModal'), {
            keyboard: false
        });



        $("#play_now_login").click(function() {
            insertUserModal.show();
        });

        $("#loginBtn").click(function() {

            $('#reg_user_name').val('');
            $('#reg_user_msisdn').val('');
            $('#reg_user_password').val('');
            $(".reg_error_msg").text('');

            const msisdn = $('#login_user_msisdn').val();
            const password = $('#login_user_password').val();
            $(".login_error_msg").text('');

            if (!msisdn) {
                $(".login_error_msg").text('Phone number is required');
                isValid = false;
            } else {
                const isValid = validateBDPhoneNumber(msisdn);
                if (isValid == false) {
                    $(".login_error_msg").text('Enter a valid phone number');
                }
            }

            if (!password) {
                $(".login_error_msg").text('Password is required');
            }

            const data = {
                msisdn,
                password
            };
            axios.post('/api/login', data)
                .then((response) => {
                    console.log(response.data);
                    const {
                        status,
                        message
                    } = response.data;
                    if (status == false) {
                        $(".login_error_msg").text(message);
                    } else {
                        $(".success_msg_container").removeClass('d-none');
                        $(".success_msg").text(message);
                        setTimeout(() => {
                            window.location.reload();
                        }, 500);
                    }
                    return false;
                })


        });
        $("#registerBtn").click(function() {

            $('#login_user_msisdn').val('');
            $('#login_user_password').val('');
            $(".login_error_msg").text('');

            const name = $('#reg_user_name').val();
            const msisdn = $('#reg_user_msisdn').val();
            const password = $('#reg_user_password').val();


            $(".reg_error_msg").text('');

            // Validate name
            if (!name) {
                $(".reg_error_msg").text('Name is required');
            }

            if (!msisdn) {
                $(".reg_error_msg").text('Phone number is required');
                isValid = false;
            } else {
                const isValid = validateBDPhoneNumber(msisdn);
                if (isValid == false) {
                    $(".reg_error_msg").text('Enter a valid phone number');
                }
            }

            if (!password) {
                $(".reg_error_msg").text('Password is required');
            } else if (password.length < 4) {
                $(".reg_error_msg").text('Password must be at least 4 characters long');
            }


            const data = {
                name,
                msisdn,
                password
            };
            axios.post('/api/register', data)
                .then((response) => {
                    console.log(response);
                    const {
                        status,
                        message
                    } = response.data;
                    if (status == false) {
                        $(".reg_error_msg").text(message);
                    } else {
                        $(".success_msg_container").removeClass('d-none');
                        $(".success_msg").text(message);
                        $("#login-tab").click();
                    }
                    return false;
                })
        });

        function validateBDPhoneNumber(phoneNumber) {
            const bdPhoneNumberPattern = /^(?:\+8801|8801|01)[3-9]\d{8}$/;
            return bdPhoneNumberPattern.test(phoneNumber);
        }



        $("#login-tab").click(function() {
            $(".nav_container div button").removeClass('active');
            $(".reg_container").addClass('d-none');
            $(".login_container").removeClass('d-none');
            $(this).find('button').addClass('active');
        });

        $("#reg-tab").click(function() {
            $(".nav_container div button").removeClass('active');
            $(".login_container").addClass('d-none');
            $(".reg_container").removeClass('d-none');
            $(this).find('button').addClass('active');
        });


        $(".forgot_passBtn").click(function() {
            $(".forgot_pass_error_msg").text('');
            $(".auth_continer").addClass('d-none');
            $(".forgot_pass_container").removeClass('d-none');
        });

        $(".btn_forgot_cancel").click(function() {
            $(".auth_continer").removeClass('d-none');
            $(".forgot_pass_container").addClass('d-none');
        });

        $("#forGot_pass_submitBtn").click(function() {
            const msisdn = $("#forgot_pass_user_msisdn").val();
            const pass = $("#forgot_pass_user_pass").val();
            axios.put('api/forgot-password', {
                    msisdn,
                    pass
                })
                .then(function(response) {
                    const status = response.data.status;
                    const message = response.data.message;
                    if (status == false) {
                        $(".forgot_pass_error_msg").addClass('error_msg');
                        $(".forgot_pass_error_msg").removeClass('success_msg');
                    } else {
                        $(".forgot_pass_error_msg").removeClass('error_msg');
                        $(".forgot_pass_error_msg").addClass('success_msg');
                        $(".success_msg_container").addClass('d-none');
                        setTimeout(() => {
                            $(".btn_forgot_cancel").click();
                        }, 2000);
                    }
                    $(".forgot_pass_error_msg").text(message);
                });
        });
    </script>
</body>

</html>
