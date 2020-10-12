<?php

class Index extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('member_model');
    }

    function index() {
        $this->data['site_content'] = $this->master->getRow('sitecontent', array('type' => 'home'));
        $this->data['site_content'] =unserialize($this->data['site_content']->code);
        // $this->data['partners'] = $this->master->getRows('partners');
        $this->data['tutors'] = $this->member_model->get_rows(array('mem_type'=>'tutor','mem_featured'=>1,'mem_verified'=>1,'mem_status'=>1,'mem_tutor_verified'=>1));
        $this->load->view("pages/index", $this->data);
    }

    function login() {
        $this->MemLogged();
        if($this->input->post()){
            $res=array();
            $res['frm_reset'] = 0;
            $res['hide_msg']=0;
            $res['scroll_to_msg']=0;
            $res['status'] = 0;
            $res['redirect_url']=0;
            $this->form_validation->set_rules('email','Email','required|valid_email');
            $this->form_validation->set_rules('password','Password','required');
            if($this->form_validation->run()===FALSE)
            {
                $res['msg'] = validation_errors();
            }else{
                $data = $this->input->post();

                $row = $this->member_model->authenticate($data['email'], $data['password']);
                if (count($row) > 0) {
                    if($row->mem_status==0){
                        $res['msg'] = showMsg('error','Your account blocked!');
                        exit(json_encode($res));
                    }

                    /*if($row->mem_verified==0){
                        $res['msg'] = showMsg('error','Please verify email to access your account!');
                        exit(json_encode($res));
                    }
                    */
                    $remember_token='';
                    if(isset($data['remeberMe'])){
                        $remember_token=doEncode('member-'.$row->mem_id);
                        $cookie= array('name'   =>'remember' ,'value'  => $remember_token,'expire' => (86400*7));
                        $this->input->set_cookie($cookie);
                    }

                    $this->member_model->update_last_login($row->mem_id,$remember_token);
                    $this->session->set_userdata('mem_id', $row->mem_id);
                    $this->session->set_userdata('mem_type', $row->mem_type);

                    // $url=$this->session->mem_type=='student'?'account-settings':'dashboard';
                    $res['redirect_url']=empty($this->session->redirect_url)?site_url('my-lessons'):$this->session->redirect_url;
                    $this->session->unset_userdata('redirect_url');

                    $res['msg'] = showMsg('success','Login successful! Please wait.');

                    $res['status'] = 1;
                    $res['frm_reset'] = 1;
                    $res['hide_msg']=1;
                } else {
                    $res['msg'] = showMsg('error','Invalid email or password');

                }
            }
            exit(json_encode($res));
        }else{
            $this->data['login_content'] = $this->master->getRow('sitecontent', array('type' => 'login'));
            $this->data['login_content'] =unserialize($this->data['login_content']->code);
            $this->load->view("account/login", $this->data);
        }
    }

    function register($ref_code='') {
        $this->MemLogged();
        if($this->input->post()){
            $res=array();
            $res['hide_msg']=0;
            $res['scroll_to_msg']=0;
            $res['frm_reset'] = 0;
            $res['status'] = 0;

            $this->form_validation->set_rules('fname','First Name','required');
            $this->form_validation->set_rules('lname','Last Name','required');
            $this->form_validation->set_rules('email','Email','required|valid_email');
            $this->form_validation->set_rules('phone','Phone','required|integer|min_length[10]|max_length[10]',array('integer'=>'Please enter valid US phone number','min_length'=>'Please enter valid US phone number','max_length'=>'Please enter valid US phone number'));
            $this->form_validation->set_rules('password','Password','required');
            $this->form_validation->set_rules('hear_about','Hear About','required');
            $this->form_validation->set_rules('confirm','Confirm','required',array('required'=>'Please accept our terms and conditions'));
            if($this->form_validation->run()===FALSE)
            {
                $res['msg'] = validation_errors();
            }else{
                $post = html_escape($this->input->post());
                $mem_row = $this->member_model->emailExists($post['email']);
                if (count($mem_row) == '0')
                {
                    if($this->member_model->phoneExists($post['phone'])){
                        $res['msg'] = showMsg('error','Phone Already In Use!');
                        exit(json_encode($res));
                    }
                    $rando=doEncode(rand(99,999).'-'.$post['email']);
                    $rando=strlen($rando)>225?substr($rando, 0,225):$rando;

                    $mem_referral_code=randCode(6);
                    while ( true) {
                        if (!$this->member_model->get_row($mem_referral_code,'mem_referral_code'))
                            break;
                        $mem_referral_code=randCode(6);
                    }

                    $save_data = array('mem_fname' => ucfirst($post['fname']),'mem_lname' => ucfirst($post['lname']),'mem_email' => $post['email'],'mem_phone' => $post['phone'], 'mem_pswd' => doEncode($post['password']), 'mem_code' => $rando, 'mem_type' => 'student','mem_status'=>1,'mem_hear_about'=>$post['hear_about'],'mem_last_login' => date('Y-m-d h:i:s'),'mem_referral_code'=>$mem_referral_code);

                    /*$this->load->library('my_braintree');
                    $save_data['mem_braintree_id']=$this->my_braintree->create_customer(array('firstName' => ucfirst($post['fname']),'lastName' => ucfirst($post['lname']),'email' => $post['email'],'phone' => $post['phone']));*/

                    $this->load->library('my_stripe');
                    $save_data['mem_stripe_id']=$this->my_stripe->save_customer(array('name' => ucfirst($post['fname']).' '.ucfirst($post['lname']),'email' => $post['email'],'phone' => $post['phone'],"description" => "Crainly Customer ".ucfirst($post['fname']).' '.ucfirst($post['lname'])));

                    $mem_id = $this->member_model->save($save_data);
                    $this->session->set_userdata('mem_id', $mem_id);
                    $this->session->set_userdata('mem_type', 'student');

                    if($ref_row=$this->member_model->get_row($ref_code,'mem_referral_code')){

                        $ref_signup_data = array('mem_id' => $ref_row->mem_id,'ref_mem_id' => $this->session->mem_id,'reward'=>0);
                        $this->master->save("ref_signups",$ref_signup_data);

                        $txt="Your friend ".ucfirst($post['fname'])." ".ucfirst($post['lname'])." signed up with your referral link. You will be rewarded after they complete their first lesson";
                        save_notificaiton($ref_row->mem_id,$this->session->mem_id,$txt);
                    }

                    $res['msg'] = showMsg('success',getSiteText('alert','registration'));

                    /*$verify_link = site_url('verification/' .$rando);
                    $mem_data=array('name'=>ucfirst($post['fname']).' '.ucfirst($post['lname']),"email"=>$post['email'],"link"=>$verify_link);
                    $this->send_site_email($mem_data,'signup');*/

                    // $this->send_signup_email($mem_id);

                    $res['redirect_url'] = site_url('phone-verification');
                    $res['status'] = 1;
                    $res['frm_reset'] = 1;
                } else {
                    $res['msg'] = showMsg('error','E-mail Address Already In Use!');
                }
            }
            exit(json_encode($res));
        }else{
            $this->data['register_content'] = $this->master->getRow('sitecontent', array('type' => 'signup'));
            $this->data['register_content'] =unserialize($this->data['register_content']->code);
            $this->load->view("account/register", $this->data);
        }
    }

    function tutor_register($ref_code='') {
        $this->MemLogged();
        if($this->input->post()){
            $res=array();
            $res['hide_msg']=0;
            $res['scroll_to_msg']=0;
            $res['frm_reset'] = 0;
            $res['status'] = 0;

            $this->form_validation->set_rules('fname','First Name','required');
            $this->form_validation->set_rules('lname','Last Name','required');
            $this->form_validation->set_rules('email','Email','required|valid_email');
            $this->form_validation->set_rules('phone','Phone','required|integer|min_length[10]|max_length[10]',array('integer'=>'Please enter valid US phone number','min_length'=>'Please enter valid US phone number','max_length'=>'Please enter valid US phone number'));
            $this->form_validation->set_rules('password','Password','required');
            $this->form_validation->set_rules('hear_about','Hear About','required');
            $this->form_validation->set_rules('confirm','Confirm','required',array('required'=>'Please accept our terms and conditions'));
            if($this->form_validation->run()===FALSE)
            {
                $res['msg'] = validation_errors();
            }else{
                $post = html_escape($this->input->post());
                $mem_row = $this->member_model->emailExists($post['email']);
                if (count($mem_row) == '0')
                {
                    if($this->member_model->phoneExists($post['phone'])){
                        $res['msg'] = showMsg('error','Phone Already In Use!');
                        exit(json_encode($res));
                    }
                    $rando=doEncode(rand(99,999).'-'.$post['email']);
                    $rando=strlen($rando)>225?substr($rando, 0,225):$rando;

                    $mem_referral_code=randCode(6);
                    while ( true) {
                        if (!$this->member_model->get_row($mem_referral_code,'mem_referral_code'))
                            break;
                        $mem_referral_code=randCode(6);
                    }
                    $arr = array('mem_fname' => ucfirst($post['fname']),'mem_lname' => ucfirst($post['lname']),'mem_email' => $post['email'],'mem_phone' => $post['phone'], 'mem_pswd' => doEncode($post['password']), 'mem_code' => $rando, 'mem_type' => 'tutor','mem_status'=>1,'mem_hear_about'=>$post['hear_about'],'mem_last_login' => date('Y-m-d h:i:s'),'mem_referral_code'=>$mem_referral_code);

                    $mem_id = $this->member_model->save($arr);
                    $this->session->set_userdata('mem_id', $mem_id);
                    $this->session->set_userdata('mem_type', 'tutor');

                    if($ref_row=$this->member_model->get_row($ref_code,'mem_referral_code')){

                        $ref_signup_data = array('mem_id' => $ref_row->mem_id,'ref_mem_id' => $this->session->mem_id,'reward'=>0);
                        $this->master->save("ref_signups",$ref_signup_data);

                        $txt="Your friend ".ucfirst($post['fname'])." ".ucfirst($post['lname'])." signed up with your referral link. You will be rewarded after they complete their first lesson";
                        save_notificaiton($ref_row->mem_id,$this->session->mem_id,$txt);
                    }

                    $res['msg'] = showMsg('success',getSiteText('alert','registration'));

                    /*$verify_link = site_url('verification/' .$rando);
                    $mem_data=array('name'=>ucfirst($post['fname']).' '.ucfirst($post['lname']),"email"=>$post['email'],"link"=>$verify_link);
                    $this->send_site_email($mem_data,'signup');*/

                    // $this->send_signup_email($mem_id);

                    $res['redirect_url'] = site_url('phone-verification');
                    $res['status'] = 1;
                    $res['frm_reset'] = 1;
                } else {
                    $res['msg'] = showMsg('error','E-mail Address Already In Use!');
                }
            }
            exit(json_encode($res));
        }else{
            $this->data['register_content'] = $this->master->getRow('sitecontent', array('type' => 'tutor_signup'));
            $this->data['register_content'] =unserialize($this->data['register_content']->code);
            $this->load->view("account/register-tutor", $this->data);
        }
    }

    function become_tutor() {
        $this->isMemLogged('tutor',true,false);
        if($this->data['mem_data']->mem_tutor_application>0){
            redirect('my-lessons');
            exit;
        }

        if($this->input->post()){
            $res=array();
            $res['hide_msg']=1;
            $res['scroll_to_msg']=0;
            $res['status'] = 0;
            $res['frm_reset'] = 0;
            $res['redirect_url'] = 0;

            $this->form_validation->set_message('integer', 'Please select a valid {field}');
            $this->form_validation->set_rules('fname','First Name','required|alpha');
            $this->form_validation->set_rules('lname','Last Name','required|alpha');
            $this->form_validation->set_rules('email','Email','required|valid_email');
            $this->form_validation->set_rules('phone','Phone','required');
            $this->form_validation->set_rules('subject','Subject','required|integer');
            $this->form_validation->set_rules('subjects[]','Subjects','required|integer');
            $this->form_validation->set_rules('hourly_rate','Hourly Rate','required|integer',array('integer'=>'Please enter valid {field}'));
            $this->form_validation->set_rules('school_name','School Name','required');
            $this->form_validation->set_rules('major_subject','Major Subject','required');
            $this->form_validation->set_rules('graduation_year','Graduation Year','required|integer',array('integer'=>"Please enter valid year"));
            $this->form_validation->set_rules('travel_radius','Travel Radius','required|integer',array('integer'=>'Please enter valid {field}'));
            $this->form_validation->set_rules('zip','Zip Code','required');
            $this->form_validation->set_rules('address','Address','required');
            $this->form_validation->set_rules('dob','Date of Birth','required');
            /*$this->form_validation->set_rules('ssn','SSN','required');
            $this->form_validation->set_rules('driver_license_number','Drivering License Number','required');
            $this->form_validation->set_rules('driver_license_state','Drivering Lisence State','required');*/
            // $this->form_validation->set_rules('referral_code','Referral Code','required');
            $this->form_validation->set_rules('hear_about','Hear About','required');

            $this->form_validation->set_rules('map_lat','Location','required|numeric',array('required'=>'Please mark your {field}','numeric'=>'Please mark your {field}'));
            $this->form_validation->set_rules('map_lng','Location','required|numeric',array('required'=>'Please mark your {field}','numeric'=>'Please mark your {field}'));

            $this->form_validation->set_rules('profile_heading','Profile Headline','required');
            $this->form_validation->set_rules('profile_bio','Profile Bio','required');

            $this->form_validation->set_rules('confirm','Confirm','required',array('required'=>'Please accept our terms and conditions'));

            if($this->form_validation->run()===FALSE)
            {
                $res['msg'] = validation_errors();
            }else{
                $post = html_escape($this->input->post());
                

                if ($this->member_model->emailExists($post['email'],$this->session->mem_id))
                {
                    $res['msg'] = showMsg('error','Email already in use, Please try another!');
                    exit(json_encode($res));
                }

                if ($this->member_model->phoneExists($post['phone'],$this->session->mem_id))
                {
                    $res['msg'] = showMsg('error','Email already in use, Please try another!');
                    exit(json_encode($res));
                }


                if(!$this->master->getRow('subjects',array('id'=>$post['subject'],'parent_id'=>0)))
                {
                    $res['msg'] = showMsg('error','Please select a valid Subject!');
                    exit(json_encode($res));
                }

                if(count($post['subjects'])<1 && min($post['subjects'])<1)
                {
                    $res['msg'] = showMsg('error','Please select at-least one Subject!');
                    exit(json_encode($res));
                }

                foreach ($post['subjects'] as $sub_id)
                {
                    if(!$this->master->getRow('subjects',array('id'=>$sub_id,'parent_id'=>$post['subject'])))
                    {
                        $res['msg'] = showMsg('error','Please select a valid Subjects!');
                        exit(json_encode($res));
                    }
                }


                if(count($post['days'])!=count($post['start_time']) || count($post['start_time'])!=count($post['end_time']))
                {
                    $res['msg'] = showMsg('error','Inconsistent data of availability!');
                    exit(json_encode($res));
                }

                $data=array('mem_tutor_application'=>1,'mem_fname'=>ucfirst($post['fname']),'mem_lname'=>ucfirst($post['lname']),'mem_profile_heading'=>ucfirst($post['profile_heading']),'mem_about'=>ucfirst($this->input->post('profile_bio')),'mem_hourly_rate'=>floatval($post['hourly_rate']),'mem_school_name'=>ucfirst($post['school_name']),'mem_major_subject'=>ucfirst($post['major_subject']),'mem_graduation_year'=>intval($post['graduation_year']),'mem_travel_radius'=>floatval($post['travel_radius']),'mem_address1'=>ucfirst($post['address']),'mem_map_lat'=>$post['map_lat'],'mem_map_lng'=>$post['map_lng'],'mem_hear_about'=>$post['hear_about'],'mem_referral_code'=>$post['referral_code'],'mem_zip'=>$post['zip'],'mem_dob'=>db_format_date($post['dob'])/*,'mem_ssn'=>$post['ssn'],'mem_ssn'=>$post['ssn'],'mem_driver_license_number'=>$post['driver_license_number'],'mem_driver_license_state'=>$post['driver_license_state']*/);

                if($post['phone']!=$this->data['mem_data']->mem_phone){
                    $data['mem_phone']=trim($post['phone']);
                    $data['mem_verified']=0;
                }

                if ($_FILES['image']['name'] != "") {
                    $image = upload_vfile('image');
                    if (!empty($image['file_name'])) 
                        $data['mem_image'] =$image['file_name'];
                }

                $this->master->delete('tutor_subjects','mem_id',$this->session->mem_id);
                foreach ($post['subjects'] as $sub_id) {
                    $this->master->save('tutor_subjects',array('mem_id'=>$this->session->mem_id,'subject_id'=>$sub_id,'type'=>'sub'));
                }
                $this->master->save('tutor_subjects',array('mem_id'=>$this->session->mem_id,'subject_id'=>$post['subject'],'type'=>'main'));

                $this->master->delete('tutor_timings','mem_id',$this->session->mem_id);
                $week_days=get_week_days();
                foreach ($week_days as $day_key=> $day) {
                    $available=$post['days'][$day_key]!=''?1:0;
                    $start_time=$post['start_time'][$day_key]?get_full_time($post['start_time'][$day_key]):'';
                    $end_time=$post['end_time'][$day_key]?get_full_time($post['end_time'][$day_key]):'';

                    $this->master->save('tutor_timings',array('mem_id'=>$this->session->mem_id,'day'=>$day,'start_time'=>$start_time,'end_time'=>$end_time,'available'=>$available));
                }

                if($this->data['mem_data']->mem_email!=$post['email']){
                    $rando=doEncode($this->session->mem_id.'-'.$post['email']);
                    $data['mem_code']=$rando;
                    $data['mem_verified']=0;

                    /*$verify_link = site_url('verification/' .$rando);

                    $mem_data=array('name'=>ucwords($post['fname'].' '.$post['lname']),"email"=>$post['email'],"link"=>$verify_link);
                    $this->send_site_email($mem_data,'change_email');
                    setMsg('info',getSiteText('alert','verify_email'))*/;
                }


                $this->member_model->save($data, $this->session->mem_id);
                // $this->session->set_userdata('mem_type','tutor');

                $res['redirect_url'] = site_url('my-lessons');
                $res['msg'] = showMsg('success','Your became a tutor application sent successfully. Wait for Approval');
                $res['status'] = 1;
                $res['hide_msg']=0;
            }
            exit(json_encode($res));
        }
        else
            $this->load->view("account/become-a-tutor", $this->data);
    }

    function logout() {

        $this->session->unset_userdata('mem_id');
        $this->session->unset_userdata('mem_type');
        $this->session->unset_userdata('redirect_url');
        $this->load->helper('cookie');
        delete_cookie('remember');
        // $this->login();
        redirect('', 'refresh');
        exit;
    }

    function forgot() {
        $this->MemLogged();
        if ($this->input->post())
        {
            $res=array();
            $res['hide_msg']=0;
            $res['scroll_to_msg']=0;
            $res['status'] = 0;
            $res['frm_reset'] = 0;
            $res['redirect_url'] = 0;

            $this->form_validation->set_rules('email','Email','required|valid_email');
            if($this->form_validation->run()===FALSE)
            {
                $res['msg'] = validation_errors();
                $res['status'] = 0;
            }else{
                $post = $this->input->post();
                if ($mem = $this->member_model->forgotEmailExists($post['email'])) {
                    // $settings = $this->data['site_settings'];
                    $rando=doEncode(randCode(rand(15, 20)));
                    $this->master->save('members', array('mem_code' => $rando), 'mem_id', $mem->mem_id);

                    $reset_link = site_url('reset/' . $rando);
                    $mem_data=array('name'=>$mem->mem_fname.' '.$mem->mem_lname,"email"=>$mem->mem_email,"link"=>$reset_link);
                    $this->send_site_email($mem_data,'forgot_password');

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

                    $res['msg'] = showMsg('success','We’ve sent a reset password link to the email address you entered to reset your password. If you don’t see the email, check your spam folder or email!');


                    $res['status'] = 1;
                    $res['frm_reset'] = 1;
                } else {
                    $res['msg'] = showMsg('error','No such email address exists. Please try again!');
                    $res['status'] = 0;
                }
            }
            exit(json_encode($res));
        }else{
            $this->data['site_content'] = $this->master->getRow('sitecontent', array('type' => 'forgot'));
            $this->data['site_content'] =unserialize($this->data['site_content']->code);
            $this->load->view("account/forgot-password", $this->data);
        }
    }

    function reset_password() {
        $reset_id = intval($this->session->userdata('reset_id'));
        if ($row = $this->member_model->getMember($reset_id))
        {
            if ($this->input->post())
            {
                $res=array();
                $res['hide_msg']=0;
                $res['scroll_to_msg']=0;
                $res['status'] = 0;
                $res['frm_reset'] = 0;
                $res['redirect_url'] = 0;

                $reset_id = intval($this->session->userdata('reset_id'));
                if ($row = $this->member_model->getMember($reset_id))
                {
                    $this->form_validation->set_rules('pswd','New Password','required');
                    $this->form_validation->set_rules('cpswd','Confirm Password','required|matches[pswd]');
                    if($this->form_validation->run()===FALSE)
                    {
                        $res['msg'] = validation_errors();
                    }else{

                        $post = html_escape($this->input->post());

                        $this->member_model->save(array('mem_pswd' => doEncode($post['pswd'])),$reset_id);
                        $this->session->unset_userdata('reset_id');
                        $res['msg'] = showMsg('success','You have successfully reset your password!');

                        $res['redirect_url'] = site_url('');
                        $res['status'] = 1;
                        $res['frm_reset'] = 1;
                        $res['hide_msg']=1;
                    }
                }else{
                    $res['msg'] = showMsg('error','Something is wrong, try again later!');
                }
                exit(json_encode($res));

            }else{
                $this->data['site_content'] = $this->master->getRow('sitecontent', array('type' => 'reset'));
                $this->data['site_content'] =unserialize($this->data['site_content']->code);
                $this->load->view("account/reset-password", $this->data);
            }
        }else{
            redirect('', 'refresh');
            exit;
        }
    }

    function reset($vcode) {
        if ($row = $this->member_model->getMemCode($vcode))
        {
            $this->member_model->save(array('mem_code'=>''), $row->mem_id);
            $this->session->set_userdata('reset_id', $row->mem_id);
            redirect('reset-password', 'refresh');
            exit;
        }else{
            redirect('', 'refresh');
            exit;
        }
    }

    function verification($vcode='') {
        if ($row = $this->member_model->getMemCode($vcode))
        {
            $this->member_model->save(array('mem_email_verified'=>1,'mem_code'=>''), $row->mem_id);
            
            // $redirect_url=$this->session->mem_type=='student'?'account-settings':'dashboard';
            redirect('my-lessons', 'refresh');
            exit;
        }else{
            redirect('', 'refresh');
            exit;
        }
    }
    
    function search() {
        if ($post=$this->input->post()) {
            $output = array();
            $output['lstData'] = array();
            $output['paging'] = '';
            $output['total'] = 0;
            $output['post'] = $post;
            // exit(json_encode($post));
            $rows = $this->member_model->search_members($post);
            $output['query']=$this->db->last_query();
            if (count($rows) > 0) {
                $output['total'] = count($rows);
                foreach ($rows as $row) {

                    $output['lstData'][] = '
                    <li>
                    <div class="cardBlk">
                    <div class="icoBlk">
                    <div class="ico"><img src="'.get_image_src($row->mem_image,'150',true).'"></div>
                    <h4>'.format_name($row->mem_fname,$row->mem_lname).'</h4>
                    <div class="rating"><div class="rateYo" data-rateyo-rating="'.get_avg_mem_rating($row->mem_id).'" data-rateyo-read-only="true"></div><strong>('.count_mem_reviews($row->mem_id).' reviews)</strong></div>
                    <div class="subjects">'.$row->mem_profile_heading.'</div>
                    <div class="price">$'.$row->mem_hourly_rate.'<small class="semi"> /hour</small></div>
                    </div>
                    <div class="btnBlk"><a href="'.profile_url($row->mem_id,$row->mem_fname.' '.$row->mem_lname).'" class="webBtn colorBtn">View Profile</a></div>
                    <ul class="list">
                    <li>
                    <div class="inside">Background<span>checked</span></div>
                    </li>
                    <li>
                    <div class="inside"><span>150 Hours</span>tutored</div>
                    </li>
                    </ul>
                    </div>
                    </li>';
                }
                $pagesHtml = '';
                $total = intval($output['total']);
                $per_page = 15;
                $pages = ceil($total / $per_page);
                if (intval($pages) > 1):
                    for ($i = 1; $i <= intval($pages); $i++):
                        $pagesHtml .= '<li><a ' . (($i == 1) ? 'class="active"' : '') . ' data-page="' . $i . '" href="javascript:void();">' . $i . '</a></li>';
                    endfor;
                endif;
                $output['paging'] = ($pagesHtml) ? '<ul id="searchPaging" class="pagination">' . $pagesHtml . '</ul>' : '';
            }
            exit(json_encode($output));
        }else{
            $this->data['site_content'] = $this->master->getRow('sitecontent', array('type' => 'search'));
            $this->data['site_content'] =unserialize($this->data['site_content']->code);

            $this->data['get'] = $this->input->get();
            $this->data['max_price']=$this->member_model->get_max_rate();
            // $this->data['max_distance']=$this->member_model->get_max_distance();
            $this->load->view('pages/search', $this->data);
        }
    }

    function profile($encoded_id,$slug) {
        $id=intval(doDecode($encoded_id));
        if($this->data['row'] = $this->member_model->get_tutor($id)){
            $this->load->model('subject_model');
            $this->data['subjects']=$this->subject_model->get_tutor_subjects($id);
            $this->data['tutor_timings']=$this->master->getRows('tutor_timings',array('mem_id'=>$id));
            $this->data['mem_reviews']=get_mem_reviews($id);
            $this->data['review_count']=count($this->data['mem_reviews']);
            $this->data['encoded_id']=$encoded_id;
            $this->load->view('account/profile', $this->data);
        }
        else
            show_404();
    }

    public function facebook_login() {

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

    public function google_login() {

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

    public function twitter_login() {

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
       $this->session->set_userdata('oauth_token',$request_token['oauth_token']);
       $this->session->set_userdata('oauth_token_secret',$request_token['oauth_token_secret']);
       $authUrl = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
       redirect(urldecode($authUrl), 'refresh');
       exit;
   }
}

?>