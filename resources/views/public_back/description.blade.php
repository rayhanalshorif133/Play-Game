@extends('layouts.app_public')

@section('content')
    @if (Session::has('status'))
        <div class="container paymentSuccessAlert">
            <div class="alert d-flex justify-content-between alert-success fade show" role="alert">
                <div class="mt-2">
                    <strong>Payment Success!</strong> {{ Session::get('message') }}
                </div>
                <div class="paymentSuccessAlertCancel">
                    <button class="btn">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <div class="mx-auto text-center container description">
        <img src="{{ asset($campaignDuration->game->banner) }}" alt="" class="my-4 logo" />
        <div>
            <button class="btn play" id="robi_button_play">
                Play
            </button>
            <button class="btn trial" id="button_trial">
                Play Trial
            </button>
        </div>
        <div class="py-4">
            @if ($hasAlreadyPayment == true)
                <a href="{{ route('public.leaderboard', $campaignDuration->id) }}" class="btn btn-primary  leaderbord mx-2">
                    <img src="{{ '/web_assets/images/leaderboard.png' }}" alt="leaderboard" class="icon">
                    Leaderboard
                </a>
            @endif
            <a href="leaderboard.html" class="btn btn-primary  leaderbord mx-2" data-toggle="modal"
                data-target="#rulesModal">
                <img src="{{ '/web_assets/images/list.png' }}" alt="rules" class="icon">
                Rules
            </a>
        </div>
        <img src="{{ $campaignDuration->game->banner }}" alt="thumbnail" class="banner my-2" />
    </div>
    <div class="modal fade" id="rulesModal" tabindex="-1" role="dialog" aria-labelledby="rulesModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header modal_header_rules">
                    <h5 class="modal-title text-white" id="rulesModalTitle">Play rules</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ol class="list-group list-group-light list-group-numbered">
                        <li class="list-group-item">You'll be charged To {{$campaignDuration->amount}} (+vat/SD) and participart this campaign.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="https://scripts.pay.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

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
