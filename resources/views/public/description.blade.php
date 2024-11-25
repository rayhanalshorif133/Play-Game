@extends('layouts.app_public', ['title' => 'Home'])

@section('styles')
@endsection

@section('content')
    <main role="main">
        <div class="home_container p-5">
            <a href="{{ route('home') }}" class="back_container">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div class="game_title mt-5">
                {{ $game->title }}
            </div>
            <div class="logo">
                <img class="bg" src="{{ asset($game->banner) }}">
                <img class="main_snake" src="{{ asset('images/main_snake.png') }}">
            </div>
            <div class="play_btn_container">
                <div class="btn_primary">
                    <button class="btn" id="button_play">
                        Subscribe to Play
                    </button>
                </div>
                <div class="btn_secondary">
                    @php
                        $game = $campaign->gameURL($msisdn);
                    @endphp
                    <a href="{{ $game }}">
                        Play Trial
                    </a>
                </div>
            </div>
        </div>
        @include('public.reg_login_modals')
    </main>
@endsection


{{-- scripts --}}
@push('scripts')
    <script>
        $("#button_play").click(() => {
            $("#button_play").text('Please Wait ...');
            axios.get('/api/payment-create')
                .then(function(response) {
                    const URL = response.data.data;
                    window.location.href = URL;
                });
        });




        $(document).ready(function() {
            $(".paymentSuccessAlertCancel").click(() => {
                $(".paymentSuccessAlert").addClass('d-none');
            });
        });
    </script>
@endpush
