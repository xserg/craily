<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Uploader extends MY_Controller {
	
	function __construct() {
		parent::__construct();
		$this->isMemLogged($this->session->mem_type);
        $this->load->model('member_model');
	}
	
	function save_mem_social_image() {
		$post=$this->input->post();
		if($post['image']!=''){
			$image = file_get_contents($post['image']);
			$file_name=md5(rand(100, 1000)) . '_' .time() . '_' . rand(1111, 9999). '.jpg';
			$dir = UPLOAD_VPATH . 'vp/'.$file_name;
			@file_put_contents($dir, $image);
			generate_thumb(UPLOAD_VPATH . "vp/", UPLOAD_VPATH . "p50x50/", $file_name, 50);
			generate_thumb(UPLOAD_VPATH . "vp/", UPLOAD_VPATH . "p150x150/", $file_name, 150);
			generate_thumb(UPLOAD_VPATH . "vp/", UPLOAD_VPATH . "p300x300/", $file_name, 300);
			echo $file_name;
		}
	}
	
	function save_image() {
		$res['upload_status'] = 0;
		$token=doDecode($this->input->post('pk_key'));
		
		if (($this->master->getRow('members',array('mem_token'=>$token)) || $token=='admin') && $_FILES['image']['name'] != "") {
			$image = upload_file(UPLOAD_VPATH . "vp", 'image');
			if (!empty($image['file_name'])) {
				generate_thumb(UPLOAD_VPATH . "vp/", UPLOAD_VPATH . "p300x300/", $image['file_name'], 300);
				generate_thumb(UPLOAD_VPATH . "vp/", UPLOAD_VPATH . "p150x150/", $image['file_name'], 150);
				generate_thumb(UPLOAD_VPATH . "vp/", UPLOAD_VPATH . "p50x50/", $image['file_name'], 50);
				if($this->input->post('basethumb') && $this->input->post('basethumb')!=''){
					$baseimg=$this->input->post('basethumb');
					// list($type, $baseimg) = explode(';', $baseimg);
					list(, $baseimg)      = explode(',', $baseimg);
					$baseimg = base64_decode($baseimg);
					$image_name=$image['file_name'].'.png';
					file_put_contents(UPLOAD_VPATH . "round/".$image_name, $baseimg);
				}
				$res['image_path'] = SITE_VPATH . "vp/" . $image['file_name'];
				$res['image'] = $image['file_name'];
				$res['upload_status'] = 1;
			}
		}
		exit(json_encode($res));
	}
	function save_mul_images() {
		$res['upload_status'] = 0;
		$token=doDecode($this->input->post('pk_key'));
		if (($this->master->getRow('members',array('mem_token'=>$token)) || $token=='admin') && count($_FILES['images']['name'])>0 && $_FILES['images']['name'][0]!='') {
			foreach ($_FILES['images']['type'] as $key => $typeExt) {
				list($type,$ext)=explode('/', $typeExt);
				if($type!='image'){
					exit(json_encode($res));
				}
			}
			foreach ($_FILES['images']['name'] as $key => $file_name) {
				$_FILES['image_file']['name'] = $file_name;
				$_FILES['image_file']['type'] = $_FILES['images']['type'][$key];
				$_FILES['image_file']['tmp_name'] = $_FILES['images']['tmp_name'][$key];
				$_FILES['image_file']['error'] = $_FILES['images']['error'][$key];
				$_FILES['image_file']['size'] = $_FILES['images']['size'][$key];
				if($_FILES['image_file']['name']!=''){
					$image = upload_file(UPLOAD_VPATH . "vp", 'image_file');
					if (!empty($image['file_name'])) {
						// generate_thumb(UPLOAD_VPATH . "vp/", UPLOAD_VPATH . "p300x300/", $image['file_name'], 300);
						generate_thumb(UPLOAD_VPATH . "vp/", UPLOAD_VPATH . "p150x150/", $image['file_name'], 150);
						generate_thumb(UPLOAD_VPATH . "vp/", UPLOAD_VPATH . "p50x50/", $image['file_name'], 50);
						$res['image_path'][]= SITE_VPATH . "vp/" . $image['file_name'];
						$res['image'][] = $image['file_name'];
					}
				}
			}
			if(count($res['image_path'])>0)
				$res['upload_status'] = 1;
		}
		exit(json_encode($res));
	}
	function remove_file() {
		$token=doDecode($this->input->post('pk_key'));
		if(($this->master->getRow('members',array('mem_token'=>$token)) || $token=='admin') && $this->input->post('image')){
			$filepath = UPLOAD_VPATH . "vp/" . $this->input->post('image');
			$p300_filepath =UPLOAD_VPATH . "p300x300/" . $this->input->post('image');
			$p150_filepath = UPLOAD_VPATH . "p150x150/" . $this->input->post('image');
			$p50_filepath = UPLOAD_VPATH . "p50x50/" . $this->input->post('image');
			if (is_file($filepath))
			{
				unlink($filepath);
			}
			if (is_file($p300_filepath))
			{
				unlink($p300_filepath);
			}
			if (is_file($p150_filepath))
			{
				unlink($p150_filepath);
			}
			if (is_file($p50_filepath))
			{
				unlink($p50_filepath);
			}
			echo 'ok';
			exit;
		}
		return false;
	}
	function remove_files() {
		$token=doDecode($this->input->post('pk_key'));
		$images=$this->input->post('images')?explode(',', $this->input->post('images')):array();
		if(($this->master->getRow('members',array('mem_token'=>$token)) || $token=='admin') && $images[0]!='' && count($images)>0){
			foreach ($images as $key => $img) {
				$filepath = UPLOAD_VPATH . "vp/" . $img;
				$p300_filepath =UPLOAD_VPATH . "p300x300/" . $img;
				$p150_filepath = UPLOAD_VPATH . "p150x150/" . $img;
				$p50_filepath = UPLOAD_VPATH . "p50x50/" . $img;
				if (is_file($filepath))
				{
					unlink($filepath);
				}
				if (is_file($p300_filepath))
				{
					unlink($p300_filepath);
				}
				if (is_file($p150_filepath))
				{
					unlink($p150_filepath);
				}
				if (is_file($p50_filepath))
				{
					unlink($p50_filepath);
				}
			}
			echo 'ok';
			exit;
		}
		return false;
	}

	/*** Attachments ***/
	function save_attachment() {
		$res['upload_status'] = 0;
		
		if ($_FILES['attach']['name'] != "") {
			$attach = upload_vfile('attach','att');
			if (!empty($attach['file_name'])) {
				$res['attach_path'] = SITE_VPATH . "attachments/" . $attach['file_name'];
				$res['attach'] = $attach['file_name'].','.str_replace(',', '', $_FILES['attach']['name']);
				$res['file_name'] = str_replace('.', '', $attach['file_name']);
				$res['upload_status'] = 1;
			}
		}
		exit(json_encode($res));
	}
	function remove_attachments() {
		$token=doDecode($this->input->post('pk_key'));
		$attachs=$this->input->post('attachs');
		if(($this->master->getRow('members',array('mem_token'=>$token)) || $token=='admin') && $attachs[0]!='' && count($attachs)>0){
			foreach ($attachs as $key => $att) {
				$filepath = UPLOAD_VPATH . "attachments/" . $att;
				if (is_file($filepath))
				{
					unlink($filepath);
				}
			}
			echo 'ok';
			exit;
		}
		return false;
	}
}
?>