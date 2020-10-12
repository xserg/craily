<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once APPPATH . "third_party/stripe/vendor/autoload.php";
class My_stripe {

	public function __construct(){
		\Stripe\Stripe::setApiKey(API_SECRET_KEY);
	}

	/*function create_bank_account($acc_id,  $data = array()) {
		try {
			$create_External_acc = \Stripe\Account::createExternalAccount(
				$acc_id,
				['external_account' =>
					[
						'object' => 'bank_account',
				       	'country' => $data['acc_country'],
						'routing_number' => $data['acc_routing_number'],
						'account_number' => $data['acc_number'],
						'currency' => 'usd',
						'account_holder_type' => 'individual',
						'account_holder_name' => $data['account_title'],
					],
				]
			);
			if($create_External_acc)
				return $create_External_acc;
			return false;
		}
		catch (Exception $e) {
			return $e->getMessage();
		}
	}*/

	function connect_stripe($acc_id) {
		try {
			$login_link = \Stripe\Account::createLoginLink(
				$acc_id
			);
			if($login_link)
				return $login_link;
			return false;
		} catch (Exception $e) {
			return $e->getMessage();
			//return false;
		}
	}

	function get_current_balance($acc_id) {
		try {
			$balance = \Stripe\Balance::retrieve(
				['stripe_account' => $acc_id]
			);
			if($balance)
				return $balance;
			return false;
		} catch (Exception $e) {
			return $e->getMessage();
			//return false;
		}
	}

	function get_total_payouts($acc_id) {
		try {
			$payouts = \Stripe\Payout::all(
				['limit' => 3]
			);
			if($payouts)
				return $payouts;
			return false;
		} catch (Exception $e) {
			return $e->getMessage();
			//return false;
		}
	}

	function stripe_connect_custom($email = '', $get_data)
	{
		try {
			$custom_connect = \Stripe\Account::create([
				'type' => 'custom',
				'country' => 'US',
				'email' => $email,
				'business_type' => 'individual',
				'requested_capabilities' => [
					'card_payments',
					'transfers',
				]
			]);
			if($custom_connect)
				return $custom_connect;
			return false;
		} catch(Excpetion $e) {
			echo $e->getMessage();
		}
	}

	function update_bank_account($acc_id, $post) {
		try {
			$update_bank = \Stripe\Account::update(
				$acc_id,
				['external_account' => ['object' => 'bank_account', 'country' => $post['country'], 'account_holder_name' => $post['account_number'], 'routing_number' => $post['routing_number'], 'account_number' => $post['account_number']]]
			);
			if($update_bank)
				return $update_bank;
			return false;
		} catch (Exception $e) {
			echo $e->getMessage();
			//return false;
		}
	}
	//external link
	function retrieve_bank_accounts($acc_id) {
		try {
			$bank_accounts = \Stripe\Account::allExternalAccounts(
				$acc_id,
				['object' => 'bank_account', 'limit' => 3]
			);
			if($bank_accounts)
				return $bank_accounts;
			return false;
		} catch (Exception $e) {
			return $e->getMessage();
			//return false;
		}
	}

	/*** start customer ***/

	function save_customer($parms,$customer_id=''){
		try {

			if(empty($customer_id)){
				$customer = \Stripe\Customer::create($parms);
				if($customer)
					return $customer->id;
				return false;
			}else{
				$customer = \Stripe\Customer::update($customer_id,$parms);
				if($customer)
					return $customer->id;
				return false;
			}
		} catch (Exception $e) {
			// echo $e->getMessage();
			return false;
		}
	}

	function list_customers($customer_id='')
	{
		try {
			$customers = \Stripe\Customer::all(['limit' => 3]);

			if($customers)
				return $customers;
			return false;
		} catch (Exception $e) {
			// echo $e->getMessage();
			return false;
		}
	}

	function create_bank_account($customer_id='', $data = array())
	{
		try
		{
			$bank_account = \Stripe\Customer::createSource(
				$customer_id,
				[
					"source" => [
				       	'object' => 'bank_account',
				       	'country' => $data['acc_country'],
						'routing_number' => $data['acc_routing_number'],
						'account_number' => $data['acc_number'],
						'currency' => 'usd',
						'account_holder_type' => 'individual',
						'account_holder_name' => $data['account_title'],
				    ],
				]
			);
			return $bank_account;
		} catch (Exception $e) {
			return $e->getMessage();
			//return false;
		}

		
	}

	function list_bank($customer_id=''){
		try {
			if(!empty($customer_id)) {

				//$bank = \Stripe\Customer::retrieve($customer_id);

				$bank_accounts = \Stripe\Customer::allSources(
					$customer_id,
					[
						'limit' => 3,
						'object' => 'bank_account',
					]
				);

				//$customer = \Stripe\Customer::create($parms);
				if($bank_accounts)
					return $bank_accounts;
				return false;
			} else {
				return false;
			}
		} catch (Exception $e) {
			// echo $e->getMessage();
			return false;
		}
	}

	function delete_customer($customer_id){
		try {
			$customer = \Stripe\Customer::retrieve($customer_id);
			if($customer)
				$customer->delete();
			return false;	
		} catch (Exception $e) {
			// echo $e->getMessage();
			return false;
		}
	}

	function make_defualt_payment_method($customer_id,$card_id){
		try {
			$customer = \Stripe\Customer::update($customer_id,
				[
					'default_source' => $card_id
				]
			);
			// pr($customer);
			if($customer)
				return $customer->id;
			return false;
		} catch (Exception $e) {
			// echo $e->getMessage();
			return false;
		}
	}

	/*** end customer ***/

	/*** start Payment Method ***/

	function create_payment_method($customer_id,$nonce){
		try {
			$card = \Stripe\Customer::createSource(
				$customer_id,
				[
					'source' => $nonce,
				]
			);
			if($card)
				return $card;
			return false;
		} catch (Exception $e) {
			echo $e->getMessage();
			return false;
		}
	}

	function delete_payment_method($customer_id,$card_id){
		try {
			print_r($customer_id);
			$card = \Stripe\Customer::deleteSource($customer_id,$card_id);
			if($card->deleted)
				return true;
			return false;
		} catch (Exception $e) {
			// echo $e->getMessage();
			return false;
		}
	}

	/*** end Payment Method ***/

	function generate_client_token(){
		return $this->gateway->clientToken()->generate();
	}

	function update_express($stripe_account_id='', $nonce = '', $method_token= '') {
		try {
			$card = \Stripe\Customer::createSource(
				$stripe_account_id,
				[
					'source' => $nonce
				]
			);
			if($card->id)
			{
				$response = \Stripe\Customer::deleteSource(
					$stripe_account_id,
					$method_token
				);

				if($response->deleted) 
				{
					return $card;
				} else {
					$response = \Stripe\Customer::deleteSource(
						$stripe_account_id,
						$card->id
					);

					return false;
				}
			}

			return false;
		}
		catch (Exception $e) {
			echo $e->getMessage();
			return false;
		}
	}

	/*** start Charge ***/

	function charge_customer($amount,$customer_id,$description=''){
		try {
			$cents=floatval($amount*100);
			$charge = \Stripe\Charge::create([
				"amount" => $cents,
				"currency" => "USD",
				'customer' => $customer_id,
                "description" => $description
			]);

			if($charge)
				return $charge->id;
				// return $result->transaction->id;
			return false;
		} catch (Exception $e) {
			// echo $e->getMessage();
			return false;
		}
	}
	function charge($customer_id,$card_id,$amount,$description=''){
		try {
			$cents=floatval($amount*100);
			$charge = \Stripe\Charge::create([
				"amount" => $cents,
				"currency" => "USD",
				'customer' => $customer_id,
				'source' => $card_id,
                "description" => $description
                //"metadata" => $metadata
			]);
			if($charge)
				return $charge->id;
				// return $charge->transaction->id;
			return false;
		} catch (Exception $e) {
			// echo $e->getMessage();
			exit($e->getMessage());
			return false;
		}
	}
}
