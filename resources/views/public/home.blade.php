@extends('layouts.app_public', ['title' => 'Home'])

@section('styles')
@endsection

@section('content')
    <main role="main">

        <div class="home_container">
            @if ($user)
                <a href="{{ route('player-profile') }}" class="profile_container">
                    <i class="fa-solid fa-user"></i>
                </a>
            @endif
            <div class="game_title mt-5">
                {{ $game->title }}
            </div>
            <div class="logo">
                <img src="{{ asset($game->banner) }}">
            </div>
            <div class="label_container">
                <div>
                    <img src="{{ asset('images/playing_hands.png') }}">
                    <p>{{ $subscription }}</p>
                </div>
                <div>
                    <img src="{{ asset('images/clock.png') }}">

                    @if ($campaign)
                        @if ($campaign->type == 'expired')
                            <p>Expired</p>
                        @elseif($campaign->type == 'upcoming')
                            <p>Start in
                                <span class="time">
                                    {{ $campaign->duration }}
                                </span>
                            </p>
                        @else
                            <p>Expired in
                                <span class="time">
                                    {{ $campaign->duration }}
                                </span>
                            </p>
                        @endif
                    @else
                        <p>Upcoming</p>
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
            @if ($campaign)
                @php
                    $game_url = $game->URL($game);
                @endphp
                <div class="play_btn_container mb-4">
                    @if ($user)
                        <div class="btn_primary">
                            <a class="btn" href="{{ route('campaign.campaign-details', $campaign->id) }}">
                                Play now
                            </a>
                        </div>
                    @else
                        <div class="btn_primary" id="play_now_login">
                            <a class="btn">Play Now</a>
                        </div>
                    @endif
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
        @include('public.reg_login_modals')
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

        const highlight = $(".leaderboard .active").html();
        const position = $(".leaderboard .active").data('position');

        if (position > 7) {
            $(".leaderboard .highlight").html(highlight);
            $(".leaderboard .highlight").removeClass("d-none");
            $(".leaderboard .highlight").addClass("active");
        } else {
            $(".leaderboard .highlight").addClass("d-none");
        }
    </script>
@endpush
