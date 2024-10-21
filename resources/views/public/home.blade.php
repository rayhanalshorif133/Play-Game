@extends('layouts.app_public', ['title' => 'Home'])

@section('styles')
@endsection

@section('content')
    <main role="main">

        <div class="home_container">
            <div class="game_title">
                <img src="{{ asset('images/game_title.png') }}">
            </div>
            <div class="logo">
                <img src="{{ asset('images/snake_avater.png') }}">
            </div>
            <div class="label_container">
                <div>
                    <img src="{{ asset('images/playing_hands.png') }}">
                    <p>3,900,900</p>
                </div>
                <div>
                    <img src="{{ asset('images/clock.png') }}">
                    <p>2d1h23m</p>
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
            @if (count($currentCampaignDurations) > 0)
                <div class="play_btn_container">
                    <div class="btn_primary">
                        @if ($hasAlreadySubs)
                            @php
                                $game = $currentCampaignDurations[0]->gameURL($currentCampaignDurations[0]);
                            @endphp
                            <a class="btn" href="{{ $game }}">
                                Play now

                            </a>
                        @else
                            <a class="btn"
                                href="{{ route('campaign.campaign-details', $currentCampaignDurations[0]->id) }}">
                                Play now
                            </a>
                        @endif
                    </div>
                </div>
            @endif



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
                    const {
                        redirectURL
                    } = response.data.data;
                    window.location.href = redirectURL;
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
