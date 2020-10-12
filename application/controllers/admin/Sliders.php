<?php

class Sliders extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->isLogged();
    }

    public function main() {
        $this->data['enable_datatable'] = TRUE;
        $this->data['pageView'] = ADMIN . '/slider-main';
        
        $this->data['rows'] = $this->master->getRows('sitebanner',array('type'=>'main'));
        $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
    }
    public function second() {
        $this->data['enable_datatable'] = TRUE;
        $this->data['pageView'] = ADMIN . '/slider-second';
        
        $this->data['rows'] = $this->master->getRows('sitebanner',array('type'=>'second'));
        $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
    }

    function main_manage() {
        $this->data['pageView'] = ADMIN . '/slider-main';
        if ($_FILES["image"]["name"] != "") {
            $vals['type']='main';

            $this->remove_file($this->uri->segment(4), 'image');
            $image = upload_file(UPLOAD_PATH . "sliders/", 'image');
            if (!empty($image['file_name'])) {
                $vals['image'] = $image['file_name'];
                generate_thumb(UPLOAD_PATH . "sliders/", UPLOAD_PATH . "sliders/", $image['file_name'],300);
            } else {
                setMsg('errorMsg', 'Please upload a valid image file >> ' . strip_tags($image['error']));
                redirect(ADMIN . '/sliders/main-manage/' . $this->uri->segment(4), 'refresh');
            }

            $this->master->save('sitebanner',$vals, $this->uri->segment(4));
            setMsg('success', 'Main Slider has been saved successfully.');
            redirect(ADMIN . '/sliders/main', 'refresh');
        }
        $this->data['row'] = $this->master->getRow('sitebanner',array('id'=>$this->uri->segment('4')));
        $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
    }

    function second_manage() {
        $this->data['pageView'] = ADMIN . '/slider-second';
        if ($this->input->post() && $_FILES["image"]["name"]!='') {
            $vals = $this->input->post();
            $vals['type']='second';

            if ($_FILES["image"]["name"] != "") {
                $this->remove_file($this->uri->segment(4), 'image');
                $image = upload_file(UPLOAD_PATH . "sliders/", 'image');
                if (!empty($image['file_name'])) {
                    $vals['image'] = $image['file_name'];
                    generate_thumb(UPLOAD_PATH . "sliders/", UPLOAD_PATH . "sliders/", $image['file_name'],300);
                } else {
                    setMsg('errorMsg', 'Please upload a valid image file >> ' . strip_tags($image['error']));
                    redirect(ADMIN . '/sliders/second-manage/' . $this->uri->segment(4), 'refresh');
                }

            }
            $this->master->save('sitebanner',$vals, 'id',$this->uri->segment(4));
            setMsg('success', 'Second Slider has been saved successfully.');
            redirect(ADMIN . '/sliders/second', 'refresh');
            exit;
        }
        $this->data['row'] = $this->master->getRow('sitebanner',array('id'=>$this->uri->segment('4')));
        $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
    }

    function main_delete() {
        $id=intval($this->uri->segment('4'));
        $this->remove_file($id);
        $this->master->delete('sitebanner','id',$id);
        setMsg('success', 'Main Slide has been deleted successfully.');
        redirect(ADMIN . '/sliders/main', 'refresh');
        exit;
    }

    function second_delete() {
        $id=intval($this->uri->segment('4'));
        $this->remove_file($id);
        $this->master->delete('sitebanner','id',$id);
        setMsg('success', 'Second Slide has been deleted successfully.');
        redirect(ADMIN . '/sliders/second', 'refresh');
        exit;
    }

    function remove_file($id) {
        $arr = $this->master->getRow('sitebanner',array('id'=>$id));

        $filepath = UPLOAD_PATH . "/sliders/" . $arr->image;
        $filepath_thumb = UPLOAD_PATH . "/sliders/thumb_" . $arr->image;
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