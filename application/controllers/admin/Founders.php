<?php

class Founders extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->isLogged();
        has_access(6);
        $this->load->model('founder_model');
    }

    public function index() {
        $this->data['enable_datatable'] = TRUE;
        $this->data['pageView'] = ADMIN . '/founders';
        
        $this->data['rows'] = $this->founder_model->get_rows();
        $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
    }

    function manage() {
        $this->data['pageView'] = ADMIN . '/founders';
        if ($this->input->post()) {
            $vals = $this->input->post();

            if (($_FILES["image"]["name"] != "")) {
                $this->remove_file($this->uri->segment(4), 'image');
                $image = upload_file(UPLOAD_PATH . "founders/", 'image');
                if (!empty($image['file_name'])) {
                    $vals['image'] = $image['file_name'];
                    generate_thumb(UPLOAD_PATH . "founders/", UPLOAD_PATH . "founders/", $image['file_name'],116);
                } else {
                    setMsg('errorMsg', 'Please upload a valid image file >> ' . strip_tags($image['error']));
                    redirect(ADMIN . '/founders/manage/' . $this->uri->segment(4), 'refresh');
                }
            }

            $this->founder_model->save($vals, $this->uri->segment(4));
            setMsg('success', 'Founder has been saved successfully.');
            redirect(ADMIN . '/founders', 'refresh');
        }

        $this->data['row'] = $this->founder_model->get_row($this->uri->segment('4'));
        $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
    }

    function delete() {
        has_access(10);
        $this->remove_file($this->uri->segment(4));
        $this->founder_model->delete($this->uri->segment('4'));
        setMsg('success', 'Founder has been deleted successfully.');
        redirect(ADMIN . '/founders', 'refresh');
    }

    function remove_file($id, $type = '') {
        $arr = $this->founder_model->get_row($id);

        $filepath = UPLOAD_PATH . "/founders/" . $arr->image;
        $filepath_thumb = UPLOAD_PATH . "/founders/thumb_" . $arr->image;
        if (is_file($filepath)) {
            unlink($filepath);
        }
        if (is_file($filepath_thumb)) {
            unlink($filepath_thumb);
        }
        return;
    }

}

?>