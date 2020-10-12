<?php

class Lecture extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('member_model');
      //  date_default_timezone_set('Asia/Kolkata');
       // echo date("Y-m-d H:i:s");die;
    }

    function index() {
        $this->load->library("OpenTok/OpenTok");
        $OT                         =    new OpenTok(OpenTok_API_KEY, OpenTok_SECRET_KEY);
        if(empty($this->session->mem_id))
        {
            showMsg('error','You can not start session lecture');
            redirect('my-lessons', 'refresh');
        }
        $data['member_id']   = $this->session->mem_id;
        $data['member_type'] = $this->session->mem_type;
        $data['member_name'] = format_name($this->session->mem_fname,$this->session->mem_lname);
        if($data['member_type']=='student')
        {
           $where = array('student_id'=>$data['member_id']);
        }else if($data['member_type']=='tutor')
        {
            $where = array('tutor_id'=>$data['member_id']);
        }
        $data['socket_url']='';
        $data['sessionData']=$this->member_model->getDetails('tbl_chat_video_class',$where);
        if(!empty( $data['sessionData']))
        {
            $where_setting = array('type'=>'socket_url');
            $socketdetails=$this->member_model->getDetails('tbl_sitecontent',$where_setting);
            if(!empty($socketdetails))
            {
                $data['socket_url'] = $socketdetails[0]->code;
            }
            if(empty($data['sessionData'][0]->session_id))
            {
                $OT->generate_session_id(array('mediaMode' => 'Routed'));
                $sessionid                   = (array)$OT->sessionId;
                $datasession['session_id']   = isset($sessionid[0])?$sessionid[0]:'';
                $res= $this->member_model->updateMemberSession('tbl_chat_video_class',$where,$datasession);
            }
           
          //  $chats = $this->getChatMessage($data['sessionData'][0]->student_id,$data['sessionData'][0]->tutor_id);
         //   $data['chatMsg'] = $chats;
            $data['openTok_sessionId']   = $data['sessionData'][0]->session_id;
            $data['openTok_apiKey']      = OpenTok_API_KEY;
            $OT->generate_token($data['openTok_sessionId']);
            $data['openTok_token']       = isset($OT->token)?$OT->token:''; 
            $this->load->view("lecture/index",$data);
        }else{
            showMsg('error','You can not start session lecture');
            redirect('my-lessons', 'refresh');
        }
    }
   public function getchatmessage($mem1,$mem2,$sessionId)
   {
    
     $sql="SELECT mem_one,mem_two,tbl_chat.time,sender_id,msg,msg_type FROM `tbl_chat` join tbl_chat_msgs on tbl_chat_msgs.chat_id=tbl_chat.id where ((mem_one='".$mem1."' and mem_two='".$mem2."') or(mem_one='".$mem2."' and mem_two='".$mem1."')) and tbl_chat_msgs.session_id='".$sessionId."' order by tbl_chat.time desc";
         $chatMsg=$this->member_model->getChatMessage($sql);
         $txthtml='';
         if(!empty($chatMsg))
         {
           
            $download = base_url('assets/lecture/images/download-ic.png');
            $pdf      = base_url('assets/lecture/images/pdf-ic.png');
           foreach($chatMsg as $chat)
             {
                $msg  = $chat['msg'];
                
                $time = date("g:i a",$chat['time']);
               if(intval($chat['sender_id'])==intval($mem1))
                  {
                   
                    if($chat['msg_type']=='attachment')
                    {
                        $file_parts = pathinfo($msg);
                        if($file_parts['extension']=='docx' || $file_parts['extension']=='PDF' || $file_parts['extension']=='pdf')
                        {
                            $txthtml .= "<div class='sent-msg clearfix'>
                                    <div class='attachment text-right w-100'>
                                                <div class='file d-inline-block mr-3'>
                                                    <img src='$pdf' alt='download' class='mCS_img_loaded'>
                                                </div>
                                                <a download href='$msg' class='download d-inline-block'>
                                                    <img  src='$download' alt='download' class='mCS_img_loaded'>
                                                </a>
                                        </div>
                                        <div class='time'>$time</div>
                                    </div>";
                        }else{
                            $txthtml .= "<div class='sent-msg clearfix'>
                                    <div class='attachment text-right w-100'>
                                                <div class='file d-inline-block mr-3'>
                                                    <img width='180' src='$msg' alt='download' class='mCS_img_loaded'>
                                                </div>
                                                <a download href='$msg' class='download d-inline-block'>
                                                <img  src='$download' alt='download' class='mCS_img_loaded'>
                                            </a>
                                        </div>
                                        <div class='time'>$time</div>
                                    </div>";
                        }
                        
                    }else{
                        $txthtml .= "<div class='sent-msg clearfix'>
                                        <div class='msg'>$msg</div>
                                        <div class='time'>$time</div>
                                    </div>";
                    }
                 
                  }
                  else if($chat['sender_id']==$mem2)
                  {
                    
                    if($chat['msg_type']=='attachment')
                    {
                        $file_parts = pathinfo($msg);
                        if($file_parts['extension']=='docx' || $file_parts['extension']=='PDF' || $file_parts['extension']=='pdf')
                        {
                        $txthtml .= "<div class='rcv-msg clearfix'>
                                    <div class='attachment text-left w-100'>
                                            <a download href='$msg' class='download d-inline-block ml-3' >
                                                <img  src='$download' alt='download' class='mCS_img_loaded'>
                                            </a>
                                            <div class='file d-inline-block' >
                                                <img src='$pdf' alt='download' class='mCS_img_loaded'>
                                            </div>
                                        </div>
                                        <div class='time'>$time</div>
                                   </div>";
                        }else{
                            $txthtml .= "<div class='rcv-msg clearfix'>
                                        <div class='attachment text-left w-100'>
                                                <a download href='$msg' class='download d-inline-block'>
                                                    <img  src='$download' alt='download' class='mCS_img_loaded'>
                                                </a>
                                                <a  href='javascript:void(0);' class='download d-inline-block ml-3'>
                                                    <img width='180' src='$msg' alt='download' class='mCS_img_loaded'>
                                                </a>
                                            </div>
                                            <div class='time'>$time</div>
                                    </div>";
                        }
                    }else{
                        $txthtml .= "<div class='rcv-msg clearfix'>
                                        <div class='msg'>$msg</div>
                                        <div class='time'>$time</div>
                                    </div>";
                    }
                   
                  }
             }
         } 
        echo $txthtml;die();
   }
  public function fileUpload()
  {
      if(!empty($_FILES['file']['name']))
      {
        
          $time       = $_POST['times'];
          $target_dir = "./uploads/chat/";
          $new_name = time().$_FILES["file"]['name'];
          $file_parts = pathinfo($new_name);
          $target_file = $target_dir . $new_name;
          if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
              $filepath =base_url('uploads/chat/'.$new_name);
            $post  = array('status'=>1,'message'=>'','path'=>$filepath,'extension'=>$file_parts['extension']);
        } else {
            $post  = array('status'=>1,'message'=>"Sorry, there was an error uploading your file.",'path'=>'','extension'=>'');
         }
         echo json_encode($post);
        
      }
  }
    
}

?>