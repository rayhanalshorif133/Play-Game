<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CreatePayment;
use App\Models\PaymentDetails;
use App\Models\Subscription;
use App\Models\Campaign;
use App\Models\SubUnsubsLog;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->handleMsisdn();
    }

    public function paymentCreate()
    {
        // Initialize cURL session
        try {



            $msisdn = $this->get_msisdn();


            if ($msisdn) {
                $url = 'https://gpglobal.b2mwap.com/api/subscription?keyword=BDG&msisdn=' . $msisdn;
            }

            $new_payment = new CreatePayment();
            $new_payment->msisdn = $msisdn;
            $new_payment->date_time = date('Y-m-d H:i:s');
            $new_payment->redirect_url = $url;
            $new_payment->save();


            $callback = url('api/payment/' . $new_payment->id . '/callback');


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


        try {


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


            // 
            $findPayment = CreatePayment::find($payment_id);
            $findPayment->status = $newPayment->status;
            $findPayment->save();



            $date = date('Y-m-d');



            if ($request->result == 'success') {
                $campaign = $this->getCurrentCampaign();
                $subscription = Subscription::where('msisdn', $newPayment->msisdn)->whereDate('subs_date', $date)->first();



                if ($subscription) {
                    $subscription->msisdn = $newPayment->msisdn;
                    $subscription->campaign_id = $campaign->id;
                    $subscription->acr = $newPayment->acr;
                    $subscription->keyword = $request->keyword;
                    $subscription->status = 1;
                    $subscription->subs_date = Carbon::now();
                    $subscription->unsubs_date = null;
                    $subscription->save();
                } else {
                    $subscription = new Subscription();
                    $subscription->msisdn = $newPayment->msisdn;
                    $subscription->campaign_id = $campaign->id;
                    $subscription->acr = $newPayment->acr;
                    $subscription->keyword = $request->keyword;
                    $subscription->status = 1;
                    $subscription->subs_date = Carbon::now();
                    $subscription->unsubs_date = null;
                    $subscription->save();
                }




                $subUnsubsLog = new SubUnsubsLog();

                $subUnsubsLog->subscription_id = $subscription->id;

                // make log

                $subUnsubsLog->payment_id = $newPayment->id;
                $subUnsubsLog->msisdn = $newPayment->msisdn;
                $subUnsubsLog->type = 'subs';
                $subUnsubsLog->keyword = $request->keyword;
                $subUnsubsLog->status = 1;
                $subUnsubsLog->message = 'ok';
                $subUnsubsLog->date_time = Carbon::now();
                $subUnsubsLog->save();
                return redirect('/home?status=success');
            } else {
                $subUnsubsLog = new SubUnsubsLog();
                $subUnsubsLog->payment_id = $newPayment->id;
                $subUnsubsLog->msisdn = $newPayment->msisdn;
                $subUnsubsLog->type = 'subs';
                $subUnsubsLog->keyword = $request->keyword;
                $subUnsubsLog->status = 0;
                $subUnsubsLog->message = 'Failed to Payment or cancel payment';
                $subUnsubsLog->date_time = Carbon::now();
                $subUnsubsLog->save();
                return redirect('/home?status=failure');
            }
        } catch (\Throwable $th) {
            return redirect('/home?status=failure');
        }
    }
}
