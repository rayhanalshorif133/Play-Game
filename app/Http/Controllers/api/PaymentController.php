<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CreatePayment;
use App\Models\PaymentDetails;
use App\Models\Subscription;
use App\Models\SubUnsubsLog;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function __construct(){
        $this->handleMsisdn();
    }

    public function paymentCreate()
    {
        // Initialize cURL session
        try {



            $msisdn = $this->get_msisdn();


            if($msisdn){
                $url = 'https://gpglobal.b2mwap.com/api/subscription?keyword=BDG&msisdn=' . $msisdn;
            }

            $new_payment = new CreatePayment();
            $new_payment->msisdn = $msisdn;
            $new_payment->date_time = date('Y-m-d H:i:s');
            $new_payment->redirect_url = $url;
            $new_payment->save();


            $callback = url('api/payment/'. $new_payment->id .'/callback');


            $url = $url . '&success_url=' . $callback . '&failed_url=' . $callback;
            $new_payment->redirect_url = $url;
            $new_payment->save();
            return $this->respondWithSuccess('create payment', $url);
        } catch (\Throwable $th) {
            return $this->respondWithError('Something went wrong', $th->getMessage());
        }
    }

    public function paymentCallback(Request $request, $payment_id)
    {

        // http://127.0.0.1:8000/api/payment/7/callback?keyword=BDG&msisdn=8801701677479&acr=OcCngbiAb6IGp5D1b2XYJ2nbjMf5izcx&type=ondemand&result=success

        try {
            // $chargeData = $this->chargeStatusCheck($request->all());

            $newPayment = new PaymentDetails();
            $newPayment->payment_id = $payment_id;
            $newPayment->keyword = $request->keyword;
            $newPayment->msisdn = $request->msisdn;
            $newPayment->acr = $request->acr;
            $newPayment->status = $request->result == 'success' ? 1 : 0;
            $newPayment->type = $request->type;
            $newPayment->result = $request->result;
            $newPayment->response = json_encode($request->all());
            $newPayment->date_time = date('Y-m-d H:i:s');
            $newPayment->save();


            return redirect('/home?status=success');



            if ($newPayment->status == 1) {
                $existingSubscription = Subscription::where('msisdn', $newPayment->msisdn)->first();
                $subUnsubsLog = new SubUnsubsLog();
                if ($existingSubscription) {
                    $existingSubscription->status = 1;
                    $existingSubscription->save();
                    $subUnsubsLog->subscription_id = $existingSubscription->id;
                } else {
                    $subscription = new Subscription();
                    $subscription->msisdn = $newPayment->msisdn;
                    $subscription->aocTransID = $newPayment->aocTransID;
                    $subscription->keyword = $request->keyword;
                    $subscription->status = 1;
                    $subscription->subs_date = Carbon::now();
                    $subscription->unsubs_date = null;
                    $subscription->save();
                    $subUnsubsLog->subscription_id = $subscription->id;
                }

                // make log

                $subUnsubsLog->robi_payment_id = $newPayment->id;
                $subUnsubsLog->msisdn = $newPayment->msisdn;
                $subUnsubsLog->type = 'subs';
                $subUnsubsLog->keyword = $request->keyword;
                $subUnsubsLog->status = 1;
                $subUnsubsLog->message = 'ok';
                $subUnsubsLog->date_time = Carbon::now();
                $subUnsubsLog->save();
                return redirect('/home?status=success');
            } else {
                //  make log with resion
                return redirect('/home?status=failure');
            }
        } catch (\Throwable $th) {
            return redirect('/home?status=failure');
        }
    }


    public function chargeStatusCheck($aocTransID)
    {
        // Initialize cURL session
        $ch = curl_init();

        // Set the URL
        curl_setopt($ch, CURLOPT_URL, 'https://rd.b2mwap.com/api/chargeStatus/' . $aocTransID);

        // Return the transfer as a string instead of outputting it directly
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Execute the request and get the response
        $response = curl_exec($ch);

        // Check if any error occurred during the request
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        } else {
            // Decode the response if it's JSON
            $data = json_decode($response, true);

            // Access the specific data from the response
            // if (isset($data['data'])) {
            //     $data = $data['data'];
            //     // Uncomment and set your redirect URL if needed
            //     // header("Location: " . $redirectURL);
            // }
        }


        curl_close($ch);

        return $data;
    }
}
