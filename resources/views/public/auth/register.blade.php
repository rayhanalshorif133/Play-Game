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
                                <form method="POST" action="{{ route('public.register') }}">
                                    @csrf
                                    @method('POST')
                                    <!-- Email input -->
                                    <div class="mb-4">
                                        <input type="text" class="form-control" placeholder="Name" id="name"
                                            name="name">
                                    </div>

                                    {{-- phone --}}
                                    <div class="mb-4">
                                        <input type="text" class="form-control" placeholder="Phone Number" id="phone"
                                            name="phone">
                                    </div>

                                    {{-- email --}}
                                    <div class="mb-4">
                                        <input type="email" id="email" class="form-control" name="email"
                                            placeholder="Email" />
                                    </div>

                                    {{-- password --}}
                                    <div class="mb-4">
                                        <input type="password" id="password" class="form-control" name="password"
                                            placeholder="Password" />
                                        <i class="fa fa-eye hidden-text px-2 cursor-pointer togglePassword"></i>
                                    </div>

                                    {{-- confirm password --}}
                                    <div class="mb-4">
                                        <input type="password" id="confirm_password" class="form-control"
                                            name="confirm_password" placeholder="Confirm Password" />
                                        <i class="fa fa-eye hidden-text px-2 cursor-pointer togglePassword"></i>
                                    </div>
                                    <button type="submit" class="btn btn-primary common-btn w-full py-2 mb-2">
                                        Register
                                    </button>

                                    <div class="d-flex align-items-center justify-content-center pb-4">
                                        <p class="mb-0 me-2" style="margin-right: 2%;">Already have an account?</p>
                                        <a href="{{ route('public.login') }}" class="text-primary">Sign in</a>
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
