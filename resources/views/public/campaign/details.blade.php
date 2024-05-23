@extends('layouts.app_public', ['title' => 'Home'])

@section('styles')
@endsection

@section('content')
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="https://scripts.pay.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout.js"></script>

    {{-- details of campaign --}}
    <div class="flex justify-content-center">
        <div class="col-12 col-sm-6 col-md-4 mb-3">
            <div class="card">
                <div>
                    <a href="#" class="text-center mx-auto text-decoration-none text-dark w-full">
                        <span class="fw-bold d-block flex text-center">
                            Campaign Name
                        </span>
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">Campaign Name</h5>
                        <p class="card-text">
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Numquam esse ipsam distinctio, nostrum asperiores fugiat quae possimus iure, nihil ad culpa libero dolorum nisi blanditiis! Omnis alias saepe distinctio doloremque.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <button class="btn btn-success" id="bKash_button">
        Pay with bKash
    </button>


    <script>
        var msisdn = '8801923988380';
        var inv_no = Math.floor((Math.random() * 100000) + 1);;
        var paymentID = '';
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
                    url: 'http://ttalksdp.b2mwap.com/create_payment/' + msisdn,
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

                const url = 'http://ttalksdp.b2mwap.com/execute_payment/' + msisdn + '/' + paymentID;

                setTimeout(() => {
                    window.location.href = url;
                }, 6000);
            },
            onClose: function() {
                //alert('User has clicked the close button');
            }
        });
    </script>
@endsection
