<?php

class Faq extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->isLogged();
        has_access(7);
    }

    public function index() {
        $this->data['enable_datatable'] = TRUE;
        $this->data['pageView'] = ADMIN . '/faqs';

        $this->data['rows'] = $this->master->getRows('faqs');
        $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
    }

    function manage() {
        $this->data['enable_editor'] = TRUE;
        $this->data['pageView'] = ADMIN . '/faqs';
        if ($this->input->post()) {
            $vals = $this->input->post();

            $this->master->save('faqs',$vals,'id', $this->uri->segment(4));
            setMsg('success', 'Question has been saved successfully.');
            redirect(ADMIN . '/faq/manage/' . $this->uri->segment(4), 'refresh');
        }

        $this->data['row'] = $this->master->getRow('faqs',array('id'=>$this->uri->segment('4')));
        $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
    }

    function delete() {
        has_access(10);
        $this->master->delete('faqs','id', $this->uri->segment(4));
        setMsg('success', 'Question has been deleted successfully.');
        redirect(ADMIN . '/faq', 'refresh');
    }

}

?>