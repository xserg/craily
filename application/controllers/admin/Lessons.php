<?php

class Lessons extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->isLogged();
        $this->load->model('lesson_model');
    }

    public function index() {
        $this->data['enable_datatable'] = TRUE;
        $this->data['pageView'] = ADMIN . '/lessons';

        $this->data['rows'] = $this->lesson_model->get_rows(array(),'','','desc');
        $this->load->view(ADMIN.'/includes/siteMaster', $this->data);
    }

    public function LessonAjax() {
        $this->data['enable_datatable'] = TRUE;

        $start = $this->input->post('start');
        $draw = $this->input->post('draw');
        $limit = $this->input->post('length');

        if(empty($this->input->post('search')['value']))
        {            
            $this->data['rows'] = $this->lesson_model->get_rows(array(), $start, $limit,'desc');
            $this->data['allCount'] = $this->lesson_model->countAll();
        }
        else {
            $search = $this->input->post('search')['value']; 
            $this->data['rows'] = $this->lesson_model->lesson_search($limit,$start,$search);

            $this->data['allCount'] = $this->lesson_model->lesson_search_count($search);
        }
        

        //$this->data['rows'] = $this->lesson_model->get_rows(array(), $start, $limit,'desc');
        //$this->data['allCount'] = $this->lesson_model->countAll();
        
        foreach($this->data['rows'] as $row) {

            $student = "<b><a href=".site_url(ADMIN.'/students/manage/'.$row->student_id)." target=\"_blank\">".get_mem_name($row->student_id)."</a></b>";

            $tutor = "<b><a href=".site_url(ADMIN.'/tutors/manage/'.$row->tutor_id)." target=\"_blank\">".get_mem_name($row->tutor_id)."</a></b>";

            $lesson_date = format_date($row->lesson_date_time,'M d, Y h:i:m a');

            $date = format_date($row->date,'M d, Y h:i:m a');

            $amount = "$ ".$row->amount;

            $detail = "<a href=".site_url(ADMIN.'/lessons/detail/'.$row->id)." class=\"btn btn-primary btn-sm\">Detail</a>";


            //$nestedData['slno'] = $i;
            $nestedData['student'] = $student;
            $nestedData['tutor'] = $tutor;
            $nestedData['lesson_date'] = $lesson_date;
            $nestedData['date'] = $date;
            $nestedData['amount'] = $amount;
            $nestedData['detail'] = $detail;

            $data[] = $nestedData;

            //$LessonsData[] = array('slno' => "".$i."", 'student' => $student, 'tutor' => $tutor, 'lesson_date' => $lesson_date, 'date' => $date, 'amount' => $amount, 'detail' => $detail);
        }

        $output = array(
            "draw" => intval($draw),
            "recordsTotal" => intval($this->data['allCount']),
            "recordsFiltered" => intval($this->data['allCount']),
            "data" => $data
        );

        echo json_encode($output);
    }

    function detail($id=0) {
        $id=intval($id);
        if($this->data['row'] = $this->lesson_model->get_admin_lesson($id)){
            if($this->input->post()){
                $res=array();
                $res['hide_msg']=0;
                $res['scroll_top']=0;
                $res['status'] = 0;
                $res['frm_reset'] = 0;
                $res['redirect_url'] = 0;


                $this->form_validation->set_rules('date','Date','required');
                $this->form_validation->set_rules('start_time','Start Time','required');
                $this->form_validation->set_rules('end_time','End Time','required');
                if($this->data['row']->completed==2){
                    $this->form_validation->set_rules('rating','Rating','required|integer',array('integer'=>'Please rate this Lesson'));
                    $this->form_validation->set_rules('comment','Comment','required',array('required'=>'Please write comment!'));
                }
                
                if($this->form_validation->run()===FALSE)
                {
                    $res['msg'] = validation_errors();
                }else{
                    $post = html_escape($this->input->post());

                    $lesson_vals=array('final_date'=>db_format_date($post['date']),'final_start_time'=>get_full_time($post['start_time']),'final_end_time'=>get_full_time($post['end_time']));

                    $this->lesson_model->save($lesson_vals,$id);
                    $res['msg']=showMsg('success','Lesson has been marked completed successfully!');
                    
                    if($this->data['row']->completed==2){
                        if($post['rating']>5 || $post['rating']<0.1){
                            $res['msg'] = '<div class="alert alert-danger alert-sm"><strong>Error!</strong> Please rate this lesson!</div>';
                            exit(json_encode($res));
                        }
                        
                        $save_data=array('ref_id'=>$id,'ref_type'=>'lesson');

                        if($this->master->getRow('reviews',$save_data)){;
                            $save_data['rating']=$post['rating'];
                            $save_data['comment']=$post['comment'];


                            $this->master->save('reviews',$save_data,'ref_id',$id);

                            $res['status']=1;
                            $res['msg']=showMsg('success','Review has been saved successfully!');

                        }
                    }
                }
                exit(json_encode($res));
            }else{
                $this->data['logs'] = $this->master->getRows('tbl_logs',array('lesson'=>$id));
                $this->data['pageView'] = ADMIN.'/lessons';
                $this->data['member']=$this->master->getRow('members',array('mem_id'=>$this->data['row']->tutor_id));
                if($this->data['row']->canceled==1)
                    $this->data['canceled_by']=$this->master->getRow('members',array('mem_id'=>$this->data['row']->canceled_by));
                $this->load->view(ADMIN.'/includes/siteMaster', $this->data);
            }
        }
        else
            show_404();
    }

    function lesson_request_detail() {
        $encoded_id=$this->input->post('store');
        $id=intval(substr(doDecode($encoded_id),4));
        $condition=array('mem_type<>'=>'student');
        if($row = $this->lesson_model->get_lesson($id,$condition)){
            $res['data']='
            <div class="crosBtn"></div>
            <h3>Lesson Request</h3>';
            $res['data'].='
            <ul class="list">
            <li><strong>Name:</strong><span>'.$row->mem_name.'</span></li>
            <li><strong>Subject:</strong><span>'.$row->subject.'</span></li>
            <li><strong>Date:</strong><span>'.format_date($row->lesson_date_time).'</span></li>
            <li><strong>Start Time:</strong><span>'.format_date($row->lesson_date_time,'h:i A').'</span></li>
            <li><strong>Hours:</strong><span>'.hours_format($row->hours).'</span></li>
            <li><strong>Total:</strong><span>$'.num($row->amount).'</span></li>';
            if ($row->promocode!='')
                $res['data'].='<li><strong>Discount:</strong>$'.num($row->discount).'&emsp; <small>('.$row->promocode.')</small></li>';
            if ($row->completed==2)
                $res['data'].='<li><strong>Status:</strong><span>Complete</span></li>';
            $res['data'].='<li><strong>Lesson Type:</strong><span>'.$row->lesson_type.'</span></li>';
            if ($row->lesson_type=='In Person')
            $res['data'].='<li><strong>Location:</strong><span>'.$row->address.'</span></li>';

            $res['data'].='
            <li><strong>Message:</strong><span>'.$row->detail.'</span></li>
            </ul>';

            if ($row->status==1 && $row->canceled!=1)
                $res['data'].='<div class="alertMsg"><div class="alert alert-success">Request has been accepted!</div><div class="clearfix"></div></div>';
            elseif ($row->status==2)
                $res['data'].='<div class="alertMsg"><div class="alert alert-success">Lesson has been booked!</div><div class="clearfix"></div></div>';
            elseif ($row->status==3)
                $res['data'].='<div class="alertMsg"><div class="alert alert-danger">Request has been Declined.</div><div class="clearfix"></div></div>';
            if ($row->canceled==1)
                $res['data'].='<div class="alertMsg"><div class="alert alert-danger">Lessons has been Canceled.</div><div class="clearfix"></div></div>';
            $res['status']=1;
            exit(json_encode($res));
        }
        die('access denied');
    }

}

?>