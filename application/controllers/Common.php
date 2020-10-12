<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('member_model');
		$this->load->model('episode_model');
		$this->load->model('chapter_model');
		$this->load->model('comment_model');
		$this->load->model('note_model');
		$this->load->model('novel_model');
		$this->load->model('comic_model');
	}

	function subscribe(){
		$this->isMemLogged('member');
		list($type,$id)=explode('-', doDecode($this->input->post('store')));
		$id=intval($id);
		if($id<1 || !in_array($type,array('comic','novel')) || !in_array($this->input->post('page'),array('main','detail')))
			die('access denied!');
		else
			$type_model=$type.'_model';

		if($row=$this->$type_model->get_row_where(array('id'=>$id,'status'=>1)))
		{
			if($this->master->getRow('subscribers',array('mem_id'=>$this->session->mem_id,'ref_id'=>$id,'ref_type'=>$type)))
			{
				$this->db->where(array('mem_id'=>$this->session->mem_id,'ref_id'=>$id,'ref_type'=>$type));
				$this->db->delete('subscribers');
				$res['data']=$this->input->post('page')=='main'?'Subscribe':'<i class="fas fa-plus"></i>';
			}
			else{
				$this->master->save('subscribers',array('mem_id'=>$this->session->mem_id,'ref_id'=>$id,'ref_type'=>$type));

				$type_url=$type.'_url';
				$url=$type_url($row->id,$row->title);

				$txt=' subscribed your '.$type.' <a href="'.$url.'">'.short_text($row->title,50).'.</a>';
				$this->save_notificaiton($row->mem_id,$this->session->mem_id,$txt,'subscribed');
				$res['data']=$this->input->post('page')=='main'?'<i class="fa fa-check"></i> Subscribed':'<i class="fa fa-check"></i>';
			}
			exit(json_encode($res));
		}
		die('access denied!');
	}

	function favorite(){
		$this->isMemLogged('member');

		list($type,$id)=explode('-', doDecode($this->input->post('store')));
		$id=intval($id);
		if($id<1 || !in_array($type,array('comment','episode','novel')))
			die('access denied!');
		else{
			$type_arr=array('comment'=>'comment','episode'=>'comic','novel'=>'novel');
			$type_model=$type.'_model';
			$function_name='get_'.$type;
		}
		if($row=$this->$type_model->$function_name($id))
		{
			if($this->master->getRow('favorites',array('mem_id'=>$this->session->mem_id,'ref_id'=>$id,'ref_type'=>$type)))
			{
				$this->db->where(array('mem_id'=>$this->session->mem_id,'ref_id'=>$id,'ref_type'=>$type));
				$this->db->delete('favorites');
				$total_favorites=total_favorites($id,$type);
				$res['data']=$type=='comment'?'<i class="fi-thumbs-up"></i><span>'.($total_favorites>0?$total_favorites:'').'</span>':'<i class="fi-heart"></i><span>'.$total_favorites.'</span>';
				$res['active']=0;
			}else{
				if($this->session->mem_id!=$row->mem_id)
				{
					if($type=='comment')
					{
						$type_url=$row->ref_type.'_url';
						$model_name1=$row->ref_type.'_model';
						$this->load->model($model_name1,'type_model1');
						$type_row=$this->type_model1->get_row($row->ref_id);
						$url=$type_url($row->ref_id,$type_row->title);
						$txt='like your comment on '.$type_arr[$row->ref_type].' '.$row->ref_type.' <a href="'.$url.'">'.short_text($type_row->title,50).'.</a>';
					}else{
						$type_url=$type.'_url';
						$url=$type_url($id,$row->title);
						$txt='like your '.$type_arr[$type].' '.$type.' <a href="'.$url.'">'.short_text($row->title,50).'.</a>';
					}

					$this->save_notificaiton($row->mem_id,$this->session->mem_id,$txt);
				}
				$this->master->save('favorites',array('mem_id'=>$this->session->mem_id,'ref_id'=>$id,'ref_type'=>$type));
				$res['data']=$type=='comment'?'<i class="fi-thumbs-up"></i><span>'.total_favorites($id,$type).'</span>':'<i class="fi-heart"></i><span>'.total_favorites($id,$type).'</span>';
				$res['active']=1;
			}
			echo json_encode($res);
			exit;
		}
		die('access denied!');
	}


	function rate(){
		$this->isMemLogged('member');
		$post=html_escape($this->input->post());
		list($type,$id)=explode('-', doDecode($this->input->post('store')));
		$id=intval($id);
		if($id<1 || !in_array($type,array('comic','novel')) || $post['rating']>5 || $post['rating']<0.1)
			die('access denied!');
		else
			$type_model=$type.'_model';

		if($row=$this->$type_model->get_row_where(array('id'=>$id,'status'=>1)))
		{
			$res['status']=0;
			$vals=array();

			$vals['from_id']=$this->session->mem_id;
			$vals['ref_id']=$id;
			$vals['ref_type']=$type;

			if(!$this->master->getRow('reviews',$vals)){;
				$vals['mem_id']=$row->mem_id;
				$vals['rating']=$post['rating'];
				// $vals['comment']=$post['comment'];

				$this->master->save('reviews',$vals);

				$type_url=$type.'_url';
				$url=$type_url($row->id,$row->title);

				$txt='rate your '.$type.' <a href="'.$url.'">'.short_text($row->title,50).'.</a>';

				$this->save_notificaiton($row->mem_id,$this->session->mem_id,$txt);
				$res['status']=1;
			}
			exit(json_encode($res));
		}
		die('access denied!');
	}

	/*function get_schedule_episodes() {
		$day=$this->input->post('day');
		$week_days=get_week_days();

		$res['items'] = "";
		$res['found'] = 0;
		if(in_array($day, $week_days)){
			$this->load->model('episode_model');
			$schedule_episodes = $this->episode_model->get_schedule_episodes($day,'',8);
			$res['found'] = 1;
			if (count($schedule_episodes) > 0) {
				foreach ($schedule_episodes as $schedule_episode) {
					$res['items'] .= 
					'<li>
					<div class="iTem">
					<div class="image" style="background-image: url(\''.get_image_src($schedule_episode->thumbnail,300).'\')">
					<a href="'.episode_url($schedule_episode->id,$schedule_episode->title).'" class="overlay"></a>
					</div>
					<div class="heart">
					'.favorite_btn($row->id,'comic',$schedule_episode->total_favorites).'
					</div>
					<div class="ico"><a href="'. profile_url($schedule_episode->mem_id,$schedule_episode->mem_name).'"><img src="'. get_image_src($schedule_episode->mem_image,50).'" alt=""></a></div>
					<div class="cntnt">
					<h4><a href="'. episode_url($schedule_episode->id,$schedule_episode->title).'">'. $schedule_episode->title.'</a></h4>
					<div class="rateYo"></div>
					<div class="chBlk">
					<div class="ch">CH 1</div>
					<div class="date">5/23</div>
					</div>
					</div>
					</div>
					</li>';
				}
			} else {
				$res['items'] = "<li>No comic schedule on ".$day."</li>";
			}
		}
		exit(json_encode($res));
	}*/

	function comment(){
		$this->isMemLogged('member');
		$vals=html_escape($this->input->post());

		list($ref_type,$id)=explode('-', doDecode($vals['store']));
		$id=intval($id);

		if(!in_array($ref_type,array('episode','chapter')))
			die('access denied!');
		$type_model=$ref_type=='episode'?'episode_model':'chapter_model';
		$function_name=$ref_type=='episode'?'get_'.$ref_type:'get_'.$ref_type;

		if($this->input->post() && $vals['cmnt']!='' && $row=$this->$type_model->$function_name($id)){
			$res=array();
			$res['status']=0;
			$res['cmnt']='error!';
			$cmnt_data['parent_id']=($vals['reply'] && !empty($vals['reply']))?intval(substr(doDecode($vals['reply']),6)):0;
			$replied_person=($vals['pr'] && !empty($vals['pr']))?intval(substr(doDecode($vals['pr']),3)):0;
			if($cmnt_data['parent_id']>0 && !$this->comment_model->is_valid_reply_id($cmnt_data['parent_id'],$id,$ref_type)){
				exit(json_encode($res));
			}

			$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
			if(preg_match($reg_exUrl, $vals['cmnt'], $url)) {
				$cmnt_data['comment']= preg_replace($reg_exUrl, "<a href=\"{$url[0]}\" target='_blank'>{$url[0]}</a> ", $vals['cmnt']);
				$vals['cmnt']=$cmnt_data['comment'].'<small> (Approval Pending)</small>';
				$cmnt_data['status']=0;
			} else {
				$cmnt_data['comment']=$vals['cmnt'];
				$cmnt_data['status']=1;
			}

			$cmnt_data['mem_id']=$this->session->mem_id;
			$cmnt_data['ref_id']=$id;
			$cmnt_data['ref_type']=$ref_type;

    		// exit(json_encode($cmnt_data));
			$reply=0;
			$cmnt_id=$this->comment_model->save($cmnt_data);

			if($cmnt_data['parent_id']>0 && $replied_person>0){
				$reply_id=$vals['reply'];
				$res['comment']=doEncode('comment-'.$cmnt_data['parent_id']);
				if($this->session->mem_id!=$replied_person){
					$type_arr=array('episode'=>'comic','chapter'=>'novel');
					$type_url=$ref_type.'_url';
					$url=$type_url($id,$row->title);
					$txt='replied to your comment on '.$type_arr[$ref_type].' '.$ref_type.' <a href="'.$url.'">'.$row->title.'.</a>';
					$this->save_notificaiton($replied_person,$this->session->mem_id,$txt);
					$reply=1;
				}
			}
			else
				$reply_id=doEncode('reply-'.$cmnt_id);

			if($this->session->mem_id!=$row->mem_id && $reply==0){
				$type_arr=array('episode'=>'comic','chapter'=>'novel');
				$type_url=$ref_type.'_url';
				$url=$type_url($id,$row->title);
				$txt='comment on your '.$type_arr[$ref_type].' '.$ref_type.' <a href="'.$url.'">'.$row->title.'.</a>';
				$this->save_notificaiton($row->mem_id,$this->session->mem_id,$txt,'comments');
			}
			$encoded_cmnt_id=doEncode('comment-'.$cmnt_id);


			$res['cmnt']='<div class="wrtCmnt" id="'.$encoded_cmnt_id.'"><div class="inside"><div class="ico"><a href="'.profile_url($this->data['mem_data']->mem_id,$this->data['mem_data']->mem_fname.' '.$this->data['mem_data']->mem_lname).'"><img src="'.get_image_src($this->data['mem_data']->mem_image,50).'" alt=""></a></div><div class="inter"><h6><a href="'.profile_url($this->data['mem_data']->mem_id,$this->data['mem_data']->mem_fname.' '.$this->data['mem_data']->mem_lname).'">'.$this->data['mem_data']->mem_fname.' '.$this->data['mem_data']->mem_lname.'</a></h6> <div class="cmnt">'.nl2br($vals['cmnt']).'</div><ul class="rplyLst">'.favorite_cmnt_btn($cmnt_id,'comment',0).'<li class="reply"><a href="javascript:void(0)" data-tip="reply" data-store="'.$reply_id.'" data-store1="'.$encoded_cmnt_id.'" data-pr="'.doEncode('pr-'.$this->session->mem_id).'"><i class="fi-reply"></i></a></li><li class="dropDown"><a href="javascript:void(0)" class="dropBtn"><i class="fi-more"></i></a><ul class="dropCnt"><li class="edtBtn"><a href="javascript:void(0)" data-store="'.$encoded_cmnt_id.'" data-store1="'. $reply_id.'"><i class="fi-cut"></i>Eraser</a></li><li class="dltBtn"><a href="javascript:void(0)" data-store="'.$encoded_cmnt_id.'" data-store1="'.$reply_id.'"><i class="fi-cross-circle"></i>Delete</a></li></ul></li><li class="time">Just Now</li></ul></div></div></div>';

			$res['comments']=$this->$type_model->total_comments($id);
			$res['status']=1;
			$res['save']=0;
			exit(json_encode($res));
		}
		die('access denied!');
	}
	function comment_delete(){
		$this->isMemLogged('member');

		list($type,$id)=explode('-', doDecode($this->input->post('store')));
		$id=intval($id);
		if($id<1 || $type!='comment')
			die('access denied!');
		if($this->input->post() && $row=$this->comment_model->is_valid_delete($id)){
			$res=array();

			$this->comment_model->delete_comment($id);
			$type_model=$row->ref_type.'_model';
			$res['comments']=$this->type_model->total_comments($row->ref_id);
			$res['status']=1;
			$res['save']=0;
			exit(json_encode($res));
		}
		die('access denied!');
	}
	function comment_update(){
		$this->isMemLogged('member');
		list($type,$id)=explode('-', doDecode($this->input->post('reply')));
		$id=intval($id);
		if($id<1 || $type!='comment')
			die('access denied!');
		if($this->input->post('cmnt') && $this->input->post('cmnt')!='' && $row=$this->comment_model->is_editable($id)){
			$res=array();
			$vals=html_escape($this->input->post());

			$cmnt_data=array();

			$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
			if(preg_match($reg_exUrl, $vals['cmnt'], $url)) {
				$cmnt_data['comment']= preg_replace($reg_exUrl, "<a href=\"{$url[0]}\" target='_blank'>{$url[0]}</a> ", $vals['cmnt']);
				$vals['cmnt']=$cmnt_data['comment'].'<small> (Approval Pending)</small>';
				$cmnt_data['status']=0;
			} else {
				$cmnt_data['comment']=$vals['cmnt'];
				$cmnt_data['status']=1;
			}

			$this->comment_model->save($cmnt_data,$id);
			$res['save']=$this->input->post('reply');
			$res['status']=1;
			$res['cmnt']=nl2br($vals['cmnt']);
			exit(json_encode($res));
		}
		die('access denied!');
	}
	function comment_report(){
		$this->isMemLogged('member');
		list($type,$id)=explode('-', doDecode($this->input->post('store')));
		$id=intval($id);
		if($id<1 || $type!='comment' || !$row=$this->comment_model->get_comment($id))
			die('access denied!');

		$res=array();
		$res['hide_msg']=1;
		$res['scroll_to_msg']=0;
		$res['status'] = 0;
		$res['frm_reset'] = 1;
		$res['redirect_url'] = 0;

		$this->form_validation->set_rules('reason','Reason','required');
		if($this->form_validation->run()===FALSE)
		{
			$res['msg'] = validation_errors();
		}else{
			$post=html_escape($this->input->post());
			$this->master->save('comment_reports',array('mem_id'=>$this->session->mem_id,'cmnt_id'=>$id,'reason'=>$post['reason']));
			$res['msg']=showMsg('success','Comment reported successfully!');
			$res['status']=1;
		}
		exit(json_encode($res));
	}

	function save_note() {
		$this->isMemLogged('member');
		$post=html_escape($this->input->post());
		list($type,$id)=explode('-', doDecode($post['store']));
		$id=intval($id);

		if($id<1 || !in_array($type,array('episode','chapter')))
			show_404();
		else{
			$type_arr=array('comment'=>'comment','episode'=>'comic','chapter'=>'novel');
			$type_model=$type.'_model';
			$function_name='get_'.$type;
		}

		if($this->input->post() && $row=$this->$type_model->$function_name($id)){
			$res=array();
			$res['frm_reset'] = 0;
			$res['hide_msg']=0;
			$res['status'] = 0;
			$res['scroll_to_msg']=0;
			$res['redirect_url'] = 0;

			$this->form_validation->set_rules('title','Title','required');
			$this->form_validation->set_rules('detail','Detail','required',array('required'=>'Plase write something for note'));
			if($this->form_validation->run()===FALSE)
			{
				$res['msg'] = validation_errors();
			}else{

				$status=$this->session->mem_id==$row->mem_id?'approved':'pending';
				$note_vals=array('mem_id'=>$this->session->mem_id,'ref_id'=>$id,'ref_type'=>$type,'title'=>ucfirst($post['title']),'detail'=>$post['detail'],'image'=>$post['image'],'status'=>$status);


				$note_id=$this->note_model->save($note_vals);

				if($this->session->mem_id!=$row->mem_id){
					$type_arr=array('episode'=>'comic','chapter'=>'novel');
					$type_url=$type.'_url';
					$url=$type_url($id,$row->title);
					$txt='add note on your '.$type_arr[$type].' '.$type.' <a href="'.$url.'">'.$row->title.'.</a>';
					$this->save_notificaiton($row->mem_id,$this->session->mem_id,$txt,'notes',$note_id);
				}

				$res['msg'] = showMsg('success','Note has been saved successfully. Please wait for approval!');
				$res['status'] = 1;
				$res['frm_reset'] = 1;
			}
			exit(json_encode($res));
		}
		else
			show_404();
	}

	function delete_note($id=''){
		$this->isMemLogged('member');
		list($type,$id)=explode('-', doDecode($id));
		$id=intval($id);
		if($id>0 && $type=='note' && $this->note_model->is_valid_note_mem($id)){
			$this->note_model->delete($id);
			$this->master->delete('notifications','note_id',$id);

			setMsg('success','Note has been deleted successfully!');
			redirect('notifications/notes');
			exit;
		}
		else
			show_404();
	}
	function update_note(){
		$this->isMemLogged('member');
		list($type,$id)=explode('-', doDecode($this->input->post('store')));
		$id=intval($id);
		if($id<1 || $type!='note')
			die('access denied!');
		if($row=$this->note_model->is_valid_note_mem($id)){

			$res=array();
			$res['frm_reset'] = 0;
			$res['hide_msg']=0;
			$res['status'] = 0;
			$res['scroll_to_msg']=0;
			$res['redirect_url'] = 0;

			$this->form_validation->set_rules('title','Title','required');
			$this->form_validation->set_rules('detail','Detail','required',array('required'=>'Plase write something for note'));
			if($this->form_validation->run()===FALSE)
			{
				$res['msg'] = validation_errors();
			}else{
				$post=html_escape($this->input->post());

				$note_vals=array('title'=>ucfirst($post['title']),'detail'=>$post['detail']);
				if($post['image'] && $post['image']!='')
					$note_vals['image']=$post['image'];


				$note_id=$this->note_model->save($note_vals,$id);

				$res['msg'] = showMsg('success','Note has been saved successfully!');
				$res['status'] = 1;
				$res['frm_reset'] = 1;
				$res['redirect_url'] = site_url('notifications/notes');
			}
			exit(json_encode($res));
		}
		die('access denied!');
	}
	function approve_note($id) {
		$this->isMemLogged('member');
		list($type,$id)=explode('-', doDecode($id));
		$id=intval($id);
		
		if($id>0 && $row=$this->note_model->get_note($id,'pending')){
			$model_name=$row->ref_type.'_model';
			$function_name='get_mem_'.$row->ref_type;
			if(!$type_row=$this->$model_name->$function_name($row->ref_id)){
				show_404();
				exit;
			}

			$this->note_model->save(array('status'=>'approved'),$id);

			$type_arr=array('episode'=>'comic','chapter'=>'novel');
			$type_url=$row->ref_type.'_url';
			$url=$type_url($type_row->id,$type_row->title);

			$txt='approved your note on '.$type_arr[$row->ref_type].' '.$row->ref_type.' <a href="'.$url.'">'.$type_row->title.'.</a>';
			$this->save_notificaiton($row->mem_id,$this->session->mem_id,$txt,'notes');

			setMsg('success','Note has been approved successfully!');
			redirect('notifications/notes');
			exit;
		}
		else
			show_404();
	}
	function reject_note($id) {
		$this->isMemLogged('member');
		list($type,$id)=explode('-', doDecode($id));
		$id=intval($id);
		
		if($id>0 && $row=$this->note_model->get_note($id,'pending')){
			$model_name=$row->ref_type.'_model';
			$function_name='get_mem_'.$row->ref_type;
			if(!$type_row=$this->$model_name->$function_name($row->ref_id)){
				show_404();
				exit;
			}

			$this->note_model->save(array('status'=>'rejected'),$id);

			$type_arr=array('episode'=>'comic','chapter'=>'novel');
			$type_url=$row->ref_type.'_url';
			$url=$type_url($type_row->id,$type_row->title);

			$txt='approved your note on '.$type_arr[$row->ref_type].' '.$row->ref_type.' <a href="'.$url.'">'.$type_row->title.'.</a>';
			$this->save_notificaiton($row->mem_id,$this->session->mem_id,$txt,'notes');

			setMsg('success','Note has been rejected successfully!');
			redirect('notifications/notes');
			exit;
		}
		else
			show_404();
	}

	function store($cat='') {
		// $this->isMemLogged('member');

		if($this->input->post()){
			$cat_id=intval(substr(doDecode($this->input->post('store')),4));
			$res['items'] = "";
			$condition='';

			$page=intval($this->input->post('load'));
			$page=$page>0?$page:1;
			$per_page=20;
			$res['page']=$this->input->post('store');


			if($this->input->post('store')!==null){
				$res['test']='testing';

				if($cat_id>0)
					$condition.="(cat_id=$cat_id or cat_id1=$cat_id)";
				$total=$this->episode_model->total_store_episodes($condition);
				$total_pages=ceil($total/$per_page);
				$start=($page-1)*$per_page;

				$res['reached']=$total_pages>$page?false:true;
				$res['btn']='';
				$res['found']=0;
				$res['load']=$this->input->post('load')?$page+1:2;


				$episodes = $this->episode_model->get_store_episodes($condition,$start,$per_page);
				if (count($episodes) > 0) {
					$res['found']=1;
					if (!$res['reached'])
						$res['btn'] .= '<div class="loadBtn hidden" id="cmcLoad"><a href="javascript:void(0)" class="webBtn">Load More...</a></div>';
					foreach ($episodes as $key => $episode){

						$res['items'] .= '<li class="hidden"><div class="iTem"><div class="image" style="background-image: url(\''. get_image_src($episode->thumbnail,300).'\')"><a href="'. comic_url($episode->comic_id,$episode->comic_title).'" class="overlay"></a></div><div class="heart">'.favorite_btn($episode->id,'episode',$episode->total_favorites).'</div><div class="ico"><a href="'. profile_url($episode->mem_id,$episode->mem_name).'"><img src="'. get_image_src($episode->mem_image,50,true).'" alt=""></a></div><div class="cntnt"><h4><a href="'. comic_url($episode->comic_id,$episode->comic_title).'">'. $episode->title.'</a></h4><div class="chBlk"><div class="ch"><a href="'.episode_url($episode->id,$episode->title).'">CH '.$episode->episode_no.'</a></div><div class="date">Free in '. $episode->free_days.' days</div></div><div class="gems">'. $episode->price.'</div></div></div></li>';
					}
				}
				else
					$res['items'] = "<li>No comic</li>";
			}else{
				$total=$this->chapter_model->total_store_chapters('');
				$total_pages=ceil($total/$per_page);
				$start=($page-1)*$per_page;

				$res['reached']=$total_pages>$page?false:true;
				$res['btn']='';
				$res['found']=0;
				$res['load']=$this->input->post('load')?$page+1:2;


				$chapters = $this->chapter_model->get_store_chapters('',$start,$per_page);
				if (count($chapters) > 0) {
					$res['found']=1;
					if (!$res['reached'])
						$res['btn'] .= '<div class="loadBtn hidden" id="nvlLoad"><a href="javascript:void(0)" class="webBtn">Load More...</a></div>';
					foreach ($chapters as $key => $chapter){

						$res['items'] .= '<li class="hidden"><div class="iTem"><div class="image" style="background-image: url(\''.get_image_src($chapter->thumbnail).'\')"><a href="'.novel_url($chapter->novel_id,$chapter->novel_title).'" class="overlay"></a></div><div class="heart"><a href="javascript:void(0)" class="active"><i class="fi-heart"></i><span>'.$chapter->total_favorites.'</span></a></div><div class="ico"><a href="'.profile_url($chapter->mem_id,$chapter->mem_name)
						.'"><img src="'.get_image_src($chapter->mem_image,50,true).'" alt=""></a></div><div class="cntnt"><h4><a href="'.novel_url($chapter->novel_id,$chapter->novel_title).'">'.$chapter->title.'</a></h4><div class="chBlk"><div class="ch"><a href="'.chapter_url($chapter->id,$chapter->title).'">CH '.$chapter->chapter_no.'</a></div><div class="date">Free in '.$chapter->free_days.' days</div></div><div class="gems">'.$chapter->price.'</div></div></div></li>';
					}
				}
				else
					$res['items'] = "<li>No Novel</li>";
			}
			exit(json_encode($res));
		}else{
			$this->load->model('category_model');
			$this->data['cat']=$cat;
			$this->data['genres']=$this->category_model->get_active_categories('comic');
			$this->data['packages']=$this->master->getRows('packages',array('status'=>1));
			$this->load->view('pages/store', $this->data);
		}
	}

	function buy_gems($id=''){
		$this->isMemLogged('member');
		if ($this->input->post()) {
			$res=array();
			$res['status'] = 0;
			$res['frm_reset'] = 0;
			$res['hide_msg'] = 0;
			$res['redirect_url'] = 0;
			$res['msg'] = '<div class="alert alert-danger alert-sm">Something went wrong!</div>';

			$this->form_validation->set_rules('package','Gems Package','required',array('required'=>'Please Select {field}'));
			$this->form_validation->set_rules('card_holder_name','Card Holder','required');
			$this->form_validation->set_rules('cardnumber','Card Number','required');
			$this->form_validation->set_rules('exp_month','Expiry Month','required',array('required'=>'Please select a {field}'));
			$this->form_validation->set_rules('exp_year','Expiry Year','required',array('required'=>'Please select a {field}'));
			$this->form_validation->set_rules('cvc','CVC','required');
			if($this->form_validation->run()===FALSE)
			{
				$res['msg'] = validation_errors();
			}else{
				$post = html_escape($this->input->post());
				list($type,$pkg_id)=explode('-', doDecode($post['package']));
				if($type!='pkg' || !$pkg_row=$this->master->getRow('packages',array('encoded_id'=>$post['package']))){
					$res['msg']=showMsg('error','Please select valid Gems Package!');
					exit(json_encode($res));
				}

				if($post['payment'] == 'posted'){
					include_once APPPATH . "libraries/stripe/init.php";


					\Stripe\Stripe::setApiKey(API_SECRET_KEY);

					try {
						if (!isset($_POST['stripeToken']))
							throw new Exception("The Stripe Token was not generated correctly");

                        // $amount = $this->data['site_settings']->site_gems_pr_dollar>0?floatval($post['num_gems']/$this->data['site_settings']->site_gems_pr_dollar):0;
						$amount = $pkg_row->price;
						$cents = round($amount * 100);

						$charge = \Stripe\Charge::create([
							"amount" => $cents,
							"currency" => "USD",
							"source" => $post['stripeToken'],
							"description" => $pkg_row->gems." Gems payment $".$pkg_row->price
						]);
						$charge_array = serialize($charge->__toArray(true));

						if($post['remember_info'] && $post['remember_info']=='yes'){
							$mem_data=array('mem_card_name' =>$post['card_holder_name'], 'mem_card_number' =>$post['cardnumber'], 'mem_card_exp_month' =>$post['exp_month'], 'mem_card_exp_year' =>$post['exp_year'], 'mem_card_cvc' =>$post['cvc']);
							$this->member_model->save($mem_data,$this->session->mem_id);
						}
						/*$this->member_model->save(array('mem_gems'=>$this->data['mem_data']->mem_gems+$pkg_row->gems),$this->session->mem_id);*/


						$this->load->model('transaction_model');
						$this->transaction_model->save(array('mem_id'=>$this->session->mem_id,'status'=>1,'note'=>$pkg_row->gems.' Gems purchased in $'.$pkg_row->price,'trx_detail'=>$charge_array,'price'=>$pkg_row->price,'gems'=>$pkg_row->gems));

						$res['msg'] = showMsg('success',$pkg_row->gems.' Gems purchased successfully!');
						$res['redirect_url']=site_url('dashboard');
						$res['status']=1;

					} catch (Exception $e) {
						$res['msg'] = showMsg('error',$e->getMessage());
					}
				}else{
					$res['msg'] = showMsg('error','Please fill all fields!');
				}
			}
			echo json_encode($res);
			exit;
		}
		else{
			$this->data['pkg_id']=$id;
			$this->data['buygems_content'] = $this->master->getRow('sitecontent', array('type' => 'buygems'));
			$this->data['buygems_content'] =unserialize($this->data['buygems_content']->code);
			$this->data['packages']=$this->master->getRows('packages',array('status'=>1));
			$this->load->view('account/payment-detail', $this->data);
		}
	}
	function purchase(){
		$this->isMemLogged('member');
		list($type,$id)=explode('-', doDecode($this->input->post('store')));
		$id=intval($id);
		if($id<1 || !in_array($type,array('episode','chapter')))
			die('access denied!');
		else{
			$type_model=$type.'_model';
			$function_name='get_released_'.$type;

			$res=array();
			$res['hide_msg']=1;
			$res['status'] = 0;
			$res['msg']=showMsg('error','Something went wrong!');
			if($row=$this->$type_model->$function_name($id))
			{
				$mem_gems=get_mem_gems($this->session->mem_id);
				if($mem_gems<$row->price){
					$res['msg']=showMsg('error','You don\'t have enough gems!');
					exit(json_encode($res));
				}

				if($this->master->getRow('purchases',array('mem_id'=>$this->session->mem_id,'ref_id'=>$row->id,'ref_type'=>$type))){
					$res['msg']=showMsg('error',"You already unlocked this $type!");
					exit(json_encode($res));
				}

				$this->master->save('purchases',array('mem_id'=>$this->session->mem_id,'ref_id'=>$row->id,'ref_type'=>$type,'gems'=>$row->price));

				$this->load->model('transaction_model');
				$this->transaction_model->save(array('mem_id'=>$this->session->mem_id,'status'=>1,'note'=>ucfirst($type)." unlocked in {$row->price}Gems",'trx_detail'=>'','price'=>0,'gems'=>-$row->price));
				$this->transaction_model->save(array('mem_id'=>$row->mem_id,'status'=>1,'note'=>ucfirst($type)." unlocked in {$row->price}Gems",'trx_detail'=>'','price'=>0,'gems'=>$row->price));

				$type_url=$type.'_url';
				$url=$type_url($row->id,$row->title);
				$txt=' purchased your '.$type.' <a href="'.$url.'">'.short_text($row->title,50).'.</a>';
				$this->save_notificaiton($row->mem_id,$this->session->mem_id,$txt);

				if ($type=='chapter') 
				{
					$res['items'].='<div class="chapter hidden"><h3>Chapter '.$row->chapter_no.': '.$row->title.'</h3>'.$row->detail.'</div>';
				}
				else{
					foreach ($row->images as $key => $ep_image)
						$res['items'].= '<li class="hidden"><img src="'. get_image_src($img_row->image).'" alt=""></li>';
				}

				$res['msg']=showMsg('success',ucfirst($type).' has been unlocked successfully!');
				$res['status']=1;
				$res['store']=$this->input->post('store');
			}
			exit(json_encode($res));
		}
	}

	function save_post(){
		$this->isMemLogged('member');
		list($type,$id)=explode('-', doDecode($this->input->post('store')));
		$id=intval($id);

		$post=html_escape($this->input->post());
		$image=$post['attach']?explode(',', $post['attach']):'';

		if($type=='profile' && $id==$this->session->mem_id && ($post['detail']!='' || (!empty($image) && count($image)==2)))
		{
			
			$post_id=$this->master->save('posts',array('mem_id'=>$this->session->mem_id,'text'=>$post['detail'],'image'=>$image[0]));
			$post_encoded_id=doEncode('post-'.$post_id);

			$res['item'].= '<li><div class="iTem"><div class="icoBlk"><div class="ico"><a href="'.profile_url($this->data['mem_data']->mem_id,$this->data['mem_data']->mem_fname.' '.$this->data['mem_data']->mem_lname).'"><img src="'.get_image_src($this->data['mem_data']->mem_image,50).'" alt=""></a></div><h4><a href="'.profile_url($this->data['mem_data']->mem_id,$this->data['mem_data']->mem_fname.' '.$this->data['mem_data']->mem_lname).'">'.$this->data['mem_data']->mem_fname.' '.$this->data['mem_data']->mem_lname.'</a><span class="time">Just Now</span></h4><div class="dropDown drpDown"><div class="more dropBtn"><span></span></div><ul class="moreLink dropCnt">
			<li>
			<!--<a href="?" title="Edit"><i class="fi-pencil"></i></a>
			</li>-->
			<li><a href="javascript:void(0)" data-store="'.$post_encoded_id.'" title="Delete" class="pstDlt"><i class="fi-trash"></i></a></li></ul></div><div class="pin" data-store="'.$post_encoded_id.'"><i class="fi-pushpin"></i></div></div>';

			if (!empty($image) && count($image)==2)
				$res['item'].= '<div class="image"><img src="'.get_image_src($image[0],'att').'" alt=""></div>';
			if (!empty($post['detail']))
				$res['item'].= '<div class="cntnt"><p>'.$post['detail'].'</p></div>';

			$res['item'].= '</div></li>';
			$res['status']=1;
			exit(json_encode($res));
		}
		die('access denied!');
	}

	function delete_post(){
		$this->isMemLogged('member');
		list($type,$id)=explode('-', doDecode($this->input->post('store')));
		$id=intval($id);
		// exit(json_encode(explode('-', doDecode($this->input->post('store')))));

		if($type=='post' && $row=$this->master->getRow('posts',array('id'=>$id)))
		{
			$this->master->delete('posts','id',$id);
			if (!empty($row->image)) {
				$query=http_build_query(array('attachs'=>array($row->image)));
				curl_call(SCONTENT_SITE.'ajax/remove_attachments',$query."&pk_key=".doEncode($this->data['mem_data']->mem_token));
			}

			$res['status']=1;
			$res['store']=$this->input->post('store');
			exit(json_encode($res));
		}
		die('access denied!');
	}
	function pin_post(){
		$this->isMemLogged('member');
		list($type,$id)=explode('-', doDecode($this->input->post('store')));
		$id=intval($id);

		if($type=='post' && $row=$this->master->getRow('posts',array('id'=>$id,'mem_id'=>$this->session->mem_id)))
		{
			$this->db->set(array('pined' => '0'));
			$this->db->where('mem_id', $this->session->mem_id);
			$this->db->update('posts');

			$this->db->set(array('pined' => '1'));
			$this->db->where('id', $id);
			$this->db->update('posts');
			
			$res['status']=1;
			$res['store']=$this->input->post('store');
			exit(json_encode($res));
		}
		die('access denied!');
	}
}

?>