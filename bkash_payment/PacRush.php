<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
*  Controller : Bkash APPS
*  @author    : Tushar Das <tushar2499@gmail.com>
*  Created    : 14-09-2021
*/

class PacRush extends Gateway_Controller 
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Dhaka');       
		$this->load->helper('cookie');
		// load necessary model
		$this->load->model('Bkash_model');
		$this->load->library('Authorization_Token');
		$this->load->model('Leaderboard_model');

	}

	function index(){
		echo 'test'; 
	}


	function landing($msisdn=''){
		if(!empty($msisdn)){
			$expire = 6*30*24*3600;

		    $cookie= array(
	           'name'   => 'msisdn',
	           'value'  => $msisdn,
	           'expire' => $expire,
	        );
	        $this->input->set_cookie($cookie);
		}
		else{
			$msisdn = $this->input->cookie('msisdn',true);
		}

		$game = 'PacRush';
		$data['msisdn'] = $msisdn;
		$data['game'] 	= $game;
		if(!empty($msisdn)){
			$token_exist_info  = $this->Bkash_model->select_data_condition_single_data('bkash_auth_data',['id_token'=>$msisdn]);
			if($token_exist_info != null){
				$payment = $this->Bkash_model->select_payment_check($msisdn);
				$count = $this->Bkash_model->get_count('play_log',['msisdn'=>$msisdn]);
				
				$hit_data['msisdn'] = $msisdn;
				$hit_data['game'] 	= $game;
				$hit_data['d_date'] = date('Y-m-d');
				$hit_data['d_time'] = date('H:i:s');
				$browser = $this->getBrowser();
				$hit_data['browser_name'] = $browser['name'];
				$hit_data['version'] = $browser['version'];
				$hit_data['platform'] = $browser['platform'];
				$hit_data['userAgent'] = $browser['userAgent'];
				$ip = $this->get_client_ip();
				$hit_data['ip'] = $ip;

				$this->Bkash_model->insert_data('hit_log',$hit_data);
				
				$hit_count = $this->Bkash_model->get_count('hit_log',['msisdn'=>$msisdn,'game'=>$game,'d_date'=>date('Y-m-d')]);
				
				$data['count'] 		= $count;
				$data['hit_count'] 	= $hit_count;
				
				$data['payment']			= $payment;
				$data['total_paly'] 		= $this->Leaderboard_model->total_paly();
				$data['total_free_paly'] 	= $this->Leaderboard_model->total_free_paly();
				$data['user_free_play_count'] 	= $this->Leaderboard_model->user_free_play_count($msisdn);
				
				
				$token_data = $this->Bkash_model->select_data_condition_single_data('bkash_auth_data',['id_token'=>$msisdn]);
				if($token_data != null){
					$mobile_number = $token_data->mobile_number;
				}
				else{
					$mobile_number = $msisdn;
				}


				$campaign_data = $this->Bkash_model->select_data_condition_single_data('campaign',['start_date <='=>date('Y-m-d'),'end_date >='=>date('Y-m-d')]);
				if($campaign_data == null){
					$campaign_data = $this->Bkash_model->select_data_condition_single_data_desc('campaign',[],'end_date');
				}
				$data['campaign_data'] 		= $campaign_data;
				$data['today_rank'] 		= $this->Leaderboard_model->daily_rank($mobile_number,date('Y-m-d'));
				$data['monthly_rank'] 		= $this->Leaderboard_model->weekly_rank($mobile_number,$campaign_data->start_date,$campaign_data->end_date);
				$this->load->view('pac_rush/landing.php',$data);
				
			}
			else{
				echo 'Token Not Match.';
			}
		}
		else{
			echo 'Empty Token.';
		}
		
	}

	function gameover($msisdn=''){
		$this->load->model('Leaderboard_model');
		$game='PacRush';
		$data['msisdn'] = $msisdn;
		$data['game'] 	= $game;
		if(!empty($msisdn)){
			$payment = $this->Bkash_model->select_payment_check($msisdn);
			$count = $this->Bkash_model->get_count('play_log',['msisdn'=>$msisdn]);
			
			$hit_data['msisdn'] = $msisdn;
			$hit_data['game'] 	= $game;
			$hit_data['d_date'] = date('Y-m-d');
			$hit_data['d_time'] = date('H:i:s');
			$this->Bkash_model->insert_data('hit_log',$hit_data);
			
			$hit_count = $this->Bkash_model->get_count('hit_log',['msisdn'=>$msisdn,'game'=>$game,'d_date'=>date('Y-m-d')]);
			
			$data['count'] 		= $count;
			$data['hit_count'] 	= $hit_count;
		
			$data['payment']			= $payment;
			
			$data['total_paly'] 		= $this->Leaderboard_model->total_paly();
			
			$token_data = $this->Bkash_model->select_data_condition_single_data('bkash_auth_data',['id_token'=>$msisdn]);
			if($token_data != null){
				$mobile_number = $token_data->mobile_number;
			}
			else{
				$mobile_number = $msisdn;
			}
			
			$campaign_data = $this->Bkash_model->select_data_condition_single_data('campaign',['start_date <='=>date('Y-m-d'),'end_date >='=>date('Y-m-d')]);
			if($campaign_data == null){
				$campaign_data = $this->Bkash_model->select_data_condition_single_data_desc('campaign',[],'end_date');
			}
			$data['campaign_data'] 		= $campaign_data;

			$data['today_rank'] 		= $this->Leaderboard_model->daily_rank($mobile_number,date('Y-m-d'));
			$data['monthly_rank'] = $this->Leaderboard_model->weekly_rank($mobile_number,$campaign_data->start_date,$campaign_data->end_date);
			$data['my_score'] 	  = $this->Leaderboard_model->last_score($mobile_number);
			
			
			$this->load->view('pac_rush/gameover.php',$data);
		}
		else{
			echo 'Invalid Request.';
		}
	}

	function paly_game($msisdn){
		$game='PacRush';
		$payment = $this->Bkash_model->select_payment_check($msisdn);
		$count = $this->Bkash_model->get_count('play_log',['msisdn'=>$msisdn]);
		
		$token_data['msisdn'] = $msisdn;
		$token_data['token'] = uniqid();
		$token_data['d_date'] = date('Y-m-d');
		$token_data['d_time'] = date('H:i:s');
		$token_data['status'] = 1;
		
		$this->Bkash_model->insert_data('redirect_token',$token_data);
		
		$play_log['msisdn'] = $msisdn;
		$play_log['game'] = $game;
		$play_log['play_date'] = date('Y-m-d');
		$play_log['play_time'] = date('H:i:s');
		$this->Bkash_model->insert_data('play_log',$play_log);
		
		redirect('https://html5.b2mwap.com/bkash_game/PacRushProduction/?token='.$token_data['token'].'&id='.$token_data['msisdn']);
	}

	function consent_back($msisdn,$trxID){
		sleep(6);
		$game='PacRush';
		$data['msisdn'] = $msisdn;
		$data['trxID'] 	= $trxID;
		$data['game'] 	= $game;
		$data['status'] = $this->search_payment($game,$msisdn,$trxID);
		$this->load->view('pac_rush/consent_back',$data);
	}


	function create_payment($msisdn=null){
		//exit;
		$amount=10;
		$invoice='Inv-'.time().rand(100000,999999);
		
		$token_exist_info  = $this->Bkash_model->select_data_condition_single_data('bkash_auth_data',['id_token'=>$msisdn]);
		$id = $token_exist_info->mobile_number;
		if($id=='01301954881' || $id == '01755438398' || $id == '01580485799' || $id == '01644977703' || $id == '01885831500'){
			echo 'NOK';
			exit;
		}
		$payment_request  = $this->Bkash_model->select_data_condition_single_data_desc('create_payment_request',['msisdn'=>$msisdn,'d_date'=>date('Y-m-d')],'id');
		if($payment_request != null){
			$pev_invoice = $payment_request->invoice;
			$payment_execute  = $this->Bkash_model->select_data_condition_single_data_desc('execute_payment_response',['merchantInvoiceNumber'=>$pev_invoice],'id');
			//var_dump($payment_execute); exit;
			if($payment_execute != null){
				$trxID =  $payment_execute->trxID;
				$status = $this->search_payment('PacRush',$msisdn,$trxID);
				if($status == 'Completed'){
					echo 'Completed';
					exit;
				}
			}
		}
		
		$token_data = $this->Bkash_model->select_data_condition_single_data('grant_token',['msisdn'=>$msisdn,'expire_time >' => date('Y-m-d H:i:s')]);
		if($token_data != null){
			$request_data['id_token']	= $token_data->id_token;
		}
		else{
			$new_token = $this->grant_token($msisdn);
			//var_dump($new_token); exit;
			if(isset($new_token['status'])){
				$request_data['id_token']	= $new_token['id_token'];
			}
			else{
				echo "failled"; exit;
			}
		}
		//echo $request_data['id_token'];  exit;
		$request_data['msisdn']		= $msisdn;
		$request_data['amount']		= $amount;
		$request_data['invoice']	= $invoice;
		$request_data['currency']	= 'BDT';
		$request_data['intent']		= 'sale';
		$request_data['d_date']		= date('Y-m-d');
		$request_data['created']	= date('Y-m-d H:i:s');

		$request_id = $this->Bkash_model->insert_data_with_return_id('create_payment_request',$request_data);


		$id_token = $request_data['id_token'];
		$request_data=array(
				'amount'				=> $amount,
				'currency'				=> 'BDT',
				'intent'				=> 'sale',
				'merchantInvoiceNumber'	=> $invoice
		);          
		//$url=curl_init('https://checkout.sandbox.bka.sh/v1.2.0-beta/checkout/payment/create');   
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

		$response_data = json_decode($response);
		//var_dump($response_data); exit;
		if (property_exists($response_data, 'paymentID')) {
			$data['paymentID'] 				= $response_data->paymentID;
			$data['createTime'] 			= $response_data->createTime;
			$data['orgLogo'] 				= $response_data->orgLogo;
			$data['orgName'] 				= $response_data->orgName;
			$data['transactionStatus'] 		= $response_data->transactionStatus;
			$data['amount'] 				= $response_data->amount;
			$data['currency'] 				= $response_data->currency;
			$data['intent'] 				= $response_data->intent;
			$data['merchantInvoiceNumber'] 	= $response_data->merchantInvoiceNumber;
		}
		elseif (property_exists($response_data, 'errorCode')) {
			$data['errorCode'] 				= $response_data->errorCode;
			$data['errorMessage'] 			= $response_data->createTime;
		}
		$data['created']					= date('Y-m-d H:i:s');
		$data['msisdn']						= $msisdn;
		$data['request_id']					= $request_id;

		$this->Bkash_model->insert_data('create_payment_response',$data);
		
		$log_data['header_request'] 	= json_encode($header);
		$log_data['json_request'] 		= $request_data_json;
		$log_data['json_response'] 		= $response;
		$log_data['created'] 			= date('Y-m-d');
		
		$this->Bkash_model->insert_data('create_payment_log',$log_data);

		echo json_encode($data);
	}


	function execute_payment($msisdn,$paymentID){
		$game='PacRush';
		//$data['game'] 	= $game;
		$token_data = $this->Bkash_model->select_data_condition_single_data('grant_token',['msisdn'=>$msisdn,'expire_time >' => date('Y-m-d H:i:s')]);
		if($token_data != null){
			$id_token	= $token_data->id_token;
		}
		else{
			$new_token = $this->grant_token($msisdn);
			if(isset($new_token['status'])){
				$id_token	= $new_token['id_token'];
			}
			else{
				return "failled";
			}
		}
		//$payment_url = 'https://checkout.sandbox.bka.sh/v1.2.0-beta/checkout/payment/execute/'.$paymentID; 
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
		
		if(isset($response)){
			$response_data = json_decode($response);
			
			if (property_exists($response_data, 'paymentID')) {
				$data['paymentId'] 				= $response_data->paymentID;
				$data['createTime'] 			= $response_data->createTime;
				$data['updateTime'] 			= $response_data->updateTime;
				$data['trxID'] 					= $response_data->trxID;
				$data['transactionStatus'] 		= $response_data->transactionStatus;
				$data['amount'] 				= $response_data->amount;
				$data['currency'] 				= $response_data->currency;
				$data['intent'] 				= $response_data->intent;
				$data['merchantInvoiceNumber'] 	= $response_data->merchantInvoiceNumber;
				$data['created']				= date('Y-m-d h:i:s');

				$this->Bkash_model->insert_data('execute_payment_response',$data);
			}
			

			$rdata['raw_data'] 	= $response;
			$rdata['created']	= date('Y-m-d');
			$this->Bkash_model->insert_data('raw_data_execute_payment',$rdata);
			
			
			$log_data['header_request'] 	= json_encode($header);
			$log_data['json_request'] 		= '';
			$log_data['json_response'] 		= $response;
			$log_data['payment_id'] 		= $paymentID;
			$log_data['created'] 			= date('Y-m-d');
			
			$this->Bkash_model->insert_data('execute_payment_log',$log_data);
		
			echo $response;
		}
		else{
			redirect('bkash_gateway/query_payment/'.$msisdn.'/'.$paymentID);
		}
	}

	function query_payment($game='PacRush',$msisdn,$paymentID){
		$token_data = $this->Bkash_model->select_data_condition_single_data('grant_token',['msisdn'=>$msisdn,'expire_time >' => date('Y-m-d H:i:s')]);
		if($token_data != null){
			$id_token	= $token_data->id_token;
		}
		else{
			$new_token = $this->grant_token($msisdn);
			if(isset($new_token['status'])){
				$id_token = $new_token['id_token'];
			}
			else{
				return "failled";
			}
		}

		//$url=curl_init('https://checkout.sandbox.bka.sh/v1.2.0-beta/checkout/payment/query/'.$paymentID);
		$url=curl_init('https://checkout.sandbox.bka.sh/v1.2.0-beta/checkout/payment/query/'.$paymentID);
		$header=array(
			'Content-Type:application/json',
			"authorization: $id_token",
			'x-app-key:2l6u3m4i01ed69foin29vp42m'
		); 
		curl_setopt($url,CURLOPT_HTTPHEADER, $header);
		curl_setopt($url,CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
		curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($url, CURLOPT_TIMEOUT, 30);
		$resultdatax=curl_exec($url);
		curl_close($url);
		
		$log_data['header_request'] 	= json_encode($header);
		$log_data['json_request'] 		= '';
		$log_data['json_response'] 		= $resultdatax;
		$log_data['payment_id'] 		= $paymentID;
		$log_data['created'] 			= date('Y-m-d');
		
		$this->Bkash_model->insert_data('query_payment_log',$log_data);
		
		//echo $resultdatax;
		
		$response_data = json_decode($resultdatax);
		if($response_data->transactionStatus == 'Completed'){
			$this->search_payment($game,$msisdn,$response_data->trxID);
		}
		
		redirect('pac_rush/paly_game/'.$msisdn);
	}

	function search_payment($game='PacRush',$msisdn,$trxID){ 
		$token_data = $this->Bkash_model->select_data_condition_single_data('grant_token',['msisdn'=>$msisdn,'expire_time >' => date('Y-m-d H:i:s')]);
		if($token_data != null){
			$id_token	= $token_data->id_token;
		}
		else{
			$new_token = $this->grant_token($msisdn);
			if(isset($new_token['status'])){
				$id_token = $new_token['id_token'];
			}
			else{
				return "failled";
			}
		}

		//$url=curl_init('https://checkout.sandbox.bka.sh/v1.2.0-beta/checkout/payment/search/'.$trxID);
		$url=curl_init('https://checkout.pay.bka.sh/v1.2.0-beta/checkout/payment/search/'.$trxID);
		$header=array(
			'Content-Type:application/json',
			"authorization: $id_token",
			'x-app-key:2l6u3m4i01ed69foin29vp42m'
		);     
        curl_setopt($url,CURLOPT_HTTPHEADER, $header);
        curl_setopt($url,CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($url, CURLOPT_TIMEOUT, 30);
        $resultdatax=curl_exec($url);
        curl_close($url);
        
		//$resultdatax= '{"trxID":"8KB4IP5X30","initiationTime":"2021-11-11T10:50:16:000 GMT+0600","completedTime":"2021-11-11T10:50:16:000 GMT+0600","transactionType":"bKash Checkout via API","customerMsisdn":"8801815920898","transactionStatus":"Completed","amount":"20","currency":"BDT","organizationShortCode":"01550028691"}';
		$log_data['header_request'] 	= json_encode($header);
		$log_data['json_request'] 		= '';
		$log_data['json_response'] 		= $resultdatax;
		$log_data['trxID'] 				= $trxID;
		$log_data['created'] 			= date('Y-m-d');
		
		$this->Bkash_model->insert_data('search_payment_log',$log_data);
		
		$response_data = json_decode($resultdatax);
		
		if (property_exists($response_data, 'trxID')) {
			if($response_data->transactionStatus == 'Completed'){
				
				
				$payment_check = $this->Bkash_model->select_payment_check($msisdn);
				if($payment_check == null){
					$payment_data['trxID'] 					= $response_data->trxID;
					$payment_data['amount'] 				= $response_data->amount;
					$payment_data['msisdn'] 				= $msisdn;
					$payment_data['game'] 					= $game;
					$payment_data['payment_date'] 			= date('Y-m-d');
					$payment_data['expire_date'] 			= date('Y-m-d');
					$this->Bkash_model->insert_data('payment_log',$payment_data);
				}
			}
		}
		
		return $response_data->transactionStatus;
		
		//echo $resultdatax;
	}
	
	function grant_token($msisdn=null){
		/* using for sendbox 1 
		$request_data = array(
				'app_key'		=>'5tunt4masn6pv2hnvte1sb5n3j',
				'app_secret'	=>'1vggbqd4hqk9g96o9rrrp2jftvek578v7d2bnerim12a87dbrrka'
			);  
		$header = array(
				'Content-Type:application/json',
				'username:sandboxTestUser',               
				'password:hWD@8vtzw0'
			); 
		*/
		/* using for sendbox 2 	
		$request_data = array(
				'app_key'		=>'5nej5keguopj928ekcj3dne8p',
				'app_secret'	=>'1honf6u1c56mqcivtc9ffl960slp4v2756jle5925nbooa46ch62'
			);  
		$header = array(
				'Content-Type:application/json',
				'username:testdemo',               
				'password:test%#de23@msdao'
			); 
		 sendbox 2 */
		/* using for production */ 	
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
		//$url = curl_init('https://checkout.sandbox.bka.sh/v1.2.0-beta/checkout/token/grant');
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

		$response_data 	= json_decode($response);
		
		$rdata['raw_data'] 	= $response;
		$rdata['created']	= date('Y-m-d');
		$this->Bkash_model->insert_data('raw_data_grant_token',$rdata);
		
		$return_data	= [];
		if (property_exists($response_data, 'id_token')) {
			$data['id_token'] 			= $response_data->id_token;
			$data['expires_in'] 		= $response_data->expires_in;
			$data['refresh_token'] 		= $response_data->refresh_token;
			$data['expire_time']		= date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s'))+$response_data->expires_in);

			$return_data['status']		= true;
			$return_data['id_token']	= $response_data->id_token;
			$return_data['msg']			= 'success';
		}
		elseif(property_exists($response_data, 'status')){
			$data['status'] 			= $response_data->status;
			$data['msg'] 				= $response_data->msg;

			$return_data['status']		= false;
			$return_data['msg']			= 'Api error.!';
		}
		else{
			$return_data['status']		= false;
			$return_data['msg']			= 'Api not reached.!';
		}
		$data['msisdn']				= $msisdn;
		$data['created']			= date('Y-m-d');
		
		$this->Bkash_model->insert_data('grant_token',$data);

		return $return_data;
	}


	function refresh_token($msisdn=null){
		$refresh_token = $_GET['refresh_token'];

		/*$request_data = array(
			'app_key'		=> '5tunt4masn6pv2hnvte1sb5n3j',
			'app_secret'	=> '1vggbqd4hqk9g96o9rrrp2jftvek578v7d2bnerim12a87dbrrka',
			'refresh_token'	=> 'refresh_token'
		);  
		*/
		$request_data = array(
			'app_key'		=> '2l6u3m4i01ed69foin29vp42m',
			'app_secret'	=> '1d2qur3hm323h26h6a0m5pqucka8qkaae5drfimo4vejabo032qi',
			'refresh_token'	=> 'refresh_token'
		);  
		//$url = curl_init("https://checkout.sandbox.bka.sh/v1.2.0-beta/checkout/token/refresh");
		$url = curl_init("https://checkout.pay.bka.sh/v1.2.0-beta/checkout/token/refresh");
		$request_data_json = json_encode($request_data);
		$header = array(
				'Content-Type:application/json',
				'username:BDGAMERS',               
				'password:B@1PtexcaQMvb'
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

		$response_data 	= json_decode($response);
		$return_data	= [];
		if (property_exists($response_data, 'id_token')) {
			$data['id_token'] 			= $response_data->id_token;
			$data['expires_in'] 		= $response_data->expires_in;
			$data['refresh_token'] 		= $response_data->refresh_token;
			$data['expire_time']		= date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s'))+$response_data->expires_in);

			$return_data['status']		= true;
			$return_data['id_token']	= $response_data->id_token;
			$return_data['msg']			= 'success';
		}
		elseif(property_exists($response_data, 'status')){
			$data['status'] 			= $response_data->status;
			$data['msg'] 				= $response_data->msg;

			$return_data['status']		= false;
			$return_data['msg']			= 'Api error.!';
		}
		else{
			$return_data['status']		= false;
			$return_data['msg']			= 'Api not reached.!';
		}
		$data['msisdn']				= $msisdn;
		$data['created']			= date('Y-m-d');
		
		$this->Bkash_model->insert_data('grant_token',$data);

		return $return_data;
	}


	function leaderboard($game='PacRush',$msisdn='091829381'){
		$data['back_url'] 			= @$_SERVER['HTTP_REFERER'];
		$data['today'] 				= date('Y-m-d');

		$campaign_data = $this->Bkash_model->select_data_condition_single_data('campaign',['start_date <='=>date('Y-m-d'),'end_date >='=>date('Y-m-d')]);
		if($campaign_data == null){
			$campaign_data = $this->Bkash_model->select_data_condition_single_data_desc('campaign',[],'end_date');
		}
		$data['campaign_data'] 		= $campaign_data;

		$data['today_result'] 		= $this->Leaderboard_model->find_result(date('Y-m-d'));
		
		$data['monthly_result'] 		= $this->Leaderboard_model->find_result_date_to_date($campaign_data->start_date,$campaign_data->end_date);
		
		$data['payment'] 				=  $this->Bkash_model->select_payment_check($msisdn);
		$data['msisdn'] 				=  $msisdn;
		$this->load->view('pac_rush/leaderboard',$data);
	}
	
	function leaderboard_data($date){
		if(empty($date)){
			$date = date('Y-m-d');
		}
		$data['loading_date'] = $date;
		
		$data['today_result'] 		= $this->Leaderboard_model->find_result($date);
		$this->load->view('pac_rush/leaderboard_data',$data);
	}
	
	function leaderboard_data_weekly($date1,$date2){
		$data['date1'] = $date1;
		$data['weekly_result'] 			= $this->Leaderboard_model->find_result_date_to_date($date1,$date2);
		$this->load->view('pac_rush/leaderboard_data_weekly',$data);
	}
	
	function subscription_request_id(){
		return date('Ymdhis').mt_rand(10000,99999);
	}
	
	function encode_data($string,$secret){
		return $sig = hash_hmac('sha256', $string, $secret);
	}

	function get_client_ip() {
	    $ipaddress = '';
	    if (isset($_SERVER['HTTP_CLIENT_IP']))
	        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
	        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    else if(isset($_SERVER['HTTP_X_FORWARDED']))
	        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
	        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	    else if(isset($_SERVER['HTTP_FORWARDED']))
	        $ipaddress = $_SERVER['HTTP_FORWARDED'];
	    else if(isset($_SERVER['REMOTE_ADDR']))
	        $ipaddress = $_SERVER['REMOTE_ADDR'];
	    else
	        $ipaddress = 'UNKNOWN';
	    return $ipaddress;
	}

	function getBrowser() { 
		  $u_agent = $_SERVER['HTTP_USER_AGENT'];
		  $bname = 'Unknown';
		  $platform = 'Unknown';
		  $version= "";

		  //First get the platform?
		  if (preg_match('/linux/i', $u_agent)) {
		    $platform = 'linux';
		  }elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
		    $platform = 'mac';
		  }elseif (preg_match('/windows|win32/i', $u_agent)) {
		    $platform = 'windows';
		  }

		  // Next get the name of the useragent yes seperately and for good reason
		  if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)){
		    $bname = 'Internet Explorer';
		    $ub = "MSIE";
		  }elseif(preg_match('/Firefox/i',$u_agent)){
		    $bname = 'Mozilla Firefox';
		    $ub = "Firefox";
		  }elseif(preg_match('/OPR/i',$u_agent)){
		    $bname = 'Opera';
		    $ub = "Opera";
		  }elseif(preg_match('/Chrome/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
		    $bname = 'Google Chrome';
		    $ub = "Chrome";
		  }elseif(preg_match('/Safari/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
		    $bname = 'Apple Safari';
		    $ub = "Safari";
		  }elseif(preg_match('/Netscape/i',$u_agent)){
		    $bname = 'Netscape';
		    $ub = "Netscape";
		  }elseif(preg_match('/Edge/i',$u_agent)){
		    $bname = 'Edge';
		    $ub = "Edge";
		  }elseif(preg_match('/Trident/i',$u_agent)){
		    $bname = 'Internet Explorer';
		    $ub = "MSIE";
		  }
		  else{
		  	$bname = 'Unknown';
		  	$ub = 'Unknown';
		  }

		  // finally get the correct version number
		  $known = array('Version', $ub, 'other');
		  $pattern = '#(?<browser>' . join('|', $known) .
		')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
		  if (!preg_match_all($pattern, $u_agent, $matches)) {
		    // we have no matching number just continue
		  }
		  // see how many we have
		  $i = count($matches['browser']);
		  if ($i != 1) {
		    //we will have two since we are not using 'other' argument yet
		    //see if version is before or after the name
		    if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
		        $version= $matches['version'][0];
		    }else {
		        $version= null;
		    }
		  }else {
		    $version= $matches['version'][0];
		  }

		  // check if we have a number
		  if ($version==null || $version=="") {$version="?";}

		  return array(
		    'userAgent' => $u_agent,
		    'name'      => $bname,
		    'version'   => $version,
		    'platform'  => $platform,
		    'pattern'    => $pattern
		  );
	}
}