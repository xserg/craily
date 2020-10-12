<?php

class Dashboard extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->isLogged();
    }
    
    public function index() {
        $this->data['pageView'] = ADMIN."/dashboard";
        $this->data['dashboard'] = "1";
        $this->data['total_students']=intval($this->master->num_rows('members',array('mem_type'=>'student')));
        $this->data['total_tutors']=intval($this->master->num_rows('members',array('mem_type'=>'tutor')));

        $this->data['total_subjects']=intval($this->master->num_rows('subjects',array('parent_id'=>'0')));
        $this->load->view(ADMIN.'/includes/siteMaster', $this->data);
    }
    
}

?>  