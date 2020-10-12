<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->isLogged();
        $this->load->model('Admin', 'admin');
    }
    function index() {
        has_access();
        $this->data['pageView'] = ADMIN . "/site_setting";
        $this->load->view(ADMIN . "/includes/siteMaster", $this->data);
    }
    function save() {
        has_access();
        if ($vals = $this->input->post()) {
            $this->admin->saveSettings($vals);
            setMsg("success", "Successfully Changed.....");
            redirect(ADMIN . "/settings");
        }
    }
    function clear_cashe(){
        has_access();
        $this->admin->saveSettings(array('site_version'=>rand(1,100)));
        setMsg("success", "Successfully Cashe Cleared!");
        redirect(ADMIN . "/settings");
    }
    function change() {
        $this->data['adminsite_setting']->page_title='Change Password';
        $this->load->view(ADMIN . '/admin_change', $this->data);
    }
    function pass() {
        if ($data = $this->input->post()) {
            $row = $this->admin->authenticate($this->session->loged_in['name'], $data['opwd']);
            if ($row) {
                $this->admin->save(array('site_password' => md5($data['npwd'])),$this->session->loged_in['id']);
                // $this->admin->saveSettings(array('site_password' => md5($data['npwd'])));
                $res['login_status'] = "success";
                $res['redirect_url'] = (base_url(ADMIN . '/dashboard'));
            } else {
                $res['login_status'] = "invalid";
                $res['invalid_respnse'] = "Old Password Does not Match";
            }
            echo json_encode($res);
        }
    }

}

?>