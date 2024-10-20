@extends('layouts.app_public', ['title' => 'Home'])

@section('styles')
@endsection

@section('content')
    <main role="main">
        <a href="{{ route('home') }}" class="back_button">
            <i class="fa-solid fa-circle-arrow-left"></i>
        </a>
        <div class="home_container">
            <div class="game_title">
                <img src="{{ asset('images/game_title.png') }}">
            </div>
            <div class="logo">
                <img src="{{ asset('images/snake_avater.png') }}">
            </div>
            <div class="play_btn_container">
                <div class="btn_primary">
                    <button class="btn" id="robi_button_play">
                        Subscribe to Play
                    </button>
                </div>
                <div class="btn_secondary">
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
<script>
    var msisdn = $("#GET_MSISDN").val();
    var inv_no = Math.floor((Math.random() * 100000) + 1);

    $("#robi_button_play").click(() => {
        axios.post('/api/payment-create')
            .then((response) => {
                const {redirectURL} = response.data.data;
                window.location.href = redirectURL;
            });
    });

    $(document).ready(function() {
        $(".paymentSuccessAlertCancel").click(() => {
            $(".paymentSuccessAlert").addClass('d-none');
        });
    });
</script>
@endpush
