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
            <div class="play_btn_container">
                <div>
                    <a href="#">
                        Subscribe to Play
                    </a>
                </div>
                <div>
                    <a href="#">
                        Play Trial
                    </a>
                </div>
            </div>
        </div>

    </main>
@endsection


{{-- scripts --}}
@push('scripts')
@endpush
