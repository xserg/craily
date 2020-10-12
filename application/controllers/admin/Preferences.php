<?php
class Preferences extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->isLogged();
        has_access(8);
    }

    public function index() {
    }

    public function footer_section() {
        $this->data['enable_editor'] = FALSE;
        $this->data['pageView'] = ADMIN . '/pref_footer_section';
        if ($vals = $this->input->post()) {
            $this->master->save('preferences', $vals, 'pref_key', 'footer_section');
            setMsg('success', 'Settings updated successfully !');
            redirect(ADMIN . "/preferences/" . $this->uri->segment('3'));
        }
        $this->data['row'] = $this->master->getRow('preferences', array('pref_key' => 'footer_section'));
        $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
    }

    public function bannerimage() {
        $this->data['enable_editor'] = FALSE;
        $this->data['pageView'] = ADMIN . '/pref_bannerimage';

        if (isset($_FILES["image"]["name"]) && $_FILES["image"]["name"] != "") {
            $row = $this->master->getRow('preferences', array('pref_key' => 'bannerimage'));
            $this->remove_file(UPLOAD_PATH."images/".$row->pref_image);
            $image = upload_file(UPLOAD_PATH.'images/', 'image','image','image');
            $vals['pref_image'] = $image['file_name'];
            $this->master->save('preferences', $vals, 'pref_key', 'bannerimage');
            setMsg('success', 'Settings updated successfully !');
            redirect(ADMIN . "/preferences/" . $this->uri->segment('3'));
        }
        $this->data['row'] = $this->master->getRow('preferences', array('pref_key' => 'bannerimage'));
        $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
    }

    /*public function register() {
        $this->data['enable_editor'] = FALSE;
        $this->data['pageView'] = ADMIN . '/pref_register';
        if ($vals = $this->input->post()) {
            if (isset($_FILES["image"]["name"]) && $_FILES["image"]["name"] != "") {
                $image = upload_image('./assets/site-content/images/', 'image');
                $vals['pref_image'] = $image['file_name'];
            }
            $this->master->save('preferences', $vals, 'pref_key', 'register');
            setMsg('success', 'Settings updated successfully !');
            redirect(ADMIN . "/preferences/" . $this->uri->segment('3'));
        }
        $this->data['row'] = $this->master->getRow('preferences', array('pref_key' => 'register'));
        $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
    }

    public function forgot() {
        $this->data['enable_editor'] = FALSE;
        $this->data['pageView'] = ADMIN . '/pref_forgot';
        if ($vals = $this->input->post()) {
            if (isset($_FILES["image"]["name"]) && $_FILES["image"]["name"] != "") {
                $image = upload_image('./assets/site-content/images/', 'image');
                $vals['pref_image'] = $image['file_name'];
            }
            $this->master->save('preferences', $vals, 'pref_key', 'forgot');
            setMsg('success', 'Settings updated successfully !');
            redirect(ADMIN . "/preferences/" . $this->uri->segment('3'));
        }
        $this->data['row'] = $this->master->getRow('preferences', array('pref_key' => 'forgot'));
        $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
    }

    public function reset() {
        $this->data['enable_editor'] = FALSE;
        $this->data['pageView'] = ADMIN . '/pref_reset';
        if ($vals = $this->input->post()) {
            if (isset($_FILES["image"]["name"]) && $_FILES["image"]["name"] != "") {
                $image = upload_image('./assets/site-content/images/', 'image');
                $vals['pref_image'] = $image['file_name'];
            }
            $this->master->save('preferences', $vals, 'pref_key', 'reset-pass');
            setMsg('success', 'Settings updated successfully !');
            redirect(ADMIN . "/preferences/" . $this->uri->segment('3'));
        }
        $this->data['row'] = $this->master->getRow('preferences', array('pref_key' => 'reset-pass'));
        $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
    }


    public function login() {
        $this->data['enable_editor'] = FALSE;
        $this->data['pageView'] = ADMIN . '/pref_login';
        if ($vals = $this->input->post()) {
            if (isset($_FILES["image"]["name"]) && $_FILES["image"]["name"] != "") {
                $image = upload_image('./assets/site-content/images/', 'image');
                $vals['pref_image'] = $image['file_name'];
            }
            $this->master->save('preferences', $vals, 'pref_key', 'login');
            setMsg('success', 'Settings updated successfully !');
            redirect(ADMIN . "/preferences/" . $this->uri->segment('3'));
        }
        $this->data['row'] = $this->master->getRow('preferences', array('pref_key' => 'login'));
        $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
    }*/


    public function termsservices() {
        $this->data['enable_editor'] = TRUE;
        $this->data['pageView'] = ADMIN . '/pref_termsservices';
        if ($vals = $this->input->post()) {
            $this->master->save('preferences', $vals, 'pref_key', 'termsservices');
            setMsg('success', 'Settings updated successfully !');
            redirect(ADMIN . "/preferences/" . $this->uri->segment('3'));
        }
        $this->data['row'] = $this->master->getRow('preferences', array('pref_key' => 'termsservices'));
        $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
    }

    public function privacypolicy() {
        $this->data['enable_editor'] = TRUE;
        $this->data['pageView'] = ADMIN . '/pref_privacypolicy';
        if ($vals = $this->input->post()) {
            $this->master->save('preferences', $vals, 'pref_key', 'privacypolicy');
            setMsg('success', 'Settings updated successfully !');
            redirect(ADMIN . "/preferences/" . $this->uri->segment('3'));
        }
        $this->data['row'] = $this->master->getRow('preferences', array('pref_key' => 'privacypolicy'));
        $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
    }
    
    public function shopping_cart() {
        $this->data['enable_editor'] = FALSE;
        $this->data['pageView'] = ADMIN . '/pref_cart';
        if ($vals = $this->input->post()) {
            $this->master->save('preferences', $vals, 'pref_key', 'cart');
            setMsg('success', 'Settings updated successfully !');
            redirect(ADMIN . "/preferences/" . $this->uri->segment('3'));
        }
        $this->data['row'] = $this->master->getRow('preferences', array('pref_key' => 'cart'));
        $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
    }


    function remove_file($filepath) {
        if (is_file($filepath)) {
            unlink($filepath);
        }
        return;
    }

}
?>