<?php

class Chat extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->isLogged();
        has_access(5);
        $this->load->model('chat_model');
    }

    public function index() {
        $this->data['enable_datatable'] = TRUE;
        $this->data['pageView'] = ADMIN . '/chats';

        $this->data['rows'] = $this->chat_model->get_chats();
        $this->load->view(ADMIN.'/includes/siteMaster', $this->data);
    }

    public function ChatAjax($mem_id = null) {
        $this->data['enable_datatable'] = TRUE;

        $start = $this->input->post('start');
        $draw = $this->input->post('draw');
        $limit = $this->input->post('length');

        $this->data['rows'] = $this->chat_model->get_chats($start, $limit,$mem_id);
        $this->data['allCount'] = count($this->data['rows']);

        // if(empty($this->input->post('search')['value']))
        // {            
        //     $this->data['rows'] = $this->chat_model->get_chats($start, $limit);
        //     $this->data['allCount'] = $this->chat_model->countAll();
        // }
        // else {
        //     $search = $this->input->post('search')['value']; 

        //     $this->data['rows'] = $this->chat_model->chat_search($limit,$start,$search);

        //     $this->data['allCount'] = $this->chat_model->posts_search_count($search);
        // }
        
        
        
        foreach($this->data['rows'] as $row) {

            $msg = "<span style=\"color: #3e3b3beb\">";

            $msg .= short_text($row->msg_row->msg=='' && count($row->msg_row->attachments)>0?'<i class="fa fa-paperclip"></i> Attachment':$row->msg_row->msg,100)."</span>";

            //$msg = !empty($row->msg_row->msg) ? short_text($row->msg_row->msg) : '';
            $time = format_date($row->msg_row->time,'M d, Y h:i:m a');
            $id = "<a href=".site_url(ADMIN.'/chat/messages/'.$row->id)." class=\"btn btn-primary btn-sm\"><span class=\"fa fa-envelope\"></span> Messages</a>";

            $mem_one = '';
            if(!empty($row->mem_one) && !empty($row->mem_two)) {
                $mem_one = "<a href=".site_url(ADMIN.'/'.get_mem_type($row->mem_one)."s/manage/".$row->mem_one)." target=\"_blank\"><b>".get_mem_name($row->mem_one)."</b></a>";
                $mem_one .= "<i class=\"fa fa-exchange\"></i>";
                $mem_one .= "<a href=".site_url(ADMIN.'/'.get_mem_type($row->mem_two)."s/manage/".$row->mem_two)." target=\"_blank\"><b>".get_mem_name($row->mem_two)."</b></a>";
            }

            $nestedData['mem_one'] = $mem_one;
            $nestedData['msg'] = $msg;
            $nestedData['time'] = $time;
            $nestedData['id'] = $id;

            $data[] = $nestedData;
        }
        if($this->data['allCount'] == 0) $data = [];
        
        $output = array(
            "draw" => intval($draw),
            "recordsTotal" => intval($this->data['allCount']),
            "recordsFiltered" => intval($this->data['allCount']),
            "data" => $data
        );

        echo json_encode($output);
    }

    function messages($id=0){
        $id=intval($id);
        if($row=$this->chat_model->get_row($id)){

            $this->data['mem_one']=$this->master->getRow('members',array('mem_id'=>$row->mem_one));
            $this->data['mem_two']=$this->master->getRow('members',array('mem_id'=>$row->mem_two));
            $this->data['messages']=$this->chat_model->get_chat_detail($id);

            $this->data['pageView'] = ADMIN . '/chat-messages';
            $this->load->view(ADMIN . '/includes/siteMaster',$this->data);
        }
        else
            show_404();
    }
}

?>