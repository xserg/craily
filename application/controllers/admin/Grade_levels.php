<?php
class Grade_levels extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->isLogged();
        $this->load->model('grade_level_model');
    }

    function index() {
        $this->data['enable_datatable'] = TRUE;
        $this->data['pageView'] = ADMIN . '/grade-levels';
        $this->data['rows'] = $this->grade_level_model->get_rows();
        $this->load->view(ADMIN.'/includes/siteMaster', $this->data);
    }

    function manage() {
        $this->data['pageView'] = ADMIN . '/grade-levels';
        if ($this->input->post()) {
            $vals = $this->input->post();

            $vals['slug'] = toSlugUrl($vals['name']);
            $id=$this->grade_level_model->save($vals, $this->uri->segment(4));
            setMsg('success', 'Grade Level has been saved successfully!');
            redirect(ADMIN . '/grade-levels', 'refresh');
            exit;
        }
        $this->data['row'] = $this->grade_level_model->get_row($this->uri->segment('4'));
        $this->load->view(ADMIN.'/includes/siteMaster', $this->data);
    }

    function delete($id=0) {
        $id=intval($id);
        if($row=$this->grade_level_model->get_row_where(array('id'=>$id))){
            $this->load->model('job_model');
            if($this->job_model->get_row_where(array('grade_level'=>$row->name))){
                setMsg('error', 'This Grade Level has related jobs, it can\'t be deleted!');
                redirect(ADMIN . '/grade-levels', 'refresh');
                exit;
            };
            $this->grade_level_model->delete($id);
            setMsg('success', 'Grade Level has been deleted successfully!');
            redirect(ADMIN . '/grade-levels', 'refresh');
            exit;
        }
        else
            show_404();
    }

    
}
?>