@extends('layouts.app_public')

@section('styles')
@endsection

@section('content')
    <main role="main">
        <section id="section_one">
                <form id="login_form" method="POST" action="{{route('public.login')}}">
                    @csrf
                    @method('POST')
                    <h3>Welcome to Play!</h3>
                    <p class="mb-4 text-center">Please sign-in to your account</p>

                    <label for="username" class="required">Email or Phone Number</label>
                    <input type="text" placeholder="Email or Phone" id="username" name="email_phone">

                    <label for="password" class="required">Password</label>
                    <input type="password" placeholder="Password" id="password" name="password">

                    <button class="btn btn-primary  common-btn" style="margin-bottom: 2%;" type="submit">Log In</button>

                    <p class="text-center">New to Play? <a href="{{route('public.register')}}">Create an account</a></p>
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
