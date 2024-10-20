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
                    <div class="btn_primary">
                        <a class="btn" href="{{ route('campaign.campaign-details', $currentCampaignDurations[0]->id) }}">
                            Play now
                        </a>
                    </div>
                </div>
            @endif
        </div>
        {{-- model --}}
        <div class="modal fade" id="paymentSuccessModal" tabindex="-1" aria-labelledby="paymentSuccessModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content payment_model">
                    <div class="status"><i class="fa-solid fa-circle-check"></i></div>
                    <div class="content">
                        <div class="modal-body d-flex justify-content-center" style="margin-top: 3.2rem">
                            <img src="{{ asset('images/payment_success.png') }}" style="width:13rem; height:auto" />
                        </div>
                        <div class="mx-auto w-full d-flex justify-content-center" style="margin-top: 2.8rem">
                            <div class="btn_secondary" style="width: 7rem!important">
                                <button data-bs-dismiss="modal" class="btn payment_close_btn">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="paymentFailedModal" tabindex="-1" aria-labelledby="paymentFailedModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content payment_model">
                    <div class="status"><i class="fa-solid fa-circle-exclamation"></i></div>
                    <div class="content">
                        <div class="modal-body d-flex flex-column justify-content-center ooops_container" style="margin-top: 3.2rem">
                            <h1>Ooops!</h1>
                            <p>Payment failed</p>
                        </div>
                        <div class="mx-auto w-full d-flex justify-content-center" style="margin-top: 2.8rem">
                            <div class="btn_secondary" style="width: 7rem!important">
                                <button data-bs-dismiss="modal" class="btn payment_try_again_btn">Try Again</button>
                            </div>
                            <div class="btn_secondary mx-2" style="width: 7rem!important">
                                <button data-bs-dismiss="modal" class="btn payment_close_btn">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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


        let url = window.location.href;
        if (url.includes("?status=success")) {
            paymentSuccessModal.show();
        }

        if(url.includes("?status=failure")) {
            paymentFailedModal.show();
        }


        $(".payment_try_again_btn").click(() => {
            axios.post('/api/payment-create')
            .then((response) => {
                const {redirectURL} = response.data.data;
                window.location.href = redirectURL;
            });
        });
    </script>
@endpush
