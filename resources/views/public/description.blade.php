@extends('layouts.app_public', ['title' => 'Home'])

@section('styles')
@endsection

@section('content')
    <main role="main">
        <a href="{{ route('home') }}" class="back_button">
            <i class="fa-solid fa-circle-arrow-left"></i>
        </a>
        <div class="home_container">
            <div class="game_title">
                <img src="{{ asset('images/game_title.png') }}">
            </div>
            <div class="logo">
                <img src="{{ asset('images/snake_avater.png') }}">
            </div>
            <div class="play_btn_container">
                <div class="btn_primary">
                    <button class="btn" id="button_play">
                        Subscribe to Play
                    </button>
                </div>
                <div class="btn_secondary">
                    @php
                        $game = $campaignDuration->gameURL($campaignDuration) . $msisdn;
                    @endphp
                    <a href="{{ $game }}">
                        Play Trial
                    </a>
                </div>
            </div>
        </div>

    </main>

@endsection


{{-- scripts --}}
@push('scripts')
    <script>
        $("#button_play").click(() => {
            $("#button_play").text('Please Wait ...');
            axios.get('/api/payment-create')
                .then(function (response) {
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
