@extends('layouts.app_public')

@section('content')
    <div class="mx-auto text-center description">
        <img src="{{ asset('images/des.png') }}" alt="" class="my-4 logo" />
        <div>

            
            @if(Auth::check())
                <input id="GET_MSISDN" class="d-none" value="{{Auth::user()->msisdn}}"/>
                <input id="GET_CampaignDurationID" class="d-none" value="{{$campaignDuration->id}}"/>
                <button class="btn btn-primary common-btn play_btn" id="bKash_button">
                    Play
                </button>
            @else
            <a href="{{ route('campaign.access', $campaignDuration->id) }}" class="btn btn-primary common-btn play_btn">
                Play
            </a>
            @endif
            
        </div>
        <div class="py-4">
            <a href="{{ route('public.leaderboard', $campaignDuration->id) }}" class="btn btn-primary  leaderbord mx-2">
                <img src="{{ '/web_assets/images/leaderboard.png' }}" alt="leaderboard" class="icon">
                Leaderboard
            </a>
            <a href="leaderboard.html" class="btn btn-primary  leaderbord mx-2" data-toggle="modal"
                data-target="#exampleModalCenter">
                <img src="{{ '/web_assets/images/list.png' }}" alt="rules" class="icon">
                Rules
            </a>
        </div>
        <img src="{{ '/web_assets/images/banner.png' }}" alt="leaderboard" class="banner my-2" />
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
                    url: 'http://ttalksdp.b2mwap.com/create-payment/' + msisdn + '/' + campaignDurationID,
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
    </script>
@endpush
