@extends('layouts.app_public', ['title' => 'Leaderboard'])

@section('styles')
    <style type="text/css">

    </style>
@endsection

@section('content')
    <div class="leaderboard_show">
        <div class="daily_score">
            <h1 class="text-lg font-bold text-center">Daily Score</h1>
        </div>
        <table>
            <thead>
                <tr>
                    <th><i class="fa-solid fa-ranking-star fa-fw"></i> <br> Rank</th>
                    <th><i class="fa-solid fa-circle-user fa-fw"></i> <br> Phone Number</th>
                    <th><i class="fa-solid fa-clipboard-check fa-fw"></i> <br/> Score</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>8801712345678</td>
                    <td>100</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>8801712345678</td>
                    <td>90</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>8801712345678</td>
                    <td>80</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>8801712345678</td>
                    <td>70</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>8801712345678</td>
                    <td>60</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection


{{-- scripts --}}
@push('scripts')
@endpush
