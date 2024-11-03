@extends('layouts.app_public', ['title' => 'Home'])

@section('styles')
@endsection

@section('content')
    <main role="main">

        <div class="home_container">
            <div class="game_title mt-5">
                {{ $game->title }}
            </div>
            <div class="logo">
                <img src="{{ asset($game->banner) }}">
            </div>
            <div class="label_container">
                <div>
                    <img src="{{ asset('images/playing_hands.png') }}">
                    <p>3,900,900</p>
                </div>
                <div>
                    <img src="{{ asset('images/clock.png') }}">

                    @if($campaignDuration->type == 'expired')
                    <p>Expired</p>
                    @elseif($campaignDuration->type == 'upcoming')
                    <p>Start in
                        <span class="time">
                            {{ $campaignDuration->duration }}
                        </span>
                    </p>
                    @else
                    <p>Expired in
                        <span class="time">
                            {{ $campaignDuration->duration }}
                        </span>
                    </p>
                    @endif

                </div>
            </div>
            <div class="leaderBoard_tournament_container">
                <div>
                    <p class="leaderboad_btn">Leaderboad</p>
                </div>
                <div>
                    <p class="tournament_rules_btn">Tournament Rules</p>
                </div>
            </div>
            @if ($campaignDuration)
                @php
                    $game_url = $game->URL($game);
                @endphp
                <div class="play_btn_container mb-4">
                    <div class="btn_primary">
                        @if ($hasAlreadySubs)
                            <a class="btn" href="{{ $game_url }}">
                                Play now
                            </a>
                        @else
                            <a class="btn"
                                href="{{ route('campaign.campaign-details', $campaignDuration->id) }}">
                                Play now
                            </a>
                        @endif
                    </div>
                </div>
            @endif


            <footer class="mt-4">
                <div class="lottie_banner">
                    <lottie-player class="lottie-player" src="{{ asset('images/banner.json') }}" background="transparent"
                        speed="1" loop autoplay>
                    </lottie-player>
                </div>
            </footer>

        </div>

        @include('public.modals')
    </main>
@endsection


{{-- scripts --}}
@push('scripts')
    <script>
        var paymentSuccessModal = new bootstrap.Modal(document.getElementById('paymentSuccessModal'), {
            keyboard: false
        });

        var paymentFailedModal = new bootstrap.Modal(document.getElementById('paymentFailedModal'), {
            keyboard: false
        });

        var leaderboadModal = new bootstrap.Modal(document.getElementById('leaderboadModal'), {
            keyboard: false
        });


        var tournamentRulesModal = new bootstrap.Modal(document.getElementById('tournamentRulesModal'), {
            keyboard: false
        });


        let url = window.location.href;
        if (url.includes("?status=success")) {
            paymentSuccessModal.show();
        }

        if (url.includes("?status=failure")) {
            paymentFailedModal.show();
        }


        $(".payment_try_again_btn").click(() => {
            axios.post('/api/payment-create')
                .then((response) => {
                    const url = response.data.data;
                    window.location.href = url;
                });
        });

        $(".leaderboad_btn").click(() => {
            leaderboadModal.show();
        });

        $(".tournament_rules_btn").click(() => {
            tournamentRulesModal.show();
        });
    </script>
@endpush
