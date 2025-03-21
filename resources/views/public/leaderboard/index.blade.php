@extends('layouts.app_public', ['title' => 'Leaderboard'])

@section('styles')
    <style type="text/css">
        .card-img {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            height: 200px;
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="item_menu">
        <h1 class="title fw-bold">Leaderboard</h1>
        <div class="row item_container">
            <div class="col-md-4 col-sm-6 col-12">
                <img src="https://picsum.photos/200/300" class="card-img" alt="...">
                <a href="{{route('public.leaderboard',1)}}" class="goto">
                    Leaderboard <i class="fa-solid fa-arrow-right px-2"></i>
                </a>
            </div>
            <div class="col-md-4 col-sm-6 col-12">
                <img src="https://picsum.photos/200/300" class="card-img" alt="...">
                <a href="{{route('public.leaderboard',2)}}" class="goto">
                    Leaderboard <i class="fa-solid fa-arrow-right px-2"></i>
                </a>
            </div>
        </div>
    </div>
@endsection


{{-- scripts --}}
@push('scripts')
@endpush
