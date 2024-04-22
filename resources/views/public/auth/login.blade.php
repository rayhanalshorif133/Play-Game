@extends('layouts.app_public')

@section('styles')
    <style media="screen">
        *,
        *:before,
        *:after {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }


       

        form {
            height: auto;
            width: 400px;
            background-color: #ffffff;
            position: absolute;
            transform: translate(-50%, -50%);
            top: 50%;
            left: 50%;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
            padding: 40px 35px;
        }

        .bodyDark form {
            background-color: #000000;
            border: 2px solid #6060601a;
            box-shadow: 0 0 40px #6060601a;
        }

        .bodyDark .login_form p{
            color: #ffffff;
        }

        .bodyDark input,
        .bodyDark label,
        .bodyDark form *{
            color: #ffffff;
        }

        .bodyDark input::placeholder{
            color: #e4e4e4;
        }

        form * {
            font-family: 'Poppins', sans-serif;
            color: #000000;
            letter-spacing: 0.5px;
            outline: none;
            border: none;
        }

        form h3 {
            font-size: 32px;
            font-weight: 500;
            line-height: 42px;
            text-align: center;
        }

        label {
            display: block;
            margin-top: 30px;
            font-size: 16px;
            font-weight: 500;
        }

        input {
            display: block;
            height: 50px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.07);
            border-radius: 5px;
            padding: 0 10px;
            margin-top: 8px;
            font-size: 14px;
            font-weight: 300;
            border: 1px solid #9a9a9a;
        }

        ::placeholder {
            color: #000000;
        }

        button {
            margin-top: 50px;
            width: 100%;
            background-color: #000000;
            color: #ffffff;
            padding: 15px 0;
            font-size: 18px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
        }

        .social {
            margin-top: 30px;
            display: flex;
        }

        .social div {
            background: red;
            width: 150px;
            border-radius: 5px;
            padding: 5px 10px 10px 5px;
            background-color: #ffffff45;
            color: #000000;
            text-align: center;
            border: 1px solid #acacac;
            cursor: pointer;
        }

        .social div:hover {
            background-color: #c9c9c945;
        }

        .social .fb {
            margin-left: 25px;
        }

        .social i {
            margin-right: 4px;
        }

        .bodyDark .social div{
            background-color: #00000045;
            color: #ffffff;
            border: 1px solid #606060;
        }
    </style>
@endsection

@section('content')
    <main role="main">
        <section id="section_one">
                <form class="login_form">
                    <h3>Welcome to Play!</h3>
                    <p class="mb-4 text-center">Please sign-in to your account</p>

                    <label for="username">Email or Phone Number</label>
                    <input type="text" placeholder="Email or Phone" id="username">

                    <label for="password">Password</label>
                    <input type="password" placeholder="Password" id="password">

                    <button class="btn btn-primary  common-btn" style="margin-bottom: 2%;">Log In</button>
                    <div class="social d-none">
                        <div class="go"><i class="fab fa-google"></i> Google</div>
                        <div class="fb"><i class="fab fa-facebook"></i> Facebook</div>
                    </div>
                </form>
        </section>
    </main>
@endsection


{{-- scripts --}}
@push('scripts')
@endpush
