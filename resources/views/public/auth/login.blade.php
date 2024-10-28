<!DOCTYPE html>
<html lang="en">
<!-- coding by Gogila._ -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-Up/Login Form | @Gogila._</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        /* POPPINS FONT */

        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap");

        * {
            margin: 0;

            padding: 0;

            box-sizing: border-box;

            font-family: "Poppins", sans-serif;
        }

        /* ===== COLOR VARIABLES ===== */

        :root {
            --primary-color: #6657f4;

            --second-color: #ffffff;

            --black-color: #000000;
        }

        /* ===== BODY - BACKGROUND IMAGE ===== */

        body {
            background: #9a90f5;
        }

        /* ===== Reusable CSS ===== */

        a {
            text-decoration: none;
            color: var(--second-color);
        }

        a:hover {
            text-decoration: underline;
        }

        /* ===== WRAPPER ===== */

        .wrapper {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: rgba(0, 0, 0, 0.2);
        }

        .login-box {
            position: relative;
            width: 450px;
            border: 3px solid var(--primary-color);
            border-radius: 15px;
            padding: 7.5em 2.5em 4em 2.5em;
            background-color: #ffffff;
            box-shadow: 0px 0px 10px 2px rgba(0, 0, 0, 0.3);
        }

        .login-header {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--primary-color);
            width: 224px;
            height: 70px;
            border-radius: 0 0 20px 20px;
        }

        .login-header span {
            font-size: 30px;
            color: #ffffff;
            font-weight: 700;
        }

        .login-header::before {
            content: "";
            position: absolute;
            top: 0;
            left: -30px;
            width: 30px;
            height: 30px;
            border-top-right-radius: 50%;
            background: transparent;
            box-shadow: 15px 0 0 0 var(--primary-color);
        }

        .login-header::after {
            content: "";
            position: absolute;
            top: 0;
            right: -30px;
            width: 30px;
            height: 30px;
            border-top-left-radius: 50%;
            background: transparent;
            box-shadow: -15px 0 0 0 var(--primary-color);
        }

        .input_box {
            position: relative;
            display: flex;
            flex-direction: column;
            margin: 20px 0;
            transition: 0.2s ease-in-out;
        }

        .icon:hover {
            font-size: 24px;
        }

        .input-field {
            width: 100%;
            height: 55px;
            font-size: 16px;
            background: transparent;
            color: #000000;
            padding-inline: 20px 50px;
            border: 2px solid var(--primary-color);
            border-radius: 30px;
            outline: none;
        }

        #user {
            margin-bottom: 10px;
        }

        .label {
            position: absolute;
            top: 15px;
            left: 20px;
            transition: 0.2s ease-in-out;
        }

        .input-field:focus~.label,
        .input-field:valid~.label {
            position: absolute;
            top: -10px;
            left: 20px;
            font-size: 14px;
            background-color: var(--primary-color);
            border-radius: 30px;
            color: rgb(255, 255, 255);
            padding: 0 10px;
        }

        .icon {
            position: absolute;
            top: 18px;
            right: 25px;
            font-size: 20px;
            cursor: pointer;
        }

        .bx-hide {
            content: "\eb2c";
            /* Hide icon */
        }

        .bx-show {
            content: "\eb25";
            /* Show icon */
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            font-size: 15px;
        }

        .input-submit {
            width: 100%;
            height: 50px;
            background: #6657f4;
            font-size: 16px;
            font-weight: 600;
            letter-spacing: 1px;
            color: #ffffff;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: 0.3s ease-in-out;
        }

        .input-submit:hover {
            background: #1d0db2;
            letter-spacing: 3px;
        }

        .register {
            text-align: center;
        }

        .register a {
            font-weight: 500;
        }

        a {
            color: #6657f4;
        }

        @media only screen and (max-width: 564px) {
            .wrapper {
                padding: 20px;
            }

            .login-box {
                padding: 7.5em 1.5em 4em 2.5em;
            }
        }

        /* For tablets and larger phones */
        @media only screen and (max-width: 1024px) {
            .wrapper {
                padding: 50px;
            }

            .login-box {
                width: 80%;
                /* Adjust width */
                padding: 5em 1.5em 3em 1.5em;
                /* Adjust padding */
            }

            .modal-content {
                width: 70%;
                /* Adjust modal width */
            }
        }

        /* For smaller screens like phones */
        @media only screen and (max-width: 564px) {
            .wrapper {
                padding: 15px;
            }

            .login-box {
                padding: 7.5em 1.5em 4em 2.5em;
            }

            .modal-content {
                width: 90%;
                /* Adjust modal width */
            }

            .remember-forgot {
                font-size: 11px;
                margin: 0 10px;
            }

            /* Hide the default checkbox */
            input[type="checkbox"] {
                width: 11px;
                /* Set width */
                height: 11px;
                /* Set height */
            }
        }

        .error-message {
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .alert-danger {
            color: #ffffff;
            background-color: #ff4d4d;
            border: 1px solid #ff1a1a;
            border-radius: 5px;
            padding: 15px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            max-width: 500px;
            margin: 10px auto;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .alert-danger:hover {
            background-color: #ff1a1a;
            border-color: #ff0000;
        }
    </style>
</head>

<body>
    <div class="wrapper">

        <form class="login-box" method="POST" action="{{ route('public.login') }}">
            @csrf
            @method('POST')
            <div class="login-header">
                <span>Admin Login</span>
            </div>
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="input_box">
                <input type="email" id="user" class="input-field" name="email" required>
                <label for="user" class="label">Email</label>
                <i class="bx bx-user icon"></i>
            </div>
            <div class="input_box">
                <input type="password" name="password" id="pass" class="input-field" required>
                <label for="pass" class="label">Password</label>
                <i class="bx bx-lock-alt icon" id="togglePassword"></i>
            </div>
            <div id="passwordStrength" class="password-strength"></div>

            <div class="input_box">
                <input type="submit" class="input-submit" value="Login" onclick="handleLogin()">
            </div>
        </form>
    </div>



    <script>
        document

            .getElementById("togglePassword")

            .addEventListener("click", function() {
                const passwordField = document.getElementById("pass");

                const type =
                    passwordField.getAttribute("type") === "password" ? "text" : "password";

                passwordField.setAttribute("type", type);

                this.classList.toggle("bx-hide");

                this.classList.toggle("bx-show");
            });
    </script>

</body>

</html>
