<?php

class Transactions extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->isLogged();
        $this->load->model('transaction_model');
    }

    public function index() {
        $this->data['enable_datatable'] = TRUE;
        $this->data['pageView'] = ADMIN . '/transactions';

        $this->data['rows'] = $this->transaction_model->get_rows(array(),'','','desc');
        $this->load->view(ADMIN.'/includes/siteMaster', $this->data);
    }

    function detail($id=0) {
        $id=intval($id);
        if($this->data['row'] = $this->transaction_model->get_transaction($id)){
            $this->data['pageView'] = ADMIN.'/transactions';
            $this->data['member']=$this->master->getRow('members',array('mem_id'=>$this->data['row']->tutor_id));
            $this->load->view(ADMIN.'/includes/siteMaster', $this->data);
        }
        else
            show_404();
    }

}

?>