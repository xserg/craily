<?php

class Promocodes extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->isLogged();
        $this->load->model('promocode_model');
    }

    public function index() {
        $this->data['enable_datatable'] = TRUE;
        $this->data['pageView'] = ADMIN . '/promocodes';
        
        $this->data['rows'] = $this->promocode_model->get_rows(array(),'','','desc');
        $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
    }
    function generate_new() {

        $this->data['enable_datatable'] = TRUE;
        $this->data['pageView'] = ADMIN . '/promocodes';
        
        if ($this->input->post()) {
            $post = $this->input->post();
            $generate_mode = $post['generate-mode'];
            $save_data['code_type']=$post['code_type'];
            $save_data['code_value']=$post['code_value'];
            $save_data['date']=date('Y-m-d H:i:s');
            $save_data['status']=0;
            $expire_date = $post['expire_date']; 
            $save_data['expire_date']=date('Y-m-d H:i:s',strtotime($expire_date));
            if($generate_mode == "auto") {
                for($i=1;$i<=$post['codes'];$i++){
                    $save_data['code']=randCode();
                    while(true){
                        if(!$this->promocode_model->get_row_where(array('code'=>$save_data['code']))){
                            break;
                        }
                        $save_data['code']=randCode();
                    }
                    $this->promocode_model->save($save_data);
                }
            }
            else if($generate_mode == "manual"){
                $save_data['code']=$post['promo_code'];
                $this->promocode_model->save($save_data);
            }
            setMsg('success', 'Promo Code has been saved successfully.');
            return redirect(ADMIN . '/promocodes');
        }

        $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
    }

    function delete($id=0) {
        $id=intval($id);
        if($this->promocode_model->get_row_where(array('id'=>$id,'status<>'=>0)))
        {
            setMsg('error',"This is Promo Code is used, It can't be deleted!");
        }else{
            $this->promocode_model->delete($id);
            setMsg('success',"Promo Code has been deleted successfully!");
        }
        redirect(ADMIN . '/promocodes', 'refresh');
        exit;
    }
}

?>