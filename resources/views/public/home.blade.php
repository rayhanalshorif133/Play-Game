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
                <img class="bg" src="{{ asset($game->banner) }}">
                <img class="main_snake" src="{{ asset('images/main_snake.png') }}">
            </div>
            <div class="label_container">
                <div>
                    <img src="{{ asset('images/playing_hands.png') }}">
                    <p>{{ $totalUser }}</p>
                </div>
                <div>
                    <img src="{{ asset('images/clock.png') }}">

                    @if ($campaign)
                        <p>Expires in
                            <span class="time">
                                {{ $campaign->duration }}
                            </span>
                        </p>
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

                <div class="play_btn_container mb-4">
                    @if ($user)
                        @php
                            $game_url = $game->URL($game, $user->msisdn);
                        @endphp
                        @if ($hasAlreadySubs)
                            {{-- cng --}}
                            <div class="btn_primary">
                                <a class="btn" href="{{ $game_url }}">
                                    Play now
                                </a>
                            </div>
                        @else
                            <div class="btn_primary">
                                <a class="btn" href="{{ route('campaign.campaign-details', $campaign->id) }}">
                                    Play now
                                </a>
                            </div>
                        @endif
                    @else
                        <div class="btn_primary" id="play_now_login">
                            <a class="btn">Play Now</a>
                        </div>
                    @endif
                </div>
                <div>
                    <p class="entry_fee">Daily Entry Fee 10 tk + SC</p>
                </div>
                <div class="price_btn_container">
                    <button type="button" class="btn">Prize</button>
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


        var priceShowModal = new bootstrap.Modal(document.getElementById('priceShowModal'), {
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

        $(".price_btn_container").click(() => {
            priceShowModal.show();
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


        $(".reg-tab").click(function() {
            $(".nav_container div button").removeClass('active');
            $(".login_container").addClass('d-none');
            $(".reg_container").removeClass('d-none');
            $(this).find('button').addClass('active');
        });





        $(".daily").click(function() {
            $(".daily_container").removeClass('d-none');
            $(".weekly_container").addClass('d-none');
            $(this).find('button').addClass('active');
            $('.weekly').find('button').removeClass('active');
        });
        $(".weekly").click(function() {
            $(".daily_container").addClass('d-none');
            $(".weekly_container").removeClass('d-none');
            $(this).find('button').addClass('active');
            $('.daily').find('button').removeClass('active');
        });

        $(document).ready(function() {
            $('.togglePassword').click(function() {
                const eyeIcon = $(this).find('i');
                const type = $(this).parent().find('input').attr('type') === 'password' ? 'text' : 'password';
                $(this).parent().find('input').attr('type', type);
                eyeIcon.toggleClass('bi-eye').toggleClass('bi-eye-slash');
            });
        });
    </script>
@endpush
