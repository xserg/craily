<?php

class Tutor_applications extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->isLogged();
        has_access(3);
        $this->load->model('member_model');
    }

    function index() {
        $this->data['enable_datatable'] = TRUE;
        $this->data['pageView'] = ADMIN . '/tutor-applications';
        $this->data['rows'] = $this->member_model->get_rows(array('mem_type'=>'tutor','mem_tutor_application'=>1,'mem_tutor_verified<>'=>1));
        $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
    }

    function view() {
        $this->data['pageView'] = ADMIN . '/tutor-applications';
        if($this->data['row'] = $this->member_model->getMember($this->uri->segment('4'),array('mem_type'=>'tutor','mem_tutor_application'=>1,'mem_tutor_verified<>'=>1))){

            if ($this->input->post()) {
                $post = $this->input->post();
                $vals=$post;

                // $vals['mem_tutor_verified']=1;
                unset($vals['subject'],$vals['subjects'],$vals['days'],$vals['start_time'],$vals['end_time']);

                if($vals['mem_pswd']!='')
                    $vals['mem_pswd']=doEncode($vals['mem_pswd']);

                if (($_FILES["mem_image"]["name"] != "")) {
                    $image = upload_vfile('mem_image');
                    if (!empty($image['file_name'])) 
                    {
                        if(!empty($this->data['row']->mem_image))
                            remove_vfile($this->data['row']->mem_image);
                        $vals['mem_image'] = $image['file_name'];
                    }
                }

                $mem_id=$this->member_model->save($vals, $this->uri->segment(4));
                $this->master->delete('tutor_subjects','mem_id',$mem_id);
                foreach ($post['subjects'] as $sub_id) {
                    $this->master->save('tutor_subjects',array('mem_id'=>$mem_id,'subject_id'=>$sub_id,'type'=>'sub'));
                }
                $this->master->save('tutor_subjects',array('mem_id'=>$mem_id,'subject_id'=>$post['subject'],'type'=>'main'));

                $this->master->delete('tutor_timings','mem_id',$mem_id);
                $week_days=get_week_days();
                foreach ($week_days as $day_key=> $day) {
                    $available=$post['days'][$day_key]!=''?1:0;
                    $start_time=$post['start_time'][$day_key]?get_full_time($post['start_time'][$day_key]):'';
                    $end_time=$post['end_time'][$day_key]?get_full_time($post['end_time'][$day_key]):'';

                    $this->master->save('tutor_timings',array('mem_id'=>$mem_id,'day'=>$day,'start_time'=>$start_time,'end_time'=>$end_time,'available'=>$available));
                }

                $mem_data=array('name'=>$this->data['row']->mem_fname.' '.$this->data['row']->mem_lname,"email"=>$this->data['row']->mem_email);

                if ($vals['mem_tutor_verified']==1) {
                send_site_email($mem_data,'approved_tutor');
                setMsg('success', 'Tutor Application has been Accepted successfully!');
                }elseif ($vals['mem_tutor_verified']==2) {
                    send_site_email($mem_data,'declined_tutor');
                    setMsg('success', 'Tutor Application has been declined successfully.');
                }else{
                    setMsg('error', 'Please select application status!');
                }

                redirect(ADMIN . '/tutor-applications', 'refresh');
                exit;
            }
            $this->data['enable_editor'] = TRUE;
            $this->data['tutor_main_subject']=$this->master->getRow('tutor_subjects',array('mem_id'=>$this->uri->segment('4'),'type'=>'main'));
            $this->data['tutor_timings']=$this->master->getRows('tutor_timings',array('mem_id'=>$this->uri->segment('4')));
            $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
        }
        else
            show_404();
    }

    function declince($id=0) {
        $mem_id = intval($id);
        if($mem_row=$this->member_model->getMember($mem_id,array('mem_type'=>'tutor','mem_tutor_application'=>1,'mem_tutor_verified'=>0))){

            $this->member_model->save(array('mem_tutor_verified'=>2), $mem_id);

            $mem_data=array('name'=>$mem_row->mem_fname.' '.$mem_row->mem_lname,"email"=>$mem_row->mem_email);
            send_site_email($mem_data,'declined_tutor');

            setMsg('success', 'Tutor Application has been declined successfully.');
            redirect(ADMIN . '/tutor-applications/view/'.$mem_id, 'refresh');
            // redirect(ADMIN . '/tutor-applications', 'refresh');
            exit;
        }
        else
            show_404();
    }
}
?>