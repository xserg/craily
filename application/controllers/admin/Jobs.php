<?php
class Jobs extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->isLogged();
        $this->load->model('job_model');
    }

    function index() {
        $this->data['enable_datatable'] = TRUE;
        $this->data['pageView'] = ADMIN . '/jobs';
        $this->data['rows'] = $this->job_model->get_admin_jobs();
        $this->load->view(ADMIN.'/includes/siteMaster', $this->data);
    }

    function manage($id=0) {
        $id=intval($id);
        if ($this->data['row'] = $this->job_model->get_admin_job($id)) {
            $this->data['pageView'] = ADMIN . '/jobs';
            if ($this->input->post()) {
                $vals = $this->input->post();

                $id=$this->job_model->save($vals, $id);
                setMsg('success', 'Job has been saved successfully.');
                redirect(ADMIN . '/jobs', 'refresh');
                exit;
            }

            $this->data['grade_levels']=$this->master->getRows('job_grade_levels');
            $this->load->view(ADMIN.'/includes/siteMaster', $this->data);
        }
        else
            show_404();
    }

    function delete($id=0) {
        $id=intval($id);
        if($this->job_model->get_row_where(array('id'=>$id))){
            $this->job_model->delete($id);
            setMsg('success', 'Job has been deleted successfully.');
            redirect(ADMIN . '/jobs', 'refresh');
            exit;
        }
        else
            show_404();
    }

    
}
?>