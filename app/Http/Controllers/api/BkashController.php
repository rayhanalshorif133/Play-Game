<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GrentToken;
use App\Models\BkashCreatePayment;


class BkashController extends Controller
{
    public function grentToken()
    {

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


        $response = json_decode($response, true);

        $grent_token = new GrentToken();
        $grent_token->id_token = $response['id_token'];
        $grent_token->token_type = $response['token_type'];
        $grent_token->expires_in = $response['expires_in'];
        $grent_token->refresh_token = $response['refresh_token'];
        $grent_token->expired_time = date('H:i:s', strtotime('+'.$response['expires_in'].' seconds'));
        $grent_token->created_date = date('Y-m-d');
        $grent_token->created_time = date('H:i:s');
        $grent_token->save();
        return $this->respondWithSuccess('Grent Token Created Successfully', $grent_token);
    }

    public function createPayment($msisdn){




        $invoice = random_int(100000, 999999) + 1;

        $grent_token = $this->grentToken();
        $grent_token = json_decode($grent_token->content(), true);



        $bkashCreatePayment = new BkashCreatePayment();
        $bkashCreatePayment->grent_token_id = $grent_token['data']['id'];
        $bkashCreatePayment->msisdn = $msisdn;
        $bkashCreatePayment->created_date = date('Y-m-d');
        $bkashCreatePayment->created_time = date('H:i:s');

        $grent_token = $grent_token['data']['id_token'];


        $request_data=array(
            'amount'				=> 10,
            'currency'				=> 'BDT',
            'intent'				=> 'sale',
            'merchantInvoiceNumber'	=> $invoice
        );

        $url=curl_init('https://checkout.pay.bka.sh/v1.2.0-beta/checkout/payment/create');
        $request_data_json=json_encode($request_data);
        $header=array(
        'Content-Type:application/json',
        	"authorization: $grent_token",
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
        $response = json_decode($response, true);
        curl_close($url);


        $bkashCreatePayment->paymentID = $response['paymentID'];
        $bkashCreatePayment->createTime = $response['createTime'];
        $bkashCreatePayment->orgLogo = $response['orgLogo'];
        $bkashCreatePayment->orgName = $response['orgName'];
        $bkashCreatePayment->transactionStatus = $response['transactionStatus'];
        $bkashCreatePayment->amount = $response['amount'];
        $bkashCreatePayment->currency = $response['currency'];
        $bkashCreatePayment->intent = $response['intent'];
        $bkashCreatePayment->merchantInvoiceNumber = $response['merchantInvoiceNumber'];
        $bkashCreatePayment->status = 1;
        $bkashCreatePayment->message = 'Payment Created Successfully';
        $bkashCreatePayment->save();


        return $this->respondWithSuccess('Payment Created Successfully', $bkashCreatePayment);
    }


    public function executePayment($payment_id){




        $bkashCreatePayment = BkashCreatePayment::find($payment_id);


        if(!$bkashCreatePayment){
            return $this->respondWithError('Payment Not Found');
        }

        $grent_token = GrentToken::find($bkashCreatePayment->grent_token_id);

        if($grent_token == null){
            return $this->respondWithError('Grent Token Not Found');
        }

        $payment_url = 'https://checkout.pay.bka.sh/v1.2.0-beta/checkout/payment/execute/'. $bkashCreatePayment->paymentID;

        $url = curl_init($payment_url);
        $header=array(
        	'Content-Type:application/json',
        	"authorization: $grent_token->id_token",
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

        return $this->respondWithSuccess('Payment Executed Successfully', $response);

    }


}
