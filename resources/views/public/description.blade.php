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
            @if ($campaignDuration->start_date_time < $currentDate)
                @if (Auth::check())
                    <input id="GET_MSISDN" class="d-none" value="{{ Auth::user()->msisdn }}" />
                    <input id="GET_CampaignDurationID" class="d-none" value="{{ $campaignDuration->id }}" />

                    @if ($hasAlreadyPayment == false)
                        <button class="btn btn-primary common-btn play_btn" id="bKash_button">
                            Play
                        </button>
                    @else
                        <a href="{{ $campaignDuration->gameURL($campaignDuration->game_id) }}"
                            class="btn btn-primary common-btn play_btn">
                            Play Now
                        </a>
                    @endif
                @else
                    <a href="{{ route('campaign.access', $campaignDuration->id) }}"
                        class="btn btn-primary common-btn play_btn">
                        Play
                    </a>
                @endif
            @endif
            {{-- <a href="{{$campaignDuration->gameURL($campaignDuration->game_id)}}" class="btn btn-primary common-btn play_btn">
                Free To Play
            </a> --}}
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
                        <li class="list-group-item">1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus
                            euismod lacus et libero pellentesque, ut elementum quam auctor.</li>
                        <li class="list-group-item">2. Maecenas purus augue, rutrum sit amet mi molestie, posuere suscipit
                            orci. Aenean tempor euismod orci, dapibus dignissim ex consequat in.</li>
                        <li class="list-group-item">3. Duis pellentesque tellus a metus tempor, nec pulvinar libero
                            vestibulum. In ac facilisis quam.</li>
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

    <script>
        var msisdn = $("#GET_MSISDN").val();
        var inv_no = Math.floor((Math.random() * 100000) + 1);
        var paymentID = '';
        var campaignDurationID = $("#GET_CampaignDurationID").val();
        bKash.init({
            paymentMode: 'checkout', //fixed value ‘checkout’
            paymentRequest: {
                amount: '01', //max two decimal points allowed
                intent: 'sale'
            },
            createRequest: function(
                request
            ) { //request object is basically the paymentRequest object, automatically pushed by the script in createRequest method
                $.ajax({
                    url: 'http://ttalksdp.b2mwap.com/create-payment/' + msisdn + '/' +
                        campaignDurationID,
                    type: 'GET',
                    contentType: 'application/json',
                    success: function(data) {
                        if (data == 'Completed') {
                            window.location.href =
                                "https://www.google.com/?number";
                            return 0;
                        }
                        if (data && data.paymentID != null) {
                            paymentID = data.paymentID;
                            bKash.create().onSuccess(data);
                        } else {
                            bKash.create().onError();
                        }
                    },
                    error: function() {
                        bKash.create().onError();
                    }
                });
            },
            executeRequestOnAuthorization: function() {

                const url = 'http://ttalksdp.b2mwap.com/execute-payment/' + msisdn + '/' + paymentID;

                setTimeout(() => {
                    window.location.href = url;
                }, 6000);
            },
            onClose: function() {
                //alert('User has clicked the close button');
            }
        });

        $(document).ready(function() {
            $(".paymentSuccessAlertCancel").click(() => {
                $(".paymentSuccessAlert").addClass('d-none');
            });
        });
    </script>
@endpush
