<?php

class My_jobs extends MY_Controller {

    function __construct() {
        parent::__construct();
        //$this->isMemLogged($this->session->mem_type);
        $this->load->model('member_model');
        $this->load->model('job_model');
    }

    function index() {
        $this->isMemLogged('student');
        if($this->input->post()){
            $condition=array("j.mem_id"=>$this->session->mem_id);
            $res['items'] = "";
            $res['reached']=true;
            $res['found']=1;
            $res['load']=1;

            $page=intval($this->input->post('load'));
            $page=$page>0?$page:1;
            $per_page=20;
            $total=$this->job_model->total_mem_jobs($condition);
            $total_pages=ceil($total/$per_page);
            $start=($page-1)*$per_page;

            $res['reached']=$total_pages>$page?false:true;


            $jobs = $this->job_model->get_mem_jobs($condition,$start,$per_page);
            if (count($jobs) > 0) {
                $res['found']=1;
                $res['load']=$page+1;

                foreach ($jobs as $key => $job){
                    $res['items'] .= 
                    '<li class="hidden">
                    <div class="innerJobList">
                    <div class="ico"><img src="'.get_image_src($job->mem_image,50,true).'"></div>
                    <div class="job-meta">
                    <div class="title">
                    <h4><a href="'.site_url('job-detail/'.$job->encoded_id).'">
                    '.$job->title.'</a>
                    </h4>
                    <p>'.short_text($job->detail,300).'</p>
                    </div>
                    <div class="meta-info d-flex">
                    <p><i class="fa fa-map-marker" aria-hidden="true"></i>'.$job->city.', '.$job->state.', '.$job->zip.'</p>
                    <p><i class="fa fa-calendar" aria-hidden="true"></i>'.format_date($job->date,'l, M d Y').'</p>
                    <!--<p><i class="fa fa-money" aria-hidden="true"></i>'.format_amount($job->budget).'</p>-->
                    </div>
                    </div>
                    <div class="_jobDetail boardJob">
                    <a class="time-btn1 time-btn" href="'.site_url('job-detail/'.$job->encoded_id).'">View</a>
                    <a class="time-btn1 time-btn edtBtn" href="javascript:void(0)" data-store="'.$job->encoded_id.'">Edit</a>
                    <a class="time-btn1 time-btn dltBtn" href="javascript:void(0)" data-store="'.$job->encoded_id.'">Delete</a>
                    </div>
                    </div>
                    </li>';
                }
            }
            else
                $res['items'] = '<li class="hidden"><p class="semi color" style="padding:10px">No job available</p></li>';
            // $res['query'] = $this->db->last_query();
            exit(json_encode($res));
        }else{
            $this->data['grade_levels']=$this->master->getRows('job_grade_levels');
            $this->load->view("jobs/my-jobs", $this->data); 
        }
    }

    function add_new() {
        $this->isMemLogged('student');
        if($this->input->post()){

            $res=array();
            $res['hide_msg']=0;
            $res['scroll_to_msg']=1;
            $res['status'] = 0;
            $res['frm_reset'] = 0;
            $res['redirect_url'] = 0;

            $this->form_validation->set_message('integer', 'Please select a valid {field}');
            $this->form_validation->set_rules('title','Title','required');
            // $this->form_validation->set_rules('budget','Budget','required|integer',array('integer'=>'Please enter valid {field}'));
            $this->form_validation->set_rules('subject','Subject','required');
            $this->form_validation->set_rules('grade_level','Grade Level','required');
            // $this->form_validation->set_rules('date','Date','required|is_min_valid_date',array('required'=>'Please select a {field}'));
            // $this->form_validation->set_rules('subject','Subject','required|integer');
            // $this->form_validation->set_rules('hours','Hours','required|numeric',array('required'=>'Please select a {field}'));
            $this->form_validation->set_rules('city','City','required');
            $this->form_validation->set_rules('state','State','required');
            $this->form_validation->set_rules('zip','Zip Code','required');
            $this->form_validation->set_rules('detail','Detail','required');

            if($this->form_validation->run()===FALSE)
            {
                $res['msg'] = validation_errors();
            }else{
                $post = html_escape($this->input->post());
                if(!$this->master->getRow('job_grade_levels',array('name'=>$post['grade_level']))){
                    $res['msg'] = showMsg('error','Please select a valid Grade Level');
                    exit(json_encode($res));
                }
                $coordinates=get_location_detail($post['zip']);
                $post['lat']=$coordinates->Latitude;
                $post['lng']=$coordinates->Longitude;

                $save_data=array('mem_id'=>$this->session->mem_id,'title'=>$post['title'],'subject'=>$post['subject'],'grade_level'=>$post['grade_level']/*,'budget'=>$post['budget']*/,'city'=>$post['city'],'state'=>$post['state'],'zip'=>$post['zip'],'detail'=>$post['detail'],'map_lat'=>$post['lat'],'map_lng'=>$post['lng'],'status'=>1,'date'=>date("Y-m-d H:i:s"));


                $job_id=$this->job_model->save($save_data);
                $encoded_id=doEncode('jb-'.$job_id);
                $this->job_model->save(array('encoded_id'=>$encoded_id),$job_id);

                $res['msg'] = showMsg('success','Job has been saved successfully!');
                $res['redirect_url'] = site_url('my-jobs');
                $res['status'] = 1;
                $res['frm_reset'] = 1;
            }
            exit(json_encode($res));
        }
        else
            show_404();
    }

    function edit(){
        $this->isMemLogged('student');
        $id=intval(substr(doDecode($this->input->post('store')),3));
        if($this->job_model->get_row_where(array('id'=>$id,'mem_id'=>$this->session->mem_id)) && $this->input->post()){
            $res=array();
            $res['hide_msg']=0;
            $res['scroll_to_msg']=1;
            $res['status'] = 0;
            $res['frm_reset'] = 0;
            $res['redirect_url'] = 0;

            $this->form_validation->set_rules('title','Title','required');
            // $this->form_validation->set_rules('budget','Budget','required|integer',array('integer'=>'Please enter valid {field}'));
            $this->form_validation->set_rules('subject','Subject','required');
            $this->form_validation->set_rules('grade_level','Grade Level','required');
            $this->form_validation->set_rules('city','City','required');
            $this->form_validation->set_rules('state','State','required');
            $this->form_validation->set_rules('zip','Zip Code','required');
            $this->form_validation->set_rules('detail','Detail','required');

            if($this->form_validation->run()===FALSE)
            {
                $res['msg'] = validation_errors();
            }else{
                $post = html_escape($this->input->post());
                if(!$this->master->getRow('job_grade_levels',array('name'=>$post['grade_level']))){
                    $res['msg'] = showMsg('error','Please select a valid Grade Level');
                    exit(json_encode($res));
                }
                $coordinates=get_location_detail($post['zip']);
                $post['lat']=$coordinates->Latitude;
                $post['lng']=$coordinates->Longitude;

                $save_data=array('title'=>$post['title'],'subject'=>$post['subject'],'grade_level'=>$post['grade_level']/*,'budget'=>$post['budget']*/,'city'=>$post['city'],'state'=>$post['state'],'zip'=>$post['zip'],'detail'=>$post['detail'],'map_lat'=>$post['lat'],'map_lng'=>$post['lng']);

                $this->job_model->save($save_data,$id);

                $res['msg'] = showMsg('success','Job has been saved successfully!');
                $res['redirect_url'] = site_url('my-jobs');
                $res['status'] = 1;
                $res['frm_reset'] = 1;
            }
            exit(json_encode($res));
        }
        else
            show_404();
    }

    function delete(){
        $this->isMemLogged('student');
        $res=array();
        $res['status']=0;
        $id=intval(substr(doDecode($this->input->post('store')),3));
        if ($this->job_model->get_job($id,array('j.mem_id'=>$this->session->mem_id))) {
            $this->job_model->delete($id);
            $res['status']=1;
        }
        exit(json_encode($res));
    }

    function get_job(){
        $this->isMemLogged('student');
        $id=intval(substr(doDecode($this->input->post('store')),3));
        if($row=$this->job_model->get_row_where(array('id'=>$id,'mem_id'=>$this->session->mem_id)))
            exit(json_encode($row));
        exit('access denied!');
    }

    function detail($id=''){
        $id=intval(substr(doDecode($id),3));
        if ($this->data['row']=$this->job_model->get_job($id,array('status'=>1))) {
            $this->load->view('jobs/job-detail', $this->data);
        }
        else
            show_404();
    }
}
?>