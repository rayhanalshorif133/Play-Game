@extends('layouts.app_public')

@section('styles')
@endsection

@section('content')
    <main role="main">
        <section id="section_one">
                <form id="login_form">
                    <h3>Welcome to Play!</h3>
                    <p class="mb-4 text-center">Please sign-in to your account</p>
                    {{-- name --}}
                    <label for="name" class="required">Name</label>
                    <input type="text" placeholder="Name" id="name">

                    {{-- phone number --}}
                    <label for="phone" class="required">Phone Number</label>
                    <input type="text" placeholder="Phone Number" id="phone">

                    {{-- email --}}
                    <label for="email" class="optional">Email</label>
                    <input type="email" placeholder="Email" id="email">

                    
                    {{-- password --}}
                    <label for="password" class="required">Password</label>
                    <input type="password" placeholder="Password" id="password">

                    {{-- confirm password --}}
                    <label for="confirm_password" class="required">Confirm Password</label>
                    <input type="password" placeholder="Confirm Password" id="confirm_password">
                    <button class="btn btn-primary  common-btn" style="margin-bottom: 2%;">
                        Register
                    </button>

                    {{-- for new user --}}
                    <p class="text-center">Aleady have an account? <a href="{{route('public.login')}}"> Sign in</a></p>
                    {{-- <p class="text-center">Forgot password? <a href="{{route('public.forgot_password')}}">Reset password</a></p> --}}

                    {{-- for forgot password --}}
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
