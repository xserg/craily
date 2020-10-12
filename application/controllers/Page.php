<?php
class Page extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    function terms_services() {
        $this->load->view('pages/terms-services', $this->data);
    }

    function privacy_policy() {
        $this->load->view('pages/privacy-policy', $this->data);
    }

    function contact() {
        $this->data['contactContent'] = $this->master->getRow('sitecontent', array('type' => 'contact'));
        $this->data['contactContent'] =unserialize($this->data['contactContent']->code);
        $this->load->view('pages/contact', $this->data);
    }
    
    function about() {
        $this->data['founders'] = $this->master->getRows('founders');
        $this->data['aboutContent'] = $this->master->getRow('sitecontent', array('type' => 'about'));
        $this->data['aboutContent'] =unserialize($this->data['aboutContent']->code);
        $this->load->view('pages/about', $this->data);
    }
    function help() {
        $this->data['faqs'] = $this->master->getRows('faqs');
        $this->data['page_title']="Help";
        $this->load->view('pages/faq', $this->data);
    }

    function faq() {
        $this->data['faqs'] = $this->master->getRows('faqs');
        $this->data['page_title']="Faq's";
        $this->load->view('pages/faq', $this->data);
    }
    function error(){
        $this->load->view("pages/404", $this->data);   
    }
}
?>