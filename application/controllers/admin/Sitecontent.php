<?php

class Sitecontent extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->isLogged();
        has_access(8);
        $this->table_name='sitecontent';
    }

    public function home() {
        $this->data['enable_editor'] = TRUE;
        $this->data['pageView'] = ADMIN . '/site_home';
        if ($vals = $this->input->post()) {
            $content_row = $this->master->getRow($this->table_name, array('type'=>'home'));
            $content_row = unserialize($content_row->code);

            if(!is_array($content_row))
                $content_row=array();

            if (isset($_FILES["banner_video"]["name"]) && $_FILES["banner_video"]["name"] != "") {
                if(isset($content_row['banner_video']))
                    $this->remove_file(UPLOAD_PATH."videos/".$content_row['banner_video']);
                $image = upload_file(UPLOAD_PATH.'videos/', 'banner_video','video');
                $vals['banner_video'] = $image['file_name'];
            }

            for($i=1;$i<=3;$i++){
                if (isset($_FILES["first_ico_image".$i]["name"]) && $_FILES["first_ico_image".$i]["name"] != "") {
                    if(isset($content_row['first_ico_image'.$i]))
                        $this->remove_file(UPLOAD_PATH."images/".$content_row['first_ico_image'.$i]);
                    $image = upload_file(UPLOAD_PATH.'images/', 'first_ico_image'.$i);
                    $vals['first_ico_image'.$i] = $image['file_name'];
                }
            }

            for($i=1;$i<=4;$i++){
                if (isset($_FILES["second_ico_image".$i]["name"]) && $_FILES["second_ico_image".$i]["name"] != "") {
                    if(isset($content_row['second_ico_image'.$i]))
                        $this->remove_file(UPLOAD_PATH."images/".$content_row['second_ico_image'.$i]);
                    $image = upload_file(UPLOAD_PATH.'images/', 'second_ico_image'.$i);
                    $vals['second_ico_image'.$i] = $image['file_name'];
                }
            }

            if (isset($_FILES["third_section_image"]["name"]) && $_FILES["third_section_image"]["name"] != "") {
                if(isset($content_row['third_section_image']))
                    $this->remove_file(UPLOAD_PATH."images/".$content_row['third_section_image']);
                $image = upload_file(UPLOAD_PATH.'images/', 'third_section_image');
                $vals['third_section_image'] = $image['file_name'];
            }

            for($i=1;$i<=2;$i++){
                if (isset($_FILES["last_section_image".$i]["name"]) && $_FILES["last_section_image".$i]["name"] != "") {
                    if(isset($content_row['last_section_image'.$i]))
                        $this->remove_file(UPLOAD_PATH."images/".$content_row['last_section_image'.$i]);
                    $image = upload_file(UPLOAD_PATH.'images/', 'last_section_image'.$i);
                    $vals['last_section_image'.$i] = $image['file_name'];
                }
            }

            

            $data = serialize(array_merge($content_row,$vals));
            //$data = serialize($vals);
            $this->master->save($this->table_name,array('code'=>$data),'type','home');
            setMsg('success', 'Settings updated successfully !');
            redirect(ADMIN . "/sitecontent/home");
        }

        $this->data['row'] = $this->master->getRow($this->table_name, array('type' => 'home'));
        $this->data['row'] =unserialize($this->data['row']->code);
        // pr($this->data['row']);
        $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
    }

    public function login() {
        $this->data['enable_editor'] = TRUE;
        $this->data['pageView'] = ADMIN . '/site_login';
        if ($vals = $this->input->post()) {
            $content_row = $this->master->getRow($this->table_name, array('type'=>'login'));
            $content_row = unserialize($content_row->code);

            if(!is_array($content_row))
                $content_row=array();
            if (isset($_FILES["login_image"]["name"]) && $_FILES["login_image"]["name"] != "") {
                if(isset($content_row['login_image']))
                    $this->remove_file(UPLOAD_PATH."images/".$content_row['login_image']);
                $image1 = upload_file(UPLOAD_PATH.'images/', 'login_image');
                $vals['login_image'] = $image1['file_name'];
            }

            $data = serialize(array_merge($content_row,$vals));
            $this->master->save($this->table_name,array('code'=>$data),'type','login');
            setMsg('success', 'Settings updated successfully !');
            redirect(ADMIN . "/sitecontent/login");
            exit;
        }

        $this->data['row'] = $this->master->getRow($this->table_name, array('type' => 'login'));
        $this->data['row'] =unserialize($this->data['row']->code);
        $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
    }

    public function tutor_signup() {
        $this->data['enable_editor'] = TRUE;
        $this->data['pageView'] = ADMIN . '/site_tutor_signup';
        if ($vals = $this->input->post()) {
            $content_row = $this->master->getRow($this->table_name, array('type'=>'tutor_signup'));
            $content_row = unserialize($content_row->code);

            if(!is_array($content_row))
                $content_row=array();
            if (isset($_FILES["page_image"]["name"]) && $_FILES["page_image"]["name"] != "") {
                if(isset($content_row['page_image']))
                    $this->remove_file(UPLOAD_PATH."images/".$content_row['page_image']);
                $image = upload_file(UPLOAD_PATH.'images/', 'page_image');
                $vals['page_image'] = $image['file_name'];
            }

            $data = serialize(array_merge($content_row,$vals));
            $this->master->save($this->table_name,array('code'=>$data),'type','tutor_signup');
            setMsg('success', 'Settings updated successfully !');
            redirect(ADMIN . "/sitecontent/tutor-signup");
            exit;
        }

        $this->data['row'] = $this->master->getRow($this->table_name, array('type' => 'tutor_signup'));
        $this->data['row'] =unserialize($this->data['row']->code);
        $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
    }

    public function signup() {
        $this->data['enable_editor'] = TRUE;
        $this->data['pageView'] = ADMIN . '/site_signup';
        if ($vals = $this->input->post()) {
            $content_row = $this->master->getRow($this->table_name, array('type'=>'signup'));
            $content_row = unserialize($content_row->code);

            if(!is_array($content_row))
                $content_row=array();
            if (isset($_FILES["register_image"]["name"]) && $_FILES["register_image"]["name"] != "") {
                if(isset($content_row['register_image']))
                    $this->remove_file(UPLOAD_PATH."images/".$content_row['register_image']);
                $image1 = upload_file(UPLOAD_PATH.'images/', 'register_image');
                $vals['register_image'] = $image1['file_name'];
            }
            $data = serialize(array_merge($content_row,$vals));
            $this->master->save($this->table_name,array('code'=>$data),'type','signup');
            setMsg('success', 'Settings updated successfully !');
            redirect(ADMIN . "/sitecontent/signup");
        }

        $this->data['row'] = $this->master->getRow($this->table_name, array('type' => 'signup'));
        $this->data['row'] =unserialize($this->data['row']->code);
        $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
    }

    public function forgot() {
        $this->data['enable_editor'] = TRUE;
        $this->data['pageView'] = ADMIN . '/site_forgot';
        if ($vals = $this->input->post()) {
            $content_row = $this->master->getRow($this->table_name, array('type'=>'forgot'));
            $content_row = unserialize($content_row->code);

            if(!is_array($content_row))
                $content_row=array();
            if (isset($_FILES["forgot_image"]["name"]) && $_FILES["forgot_image"]["name"] != "") {
                if(isset($content_row['forgot_image']))
                    $this->remove_file(UPLOAD_PATH."images/".$content_row['forgot_image']);
                $image1 = upload_file(UPLOAD_PATH.'images/', 'forgot_image');
                $vals['forgot_image'] = $image1['file_name'];
            }
            $data = serialize(array_merge($content_row,$vals));
            $this->master->save($this->table_name,array('code'=>$data),'type','forgot');
            setMsg('success', 'Settings updated successfully !');
            redirect(ADMIN . "/sitecontent/forgot");
        }

        $this->data['row'] = $this->master->getRow($this->table_name, array('type' => 'forgot'));
        $this->data['row'] =unserialize($this->data['row']->code);
        $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
    }

    public function reset() {
        $this->data['enable_editor'] = TRUE;
        $this->data['pageView'] = ADMIN . '/site_reset';
        if ($vals = $this->input->post()) {
            $content_row = $this->master->getRow($this->table_name, array('type'=>'reset'));
            $content_row = unserialize($content_row->code);

            if(!is_array($content_row))
                $content_row=array();
            if (isset($_FILES["reset_image"]["name"]) && $_FILES["reset_image"]["name"] != "") {
                if(isset($content_row['reset_image']))
                    $this->remove_file(UPLOAD_PATH."images/".$content_row['reset_image']);
                $image1 = upload_file(UPLOAD_PATH.'images/', 'reset_image');
                $vals['reset_image'] = $image1['file_name'];
            }
            $data = serialize(array_merge($content_row,$vals));
            $this->master->save($this->table_name,array('code'=>$data),'type','reset');
            setMsg('success', 'Settings updated successfully !');
            redirect(ADMIN . "/sitecontent/reset");
        }

        $this->data['row'] = $this->master->getRow($this->table_name, array('type' => 'reset'));
        $this->data['row'] =unserialize($this->data['row']->code);
        $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
    }

    public function creators() {
        $this->data['enable_editor'] = TRUE;
        $this->data['pageView'] = ADMIN . '/site_creators';
        if ($vals = $this->input->post()) {
            $content_row = $this->master->getRow($this->table_name, array('type'=>'creators'));
            $content_row = unserialize($content_row->code);

            if(!is_array($content_row))
                $content_row=array();
            if (isset($_FILES["creators_image"]["name"]) && $_FILES["creators_image"]["name"] != "") {
                if(isset($content_row['creators_image']))
                    $this->remove_file(UPLOAD_PATH."images/".$content_row['creators_image']);
                $image1 = upload_file(UPLOAD_PATH.'images/', 'creators_image');
                $vals['creators_image'] = $image1['file_name'];
            }
            $data = serialize(array_merge($content_row,$vals));
            $this->master->save($this->table_name,array('code'=>$data),'type','creators');
            setMsg('success', 'Settings updated successfully !');
            redirect(ADMIN . "/sitecontent/creators");
        }

        $this->data['row'] = $this->master->getRow($this->table_name, array('type' => 'creators'));
        $this->data['row'] =unserialize($this->data['row']->code);
        $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
    }

    public function about() {
        $this->data['enable_editor'] = TRUE;
        $this->data['pageView'] = ADMIN . '/site_about';
        if ($vals = $this->input->post()) {
            $content_row = $this->master->getRow($this->table_name, array('type'=>'about'));
            $content_row = unserialize($content_row->code);
            if(!is_array($content_row))
                $content_row=array();
            if (isset($_FILES["about_image"]["name"]) && $_FILES["about_image"]["name"] != "") {
                if(isset($content_row['about_image']))
                    $this->remove_file(UPLOAD_PATH."images/".$content_row['about_image']);
                $image1 = upload_file(UPLOAD_PATH.'images/', 'about_image');
                $vals['about_image'] = $image1['file_name'];
            }
            $data = serialize(array_merge($content_row,$vals));
            $this->master->save($this->table_name,array('code'=>$data),'type','about');
            setMsg('success', 'Settings updated successfully !');
            redirect(ADMIN . "/sitecontent/about");
        }

        $this->data['row'] = $this->master->getRow($this->table_name, array('type' => 'about'));
        $this->data['row'] =unserialize($this->data['row']->code);
        $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
    }

    public function email_verify() {
        $this->data['enable_editor'] = TRUE;
        $this->data['pageView'] = ADMIN . '/site_email_verify';
        if ($vals = $this->input->post()) {
            $content_row = $this->master->getRow($this->table_name, array('type'=>'email_verify'));
            $content_row = unserialize($content_row->code);
            if(!is_array($content_row))
                $content_row=array();
            $data = serialize(array_merge($content_row,$vals));
            $this->master->save($this->table_name,array('code'=>$data),'type','email_verify');
            setMsg('success', 'Settings updated successfully !');
            redirect(ADMIN . "/sitecontent/email_verify");
        }

        $this->data['row'] = $this->master->getRow($this->table_name, array('type' => 'email_verify'));
        $this->data['row'] =unserialize($this->data['row']->code);
        $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
    }

    public function phone_verify() {
        $this->data['enable_editor'] = TRUE;
        $this->data['pageView'] = ADMIN . '/site_phone_verify';
        if ($vals = $this->input->post()) {
            $content_row = $this->master->getRow($this->table_name, array('type'=>'phone_verify'));
            $content_row = unserialize($content_row->code);
            if(!is_array($content_row))
                $content_row=array();
            $data = serialize(array_merge($content_row,$vals));
            $this->master->save($this->table_name,array('code'=>$data),'type','phone_verify');
            setMsg('success', 'Settings updated successfully !');
            redirect(ADMIN . "/sitecontent/phone_verify");
        }

        $this->data['row'] = $this->master->getRow($this->table_name, array('type' => 'phone_verify'));
        $this->data['row'] =unserialize($this->data['row']->code);
        $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
    }

    function contact() {
        $this->data['enable_editor'] = TRUE;
        $this->data['pageView'] = ADMIN . '/site_contact';
        if ($vals = $this->input->post()) {
            $content_row = $this->master->getRow($this->table_name, array('type'=>'contact'));
            $content_row = unserialize($content_row->code);
            if(!is_array($content_row))
                $content_row=array();
            $data = serialize(array_merge($content_row,$vals));
            $this->master->save($this->table_name,array('code'=>$data),'type','contact');
            setMsg('success', 'Settings updated successfully !');
            redirect(ADMIN . "/sitecontent/contact");
            exit;
        }

        $this->data['row'] = $this->master->getRow($this->table_name, array('type' => 'contact'));
        $this->data['row'] =unserialize($this->data['row']->code);
        $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
    }



    public function search() {
        $this->data['enable_editor'] = TRUE;
        $this->data['pageView'] = ADMIN . '/site_search';
        if ($vals = $this->input->post()) {
            $content_row = $this->master->getRow($this->table_name, array('type'=>'search'));
            $content_row = unserialize($content_row->code);
            if(!is_array($content_row))
                $content_row=array();
            $data = serialize(array_merge($content_row,$vals));
            $this->master->save($this->table_name,array('code'=>$data),'type','search');
            setMsg('success', 'Settings updated successfully !');
            redirect(ADMIN . "/sitecontent/search");
        }

        $this->data['row'] = $this->master->getRow($this->table_name, array('type' => 'search'));
        $this->data['row'] =unserialize($this->data['row']->code);
        $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
    }


    public function buygems() {
        $this->data['enable_editor'] = TRUE;
        $this->data['pageView'] = ADMIN . '/site_buygems';
        if ($vals = $this->input->post()) {
            $content_row = $this->master->getRow($this->table_name, array('type'=>'buygems'));
            $content_row = unserialize($content_row->code);
            if(!is_array($content_row))
                $content_row=array();
            $data = serialize(array_merge($content_row,$vals));
            $this->master->save($this->table_name,array('code'=>$data),'type','buygems');
            setMsg('success', 'Settings updated successfully !');
            redirect(ADMIN . "/sitecontent/buygems");
            exit;
        }

        $this->data['row'] = $this->master->getRow($this->table_name, array('type' => 'buygems'));
        $this->data['row'] =unserialize($this->data['row']->code);
        $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
    }


    public function delete() {
        $arr = $this->input->post('delete');
        foreach ($arr as $key => $values) {
            $this->master->delete($this->table_name,'id', $values);
        }
        redirect("admin/sitecontent/slider", 'refresh');
    }

    function remove_file($filepath) {
        if (is_file($filepath)) {
            unlink($filepath);
        }
        return;
    }

}
?>