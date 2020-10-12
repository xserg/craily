<?php

class My_lessons extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        //$this->isMemLogged($this->session->mem_type);
        $this->load->model('member_model');
        $this->load->model('lesson_model');
        $this->load->model('subject_model');
        $this->load->library('my_stripe');
        $this->load->model('payment_methods_model');
        $this->load->model('transaction_model');

        //   date_default_timezone_set('Asia/Kolkata');
        //   date_default_timezone_set('America/Los_Angeles');
        // exit(date("Y-m-d H:i"));
    }

    function index()
    {

        if ($this->data['mem_data']->mem_type == 'tutor') {
            if ($this->data['mem_data']->mem_tutor_application > 0) {
                if (empty($this->data['mem_data']->mem_stripe_id)) {
                    redirect('stripe-register');
                    exit;
                }
            }
        }

        if ($this->input->post()) {
            $condition = array('mem_type<>' => $this->session->mem_type, $this->session->mem_type . '_id' => $this->session->mem_id);
            $res['items'] = "";
            $res['reached'] = true;
            $res['found'] = 1;
            $res['load'] = 1;

            $type = strtolower(trim($this->input->post('store')));
            $res['type'] = $type;

            if (!in_array($type, array('upcoming', 'previous'))) {
                $res['items'] = '<li class="hidden"><div class="semi color">No Lesson available</div></li>';
                exit(json_encode($res));
            }

            $count_function_name = 'total_' . $type . '_lessons';
            $function_name = 'get_' . $type . '_lessons';

            $page = intval($this->input->post('load'));
            $page = $page > 0 ? $page : 1;
            $per_page = 20;
            $total = $this->lesson_model->$count_function_name(array($this->session->mem_type . '_id' => $this->session->mem_id));
            $total_pages = ceil($total / $per_page);
            $start = ($page - 1) * $per_page;

            $res['reached'] = $total_pages > $page ? false : true;

            $lessons = $this->lesson_model->$function_name($condition, $start, $per_page);
            if (count($lessons) > 0) {
                $res['found'] = 1;
                $res['load'] = $page + 1;

                foreach ($lessons as $key => $lesson) {
                    $res['items'] .=
                        '<li class="hidden">
                    <div class="icoBlk">
                    <div class="ico"><img src="' . get_image_src($lesson->mem_image, 50, true) . '"></div>
                    <div class="name">' . $lesson->mem_name . '</div>
                    </div>
                    <div class="date">' . format_date($lesson->lesson_date_time, 'l, M d Y') . ' at ' . format_date($lesson->lesson_date_time, 'h:i A') . '</div>
                    <div class="bTn">';
                    if ($lesson->completed == 0 && $lesson->video_lesson_status == 0 && $lesson->lesson_type == 'Online') {
                        // if ($lesson->lesson_type=='Online'){
                        $lesson_start = compare_dates($lesson->lesson_date_time, date('Y-m-d H:i'), 'Y-m-d H:i');
                        $video_end = compare_dates($lesson->video_max_join_time, date('Y-m-d H:i'), 'Y-m-d H:i');
                        $time_ago10 = date('Y-m-d H:i', strtotime("+ 10minutes"));
                        $lesson_ready = compare_dates($lesson->lesson_date_time, $time_ago10, 'Y-m-d H:i');
                        if ($video_end)
                            $res['items'] .= '<a href="javascript:void(0)" class="webBtn smBtn" onclick="alert(\'Sorry this lesson has already passed\')">Join</a> ';
                        else
                            $res['items'] .= '<a href="' . ($lesson_ready ? site_url("join-lecture/" . $lesson->encoded_id) : "javascript:void(0)") . ($lesson_ready ? '" ' : '" onclick="alert(\'Hang Tight! You can only join up to 10 minutes early.\')"') . ' class="webBtn smBtn' . ($lesson_ready ? ' colorBtn' : '') . '" target=' . ($lesson_ready ? "_blank" : "") . '>Join</a> ';
                    }
                    $res['items'] .=
                        '<a href="javascript:void(0)" class="webBtn smBtn view-detail" data-store="' . $lesson->encoded_id . '">view' . ($lesson->{$this->session->mem_type . '_noti'} == 1 ? '<span class="dot"></span>' : '') . '</a>
                    </div>
                    </li>';
                }
            } else
                $res['items'] = '<li class="hidden"><div class="semi color">No Lesson available</div></li>';
//            $res['query'] = $this->db->last_query();
            exit(json_encode($res));
        } else {
            $this->load->view("lessons/my-lessons", $this->data);
        }
    }

    function lesson_detail($encoded_id = '')
    {
        $encoded_id = empty($encoded_id) ? $this->input->post('store') : $encoded_id;
        $id = intval(substr(doDecode($encoded_id), 4));
        $condition = array('mem_type<>' => $this->session->mem_type, $this->session->mem_type . '_id' => $this->session->mem_id, 'l.status' => 2);
        if ($row = $this->lesson_model->get_lesson($id, $condition)) {
            $discount = $row->discount ? $row->discount : 0;
            $percentage_amount = $this->data['site_settings']->site_percentage > 0 ? round(($this->data['site_settings']->site_percentage * $row->amount) / 100, 2) : 0;
            $amount = (num($row->amount) - num($discount)) + num($percentage_amount);

            if ($this->session->mem_type == 'student' && $row->completed == 1)
                $this->mark_complete_lesson($encoded_id);
            $this->lesson_model->save(array($this->session->mem_type . '_noti' => 0), 'id', $id);
            $res['data'] = '
            <div class="crosBtn"></div>
            <h3>Lesson Detail</h3>
            <ul class="list">
            <li><strong>Name:</strong><span>' . $row->mem_name . '</span></li>
            <li><strong>Subject:</strong><span>' . $row->subject . '</span></li>
            <li><strong>Date:</strong><span>' . format_date($row->lesson_date_time) . '</span></li>
            <li><strong>Start Time:</strong><span>' . format_date($row->lesson_date_time, 'h:i A') . '</span></li>
            <li><strong>Hours:</strong><span>' . hours_format($row->hours) . '</span></li>
            <li><strong>Total:</strong><span class="TotalPrice">$' . $amount . '</span></li>';
            if ($this->session->mem_type == 'student' && $row->promocode != '')
                $res['data'] .= '<li><strong>Discount:</strong>$' . num($row->discount) . '&emsp; <small>(' . $row->promocode . ')</small></li>';
            if ($row->completed == 2)
                $res['data'] .= '<li><strong>Status:</strong><span>Complete</span></li>';
            $res['data'] .= '<li><strong>Lesson Type:</strong><span>' . $row->lesson_type . '</span></li>';
            if ($row->lesson_type == 'In Person')
                $res['data'] .= '<li><strong>Location:</strong><span>' . $row->address . '</span></li>';

            //$res['data'].='<li><strong>Message:</strong><span>'.$row->detail.'</span></li>';
            $res['data'] .= '</ul>';

            $current = time();
            $start_time = strtotime($row->lesson_date_time);
            $video_end_time = strtotime($row->video_end_time);
            if ($row->canceled == 0 && $row->completed == 0)
                if ($current >= $start_time && $current >= $video_end_time && $this->session->mem_type == 'student') { //previos
                    $res['data'] .= '
                        <div class="bTn text-center">
                        <a href="javascript:void(0)" class="webBtn colorBtn mActn-btn" data-store="' . $encoded_id . '" data-link="mark-complete-lesson">Review <i class="fa-spinner hidden"></i></a>
                        </div>';
                } else if (($current < $start_time && $current < $video_end_time) || ($current < $start_time && $video_end_time === false)) { //upcoming
                    $res['data'] .= '
                        <div class="bTn text-center">
                        <a href="javascript:void(0)" class="webBtn cnclBtn mActn-btn" data-store="' . $encoded_id . '" data-link="mark-cancel-lesson">Cancel Lesson <i class="fa-spinner hidden"></i></a>
                        <a href="javascript:void(0)" class="webBtn colorBtn mActn-btn" data-store="' . $encoded_id . '" data-link="mark-complete-lesson">Mark complete <i class="fa-spinner hidden"></i></a>
                        </div>';
                }

            if ($row->canceled == 1)
                $res['data'] .= '<div class="alertBlk reject">Lesson has been canceled.</div>';
            if ($this->session->mem_type == 'tutor' && $row->completed == 1)
                $res['data'] .= '<div class="alertBlk accept">You mark this Lesson as completed.</div>';
            if ($row->canceled == 0 && $row->completed == 2) {
                $review = get_mem_rating($row->student_id, $row->id);
                $res['data'] .= '
                <div class="blk">
                <div class="txtGrp">
                <div class="rateYo" data-rateyo-rating="' . $review->rating . '" data-rateyo-read-only="true"></div>
                </div>' . $review->comment . '
                </div>';
            }

            $res['status'] = 1;
            exit(json_encode($res));
        }
        die('access denied');
    }

    function mark_complete_lesson($encoded_id = '')
    {
        $encoded_id = empty($encoded_id) ? $this->input->post('store') : $encoded_id;
        $id = intval(substr(doDecode($encoded_id), 4));
        $where = array('ref_mem_id' => $this->session->mem_id);

        $condition = array('mem_type<>' => $this->session->mem_type, $this->session->mem_type . '_id' => $this->session->mem_id, 'l.status' => 2, 'completed<>' => 2, 'canceled' => 0);
        if ($row = $this->lesson_model->get_lesson($id, $condition)) {
            // $this->lesson_model->save(array($this->session->mem_type.'_noti'=>0),$id);
            $res['data'] = '<div class="crosBtn"></div>
            <h3>' . ($this->session->mem_type == 'student' ? 'Leave Feedback' : 'Mark Complete') . '</h3>';
            if ($row->completed == 1) {
                /*$res['data'].='
            <ul class="list">
            <li><strong>Name:</strong><span>'.$row->mem_name.'</span></li>
            <li><strong>Subject:</strong><span>'.$row->subject.'</span></li>
            <li><strong>Date:</strong><span>'.format_date($row->lesson_date_time).'</span></li>
            <li><strong>Start Time:</strong><span>'.format_date($row->lesson_date_time,'h:i A').'</span></li>
            <li><strong>Hours:</strong><span>'.$row->hours.'</span></li>
            <li><strong>Total:</strong><span>$'.num($row->amount).'</span></li>';
            if ($this->session->mem_type=='student' && $row->promocode!='')
               	$res['data'].='<li><strong>Discount:</strong>'.$row->discount.' <small>('.$row->promocode.')</small></li>';
            if ($row->completed==2)
                $res['data'].='<li><strong>Status:</strong><span>Complete</span></li>';
            $res['data'].='<li><strong>Lesson Type:</strong><span>'.$row->lesson_type.'</span></li>';
            if ($row->lesson_type=='In Person')
            $res['data'].='<li><strong>Location:</strong><span>'.$row->address.'</span></li>';

            //$res['data'].='<li><strong>Message:</strong><span>'.$row->detail.'</span></li>';
            $res['data'].='</ul>';*/
            }
            $res['data'] .= '
            <form action="' . site_url('complete-lesson') . '" method="post" autocomplete="off" class="frmAjax">
            <input type="hidden" name="store" value="' . $encoded_id . '">';

            if ($row->completed == 0) {
                $current = time();
                $start_time = strtotime($row->lesson_date_time);
                $video_end_time = strtotime($row->video_end_time);
                if (($current < $start_time && $current < $video_end_time) || ($current < $start_time && $video_end_time === false)) { //upcoming
                    $res['data'] .= '
                    <div class="txtGrp">
                    <h4>Times for Lessons</h4>
                    <div class="row formRow">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xx-4 txtGrp">
                    <input type="text" id="date" name="date" class="txtBox datepicker" placeholder="Date" required="">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xx-4 txtGrp">
                    <input type="text" id="start_time" name="start_time" class="txtBox timepicker" placeholder="Start Time" required="">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xx-4 txtGrp">
                    <input type="text" id="end_time" name="end_time" class="txtBox timepicker" placeholder="End Time" required="">
                    </div>
                    </div>
                    </div>';
                }
            }
            if ($this->session->mem_type == 'student')
                $res['data'] .= '
            <div class="txtGrp">
            <h4>Leave a rating for your tutor</h4>
            <div class="row formRow">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xx-12 txtGrp">
            <div class="rateYo" id="rating"></div>
            <input type="hidden" name="rating" value="0">
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xx-12 txtGrp">
            <textarea name="cmnt" id="cmnt" class="txtBox" placeholder="Comment"></textarea>
            </div>
            </div>
            </div>';

            $res['data'] .= '
            <div class="bTn text-center">';
            if ($this->session->mem_type == 'tutor' || ($this->session->mem_type == 'student' && $row->completed != 1))
                $res['data'] .= '
            <a href="javascript:void(0)" class="webBtn  cnclBtn mActn-btn" data-store="' . $encoded_id . '" data-link="lesson-detail">Go Back <i class="fa-spinner hidden"></i></a>';
            $res['data'] .= '
            <button type="submit" class="webBtn colorBtn">Submit <i class="fa-spinner hidden"></i></button>
            </div>
            <div class="alertMsg" style="display: none;"></div>
            </form>';
            $res['status'] = 1;
            exit(json_encode($res));
        }
        die('access denied');
    }

    function complete_lesson()
    {
        if ($this->input->post()) {
            $res = array();
            $res['hide_msg'] = 0;
            $res['scroll_top'] = 0;
            $res['status'] = 0;
            $res['frm_reset'] = 0;
            $res['redirect_url'] = 0;

            $encoded_id = $this->input->post('store');
            $id = intval(substr(doDecode($encoded_id), 4));
            $condition = array('mem_type<>' => $this->session->mem_type, $this->session->mem_type . '_id' => $this->session->mem_id, 'l.status' => 2, 'completed<>' => 2, 'canceled' => 0);
            if (!$row = $this->lesson_model->get_lesson($id, $condition)) {
                $res['msg'] = showMsg('error', 'Something went worng!');
                exit(json_encode($res));
            }

            $this->form_validation->set_rules('store', 'store', 'required', array('required' => 'Something went wrong!'));

            if ($row->completed == 0) {
                // $this->form_validation->set_rules('date','Date','required');
                // $this->form_validation->set_rules('start_time','Start Time','required');
                // $this->form_validation->set_rules('end_time','End Time','required');
            }

            if ($this->session->mem_type == 'student') {
                $this->form_validation->set_rules('rating', 'Rating', 'required|integer', array('integer' => 'Please rate this Lesson'));
                // $this->form_validation->set_rules('cmnt','Comment','required',array('required'=>'Please write comment!'));
            }

            if ($this->form_validation->run() === FALSE) {
                $res['msg'] = validation_errors();
            } else {
                $post = html_escape($this->input->post());

                if ($this->session->mem_type == 'tutor' && $row->completed == 1) {
                    $res['msg'] = showMsg('error', 'Something went worng!');
                    exit(json_encode($res));
                }

                $noti_mem = $this->session->mem_type == 'tutor' ? 'student' : 'tutor';

                $lesson_vals = array($noti_mem . '_noti' => 1);

                if ($row->completed == 0) {

                    $lesson_vals['final_date'] = db_format_date($post['date']);
                    $lesson_vals['final_start_time'] = get_full_time($post['start_time']);
                    $lesson_vals['final_end_time'] = get_full_time($post['end_time']);
                    $lesson_vals['completed'] = 1;

                    if ($this->session->mem_type == 'tutor') {
                        $txt = 'Your lesson with ' . format_name($this->data["mem_data"]->mem_fname, $this->data["mem_data"]->mem_lname) . '. is submitted. click here <a href="javascript:void(0)" class="view-detail" data-store="' . $encoded_id . '" data-link="lesson-detail">click here</a>  to view lesson.';
                        save_notificaiton($row->student_id, $this->session->mem_id, $txt);

                        $txt = 'Leave a review for your lesson with ' . format_name($this->data["mem_data"]->mem_fname, $this->data["mem_data"]->mem_lname) . '. <a href="javascript:void(0)" class="view-detail" data-store="' . $encoded_id . '" data-link="lesson-detail">click here</a>';
                        save_notificaiton($row->student_id, $this->session->mem_id, $txt);
                        $res['msg'] = showMsg('success', 'Lesson has been marked completed successfully!');
                        $res['status'] = 1;
                        $res['frm_reset'] = 1;
                        // $res['redirect_url']=' ';
                    }
                }

                if ($this->session->mem_type == 'student') {
                    if ($post['rating'] > 5 || $post['rating'] < 0.1) {
                        $res['msg'] = '<div class="alert alert-danger alert-sm"><strong>Error!</strong> Please rate this lesson!</div>';
                        exit(json_encode($res));
                    }

                    $save_data = array('from_id' => $this->session->mem_id, 'ref_id' => $id, 'ref_type' => 'lesson');
                    $result = $this->master->getRow('reviews', $save_data);

                    if (!$result) {
                        $save_data['mem_id'] = $row->tutor_id;
                        $save_data['rating'] = $post['rating'];
                        $save_data['comment'] = $post['cmnt'];

                        $this->master->save('reviews', $save_data);

                        $txt = format_name($this->data["mem_data"]->mem_fname, $this->data["mem_data"]->mem_lname) . '. reviewed you ' . $post['rating'] . ' stars. <a href="javascript:void(0)" class="view-detail" data-store="' . $encoded_id . '" data-link="lesson-detail">click here</a> to view lesson.';

                        save_notificaiton($row->tutor_id, $this->session->mem_id, $txt);


                        $txt = 'You reviewed ' . $row->mem_name . '. ' . $post['rating'] . ' stars. <a href="javascript:void(0)" class="view-detail" data-store="' . $encoded_id . '" data-link="lesson-detail">click here</a> to view lesson.';
                        save_notificaiton($this->session->mem_id, $row->tutor_id, $txt);

                        $this->load->model('transaction_model');

                        $percentage_amount = $this->data['site_settings']->site_percentage > 0 ? round(($this->data['site_settings']->site_percentage * $row->amount) / 100, 2) : 0;

                        $amount = $row->amount - $percentage_amount;

                        $trx_id = $this->transaction_model->save(array('mem_id' => $row->tutor_id, 'lesson_id' => $row->id, 'amount' => $amount, 'status' => 0));

                        $lesson_vals['completed'] = 2;
                        $sign_mem_id = $row->tutor_id;
                        $sign_ref_mem_id = $row->student_id;
                        $getdata = $this->master->getRow('ref_signups', array('coupon_mem_id' => 0, 'mem_id' => $sign_ref_mem_id));
                        $coupon = '';
                        // email to the the referer
                        if ($getdata) {
                            $referer = $this->master->getRow('members', array('mem_id' => $getdata->ref_mem_id));
                            $refered = $this->master->getRow('members', array('mem_id' => $getdata->mem_id));
                            $coupon = $refered->mem_referral_code;

                            $emailto = $referer->mem_email;
                            $subject = 'Congratualions !!';
                            $headers = "MIME-Version: 1.0\r\n";
                            $headers .= "Content-type: text/html;charset=utf-8\r\n";
                            $headers .= "From: support@crainly.com" . "\r\n";
                            //$headers .= "Reply-To: '" . $settings->site_name . " <" . $settings->site_email . ">" . "\r\n";

                            $this->data['email_body'] = 'Your friend has completed his first lesson. Please check you coupon code for $10 discount. Your Coupon is: <b>' . $coupon . '</b>';
                            $this->data['email_subject'] = $subject;
                            $ebody = $this->load->view('includes/email_template', $this->data, TRUE);
                            sendgrid($emailto, $subject, $ebody, $headers);

                            $date = new DateTime();
                            $date->modify('+30 day');
                            $expireTime = $date->format('Y-m-d H:i:s');
                            $new_coupon = array('mem_id' => $referer->mem_id, 'reward' => 10, 'coupon_expire' => 0, 'coupon_id' => $coupon, 'expire_time' => $expireTime);
                            $this->master->save("coupon", $new_coupon);

                            // email to the the user refered

                            $coupon = $referer->mem_referral_code;
                            $emailto = $refered->mem_email;
                            $subject = 'Congratualions !!';
                            $headers = "MIME-Version: 1.0\r\n";
                            $headers .= "Content-type: text/html;charset=utf-8\r\n";
                            $headers .= "From: support@crainly.com" . "\r\n";
                            //$headers .= "Reply-To: '" . $settings->site_name . " <" . $settings->site_email . ">" . "\r\n";

                            $this->data['email_body'] = 'You has completed the first lesson. Please check you coupon code for $10 discount. Your Coupon is: <b>' . $coupon . '</b>';
                            $this->data['email_subject'] = $subject;
                            $ebody = $this->load->view('includes/email_template', $this->data, TRUE);
                            sendgrid($emailto, $subject, $ebody, $headers);

                            $new_coupon = array('mem_id' => $refered->mem_id, 'reward' => 10, 'coupon_expire' => 0, 'coupon_id' => $coupon, 'expire_time' => $expireTime);
                            $this->master->save("coupon", $new_coupon);

                            $this->master->save('ref_signups', array('coupon_mem_id' => 1), 'mem_id', $sign_ref_mem_id);

                            $res['status'] = 1;
                            $res['msg'] = showMsg('success', 'Review has been saved successfully!');
                            $res['frm_reset'] = 1;
                        }
                    }
                }

                $this->lesson_model->save($lesson_vals, 'id', $id);
            }
            exit(json_encode($res));
        }
        die('access denied');
    }

    function mark_cancel_lesson()
    {
        $encoded_id = $this->input->post('store');
        $id = intval(substr(doDecode($encoded_id), 4));
        $condition = array('mem_type<>' => $this->session->mem_type, $this->session->mem_type . '_id' => $this->session->mem_id, 'l.status' => 2, 'completed' => 0, 'canceled' => 0);
        if ($row = $this->lesson_model->get_lesson($id, $condition)) {
            $res['data'] = '
            <div class="crosBtn"></div>
            <h3>Cancel Lesson</h3>
            <div class="text-center">
            <p>Are you sure you want to cancel this lesson?</p>
            <div class="bTn">
            <a href="javascript:void(0)" class="webBtn cnclBtn mActn-btn" data-store="' . $encoded_id . '" data-link="lesson-detail">Go Back <i class="fa-spinner hidden"></i></a>
            <a href="javascript:void(0)" class="webBtn redBtn mActn-btn" data-store="' . $encoded_id . '" data-link="cancel-lesson">Confirm <i class="fa-spinner hidden"></i></a>
            </div>
            </div>';
            $res['status'] = 1;
            exit(json_encode($res));
        }
        die('access denied');
    }

    function cancel_lesson()
    {
        $encoded_id = $this->input->post('store');
        $id = intval(substr(doDecode($encoded_id), 4));
        $condition = array('mem_type<>' => $this->session->mem_type, $this->session->mem_type . '_id' => $this->session->mem_id, 'l.status' => 2, 'completed' => 0, 'canceled' => 0);
        if ($row = $this->lesson_model->get_lesson($id, $condition)) {

            $noti_mem = $this->session->mem_type == 'tutor' ? 'student' : 'tutor';
            $this->lesson_model->save(array($noti_mem . '_noti' => 1, 'canceled' => 1, 'canceled_by' => $this->session->mem_id, 'final_date' => date('Y-m-d')), 'id', $id);

            $txt = 'Your lesson with ' . format_name($this->data["mem_data"]->mem_fname, $this->data["mem_data"]->mem_lname) . '. has been canceled. <a href="javascript:void(0)" class="view-detail" data-store="' . $encoded_id . '" data-link="lesson-detail">click here</a> to view.';
            save_notificaiton($row->{$noti_mem . '_id'}, $this->session->mem_id, $txt);

            $where = array('mem_id' => $row->{$noti_mem . '_id'});
            $student_row = $this->member_model->get_row_where($where, 'members');
            $where = array('mem_id' => $this->session->mem_id);
            $tutor_row = $this->member_model->get_row_where($where, 'members');
            $data = array();
            $date = $date = date_create($row->lesson_date_time);
            $date = date_format($date, "l F jS") . " at " . date_format($date, "h:i:s A") . " Pacific Time (PT).";
            $link = base_url("login") . "?email=" . urlencode($tutor_row->mem_email) . "&password=" . urlencode(doDecode($tutor_row->mem_pswd));
            $emailto = $tutor_row->mem_email;
            $data['email_subject'] = 'Lesson Canceled';
            $data['name'] = $student_row->mem_fname . ' ' . $student_row->mem_lname;
            sendgridWithTemplate($emailto, $data['email_subject'], Lesson_cancel_template_id, [
                'appname' => 'Crainly',
                'username' => $data['name'],
                'myaccount' => site_url('my-lessons/'),
                'booked_date' => $date,
                'help_link' => site_url('contact-us/')
            ]);
            $data = array();
            $link = base_url("login") . "?email=" . urlencode($student_row->mem_email) . "&password=" . urlencode(doDecode($student_row->mem_pswd));
            $emailto = $student_row->mem_email;
            $data['email_subject'] = 'Lesson Canceled';
            $data['name'] = $tutor_row->mem_fname . ' ' . $tutor_row->mem_lname;
            $data['loginlink'] = $link;
            $data['email_body'] =   "Your lesson with " . $data['name'] . " for " . $date . " has been canceled. Please check your account for more information";
            sendgridWithTemplate($emailto, $data['email_subject'], Lesson_cancel_template_id, [
                'appname' => 'Crainly',
                'username' => $data['name'],
                'myaccount' => site_url('my-lessons/'),
                'booked_date' => $date,
                'help_link' => site_url('contact-us/')
            ]);
            $res['data'] = $this->lesson_detail($encoded_id);
            $res['status'] = 1;
            exit(json_encode($res));
        }
        die('access denied');
    }

    function my_tutors($page = 1)
    {
        $this->isMemLogged('student');
        $page = intval($page);
        $per_page = 40;

        $total = $this->lesson_model->total_student_tutors();

        $total_pages = ceil($total / $per_page);


        $this->load->library('pagination');
        $this->config->load('pagination');

        $config = $this->config->item('pagination');
        $config['base_url'] = site_url('my-tutors');
        $config['total_rows'] = $total;
        $config['per_page'] = $per_page;
        $this->pagination->initialize($config);
        $this->data['links'] = $this->pagination->create_links();

        $start = ($page - 1) * $per_page;

        $this->data['rows'] = $this->lesson_model->get_student_tutors('', $start, $per_page, 'desc');
        $this->load->view('account/my-tutors', $this->data);
    }

    function requests($page = 1)
    {
        if ($this->data['mem_data']->mem_type == 'tutor') {
            if ($this->data['mem_data']->mem_tutor_application > 0) {
                if (empty($this->data['mem_data']->mem_stripe_id)) {
                    redirect('stripe-register');
                    exit;
                }
            }
        }
        $page = $page == 0 ? 1 : intval($page);
        $per_page = 40;

        if ($this->session->mem_type == 'tutor') {
            $condition = array('mem_type<>' => $this->session->mem_type, $this->session->mem_type . '_id' => $this->session->mem_id, 'l.status<=' => 0);

            $total = $this->lesson_model->total_mem_lesson_requests(array($this->session->mem_type . '_id' => $this->session->mem_id, 'status<=' => 0));
        } else {
            $condition = array('mem_type<>' => $this->session->mem_type, $this->session->mem_type . '_id' => $this->session->mem_id, 'l.status<=' => 1);

            $total = $this->lesson_model->total_mem_lesson_requests(array($this->session->mem_type . '_id' => $this->session->mem_id, 'status<=' => 1));
        }
        $total_pages = ceil($total / $per_page);


        if ($this->session->mem_type == 'tutor') {
            $this->data['page_title'] = 'Lesson Requests';
            $url = 'lesson-requests';
        } else {
            $this->data['page_title'] = 'Requests';
            $url = 'requests';
        }
        $this->load->library('pagination');
        $this->config->load('pagination');

        $config = $this->config->item('pagination');
        $config['base_url'] = site_url($url);
        $config['total_rows'] = $total;
        $config['per_page'] = $per_page;
        $this->pagination->initialize($config);
        $this->data['links'] = $this->pagination->create_links();

        $start = ($page - 1) * $per_page;

        $this->data['rows'] = $this->lesson_model->get_mem_requests($condition, $start, $per_page, 'desc');

        $this->load->view("lessons/requests", $this->data);


        /*$condition=array('mem_type<>'=>$this->session->mem_type,$this->session->mem_type.'_id'=>$this->session->mem_id);
        if($this->input->post()){
            $cat_id=intval(substr(doDecode($this->input->post('store')),4));
            $res['items'] = "";

            $page=intval($this->input->post('load'));
            $page=$page>0?$page:1;
            $per_page=20;
            $total=$this->lesson_model->total_lessons('',$condition);
            $total_pages=ceil($total/$per_page);
            $start=($page-1)*$per_page;

            $res['reached']=$total_pages>$page?false:true;
            $res['btn']='';
            $res['found']=0;
            $res['load']=$this->input->post('load')?$page+1:2;

            $lessons = $this->lesson_model->get_lessons_by_order($condition,$start,$per_page,$sort_order);
            if (count($lessons) > 0) {
                $res['found']=1;
                if (!$res['reached'])
                    $res['btn'] .= '<div class="loadBtn hidden"><a href="javascript:void(0)" class="webBtn">Load More...</a></div>';

                foreach ($lessons as $key => $lesson){
                    $res['items'] .=
                    '<li class="hidden">
                    <div class="iTem">
                    <div class="image" style="background-image: url(\''. get_image_src($lesson->thumbnail,300).'\')">
                    <a href="'. lesson_url($lesson->id,$lesson->title).'" class="overlay"></a>
                    </div>
                    <div class="heart">
                    <a href="javascript:void(0)" class="active"><i class="fi-heart"></i><span>'.$lesson->likes.'</span></a>
                    </div>
                    <div class="ico"><a href="'. profile_url($lesson->mem_id,get_mem_name($lesson->mem_id)).'"><img src="'. get_image_src(get_mem_image($lesson->mem_id),50,true).'" alt=""></a></div>
                    <div class="cntnt">
                    <h4><a href="'. lesson_url($lesson->id,$lesson->title).'">'. $lesson->title.'</a></h4>
                    <div class="rateYo" data-rateyo-rating="'.get_avg_rating($lesson->id,'lesson').'" data-rateyo-read-only="true"></div>
                    <!--<div class="chBlk">
                    <div class="ch">CH 1</div>
                    <div class="date">5/23</div>-->
                    </div>
                    </div>
                    </div>
                    </li>';
                }
            }
            else
                $res['items'] = "<li>No lesson</li>";
            exit(json_encode($res));
        }

        $this->data['page_title'] = $this->session->mem_type=='tutor'?'Lesson Requests':'Requests';
        $this->data['rows'] = $this->lesson_model->get_mem_requests($condition,'',18);
        // $this->data['rows'] = $this->lesson_model->get_lessons(array($this->session->mem_type.'_id'=>$this->session->mem_id),'',18);
        $this->load->view("lessons/requests", $this->data); */
    }
    function request_payment($encoded_id)
    {
        if ($this->data['mem_data']->mem_type == 'tutor') {
            if ($this->data['mem_data']->mem_tutor_application > 0) {
                if (empty($this->data['mem_data']->mem_stripe_id)) {
                    redirect('stripe-register');
                    exit;
                }
            }
        }
        $id = intval(substr(doDecode($encoded_id), 4));
        $this->data['tut_name'] = '';
        $this->data['tut_image'] = '';
        if ($row = $this->lesson_model->get_lesson($id, '')) {
            $this->data['tut_name'] = $row->mem_name;
            $this->data['tut_image'] = $row->mem_image;
        }
        //		331 | tutor id


        $this->data['encoded_id'] = $encoded_id;
        $this->data['page_title'] = 'Request Payment';

        $this->load->view("lessons/requests_payment", $this->data);
    }
    function lesson_request_detail()
    {
        $encoded_id = $this->input->post('store');
        $image = $this->input->post('image');
        $name = $this->input->post('name');
        $tut_mem_id = $this->input->post('mem_id');
        $where = array('mem_id' => $this->session->mem_id, 'coupon_mem_id' => 0);
        $id = intval(substr(doDecode($encoded_id), 4));

        $condition = array('mem_type' => $this->session->mem_type, $this->session->mem_type . '_id' => $this->session->mem_id);
        $row = $this->lesson_model->get_lesson($id, $condition);

        if ($row->status != 2) {
            $this->master->delete('coupon', 'lesson_id', $id);
            $this->lesson_model->save(array('discount' => null, 'promocode' => null), 'id', $id);
            $row->promocode = null;
            $row->discount = null;
        }

        //	    $getdata  = []
        $getdata = $this->master->getRow('coupon', array('coupon_mem_id' => 1, 'mem_id' => $this->session->mem_id, 'coupon_expire' => 1, 'lesson_id' => $id));

        $getfirstoff = $this->master->getRow('ref_signups', array('mem_id' => $this->session->mem_id, 'coupon_expire' => 0, 'first_lesson_off' => 1));

        $ref = $this->master->getRow('coupon', $where);

        //        $condition=array('mem_type'=>$this->session->mem_type,$this->session->mem_type.'_id'=>$this->session->mem_id);
        //$condition=array('mem_type<>'=>$this->session->mem_type,$this->session->mem_type.'_id'=>$this->session->mem_id);
        //        if($row = $this->lesson_model->get_lesson($id,$condition)){
        if ($row) {
            if ($row->status != 2)
                $this->lesson_model->save(array($this->session->mem_type . '_noti' => 0), 'id', $id);

            $total_amount = $row->amount;
            $promocode = $row->promocode;
            $original_amount = $row->amount;
            if (!empty($getdata)) {
                $total_amount = $row->amount - $getdata->reward;
            }

            $percentage_amount = $this->data['site_settings']->site_percentage > 0 ? round(($this->data['site_settings']->site_percentage * $row->amount) / 100, 2) : 0;
            if (!empty($percentage_amount)) {
                $total_amount = $total_amount + $percentage_amount;
            }

            if (!empty($getfirstoff)) {
                $total_amount = $total_amount - $getfirstoff->reward;
            }

            $res['data'] = '
            <div class="crosBtn crosbtnfinal"></div>
            <h3>' . ($this->session->mem_type == 'student' ? 'Book your session with ' . $name . '' : 'Lesson Request') . '</h3>';
            if ($this->session->mem_type == 'student')
                $res['data'] .= '
            <div class="cardBlk text-center">
            <div class="icoBlk">
            <div class="ico"><img src="' . get_image_src($image, 150, true) . '"></div>
            <h4>' . $name . '</h4>';
            /*<div class="rating">
            <div class="rateYo" data-rateyo-rating="'.get_avg_mem_rating($tut_mem_id).'" data-rateyo-read-only="true"></div>
            <strong>('.count_mem_reviews($tut_mem_id).' reviews)</strong>*/
            $res['data'] .= '</div>
            </div>
            </div>
            <hr>';
            $res['data'] .= '<ul class="list lesson-disc">';

            if ($this->session->mem_type == 'tutor')
                $res['data'] .= '<li><strong>Name:</strong><span>' . $row->mem_name . '</span></li>';

            $res['data'] .= '
            <li><strong>Subject:</strong><span>' . $row->subject . '</span></li>
            <li><strong>Date:</strong><span>' . format_date($row->lesson_date_time) . '</span></li>
            <li><strong>Start Time:</strong><span>' . format_date($row->lesson_date_time, 'h:i A') . '</span></li>
            <li><strong>Hours:</strong><span>' . hours_format($row->hours) . '</span></li>';

            $res['data'] .= '<li><strong>Lesson Type:</strong><span>' . $row->lesson_type . '</span></li>';

            if ($row->lesson_type == 'In Person')
                $res['data'] .= '<li><strong>Location:</strong><span>' . $row->address . '</span></li>';

            //$res['data'].='<li><strong>Message:</strong><span>'.$row->detail.'</span></li>';

            if (!empty($getdata)) {
                //$res['data'].='<li><strong>Discount:</strong><span>- $'.$ref->reward.'</span></li>';


                if ($this->session->mem_type == 'student' && $row->status == 1) {
                    $res['data'] .= '<li><strong>Subtotal:</strong><span>$' . num($original_amount) . ' </span></li>';
                    $res['data'] .= '<li><strong>Service Fee <a href="javascript:void(0)" class="service_details"><i class="fa fa-question-circle" aria-hidden="true"></i></a> :</strong><span>$' . num($percentage_amount) . '</span></li>';
                    if (empty($promocode)) {
                        $res['data'] .= '<li class="pre_promo_code"><strong class="apply_promo_code"><div class="col-md-12 applied_promo_code"><label class="text-head"><i class="fa fa-angle-down"></i> Have a Promo Code?</label></div></strong></li>';
                        $res['data'] .= '<li class="promo_coded" style="display: none;"><strong class="apply_promo_code">Discount</strong><div class="applied_promo_view"></div></li>';
                        //$res['data'].='</li>';
                        $res['data'] .= '<li><div class="col-lg-5 col-md-8 col-sm-8 col-xs-8 col-xx-8 txtGrp promo_code">
			                	<input type="text" name="promocode" id="promocode" class="txtBox" placeholder="Enter Promo Code" maxlength="8">
			                	<input type="hidden" name="encoded_id" id="encoded_id" value="' . $encoded_id . '" >
			                	<input type="hidden" name="total_sum" id="total_sum" value="' . num($total_amount) . '" >
			                	<span class="show_result"></span>
			                </div>
			                <div class="col-lg-7 promo_code">
			                	<button class="apply_button"><i class="fa fa-spinner hidden"></i> Apply</button><div class="col-lg-12">
			                </div>';
                    } else {
                        $res['data'] .= '<li><strong class="apply_promo_code">Discount:</strong>';
                        $res['data'] .= '<div class="col-md-12 applied_promo_code"><label class="text-head">- $' . $getdata->reward . '</label></div></li>';
                    }
                    $res['data'] .= '<li><strong  style="font-size: 18px;font-weight: bold;">Total:</strong><span  style="font-size: 18px;font-weight: bold;" class="total_amount_applied">$' . num($total_amount) . '</span></li>';
                } elseif ($this->session->mem_type == 'student') {
                    $res['data'] .= '<li><strong  style="font-size: 18px;font-weight: bold;">Total:</strong><span  style="font-size: 18px;font-weight: bold;" class="total_amount_applied">$' . num($total_amount) . '</span></li>';
                } else {
                    $res['data'] .= '<li></li>';
                }

                $res['data'] .= '</ul>';
            } else {
                if ($this->session->mem_type == 'student' && $row->status == 1) {
                    $res['data'] .= '<li><strong>Subtotal:</strong><span>$' . num($original_amount) . ' </span></li>';
                    $res['data'] .= '<li><strong>Service Fee <a href="javascript:void(0)" class="service_details"><i class="fa fa-question-circle" aria-hidden="true"></i></a>:</strong><span>$' . num($percentage_amount) . '</span></li>';
                    if ($getfirstoff->reward)
                        $res['data'] .= '<li><strong>First Lesson Discount:</strong><span>-$' . $getfirstoff->reward . '</span></li>';
                    if (empty($promocode)) {
                        $res['data'] .= '<li class="pre_promo_code"><strong class="apply_promo_code"><div class="col-md-12 applied_promo_code"><label class="text-head"><i class="fa fa-angle-down"></i> Have a Promo Code?</label></div></strong></li>';
                        $res['data'] .= '<li class="promo_coded" style="display: none;"><strong class="apply_promo_code">Discount</strong><div class="applied_promo_view"></div></li>';
                        //$res['data'].='';
                        $res['data'] .= '<li><div class="col-lg-5 col-md-8 col-sm-8 col-xs-8 col-xx-8 txtGrp promo_code">
			                	<input type="text" name="promocode" id="promocode" class="txtBox" placeholder="Enter Promo Code" maxlength="8">
			                	<input type="hidden" name="encoded_id" id="encoded_id" value="' . $encoded_id . '" >
			                	<input type="hidden" name="total_sum" id="total_sum" value="' . num($total_amount) . '" >
			                	<span class="show_result"></span>
			                </div>
			                <div class="col-lg-7 promo_code">
			                	<button class="apply_button"><i class="fa fa-spinner hidden"></i> Apply</button>
			                </div>';
                    } else {
                        $res['data'] .= '<li><strong class="apply_promo_code">Discount:</strong>';
                        $res['data'] .= '<div class="col-md-12 applied_promo_code"><label class="text-head">- $' . $getdata->reward . '</label></div></li>';
                    }

                    $res['data'] .= '<li><strong style="font-size: 18px;font-weight: bold;">Total:</strong><span style="font-size: 18px;font-weight: bold;" class="total_amount_applied">$' . num($total_amount) . '</span></li>';
                } elseif ($this->session->mem_type == 'student') {
                    $res['data'] .= '<li><strong style="font-size: 18px;font-weight: bold;">Total:</strong><span style="font-size: 18px;font-weight: bold;" class="total_amount_applied">$' . num($total_amount) . '</span></li>';
                } else {
                    $res['data'] .= '<li></li>';
                }

                $res['data'] .= '</ul>';
            }

            if ($this->session->mem_type == 'tutor' && $row->status == 0)
                $res['data'] .= '
            <div class="bTn text-center">
            <a href="javascript:void(0)" class="webBtn redBtn actn-btn" data-store="' . $encoded_id . '" data-link="reject-lesson-request">Decline <i class="fa-spinner hidden"></i></a>
            <a href="javascript:void(0)" class="webBtn greenBtn actn-btn" data-store="' . $encoded_id . '" data-link="accept-lesson-request">Accept <i class="fa-spinner hidden"></i></a>
            </div>';
            //			echo "|||||||||||||||||||||";
            //			echo $this->session->mem_type;
            //	        echo "|||||||||||||||||||||";
            //			print_r($row);

            if ($this->session->mem_type == 'student' && $row->status == 1) {
                $this->load->model('payment_methods_model');
                $credit_cards = $this->payment_methods_model->get_credit_cards($this->sesison->mem_id);
                $res['data'] .= '
                <div class="formRow row svdCards">
                <hr>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xx-12 txtGrp">
                <h4>Payment Method</h4>
                <select id="payment_method" name="payment_method" class="txtBox selectpicker">';
                $res['data'] .= '<option value="">Select</option>';
                foreach ($credit_cards as $card_row) {
                    $res['data'] .= '<option style="background-image:url(https://crainly.com/assets/images/cards/' . $card_row->image . ') !important;background-repeat: no-repeat!important;padding: 13px;display: inline-block;padding-left: 70px;background-position: 5px 6px !important;width: 100%;background-color: #FFFAF6 !important;" class="payment_option" value="' . $card_row->encoded_id . '"' . (empty($card_row->default_method) ? '' : ' selected=""') . '> * * * * * ' . $card_row->last_digits . '</option>';
                }
                $res['data'] .= '<option value="#add_new_card" class="add_new_card">Add a new Card +</option>';
                $res['data'] .= '</select>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xx-12 txtGrp text-center">
                	<button type="button" data-store="' . $encoded_id . '" class="webBtn lgBtn colorBtn bkNow">Pay Now <i class="fa-spinner hidden"></i></button>
				</div>

                </div>
                <div class="alertMsg"></div>';
                /*<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-12 txtGrp">
                <a href="'.site_url('payment-methods').'" class="color">Manage Payment Method</a>
                </div>*/

                /*
                <a href="javascript:void(0)" class="color addCard">Add new card</a>
                $res['data'].='<form action="" method="post" autocomplete="off" class="frmCreditCard">
                <input type="hidden" name="payment_type" value="credit-card">
                <hr>
                <h4>Credit card</h4>
                <div class="row formRow">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                <input type="text" name="cardnumber" id="cardnumber" class="txtBox" placeholder="Card Number">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                <input type="text" name="card_holder_name" id="card_holder_name" class="txtBox" placeholder="Card Holder">
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xx-4 txtGrp">
                <select class="txtBox selectpicker" name="exp_month" id="exp_month">
                <option value="">Month</option>';
                for($i=1;$i<=12;$i++){
                    $res['data'].='<option value="'.sprintf('%02d', $i).'" '.(sprintf('%02d', $i)==$mem_data->mem_card_exp_month?'selected':'').'>'.sprintf('%02d', $i).'</option>';
                }
                $res['data'].='</select>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xx-4 txtGrp">
                <select  name="exp_year" id="exp_year" class="txtBox selectpicker">
                <option value="">Year</option>';
                for($i=date('Y');$i<=date('Y')+10;$i++){
                    $res['data'].='<option value="'.$i.'"'.($i==$mem_data->mem_card_exp_year?' selected':'').'>'.$i.'</option>';
                }
                $res['data'].='</select>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xx-4 txtGrp">
                <input type="text" name="cvc" id="cvc" class="txtBox" placeholder="CVC?">
                </div>
                </div>
                <div class="bTn text-center">
                <button type="button" class="webBtn cnclBtn cnclBtnNCard">Cancel</button>
                <button type="submit" data-store="'.$encoded_id.'" class="webBtn colorBtn">Book Now <i class="fa-spinner hidden"></i></button>
                </div>
                <div class="alertMsg"></div>
                </form>';*/
            } elseif ($this->session->mem_type == 'tutor' && $row->status == 1) {
                $res['data'] .= '<div class="alertBlk accept">Request has been accepted!</div>';
            }

            if ($row->status == 2)
                $res['data'] .= '<div class="alertBlk accept">Lesson has been booked!</div>';
            if ($row->status == 3)
                $res['data'] .= '<div class="alertBlk reject">Request has been Declined.</div>';
            if ($row->canceled == 1)
                $res['data'] .= '<div class="alertBlk reject">Lessons has been Canceled.</div>';
            $res['status'] = 1;
            exit(json_encode($res));
        }
        die('access denied');
    }

    function accept_lesson_request()
    {
        //$this->isMemLogged('tutor');
        $encoded_id = $this->input->post('store');
        $id = intval(substr(doDecode($encoded_id), 4));
        // $condition=array('mem_type<>'=>$this->session->mem_type,$this->session->mem_type.'_id'=>$this->session->mem_id,'l.status'=>0);
        $condition = array('mem_type' => $this->session->mem_type, 'tutor_id' => $this->session->mem_id, 'l.status' => 0);
        if ($row = $this->lesson_model->get_lesson($id, $condition)) {

            $this->lesson_model->save(array('student_noti' => 1, 'status' => 1), 'id', $id);

            $txt = format_name($this->data["mem_data"]->mem_fname, $this->data["mem_data"]->mem_lname) . '. has accepted your lesson request. <a href="javascript:void(0)" class="view-detail" data-store="' . $encoded_id . '" data-name="' . $this->data["mem_data"]->mem_fname . ' ' . $this->data["mem_data"]->mem_lname . '" data-image="' . $this->data["mem_data"]->mem_image . '" data-mem="' . $this->data["mem_data"]->mem_id . '" data-link="get-request-detail">click here</a> to book.';
            save_notificaiton($row->student_id, $this->session->mem_id, $txt);

            $res['data'] .= '<div class="alertBlk accept">Request has been Accepted.</div>';
            $res['status'] = 1;
            $res['reload'] = 1;
            exit(json_encode($res));
        }
        die('access denied');
    }

    function reject_lesson_request()
    {
        //$this->isMemLogged('tutor');
        $encoded_id = $this->input->post('store');
        $id = intval(substr(doDecode($encoded_id), 4));
        //$condition=array('mem_type<>'=>$this->session->mem_type,$this->session->mem_type.'_id'=>$this->session->mem_id,'l.status'=>0);
        $condition = array('mem_type' => $this->session->mem_type, 'tutor_id' => $this->session->mem_id, 'l.status' => 0);
        if ($row = $this->lesson_model->get_lesson($id, $condition)) {

            $this->lesson_model->save(array('student_noti' => 1, 'status' => 3), 'id', $id);

            $txt = 'Your lesson request with ' . format_name($this->data["mem_data"]->mem_fname, $this->data["mem_data"]->mem_lname) . '. has been declined.';
            save_notificaiton($row->student_id, $this->session->mem_id, $txt);

            $res['data'] .= '<div class="alertBlk reject">Request has been Declined.</div>';
            $res['status'] = 1;
            $res['reload'] = 1;
            exit(json_encode($res));
        }
        die('access denied');
    }

    function book_lesson($tutor_id = '')
    {
        $this->isMemLogged('student');
        $this->data['encoded_id'] = $tutor_id;
        $tutor_id = intval(doDecode($tutor_id));
	
        if ($tutor_row = $this->member_model->get_tutor($tutor_id)) {
            if ($this->input->post()) {
                $post = html_escape($this->input->post());

                $res = array();
                $res['hide_msg'] = 0;
                $res['scroll_to_msg'] = 1;
                $res['status'] = 0;
                $res['frm_reset'] = 0;
                $res['redirect_url'] = 0;

                $checkTimings = $this->member_model->check_timing($tutor_id);
                $flag = 0;
                if (count($checkTimings) > 0) {
                    $flag = 1;
                    $this->form_validation->set_message('integer', 'Please select a valid {field}');
                }
                $this->form_validation->set_rules('subject', 'subject', 'required|integer');
                $this->form_validation->set_rules('date', 'Date', 'required|is_min_valid_date', array('required' => 'Please select a {field}'));
                $this->form_validation->set_rules('time', 'Time', 'required');
                $this->form_validation->set_rules('hours', 'Hours', 'required|numeric', array('required' => 'Please select a {field}'));
                $this->form_validation->set_rules('lesson_type', 'Lesson type', 'required');
                if ($post['lesson_type'] == 'In Person') {
                    $this->form_validation->set_rules('address', 'Address', 'required');
                }


                // $this->form_validation->set_rules('detail','Detail','required');

                if ($this->form_validation->run() === FALSE) {
                    $res['msg'] = validation_errors();
                } else {
                    if (!in_array($post['lesson_type'], array('In Person', 'Online'))) {
                        $res['msg'] = showMsg('error', 'Please select a valid Lesson type');
                        exit(json_encode($res));
                    }

                    if (!$this->master->getRow('tutor_subjects', array('mem_id' => $tutor_id, 'subject_id' => $post['subject']))) {
                        $res['msg'] = showMsg('error', 'Please select a valid subject');
                        exit(json_encode($res));
                    }
                    $day = date('l', strtotime($post['date']));
                    if (!$this->master->getRow('tutor_timings', array('mem_id' => $tutor_id, 'day' => $day, 'available' => 1)) && $flag == 1) {
                        $res['msg'] = showMsg('error', "Please select a valid Date");
                        exit(json_encode($res));
                    }

                    $start_time = empty($post['time']) ? '' : get_full_time($post['time']);
                    $lesson_date_time = db_format_date($post['date']) . ' ' . $start_time;
                    if (compare_dates($lesson_date_time, date('Y-m-d H:i'), 'Y-m-d H:i')) {
                        $res['msg'] = showMsg('error', 'Please select future timing !');
                        exit(json_encode($res));
                    }


                    $start_time = $lesson_date_time;
                    $date = new DateTime($start_time);
                    $f_hours = hours_format($post['hours']);
                    $f_hours = str_replace('h', 'hour', $f_hours);
                    $date->modify('+' . $f_hours);
                    $video_max_join_time = $date->format('Y-m-d H:i');

                    $amount = $tutor_row->mem_hourly_rate * $post['hours'];

                    $save_data = array('tutor_id' => $tutor_id, 'student_id' => $this->session->mem_id, 'subject_id' => $post['subject'], 'lesson_date_time' => $lesson_date_time, 'hours' => $post['hours'], 'video_max_join_time' => $video_max_join_time, 'lesson_type' => $post['lesson_type'], 'address' => $post['address'], 'detail' => $post['detail'], 'amount' => $amount, 'tutor_noti' => 1, 'date' => date("Y-m-d H:i:s"));

                    $lesson_id = $this->lesson_model->save($save_data);
                    if ($lesson_id == 0) {
                        $res['msg'] = showMsg('error', 'Something went wrong! please try again');
                        exit(json_encode($res));
                    }
                    $encoded_id = doEncode('lsn-' . $lesson_id);
                    $this->lesson_model->save(array('encoded_id' => $encoded_id), 'id', $lesson_id);

                    $txt = 'You have a new lesson request from ' . format_name($this->data["mem_data"]->mem_fname, $this->data["mem_data"]->mem_lname) . '. <a href="javascript:void(0)" class="view-detail" data-link="get-request-detail" data-store="' . $encoded_id . '">click here</a> to view detail.';
                    save_notificaiton($tutor_id, $this->session->mem_id, $txt);

                    $res['msg'] = showMsg('success', 'Book a Lesson request has been sent successfully!');
                    $res['redirect_url'] = site_url('requests');
                    $res['status'] = 1;
                    $res['frm_reset'] = 1;
                }
                exit(json_encode($res));
            } else {
                $this->data['subjects'] = $this->subject_model->get_tutor_subjects($tutor_row->mem_id);
			
                $tutor_days = $this->master->fetch_row("select group_concat(day) as days from tbl_tutor_timings where mem_id=$tutor_id and available=0");
                if (empty($this->data['subjects'])) {
                    // if (empty($tutor_days->days) || empty($this->data['subjects'])) {
                    redirect('search', 'refresh');
                    exit;
                }
                if (!empty($tutor_days->days)) {
                    $tutor_days->days = @explode(',', $tutor_days->days);
                    $not_avail_days = '';
                    foreach ($tutor_days->days as $key => $day) {
                        $not_avail_days .= date('w', strtotime($day)) . ',';
                    }
                    $this->data['not_avail_days'] = $not_avail_days;
                    // $this->data['not_avail_days']=trim($not_avail_days,',');
                }

                // exit($this->data['not_avail_days']);
                $this->load->view('lessons/book-lesson', $this->data);
            }
        } else
            show_404();
    }

    function book_chat_lesson($requster_id = '')
    {
        $requster_id = intval(doDecode($requster_id));
        if ($this->session->mem_type == 'student') {
            $tutor_id = $requster_id;
            $student_id = $this->session->mem_id;
        } else {
            $tutor_id = $this->session->mem_id;
            $student_id = $requster_id;
        }

        if ($tutor_row = $this->member_model->get_tutor($tutor_id)) {

            if ($this->input->post()) {
                $post = html_escape($this->input->post());

                $res = array();
                $res['hide_msg'] = 0;
                $res['scroll_to_msg'] = 1;
                $res['status'] = 0;
                $res['frm_reset'] = 0;
                $res['redirect_url'] = 0;

                $checkTimings = $this->member_model->check_timing($tutor_id);
                $flag = 0;
                if (count($checkTimings) > 0) {
                    $flag = 1;
                    $this->form_validation->set_message('integer', 'Please select a valid {field}');
                }
                $this->form_validation->set_message('integer', 'Please select a valid {field}');
                $this->form_validation->set_rules('subject', 'subject', 'required|integer');
                $this->form_validation->set_rules('date', 'Date', 'required|is_min_valid_date', array('required' => 'Please select a {field}'));
                $this->form_validation->set_rules('time', 'Time', 'required');
                $this->form_validation->set_rules('hours', 'Hours', 'required|numeric', array('required' => 'Please select a {field}'));
                $this->form_validation->set_rules('lesson_type', 'Lesson type', 'required');
                if ($post['lesson_type'] == 'In Person')
                    $this->form_validation->set_rules('address', 'Address', 'required');
                // $this->form_validation->set_rules('detail','Detail','required');

                if ($this->form_validation->run() === FALSE) {
                    $res['msg'] = validation_errors();
                } else {

                    if (!in_array($post['lesson_type'], array('In Person', 'Online'))) {
                        $res['msg'] = showMsg('error', 'Please select a valid Lesson type');
                        exit(json_encode($res));
                    }

                    if (!$this->master->getRow('tutor_subjects', array('mem_id' => $tutor_id, 'subject_id' => $post['subject']))) {
                        $res['msg'] = showMsg('error', 'Please select a valid subject');
                        exit(json_encode($res));
                    }
                    $day = date('l', strtotime($post['date']));
                    if (!$this->master->getRow('tutor_timings', array('mem_id' => $tutor_id, 'day' => $day, 'available' => 1))  && $flag == 1) {
                        $res['msg'] = showMsg('error', "Please select a valid Date");
                        exit(json_encode($res));
                    }

                    $start_time = empty($post['time']) ? '' : get_full_time($post['time']);
                    $lesson_date_time = db_format_date($post['date']) . ' ' . $start_time;
                    if (compare_dates($lesson_date_time, date('Y-m-d H:i'), 'Y-m-d H:i')) {
                        $res['msg'] = showMsg('error', 'Please select future timing !');
                        exit(json_encode($res));
                    }

                    $start_time = $lesson_date_time;
                    $date = new DateTime($start_time);
                    $f_hours = hours_format($post['hours']);
                    $f_hours = str_replace('h', 'hour', $f_hours);
                    $date->modify('+' . $f_hours);
                    $video_max_join_time = $date->format('Y-m-d H:i');

                    $amount = $tutor_row->mem_hourly_rate * $post['hours'];
                    $save_data = array('tutor_id' => $tutor_id, 'student_id' => $student_id, 'subject_id' => $post['subject'], 'lesson_date_time' => $lesson_date_time, 'hours' => $post['hours'], 'video_max_join_time' => $video_max_join_time, 'lesson_type' => $post['lesson_type'], 'address' => $post['address'], 'detail' => $post['detail'], 'amount' => $amount, 'tutor_noti' => 1, 'student_noti' => 1, 'date' => date("Y-m-d H:i:s"));

                    $save_data['status'] = $this->session->mem_type == 'student' ? 0 : 1;

                    $lesson_id = $this->lesson_model->save($save_data);
                    if ($lesson_id == 0) {
                        $res['msg'] = showMsg('error', 'Something went wrong. Please try again!');
                        $res['lesson'] = $encoded_id;
                        $res['frm_reset'] = 0;
                        exit(json_encode($res));
                    }
                    $encoded_id = doEncode('lsn-' . $lesson_id);
                    $this->lesson_model->save(array('encoded_id' => $encoded_id), 'id', $lesson_id);

                    if ($this->session->mem_type == 'student') {
                        $txt = 'You have a new lesson request from ' . format_name($this->data["mem_data"]->mem_fname, $this->data["mem_data"]->mem_lname) . '. <a href="javascript:void(0)" class="view-detail" data-link="get-request-detail" data-store="' . $encoded_id . '">click here</a> to view detail.';

                        save_notificaiton($tutor_id, $this->session->mem_id, $txt);

                        $where = array('mem_id' => $student_id);
                        $student_row = $this->member_model->get_row_where($where, 'members');
                        $where = array('mem_id' => $tutor_id);
                        $tutor_row = $this->member_model->get_row_where($where, 'members');
                        $data = array();
                        $link = base_url("login") . "?email=" . urlencode($tutor_row->mem_email) . "&password=" . urlencode(doDecode($tutor_row->mem_pswd));
                        $emailto = $tutor_row->mem_email;
                        $data['email_subject'] = 'Lesson Request!';
                        $data['name'] = $student_row->mem_fname . ' ' . $student_row->mem_lname;
                        $data['loginlink'] = $link;
                        $data['email_body'] = $data['name'] . "has requested a lesson with you! Check your Lesson Requests for more info.";
                        sendgridWithTemplate($emailto, $data['email_subject'], Lesson_request_template_id, [
                            'appname' => 'Crainly',
                            'username' => $data['name'],
                            'myaccount' => site_url('my-lessons/'),
                            'help_link' => site_url('contact-us/')
                        ]);

                        $res['msg'] = showMsg('success', 'Book a Lesson request has been sent successfully!');
                    } else {
                        $txt = format_name($this->data["mem_data"]->mem_fname, $this->data["mem_data"]->mem_lname) . '.scheduled a lesson with you <a href="javascript:void(0)" class="view-detail" data-link="get-request-detail" data-store="' . $encoded_id . '">click here</a> to view detail.';

                        save_notificaiton($student_id, $tutor_id, $txt);
                        $res['msg'] = showMsg('success', 'Lesson scheduled has been successfully!');

                        $where = array('mem_id' => $student_id);
                        $student_row = $this->member_model->get_row_where($where, 'members');
                        $where = array('mem_id' => $tutor_id);
                        $tutor_row = $this->member_model->get_row_where($where, 'members');
                        $data = array();
                        $link = base_url("login") . "?email=" . urlencode($student_row->mem_email) . "&password=" . urlencode(doDecode($student_row->mem_pswd));
                        $emailto = $student_row->mem_email;
                        $data['email_subject'] = 'Lesson Scheduled!';
                        $data['name'] = $tutor_row->mem_fname . ' ' . $tutor_row->mem_lname;
                        sendgridWithTemplate($emailto, $data['email_subject'], Lesson_request_template_id, [
                            'appname' => 'Crainly',
                            'username' => $data['name'],
                            'myaccount' => site_url('my-lessons/'),
                            'help_link' => site_url('contact-us/')
                        ]);
                    }

                    $res['lesson'] = $encoded_id;
                    $res['status'] = 1;
                    $res['frm_reset'] = 1;
                }
                exit(json_encode($res));
            }
        } else
            show_404();
    }

    function check_coupon()
    {
        if ($this->input->post()) {
            $res = array();
            $res['hide_msg'] = 0;
            $res['scroll_to_msg'] = 1;
            $res['status'] = 0;
            $res['frm_reset'] = 0;
            $res['redirect_url'] = 0;

            $encoded_id = $this->input->post('store');
            $id = intval(substr(doDecode($encoded_id), 4));

            $post = html_escape($this->input->post());

            $date = date('Y-m-d H:i:s');
            $getdata = $this->master->getRow('promocode', array('expire_date > ' => $date, 'code' => $post['promocode']));
            $check_used = $this->master->getRow('coupon', array('coupon_id' => $post['promocode'], 'coupon_mem_id' => 1, 'coupon_expire' => 1, 'mem_id' => $this->session->mem_id));
            if ($getdata != null && $check_used == null) {
                $reward = floatval($getdata->code_value);
                $amount = floatval($post['total_num']);
                if ($getdata->code_type == "percent") {
                    $reward = $amount * $reward / 100;
                    $reward = truncate_decimal($reward);
                }
                $amount = $amount - $reward;

                $promocode_id = $this->master->save('coupon', array('mem_id' => $this->session->mem_id, 'coupon_mem_id' => 1, 'coupon_expire' => 1, 'reward' => $reward, 'lesson_id' => $id, 'coupon_id' => $post['promocode']));

                $save_data['discount'] = $reward;
                $save_data['promocode'] = $post['promocode'];
                $save_data['promocode_id'] = $promocode_id;
                //                $save_data['amount']=$amount;
                $this->lesson_model->save($save_data, 'id', $id);

                $res['amount'] = '$' . $amount;
                $res['status'] = 1;
                $res['discount'] = $amount;
                $res['promo_code_discount'] = '- $' . floatval($reward);
                $res['data'] .= '<div class="accept"  style="color:green;">Promo Code applied! </br>  You got ' . $reward . ' discount</div>';

                exit(json_encode($res));
            } else {
                $date = date('Y-m-d H:i:s');
                $getdata = $this->master->getRow('coupon', array('expire_time > ' => $date, 'coupon_id' => $post['promocode'], 'coupon_mem_id' => 0, 'mem_id' => $this->session->mem_id));
                if ($getdata->coupon_id) {
                    $this->master->save('coupon', array('coupon_mem_id' => 1, 'coupon_expire' => 1, 'lesson_id' => $id), 'coupon_id', $post['promocode']);
                    $reward = floatval($getdata->reward);
                    $amount = floatval($post['total_num']);
                    $amount = $amount - $reward;

                    //$amount = $amount - $reward;
                    $save_data['discount'] = $reward;
                    $save_data['promocode'] = $post['promocode'];
                    $save_data['promocode_id'] = $getdata->id;
                    $save_data['amount'] = $amount;

                    $this->lesson_model->save($save_data, 'id', $id);

                    $res['amount'] = '$' . number_format($amount, 2, '.', '');
                    $res['status'] = 1;
                    $res['discount'] = number_format($amount, 2, '.', '');
                    $res['promo_code_discount'] = '- $' . floatval($reward);
                    $res['data'] .= '<div class="accept"  style="color:green;">Promo Code applied! </br>  You got ' . $reward . ' discount</div>';

                    exit(json_encode($res));
                } else {
                    $res['amount'] = '$' . floatval($post['total_num']);
                    $res['discount'] = 0;
                    $res['status'] = 0;
                    $res['promo_code_discount'] = 0;
                    $res['data'] .= '<div class="decline" style="color:red;">Promo Code is invalid!</div>';
                    exit(json_encode($res));
                }
            }
        }
    }

    function book_now()
    {
        //$this->isMemLogged('student');
        if ($this->input->post()) {
            $res = array();
            $res['hide_msg'] = 0;
            $res['scroll_to_msg'] = 1;
            $res['status'] = 0;
            $res['frm_reset'] = 0;
            $res['redirect_url'] = 0;
            $post = html_escape($this->input->post());

            $this->form_validation->set_rules('store', 'Store', 'required', array('required' => 'Something went wrong!'));
            if ($post['payment_type'] == 'credit-card') {
                $this->form_validation->set_rules('nonce', 'Nonce', 'required', array('required' => "Something went wrong!"));
            } else
                $this->form_validation->set_rules('payment_method', 'Payment Method', 'required', array('required' => 'Please Select Pyament Method!'));
            if ($this->form_validation->run() === FALSE) {
                $res['msg'] = validation_errors();
            } else {

                $encoded_id = $post['store'];
                $id = intval(substr(doDecode($encoded_id), 4));
                $condition = array('mem_type<>' => $this->session->mem_type, $this->session->mem_type . '_id' => $this->session->mem_id, 'l.status' => 1);
                if (!$row = $this->lesson_model->get_lesson($id, $condition)) {
                    $res['msg'] = showMsg('error', 'Something went worng!');
                    exit(json_encode($res));
                }
                $this->load->model('payment_methods_model');
                if ($post['payment_type'] == 'credit-card') {
                    /*$last_digits=substr($post['cardnumber'], -4);
                    $expiry=get_month_name($post['exp_month']).', '.$post['exp_year'];
                    $save_data=array('mem_id'=>$this->session->mem_id,'last_digits'=>$last_digits,'expiry'=>$expiry);
                    $card_id=$this->payment_methods_model->save($save_data);
                    $this->payment_methods_model->save(array('encoded_id'=>doEncode('pm-'.$card_id)),$card_id);*/
                } else {
                    $method_id = intval(substr(doDecode($post['payment_method']), 3));
                    if (!$method_row = $this->payment_methods_model->get_mem_method($method_id)) {
                        $res['msg'] = showMsg('error', 'Please select valid saved card!');
                        exit(json_encode($res));
                    }

                    $save_data = array('tutor_noti' => 1, 'status' => 2);
                    $amount = floatval($row->amount);
                    $flag = 0;
                    $reward = 0;

                    //					$percentage_amount = '';
                    //                    if(empty($row->promocode))
                    //                    {
                    //                    	$percentage_amount = $this->data['site_settings']->site_percentage>0?round(($this->data['site_settings']->site_percentage*$amount)/100,2):0;
                    //                    }
                    $percentage_amount = $this->data['site_settings']->site_percentage > 0 ? round(($this->data['site_settings']->site_percentage * $amount) / 100, 2) : 0;

                    if (!empty($percentage_amount)) {
                        $amount = floatval($amount) + floatval($percentage_amount);
                    }

                    $where = array('mem_id' => $this->session->mem_id, 'first_lesson_off' => 1);
                    $mem_ref_row = $this->master->getRow('ref_signups', $where);

                    if (!empty($mem_ref_row)) {
                        $amount = floatval($amount) - floatval($mem_ref_row->reward);
                    }
                    $getdata = $this->master->getRow('coupon', array('coupon_mem_id' => 1, 'mem_id' => $this->session->mem_id, 'coupon_expire' => 1, 'lesson_id' => $id));

                    if ($getdata->reward) {
                        $amount = floatval($amount) - floatval($getdata->reward); //amount added just to for stripe custom copon method (metadata)
                    }
                    // $metadata = array('coupon_code' => $getdata->coupon_id, 'coupon_discount' => $getdata->reward);

                    $charge = $this->my_stripe->charge($this->data['mem_data']->mem_stripe_id, $method_row->method_token, $amount, "Charge for " . $this->data['mem_data']->mem_email); //charge made by stripe

                    if (empty($charge)) {
                        $res['msg'] = showMsg('error', 'Something went worng please try again later!');
                        exit(json_encode($res));
                    }
                    //if(!empty($post['promocode']) && $promocode_row)
                    //$this->promocode_model->save(array('status'=>1),$promocode_row->id, 'id');
                }
                //                $save_data['amount']=$amount;
                $this->lesson_model->save($save_data, 'id', $id);
                $this->transaction_model->save(array('mem_id' => $row->student_id, 'lesson_id' => $id, 'amount' => $amount, 'status' => 0));

                $txt = 'Your lesson with ' . format_name($this->data["mem_data"]->mem_fname, $this->data["mem_data"]->mem_lname) . '. has been confirmed! You can view your upcoming lesson in <a href="' . site_url('my-lessons') . '">My Lessons</a>.';
                save_notificaiton($row->tutor_id, $this->session->mem_id, $txt);

                $where = array('mem_id' => $row->student_id);
                $student_row = $this->member_model->get_row_where($where, 'members');
                $where = array('mem_id' => $row->tutor_id);
                $tutor_row = $this->member_model->get_row_where($where, 'members');
                $data = array();
                $date = $date = date_create($row->lesson_date_time);
                $date = date_format($date, "l F jS") . " at " . date_format($date, "h:i:s A") . " Pacific Time (PT).";
                // $link = base_url("login")."?email=".urlencode($tutor_row->mem_email)."&password=".urlencode(doDecode($tutor_row->mem_pswd));
                $emailto = $tutor_row->mem_email;
                $data['email_subject'] = 'Lesson Booked!';
                $data['name'] = $student_row->mem_fname . ' ' . $student_row->mem_lname;
                sendgridWithTemplate($emailto, $data['email_subject'], Lesson_booked_template_id, [
                    'appname' => 'Crainly',
                    'help_link' => site_url('contact-us/'),
                    'username' =>   $data['name'] ,
                    'booked_date' => $date,
                    'myaccount' => site_url('my-lessons/')
                ]);
                $txt = 'Lesson has been booked!';
                save_notificaiton($row->student_id, $row->tutor_id, $txt);


                $data = array();
                // $link = base_url("login")."?email=".urlencode($tutor_row->mem_email)."&password=".urlencode(doDecode($tutor_row->mem_pswd));
                $emailto = $student_row->mem_email;
                $data['email_subject'] = 'Lesson Booked!';
                $data['name'] = $tutor_row->mem_fname . ' ' . $tutor_row->mem_lname;
                // $data['loginlink'] = $link;
                sendgridWithTemplate($emailto, $data['email_subject'], Lesson_booked_template_id, [
                    'appname' => 'Crainly',
                    'help_link' => site_url('contact-us/'),
                    'username' =>   $data['name'] ,
                    'booked_date' => $date,
                    'myaccount' => site_url('my-lessons/')
                ]);
                $this->master->save('ref_signups', array('first_lesson_off' => 0), 'mem_id', $this->session->mem_id);
                if ($flag == 1) {
                    $res['discount'] = $amount;
                    $res['data'] .= '<div class="alertBlk accept">Lesson has been booked! </br>  $10 coupon applied !</div>';
                } else {

                    $res['discount'] = $amount;
                    $res['data'] .= '<div class="alertBlk accept">Lesson has been booked!</div>';
                }
                $res['status'] = 1;
            }
            exit(json_encode($res));
        } else
            $this->load->view("payments/add-payment-method", $this->data);
    }

    function join_lecture($encoded_id = '')
    {
        $id = intval(substr(doDecode($encoded_id), 4));

        $condition = array('mem_type<>' => $this->session->mem_type, $this->session->mem_type . '_id' => $this->session->mem_id);
        // $condition=array('mem_type<>'=>$this->session->mem_type,$this->session->mem_type.'_id'=>$this->session->mem_id,'l.lesson_type'=>'online');

        // $condition=array('mem_type<>'=>$this->session->mem_type,$this->session->mem_type.'_id'=>$this->session->mem_id,'l.status'=>2,'l.completed'=>0,'l.lesson_type'=>'online','l.video_lesson_status'=>0,'l.video_end_time<='=>date('Y-m-d H:i'));
        if ($this->data['lesson_row'] = $this->lesson_model->get_lesson($id, $condition)) {


            $this->load->library("OpenTok/OpenTok");
            $OT = new OpenTok(OpenTok_API_KEY, OpenTok_SECRET_KEY);

            $this->data['member_id']   = $this->session->mem_id;
            $this->data['member_type'] = $this->session->mem_type;
            $this->data['member_name'] = format_name($this->data['mem_data']->mem_fname, $this->data['mem_data']->mem_lname);

            $where = array($this->session->mem_type . '_id' => $this->session->mem_id);

            $this->data['socket_url'] = '';
            //$this->data['sessionData']=$this->member_model->getDetails('tbl_chat_video_class',$where);

            $socketdetails = $this->member_model->getDetails('tbl_sitecontent', array('type' => 'socket_url'));

            if (!empty($socketdetails))
                $this->data['socket_url'] = $socketdetails->code;
            if (empty($this->data['lesson_row']->video_session_id)) {
                $OT->generate_session_id(array('mediaMode' => 'Routed'));
                $sessionid = (array) $OT->sessionId;
				
                $video_session_id = isset($sessionid[0]) ? $sessionid[0] : '';

                // $end_time=date("H:i", strtotime('+'.hours_format($this->data['lesson_row']->hours)));

                $start_time = date('Y-m-d H:i');
                /*$date = new DateTime($start_time);
                $f_hours=hours_format($this->data['lesson_row']->hours);
                $f_hours=str_replace('h', 'hour', $f_hours);
                $date->modify('+'.$f_hours);
                $end_time=$date->format('Y-m-d H:i');*/

                $this->lesson_model->save(array('video_session_id' => $video_session_id), 'id', $id);
	            $this->data['lesson_row']->video_session_id = $video_session_id;

                // $this->lesson_model->save(array('video_session_id'=>$video_session_id,'video_start_time'=>$start_time,'video_end_time'=>$end_time),$id);
                // $this->data['lesson_row']->video_end_time=$end_time;

            }
            $this->data['lecture_time'] = format_hour_to_time($this->data['lesson_row']->hours);

            // $this->data['lecture_time']=get_time_difference($this->data['lesson_row']->video_end_time,date('Y-m-d H:i:00'));

            //  $chats = $this->getChatMessage($this->data['sessionData']->student_id,$this->data['sessionData']->tutor_id);
            //   $this->data['chatMsg'] = $chats;
            $this->data['openTok_sessionId'] = $this->data['lesson_row']->video_session_id;
            $this->data['openTok_apiKey'] = OpenTok_API_KEY;
            $OT->generate_token($this->data['openTok_sessionId']);
            $this->data['openTok_token'] = isset($OT->token) ? $OT->token : '';

            /** updated start 23-09-2019 */
            $this->data['sessionID']       =   $this->data['lesson_row']->id;
            $minutes                       =   $this->convertToHoursMins($this->data['lesson_row']->hours);
            $now                           =   time();
            $add_minutes                   =   $now + ($minutes * 60);
            $startTime                     =   date('Y-m-d H:i:s', $now);
            $endTime                       =   date('Y-m-d H:i:s', $add_minutes);
            $this->data['startTime']       =   $startTime;
            $this->data['endTime']         =   $endTime;
            $lesson_date_time              =   $this->data['lesson_row']->lesson_date_time;

            $time_started = strtotime($startTime);
            $time_office = strtotime($lesson_date_time);
            $interval = $time_office - $time_started;
            if ($interval < 0) $interval = 0;
            $this->data['earlyTime'] = $interval;
            $lecture_time                  =   $this->data['lecture_time'];
            $video_start_time = $this->data['lesson_row']->video_start_time;

//            $tmpDate = '2020-07-10 17:13:25';
//            $lesson_date_time = $tmpDate;
//	        $lecture_time = '01:00:00';
//	        $video_start_time = $tmpDate;
            $sessionTimeRemains            =   getSessionTime($lesson_date_time, $lecture_time, $video_start_time, '%H:%i:%s');

            //  echo $lesson_date_time."//////////".$lecture_time."//////////////".$sessionTimeRemains."//////////".$video_start_time; die;

            // $time = explode(":",$this->data['lecture_time']);
            $time                          =   explode(":", $sessionTimeRemains);
            $this->data['hours']           =   isset($time[0]) ? $time[0] : 00;
            $this->data['minutes']         =   isset($time[1]) ? $time[1] : 00;
            $this->data['seconds']         =   isset($time[2]) ? $time[2] : 00;
            $this->data['subject_id']      =   ($this->data['lesson_row']->subject_id) ? $this->data['lesson_row']->subject_id : '';
            $this->data['tutor_id']        =   $this->data['lesson_row']->tutor_id;
            $this->data['student_id']      =   $this->data['lesson_row']->student_id;
            
            /** updated end 23-09-2019 */
            $this->load->view("lessons/video-lecture", $this->data);
        } else
            show_404();
    }
    function convertToHoursMins($hours)
    {
        $minutes = 0;
        $explode = explode(".", $hours);
        $min1 = intval($explode[0] * 60);
        $min2 = isset($explode[1]) ? 30 : 0;
        $minutes = intval($min1) + intval($min2);
        return $minutes;
    }
    // function join_lecture($encoded_id='') {
    //     $id=intval(substr(doDecode($encoded_id),4));
    //     $condition=array('mem_type<>'=>$this->session->mem_type,$this->session->mem_type.'_id'=>$this->session->mem_id,'l.status'=>2,'l.completed'=>0,'l.lesson_type'=>'online','l.video_lesson_status'=>0);
    //     // $condition=array('mem_type<>'=>$this->session->mem_type,$this->session->mem_type.'_id'=>$this->session->mem_id,'l.status'=>2,'l.completed'=>0,'l.lesson_type'=>'online','l.video_lesson_status'=>0,'l.video_end_time<='=>date('Y-m-d H:i'));
    //     if($this->data['lesson_row'] = $this->lesson_model->get_lesson($id,$condition)){


    //         $this->load->library("OpenTok/OpenTok");
    //         $OT = new OpenTok(OpenTok_API_KEY, OpenTok_SECRET_KEY);

    //         $this->data['member_id']   = $this->session->mem_id;
    //         $this->data['member_type'] = $this->session->mem_type;
    //         $this->data['member_name'] = format_name($this->data['mem_data']->mem_fname,$this->data['mem_data']->mem_lname);

    //         $where = array($this->session->mem_type.'_id'=>$this->session->mem_id);

    //         $this->data['socket_url']='';
    //         // $this->data['sessionData']=$this->member_model->getDetails('tbl_chat_video_class',$where);

    //         $socketdetails=$this->member_model->getDetails('tbl_sitecontent',array('type'=>'socket_url'));

    //         if(!empty($socketdetails))
    //             $this->data['socket_url'] = $socketdetails->code;
    //         if(empty($this->data['lesson_row']->video_session_id))
    //         {
    //             $OT->generate_session_id(array('mediaMode' => 'Routed'));
    //             $sessionid = (array)$OT->sessionId;
    //             $video_session_id = isset($sessionid[0])?$sessionid[0]:'';

    //             // $end_time=date("H:i", strtotime('+'.hours_format($this->data['lesson_row']->hours)));

    //             $start_time=date('Y-m-d H:i');
    //             /*$date = new DateTime($start_time);
    //             $f_hours=hours_format($this->data['lesson_row']->hours);
    //             $f_hours=str_replace('h', 'hour', $f_hours);
    //             $date->modify('+'.$f_hours);
    //             $end_time=$date->format('Y-m-d H:i');*/

    //             $this->lesson_model->save(array('video_session_id'=>$video_session_id),$id);

    //             // $this->lesson_model->save(array('video_session_id'=>$video_session_id,'video_start_time'=>$start_time,'video_end_time'=>$end_time),$id);
    //             // $this->data['lesson_row']->video_end_time=$end_time;

    //         }
    //         $this->data['lecture_time']=format_hour_to_time($this->data['lesson_row']->hours);
    //         // $this->data['lecture_time']=get_time_difference($this->data['lesson_row']->video_end_time,date('Y-m-d H:i:00'));

    //       //  $chats = $this->getChatMessage($this->data['sessionData']->student_id,$this->data['sessionData']->tutor_id);
    //      //   $this->data['chatMsg'] = $chats;
    //         $this->data['openTok_sessionId'] = $this->data['lesson_row']->video_session_id;
    //         $this->data['openTok_apiKey'] = OpenTok_API_KEY;
    //         $OT->generate_token($this->data['openTok_sessionId']);
    //         $this->data['openTok_token'] = isset($OT->token)?$OT->token:'';

    //         /** updated start 23-09-2019 */
    //             // $data['sessionID']=$data['sessionData'][0]->id;
    //         /** updated end 23-09-2019 */
    //         $this->load->view("lessons/video-lecture",$this->data);
    //     }
    //     else
    //       show_404();
    // }

    function video_completed()
    {
        $id = intval($this->input->post('lesson'));
        $condition = array('mem_type<>' => $this->session->mem_type, $this->session->mem_type . '_id' => $this->session->mem_id, 'l.status' => 2, 'completed' => 0, 'canceled' => 0, 'video_lesson_status' => 0);
        if ($row = $this->lesson_model->get_lesson($id, $condition)) {

            $this->lesson_model->save(array('student_noti' => 1, 'tutor_noti' => 1, 'video_lesson_status' => 1, 'video_max_join_time' => date('Y-m-d H:i')), 'id', $id);

            $noti_mem = $this->session->mem_type == 'tutor' ? 'student' : 'tutor';
            /*$txt='Your lesson with '.format_name($this->data["mem_data"]->mem_fname,$this->data["mem_data"]->mem_lname).'. has been canceled. <a href="javascript:void(0)" class="view-detail" data-store="'.$encoded_id.'" data-link="lesson-detail">click here</a> to view.';
            save_notificaiton($row->{$noti_mem.'_id'},$this->session->mem_id,$txt);*/

            $res['status'] = 1;
            exit(json_encode($res));
        } else {
	        $res['status'] = 1;
	        exit(json_encode($res));
        }
//        die('access denied');
    }
}
