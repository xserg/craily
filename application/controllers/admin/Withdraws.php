<?php

class Withdraws extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->isLogged();
        $this->load->model('transaction_model');
        $this->load->model('payment_methods_model');
    }

    public function index() {
        $this->data['enable_datatable'] = TRUE;
        $this->data['pageView'] = ADMIN . '/withdraw-requests';
        $this->data['rows'] = $this->transaction_model->get_withdraws('','','desc');
        $this->load->view(ADMIN.'/includes/siteMaster', $this->data);
    }

    public function requests() {
        $this->data['enable_datatable'] = TRUE;
        $this->data['pageView'] = ADMIN . '/withdraw-requests';
        $this->data['rows'] = $this->transaction_model->get_withdraw_request('','','desc');
        $this->load->view(ADMIN.'/includes/siteMaster', $this->data);
    }
    function detail($id=0) {
        $id=intval($id);
        if($this->data['row'] = $this->transaction_model->get_withdraw($id)){
            $this->data['pageView'] = ADMIN.'/withdraw-requests';
            $this->data['member']=$this->master->getRow('members',array('mem_id'=>$this->data['row']->mem_id));
            if($this->data['row']->status==0){
                $this->data['banks']=$this->payment_methods_model->get_methods($this->data['row']->mem_id);
            }else{
                $this->data['bank_row']=$this->payment_methods_model->get_mem_method($this->data['row']->payment_method_id,$this->data['row']->mem_id);

            }
            $this->load->view(ADMIN.'/includes/siteMaster', $this->data);
        }
        else
            show_404();
    }
    function mark_paid($id=0) {
        $id=intval($id);
        if($row=$this->transaction_model->get_withdraw($id,array('status'=>0))){
            $save_data=array('status'=>1,'paid_date'=>date('Y-m-d h:i:s'));
                $bank=intval($this->input->post('bank'));

                if ($bank<1 || !$this->payment_methods_model->get_mem_method($bank,$row->mem_id)) {
                    setMsg('error', 'Bank not belongs to that tutor!');
                    redirect(ADMIN . '/withdraws/detail/'.$id, 'refresh');
                    exit;
                }

                $save_data['payment_method_id']=$bank;


            $this->transaction_model->save_withdraw($save_data,$id);

            setMsg('success', 'Withdraw request has been completed successfully.');
            redirect(ADMIN . '/withdraws/detail/'.$id, 'refresh');
            exit;
        }
        else
            show_404();
    }
}

?>