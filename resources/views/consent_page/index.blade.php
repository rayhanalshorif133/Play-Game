<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="https://scripts.pay.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout.js"></script>
</head>

<body>
    <div class="my-20">
        <img src="{{ asset('images/bkash_payment_logo.png') }}" class="w-auto h-16 mx-auto flex" alt="image">
        <h3 class="text-center mx-auto font-bold py-2 text-stone-700 text-xl">স্বাগতম B2M Technologies Ltd.</h3>
        <h3 class="text-center mx-auto font-bold py-2 text-stone-700 text-lg my-2">আপনার সর্বমোট চার্জ 10/= + ভ্যাট</h3>
        {{-- pay now btn --}}
        <div class="flex flex-col sm:hidden mx-auto justify-center space-y-10 mt-10">
            <a href="#"
                class="w-auto flex justify-center mx-auto text-gray-50 bg-[#DA196C] py-2 px-4 rounded-lg hover:shadow-md hover:shadow-[#DA196C]">
                <i class="fa fa-money-bill-wave text-white"></i> পেমেন্ট করুন
            </a>
            {{-- cancel --}}
            <a href="{{ route('home') }}"
                class="w-auto flex justify-center mx-auto text-gray-50 bg-[#9f9f9f] py-2 px-4 rounded-lg hover:shadow-md hover:shadow-[#9f9f9f]">
                <i class="fa fa-times text-white"></i> বাতিল করুন
            </a>
        </div>
        <div class="hidden sm:flex mx-auto justify-center sm:space-x-10 sm:space-y-0 space-y-10 mt-10">
            <a href="#"
                class="w-auto text-gray-50 bg-[#DA196C] py-2 px-4 rounded-lg hover:shadow-md hover:shadow-[#DA196C]">
                <i class="fa fa-money-bill-wave text-white"></i> পেমেন্ট করুন
            </a>
            {{-- cancel --}}
            <a href="{{ route('home') }}"
                class="w-auto text-gray-50 bg-[#9f9f9f] py-2 px-4 rounded-lg hover:shadow-md hover:shadow-[#9f9f9f]">
                <i class="fa fa-times text-white"></i> বাতিল করুন
            </a>
        </div>
        <h3 class="text-center mx-auto font-bold py-2 text-gray-700 mt-40">
            যেকোনো সহযোগিতার জন্য আমাদের সাথে যোগাযোগ করুন:
            <a href="tel:+88017xxxxxxxx" class="text-blue-500">88017xxxxxxxx</a>
        </h3>
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


   
</body>

</html>
