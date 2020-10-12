<?php

defined('BASEPATH') or exit('No direct script access allowed');

use Twilio\Rest\Client;

class Account extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('member_model');
        $this->load->model('member_educations_model');
        $this->load->model('member_experiences_model');
    }

    function dashboard()
    {
        $this->isMemLogged('tutor');
        // $this->load->view("account/dashboard", $this->data);
        $this->load->view("lessons/my-lessons", $this->data);
    }

    function account_settings()
    {
        //$this->isMemLogged($this->session->mem_type);
        if ($this->session->mem_type == 'tutor') {
            if ($this->data['mem_data']->mem_tutor_application > 0) {
                if (empty($this->data['mem_data']->mem_stripe_id)) {
                    redirect('stripe-register');
                    exit;
                }
            }
        }
        if ($this->input->post()) {
            $res = array();
            $res['hide_msg'] = 0;
            $res['scroll_to_msg'] = 1;
            $res['status'] = 0;
            $res['frm_reset'] = 0;
            $res['redirect_url'] = 0;

            $this->form_validation->set_message('integer', 'Please select a valid {field}');
            $this->form_validation->set_rules('fname', 'First Name', 'required|alpha');
            $this->form_validation->set_rules('lname', 'Last Name', 'required|alpha');

            if ($this->session->mem_type == 'tutor') {
                $this->form_validation->set_rules('profile_heading', 'Profile Heading', 'required');
                $this->form_validation->set_rules('profile_bio', 'Profile Bio', 'required');
            } else {
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
                $this->form_validation->set_rules('country', 'Country', 'required', array('required' => 'Please select a {field}'));
            }

            if ($this->form_validation->run() === FALSE) {
                $res['msg'] = validation_errors();
            } else {
                $post = html_escape($this->input->post());
                if ($this->session->mem_type == 'tutor') {


                    $data = array('mem_fname' => ucfirst($post['fname']), 'mem_lname' => ucfirst($post['lname']), 'mem_profile_heading' => ucfirst($post['profile_heading']), 'mem_about' => ucfirst($this->input->post('profile_bio')));


                    /*if($post['phone']!=$this->data['mem_data']->mem_phone){
                        $data['mem_phone']=trim($post['phone']);
                        $data['mem_verified']=0;
                        $res['redirect_url'] = ' ';
                    }*/
                } else {
                    /*if ($this->member_model->emailExists($post['email'],$this->session->mem_id))
                    {
                        $res['msg'] = showMsg('error','Email already in use, Please try another!');
                        exit(json_encode($res));
                    }*/
                    if (!$this->master->getRow('countries', array('id' => $post['country']))) {
                        $res['msg'] = showMsg('error', 'Please select a valid Country!');
                        exit(json_encode($res));
                    }

                    $data = array('mem_fname' => ucfirst($post['fname']), 'mem_lname' => ucfirst($post['lname']), 'mem_email' => $post['email'], 'mem_country_id' => $post['country'], 'mem_city' => ucwords($post['city']), 'mem_zip' => $post['zip'], 'mem_address1' => ucfirst($post['address']));

                    $this->load->library('my_stripe');

                    $this->my_stripe->save_customer(array('name' => ucfirst($post['fname']) . ' ' . ucfirst($post['lname']), 'email' => $post['email'], 'phone' => $this->data['mem_data']->mem_phone), $this->data['mem_data']->mem_stripe_id, "Crainly Customer " . ucfirst($post['fname']) . ' ' . ucfirst($post['lname']) . ' id ' . $this->session->mem_id);

                    if ($this->data['mem_data']->mem_email != $post['email']) {

                        $rando = doEncode($this->session->mem_id . '-' . $post['email']);
                        $data['mem_email'] = $post['email'];
                        $data['mem_code'] = $rando;
                        $data['mem_email_verified'] = 0;

                        /*$verify_link = site_url('verification/' .$rando);

                        $mem_data=array('name'=>ucwords($post['fname'].' '.$post['lname']),"email"=>$post['email'],"link"=>$verify_link);
                        $this->send_site_email($mem_data,'change_email');
                        $res['redirect_url']=' ';
                        setMsg('info',getSiteText('alert','verify_email'));*/
                    }
                }




                $this->member_model->save($data, 'mem_id', $this->session->mem_id);

                $res['msg'] = showMsg('success', 'Profile update successfully!');
                $res['status'] = 1;
                $res['hide_msg'] = 1;
            }
            exit(json_encode($res));
        } else {
            $checkTimings = $this->member_model->check_timing($this->session->mem_id);
            $this->data['alertText'] = '';
            if (count($checkTimings) == 0) {
                $this->data['alertText'] = 'Your schedule is not yet created on your profile';
            }
            if ($this->session->mem_type == 'tutor') {
                $this->data['tutor_main_subject'] = $this->master->getRow('tutor_subjects', array('mem_id' => $this->session->mem_id, 'type' => 'main'));
                $this->data['tutor_timings'] = $this->master->getRows('tutor_timings', array('mem_id' => $this->session->mem_id));
                $this->data['eduction'] = $this->member_educations_model->getRecordMemberwise($this->session->mem_id);
                if ( count($this->data['eduction']) > 0 ) {
                    $this->data['eduction'] = json_decode(json_encode($this->data['eduction']), 1);
                    foreach ($this->data['eduction'] as $i => $edu) {
                        $this->data['eduction'][$i]['fromYear'] = $edu['from_year'];
                        $this->data['eduction'][$i]['toYear'] = $edu['to_year'];
                        $this->data['eduction'][$i]['studyField'] = $edu['study_field'];
                    }
                }
                $this->data['experiences'] = $this->member_experiences_model->getRecordMemberwise($this->session->mem_id);
                if ( count($this->data['experiences']) > 0 ) {
                    $this->data['experiences'] = json_decode(json_encode($this->data['experiences']), 1);
                    foreach ($this->data['experiences'] as $j => $exp) {
                        $this->data['experiences'][$j]['fromMonth'] = $exp['from_month'];
                        $this->data['experiences'][$j]['fromYear'] = $exp['from_year'];
                        $this->data['experiences'][$j]['toMonth'] = $exp['to_month'];
                        $this->data['experiences'][$j]['toYear'] = $exp['to_year'];
                        $this->data['experiences'][$j]['name'] = $exp['company_name'];
                        $this->data['experiences'][$j]['is_currently_work'] = (($exp['is_currently_work'] == '0') ? false : true);
                    }
                }
            }
            // echo '<pre>';print_r($this->data);exit;
            $this->load->view("account/" . $this->session->mem_type . "-account-settings", $this->data);
        }
    }

    function additional_subjects()
    {
        //$this->isMemLogged('tutor');
        if ($this->input->post()) {
            $res = array();
            $res['hide_msg'] = 0;
            $res['scroll_to_msg'] = 1;
            $res['status'] = 0;
            $res['frm_reset'] = 0;
            $res['redirect_url'] = 0;

            $this->form_validation->set_rules('subject', 'Subject', 'required|integer');
            //$this->form_validation->set_rules('subjects[]','Subjects','required|integer');

            if ($this->form_validation->run() === FALSE) {
                $res['msg'] = validation_errors();
            } else {
                $post = html_escape($this->input->post());
                $group = $this->input->post('subject');
                $subject = $this->master->getRow('subjects', array('id' => $group));
                // $this->data['sub_subjects'] = $this->master->getRows('subjects', array('parent_id !=' => '0'));
                /*if(!$this->master->getRow('subjects',array('id'=>$post['subject'],'parent_id'=>0)))
                {
                    $res['msg'] = showMsg('error','Please select a valid Subject!');
                    exit(json_encode($res));
                }*/

                if (count($subjects) < 1 && min($post[$subjects[$group]]) != '') {
                    $res['msg'] = showMsg('error', 'Please select at-least one Subject!');
                    exit(json_encode($res));
                }

                /* foreach ($post[$subjects[$group]] as $sub_id)
                {
                    if(!$this->master->getRow('subjects',array('id'=>$sub_id,'parent_id'=>$post['subject'])))
                    {
                        $res['msg'] = showMsg('error','Please select a valid Subjects!');
                        exit(json_encode($res));
                    }
                }*/

                $this->master->delete('tutor_subjects', 'mem_id', $this->session->mem_id);
                $sub_subjects = null;
                $loop = 0;
                if (!empty($post['sub_' . $group . ''])) {

                    $tblTutorSubjects = array('mem_id' => $this->session->mem_id, 'subject_id' => $group, 'parent_id' => 0, 'type' => 'main');
                    $this->master->save('tutor_subjects', $tblTutorSubjects);

                    foreach ($post['sub_' . $group . ''] as $k => $val) {
                        $tblTutorSubjects = array('mem_id' => $this->session->mem_id, 'subject_id' => $val, 'parent_id' => $group, 'type' => 'sub');
                        $this->master->save('tutor_subjects', $tblTutorSubjects);

                        $sub_subject = $this->master->getRow('subjects', array('parent_id' => $group, 'id' => $val));
                        $sub_subjects[$loop] = $sub_subject->name;
                        $loop++;
                    }
                }


                /*foreach ($post[$subjects[$group]] as $sub_id) {
                    $this->master->save('tutor_subjects',array('mem_id'=>$this->session->mem_id,'subject_id'=>$sub_id,'type'=>'sub'));
                }*/
                //$this->master->save('tutor_subjects',array('mem_id'=>$this->session->mem_id,'subject_id'=>$post['subject'],'type'=>'main'));

                $getRow = $this->master->getRow('members', array('mem_id' => $this->session->mem_id));
                $me_subjects = json_decode($getRow->mem_subjects,  true);
                $me_subjects[$subject->name] = $sub_subjects;
                $Updated_mem_subjects = json_encode($me_subjects);
                $arr = array('mem_subjects' => $Updated_mem_subjects);

                $mem_id = $this->member_model->save($arr, 'mem_id', $this->session->mem_id);

                $res['msg'] = showMsg('success', 'Additional Subjects updated successfully!');
                $res['status'] = 1;
                $res['hide_msg'] = 1;
            }
            exit(json_encode($res));
        } else
            show_404();
    }
    function setonlinelesson()
    {
        if ($this->input->post()) {
            $res = array();
            $res['hide_msg'] = 0;
            $res['scroll_to_msg'] = 1;
            $res['status'] = 0;
            $res['frm_reset'] = 0;
            $res['redirect_url'] = 0; {
                $post = html_escape($this->input->post());

                $data = array('mem_onlinelesson' => $post['onlinelesson']);

                $this->member_model->save($data, 'mem_id', $this->session->mem_id);
                $res['msg'] = showMsg('success', 'Additional Info updated successfully!');
                $res['status'] = 1;
                $res['hide_msg'] = 1;
            }
            exit(json_encode($res));
        } else
            show_404();
    }
    function additional_info()
    {
        //$this->isMemLogged('tutor');
        if ($this->input->post()) {
            $res = array();
            $res['hide_msg'] = 0;
            $res['scroll_to_msg'] = 1;
            $res['status'] = 0;
            $res['frm_reset'] = 0;
            $res['redirect_url'] = 0;

            $this->form_validation->set_message('integer', 'Please select a valid {field}');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

            $this->form_validation->set_rules('hourly_rate', 'Hourly Rate', 'required|integer|less_than_equal_to[150]|greater_than_equal_to[20]', array('integer' => 'Please enter valid {field}'));
            // $this->form_validation->set_rules('school_name', 'School Name', 'required');
            // $this->form_validation->set_rules('major_subject', 'Major Subject', 'required');
            // $this->form_validation->set_rules('graduation_year', 'Graduation Year', 'required|integer', array('integer' => "Please enter valid year"));
            $this->form_validation->set_rules('travel_radius', 'Travel Radius', 'required|integer', array('integer' => 'Please enter valid {field}'));
            $this->form_validation->set_rules('zip', 'Zip Code', 'required');
            $this->form_validation->set_rules('address', 'Address', 'required');

            if ($this->form_validation->run() === FALSE) {
                $res['msg'] = validation_errors();
            } else {
                $post = html_escape($this->input->post());


                if ($this->member_model->emailExists($post['email'], $this->session->mem_id)) {
                    $res['msg'] = showMsg('error', 'Email already in use, Please try another!');
                    exit(json_encode($res));
                }

                $data = array('mem_hourly_rate' => floatval($post['hourly_rate']), 'mem_school_name' => ucfirst($post['school_name']), 'mem_major_subject' => ucfirst($post['major_subject']), 'mem_graduation_year' => intval($post['graduation_year']), 'mem_travel_radius' => floatval($post['travel_radius']), 'highest_level_of_education' => $post['highest_level_of_education'], 'mem_address2' => ucfirst($post['address2']), 'mem_address1' => ucfirst($post['address']), 'mem_zip' => $post['zip'], 'mem_state_id' => $post['state'], 'mem_city' => $post['city']);

                if (!empty($post['zip'])) {
                    $coordinates = get_location_detail($post['zip']);
                    $data['mem_map_lat'] = $coordinates->Latitude;
                    $data['mem_map_lng'] = $coordinates->Longitude;
                }
                if ($this->data['mem_data']->mem_email != $post['email']) {
                    $rando = doEncode($this->session->mem_id . '-' . $post['email']);
                    $data['mem_email'] = $post['email'];
                    $data['mem_code'] = $rando;
                    $data['mem_email_verified'] = 0;

                    /*$verify_link = site_url('verification/' .$rando);

                    $mem_data=array('name'=>ucwords($post['fname'].' '.$post['lname']),"email"=>$post['email'],"link"=>$verify_link);
                    $this->send_site_email($mem_data,'change_email');
                    $res['redirect_url']=' ';
                    setMsg('info',getSiteText('alert','verify_email'));*/
                }

                $this->member_model->save($data, 'mem_id', $this->session->mem_id);
                $res['msg'] = showMsg('success', 'Additional Info updated successfully!');
                $res['status'] = 1;
                $res['hide_msg'] = 1;
            }
            exit(json_encode($res));
        } else
            show_404();
    }

    function education()
    {
        if ($this->input->post()) {
            $res = array();
            $res['hide_msg'] = 0;
            $res['scroll_to_msg'] = 1;
            $res['status'] = 0;
            $res['frm_reset'] = 0;
            $res['redirect_url'] = 0;

            $this->form_validation->set_message('integer', 'Please select a valid {field}');
            $this->form_validation->set_rules('education', 'Education', 'required');

            if ($this->form_validation->run() === FALSE) {
                $res['msg'] = validation_errors();
            } else {
                $post = html_escape($this->input->post());
                $Education = json_decode(html_entity_decode($post['education']), true);
                
                // Insert Education
                if ( count($Education) > 0 ) {
                    $this->member_educations_model->deleteMemberwise($this->session->mem_id);
                    foreach ($Education as $edu) {
                        $edu['mem_id'] = $this->session->mem_id;
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

                $res['msg'] = showMsg('success', 'Educations synced successfully!');
                $res['status'] = 1;
                $res['hide_msg'] = 1;
            }
            exit(json_encode($res));
        } else
            show_404();
    }

    function experience()
    {
        if ($this->input->post()) {
            $res = array();
            $res['hide_msg'] = 0;
            $res['scroll_to_msg'] = 1;
            $res['status'] = 0;
            $res['frm_reset'] = 0;
            $res['redirect_url'] = 0;

            $this->form_validation->set_message('integer', 'Please select a valid {field}');
            $this->form_validation->set_rules('workExperiences', 'Work Experiences', 'required');

            if ($this->form_validation->run() === FALSE) {
                $res['msg'] = validation_errors();
            } else {
                $post = html_escape($this->input->post());
                $workExperiences = json_decode(html_entity_decode($post['workExperiences']), true);
                
                // Insert Work Experiences
                if ( count($workExperiences) > 0 ) {
                    $this->member_experiences_model->deleteMemberwise($this->session->mem_id);
                    foreach ($workExperiences as $exp) {
                        $exp['mem_id'] = $this->session->mem_id;
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

                $res['msg'] = showMsg('success', 'Work Experiences synced successfully!');
                $res['status'] = 1;
                $res['hide_msg'] = 1;
            }
            exit(json_encode($res));
        } else
            show_404();
    }

    function availability()
    {
        //$this->isMemLogged('tutor');
        if ($this->input->post()) {
            $res = array();
            $res['hide_msg'] = 0;
            $res['scroll_to_msg'] = 1;
            $res['status'] = 0;
            $res['frm_reset'] = 0;
            $res['redirect_url'] = 0;
            $post = html_escape($this->input->post());

            if (count($post['days']) != count($post['start_time']) || count($post['start_time']) != count($post['end_time'])) {
                $res['msg'] = showMsg('error', 'Inconsistent data of availability!');
                exit(json_encode($res));
            }
            $this->master->delete('tutor_timings', 'mem_id', $this->session->mem_id);
            $week_days = get_week_days();
            foreach ($week_days as $day_key => $day) {
                $available = $post['days'][$day_key] != '' ? 1 : 0;
                $start_time = ($post['start_time'][$day_key] && $post['start_time'][$day_key] != "Anytime") ? get_full_time($post['start_time'][$day_key]) : '';
                $end_time = ($post['end_time'][$day_key] && $post['end_time'][$day_key] != "Anytime") ? get_full_time($post['end_time'][$day_key]) : '';
                $this->master->save('tutor_timings', array('mem_id' => $this->session->mem_id, 'day' => $day, 'start_time' => $start_time, 'end_time' => $end_time, 'available' => $available));
            }
            $res['msg'] = showMsg('success', 'Availability updated successfully!');
            $res['status'] = 1;
            $res['hide_msg'] = 1;
            exit(json_encode($res));
        } else
            show_404();
    }

    function change_pswd()
    {
        //$this->isMemLogged($this->session->mem_type);
        if ($this->input->post()) {
            $res = array();
            $res['hide_msg'] = 0;
            $res['scroll_to_msg'] = 1;
            $res['redirect_url'] = 0;
            $res['status'] = 0;
            $res['frm_reset'] = 0;

            $this->form_validation->set_rules('pswd', 'Current Password', 'required');
            $this->form_validation->set_rules('npswd', 'New Password', 'required');
            $this->form_validation->set_rules('cpswd', 'Confirm Password', 'required|matches[npswd]');
            if ($this->form_validation->run() === FALSE) {
                $res['msg'] = validation_errors();
            } else {
                $post = html_escape($this->input->post());
                $row = $this->member_model->oldPswdCheck($this->data['mem_data']->mem_id, $post['pswd']);
                if (count($row) > 0) {
                    $ary = array('mem_pswd' => doEncode($post['npswd']));
                    $this->member_model->save($ary, $this->data['mem_data']->mem_id);
                    $res['msg'] = showMsg('success', 'Password successfully updated!');

                    $res['status'] = 1;
                    $res['frm_reset'] = 1;
                    $res['hide_msg'] = 1;
                } else {
                    $res['msg'] = showMsg('error', 'Old Password Does Not Match!');
                }
            }
            exit(json_encode($res));
        }
    }

    function invite_friend()
    {
        //$this->isMemLogged($this->session->mem_type);
        if ($this->session->mem_type == 'tutor') {
            if ($this->data['mem_data']->mem_tutor_application > 0) {
                if (empty($this->data['mem_data']->mem_stripe_id)) {
                    redirect('stripe-register');
                    exit;
                }
            }
        } elseif (empty($this->session->mem_type)) {
            redirect('login');
            exit;
        }

        if ($this->input->post()) {
            $res = array();
            $res['hide_msg'] = 0;
            $res['scroll_to_msg'] = 1;
            $res['redirect_url'] = 0;
            $res['status'] = 0;
            $res['frm_reset'] = 0;

            $this->form_validation->set_rules('emails', 'Email', 'required');
            if ($this->form_validation->run() === FALSE) {
                $res['msg'] = validation_errors();
            } else {
                $post = html_escape($this->input->post());
                $emails = @explode(',', $post['emails']);
                // exit(json_encode($emails));
                if (count($emails) > 0) {
                    foreach ($emails as $key => $email) {
                        if (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
                            $res['msg'] = showMsg('error', 'Please enter valid comma separated emails');
                            exit(json_encode($res));
                        }
                    }
                    $new_count = 0;
                    foreach ($emails as $key => $email) {

                        $ref_code = $this->data['mem_data']->mem_referral_code;
                        //$referral_signup_link = site_url(($this->session->mem_type=='tutor'?'rts':'rs').'/'.$ref_code);
                        $referral_signup_link = site_url('rs' . '/' . $ref_code);

                        $mem_data = array('name' => ucfirst($this->data['mem_data']->mem_fname) . ' ' . ucfirst($this->data['mem_data']->mem_lname), "email" => $email, "link" => $referral_signup_link);

                        if (send_site_email($mem_data, 'invite_friend'))
                            $new_count++;
                    }
                    $s = $new_count > 1 ? 's' : '';
                    $res['msg'] = showMsg('success', "Email has been sent to your friend$s !");


                    $res['frm_reset'] = 1;
                    $res['status'] = 1;
                } else {
                    $res['msg'] = showMsg('error', 'Please enter emails!');
                }
            }
            exit(json_encode($res));
        } else
            $this->load->view('account/invite-friend', $this->data);
    }

    function share_profile()
    {
        //$this->isMemLogged($this->session->mem_type);
        if ($this->session->mem_type == 'tutor') {
            if ($this->data['mem_data']->mem_tutor_application > 0) {
                if (empty($this->data['mem_data']->mem_stripe_id)) {
                    redirect('stripe-register');
                    exit;
                }
            }
        } elseif (empty($this->session->mem_type)) {
            redirect('login');
            exit;
        }

        if ($this->input->post()) {
            $res = array();
            $res['hide_msg'] = 0;
            $res['scroll_to_msg'] = 1;
            $res['redirect_url'] = 0;
            $res['status'] = 0;
            $res['frm_reset'] = 0;

            $this->form_validation->set_rules('emails', 'Email', 'required');
            if ($this->form_validation->run() === FALSE) {
                $res['msg'] = validation_errors();
            } else {
                $post = html_escape($this->input->post());
                $emails = @explode(',', $post['emails']);
                // exit(json_encode($emails));
                if (count($emails) > 0) {
                    foreach ($emails as $key => $email) {
                        if (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
                            $res['msg'] = showMsg('error', 'Please enter valid comma separated emails');
                            exit(json_encode($res));
                        }
                    }
                    // $new_count = 0;
                    foreach ($emails as $key => $email) {

                        $ref_code = $this->data['mem_data']->mem_referral_code;
                        //$referral_signup_link = site_url(($this->session->mem_type=='tutor'?'rts':'rs').'/'.$ref_code);
                        //	                    $referral_signup_link = site_url('profile/'.doEncode($this->data['mem_data']->mem_id).'/'.toSlugUrl($this->data['mem_data']->mem_fname.' '.$this->data['mem_data']->mem_lname));
                        $referral_signup_link = site_url('tutor/' . doEncode($this->data['mem_data']->mem_id));

                        $mem_data = array('name' => ucfirst($this->data['mem_data']->mem_fname) . ' ' . ucfirst($this->data['mem_data']->mem_lname), "email" => $email, "link" => $referral_signup_link);

                        // if (send_site_email($mem_data, 'share_profile'))
                        //     $new_count++;
                    }
                    // $s = $new_count > 1 ? 's' : '';
                    // $res['msg'] = showMsg('success', "Email has been sent to your friend$s !");
                    $res['msg'] = showMsg('success', "Email has been sent to your friend(s)!");


                    $res['frm_reset'] = 1;
                    $res['status'] = 1;
                } else {
                    $res['msg'] = showMsg('error', 'Please enter emails!');
                }
            }
            exit(json_encode($res));
        } else
            $this->load->view('account/share-profile', $this->data);
    }

    function profile()
    {
        if ($this->session->mem_type == 'tutor') {
            if ($this->data['mem_data']->mem_tutor_application > 0) {
                if (empty($this->data['mem_data']->mem_stripe_id)) {
                    redirect('stripe-register');
                    exit;
                }
            }
            
            $this->data['row'] = $this->data['mem_data'];

            $this->load->model('subject_model');
            //$this->data['subjects']=$this->subject_model->get_tutor_subjects($this->session->mem_id);
            $this->data['eduction'] = $this->member_educations_model->getRecordMemberwise($this->session->mem_id);
            $this->data['experiences'] = $this->member_experiences_model->getRecordMemberwise($this->session->mem_id);
            $this->data['subjects'] = $this->data['mem_data']->mem_subjects;

            $this->data['tutor_timings'] = $this->master->getRows('tbl_tutor_timings', array('mem_id' => $this->session->mem_id));
            $this->data['mem_reviews'] = get_mem_reviews($this->session->mem_id);
            $this->data['review_count'] = count($this->data['mem_reviews']);
            $this->data['encoded_id'] = $encoded_id;
            $this->load->view('account/profile', $this->data);
        } else
            show_404();
    }

    function report_profile()
    {

        list($type, $id) = explode('-', doDecode($this->input->post('store')));
        $id = intval($id);
        if ($id < 1 || $type != 'profile' || !$row = $this->member_model->getMember($id, array('mem_status' => 1, 'mem_verified' => 1)))
            die('access denied!');

        $res = array();
        $res['hide_msg'] = 1;
        $res['scroll_to_msg'] = 1;
        $res['status'] = 0;
        $res['frm_reset'] = 1;
        $res['redirect_url'] = 0;

        $this->form_validation->set_rules('reason', 'Reason', 'required');
        if ($this->form_validation->run() === FALSE) {
            $res['msg'] = validation_errors();
        } else {
            $post = html_escape($this->input->post());
            $this->master->save('reports', array('mem_id' => $this->session->mem_id, 'profile_id' => $id, 'reason' => $post['reason']));
            $res['msg'] = showMsg('success', 'Profile reported successfully!');
            $res['status'] = 1;
        }
        exit(json_encode($res));
    }

    function change_phone()
    {
        $verification_check = $this->data['mem_data']->mem_verified == 0 ? false : true;
        $this->isMemLogged($this->session->mem_type, $verification_check);
        if ($this->input->post()) {
            $res = array();
            $res['hide_msg'] = 0;
            $res['scroll_to_msg'] = 1;
            $res['redirect_url'] = 0;
            $res['status'] = 0;
            $res['frm_reset'] = 0;

            $this->form_validation->set_rules('phone', 'Phone', 'required|integer|min_length[10]|max_length[10]', array('integer' => 'Please enter valid US phone number', 'min_length' => 'Please enter valid US phone number', 'max_length' => 'Please enter valid US phone number'));
            if ($this->form_validation->run() === FALSE) {
                $res['msg'] = validation_errors();
            } else {
                $post = html_escape($this->input->post());
                if ($post['phone'] == $this->data['mem_data']->mem_phone) {
                    $res['msg'] = showMsg('error', 'Please change Phone Number to updated!');
                    exit(json_encode($res));
                }
                if ($this->member_model->phoneExists($post['phone'], $this->session->mem_id)) {
                    $res['msg'] = showMsg('error', 'Phone Already In Use!');
                    exit(json_encode($res));
                }
                $ary = array('mem_phone' => trim($post['phone']));
                if ($post['phone'] != $this->data['mem_data']->mem_phone) {
                    $ary['mem_verified'] = 0;
                    $res['redirect_url'] = ' ';
                }

                $this->member_model->save($ary, $this->session->mem_id);
                $res['msg'] = showMsg('success', 'Phone number successfully updated!');
                $res['status'] = 1;
            }
            exit(json_encode($res));
        }
    }

    function verify_phone()
    {
        $this->isMemLogged($this->session->mem_type);
        if ($this->input->post()) {
            $res = array();
            $res['hide_msg'] = 0;
            $res['scroll_to_msg'] = 1;
            $res['redirect_url'] = 0;
            $res['status'] = 0;
            $res['frm_reset'] = 0;

            $this->form_validation->set_rules('code[]', 'code', 'required|integer');
            if ($this->form_validation->run() === FALSE) {
                $res['msg'] = validation_errors();
            } else {
                $post = html_escape($this->input->post());
                $code = implode('', $post['code']);
                if (!$this->member_model->getMember($this->session->mem_id, array('mem_phone_code' => $code))) {
                    $res['msg'] = showMsg('error', 'Invalid code!');
                    exit(json_encode($res));
                }

                $mem_data = array('mem_phone_code' => '', 'mem_verified' => 1);
                $this->member_model->save($mem_data, $this->session->mem_id);
                $res['msg'] = showMsg('success', 'Phone Number verified successfully!');
                $res['status'] = 1;
                $res['redirect_url'] = ' ';
            }
            exit(json_encode($res));
        }
        die('access denied!');
    }

    function verify_phone_code()
    {
        $this->isMemLogged($this->session->mem_type, false, false);
        if ($this->data['mem_data']->mem_verified == 1) {
            // $url=$this->session->mem_type=='student'?'account-settings':'dashboard';
            redirect('my-lessons');
            exit;
        }

        if ($this->input->post()) {
            $res = array();
            $res['hide_msg'] = 0;
            $res['scroll_to_msg'] = 1;
            $res['redirect_url'] = 0;
            $res['status'] = 0;
            $res['frm_reset'] = 0;

            if (!empty($this->data['mem_data']->mem_phone) && empty($this->data['mem_data']->mem_phone_verified)) {

                $code = rand(111111, 999999);
                if ($_SERVER['HTTP_HOST'] != 'localhost') {
                    $client = new Client(TWILIO_SID, TWILIO_TOEKN);
                    try {
                        $client->messages
                            ->create(
                                '+1' . $this->data['mem_data']->mem_phone,
                                array(
                                    "from" => TWILIO_NUMBER,
                                    "body" => $code . " is your Crainly code. Don't share this code with others"
                                )
                            );
                    } catch (Exception $e) {
                        $res['msg'] = '<div class="alert alert-danger alert-sm">' . $e->getMessage() . '</div>';
                        $res['status'] = 0;
                        exit(json_encode($res));
                    }
                }

                // send_twilio_msg($this->data['mem_data']->mem_phone,$code." is your Crainly code. Don't share this code with others");

                $ary = array('mem_phone_code' => $code);

                $this->member_model->save($ary, $this->session->mem_id);
                $res['status'] = 1;
            }
            exit(json_encode($res));
        }
        die('access denied!');
    }

    function phone_verification()
    {
        $this->isMemLogged($this->session->mem_type, false, false);
        if ($this->data['mem_data']->mem_verified == 1) {
            // $url=$this->session->mem_type=='student'?'account-settings':'dashboard';
            redirect('my-lessons');
            exit;
        }
        if ($this->input->post()) {
            $res = array();
            $res['hide_msg'] = 0;
            $res['scroll_to_msg'] = 1;
            $res['redirect_url'] = 0;
            $res['status'] = 0;
            $res['frm_reset'] = 0;

            $this->form_validation->set_rules('code[]', 'code', 'required|integer');
            if ($this->form_validation->run() === FALSE) {
                $res['msg'] = validation_errors();
            } else {
                $post = html_escape($this->input->post());
                $code = implode('', $post['code']);
                if (!$this->member_model->getMember($this->session->mem_id, array('mem_phone_code' => $code))) {
                    $res['msg'] = showMsg('error', 'Invalid code!');
                    exit(json_encode($res));
                }

                $mem_data = array('mem_phone_code' => '', 'mem_verified' => 1);
                $this->member_model->save($mem_data, $this->session->mem_id);
                $res['msg'] = showMsg('success', 'Phone Number verified successfully!');
                $res['status'] = 1;
                $res['redirect_url'] = ' ';
                // $res['redirect_url'] = $this->session->mem_type=='tutor' && $this->session->mem_tutor_verified==0 && $this->session->mem_tutor_verified==0 && $this->session->mem_tutor_application==0?'become-a-tutor':' '
            }
            exit(json_encode($res));
        } else {
            $this->data['site_content'] = $this->master->getRow('sitecontent', array('type' => 'phone_verify'));
            $this->data['site_content'] = unserialize($this->data['site_content']->code);
            $this->load->view("account/verify-phone", $this->data);
        }
    }

    function email_verification()
    {
        $this->isMemLogged($this->session->mem_type);
        if ($this->data['mem_data']->mem_email_verified == 1) {
            // $url=$this->session->mem_type=='student'?'account-settings':'dashboard';
            redirect('my-lessons');
            exit;
        }

        if ($this->input->post()) {
            $res = array();
            $res['frm_reset'] = 0;
            $res['hide_msg'] = 0;
            $res['scroll_to_msg'] = 0;
            $res['status'] = 0;
            $res['redirect_url'] = 0;
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            if ($this->form_validation->run() === FALSE) {
                $res['msg'] = validation_errors();
            } else {
                $post = html_escape($this->input->post());

                if (!$this->member_model->emailExists($post['email'], $this->session->mem_id)) {
                    // $rando=doEncode(rand(111111, 999999));
                    $rando = doEncode($this->session->mem_id . '-' . $post['email']);
                    $rando = strlen($rando) > 225 ? substr($rando, 0, 225) : $rando;

                    $this->member_model->save(array('mem_code' => $rando, 'mem_email' => $post['email']), $this->session->mem_id);
                    $verify_link = site_url('verification/' . $rando);

                    $mem_data = array('name' => $this->data['mem_data']->mem_fname . ' ' . $this->data['mem_data']->mem_lname, "email" => $post['email'], "link" => $verify_link);
                    $this->send_site_email($mem_data, 'change_email');

                    $res['redirect_url'] = ' ';

                    $res['msg'] = showMsg('success', 'Email has been changed successful! Please wait.');
                    setMsg('info', getSiteText('alert', 'verify_email'));

                    $res['status'] = 1;
                    $res['frm_reset'] = 1;
                    $res['hide_msg'] = 1;
                } else {
                    $res['msg'] = showMsg('error', 'Email already exists!');
                }
            }
            exit(json_encode($res));
        } else {

            $this->data['site_content'] = $this->master->getRow('sitecontent', array('type' => 'email_verify'));
            $this->data['site_content'] = unserialize($this->data['site_content']->code);
            $this->load->view("account/verify-email", $this->data);
        }
    }

    function resend_email()
    {
        $this->isMemLogged($this->session->mem_type, false);

        $res = array();
        $res['hide_msg'] = 0;
        $res['scroll_to_msg'] = 0;
        $res['status'] = 0;
        $res['frm_reset'] = 0;
        $res['redirect_url'] = 0;

        $rando = doEncode($this->session->mem_id . '-' . $this->data['mem_data']->mem_email);
        $rando = strlen($rando) > 225 ? substr($rando, 0, 225) : $rando;

        $this->member_model->save(array('mem_code' => $rando), $this->session->mem_id);

        $verify_link = site_url('verification/' . $rando);

        $mem_data = array('name' => $this->data['mem_data']->mem_fname . ' ' . $this->data['mem_data']->mem_lname, "email" => $this->data['mem_data']->mem_email, "link" => $verify_link);

        $ok = $this->send_site_email($mem_data, 'verify_email');

        $res['msg'] = $ok ? showMsg('success', 'Email sent successfully!') : showMsg('error', 'There is an error occurred, Please try again later!');
        $res['status'] = 1;
        $res['hide_msg'] = 1;

        exit(json_encode($res));
    }
}
