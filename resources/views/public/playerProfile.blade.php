@extends('layouts.app_public', ['title' => 'Home'])

@section('styles')
@endsection

@section('content')
    <main role="main">

        <div class="home_container">
            <a href="{{ route('home') }}" class="back_container">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div class="player_profile mt-5">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="logo">
                banner
            </div>
            <div class="leaderBoard_tournament_container">
                <div>
                    <p class="leaderboad_btn">Leaderboad</p>
                </div>
                <div>
                    <p class="tournament_rules_btn">Tournament Rules</p>
                </div>
            </div>

        </div>


    </main>
@endsection


{{-- scripts --}}
@push('scripts')

@endpush
