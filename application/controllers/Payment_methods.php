<?php

class Payment_methods extends MY_Controller {

	function __construct() {
		parent::__construct();
		//$this->isMemLogged($this->session->mem_type);
		$this->load->model('payment_methods_model');
		$this->load->model('transaction_model');
		$this->load->library('my_stripe');
	}
	
	function index() {
		//$this->isMemLogged('student');
	
		if($this->data['mem_data']->mem_type == 'tutor')
        {
            if($this->data['mem_data']->mem_tutor_application > 0){
                if(empty($this->data['mem_data']->mem_stripe_id)) {
                    redirect('stripe-register');
                    exit;
                }
                
            }
        }

		$this->data['rows']=$this->payment_methods_model->get_methods();
		$this->load->view("payments/payments", $this->data);
	}

	function update_card() {
		$post = html_escape($this->input->post());

		if ($this->input->post()) {
			$res=array();
			$res['hide_msg']=0;
			$res['scroll_to_msg']=1;
			$res['status'] = 0;
			$res['frm_reset'] = 0;
			$res['redirect_url'] = 0;
			$post = html_escape($this->input->post());

			$method_token = $post['method_token'];
			$nonce = $post['nonce'];
			$card_name = $post['card_name'];
			$card_number = $post['card_number'];
			$exp_month = $post['exp_month'];
			$exp_year = $post['exp_year'];
			$cvc = $post['cvc'];
			$row_id = $post['row_id'];

			$this->form_validation->set_rules('nonce','Nonce','required',array('required'=>"Something went wrong!"));

			if($this->form_validation->run()===FALSE)
			{
				$res['msg'] = validation_errors();
			}else{
				$payment_method = $this->my_stripe->update_express($this->data['mem_data']->mem_stripe_id, $nonce, $method_token);
				if(!empty($payment_method))
				{
					$last_digits= $payment_method->last4;
					$method_token= $payment_method->id;
					$expiry= get_month_name($payment_method->exp_month).', '.$payment_method->exp_year;
					$image= str_replace(' ', '-', strtolower($payment_method->brand)).'.png';

					$save_data=array('mem_id'=>$this->session->mem_id,'last_digits'=>$last_digits,'expiry'=>$expiry,'method_token'=>$method_token,'image'=>$image, 'stripe_customer_id' => $this->data['mem_data']->mem_stripe_id);

					if(!$this->payment_methods_model->get_default_method())
						$save_data['default_method']=1;

					$res['msg'] = showMsg('success','Credit card has been saved successfully!');

					$id = $this->payment_methods_model->save($save_data, 'id', $row_id);
					$this->payment_methods_model->save(array('encoded_id'=>doEncode('pm-'.$id)),'id', $id);
				}
				$res['redirect_url'] = site_url('payment-methods');
				$res['status'] = 1;
				$res['hide_msg']=1;
			}
			exit(json_encode($res));
		}
		else{
			// $this->data['clientToken'] = $this->my_stripe->generate_client_token();
			$this->load->view("payments/add-payment-method", $this->data);
		}
	}
	
	function add_new() {
		//$this->isMemLogged('student');
		if($this->data['mem_data']->mem_type == 'tutor')
        {
            if($this->data['mem_data']->mem_tutor_application > 0){
                if(empty($this->data['mem_data']->mem_stripe_id)) {
                    redirect('stripe-register');
                    exit;
                }
                
            }
        }
        elseif (empty($this->session->mem_type)) {
            redirect('login');
                    exit;
        }
		if ($this->input->post()) {
			$res=array();
			$res['hide_msg']=0;
			$res['scroll_to_msg']=1;
			$res['status'] = 0;
			$res['frm_reset'] = 0;
			$res['redirect_url'] = 0;
			$post = html_escape($this->input->post());

			// if ($post['type']=='credit-card')
				$this->form_validation->set_rules('nonce','Nonce','required',array('required'=>"Something went wrong!"));
			/*else
				$this->form_validation->set_rules('email','Paypal address','required|valid_email');*/
			
			if($this->form_validation->run()===FALSE)
			{
				$res['msg'] = validation_errors();
			}else{
				// if ($post['type']=='credit-card'){
					
					if(!$payment_method=$this->my_stripe->create_payment_method($this->data['mem_data']->mem_stripe_id,$post['nonce'])){
					
//						$res['msg']=showMsg("error","Something went wrong, Please try again later!");
						$res['msg']=showMsg("error","This card is invalid.");
						exit(json_encode($res));
					}

					$last_digits=$payment_method->last4;
					$method_token=$payment_method->id;
					$expiry=get_month_name($payment_method->exp_month).', '.$payment_method->exp_year;
					$image=str_replace(' ', '-', strtolower($payment_method->brand)).'.png';

					$save_data=array('mem_id'=>$this->session->mem_id,'last_digits'=>$last_digits,'expiry'=>$expiry,'method_token'=>$method_token,'image'=>$image);

					if(!$this->payment_methods_model->get_default_method())
						$save_data['default_method']=1;

					
				/*}else{
					$save_data=array('mem_id'=>$this->session->mem_id,'paypal'=>$post['email'],'image'=>'paypal.png');
					$res['msg'] = showMsg('success','Paypal address has been saved successfully!');
				}*/

				$id=$this->payment_methods_model->save($save_data);
				$credit_cards=$this->payment_methods_model->get_mem_method($id, $this->sesison->mem_id);
				if($id)
				{
					$res['msg'] = showMsg('success','Credit card has been saved successfully!');
					$this->payment_methods_model->save(array('encoded_id'=>doEncode('pm-'.$id)),'id', $id);
					$res['status'] = 1;
				} else {
//					$res['msg'] = showMsg('error','Something went wrong, Please try again later!');
					$res['msg']=showMsg("error","This card is invalid.");
					$res['status'] = 0;
				}

				$res['redirect_url'] = site_url('payment-methods');
				$res['credit_card'] = $credit_cards;
				
				$res['hide_msg']=1;
			}
			exit(json_encode($res));
		}
		else{
			// $this->data['clientToken'] = $this->my_stripe->generate_client_token();
			$this->load->view("payments/add-payment-method", $this->data);
		}
	}
	function add_bank() {
		//$this->isMemLogged('tutor');
		$this->load->library('my_stripe');
		if($this->data['mem_data']->mem_type == 'tutor')
        {
            if($this->data['mem_data']->mem_tutor_application > 0){
                if(empty($this->data['mem_data']->mem_stripe_id)) {
                    redirect('stripe-register');
                    exit;
                }
                
            }
        }
		if ($this->input->post()) {
			$res=array();
			$res['hide_msg']=0;
			$res['scroll_to_msg']=1;
			$res['status'] = 0;
			$res['frm_reset'] = 0;
			$res['redirect_url'] = 0;

			$this->form_validation->set_rules('swift_code','Swift Code','required');
			$this->form_validation->set_rules('routing_number','Routing Number','required');
			$this->form_validation->set_rules('bank_name','Bank Name','required');
			$this->form_validation->set_rules('account_title','Account Title','required');
			$this->form_validation->set_rules('account_number','Account Number','required');
			$this->form_validation->set_rules('city','City','required');
			$this->form_validation->set_rules('state','State','required');
			$this->form_validation->set_rules('country','Country','required',array('required'=>'Please select a {field}'));

			if($this->form_validation->run()===FALSE)
			{
				$res['msg'] = validation_errors();
			}else{
				$post = html_escape($this->input->post());

				if(!$this->master->getRow('countries',array('sortname'=>$post['country']))){
					$res['msg'] = showMsg('error','Please select a valid Country!');
					exit(json_encode($res));
				}

				$get_mem_data = $this->master->getRow('members', array('mem_id' => $this->session->mem_id));

				$save_data=array('mem_id'=>$this->session->mem_id,'acc_swift_code'=>$post['swift_code'],'acc_routing_number'=>$post['routing_number'],'acc_bank_name'=>$post['bank_name'],'acc_title'=>$post['account_title'],'acc_number'=>$post['account_number'],'acc_city'=>$post['city'],'acc_state'=>$post['state'],'acc_country'=>$post['country']);

				$cust_id = $get_mem_data->mem_stripe_id;
				$bank_account = $this->my_stripe->create_bank_account($cust_id, $save_data);

				if($bank_account->id)
				{
					$res['id'] = $bank_account->id;
					$res['msg'] = showMsg('success','Successfully added to stripe'.$bank_account->id.' ');
					//$res['redirect_url'] = site_url('direct-deposit');
					$res['status'] = 1;
					$res['hide_msg']=1;
				} else {
					$res['msg'] = showMsg('error',''.$bank_account.'');
				}
			}
			exit(json_encode($res));
		}
		else{
	        $list_customers = $this->my_stripe->list_customers($this->data['mem_data']->mem_stripe_id);

	        if($list_customers->data[0]->id) {
	        	$get_cust_id = $this->payment_methods_model->get_account($list_customers->data[0]->id);

	        	if(count($get_cust_id) > 0) {
	        		$this->session->set_userdata('stripe_customer_id', $list_customers->data[0]->id);
	        		$this->payment_methods_model->save(array('stripe_customer_id' => $list_customers->data[0]->id), 'id', $this->session->mem_id);
	        	} else {
	        		$save_data=array('mem_id'=>$this->session->mem_id, 'stripe_customer_id' => $list_customers->data[0]->id);
	        		$this->payment_methods_model->save($save_data);
	        	}

	        	$list_banks = $this->my_stripe->list_bank($list_customers->data[0]->id);
	        	$this->data['bank'] = $list_banks->data;
	        }

			$this->load->view("payments/add-bank", $this->data);
		}
	}
	
	function direct_deposit() {
		if($this->data['mem_data']->mem_type == 'tutor')
        {
            if($this->data['mem_data']->mem_tutor_application > 0){
                if(empty($this->data['mem_data']->mem_stripe_id)) {
                    redirect('stripe-register');
                    exit;
                }
                
            }
        }

        if ($this->input->post()) {
			$res=array();
			$res['hide_msg']=0;
			$res['scroll_to_msg']=1;
			$res['status'] = 0;
			$res['frm_reset'] = 0;
			$res['redirect_url'] = 0;

			//$this->form_validation->set_rules('swift_code','Swift Code','required');
			$this->form_validation->set_rules('routing_number','Routing Number','required');
			$this->form_validation->set_rules('bank_name','Bank Name','required');
			$this->form_validation->set_rules('account_title','Account Title','required');
			$this->form_validation->set_rules('account_number','Account Number','required');
			//$this->form_validation->set_rules('city','City','required');
			//$this->form_validation->set_rules('state','State','required');
			$this->form_validation->set_rules('country','Country','required',array('required'=>'Please select a {field}'));

			if($this->form_validation->run()===FALSE)
			{
				$res['msg'] = validation_errors();
			} else {
				$post = html_escape($this->input->post());
				$cust_id = $post['cust_id'];
				$update_bank = $this->my_stripe->update_bank_account($cust_id, $post);

				//update bank details
				if($update_bank->id)
				{
					$res['url'] = $update_bank->url;
					$res['msg'] = showMsg('success','Successfully Updated');
					$res['redirect_url'] = site_url('direct-deposit');
					$res['status'] = 1;
					$res['hide_msg'] = 1;
				}
			}

			exit(json_encode($res));
		} else {
				//$this->isMemLogged('tutor');
				$this->data['total_payout'] = $this->transaction_model->get_total_payout($this->session->mem_id);
		        $this->data['balance_due'] = $this->transaction_model->get_balance_due($this->session->mem_id);
		        
				$this->data['processing_payouts'] = $this->transaction_model->get_processing_payouts($this->session->mem_id);
				$this->data['cleared_payouts'] = $this->transaction_model->get_cleared_payouts($this->session->mem_id);
				$this->data['rows']=$this->payment_methods_model->get_methods();
				$get_cust_id = $this->payment_methods_model->get_methods();
				$this->data['cust_id'] = $get_cust_id[0]->stripe_connect_custom_id;
									
				if(!empty($get_cust_id))
				{
					$bank_accounts = $this->my_stripe->retrieve_bank_accounts($get_cust_id[0]->stripe_customer_id);
					$this->data['rows']= $bank_accounts;
				} else {
					$this->data['rows']= '';
				}

				$get_mem_data = $this->master->getRow('members', array('mem_id' => $this->session->mem_id));

				//get current balance
				$cust_id = $get_mem_data->mem_stripe_id;
				$bank_balance = $this->my_stripe->get_current_balance($cust_id);				
				/*$get_payouts = $this->my_stripe->get_total_payouts($cust_id);

				echo "<prE>"; print_r($get_payouts); die();*/

				$current_balance = 0;
				if($bank_balance['available'][0]->amount) {
					$current_balance = $bank_balance['available'][0]->amount;
				}
				$bank_account = $this->my_stripe->connect_stripe($cust_id);

				if(empty($bank_account->url)) {
					//$res['msg'] = showMsg('error',$bank_account);
					$this->data['error'] = $bank_account;
					//exit(json_encode($res));
				}
				$get_pay_method = $this->master->getRow('payment_methods', array('mem_id' => $this->session->mem_id));
				$save_data_re=array('mem_id'=>$this->session->mem_id, 'login_link' => $bank_account->url);
				$id=$this->payment_methods_model->save($save_data_re,'id', $get_pay_method->id);
				$this->data['url'] = $bank_account->url;
				$this->data['current_balance'] = $current_balance;

				$this->load->view("payments/direct-deposit", $this->data); 
			}
	}

	function delete($id='') {
		$id=intval(substr(doDecode($id),3));
		if($row=$this->payment_methods_model->get_mem_method($id))
		{
			if($this->session->mem_type=='student'){
				if(!$this->my_stripe->delete_payment_method($this->data['mem_data']->mem_stripe_id,$row->method_token)){
					setMsg('error', 'Something went wrong, Please try again later!');
					redirect("payment-methods", 'refresh');
					exit;
				}

			}

			$this->payment_methods_model->delete($id);
			setMsg('success', 'Payment Method has been deleted successfully!');
			
			$url=$this->session->mem_type=='student'?'payment-methods':'direct-deposit';
			redirect($url, 'refresh');
			exit;
		}
		else
			show_404();
	}

	function make_default($id='') {
		$id=intval(substr(doDecode($id),3));
		if($row=$this->payment_methods_model->get_mem_method($id))
		{
			if($this->session->mem_type=='student'){
				if(!$this->my_stripe->make_defualt_payment_method($this->data['mem_data']->mem_stripe_id,$row->method_token)){
					setMsg('error', 'Something went wrong, Please try again later!');
					redirect("payment-methods", 'refresh');
					exit;
				}
			}

			$this->payment_methods_model->save(array('default_method'=>0),'mem_id',$this->session->mem_id);
			$this->payment_methods_model->save(array('default_method'=>1),'id',$id);
			setMsg('success', 'Payment Method has been set to default successfully!');
			$url=$this->session->mem_type=='student'?'payment-methods':'direct-deposit';
			redirect($url, 'refresh');
			exit;
		}
		else
			show_404();
	}

	function transactions($page=1) {
        //$this->isMemLogged('tutor');
        if($this->data['mem_data']->mem_type == 'tutor')
        {
            if($this->data['mem_data']->mem_tutor_application > 0){
                if(empty($this->data['mem_data']->mem_stripe_id)) {
                    redirect('stripe-register');
                    exit;
                }
                
            }
        }

        /*$page=intval($page);
        $per_page=20;

        $total=$this->transaction_model->total_transactions($this->session->mem_id);
        $total_pages=ceil($total/$per_page);
        
        if($page<=$total_pages || $page>0){

            $this->load->library('pagination');
            $this->config->load('pagination');
            
            $config = $this->config->item('pagination');        
            $config['base_url'] = site_url('transactions');
            $config['total_rows'] = $total;
            $config['per_page'] = $per_page;
            $this->pagination->initialize($config); 
            $this->data['links'] = $this->pagination->create_links();

            $start=($page-1)*$per_page;

            $this->data['rows'] = $this->transaction_model->get_transactions($this->session->mem_id,$start,$per_page,'desc');
            $this->load->view("account/transactions", $this->data); 
        }
        else
            show_404();*/
        if($this->data['mem_data']->mem_type == 'tutor') 
        {
        	$mem_type = 'tutor';
        } else {
			$mem_type = 'student';
        }
        $this->data['rows'] = $this->transaction_model->get_tutor_transactions($this->session->mem_id, $mem_type);
        $this->data['total_payout'] = $this->transaction_model->get_total_payout($this->session->mem_id);
        $this->data['balance_due'] = $this->transaction_model->get_balance_due($this->session->mem_id);
        $this->load->view("account/transactions", $this->data); 

    }
    function transaction_detail() {
        //$this->isMemLogged('tutor');
        if($this->data['mem_data']->mem_type == 'tutor')
        {
            if($this->data['mem_data']->mem_tutor_application > 0){
                if(empty($this->data['mem_data']->mem_stripe_id)) {
                    redirect('stripe-register');
                    exit;
                }
                
            }
        }

        $encoded_id=$this->input->post('store');
        $id=intval(substr(doDecode($encoded_id),4));
        // $condition=array('mem_type<>'=>$this->session->mem_type,$this->session->mem_type.'_id'=>$this->session->mem_id,'l.status'=>2,'completed'=>2);
        if($row = $this->transaction_model->get_tutor_transaction($id,$this->session->mem_id)){
			
			if($row->status == 0) $status = "Pending";
			else if($row->status == 1) $status = "Accepted";
			if($row->completed == 0){
				 if($row->status == 2) $status = "Confirmed";
			}			
			else if($row->completed == 1){
				if($row->status == 2) $status = "Complete Request";
			}   
			else if($row->completed == 2) {
				if($row->status == 2) $status = "Completed";
			} 
            $res['data']='
            <div class="crosBtn"></div>
            <h3>Transaction Detail</h3>
            <ul class="list">
            <li><strong>Name:</strong><span>'.$row->mem_name.'</span></li>
            <li><strong>Email:</strong><span>'.$row->mem_email.'</span></li>
            <li><strong>Subject:</strong><span>'.$row->subject.'</span></li>
            <li><strong>Date:</strong><span>'.format_date($row->lesson_date_time).'</span></li>
            <li><strong>Start Time:</strong><span>'.format_date($row->lesson_date_time,'h:m A').'</span></li>
            <li><strong>Hours:</strong><span>'.$row->hours.'</span></li>
            <li><strong>Amount:</strong><span>$'.$row->trx_amount.'</span></li>
            <li><strong>Status:</strong><span>'.$status.'</span></li>
            <li><strong>Location:</strong><span>'.$row->address.'</span></li>
            <li><strong>Detail:</strong><span>'.$row->detail.'</span></li>
            </ul>';
            $res['status']=1;
            exit(json_encode($res));
        }
        die('access denied!');
    }

    function withdraw() {
        //$this->isMemLogged('tutor');
        if($this->data['mem_data']->mem_type == 'tutor')
        {
            if($this->data['mem_data']->mem_tutor_application > 0){
                if(empty($this->data['mem_data']->mem_stripe_id)) {
                    redirect('stripe-register');
                    exit;
                }
                
            }
        }
        $res=array();
        $res['status'] = 0;
        $res['redirect_url'] = 0;
        $balance_due = $this->transaction_model->get_balance_due($this->session->mem_id);
        if($balance_due<=0)
        {
            $res['msg'] = showMsg('error',"You don't have enough Balance to withdraw!");
        }else{
            $this->transaction_model->update(array('status'=>1),array('mem_id'=>$this->session->mem_id,'status'=>0));

            $this->transaction_model->save_withdraw(array('mem_id'=>$this->session->mem_id,'amount'=>$balance_due));

            $res['msg'] = showMsg('success',"Withdraw request saved successfully, Please wait!");
            $res['status'] = 1;
        }
        exit(json_encode($res));
    }
}
?>