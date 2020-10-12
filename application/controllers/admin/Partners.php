<?php

class Partners extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->isLogged();
        $this->load->model('partner_model');
    }

    public function index() {
        $this->data['enable_datatable'] = TRUE;
        $this->data['pageView'] = ADMIN . '/partners';
        
        $this->data['rows'] = $this->partner_model->get_rows();
        $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
    }

    function manage() {
        $this->data['pageView'] = ADMIN . '/partners';
        $this->data['row'] = $this->partner_model->get_row($this->uri->segment('4'));
        if ($this->input->post()) {
            $vals = $this->input->post();

            if (($_FILES["image"]["name"] == "" && !$this->data['row'])) {
                setMsg('error', 'Please select partner image.');
                redirect(ADMIN . '/partners/manage', 'refresh');
                exit;
            }

            if (($_FILES["image"]["name"] != "")) {
                $this->remove_file($this->uri->segment(4), 'image');
                $image = upload_file(UPLOAD_PATH . "partners/", 'image');
                if (!empty($image['file_name'])) {
                    $vals['image'] = $image['file_name'];
                } else {
                    setMsg('errorMsg', 'Please upload a valid image file >> ' . strip_tags($image['error']));
                    redirect(ADMIN . '/partners/manage/' . $this->uri->segment(4), 'refresh');
                    exit;
                }
            }

            $this->partner_model->save($vals, $this->uri->segment(4));

            setMsg('success', 'Partner has been saved successfully.');
            redirect(ADMIN . '/partners', 'refresh');
            exit;
        }
        $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
    }

    function delete() {
        $this->remove_file($this->uri->segment(4));
        $this->partner_model->delete($this->uri->segment('4'));
        setMsg('success', 'Partner has been deleted successfully.');
        redirect(ADMIN . '/partners', 'refresh');
        exit;
    }

    function active($id=0) {
        $id = intval($id);
        $vals['status'] = '1';
        $this->partner_model->save($vals, $id);
        setMsg('success', 'Partner has been activated successfully.');
        redirect(ADMIN . '/partners', 'refresh');
    }

    function inactive($id=0) {
        $id = intval($id);
        $vals['status'] = '0';
        $this->partner_model->save($vals, $id);
        setMsg('success', 'Partner has been deactivated successfully.');
        redirect(ADMIN . '/partners', 'refresh');
    }

    function remove_file($id) {
        $arr = $this->partner_model->get_row($id);

        $filepath = UPLOAD_PATH . "/partners/" . $arr->image;
        if (is_file($filepath)) {
            unlink($filepath);
        }
        return;
    }

}

?>