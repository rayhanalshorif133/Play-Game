<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        return $response['id_token'];
    }

    public function createPayment(Request $request,$msisdn)
    {
        $this->getToken();

        $id_token = session()->get('bkash_token');

		$request_data=array(
				'amount'				=> 01,
				'currency'				=> 'BDT',
				'intent'				=> 'sale',
				'merchantInvoiceNumber'	=> "10192930"
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

        return $response;

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


        return $response;

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
