@extends('layouts.app_public', ['title' => 'Home'])

@section('styles')
    <style>
        .login-warning {
            display: inline-block;
            background-color: #5D2E90;
            color: #ffffff;
            padding: 10px 15px;
            border-radius: 5px;

            font-size: 16px;
            font-weight: bold;
            margin-top: 3rem;
            border: 1px solid #f5c6cb;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .login-warning:hover {
            background-color: #f5c6cb;
            cursor: pointer;
        }

        .card_padding {
            padding: 2.5rem 5rem;
        }

        .card_padding_without_login {
            padding: 5.5rem 7rem;
        }
    </style>
@endsection

@section('content')
    <main role="main">

        <div class="home_container @if ($user) card_padding @else card_padding_without_login @endif">
            <a href="{{ route('home') }}" class="back_container">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div class="player_profile mt-5">
                <i class="fa-solid fa-user"></i>
            </div>
            @if (session('success'))
                <div class="alert alert-primary">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif
            @if ($user)
                <form action="{{ route('player-profile') }}" method="POST" class="user_info_edit">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="user_id" value="{{ $user->id }}" />
                    <label class="my-1">Name</label>
                    <input type="text" class="form-control" name="name" id="update_user_name"
                        value="{{ $user->name }}" />
                    <label class="my-1">Phone Number</label>
                    <input type="text" readonly disabled class="form-control" id="update_user_msisdn"
                        value="{{ $user->msisdn }}" />
                    <label class="my-1">Password</label>
                    <input type="password" class="form-control" name="password" id="update_user_password" />
                    <span class="update_error_msg error_msg"></span>
                    <div class="my-3 w-full" id="registerBtn">
                        <button class="btn btn-sm btn-reg w-full" type="submit">Update</button>
                    </div>
                </form>
            @else
                <div>
                    <label class="login-warning">You are not logged in</label>
                </div>
            @endif

        </div>


    </main>
@endsection


{{-- scripts --}}
@push('scripts')
@endpush
