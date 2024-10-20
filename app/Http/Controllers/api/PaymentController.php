<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RobiCreatePayment;
use App\Models\RobiPayment;
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
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://rd.b2mwap.com/api/getToken/Snake');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            } else {
                $data = json_decode($response, true);
                if (isset($data['data'])) {
                    $data = $data['data'];
                }
            }
            curl_close($ch);

            $new_payment = new RobiCreatePayment();
            $new_payment->aocTransID = $data['aocTransID'];
            $new_payment->redirectURL = $data['redirectURL'];
            $new_payment->spTransID = $data['spTransID'];
            $new_payment->response = json_encode($data);
            $new_payment->date_time = date('Y-m-d H:i:s');
            $new_payment->save();

            return $this->respondWithSuccess('create payment', $data);
        } catch (\Throwable $th) {
            return $this->respondWithError('Something went wrong', $th->getMessage());
        }
    }

    public function paymentCallback(Request $request)
    {

        try {
            $chargeData = $this->chargeStatusCheck($request->aocTransID);

            $newPayment = new RobiPayment();
            $newPayment->code = $chargeData['code'];
            $newPayment->response = json_encode($chargeData['data']);
            $newPayment->aocTransID = $request->aocTransID; // Assuming you want to use this as a transaction ID
            if($chargeData['status'] == true){
                $newPayment->msisdn = $chargeData['data']['msisdn'];
                $newPayment->status = $chargeData['code'] == "00" ? 1 : 0;
                $newPayment->amount = $chargeData['data']['totalAmountCharged'];
                $newPayment->transaction_id = $chargeData['data']['clientCorrelator'];
                $newPayment->chargeStatus = $chargeData['data']['transactionOperationStatus'];
            }else{
                $newPayment->status = 0;
                $newPayment->chargeStatus = false;
            }
            $newPayment->date_time = date('Y-m-d H:i:s'); // Current date and time
            $newPayment->save();



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
                    $subscription->keyword = 'Snake';
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
                $subUnsubsLog->keyword = 'Snake';
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
            return $this->respondWithError('error to payment callback api', $th->getMessage());
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
