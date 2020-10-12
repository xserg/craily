<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('member_model', 'member');
	}

	function follow(){
		$this->isMemLogged('member');

		$id=intval(substr(doDecode($this->input->post('store')),2));
		if($this->member->getMember($id,array('mem_status'=>1,'mem_verified'=>1))){

			if($this->master->getRow('followers',array('follower_id'=>$this->session->mem_id,'mem_id'=>$id))){
				$this->db->where(array('follower_id'=>$this->session->mem_id,'mem_id'=>$id));
				$this->db->delete('followers');
				$res['data']='Follow';
			}
			else{
				$this->master->save('followers',array('follower_id'=>$this->session->mem_id,'mem_id'=>$id));
				$txt=' starts Following you';
				$this->save_notificaiton($id,$this->session->mem_id,$txt);
				$res['data']='<i class="fa fa-check"></i> Following';
			}
			echo json_encode($res);
			// echo $res['data'];
			exit;
		}
		die('access denied!');
	}

	function contact(){
		$res=array();
		$res['hide_msg']=0;
		$res['scroll_to_msg']=0;
		$res['status'] = 0;
		$res['frm_reset'] = 0;
		$res['redirect_url'] = 0;

		$this->form_validation->set_rules('name','Name','required');
		//$this->form_validation->set_rules('subject','Subject','required');
		$this->form_validation->set_rules('email','Email','required|valid_email');
		$this->form_validation->set_rules('msg','Message','required');
		//$this->form_validation->set_rules('g-recaptcha-response','Robot','required',array('required'=>'Please verify that you are not robot!'));
		if($this->form_validation->run()===FALSE)
		{
			$res['msg'] = validation_errors();
		}else{
			$vals=$this->input->post();
			$vals['message']=html_escape($this->input->post('msg'));
			//$secret = RECAPTCHA_SECRET_KEY;
			//$response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$vals['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
			//if($response['success'] == true){

				$vals['site_email']=$this->data['site_settings']->site_email;
				$vals['site_noreply_email']=$this->data['site_settings']->site_noreply_email;
				$okmsg=send_email($vals);
				if($okmsg){
					$res['msg'] = showMsg('success','Message send sucessfully!');

					$res['status'] = 1;
					$res['frm_reset'] = 1;
					$res['hide_msg']=1;
					// $res['redirect_url'] = site_url('contact-us');
				}else{
					$res['msg'] = showMsg('error','Error Occured!');

				}
			//}else{
				//$res['msg'] = showMsg('error','Please verify that you are not robot!');

				// $res['redirect_url'] = site_url('contact-us');
			//}
		}
		echo json_encode($res);
		exit();
	}
	/*function save_mem_images() {
		if ($this->input->post('image') != "" && $this->input->post('type') != "") {

			if($this->input->post('type')=='dp'){
				$arr = array('mem_image' => $this->input->post('image'));
				$image=$this->data['mem_data']->mem_image;
			}
			else{
				$arr = array('mem_cover_image' => $this->input->post('image'));
				$image=$this->data['mem_data']->mem_cover_image;
			}

			curl_call(SCONTENT_SITE.'ajax/remove_file',"image=".$image."&pk_key=".doEncode($this->data['mem_data']->mem_token));

			$res['image_upload'] = 1;
			$this->member->save($arr, $this->session->mem_id);
			exit(json_encode($res));
		}
	}*/
	function save_mem_images() {
		if ($_FILES['image']['name'] != "" && $this->input->post('image_type') != "") {
			$res=array();
			$image = upload_vfile('image');
			if (!empty($image['file_name'])) 
			{
				$image_type = 'mem_'.$this->input->post('image_type');
				
				if ($image_type == 'mem_cover_image') {
					remove_vfile($this->data['mem_data']->mem_cover_image);
					$arr = array('mem_cover_image' => $image['file_name']);
				} else {
					remove_vfile($this->data['mem_data']->mem_image);
					$arr = array('mem_image' => $image['file_name']);
				}

				$this->member->save($arr, 'mem_id', $this->session->mem_id);
				$res['image'] = get_image_src($image['file_name']);
				$res['upload_status'] = 1;
			} else {
				$res['upload_status'] = 0;
			}
			exit(json_encode($res));
		}
	}
	function fb_callback() {
		include_once APPPATH . "libraries/Facebook/autoload.php";
		$fb = new Facebook\Facebook(array(
			'app_id' => '513833342331811',
			'app_secret' => '8a7378961461fd4c002f70e234e30a4a',
			'default_graph_version' => 'v2.9'
		));
		$helper = $fb->getRedirectLoginHelper();
		try {
			$accessToken = $helper->getAccessToken();
		} catch (Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		} catch (Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}

		if (!isset($accessToken)) {
			if ($helper->getError()) {
				header('HTTP/1.0 401 Unauthorized');
				echo "Error: " . $helper->getError() . "\n";
				echo "Error Code: " . $helper->getErrorCode() . "\n";
				echo "Error Reason: " . $helper->getErrorReason() . "\n";
				echo "Error Description: " . $helper->getErrorDescription() . "\n";
			} else {
				header('HTTP/1.0 400 Bad Request');
				echo 'Bad request';
			}
			exit;
		}
		$this->session->set_userdata('fb_access_token', (string) $accessToken);
		$res = $fb->get('/me', $accessToken);
		$user = $res->getGraphObject();
		$data = array();
		$data['access_token'] = $accessToken;
		$data['name'] = $user->getProperty('name');
		$data['email'] = $user->getProperty('email');
		$data['social_id'] = trim($user->getProperty('id'));

		if (!empty($data['name']) && !empty($data['social_id']) && !empty($data['access_token'])) {
			if ($mem = $this->member->socialIdExists('facebook', $data['social_id'])) {

				$this->member->update_last_login($mem->mem_id);
				$this->session->set_userdata('mem_type', $mem->mem_type);
				$this->session->set_userdata('mem_id', $mem->mem_id);
			} else {
				$image='';
				if(!empty($data['image'])){
					
					$image = file_get_contents($data['image']);
					$file_name=md5(rand(100, 1000)) . '_' .time() . '_' . rand(1111, 9999). '.jpg';

					$dir = UPLOAD_VPATH . 'vp/'.$file_name;
					@file_put_contents($dir, $image);

					generate_thumb(UPLOAD_VPATH . "vp/", UPLOAD_VPATH . "p50x50/", $file_name, 50);
					generate_thumb(UPLOAD_VPATH . "vp/", UPLOAD_VPATH . "p150x150/", $file_name, 150);
					generate_thumb(UPLOAD_VPATH . "vp/", UPLOAD_VPATH . "p300x300/", $file_name, 300);

					$image=$file_name;
				}

				if($data['email']!=''){
					$mem_row = $this->member->emailExists($data['email']);
					if (count($mem_row) > 0)
						$data['email']='';

				}

				$arr = explode(" ", $data['name']);
				$new_vals = array(
					'mem_type' => 'student',
					'mem_social_type' => 'facebook',
					'mem_social_id' => $data['social_id'],
					'mem_fname' => $arr[0],
					'mem_lname' => $arr[1],
					'mem_email' => $data['email'],
					'mem_status' => '1',
					'mem_verified' => '1',
					'mem_image' => $image
				);
				$this->load->library('my_braintree');
        		$new_vals['mem_braintree_id']=$this->my_braintree->create_customer(array('firstName' => ucfirst($new_vals['mem_fname']),'lastName' => ucfirst($new_vals['mem_lname']),'email' => $new_vals['mem_email']));
        		
				$mem_id = $this->member->save($new_vals);
				
				$this->member->update_last_login($mem_id);
				$this->session->set_userdata('mem_type', 'student');
				$this->session->set_userdata('mem_id', $mem_id);
				// $this->sendEmail();
			}
			$redirect_url=$this->session->mem_type=='student'?'account-settings':'dashboard';
			redirect($redirect_url, 'refresh');
			exit;
		}
	}

	function google_callback() {
		include_once APPPATH . "libraries/Google/autoload.php";

		$client_id = '64946543542-d5qjd9vp2f71qrd62p13l1ftbeon40dg.apps.googleusercontent.com';
		$client_secret = 'h3Fkf00VUVHvSAMf4aLFhefG';
		$redirect_uri = base_url('google-callback');

		$client = new Google_Client();
		$client->setClientId($client_id);
		$client->setClientSecret($client_secret);
		$client->setRedirectUri($redirect_uri);

		$client->authenticate($_GET['code']);
		$accessToken = $client->getAccessToken();
		$client->setAccessToken($accessToken);

		$service = new Google_Service_Oauth2($client);
		$data = array();
        $user = $service->userinfo->get(); //get user info 

        $data['access_token'] = $accessToken;
        $data['social_id'] = $user->id;
        $data['name'] = $user->name;
        $data['email'] = $user->email;
        $data['image'] = $user->picture;
        if (!empty($data['name']) && !empty($data['social_id']) && !empty($data['access_token'])) {


        	if ($mem = $this->member->socialIdExists('google', $data['social_id'])) {

        		$this->member->update_last_login($mem->mem_id);
        		$this->session->set_userdata('mem_type', $mem->mem_type);
        		$this->session->set_userdata('mem_id', $mem->mem_id);
        	} else {

        		$image='';
        		if(!empty($data['image'])){
        			
        			$image = file_get_contents($data['image']);
        			$file_name=md5(rand(100, 1000)) . '_' .time() . '_' . rand(1111, 9999). '.jpg';

        			$dir = UPLOAD_VPATH . 'vp/'.$file_name;
        			@file_put_contents($dir, $image);

        			generate_thumb(UPLOAD_VPATH . "vp/", UPLOAD_VPATH . "p50x50/", $file_name, 50);
        			generate_thumb(UPLOAD_VPATH . "vp/", UPLOAD_VPATH . "p150x150/", $file_name, 150);
        			generate_thumb(UPLOAD_VPATH . "vp/", UPLOAD_VPATH . "p300x300/", $file_name, 300);

        			$image=$file_name;
        		}
        		if($data['email']!=''){
        			$mem_row = $this->member->emailExists($data['email']);
        			if (count($mem_row) > 0)
        				$data['email']='';

        		}

        		$arr = explode(" ", $data['name']);
        		$new_vals = array(
        			'mem_type' => 'student',
        			'mem_social_type' => 'google',
        			'mem_social_id' => $data['social_id'],
        			'mem_fname' => $arr[0],
        			'mem_lname' => $arr[1],
        			'mem_email' => $data['email'],
        			'mem_status' => '1',
        			'mem_verified' => '1',
        			'mem_image' => $image
        		);

        		$this->load->library('my_stripe');
        		$new_vals['mem_stripe_id']=$this->my_stripe->save_customer(array('name' => ucfirst($new_vals['mem_fname']).' '.ucfirst($new_vals['mem_lname']),'email' => $new_vals['mem_email'],"description" => "Crainly Customer ".ucfirst($new_vals['mem_fname']).' '.ucfirst($new_vals['mem_lname'])));

        		$mem_id = $this->member->save($new_vals);

        		$this->member->update_last_login($mem_id);
        		$this->session->set_userdata('mem_type', 'student');
        		$this->session->set_userdata('mem_id', $mem_id);
        		// $this->sendEmail();
        	}
        }
        $redirect_url=$this->session->mem_type=='student'?'account-settings':'dashboard';
        redirect($redirect_url, 'refresh');
        exit;
    }
    function twitter_callback() {
    	include_once APPPATH . "libraries/Twitter/autoload.php";
    	
    	$client_id = '  ihs0ekv7iq91XlLbvACwod4jA';
    	$client_secret = 'N0JnOSSL8BYH8a5ISPHp0YMSHatZFLa3TZfLcBfySTjetG6a0r';
    	$redirect_uri = site_url('ajax/twitter_callback');

    	$request_token = [];
    	$request_token['oauth_token'] = $this->session->oauth_token;
    	$request_token['oauth_token_secret'] = $this->session->oauth_token_secret;

    	$this->session->unset_userdata('oauth_token');
    	$this->session->unset_userdata('oauth_token_secret');

    	if ($this->input->get('oauth_token') && $request_token['oauth_token'] === $this->input->get('oauth_token')) {


    		$connection = new Abraham\TwitterOAuth\TwitterOAuth($client_id, $client_secret, $request_token['oauth_token'], $request_token['oauth_token_secret']);
    		$access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $this->input->get('oauth_verifier')));

    		$connection = new Abraham\TwitterOAuth\TwitterOAuth($client_id, $client_secret, $access_token['oauth_token'], $access_token['oauth_token_secret']);

    		$data = array();
    		$user = $connection->get("account/verify_credentials");
    		pr($user);

    		$data['access_token'] = $accessToken;
    		$data['social_id'] = $user->id;
    		$data['name'] = $user->name;
    		$data['email'] = $user->email;
    		$data['image'] = $user->profile_image_url;
    		if (!empty($data['name']) && !empty($data['social_id']) && !empty($data['access_token'])) {


    			if ($mem = $this->member->socialIdExists('twitter', $data['social_id'])) {

    				$this->member->update_last_login($mem->mem_id);
    				$this->session->set_userdata('mem_type', $mem->mem_type);
    				$this->session->set_userdata('mem_id', $mem->mem_id);
    			} else {

    				$image='';
    				if(!empty($data['image'])){
    					$res=curl_call(SCONTENT_SITE.'ajax/save_mem_social_image',"image=".$data['image']);
    					if($res)
    						$image=$res;
    				}
    				if($data['email']!=''){
    					$mem_row = $this->member->emailExists($data['email']);
    					if (count($mem_row) > 0)
    						$data['email']='';

    				}

    				$arr = explode(" ", $data['name']);
    				$new_vals = array(
    					'mem_type' => 'member',
    					'mem_social_type' => 'google',
    					'mem_social_id' => $data['social_id'],
    					'mem_fname' => $arr[0],
    					'mem_lname' => $arr[1],
    					'mem_email' => $data['email'],
    					'mem_status' => '1',
    					'mem_verified' => '1',
    					'mem_image' => $image
    				);

    				$mem_id = $this->member->save($new_vals);

    				$this->member->update_last_login($mem_id);
    				$this->session->set_userdata('mem_type', 'member');
    				$this->session->set_userdata('mem_id', $mem_id);
        		// $this->sendEmail();
    			}
    		}
    	}
    	$redirect_url=$this->session->mem_type=='student'?'account-settings':'dashboard';
    	redirect($redirect_url, 'refresh');
    	exit;
    }
    function get_schedule_episodes() {
    	$day=$this->input->post('day');
    	$week_days=get_week_days();

    	$res['items'] = "";
    	$res['found'] = 0;
    	if(in_array($day, $week_days)){
    		$this->load->model('episode_model');
    		$schedule_episodes = $this->episode_model->get_schedule_episodes($day,'',8);
    		$res['found'] = 1;
    		if (count($schedule_episodes) > 0) {
    			foreach ($schedule_episodes as $schedule_episode) {
    				$res['items'] .= 
    				'<li>
    				<div class="iTem">
    				<div class="image" style="background-image: url(\''.get_image_src($schedule_episode->thumbnail,300).'\')">
    				<a href="'.comic_url($schedule_episode->comic_id,$schedule_episode->comic_title).'" class="overlay"></a>
    				</div>
    				<!--<div class="heart">
    				'.favorite_btn($schedule_episode->id,'episode',$schedule_episode->total_favorites).'
    				</div>-->
    				<div class="ico"><a href="'. profile_url($schedule_episode->mem_id,$schedule_episode->mem_name).'"><img src="'. get_image_src($schedule_episode->mem_image,50,true).'" alt=""></a></div>
    				<div class="cntnt">
    				<h4><a href="'. comic_url($schedule_episode->comic_id,$schedule_episode->comic_title).'">'. $schedule_episode->title.'</a></h4>
    				<!--<div class="rateYo" data-rateyo-rating="'.get_avg_rating($schedule_episode->comic_id,'comic').'" data-rateyo-read-only="true"></div>-->
    				<div class="chBlk">
    				<div class="ch">CH '.$schedule_episode->episode_no.'</div>
    				</div>
    				</div>
    				</div>
    				</li>';
    			}
    		} else {
    			$res['items'] = "<li>No comic schedule on ".$day."</li>";
    		}
    	}
    	exit(json_encode($res));
    }

    function get_subjects_new()
    {
		$res['option'] = "";
    	if ($this->input->post('subject')>0) {
    		
			$subject = $this->master->getRows('subjects', array('parent_id' => '0', 'id' => $this->input->post('subject')));
    		if(isset($subject) && $subject != null)
    		{
				$sub_subjects = $this->master->getRows('subjects', array('parent_id' =>$this->input->post('subject')));
	    		foreach($sub_subjects as $key => $value) {
		            $res['option'] .= '<label class="checkbox-inline"><input type="checkbox" name="sub_'. $this->input->post('subject') .'[]" class="checkbox_card" value="'.$value->id.'"';
		            if (in_array($value->name, $m_subjects[$subject->name])) { $res['option'] .= 'checked';  }  $res['option'] .= '>'.$value->name.'</label>';
		        }
    		}

    	

	        $res['found'] = 1;

	        exit(json_encode($res));
    	}
    }

    function get_subjects() {
    	// $this->isMemLogged($this->session->mem_type);
    	$res['option'] = "";
    	if ($this->input->post('subject')>0) {
    		$subject_rows = $this->master->getRows("subjects",array('parent_id'=>intval($this->input->post('subject')),'status'=>1));

    		if (count($subject_rows) > 0) {
    			foreach ($subject_rows as $index=> $subject_row) {
    				$tutor_subject=null;

    				$post_mem_id=$this->input->post('mem_id');
    				$mem_id=empty($post_mem_id)?$this->session->mem_id:intval($post_mem_id);
    				// $mem_id=empty($this->session->mem_id)?intval($this->input->post('mem_id')):$this->session->mem_id;
    				if ($mem_id>0)
    					$tutor_subject=$this->master->getRow('tutor_subjects',array('mem_id'=>$mem_id,'subject_id'=>$subject_row->id,'type'=>'sub'));

    				$name = str_replace('_', ' ', $subject_row->name);

    				$res['option'] .= '
    				<li class="lblBtn">
    				<input type="checkbox" name="subjects['.$index.']" value="'.$subject_row->id.'" id="'.$subject_row->name.'" class="atlst_one" '.($tutor_subject?'checked':'').'>
    				<label for="'.$subject_row->name.'">'.$name.'</label>
    				</li>';
    			}
    			$res['found'] = 1;
    		} else {
    			$res['option'] = '<li class="lblBtn">No Subject Found</li>';
    			$res['found'] = 0;
    		}
    	}
    	exit(json_encode($res));
    }

    function search_subject() {
    	$q=$this->input->post('query');
    	$this->db->where("status",1);
    	$this->db->like('name', $q, 'after');
		  $query=$this->db->get('subjects');
		// $this->db->limit(100);
    	$rows=array();
    	foreach ($query->result() as $row) {
    		$rows[]=array('label'=>$row->name,'value'=>$row->name,'id'=>$row->id);
    	}
    	exit(json_encode($rows));
    }
}

?>