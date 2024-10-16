@extends('layouts.app_public', ['title' => 'Home'])

@section('styles')
@endsection

@section('content')
    <main role="main">

        <div class="home_container">
            <div class="game_title">
                <h1>Snake Game</h1>
            </div>
            <div class="logo">
                <img src="https://picsum.photos/200/200">
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
            <div class="play_btn_container">
                <div>
                    <a href="#" class="play-now-btn">Play now</a>
                </div>
            </div>
        </div>

    </main>
@endsection


{{-- scripts --}}
@push('scripts')
@endpush
