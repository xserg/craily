<?php

class Notifications extends MY_Controller {

	function __construct() {
		parent::__construct();
		//$this->isMemLogged($this->session->mem_type);
		$this->load->model('notification_model');
	}
	
	function index($page=1,$noti=NULL) {
		if($this->data['mem_data']->mem_type == 'tutor')
        {
            if($this->data['mem_data']->mem_tutor_application > 0){
                if(empty($this->data['mem_data']->mem_stripe_id)) {
                    redirect('stripe-register');
                    exit;
                }
                
            }
        }

		$page=intval($page);
		if ($page>0 && $page<=5) {

			$this->data['noti']=$noti;

			$per_page=10;
			$total=$this->notification_model->count_rows_where(array('mem_id'=>$this->session->mem_id));
			$total=$total>50?50:$total;
			$total_pages=ceil($total/$per_page);


			$this->load->library('pagination');
			$this->config->load('pagination');

			$config = $this->config->item('pagination');        
			$config['base_url'] = base_url('notifications');
			$config['total_rows'] = $total;
			$config['per_page'] = $per_page;
			$this->pagination->initialize($config); 
			$this->data['links'] = $this->pagination->create_links();

			$start=($page-1)*$per_page;

			mark_seen_notifications();
			$this->data['rows'] = $this->notification_model->get_notifications(array('n.mem_id'=>$this->session->mem_id),$start,$per_page,'desc');
			$this->load->view("account/notifications", $this->data);	
		}
		else
			show_404();
		
	}

	function mark_seen_noti(){
		mark_seen_notifications();
		echo 'ok';
	}

	function scan_notification(){
		$noti_rows = count_new_header_notis();
		$messageCnt = 0;
		if(!empty($this->data['mem_data']->mem_stripe_id) || $this->data['mem_data']->mem_type != 'tutor')
			$messageCnt = count_new_msgs();
		$returnArry = ['noti_cnt'=>$noti_rows, 'message_cnt' => $messageCnt];
		echo json_encode($returnArry);
	}

		/*function index($cat='') {
		// $this->mark_seen_notifications();
			$condition=array('n.mem_id'=>$this->session->mem_id);
			$this->data['cat']=$cat;

			$fnctn_name='get_all_notifications';

			if($cat!='' && in_array($cat, array('comments','subscribed','notes','other'))){
				$condition['n.cat']=$cat;


				$fnctns_arr=array('comments'=>'get_notifications','subscribed'=>'get_notifications','other'=>'get_notifications','notes'=>'get_note_notifications');
				$fnctn_name=$fnctns_arr[$cat];
			}

			$this->data['rows'] = $this->notification_model->$fnctn_name($condition,0,100,'desc');

			if($this->input->post()){
				$res['items'] = "";
				$res['found'] = 1;
				if(count($this->data['rows'])<1){
					$res['items'].='<p class="text-center">No new notification</p>';
				}
				foreach ($this->data['rows'] as $key => $row){
					$res['items'] .='<div class="inner"><div class="ico"><img src="'.get_image_src($row->mem_image,50,true).'" alt="'.$row->mem_name.'"></div><div class="cntnt">';

					if ($row->cat=='notes' && $row->note_status=='pending'){
						$res['items'] .'<div class="editDel"><a href="'.site_url('approve-note/'.doEncode('note-'.$row->note_id)).'" class="editBtn popBtn" title="Approve">Approve</a><a href="'.site_url('reject-note/'.doEncode('note-'.$row->note_id)).'" title="Reject" onclick="return confirm(\'Reject?\')" class="delBtn">Reject</a></div>';
					}

					$res['items'] .='<p><strong>'.$row->mem_name.'</strong> '.$row->txt .'</p><div class="time">'.time_ago($row->date) .'</div></div></div>';

					if ($row->cat=='notes' && $row->note_id>0){
						$res['items'] .='<div class="inner _inner"><div class="ico"><img src="'.get_image_src($row->image,300).'" alt=""></div><div class="cntnt"><div class="editDel"><a href="javascript:void(0)" class="editBtn aprovBtn" title="Edit" data-store="'.doEncode('note-'.$row->note_id).'">Edit</a><a href="'.site_url('delete-note/'.doEncode('note-'.$row->note_id)).'" title="Delete" onclick="return confirm(\'Delete?\')" class="delBtn">Delete</a></div><h3>'.$row->title.'</h3><p>'.$row->detail.'</p></div></div>';
					}
				}
				exit(json_encode($res));
			}
			$this->load->view("account/notifications", $this->data);
		}*/
}
?>