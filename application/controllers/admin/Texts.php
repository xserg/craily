<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Texts extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->isLogged();
        $this->load->model('Admin', 'admin');
        $this->load->model('Text_model', 'text');
    }

    function index() {
        $this->data['pageView'] = ADMIN . "/site_texts";
        $this->data['enable_editor'] = TRUE;

        if ($post = $this->input->post()) {
            if ($post['addnewForm'] == 'posted') {
                $vals = array(
                    'txt_type' => $post['txt_type'],
                    'txt_label' => $post['txt_label'],
                    'txt_key' => $post['txt_key'],
                    'txt_value' => $post['txt_value'],
                    'txt_subject' => $post['txt_subject']
                );
                $this->text->save($vals);
            } else {
                if (count($post['txt_value']) > 0):
                    foreach ($post['txt_value'] as $key => $val):
                        $this->text->save(array('txt_value' => $val,'txt_subject'=>$post['txt_subject'][$key] ), $key);
                    endforeach;
                endif;
                setMsg('success', 'Text has been saved successfully.');
            }
        }
        $this->data['email_texts'] = $this->text->getTexts('email',"txt_key not in('signup','verify_email','change_email')");
        $this->data['alert_texts'] = $this->text->getTexts('alert');

        $this->load->view(ADMIN . "/includes/siteMaster", $this->data);
    }

}

?>