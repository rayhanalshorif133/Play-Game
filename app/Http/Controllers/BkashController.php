<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GrentToken;
use App\Models\BkashCreatePayment;
use App\Models\CampaignDuration;
use App\Models\BkashExecutePayment;
use App\Models\BkashPayment;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class BkashController extends Controller
{
    
    
    public function getToken()
    {
        session()->forget('bkash_token');

        $request_data = array(
            'app_key'		=>'2l6u3m4i01ed69foin29vp42m',
            'app_secret'	=>'1d2qur3hm323h26h6a0m5pqucka8qkaae5drfimo4vejabo032qi'
        );  
        $header = array(
            'Content-Type:application/json',
            'username:BDGAMERS',               
            'password:B@1PtexcaQMvb'
        ); 
        /* production */
        $url = curl_init('https://checkout.pay.bka.sh/v1.2.0-beta/checkout/token/grant');
        $request_data_json = json_encode($request_data);

        curl_setopt($url,CURLOPT_HTTPHEADER, $header);
        curl_setopt($url,CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url,CURLOPT_POSTFIELDS, $request_data_json);
        curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($url, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($url, CURLOPT_TIMEOUT, 30);
        $response = curl_exec($url);
        curl_close($url);

        $response = json_decode($response, true);


        session()->put('bkash_token', $response['id_token']);

        $currentDateTime = new \DateTime();
        $currentDateTime->modify('+' . ($response['expires_in'] + 1) . ' seconds');

        $grentToken = new GrentToken();
        $grentToken->id_token = $response['id_token'];
        $grentToken->token_type = $response['token_type'];
        $grentToken->expires_in = $response['expires_in'];
        $grentToken->expired_time = $currentDateTime->format('H:i:s');
        $grentToken->refresh_token = $response['refresh_token'];
        $grentToken->created_date = date('Y-m-d');
        $grentToken->created_time = date('H:i:s');
        $grentToken->save();

        return $response['id_token'];
    }

    public function createPayment(Request $request,$msisdn, $campaignDurationId)
    {

       

        $this->getToken();

        $id_token = session()->get('bkash_token');
        $grentToken = GrentToken::select()->where('id_token',$id_token)->first();
        $getCampaignDuration = CampaignDuration::find($campaignDurationId);

		$request_data=array(
				'amount'				=> $getCampaignDuration->amount,
				'currency'				=> 'BDT',
				'intent'				=> 'sale',
				'merchantInvoiceNumber'	=> $this->merchantInvoiceNumber()
		);   

               
                 
        $url=curl_init('https://checkout.pay.bka.sh/v1.2.0-beta/checkout/payment/create');   
        $request_data_json=json_encode($request_data);
        $header=array(
        'Content-Type:application/json',
            "authorization: $id_token",
            'x-app-key:2l6u3m4i01ed69foin29vp42m'
        );
                    
        curl_setopt($url,CURLOPT_HTTPHEADER, $header);
        curl_setopt($url,CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url,CURLOPT_POSTFIELDS, $request_data_json);
        curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($url, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($url, CURLOPT_TIMEOUT, 30);
        $response = curl_exec($url);
        curl_close($url);

        $response = json_decode($response, true);

        $bkashCreatePayment = new BkashCreatePayment();
        $bkashCreatePayment->msisdn = $msisdn;
        $bkashCreatePayment->campaign_duration_id = $campaignDurationId;
        $bkashCreatePayment->grent_token_id = $grentToken->id;
        $bkashCreatePayment->paymentID = $response['paymentID'];
        $bkashCreatePayment->orgLogo = $response['orgLogo'];
        $bkashCreatePayment->orgName = $response['orgName'];
        $bkashCreatePayment->transactionStatus = $response['transactionStatus'];
        $bkashCreatePayment->amount = $response['amount'];
        $bkashCreatePayment->status = 0;
        $bkashCreatePayment->currency = $response['currency'];
        $bkashCreatePayment->merchantInvoiceNumber = $response['merchantInvoiceNumber'];
        $bkashCreatePayment->hash = $response['hash'];
        $bkashCreatePayment->createDateTime = $response['createTime'];
        $bkashCreatePayment->response = json_encode($response);
        $bkashCreatePayment->save();


        return $response;

    }


    protected function merchantInvoiceNumber(){

        $merchantInvoiceNumber = rand(1111111,9999999);
        $findBkashCreatePayment = BkashCreatePayment::select()->where('merchantInvoiceNumber', $merchantInvoiceNumber)->first();

        if($findBkashCreatePayment){
            $this->merchantInvoiceNumber();
        }

        return $merchantInvoiceNumber;
    }

    public function executePayment(Request $request,$msisdn, $paymentID)
    {
        sleep(5);
        $id_token = session()->get('bkash_token');

        $payment_url = 'https://checkout.pay.bka.sh/v1.2.0-beta/checkout/payment/execute/'.$paymentID; 
        $url = curl_init($payment_url);
        $header=array(
        	'Content-Type:application/json',
        	"authorization: $id_token",
        	'x-app-key:2l6u3m4i01ed69foin29vp42m'
        );
        curl_setopt($url,CURLOPT_HTTPHEADER, $header);
        curl_setopt($url,CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($url, CURLOPT_TIMEOUT, 30);
        $response = curl_exec($url);
        curl_close($url);


        $response = json_decode($response, true);


        // if(isset($response['errorCode'])){
        //     // Session::flash('message', 'The payment execution has already been completed');
        //     // Session::flash('status', 'Success');
        //     return redirect()->back();
        // }


        if($response){
            $bkashExecutePayment = new BkashExecutePayment();
            $bkashExecutePayment->paymentID = $response['paymentID']? $response['paymentID'] : null;
            $bkashExecutePayment->createTime = $response['createTime'];
            $bkashExecutePayment->createTime = $response['createTime'];
            $bkashExecutePayment->updateTime = $response['updateTime'];
            $bkashExecutePayment->trxID = $response['trxID'];
            $bkashExecutePayment->transaction_status = $response['transactionStatus'];
            $bkashExecutePayment->amount = $response['amount'];
            $bkashExecutePayment->currency = $response['currency'];
            $bkashExecutePayment->intent = $response['intent'];
            $bkashExecutePayment->merchantInvoiceNumber = $response['merchantInvoiceNumber'];
            $bkashExecutePayment->bkash_msisdn = $response['customerMsisdn'];
            $bkashExecutePayment->msisdn = $msisdn;
            $bkashExecutePayment->response = json_encode($response);
            $bkashExecutePayment->save();

            $bkashCreatePayment = BkashCreatePayment::select()->where('paymentID',$bkashExecutePayment->paymentID)->first();
            $campaignDuration = CampaignDuration::select()->where('id',$bkashCreatePayment->campaign_duration_id)->first();
            if($response['transactionStatus'] == 'Completed'){
                $bkashCreatePayment->status = 1;
                
                $bkashPayment = new BkashPayment();
                $bkashPayment->user_id = Auth::user()->id;
                $bkashPayment->msisdn = $msisdn;
                $bkashPayment->bkash_msisdn = $bkashExecutePayment->bkash_msisdn;
                $bkashPayment->bkash_execute_payment_id = $bkashExecutePayment->id;
                $bkashPayment->campaign_id = $campaignDuration->campaign_id;
                $bkashPayment->tournament_id = '0192929';
                $bkashPayment->campaign_duration_id = $campaignDuration->id;
                $bkashPayment->amount = $bkashExecutePayment->amount;
                $bkashPayment->paymentID = $bkashExecutePayment->paymentID;
                $bkashPayment->status = '1';
                $bkashPayment->date_time = date('Y-m-d H:i:s');
                $bkashPayment->message = 'success';
                $bkashPayment->save();
                
            }else{
                $bkashCreatePayment->status = 0;
            }
            $bkashCreatePayment->save();
       
            // flash()->addSuccess('Payment created successfully');
            Session::flash('message', 'Payment created successfully');
            Session::flash('status', 'Success');
            sleep(3);          
            return redirect()->back();
        }

        flash()->addError('Payment is not created!');
        return redirect()->back();
    }

    

    public function queryPayment(Request $request)
    {
        $token = session()->get('bkash_token');
        $paymentID = $request->payment_info['payment_id'];

        $url = curl_init("$this->base_url/checkout/payment/query/" . $paymentID);
        $header = array(
            'Content-Type:application/json',
            "authorization:$token",
            "x-app-key:$this->app_key"
        );

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        $resultdata = curl_exec($url);
        curl_close($url);
        return json_decode($resultdata, true);
    }

    public function bkashSuccess(Request $request)
    {
        // IF PAYMENT SUCCESS THEN YOU CAN APPLY YOUR CONDITION HERE
        if ('Noman' == 'success') {

            // THEN YOU CAN REDIRECT TO YOUR ROUTE

            Session::flash('successMsg', 'Payment has been Completed Successfully');

            return response()->json(['status' => true]);
        }

        Session::flash('error', 'Noman Error Message');

        return response()->json(['status' => false]);
    }


    
    // consent_back
    public function consentBack(Request $request, $msisdn,$trxID){
        dd($request->all(), $msisdn, $trxID);
    }
}
