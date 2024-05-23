@extends('layouts.app_public')

@section('styles')
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

        .social {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .social button {
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            margin: 10px 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .social button:nth-child(1) {
            background-color: #2374F2;
        }

        .social button:nth-last-child(1) {
            background-color: #DB4437;
        }

        .social button span:nth-child(1) {
            height: 20px;
            width: 20px;
            padding: 15px;
            border-radius: 50%;
            background: #fefefe;
            display: block;
        }

        .social button i {
            margin-right: 10px;
        }





        .social-login-btn {
            display: inline-flex;
            align-items: center;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .fb-login-btn {
            background-color: #4267B2;
        }

        .fb-login-btn:hover {
            background-color: #385898;
        }

        .google-login-btn {
            background-color: #DB4437;
        }

        .google-login-btn:hover {
            background-color: #C13505;
        }



        .social a {
            margin-top: 20px;
        }



        .social div {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 30px;
            width: 30px;
            border-radius: 50%;
            background: #ffffff;
            margin-right: 10px;
        }

        .social div img {
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .social-login-btn{
            transition: font-size 0.5s ease;
        }

        .social-login-btn:hover{
            color: #fff;
            font-size: 18px;
        }
    </style>
@endsection

@section('content')
    <div class="discription-wrapper">
        <section class="h-100 gradient-form" style="background-color: #fff;">
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
                                            placeholder="Mobile or Email address" name="email_phone"/>
                                    </div>

                                    <!-- Password input -->
                                    <div class="mb-4 position-relative">
                                        <input type="password" id="password" class="form-control position-relative" name="password" placeholder="Password" />
                                        <i style="top:10px;right:10px" class="fa fa-eye position-absolute hidden-text px-2 cursor-pointer togglePassword"></i>
                                    </div>
                                    <button type="submit" class="btn btn-primary common-btn w-full py-2 mb-2">
                                        Login
                                    </button>

                                    <div class="d-flex align-items-center justify-content-center pb-4">
                                        <p class="mb-0 me-2" style="margin-right: 2%;">Don't have an account?</p>
                                        <a href="{{ route('public.register') }}" class="text-primary">Sign up</a>
                                    </div>




                                    <!-- Register buttons -->
                                    <div class="text-center social">
                                        <p>or sign up with:</p>
                                        {{-- <a href="{{ route('auth.facebook') }}" class="social-login-btn fb-login-btn">
                                            <div><img class="social-icon"
                                                    src="{{ asset('web_assets/images/Facebook.png') }}" alt="Google Icon">
                                            </div>
                                            Login with Facebook
                                        </a> --}}
                                        <a href="{{ route('auth.google') }}" class="social-login-btn google-login-btn">
                                            <div>
                                                <img class="social-icon" src="{{ asset('web_assets/images/Google.png') }}"
                                                    alt="Google Icon">
                                            </div>
                                            Login with Google
                                        </a>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection


{{-- scripts --}}
@push('scripts')
@endpush
