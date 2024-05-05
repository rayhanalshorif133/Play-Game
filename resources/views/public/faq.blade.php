@extends('layouts.app_public')

@section('content')
    <div class="container mt-10">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="one">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button"
                                    data-toggle="collapse" data-target="#collapseOne" aria-expanded="false"
                                    aria-controls="collapseOne">
                                    Collapsible Group Item #1
                                </button>
                            </h2>
                        </div>

                        <div id="collapseOne" class="collapse" aria-labelledby="one" data-parent="#accordionExample"
                            style="">
                            <div class="card-body">
                                Some placeholder content for the first accordion panel. This panel is shown by default,
                                thanks to the <code>.show</code> class.
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="two">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button"
                                    data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                    aria-controls="collapseTwo">
                                    Collapsible Group Item #2
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="two" data-parent="#accordionExample">
                            <div class="card-body">
                                Some placeholder content for the second accordion panel. This panel is hidden by default.
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="three">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button"
                                    data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                                    aria-controls="collapseThree">
                                    Collapsible Group Item #3
                                </button>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="three" data-parent="#accordionExample">
                            <div class="card-body">
                                And lastly, the placeholder content for the third and final accordion panel. This panel is
                                hidden by default.
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="four">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button"
                                    data-toggle="collapse" data-target="#collapseFour" aria-expanded="false"
                                    aria-controls="collapseFour">
                                    Collapsible Group Item #4
                                </button>
                            </h2>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="four" data-parent="#accordionExample">
                            <div class="card-body">
                                And lastly, the placeholder content for the third and final accordion panel. This panel is
                                hidden by default.
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="five">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button"
                                    data-toggle="collapse" data-target="#collapseFive" aria-expanded="false"
                                    aria-controls="collapseFive">
                                    Collapsible Group Item #5
                                </button>
                            </h2>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="five" data-parent="#accordionExample">
                            <div class="card-body">
                                And lastly, the placeholder content for the third and final accordion panel. This panel is
                                hidden by default.
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="six">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button"
                                    data-toggle="collapse" data-target="#collapseSix" aria-expanded="false"
                                    aria-controls="collapseSix">
                                    Collapsible Group Item #6
                                </button>
                            </h2>
                        </div>
                        <div id="collapseSix" class="collapse" aria-labelledby="six" data-parent="#accordionExample">
                            <div class="card-body">
                                And lastly, the placeholder content for the third and final accordion panel. This panel is
                                hidden by default.
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="seven">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button"
                                    data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false"
                                    aria-controls="collapseSeven">
                                    Collapsible Group Item #7
                                </button>
                            </h2>
                        </div>
                        <div id="collapseSeven" class="collapse" aria-labelledby="seven"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                And lastly, the placeholder content for the third and final accordion panel. This panel is
                                hidden by default.
                            </div>
                        </div>
                    </div>

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
