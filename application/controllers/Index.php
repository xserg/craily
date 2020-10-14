<?php

include_once APPPATH . "vendor/autoload.php";

class Index extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('member_model');
		$this->load->model('member_educations_model');
		$this->load->model('member_experiences_model');
		$this->load->model('payment_methods_model');
		$this->load->library('my_stripe');
		$this->load->library('xmlrpc');
		$this->load->library('xmlrpcs');
	}

	function index()
	{
		$subject = $this->master->getRows('subjects', array('parent_id' => '0')); // autocompleted subject
		$subjectjson = array();
		$item['text'] = 'Search Subject';
		$item['id'] = '';
		$item['selected'] = true;
		$subjectjson[0] = $item;
		foreach ($subject as $i => $s) {
			$item = [];
			$item['id'] = $s->name;
			$item['text'] = $s->name;
			$subjectjson[$i + 1] = $item;
		}
		$this->data['subject'] = $subjectjson;
		$this->data['site_content'] = $this->master->getRow('sitecontent', array('type' => 'home'));
		$this->data['site_content'] = unserialize($this->data['site_content']->code);
		// $this->data['partners'] = $this->master->getRows('partners');
		$this->data['tutors'] = $this->member_model->get_rows(array('mem_type' => 'tutor', 'mem_featured' => 1, 'mem_verified' => 1, 'mem_status' => 1, 'mem_tutor_verified' => 1));
		$this->load->view("pages/index", $this->data);
	}

	function login()
	{
		//$this->MemLogged();
		if ($this->input->post()) {
			$res = array();
			$res['frm_reset'] = 0;
			$res['hide_msg'] = 0;
			$res['scroll_to_msg'] = 0;
			$res['status'] = 0;
			$res['redirect_url'] = 0;
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if ($this->form_validation->run() === FALSE) {
				$res['msg'] = validation_errors();
			} else {
				$data = $this->input->post();

				$row = $this->member_model->authenticate($data['email'], $data['password']);
				if (count($row) > 0) {
					if ($row->mem_status == 0) {
						$res['msg'] = showMsg('error', 'Your account is currently under review. We will email you when your account is active.');
						exit(json_encode($res));
					}

					/*if($row->mem_verified==0){
						$res['msg'] = showMsg('error','Please verify email to access your account!');
						exit(json_encode($res));
					}
					*/
					$remember_token = '';
					if (isset($data['remeberMe'])) {
						$remember_token = doEncode('member-' . $row->mem_id);
						$cookie = array('name'   => 'remember', 'value'  => $remember_token, 'expire' => (86400 * 7));
						$this->input->set_cookie($cookie);
					}

					$this->member_model->update_last_login($row->mem_id, $remember_token);
					$this->session->set_userdata('mem_id', $row->mem_id);
					$this->session->set_userdata('mem_type', $row->mem_type);
					$this->session->set_userdata('mem_email', $data['email']);

					// $url=$this->session->mem_type=='student'?'account-settings':'dashboard';
					//$res['redirect_url']=empty($this->session->redirect_url)?site_url('my-lessons'):$this->session->redirect_url;
					$id = $this->session->mem_id;
					$this->data['rows'] = $this->payment_methods_model->get_methods($id);
					$res['redirect_url'] = site_url('my-lessons');
					if ($row->mem_type != 'student') {
						//if(empty($this->data['rows'])) {
						if (empty($row->mem_stripe_id)) {
							//$this->load->view("account/stripe-register");
							$res['redirect_url'] = site_url('stripe-register');
						}
					}

					//$this->session->unset_userdata('redirect_url');

					$res['msg'] = showMsg('success', 'Login successful! Please wait.');

					$res['status'] = 1;
					$res['frm_reset'] = 1;
					$res['hide_msg'] = 1;
				} else {
					$res['msg'] = showMsg('error', 'Invalid email or password');
				}
			}
			exit(json_encode($res));
		} else if ($this->input->get()) {
			$data = $this->input->get();
			if (isset($data['email']) && isset($data['password'])) {
				$row = $this->member_model->authenticate($data['email'], $data['password']);
				if (count($row) > 0) {
					if ($row->mem_status == 0) {
						$res['msg'] = showMsg('error', 'Your account is currently under review. We will email you when your account is active.');
						exit(json_encode($res));
					}

					$this->member_model->update_last_login($row->mem_id, $remember_token);
					$this->session->set_userdata('mem_id', $row->mem_id);
					$this->session->set_userdata('mem_type', $row->mem_type);
					$this->session->set_userdata('mem_email', $data['email']);

					// $url=$this->session->mem_type=='student'?'account-settings':'dashboard';
					//$res['redirect_url']=empty($this->session->redirect_url)?site_url('my-lessons'):$this->session->redirect_url;
					$id = $this->session->mem_id;
					$this->data['rows'] = $this->payment_methods_model->get_methods($id);
					if ($row->mem_type != 'student') {
						if (empty($row->mem_stripe_id)) {
							redirect('stripe-register');
						}
					}
					redirect('my-lessons');
				} else {
					$this->data['site_content'] = $this->master->getRow('sitecontent', array('type' => 'home'));
					$this->data['site_content'] = unserialize($this->data['site_content']->code);
					// $this->data['partners'] = $this->master->getRows('partners');
					$this->data['tutors'] = $this->member_model->get_rows(array('mem_type' => 'tutor', 'mem_featured' => 1, 'mem_verified' => 1, 'mem_status' => 1, 'mem_tutor_verified' => 1));
					$this->load->view("pages/index", $this->data);
				}
			} else {
				$this->data['site_content'] = $this->master->getRow('sitecontent', array('type' => 'home'));
				$this->data['site_content'] = unserialize($this->data['site_content']->code);
				// $this->data['partners'] = $this->master->getRows('partners');
				$this->data['tutors'] = $this->member_model->get_rows(array('mem_type' => 'tutor', 'mem_featured' => 1, 'mem_verified' => 1, 'mem_status' => 1, 'mem_tutor_verified' => 1));
				$this->load->view("pages/index", $this->data);
			}
		} else {
			$this->data['site_content'] = $this->master->getRow('sitecontent', array('type' => 'home'));
			$this->data['site_content'] = unserialize($this->data['site_content']->code);
			// $this->data['partners'] = $this->master->getRows('partners');
			$this->data['tutors'] = $this->member_model->get_rows(array('mem_type' => 'tutor', 'mem_featured' => 1, 'mem_verified' => 1, 'mem_status' => 1, 'mem_tutor_verified' => 1));
			$this->load->view("pages/index", $this->data);
		}
	}

	/**
	 * Update all existing student stripe customer id
	 *
	 * @return string
	 */
	function auto_update_stripe_cus_id()
	{
		// Grab all active student list
		$students = $this->member_model->get_students();
		foreach ($students as $key => $student) {
			$mem_id = $student->mem_id;
			$full_name = ucfirst($student->mem_fname) . ' ' . ucfirst($student->mem_lname);
			$stripe_customer_data = array(
				'name' => $full_name,
				'email' => $student->mem_email,
				'phone' => $student->mem_phone,
				"description" => "Crainly Customer " . $full_name
			);
			$update_data['mem_stripe_id'] = $this->my_stripe->save_customer($stripe_customer_data);
			//		    clear_table
			// Update stripe id
			$this->member_model->update($update_data, 'mem_id', $mem_id);
		}
		// TODO Clear all card informaion from table
		//	    $this->payment_methods_model->clear_table();

		echo "Script executed successfully.";
		exit;
	}
	function register($ref_code = '')
	{
		//$this->MemLogged();
		if ($this->input->post()) {
			$res = array();
			$res['hide_msg'] = 0;
			$res['scroll_to_msg'] = 0;
			$res['frm_reset'] = 0;
			$res['status'] = 0;
			$res['redirect_url'] = 0;

			$this->form_validation->set_rules('fname', 'First Name', 'required');
			$this->form_validation->set_rules('lname', 'Last Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			//$this->form_validation->set_rules('phone','Phone','required|integer|min_length[10]|max_length[10]',array('integer'=>'Please enter valid US phone number','min_length'=>'Please enter valid US phone number','max_length'=>'Please enter valid US phone number'));
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'required|matches[password]');
			//$this->form_validation->set_rules('hear_about','Hear About','required');
			//$this->form_validation->set_rules('confirm','Confirm','required',array('required'=>'Please accept our terms and conditions'));
			if ($this->form_validation->run() === FALSE) {
				$res['msg'] = validation_errors();
			} else {
				$post = html_escape($this->input->post());
				$mem_row = $this->member_model->emailExists($post['email']);
				if (count($mem_row) == '0') {
					if ($this->member_model->phoneExists($post['phone'])) {
						$res['msg'] = showMsg('error', 'Phone Already In Use!');
						exit(json_encode($res));
					}
					$rando = doEncode(rand(99, 999) . '-' . $post['email']);
					$rando = strlen($rando) > 225 ? substr($rando, 0, 225) : $rando;

					$mem_referral_code = randCode(6);
					while (true) {
						if (!$this->member_model->get_row($mem_referral_code, 'mem_referral_code'))
							break;
						$mem_referral_code = randCode(6);
					}


					$save_data = array('mem_fname' => ucfirst($post['fname']), 'mem_lname' => ucfirst($post['lname']), 'mem_email' => $post['email'], 'mem_phone' => $post['phone'], 'mem_pswd' => doEncode($post['password']), 'mem_code' => $rando, 'mem_type' => 'student', 'mem_status' => 1, 'mem_hear_about' => $post['hear_about'], 'mem_last_login' => date('Y-m-d h:i:s'), 'mem_referral_code' => $mem_referral_code);

					/*$this->load->library('my_braintree');
					$save_data['mem_braintree_id']=$this->my_braintree->create_customer(array('firstName' => ucfirst($post['fname']),'lastName' => ucfirst($post['lname']),'email' => $post['email'],'phone' => $post['phone']));*/

					$this->load->library('my_stripe');
					$save_data['mem_stripe_id'] = $this->my_stripe->save_customer(array('name' => ucfirst($post['fname']) . ' ' . ucfirst($post['lname']), 'email' => $post['email'], 'phone' => $post['phone'], "description" => "Crainly Customer " . ucfirst($post['fname']) . ' ' . ucfirst($post['lname'])));

					$mem_id = $this->member_model->save($save_data);



					$this->session->set_userdata('mem_id', $mem_id);
					$this->session->set_userdata('mem_type', 'student');
					$mem_row = '';
					if (!empty($ref_code)) {
						$mem_row = $this->member_model->get_row($ref_code, 'mem_referral_code');
						$ref_signup_data_first = array('mem_id' => $mem_id, 'ref_mem_id' => $mem_row->mem_id, 'reward' => 10, 'first_lesson_off' => 1, 'coupon_id' => $ref_code);
						$this->master->save("ref_signups", $ref_signup_data_first);
					}
					if (!empty($mem_row)) {
						$txt = "Your friend " . ucfirst($post['fname']) . " " . ucfirst($post['lname']) . " signed up with your referral link. You will be rewarded with (coupon ID) after they complete their first lesson.";

						$emailto = $mem_row->mem_email;
						//$emailto = 'jeremiah@crainly.com';
						$subject = 'Notification';
						$headers = "MIME-Version: 1.0\r\n";
						$headers .= "Content-type: text/html;charset=utf-8\r\n";
						$headers .= "From: support@crainly.com" . "\r\n";
						//$headers .= "Reply-To: '" . $settings->site_name . " <" . $settings->site_email . ">" . "\r\n";

						$this->data['email_body'] = $msg_body;
						$this->data['email_subject'] = $txt;
						$ebody = $this->load->view('includes/email_template', $this->data, TRUE);
						sendgrid($emailto, $subject, $ebody, $headers);

						save_notificaiton($mem_row->mem_id, $mem_id, $txt);
					}

					$res['msg'] = showMsg('success', getSiteText('alert', 'registration'));

					/*$verify_link = site_url('verification/' .$rando);
					$mem_data=array('name'=>ucfirst($post['fname']).' '.ucfirst($post['lname']),"email"=>$post['email'],"link"=>$verify_link);
					$this->send_site_email($mem_data,'signup');*/

					// $this->send_signup_email($mem_id);

					$row = $this->member_model->authenticate($post['email'], $post['password']);
					if (count($row) > 0) {
						if ($row->mem_status == 0) {
							$res['msg'] = showMsg('error', 'Your account is currently under review. We will email you when your account is active.');
							exit(json_encode($res));
						}

						$remember_token = '';
						if (isset($data['remeberMe'])) {
							$remember_token = doEncode('member-' . $row->mem_id);
							$cookie = array('name'   => 'remember', 'value'  => $remember_token, 'expire' => (86400 * 7));
							$this->input->set_cookie($cookie);
						}

						$this->member_model->update_last_login($row->mem_id, $remember_token);
						$this->session->set_userdata('mem_id', $row->mem_id);
						$this->session->set_userdata('mem_type', $row->mem_type);

						// $url=$this->session->mem_type=='student'?'account-settings':'dashboard';
						//$res['redirect_url']=empty($this->session->redirect_url)?site_url('my-lessons'):$this->session->redirect_url;
						$id = $this->session->mem_id;
						$this->data['rows'] = $this->payment_methods_model->get_methods($id);
						$res['redirect_url'] = site_url('my-lessons');


						//$this->session->unset_userdata('redirect_url');

						$res['msg'] = showMsg('success', 'Login successful! Please wait.');

						$res['status'] = 1;
						$res['frm_reset'] = 1;
						$res['hide_msg'] = 1;

						$data = array();
						$link = base_url("login") . "?email=" . urlencode($row->mem_email) . "&password=" . urlencode(doDecode($row->mem_pswd));
						$emailto = $row->mem_email;
						$data['email_subject'] = 'Welcome!';
						// $data['name'] = $get_row->mem_fname ? $get_row->mem_fname : 'there';
						$data['loginlink'] = $link;
                        sendgridWithTemplate($emailto, $data['email_subject'], Signup_template_id, [
                            'appname' => 'Crainly',
                            'help_link' => site_url('contact-us/')
                        ]);
					} else {

						$res['redirect_url'] = site_url('login');
						$res['status'] = 1;
						$res['frm_reset'] = 1;
					}
				} else {
					$res['msg'] = showMsg('error', 'E-mail Address Already In Use!');
				}
			}
			exit(json_encode($res));
		} else {
			$mem_row = $this->member_model->get_row($ref_code, 'mem_referral_code');
			$this->data['ref_code'] = $ref_code;
			$this->data['ref_name'] = $mem_row->mem_fname;
			$this->data['register_content'] = $this->master->getRow('sitecontent', array('type' => 'signup'));
			$this->data['register_content'] = unserialize($this->data['register_content']->code);
			$this->load->view("account/register", $this->data);
		}
	}

	function tutor_register($ref_code = '')
	{

		if ($this->input->get('code', TRUE)) 
		{
			$code = $this->input->get('code', TRUE);
			$ch = curl_init();
			$curlConfig = array(
				CURLOPT_URL            => "https://connect.stripe.com/oauth/token",
				CURLOPT_POST           => true,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_POSTFIELDS     => array(
					'client_secret' => API_SECRET_KEY,
					'code' => $code,
					'grant_type' => 'authorization_code',
				)
			);
			curl_setopt_array($ch, $curlConfig);
			$result = curl_exec($ch);
			curl_close($ch);

			$result_decode = json_decode($result);
			$mem_id = $this->session->mem_id;
			$save_data = array('stripe_customer_id' => $result_decode->stripe_user_id, 'mem_id' => $mem_id);
			$payment_id = $this->payment_methods_model->save($save_data);

			$update_column = array('mem_stripe_id' => $result_decode->stripe_user_id);
			$this->member_model->save($update_column, 'mem_id', $mem_id);

			//create custom account for stripe connect
			/*$get_data = $this->master->getRow('members', array('mem_id' => $mem_id));
			$get_connect_custom_id = $this->my_stripe->stripe_connect_custom($get_data->mem_email, $get_data);
			$save_custom_data = array('stripe_connect_custom_id' => $get_connect_custom_id->id);
			$this->payment_methods_model->save($save_custom_data, 'id', $payment_id);*/

			redirect('my-lessons');
		}

		//$this->MemLogged();
		if ($this->input->post()) 
		{
			$res = array();
			$res['hide_msg'] = 0;
			$res['scroll_to_msg'] = 0;
			$res['frm_reset'] = 0;
			$res['status'] = 0;
			
			$this->form_validation->set_rules('fname', 'First Name', 'required');
			$this->form_validation->set_rules('lname', 'Last Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('phone', 'Phone', 'integer|min_length[10]|max_length[10]', array('integer' => 'Please enter valid US phone number', 'min_length' => 'Please enter valid US phone number', 'max_length' => 'Please enter valid US phone number'));
			$this->form_validation->set_rules('password', 'Password', 'required');
			
			if ($this->form_validation->run() === FALSE) {
				$res['msg'] = validation_errors();
				//$res['scroll_to_msg'] = 1;
			} else {
				$post = html_escape($this->input->post());
				$mem_row = $this->member_model->emailExists($post['email']);
				
				$emailAlready = false;
				if ( count($mem_row) > 0 ) {
					// Check tutor profile 100% completed
					if ( $mem_row->is_profile_complete ) {
						$emailAlready = true;
					} else {
						// Delete fake/old member detail
						$memberDelete = $this->master->delete('members','mem_id', $mem_row->mem_id);
					}
				}

				if ( !$emailAlready ) {
					$rando = doEncode(rand(99, 999) . '-' . $post['email']);
					$rando = strlen($rando) > 225 ? substr($rando, 0, 225) : $rando;

					$mem_referral_code = randCode(6);
					while (true) {
						if (!$this->member_model->get_row($mem_referral_code, 'mem_referral_code'))
							break;
						$mem_referral_code = randCode(6);
					}
					$arr = array('mem_fname' => ucfirst($post['fname']), 'mem_lname' => ucfirst($post['lname']), 'mem_email' => $post['email'], 'mem_phone' => $post['phone'], 'mem_pswd' => doEncode($post['password']), 'mem_code' => $rando, 'mem_type' => 'tutor', 'mem_status' => 0, 'mem_hear_about' => $post['hear_about'], 'mem_last_login' => date('Y-m-d h:i:s'), 'mem_referral_code' => $mem_referral_code, 'mem_tutor_application' => 1);

					$mem_id = $this->member_model->save($arr);
					$this->session->set_userdata('id', $mem_id);
					$this->session->set_userdata('mem_email', $post['email']);

					//for new reference

					/*if(!empty($mem_row)) {
						$ref_signup_data = array('mem_id' => $mem_row->mem_id, 'ref_mem_id' => $mem_id, 'reward'=>10);
						$this->master->save("ref_signups",$ref_signup_data);
					}*/

					/*$mem_row = $this->member_model->get_row($ref_code, 'mem_referral_code');
					if(!empty($mem_row)) {

						$ref_signup_data = array('mem_id' => $mem_row->mem_id, 'ref_mem_id' => $mem_id, 'reward'=>10, 'coupon_id' => $mem_referral_code);
						$this->master->save("ref_signups",$ref_signup_data);

						$txt = "Your friend ".ucfirst($post['fname'])." ".ucfirst($post['lname'])." signed up with your referral link. You will be rewarded with (coupon ID) after they complete their first lesson.";

						$emailto = $mem_row->mem_email;
						//$emailto = 'jeremiah@crainly.com';
						$subject = 'Notification';
						$headers = "MIME-Version: 1.0\r\n";
						$headers .= "Content-type: text/html;charset=utf-8\r\n";
						$headers .= "From: support@crainly.com". "\r\n";
						//$headers .= "Reply-To: '" . $settings->site_name . " <" . $settings->site_email . ">" . "\r\n";

						$this->data['email_body'] = $msg_body;
						$this->data['email_subject'] = $txt;
						$ebody = $this->load->view('includes/email_template', $this->data, TRUE);
						sendgrid($emailto, $subject, $ebody, $headers);

						save_notificaiton($mem_row->mem_id, $mem_id, $txt);
					}*/

					//$res['msg'] = showMsg('success',getSiteText('alert','registration'));
					$res['msg'] = '';

					/*$verify_link = site_url('verification/' .$rando);
					$mem_data=array('name'=>ucfirst($post['fname']).' '.ucfirst($post['lname']),"email"=>$post['email'],"link"=>$verify_link);
					$this->send_site_email($mem_data,'signup');*/

					// $this->send_signup_email($mem_id);

					$res['redirect_url'] = site_url('tutor-multi-signup');
					$res['status'] = 1;
					$res['frm_reset'] = 1;
					$res['mem_id'] = $mem_id;
				} else {
					$res['msg'] = showMsg('error', 'E-mail Address Already In Use!');
				}
			}
			print_r(json_encode($res));
		} else {
			$this->data['register_content'] = $this->master->getRow('sitecontent', array('type' => 'tutor_signup'));
			$this->data['register_content'] = unserialize($this->data['register_content']->code);
			$this->load->view("account/register-tutor", $this->data);
		}
	}

	function stripe_success()
	{
		if ($this->input->get('code', TRUE)) {
			$code = $this->input->get('code', TRUE);
			$ch = curl_init();
			$curlConfig = array(
				CURLOPT_URL            => "https://connect.stripe.com/oauth/token",
				CURLOPT_POST           => true,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_POSTFIELDS     => array(
					//				    'client_secret' => 'sk_live_rTVRdilRTzJsaMyBiaHbOkJq00w5ADsUyP',
					'client_secret' => API_SECRET_KEY,
					'code' => $code,
					'grant_type' => 'authorization_code',
				)
			);
			curl_setopt_array($ch, $curlConfig);
			$result = curl_exec($ch);
			curl_close($ch);

			$result_decode = json_decode($result);
			$mem_id = $this->session->mem_id;
			$save_data = array('stripe_customer_id' => $result_decode->stripe_user_id, 'mem_id' => $mem_id);
			$payment_id = $this->payment_methods_model->save($save_data);

			$update_column = array('mem_stripe_id' => $result_decode->stripe_user_id);
			$this->member_model->save($update_column, 'mem_id', $mem_id);

			//create custom account for stripe connect
			/*$get_data = $this->master->getRow('members', array('mem_id' => $mem_id));
			$get_connect_custom_id = $this->my_stripe->stripe_connect_custom($get_data->mem_email, $get_data);
			$save_custom_data = array('stripe_connect_custom_id' => $get_connect_custom_id->id);
			$this->payment_methods_model->save($save_custom_data, 'id', $payment_id);*/

			redirect('my-lessons');
		}

		//$this->MemLogged();
		if ($this->input->post()) {
			$res = array();
			$res['hide_msg'] = 0;
			$res['scroll_to_msg'] = 0;
			$res['frm_reset'] = 0;
			$res['status'] = 0;

			$this->form_validation->set_rules('fname', 'First Name', 'required');
			$this->form_validation->set_rules('lname', 'Last Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('phone', 'Phone', 'required|integer|min_length[10]|max_length[10]', array('integer' => 'Please enter valid US phone number', 'min_length' => 'Please enter valid US phone number', 'max_length' => 'Please enter valid US phone number'));
			$this->form_validation->set_rules('password', 'Password', 'required');
			//$this->form_validation->set_rules('hear_about','Hear About','required');
			//$this->form_validation->set_rules('confirm','Confirm','required',array('required'=>'Please accept our terms and conditions'));
			if ($this->form_validation->run() === FALSE) {
				$res['msg'] = validation_errors();
			} else {
				$post = html_escape($this->input->post());
				$mem_row = $this->member_model->emailExists($post['email']);
				if (count($mem_row) == '0') {
					if ($this->member_model->phoneExists($post['phone'])) {
						$res['msg'] = showMsg('error', 'Phone Already In Use!');
						exit(json_encode($res));
					}
					$rando = doEncode(rand(99, 999) . '-' . $post['email']);
					$rando = strlen($rando) > 225 ? substr($rando, 0, 225) : $rando;

					$mem_referral_code = randCode(6);
					while (true) {
						if (!$this->member_model->get_row($mem_referral_code, 'mem_referral_code'))
							break;
						$mem_referral_code = randCode(6);
					}
					$arr = array('mem_fname' => ucfirst($post['fname']), 'mem_lname' => ucfirst($post['lname']), 'mem_email' => $post['email'], 'mem_phone' => $post['phone'], 'mem_pswd' => doEncode($post['password']), 'mem_code' => $rando, 'mem_type' => 'tutor', 'mem_status' => 0, 'mem_hear_about' => $post['hear_about'], 'mem_last_login' => date('Y-m-d h:i:s'), 'mem_referral_code' => $mem_referral_code, 'mem_tutor_application' => 1);

					$mem_id = $this->member_model->save($arr);
					$this->session->set_userdata('id', $mem_id);
					$this->session->set_userdata('mem_email', $post['email']);

					$res['msg'] = '';

					$res['redirect_url'] = site_url('tutor-multi-signup');
					$res['status'] = 1;
					$res['frm_reset'] = 1;
					$res['mem_id'] = $mem_id;
				} else {
					$res['msg'] = showMsg('error', 'E-mail Address Already In Use!');
				}
			}
			print_r(json_encode($res));
		} else {
			$this->data['register_content'] = $this->master->getRow('sitecontent', array('type' => 'tutor_signup'));
			$this->data['register_content'] = unserialize($this->data['register_content']->code);
			$this->load->view("account/register-tutor", $this->data);
		}
	}
	function tutor_multi_signup()
	{
		//$this->MemLogged();
		
		$subject = $this->master->getRows('subjects', array('parent_id' => '0'));
		
		foreach($subject as $sub)
		{
			$subsubject = $this->master->getRows('subjects', array('parent_id =' => $sub->id));
			
			$sub->subcatcount = count($subsubject);
		}
		
		$this->data['subjects'] = $subject;
		$this->data['sub_subjects'] = $this->master->getRows('subjects', array('parent_id !=' => '0'));
		
		if ($this->input->post()) 
		{
			$res = array();
			$res['hide_msg'] = 0;
			$res['scroll_to_msg'] = 0;
			$res['frm_reset'] = 0;
			$res['status'] = 0;

			$post = html_escape($this->input->post());
			$subjects = [];
			foreach($subject as $key => $value) {
				$sub_subjects = null;
				$loop = 0;
				if (!empty($post['sub_' . $value->id . ''])) {

					$tblTutorSubjects = array('mem_id' => $this->session->userdata('id'), 'parent_id' => '0', 'subject_id' => $value->id, 'type' => 'main');
					$this->master->save('tutor_subjects', $tblTutorSubjects);
					foreach ($post['sub_' . $value->id . ''] as $k => $val) {
						$tblTutorSubjects = array('mem_id' => $this->session->userdata('id'), 'parent_id' => $value->id, 'subject_id' => $val, 'type' => 'sub');
						$this->master->save('tutor_subjects', $tblTutorSubjects);
						$sub_subject = $this->master->getRow('subjects', array('parent_id' => $value->id, 'id' => $val));
						$sub_subjects[$loop] = $sub_subject->name;
						$loop++;
					}
				}
				$subjects[$value->name] = $sub_subjects;
			}

			$subjects = json_encode($subjects);
			//$Education = array('college' => $post['college'], 'major' => $post['major'], 'grad_year' => $post['grad_year']);
			//$Education = json_encode($Education);
			
			$Education = json_decode(html_entity_decode($post['education']), true);
			$workExperiences = json_decode(html_entity_decode($post['workExperiences']), true);
			if($_FILES['profile_photo']['name'] != "") {
				$image = upload_vfile('profile_photo');
				if (!empty($image['file_name'])) {
					$data['mem_image'] = $image['file_name'];
				}
			}

			$week_days = get_week_days();
			foreach ($week_days as $day_key => $day) {
				$available = 1;
				$start_time = '';
				$end_time = '';
				$this->master->save('tutor_timings', array('mem_id' => $this->session->userdata('id'), 'day' => $day, 'start_time' => $start_time, 'end_time' => $end_time, 'available' => $available));
			}
			$mem_row = $this->session->userdata('id');
			if ($mem_row != '0') {
				/*if(!empty($post['stripeToken']))
				{
					try
					{
						require_once('application/libraries/stripe-php/init.php');

						\Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));

						\Stripe\Charge::create ([
								"amount" => 100 * 100,
								"currency" => "usd",
								"source" => $post['stripeToken'],
								"description" => "Test payment from crainly.com."
						]);
					} catch (Exception $e) {
						 var_dump($e->getMessage());
					}
				}*/
				$where = array('name' => $post['country']);
				$get_row = $this->member_model->get_row_where($where, 'countries');
				if (isset($get_row))
					$arr = array('mem_subjects' => $subjects/*, 'mem_education' => $Education*/, 'mem_type' => 'tutor', 'mem_status' => 0, 'mem_hear_about' => $post['hear_about'], 'mem_last_login' => date('Y-m-d h:i:s'), 'mem_hourly_rate' => $post['hourly_rate'], 'mem_address1' => $post['address'], 'mem_address2' => $post['address2'], 'mem_travel_radius' => $post['travel_radius'], 'mem_cancel_policy' => $post['selectCancelPolicy'], 'mem_profile_heading' => $post['profile_headline'], 'mem_image' => $data['mem_image'], 'mem_bio' => $post['bio'], 'mem_about' => $post['bio'], 'mem_street' => $post['street'], 'mem_city' => $post['city'], 'mem_state_id' => $post['state'], 'mem_zip' => $post['zip'], 'mem_country_id' => $get_row->id, 'mem_graduation_year' => $post['grad_year'], 'mem_major_subject' => $post['major'], 'mem_school_name' => $post['college'], 'mem_map_lat' => $post['txtLatitude'], 'mem_map_lng' => $post['txtLongitude'], 'mem_onlinelesson' => $post['onlinelesson'],'highest_level_of_education' => $post['highest_level_of_education']);
				else
					$arr = array('mem_subjects' => $subjects/*, 'mem_education' => $Education*/, 'mem_type' => 'tutor', 'mem_status' => 0, 'mem_hear_about' => $post['hear_about'], 'mem_last_login' => date('Y-m-d h:i:s'), 'mem_hourly_rate' => $post['hourly_rate'], 'mem_address1' => $post['address'], 'mem_address2' => $post['address2'], 'mem_travel_radius' => $post['travel_radius'], 'mem_cancel_policy' => $post['selectCancelPolicy'], 'mem_profile_heading' => $post['profile_headline'], 'mem_image' => $data['mem_image'], 'mem_bio' => $post['bio'], 'mem_about' => $post['bio'], 'mem_street' => $post['street'], 'mem_city' => $post['city'], 'mem_state_id' => $post['state'], 'mem_zip' => $post['zip'], 'mem_graduation_year' => $post['grad_year'], 'mem_major_subject' => $post['major'], 'mem_school_name' => $post['college'], 'mem_map_lat' => $post['txtLatitude'], 'mem_map_lng' => $post['txtLongitude'], 'mem_onlinelesson' => $post['onlinelesson'],'highest_level_of_education' => $post['highest_level_of_education']);
				$arr['mem_school_name'] = '';
				$arr['is_profile_complete'] = 1;
				$arr['mem_sex'] = strtolower($post['gender']);
				if (!$arr['mem_travel_radius']) {
						$arr['mem_travel_radius'] = null;
				} 
				$mem_id = $this->member_model->save($arr, 'mem_id', $mem_row);
				if ( $mem_id != '' && $mem_id != 0 ) {
					// Insert Education
					if ( count($Education) > 0 ) {
						foreach ($Education as $edu) {
							$edu['mem_id'] = $mem_id;
							$edu['study_field'] = $edu['studyField'];
							$edu['from_year'] = $edu['fromYear'];
							$edu['to_year'] = $edu['toYear'];
							unset($edu['studyField']);
							unset($edu['fromYear']);
							unset($edu['toYear']);
							unset($edu['addmorecount']);
							$m_edu_id = $this->member_educations_model->save($edu);
						}
					}
					
					// Insert Work Experiences
					if ( count($workExperiences) > 0 ) {
						foreach ($workExperiences as $exp) {
							$exp['mem_id'] = $mem_id;
							$exp['company_name'] = $exp['name'];
							$exp['from_month'] = $exp['fromMonth'];
							$exp['from_year'] = $exp['fromYear'];
							$exp['to_month'] = $exp['toMonth'];
							$exp['to_year'] = $exp['toYear'];
							unset($exp['name']);
							unset($exp['fromMonth']);
							unset($exp['fromYear']);
							unset($exp['toMonth']);
							unset($exp['toYear']);
							$m_exp_id = $this->member_experiences_model->save($exp);
						}
					}	
				}
				//$this->session->set_userdata('mem_id', $mem_id);
				//$this->session->set_userdata('mem_type', 'tutor');

				/*It's for user*/
				/*$res['msg'] = showMsg('success',getSiteText('alert','multi_register_user'));

					$emailto =  $this->session->userdata('mem_email');
					$subject = 'Notification';
					$headers = "MIME-Version: 1.0\r\n";
					$headers .= "Content-type: text/html;charset=utf-8\r\n";
					$headers .= "From: support@crainly.com". "\r\n";
					//$headers .= "Reply-To: '" . $settings->site_name . " <" . $settings->site_email . ">" . "\r\n";

					$this->data['email_body'] = $msg_body;
					$this->data['email_subject'] = $subject;
					$ebody = $this->load->view('includes/email_template', $this->data, TRUE);
					sendgrid($emailto, $subject, $ebody, $headers);*/

				/* this is for admin */
				$link = "<a href='https://crainly.com/admin/tutors/inactive/" . $mem_row . "''> </a>";
				$link_active = "<a href='https://crainly.com/admin/tutors/manage/" . $mem_row . "''>View Profile</a>";
				$msg_body = "A new tutor has registered. Click here to approve their profile: " . $link . "  " . $link_active . "";

				//$emailto = 'jeremiahbus1@gmail.com';
				$emailto = 'support@crainly.com'; //'support@crainly.com';
				$subject = 'Notification';
				$headers = "MIME-Version: 1.0\r\n";
				$headers .= "Content-type: text/html;charset=utf-8\r\n";
				$headers .= "From: support@crainly.com" . "\r\n";
				//$headers .= "Reply-To: '" . $settings->site_name . " <" . $settings->site_email . ">" . "\r\n";

				$this->data['email_body'] = $msg_body;
				$this->data['email_subject'] = $subject;
				$ebody = $this->load->view('includes/email_template', $this->data, TRUE);
				sendgrid($emailto, $subject, $ebody, $headers);



				$res['msg'] = showMsg('success', 'Your registration is complete and our team will review your application and get back to you shortly');
				$this->session->set_flashdata('success', getSiteText('alert', 'multi_register_user'));
				$_SESSION['tutor-review'] = true;
				$res['redirect_url'] = site_url('/');
				$res['status'] = 1;
				$res['frm_reset'] = 1;

				redirect('/');
			} else {
				$res['msg'] = showMsg('error', 'Register First!');
			}
			print_r(json_encode($res));

			//print_r(json_encode($res));
			exit();
		} else {
			$this->data['register_content'] = $this->master->getRow('sitecontent', array('type' => 'tutor_signup'));
			$this->data['register_content'] = unserialize($this->data['register_content']->code);
			$this->load->view("account/multi-signup-form", $this->data);
		}
	}
	
	function become_tutor()
	{
		//$this->isMemLogged('tutor',true,false);
		if ($this->data['mem_data']->mem_type == 'tutor') {
			if ($this->data['mem_data']->mem_tutor_application > 0) {
				if (empty($this->data['mem_data']->mem_stripe_id)) {
					redirect('stripe-register');
					exit;
				} else {
					redirect('my-lessons');
					exit;
				}
			}
		}

		if ($this->input->post()) {
			$res = array();
			$res['hide_msg'] = 1;
			$res['scroll_to_msg'] = 0;
			$res['status'] = 0;
			$res['frm_reset'] = 0;
			$res['redirect_url'] = 0;

			$this->form_validation->set_message('integer', 'Please select a valid {field}');
			$this->form_validation->set_rules('fname', 'First Name', 'required|alpha');
			$this->form_validation->set_rules('lname', 'Last Name', 'required|alpha');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('phone', 'Phone', 'required');
			$this->form_validation->set_rules('subject', 'Subject', 'required|integer');
			$this->form_validation->set_rules('subjects[]', 'Subjects', 'required|integer');
			$this->form_validation->set_rules('hourly_rate', 'Hourly Rate', 'required|integer', array('integer' => 'Please enter valid {field}'));
			$this->form_validation->set_rules('school_name', 'School Name', 'required');
			$this->form_validation->set_rules('major_subject', 'Major Subject', 'required');
			$this->form_validation->set_rules('graduation_year', 'Graduation Year', 'required|integer', array('integer' => "Please enter valid year"));
			$this->form_validation->set_rules('travel_radius', 'Travel Radius', 'required|integer', array('integer' => 'Please enter valid {field}'));
			$this->form_validation->set_rules('zip', 'Zip Code', 'required');
			$this->form_validation->set_rules('address', 'Address', 'required');
			$this->form_validation->set_rules('dob', 'Date of Birth', 'required');
			/*$this->form_validation->set_rules('ssn','SSN','required');
			$this->form_validation->set_rules('driver_license_number','Drivering License Number','required');
			$this->form_validation->set_rules('driver_license_state','Drivering Lisence State','required');*/
			// $this->form_validation->set_rules('referral_code','Referral Code','required');
			$this->form_validation->set_rules('hear_about', 'Hear About', 'required');

			$this->form_validation->set_rules('map_lat', 'Location', 'required|numeric', array('required' => 'Please mark your {field}', 'numeric' => 'Please mark your {field}'));
			$this->form_validation->set_rules('map_lng', 'Location', 'required|numeric', array('required' => 'Please mark your {field}', 'numeric' => 'Please mark your {field}'));

			$this->form_validation->set_rules('profile_heading', 'Profile Headline', 'required');
			$this->form_validation->set_rules('profile_bio', 'Profile Bio', 'required');

			$this->form_validation->set_rules('confirm', 'Confirm', 'required', array('required' => 'Please accept our terms and conditions'));

			if ($this->form_validation->run() === FALSE) {
				$res['msg'] = validation_errors();
			} else {
				$post = html_escape($this->input->post());


				if ($this->member_model->emailExists($post['email'], $this->session->mem_id)) {
					$res['msg'] = showMsg('error', 'Email already in use, Please try another!');
					exit(json_encode($res));
				}

				if ($this->member_model->phoneExists($post['phone'], $this->session->mem_id)) {
					$res['msg'] = showMsg('error', 'Email already in use, Please try another!');
					exit(json_encode($res));
				}


				if (!$this->master->getRow('subjects', array('id' => $post['subject'], 'parent_id' => 0))) {
					$res['msg'] = showMsg('error', 'Please select a valid Subject!');
					exit(json_encode($res));
				}

				if (count($post['subjects']) < 1 && min($post['subjects']) < 1) {
					$res['msg'] = showMsg('error', 'Please select at-least one Subject!');
					exit(json_encode($res));
				}

				foreach ($post['subjects'] as $sub_id) {
					if (!$this->master->getRow('subjects', array('id' => $sub_id, 'parent_id' => $post['subject']))) {
						$res['msg'] = showMsg('error', 'Please select a valid Subjects!');
						exit(json_encode($res));
					}
				}


				if (count($post['days']) != count($post['start_time']) || count($post['start_time']) != count($post['end_time'])) {
					$res['msg'] = showMsg('error', 'Inconsistent data of availability!');
					exit(json_encode($res));
				}

				$data = array('mem_tutor_application' => 1, 'mem_fname' => ucfirst($post['fname']), 'mem_lname' => ucfirst($post['lname']), 'mem_profile_heading' => ucfirst($post['profile_heading']), 'mem_about' => ucfirst($this->input->post('profile_bio')), 'mem_hourly_rate' => floatval($post['hourly_rate']), 'mem_school_name' => ucfirst($post['school_name']), 'mem_major_subject' => ucfirst($post['major_subject']), 'mem_graduation_year' => intval($post['graduation_year']), 'mem_travel_radius' => floatval($post['travel_radius']), 'mem_address1' => ucfirst($post['address']), 'mem_map_lat' => $post['map_lat'], 'mem_map_lng' => $post['map_lng'], 'mem_hear_about' => $post['hear_about'], 'mem_referral_code' => $post['referral_code'], 'mem_zip' => $post['zip'], 'mem_dob' => db_format_date($post['dob'])/*,'mem_ssn'=>$post['ssn'],'mem_ssn'=>$post['ssn'],'mem_driver_license_number'=>$post['driver_license_number'],'mem_driver_license_state'=>$post['driver_license_state']*/);

				if ($post['phone'] != $this->data['mem_data']->mem_phone) {
					$data['mem_phone'] = trim($post['phone']);
					$data['mem_verified'] = 0;
				}

				if ($_FILES['image']['name'] != "") {
					$image = upload_vfile('image');
					if (!empty($image['file_name']))
						$data['mem_image'] = $image['file_name'];
				}

				$this->master->delete('tutor_subjects', 'mem_id', $this->session->mem_id);
				foreach ($post['subjects'] as $sub_id) {
					$this->master->save('tutor_subjects', array('mem_id' => $this->session->mem_id, 'subject_id' => $sub_id, 'type' => 'sub'));
				}
				$this->master->save('tutor_subjects', array('mem_id' => $this->session->mem_id, 'subject_id' => $post['subject'], 'type' => 'main'));

				$this->master->delete('tutor_timings', 'mem_id', $this->session->mem_id);
				$week_days = get_week_days();
				foreach ($week_days as $day_key => $day) {
					$available = $post['days'][$day_key] != '' ? 1 : 0;
					$start_time = $post['start_time'][$day_key] ? get_full_time($post['start_time'][$day_key]) : '';
					$end_time = $post['end_time'][$day_key] ? get_full_time($post['end_time'][$day_key]) : '';

					$this->master->save('tutor_timings', array('mem_id' => $this->session->mem_id, 'day' => $day, 'start_time' => $start_time, 'end_time' => $end_time, 'available' => $available));
				}

				if ($this->data['mem_data']->mem_email != $post['email']) {
					$rando = doEncode($this->session->mem_id . '-' . $post['email']);
					$data['mem_code'] = $rando;
					$data['mem_verified'] = 0;

					/*$verify_link = site_url('verification/' .$rando);

				$mem_data=array('name'=>ucwords($post['fname'].' '.$post['lname']),"email"=>$post['email'],"link"=>$verify_link);
				$this->send_site_email($mem_data,'change_email');
				setMsg('info',getSiteText('alert','verify_email'))*/;
				}


				$this->member_model->save($data, $this->session->mem_id);
				// $this->session->set_userdata('mem_type','tutor');

				$res['redirect_url'] = site_url('my-lessons');
				$res['msg'] = showMsg('success', 'Your became a tutor application sent successfully. Wait for Approval');
				$res['status'] = 1;
				$res['hide_msg'] = 0;
			}
			exit(json_encode($res));
		} else {
			$this->load->view("account/become-a-tutor", $this->data);
		}
	}

	function stripe_register()
	{
		$this->data['login_content'] = $this->master->getRow('sitecontent', array('type' => 'login'));
		$this->data['login_content'] = unserialize($this->data['login_content']->code);
		$this->load->view('account/stripe-register', $this->data);
	}

	function logout()
	{

		$this->session->unset_userdata('mem_id');
		$this->session->unset_userdata('mem_type');
		$this->session->unset_userdata('redirect_url');
		$this->session->unset_userdata('mem_email');
		$this->load->helper('cookie');
		delete_cookie('remember');
		// $this->login();
		redirect('', 'refresh');
		exit;
	}

	function forgot()
	{
		$this->MemLogged();
		if ($this->input->post()) {
			$res = array();
			$res['hide_msg'] = 0;
			$res['scroll_to_msg'] = 0;
			$res['status'] = 0;
			$res['frm_reset'] = 0;
			$res['redirect_url'] = 0;

			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			if ($this->form_validation->run() === FALSE) {
				$res['msg'] = validation_errors();
				$res['status'] = 0;
			} else {
				$post = $this->input->post();
				if ($mem = $this->member_model->forgotEmailExists($post['email'])) {
					// $settings = $this->data['site_settings'];
					$rando = doEncode(randCode(rand(15, 20)));
					$this->master->save('members', array('mem_code' => $rando), 'mem_id', $mem->mem_id);

					$reset_link = site_url('reset/' . $rando);

					$data = array();
					$emailto = $mem->mem_email;
					$data['email_subject'] = 'Trouble Signing In?';
					$data['name'] = $mem->mem_fname . ' ' . $mem->mem_lname;
					$data['need_help'] = true;
					sendgridWithTemplate($emailto, $data['email_subject'], Password_rest_template, [
                        'appname' => 'Crainly',
                        'reset_password' => $reset_link,
                        'help_link' => site_url('contact-us/')
                    ]);

					/*$reset_link = site_url('reset/' . $rando);
					$msg_body = "
					<h4 style='text-align:left;padding:0px 20px;margin-bottom:0px;'>Dear " . $mem->mem_fname . ' ' . $mem->mem_lname . ",</h4>
					<p style='text-align:left;padding:5px 20px;'>" . getSiteText('email', 'forgot_password') . "</p>
					<p style='text-align:left;padding:5px 20px;'><a href='$reset_link'>$reset_link</a></p>";

					$emailto = $mem->mem_email;
					$subject = $settings->site_name." - ".getSiteText('email', 'forgot_password','subject');
					$headers = "MIME-Version: 1.0\r\n";
					$headers .= "Content-type: text/html;charset=utf-8\r\n";
					$headers .= "From: " . $settings->site_name . " <" . $settings->site_email . ">" . "\r\n";
					$headers .= "Reply-To: '" . $settings->site_name . " <" . $settings->site_email . ">" . "\r\n";

					$this->data['email_body'] = $msg_body;
					$this->data['email_subject'] = $subject;
					$ebody = $this->load->view('includes/email_template', $this->data, TRUE);
					sendgrid($emailto, $subject, $ebody, $headers);*/

					$res['msg'] = showMsg('success', 'We’ve sent a reset password link to the email address you entered to reset your password. If you don’t see the email, check your spam folder or email!');


					$res['status'] = 1;
					$res['frm_reset'] = 1;
				} else {
					$res['msg'] = showMsg('error', 'No such email address exists. Please try again!');
					$res['status'] = 0;
				}
			}
			exit(json_encode($res));
		} else {
			$this->data['site_content'] = $this->master->getRow('sitecontent', array('type' => 'forgot'));
			$this->data['site_content'] = unserialize($this->data['site_content']->code);
			$this->load->view("account/forgot-password", $this->data);
		}
	}

	function reset_password()
	{
		$reset_id = intval($this->session->userdata('reset_id'));
		if ($row = $this->member_model->getMember($reset_id)) {
			if ($this->input->post()) {
				$res = array();
				$res['hide_msg'] = 0;
				$res['scroll_to_msg'] = 0;
				$res['status'] = 0;
				$res['frm_reset'] = 0;
				$res['redirect_url'] = 0;

				$reset_id = intval($this->session->userdata('reset_id'));
				if ($row = $this->member_model->getMember($reset_id)) {
					$this->form_validation->set_rules('pswd', 'New Password', 'required');
					$this->form_validation->set_rules('cpswd', 'Confirm Password', 'required|matches[pswd]');
					if ($this->form_validation->run() === FALSE) {
						$res['msg'] = validation_errors();
					} else {

						$post = html_escape($this->input->post());

						$this->member_model->save(array('mem_pswd' => doEncode($post['pswd'])), $reset_id);
						$this->session->unset_userdata('reset_id');
						$res['msg'] = showMsg('success', 'You have successfully reset your password!');

						$res['redirect_url'] = site_url('');
						$res['status'] = 1;
						$res['frm_reset'] = 1;
						$res['hide_msg'] = 1;
					}
				} else {
					$res['msg'] = showMsg('error', 'Something is wrong, try again later!');
				}
				exit(json_encode($res));
			} else {
				$this->data['site_content'] = $this->master->getRow('sitecontent', array('type' => 'reset'));
				$this->data['site_content'] = unserialize($this->data['site_content']->code);
				$this->load->view("account/reset-password", $this->data);
			}
		} else {
			redirect('', 'refresh');
			exit;
		}
	}

	function reset($vcode)
	{
		if ($row = $this->member_model->getMemCode($vcode)) {
			$this->member_model->save(array('mem_code' => ''), $row->mem_id);
			$this->session->set_userdata('reset_id', $row->mem_id);
			redirect('reset-password', 'refresh');
			exit;
		} else {
			redirect('', 'refresh');
			exit;
		}
	}

	function verification($vcode = '')
	{
		if ($row = $this->member_model->getMemCode($vcode)) {
			$this->member_model->save(array('mem_email_verified' => 1, 'mem_code' => ''), $row->mem_id);

			// $redirect_url=$this->session->mem_type=='student'?'account-settings':'dashboard';
			redirect('my-lessons', 'refresh');
			exit;
		} else {
			redirect('', 'refresh');
			exit;
		}
	}

	function search()
	{
		
		$subject = $this->master->getRows('subjects', array('parent_id' => '0')); // autocompleted subject
		$subjectjson = array();
		$item['text'] = 'Search Subject';
		$item['id'] = '';
		$item['selected'] = true;
		$subjectjson[0] = $item;
		foreach ($subject as $i => $s) {
			$item = [];
			$item['id'] = $s->name;
			$item['text'] = $s->name;
			$subjectjson[$i + 1] = $item;
		}
		// Setup querystring subject and zip filter
		$this->data['q_subject'] = '';
		$this->data['q_zip'] = '';
		//print_r($_POST);
		//exit;
		if ($post = $this->input->post()) {
			$output = array();
			$output['lstData'] = array();
			$output['paging'] = '';
			$output['total'] = 0;
			$output['per_page'] = 15;
			$output['subject'] = $subjectjson;
			// $output['post'] = $post;
			// exit(json_encode($post));
			$checkTimings = $this->member_model->check_timing($this->session->mem_id);
			$flag = 1;
			if (count($checkTimings) == 0) {
				$flag = 0;
			}
			$rows = $this->member_model->search_members($post, $flag);

			// $output['query']=$this->db->last_query();
			if (count($rows) > 0) {
				$output['total'] = count($rows);
				foreach ($rows as $row) {

					$output['lstData'][] = '
                    <li>
                        <div class="cardBlk tutor-card"  data-href="' . profile_url($row->mem_id, $row->mem_fname . ' ' . $row->mem_lname) . '">
                            <div class="icoBlk">
                                <div class="ico"><img src="' . get_image_src($row->mem_image, '150', true) . '"></div>
                                <h4>' . format_name($row->mem_fname, $row->mem_lname) . '</h4>
                                <div class="rating"><div class="rateYo" data-rateyo-rating="' . get_avg_mem_rating($row->mem_id) . '" data-rateyo-read-only="true"></div><strong>(' . count_mem_reviews($row->mem_id) . ' reviews)</strong></div>
                                <div class="bios" style=" color:#727272">' . $row->mem_about . '</div>

                                <!--span style="text-align:left; height:61px; color:#727272">' . substr($row->mem_about, 0, 85) . '...</span-->
                                <div class="price" style="text-align:center; color:black">$' . $row->mem_hourly_rate . '<small class="semi"> /hour</small></div>
                            </div>
                            <div class="btnBlk" style="display:none"><div  class="webBtn colorBtn">View Profile</div></div>
                        </div>
                    </li>';
				}
				$pagesHtml = '';
				$total = intval($output['total']);
				$per_page = $output['per_page'];
				$pages = ceil($total / $per_page);
				if (intval($pages) > 1) {
					$output['paging'] = '<div  class="webBtn colorBtn">Show More Results</div>';
				}
				// if (intval($pages) > 1):
				//     for ($i = 1; $i <= intval($pages); $i++):
				//         $pagesHtml .= '<li><a ' . (($i == 1) ? 'class="active"' : '') . ' data-page="' . $i . '" href="javascript:void();">' . $i . '</a></li>';
				//     endfor;
				// endif;
				// $output['paging'] = ($pagesHtml) ? '<ul id="searchPaging" class="pagination">' . $pagesHtml . '</ul>' : '';
			}
			exit(json_encode($output));
		} else {
			$getData = $this->input->get();
			if (count($getData) > 0) {
				$this->data['q_subject'] = $getData['subject'];
				$this->data['q_zip'] = $getData['zip'];
			}

			$this->data['site_content'] = $this->master->getRow('sitecontent', array('type' => 'search'));
			$this->data['site_content'] = unserialize($this->data['site_content']->code);

			$this->data['subject'] = $subjectjson;

			$this->data['get'] = $this->input->get();
			$this->data['max_price'] = $this->member_model->get_max_rate();
			// $this->data['max_distance']=$this->member_model->get_max_distance();
			$this->load->view('pages/search', $this->data);
		}
	}

	function search_jobs()
	{
		if ($this->data['mem_data']->mem_type == 'tutor') {
			if ($this->data['mem_data']->mem_tutor_application > 0) {
				if (empty($this->data['mem_data']->mem_stripe_id)) {
					redirect('stripe-register');
					exit;
				}
			}
		}
		//$this->isMemLogged('tutor');
		if ($post = $this->input->post()) {
			$output = array();
			$output['lstData'] = array();
			$output['paging'] = '';
			$output['total'] = 0;
			$output['per_page'] = 15;
			// $output['post'] = $post;
			// exit(json_encode($post));
			$this->load->model('job_model');
			$rows = $this->job_model->search_job($post);
			$output['query'] = $this->db->last_query();
			if (count($rows) > 0) {
				$output['total'] = count($rows);
				foreach ($rows as $row) {

					$output['lstData'][] = '
                    <li>
                        <div class="innerJobList">
                            <div style="width:65px; height:65px;float:left">
                                <div class="ico" ><img src="' . get_image_src($row->mem_image, '150', true) . '">
                                </div>
                                <h4 style="font-size: 13px; text-align: center;margin-top: 10px;">' . format_name($row->mem_fname, $row->mem_lname) . '</h4>
                            </div>
                            <div class="job-meta">
                              <div class="title">
                                 <h4><a href="' . site_url('job-detail/' . $row->encoded_id) . '">
                                    ' . $row->title . '</a>
                                 </h4>
                                 <p>' . short_text($row->detail) . '</p>
                              </div>
                              <div class="meta-info d-flex">
                                 <p><i class="fa fa-map-marker" aria-hidden="true"></i>' . $row->city . ', ' . $row->state . ', ' . $row->zip . '</p>
                                 <p><i class="fa fa-briefcase" aria-hidden="true"></i>' . $row->subject . '</p>
                                 <p><i class="fa fa-calendar" aria-hidden="true"></i>' . format_date($row->date) . '</p>

                              </div>
                            </div>
                            <div class="_jobDetail">
                                <p><i class="fi-clock" aria-hidden="true"></i>' . time_ago($row->date) . '</p>
                              <a class="time-btn1 time-btn" href="' . site_url('job-detail/' . $row->encoded_id) . '">View Details</a>
                            </div>
                        </div>
                    </li>';
				}
				$pagesHtml = '';
				$total = intval($output['total']);
				$per_page = $output['per_page'];
				$pages = ceil($total / $per_page);
				if (intval($pages) > 1) :
					for ($i = 1; $i <= intval($pages); $i++) :
						$pagesHtml .= '<li><a ' . (($i == 1) ? 'class="active"' : '') . ' data-page="' . $i . '" href="javascript:void();">' . $i . '</a></li>';
					endfor;
				endif;
				$output['paging'] = ($pagesHtml) ? '<ul id="searchPaging" class="pagination">' . $pagesHtml . '</ul>' : '';
			}
			exit(json_encode($output));
		} else {
			/*$this->data['site_content'] = $this->master->getRow('sitecontent', array('type' => 'search'));
			$this->data['site_content'] =unserialize($this->data['site_content']->code);*/
			$this->data['grade_levels'] = $this->master->getRows('job_grade_levels');
			$this->load->view('jobs/search', $this->data);
		}
	}

	function check_pay()
	{
		$tut_id = $this->input->post('store');
		$student_id = $this->session->mem_id;
		$getdata = $this->master->getRow('members', array('mem_id' => $student_id));

		$payment_method = $this->input->post('payment_method');
		$method_id = intval(substr(doDecode($payment_method), 3));
		if (!$method_row = $this->payment_methods_model->get_mem_method($method_id)) {
			$res['msg'] = showMsg('error', 'Please select valid saved card!');
			exit(json_encode($res));
		}

		$amount = $this->data['site_settings']->site_background_check_price > 0 ? round(($this->data['site_settings']->site_background_check_price), 2) : 1;
		$charge = $this->my_stripe->charge($this->data['mem_data']->mem_stripe_id, $method_row->method_token, $amount, "Charge for background check");
		if (empty($charge)) {
			$res['msg'] = showMsg('error', 'Something went worng please try again later!');
			exit(json_encode($res));
		}
		$save_data['tutor_id'] = $tut_id;
		$save_data['student_id'] = $student_id;
		$save_data['amount'] = $amount;

		/******************************** Checkr *******************************************/
		$getTutorDetails = $this->master->getRow('members', array('mem_id' => $tut_id));
		//$getdata = $this->master->getRow('background_check_info', array('tutor_id' => $tut_id, 'student_id' => $student_id, 'status' => 0));
		//		    $CHECKR_API_KEY = "6a82d58114f5b57e468f3e6485c4648cfffcd2e2";
		$CHECKR_API_KEY = CHECKR_API_KEY;

		$candidate_params = [
			"first_name" => $getTutorDetails->mem_fname,
			'middle_name' => 'Abc',
			"last_name" => $getTutorDetails->mem_lname,
			"dob" => date('Y-m-d', $getTutorDetails->mem_dob),
			"phone" => $getTutorDetails->mem_phone,
			"email" => $getTutorDetails->mem_email,
			"ssn" => "111-11-2001",
			"zipcode" => "90401"
		];
		try {
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, 'https://api.checkr.io/v1/candidates');
			curl_setopt($curl, CURLOPT_USERPWD, $CHECKR_API_KEY . ":");
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
			curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($candidate_params));

			$json = curl_exec($curl);
			$http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

			curl_close($curl);
		} catch (Exception $e) {
			print_r($e);
		}

		//echo "status:" . $http_status . "\n" . $json . "\n\n";

		$response = json_decode($json);

		//echo "<pre>"; print_r($response); die();

		$save_data['checkr_id'] = $response->id;

		$curl_er = curl_init();
		curl_setopt($curl_er, CURLOPT_URL, 'https://api.checkr.com/v1/packages');
		curl_setopt($curl_er, CURLOPT_USERPWD, $CHECKR_API_KEY . ":");
		curl_setopt($curl_er, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl_er, CURLOPT_POST, false);
		curl_setopt($curl_er, CURLOPT_CONNECTTIMEOUT, 5);
		//curl_setopt($curl_er, CURLOPT_POSTFIELDS, http_build_query($candidate_params_ert));

		$json_er = curl_exec($curl_er);
		$http_status_er = curl_getinfo($curl_er, CURLINFO_HTTP_CODE);

		//$response_er = json_decode($json_er);

		//echo "<pre>"; print_r($json_er); die();

		try {

			$candidate_params_ert = [
				"candidate_id" => $response->id,
				"package" => 'tasker_standard'
			];

			$curl_ert = curl_init();
			curl_setopt($curl_ert, CURLOPT_URL, 'https://api.checkr.com/v1/reports');
			curl_setopt($curl_ert, CURLOPT_USERPWD, $CHECKR_API_KEY . ":");
			curl_setopt($curl_ert, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl_ert, CURLOPT_POST, true);
			curl_setopt($curl_ert, CURLOPT_CONNECTTIMEOUT, 5);
			curl_setopt($curl_ert, CURLOPT_POSTFIELDS, http_build_query($candidate_params_ert));

			$json_ert = curl_exec($curl_ert);
			$http_status_ert = curl_getinfo($curl_ert, CURLINFO_HTTP_CODE);

			curl_close($curl_ert);
		} catch (Exception $e) {
			print_r($e);
		}

		//echo "status:" . $http_status . "\n" . $json . "\n\n";

		$response_ert = json_decode($json_ert);

		// echo "<prE>"; print_r($response_ert); die();

		$save_data['report_ids'] = $response_ert->id;
		$save_data['status'] = 0;
		// $save_data['status'] = $response_ert->status;
		$save_data['date'] = $response_ert->created_at;
		// $save_data['due_time'] = $response_ert->due_time;
		// $save_data['package'] = $response_ert->package;
		// $save_data['tags'] = $response_ert->tags;
		// $save_data['adjudication'] = $response_ert->adjudication;
		// $save_data['assessment'] = $response_ert->assessment;
		// $save_data['candidate_id'] = $response_ert->candidate_id;
		// $save_data['county_criminal_search_ids'] = $response_ert->county_criminal_search_ids;
		// $save_data['document_ids'] = $response_ert->document_ids;
		// $save_data['federal_criminal_search_id'] = $response_ert->federal_criminal_search_id;
		// $save_data['global_watchlist_search_id'] = $response_ert->id;
		// $save_data['national_criminal_search_id'] = $response_ert->id;
		// $save_data['personal_reference_verification_ids'] = $response_ert->id;
		// $save_data['professional_reference_verification_ids'] = $response_ert->id;
		// $save_data['sex_offender_search_id'] = $response_ert->id;
		// $save_data['ssn_trace_id'] = $response_ert->id;
		// $save_data['state_criminal_search_ids'] = $response_ert->id;
		// $save_data['terrorist_watchlist_search_id'] = $response_ert->id;
		// $save_data['facis_search_id'] = $response_ert->id;
		// $save_data['arrest_search_id'] = $response_ert->id;
		// $save_data['motor_vehicle_report_id'] = $response_ert->id;
		/******************************* end of checkr intergation **************************/
		// print_r($save_data); die;
		$getdata = $this->master->getRow('background_check_info', array('tutor_id' => $tut_id, 'student_id' => $student_id, 'status' => 0));
		if (!empty($getdata)) {
			$save_data['status'] = 0;
			$save_mem_data['mem_verified'] = 0;
			/************************** *****************************/
			$res['status'] = 0;
			$res['msg'] = showMsg('success', 'You have already paid, review is in progress.');
			exit(json_encode($res));
			/************************** *****************************/
			$this->master->save('background_check_info', $save_data, 'id', $getdata->id);
			$this->master->save('members', $save_mem_data, 'mem_id', $tut_id);
		} else {
			$this->master->save('background_check_info', $save_data);
		}

		$res['status'] = 1;
		$res['msg'] = showMsg('success', 'Payment received successfully');
		exit(json_encode($res));
	}

	function pay_for_check()
	{
		$encoded_id = $this->input->post('encoded_id');
		$tut_id = $this->input->post('mem_id');
		$id = intval(doDecode($encoded_id));
		$getdata = $this->master->getRow('members', array('mem_id' => $tut_id));

		$res['status'] = 1;
		$amount = $this->data['site_settings']->site_background_check_price > 0 ? round(($this->data['site_settings']->site_background_check_price), 2) : 1;
		$res['data'] = '
    		<div class="cardBlk text-center">
            <div class="crosBtn order_back_cross"></div>
            <h3 class="order_back">Would you like to order a background check on ' . $getdata->mem_fname . ' for $' . $amount . '</h3>';
		$credit_cards = $this->payment_methods_model->get_credit_cards($this->sesison->mem_id);
		$res['data'] .= '<div class="formRow row svdCards">
            <hr>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 col-xx-8 txtGrp">
            <h4>Payment Method</h4>
            <select id="payment_method" name="payment_method" class="txtBox selectpicker" style="display: block!important;">';
		foreach ($credit_cards as $card_row) {
			$res['data'] .= '<option style="background-image:url(https://crainly.com/assets/images/cards/' . $card_row->image . ') !important;background-repeat: no-repeat!important;padding: 13px;display: inline-block;padding-left: 70px;background-position: 5px 6px !important;width: 100%;background-color: #FFFAF6 !important;" class="payment_option" value="' . $card_row->encoded_id . '"' . (empty($card_row->default_method) ? '' : ' selected=""') . '> * * * * * ' . $card_row->last_digits . '</option>';
		}
		$res['data'] .= '</select>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xx-4 txtGrp">
            <h4>&nbsp;</h4>
            <button type="button" data-store="' . $tut_id . '" class="webBtn lgBtn colorBtn checkPay">Pay Now <i class="fa-spinner hidden"></i></button>
            </div>
            </div>
            <div class="alertMsg"></div>';

		//$res['data'].='<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xx-4 txtGrp">  <h4>&nbsp;</h4><button type="button" data-store="'.$tut_id.'" class="webBtn lgBtn colorBtn checkPay">Pay Now <i class="fa-spinner hidden"></i></button></div><div class="pay_status"></div></div>';

		exit(json_encode($res));
	}
    function check_status()
    {
        $encoded_id = $this->input->post('encoded_id');
        $tut_id = $this->input->post('mem_id');
        $id = intval(doDecode($encoded_id));
        $mem = $this->master->getRow('members', array('mem_id' => $tut_id));
        $tutorcheck = get_background_check($tut_id);
        $res['status'] = 1;
        $amount = $this->data['site_settings']->site_background_check_price > 0 ? round(($this->data['site_settings']->site_background_check_price), 2) : 1;
        $content = '';
        if(!empty($tutorcheck) && $tutorcheck->status == 1 && $mem->mem_verified == 1)
        {
            $content = $mem->mem_fname.' '.$mem->mem_lname.' has passed a background check on '.format_date($tutorcheck->date).'. To order a new background
check, please select <b>Background Check</b> on the tutors profile.';
            $content = "This tutor has not yet completed a background check. To order a new background check please select \"Purchase Background Check\" on the tutor's profile.";
        } if(!empty($tutorcheck) && $tutorcheck->status == 0)
    {
        $content = $mem->mem_fname.' '.$mem->mem_lname.' is currently in the process of having a background check completed.';
    } if(empty($tutorcheck))
    {
        $content = "This tutor has not yet completed a background check. To order a new background check please select \"Purchase Background Check\" on the tutor's profile.";
    }
        $res['data'] = '
                    <div class="cardBlk text-center">
                    <div class="crosBtn order_back_cross"></div>
                    <h3 class="order_back">'.$content.'</h3>';
        $res['data'] .= '<div class="formRow row svdCards">';
        $res['data'] .= '</div>';
        exit(json_encode($res));
    }
	function profile($encoded_id)
	{
		$id = intval(doDecode($encoded_id));

		if ($this->data['row'] = $this->member_model->get_tutor($id)) 
		{
			
			$this->data['eduction'] = $this->member_educations_model->getRecordMemberwise($id);
			$this->data['experiences'] = $this->member_experiences_model->getRecordMemberwise($id);
			$this->load->model('subject_model');
			//$this->data['subjects']=$this->subject_model->get_tutor_subjects($id);
			$this->data['subjects'] = $this->data['row']->mem_subjects;
			$this->data['tutor_timings'] = $this->master->getRows('tutor_timings', array('mem_id' => $id));
			$this->data['mem_reviews'] = get_mem_reviews($id);
			$this->data['review_count'] = count($this->data['mem_reviews']);
			$this->data['encoded_id'] = $encoded_id;
			if ($this->session->mem_type == 'student') {
				$getdata = $this->master->getRow('background_check_info', array('tutor_id' => $id, 'student_id' => $this->session->mem_id));
				if (!empty($getdata)) {
					//                    $this->master->save('background_check_info', $save_data, 'id', $getdata->id);

					try {

						//                        $CHECKR_API_KEY = "6a82d58114f5b57e468f3e6485c4648cfffcd2e2";
						$CHECKR_API_KEY = CHECKR_API_KEY;

						$curl_ert = curl_init();
						curl_setopt($curl_ert, CURLOPT_URL, 'https://api.checkr.com/v1/reports/' . $getdata->report_ids);
						curl_setopt($curl_ert, CURLOPT_USERPWD, $CHECKR_API_KEY . ":");
						curl_setopt($curl_ert, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($curl_ert, CURLOPT_GET, true);
						curl_setopt($curl_ert, CURLOPT_CONNECTTIMEOUT, 5);

						$json_ert = curl_exec($curl_ert);
						$http_status_ert = curl_getinfo($curl_ert, CURLINFO_HTTP_CODE);

						curl_close($curl_ert);
					} catch (Exception $e) {
						print_r($e);
					}

					$response = json_decode($json_ert);

					//	                $response->status = 'complete'; // #TODO Remove this line.
					if ($response->status == "pending") $this->data['backgroudn_status'] = "In Progress";
					if ($response->status == "complete") {
						$this->data['backgroudn_status'] = "Passed";
						$this->master->save('background_check_info', array('status' => 1), 'id', $getdata->id);
					}
					if ($response->status == "clear") $this->data['backgroudn_status'] = "Cleared";
					if ($response->status == "consider") $this->data['backgroudn_status'] = "Considered";
					if ($response->status == "dispute") $this->data['backgroudn_status'] = "Dispute";
					if ($response->status == "suspended") $this->data['backgroudn_status'] = "Suspended";
				} else {
					$this->data['backgroudn_status'] = "Not Complete";
				}
			}


			$this->load->view('account/profile', $this->data);
		} else
			show_404();
	}

	function getReviews()
    {
				$encoded_id = $this->input->post('encoded_id');
				$rating = $this->input->post('rating');
				$page = $this->input->post('page');
        $id = intval(doDecode($encoded_id));
				
				$per_page = 5;
				$mem_reviews = get_mem_reviews_pagewise($id, $rating, $page, $per_page);
				$mem_review_count = get_mem_reviews_pagewise($id, $rating, $page, $per_page, true);
		
				$res['status'] = 1;
				$res['data'] = $mem_reviews;
				$res['data_count'] = count($mem_review_count);
				$res['data_per_page'] = $per_page;
				$res['data_total_page'] = ceil(count($mem_review_count)/$per_page);
        exit(json_encode($res));
    }

	public function facebook_login()
	{

		include_once APPPATH . "libraries/Facebook/autoload.php";

		$fb = new Facebook\Facebook(array(
			'app_id' => '1621516391231142', // Replace {app-id} with your app id
			'app_secret' => '700dbe7cbdfe2ab506e58ce1e4afee53',
			'default_graph_version' => 'v2.9'
		));

		$helper = $fb->getRedirectLoginHelper();
		$permissions = array('email'); // Optional permissions
		$loginUrl = $helper->getLoginUrl(base_url('ajax/fb_callback'), $permissions);
		$fb_login_url = ($loginUrl);
		redirect($fb_login_url, 'refresh');
		exit;
	}

	public function google_login()
	{

		include_once APPPATH . "libraries/Google/autoload.php";

		$client_id = '64946543542-d5qjd9vp2f71qrd62p13l1ftbeon40dg.apps.googleusercontent.com';
		$client_secret = 'h3Fkf00VUVHvSAMf4aLFhefG';
		$redirect_uri = base_url('google-callback');

		$client = new Google_Client();
		$client->setClientId($client_id);
		$client->setClientSecret($client_secret);
		$client->setRedirectUri($redirect_uri);
		$client->addScope("email");
		$client->addScope("profile");
		$authUrl = $client->createAuthUrl();

		redirect(urldecode($authUrl), 'refresh');
	}

	public function twitter_login()
	{

		/*include_once APPPATH . "libraries/Twitter/OAuth.php";
	   include_once APPPATH . "libraries/Twitter/twitteroauth.php";

	   $client_id = '  ihs0ekv7iq91XlLbvACwod4jA';
	   $client_secret = 'N0JnOSSL8BYH8a5ISPHp0YMSHatZFLa3TZfLcBfySTjetG6a0r';
	   $redirect_uri = site_url('ajax/twitter_callback');

	   $connection = new TwitterOAuth($client_id, $client_secret);

	   $request_token = $connection->getRequestToken($redirect_uri);
	   pr($request_token);


	   $this->session->set_userdata('oauth_token',$request_token['oauth_token']);
	   $this->session->set_userdata('oauth_token_secret',$request_token['oauth_token_secret']);

	   $authUrl = $connection->getAuthorizeURL($request_token['oauth_token']);
	   redirect(urldecode($authUrl), 'refresh');
	   exit;*/

		include_once APPPATH . "libraries/Twitter/autoload.php";
		// use Abraham\TwitterOAuth\TwitterOAuth;
		$client_id = '  ihs0ekv7iq91XlLbvACwod4jA';
		$client_secret = 'N0JnOSSL8BYH8a5ISPHp0YMSHatZFLa3TZfLcBfySTjetG6a0r';
		$redirect_uri = site_url('ajax/twitter_callback');

		$connection = new Abraham\TwitterOAuth\TwitterOAuth($client_id, $client_secret);
		$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => $redirect_uri));
		pr($request_token);
		$this->session->set_userdata('oauth_token', $request_token['oauth_token']);
		$this->session->set_userdata('oauth_token_secret', $request_token['oauth_token_secret']);
		$authUrl = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
		redirect(urldecode($authUrl), 'refresh');
		exit;
	}
}
