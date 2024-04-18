<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment</title>
</head>

<body>
    <h1>Payment</h1>
    <script src="https://scripts.pay.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout.js"></script>
    <script>
        var msisdn = '8801923988380';
        var game = 'PacRush';
        var inv_no = Math.floor((Math.random() * 100000) + 1);
        var paymentID = '';
        bKash.init({
            paymentMode: 'checkout',
            paymentRequest: {
                amount: '10', //max two decimal points allowed
                intent: 'sale'
            },
            createRequest: function(
                request
            ) { //request object is basically the paymentRequest object, automatically pushed by the script in createRequest method
                $.ajax({
                    url: '/api/bkash/create-payment/' + msisdn,
                    type: 'GET',
                    contentType: 'application/json',
                    success: function(data) {
                        console.log(data)
                        if (data == 'Completed') {
                            window.location.href = "/bkash/execute-payment/" + paymentID;
                            return 0;
                        }
                        data = JSON.parse(data);
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
                $.ajax({
                    url: '/api/bkash/execute-payment/6',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        "paymentID": paymentID
                    }),
                    success: function(data) {
                        data = JSON.parse(data);
                        if (data && data.paymentID != null) {
                            window.location.href =
                                "https://ghoori.b2mwap.com/PacRush/consent_back/" + msisdn + "/" +
                                data.trxID; //Merchant’s success page
                        } else {
                            $('#model_errorMessage').html(data.errorMessage);
                            $("#modal_button").click();
                            bKash.execute().onError();
                        }
                    },
                    error: function() {
                        bKash.execute().onError();
                    }
                });

            },
            onClose: function() {
                alert('User has clicked the close button');
            }
        });
    </script>


</body>

</html>
