<?php

class Tutors extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->isLogged();
        has_access(2);
        $this->load->model('member_model');
        $this->load->model('member_educations_model');
        $this->load->model('member_experiences_model');
    }

    public function index() {
        $this->data['enable_datatable'] = TRUE;
        $this->data['pageView'] = ADMIN . '/tutors';
        $this->data['rows'] = $this->member_model->get_rows(array('mem_type' => 'tutor', 'mem_status' => 1), '', '', 'desc');
        $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
    }

    function tutor_registrations() {
        $this->data['enable_datatable'] = TRUE;
        $this->data['pageView'] = ADMIN . '/tutor_registrations';
        $this->data['rows'] = $this->member_model->get_rows(array('mem_type' => 'tutor', 'mem_status' => 0, 'is_profile_complete' => 1), '', '', 'desc');
        $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
    }

    function manage() {
        $this->data['pageView'] = ADMIN . '/tutors';
        $row = $this->member_model->getMember($this->uri->segment('4'));
        $subject = $this->master->getRows('subjects', array('parent_id' => '0'));
        $this->data['subjects'] = $subject;
        $this->data['sub_subjects'] = $this->master->getRows('subjects', array('parent_id !=' => '0'));
        // pr($row);
        if ($this->input->post()) {
            $post = $this->input->post();
            $vals = $post;
            $subjects = [];
            $subjectsFiltered = [];
            if ( $this->uri->segment('4') != '' ) {
                $this->master->delete('tutor_subjects', 'mem_id', $this->uri->segment('4'));
            }
            foreach ($subject as $key => $value) {
                $sub_subjects =null; $loop = 0;
                if(!empty($post['sub_'.$value->id.''])) {

                    $tblTutorSubjects = array('mem_id' => $this->uri->segment('4'), 'parent_id'=> '0', 'subject_id' => $value->id, 'type' => 'main' );
                    if ( $this->uri->segment('4') != '' ) {
                        $this->master->save('tutor_subjects', $tblTutorSubjects);
                    } else {
                        array_push($subjectsFiltered, $tblTutorSubjects);
                    }
                    foreach ($post['sub_'.$value->id.''] as $k => $val) {
                        $tblTutorSubjects = array('mem_id' => $this->uri->segment('4'), 'parent_id'=> $value->id, 'subject_id' => $val, 'type' => 'sub' );
                        if ( $this->uri->segment('4') != '' ) {
                            $this->master->save('tutor_subjects', $tblTutorSubjects);
                        } else {
                            array_push($subjectsFiltered, $tblTutorSubjects);
                        }
                        $sub_subject = $this->master->getRow('subjects', array('parent_id'=> $value->id, 'id' => $val));
                        $sub_subjects[$loop] = $sub_subject->name;
                        $loop++;
                    }
                }
                $subjects[$value->name] = $sub_subjects;
                unset($vals[$value->name]);
                unset($vals['sub_'.$value->id.'']);
            }

            $subjects = json_encode($subjects);
            $vals['mem_subjects'] = $subjects;
            // exit(json_encode($vals['mem_subjects']))  ;

            $vals['mem_type'] = 'tutor';
            $vals['mem_verified'] = $post['mem_verified'];

            $mem_verified = $post['mem_verified'];
            if($vals['mem_verified'] == null)
                $vals['mem_verified'] = '0';
            if($mem_verified == 1)
			{
				$check_info = array('status' => 1, 'date' => date('Y-m-d H:i:s'));
				$this->master->save("background_check_info", $check_info, 'tutor_id', $this->uri->segment('4'));
			}

            $email = $post['mem_email'];

            unset($vals['subject'], $vals['subjects'], $vals['days'], $vals['start_time'], $vals['end_time']);

            if ($vals['mem_pswd'] != '' && access(9))
                $vals['mem_pswd'] = doEncode($vals['mem_pswd']);
            else
                unset($vals['mem_pswd']);

            if (($_FILES["mem_image"]["name"] != "")) {
                $image = upload_vfile('mem_image');
                if (!empty($image['file_name'])) {
                    if (!empty($row->mem_image))
                        remove_vfile($row->mem_image);
                    $vals['mem_image'] = $image['file_name'];
                }
            }
            $savedata=array('mem_address2'=>ucfirst($post['mem_address2']),'mem_address1'=>ucfirst($post['mem_address1']),'mem_zip'=>$post['mem_zip'],'mem_state_id'=>$post['mem_state'],'mem_city'=>$post['mem_city'],'mem_onlinelesson'=>($post['onlinelesson'] ? '1' : '0'));
            $mem_id = $this->member_model->save($savedata, 'mem_id', $this->uri->segment('4'));
            // pr($mem_id);
            //$mem_id=$this->member_model->save($vals, $this->uri->segment(4));

            // Sync Education Data
            if ( isset($post['edu_name']) && count($post['edu_name']) > 0 ) {
                $this->member_educations_model->deleteMemberwise($mem_id);
                foreach ($post['edu_name'] as $eduI => $edu) {
                    $eduArr = array(
                        'mem_id' => $mem_id,
                        'college' => $edu,
                        'degree' => $post['edu_degree'][$eduI],
                        'study_field' => $post['edu_study'][$eduI],
                        'from_year' => $post['edu_from_year'][$eduI],
                        'to_year' => $post['edu_to_year'][$eduI]
                    );
                    $m_edu_id = $this->member_educations_model->save($eduArr);
                }
            }
            unset($vals['edu_name']);
            unset($vals['edu_degree']);
            unset($vals['edu_study']);
            unset($vals['edu_from_year']);
            unset($vals['edu_to_year']);

            // Sync Word Data
            if ( isset($post['work_company_name']) && count($post['work_company_name']) > 0 ) {
                $this->member_experiences_model->deleteMemberwise($mem_id);
                foreach ($post['work_company_name'] as $expI => $exp) {
                    $expArr = array(
                        'mem_id' => $mem_id,
                        'company_name' => $exp,
                        'title' => $post['work_title'][$expI],
                        'from_month' => $post['work_from_month'][$expI],
                        'from_year' => $post['work_from_year'][$expI],
                        'description' => $post['work_description'][$expI]
                    );
                    if ( !isset($post['work_currently'][$expI]) ) {
                        $expArr['is_currently_work'] = 0;
                        $expArr['to_month'] = $post['work_to_month'][$expI];
                        $expArr['to_year'] = $post['work_to_year'][$expI];
                    } else {
                        $expArr['is_currently_work'] = 1;
                    }
                    $m_exp_id = $this->member_experiences_model->save($expArr);
                }
            }
            unset($vals['work_company_name']);
            unset($vals['work_title']);
            unset($vals['work_from_month']);
            unset($vals['work_from_year']);
            unset($vals['work_to_month']);
            unset($vals['work_to_year']);
            unset($vals['work_description']);
            unset($vals['work_currently']);

            if ( $vals['mem_graduation_year'] === '' ) {
                $vals['mem_graduation_year'] = NULL;
            }
            if ( $vals['mem_travel_radius'] === '' ) {
                $vals['mem_travel_radius'] = NULL;
            }
            $where = array('mem_email' => $email);
            $get_row = $this->member_model->get_row_where($where, 'members');
            if (!empty($get_row->mem_email)) {
                $vals['mem_about'] = strip_tags($vals['mem_about']);
                $mem_id = $this->member_model->update($vals, 'mem_email', $email);
                setMsg('success', 'Tutor has been Update successfully.');
                redirect(ADMIN . '/tutors/manage/' . $this->uri->segment(4), 'refresh');
                exit;
            }
            $this->member_model->update($vals, 'mem_id', $mem_id);

            // print_query();
            $this->master->delete('tutor_subjects', 'mem_id', $mem_id);
            /*foreach ($post['subjects'] as $sub_id) {
                $this->master->save('tutor_subjects', array('mem_id' => $mem_id, 'subject_id' => $sub_id, 'type' => 'sub'));
            }
            $this->master->save('tutor_subjects', array('mem_id' => $mem_id, 'subject_id' => $post['subject'], 'type' => 'main'));*/
            if ( count($subjectsFiltered) > 0 ) {
                foreach ($subjectsFiltered as $val) {
                    $val['mem_id'] = $mem_id;
                    $this->master->save('tutor_subjects', $val);
                }
            }

            $this->master->delete('tutor_timings', 'mem_id', $mem_id);
            $week_days = get_week_days();
            foreach ($week_days as $day_key => $day) {
                $available = $post['days'][$day_key] != '' ? 1 : 0;
                $start_time = $post['start_time'][$day_key] ? get_full_time($post['start_time'][$day_key]) : '';
                $end_time = $post['end_time'][$day_key] ? get_full_time($post['end_time'][$day_key]) : '';

                $this->master->save('tutor_timings', array('mem_id' => $mem_id, 'day' => $day, 'start_time' => $start_time, 'end_time' => $end_time, 'available' => $available));
            }


            setMsg('success', 'Tutor has been saved successfully.');
            redirect(ADMIN . '/tutors/manage/' . $this->uri->segment(4), 'refresh');
            exit;
        }
        $this->data['enable_editor'] = TRUE;
        $check = $this->master->getRow('background_check_info', array('tutor_id' => $this->uri->segment('4'), 'status' => '0'));
        $this->data['tutor_background_check'] = $check;
        $student_id = $check->student_id;
        $getdata = $this->master->getRow('members', array('mem_id' => $student_id));
        $this->data['student_name'] = $getdata->mem_fname;
        $this->master->getRow('tutor_subjects', array('mem_id' => $this->uri->segment('4'), 'type' => 'main'));
        $this->data['tutor_background_check'] = $student_id;
        $this->data['tutor_main_subject'] = $this->master->getRow('tutor_subjects', array('mem_id' => $this->uri->segment('4'), 'type' => 'main'));
        $this->data['tutor_timings'] = $this->master->getRows('tutor_timings', array('mem_id' => $this->uri->segment('4')));
        $this->data['row'] = $this->member_model->getMember($this->uri->segment('4'));
        $this->data['education'] = $this->member_educations_model->getRecordMemberwise($this->uri->segment('4'));
        $this->data['work_experience'] = $this->member_experiences_model->getRecordMemberwise($this->uri->segment('4'));
        $this->data['mode'] = (($this->uri->segment('4') != '') ? 'edit' : 'add');
        $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
    }

    function send_tutor_email($emailto, $subject, $data, $txt_key) {
        $this->load->model('Text_model');
        $email_text = $this->Text_model->getTextValue($txt_key);

        $em_text = strtr($email_text, array('{$name}' => $data['name']));
        //print_r($email_text); die();
        if ($email_text) {
            $link = "<a href='https://crainly.com/login'> Login</a>";
            //sent email
           // $msg_body = 'Your account is approved and you can now ' . $link . '';
            $emailto = 'wpwebpro18@gmail.com';
            //  $emailto = $get_row->mem_email;
            $subject = $subject;
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html;charset=utf-8\r\n";
            $headers .= "From: support@crainly.com" . "\r\n";
            $data['email_body'] = $em_text;
            $ebody = $this->load->view('includes/email_template', $data, TRUE);
            sendgrid($emailto, $subject, $ebody, $headers);
        }
    }

    function active() {
        $mem_id = $this->uri->segment(4);
        $vals['mem_status'] = '1';
        //$this->member_model->save($vals, $mem_id);
        $this->member_model->update($vals, 'mem_id', $mem_id);
        setMsg('success', 'Tutor has been activated successfully.');

        $where = array('mem_id' => $mem_id);
        $get_row = $this->member_model->get_row_where($where, 'members');
        // $this->send_tutor_email();

        if (!empty($get_row->mem_email)) {
            $data = array();
            $link = base_url("login")."?email=".urlencode($get_row->mem_email)."&password=".urlencode(doDecode($get_row->mem_pswd));
            $emailto = $get_row->mem_email;
            $data['email_subject'] ='Welcome!';
            $data['name'] = $get_row->mem_fname ? $get_row->mem_fname : 'there';
            $data['loginlink'] = $link;
            $data['email_body'] = "Thanks for signing up with Crainly! We have reviewed your application and your profile has been approved. Welcome to the Crainly team! Please sign in to your account settings to update your profile.
            ";
            $ebody = $this->load->view('includes/email_template', $data, TRUE);
            sendgrid($emailto, $data['email_subject'], $ebody, $headers);
        }

        redirect(ADMIN . '/tutors', 'refresh');
    }

    function inactive() {
        $mem_id = $this->uri->segment(4);
        $vals['mem_status'] = '0';
        //$this->member_model->save($vals, $mem_id);
        $this->member_model->update($vals, 'mem_id', $mem_id);
        $where = array('mem_id' => $mem_id);
        $get_row = $this->member_model->get_row_where($where, 'members');
        if (!empty($get_row->mem_email)) {
            $data = array();
            $emailto = $get_row->mem_email;
            $data['email_subject'] =' Application Status ';
            sendgridWithTemplate($emailto, $data['email_subject'], Account_decline_template_id, [
                "appname" => "Crainly",
                'help_link' => site_url('contact-us/')
            ]);
        }
        setMsg('success', 'Tutor has been deactivated successfully.');
        redirect(ADMIN . '/tutors', 'refresh');
    }

    function suspend() {
        $mem_id = $this->uri->segment(4);
        $vals['mem_status'] = '0';
        //$this->member_model->save($vals, $mem_id);
        $this->member_model->update($vals, 'mem_id', $mem_id);
        $where = array('mem_id' => $mem_id);
        $get_row = $this->member_model->get_row_where($where, 'members');
        if (!empty($get_row->mem_email)) {
            $data = array();
            $emailto = $get_row->mem_email;
            $data['email_subject'] ='Account Suspended';
            $data['email_body'] = "Your account has been temporarily Suspended.";
            sendgridWithTemplate($emailto, $data['email_subject'], Account_suspended_template_id, [
                'appname' => 'Crainly',
                "status" =>  "Suspended",
                'help_link' => site_url('contact-us/'),
            ]);
        }
        setMsg('success', 'Tutor has been deactivated successfully.');
        redirect(ADMIN . '/tutors', 'refresh');
    }

    function delete() {
        has_access(10);
        $this->remove_file($this->uri->segment(4));
// $this->remove_member_data($this->uri->segment(4));
        $this->member_model->delete($this->uri->segment('4'));
        setMsg('success', 'Tutor has been deleted successfully.');
        redirect(ADMIN . '/tutors', 'refresh');
    }

    function status() {
        echo $this->member_model->changeStatus($this->uri->segment('4'));
    }

    function remove_file($id, $type = '') {
        $arr = $this->member_model->getMember($id);
        $filepath = UPLOAD_PATH . "/tutors/" . $arr->image;
        $filepath_thumb = UPLOAD_PATH . "/tutors/thumb_" . $arr->image;
        $filepath_ico = UPLOAD_PATH . "/tutors/ico_" . $arr->image;
        if (is_file($filepath)) {
            unlink($filepath);
        }
        if (is_file($filepath_thumb)) {
            unlink($filepath_thumb);
        }
        if (is_file($filepath_ico)) {
            unlink($filepath_ico);
        }
        return;
    }

    function transactions($id = 0) {
        if ($this->data['member_row'] = $this->member_model->getMember($id)) {
            $this->load->model('transaction_model');
            $this->data['rows'] = $this->transaction_model->get_rows(array('mem_id' => $id), '', '', 'desc');
            $this->data['enable_datatable'] = TRUE;
            $this->data['pageView'] = ADMIN . '/transactions';
            $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
        } else
            show_404();
    }

    /* function withdraws($id=0){
      if($this->data['member_row'] = $this->member_model->getMember($id))
      {
      $this->load->model('transaction_model');
      $this->data['rows'] = $this->transaction_model->get_tutor_withdraws($id);
      $this->data['enable_datatable'] = TRUE;
      $this->data['pageView'] = ADMIN . '/withdraw-requests';
      $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
      }
      else
      show_404();

      } */

    function chats($id = 0) {
        if ($this->data['member_row'] = $this->member_model->getMember($id, array('mem_type' => 'tutor'))) {
            $this->load->model('chat_model');
            $this->data['rows'] = $this->chat_model->get_mem_msgs_list($id);
            $this->data['enable_datatable'] = TRUE;
            $this->data['pageView'] = ADMIN . '/chats';
            $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
        } else
            show_404();
    }

    function bank_accounts($id = 0) {
        $id = intval($id);
        if ($this->data['member_row'] = $this->member_model->getMember($id, array('mem_type' => 'tutor'))) {
            $this->load->model('payment_methods_model');
            $this->data['rows'] = $this->payment_methods_model->get_methods($id);
            $this->data['enable_datatable'] = TRUE;
            $this->data['pageView'] = ADMIN . '/bank-accounts';
            $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
        } else
            show_404();
    }

    /* function remove_member_data($id) {
      $gigs_rows=$this->comic_model->get_gigs(array('mem_id'=>$id));
      foreach ($gigs_rows as $key => $gig) {
      $this->db->query("delete from `tbl_favorites` where ref_type='gig' and ref_id=".$gig->id);
      $thumbpath = UPLOAD_IMAGES . "/gigs/" . $gig->thumbnail;
      if (is_file($thumbpath)) {
      unlink($thumbpath);
      }
      foreach ($gig->images as $key => $gimage) {
      $filepath = UPLOAD_PATH . "/gigs/" . $gimage->image;
      if (is_file($filepath)) {
      unlink($filepath);
      }
      $this->comic_model->delete_image($image->id);
      }
      $this->comic_model->delete($gig->id);
      }
      $rows=$this->product_model->get_products(array('mem_id'=>$id));
      foreach ($rows as $key => $product) {
      $thumbpath = UPLOAD_IMAGES . "/products/" . $product->thumbnail;
      if (is_file($thumbpath)) {
      unlink($thumbpath);
      }
      foreach ($product->images as $key => $image) {
      $filepath = UPLOAD_PATH . "/products/" . $image->image;
      if (is_file($filepath)) {
      unlink($filepath);
      }
      $this->product_model->delete_image($image->id);
      }
      $this->db->query("delete from `tbl_favorites` where ref_type='product' and ref_id=".$product->id);
      $this->product_model->delete($product->id);
      }
      } */
}

?>