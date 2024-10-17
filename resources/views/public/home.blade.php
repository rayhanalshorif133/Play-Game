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
                    <p>Leaderboad</p>
                </div>
                <div>
                    <p>Tournament Rules</p>
                </div>
            </div>
            @if (count($currentCampaignDurations) > 0)
                <div class="play_btn_container">
                    <div>
                        <a href="{{ route('campaign.campaign-details', $currentCampaignDurations[0]->id) }}" class="play-now-btn">
                            Play now
                        </a>
                    </div>
                </div>
            @endif
        </div>

    </main>
@endsection


{{-- scripts --}}
@push('scripts')
@endpush
