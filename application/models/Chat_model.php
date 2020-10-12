<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Chat_model extends CRUD_Model {

    public function __construct() {
        parent::__construct();
        $this->table_name='chat';
        $this->field="id";
    }

    /*** start admin chat management ***/
    
    function get_chats($start = '', $offset = '',$mem_id = ''){
        $this->db->order_by('time','desc');
        if (!empty($offset))
            $this->db->limit($offset, $start);
        if($mem_id != null){
            $this->db->where('mem_one',$mem_id);
            $this->db->or_where('mem_two',$mem_id);            
        }
        $query = $this->db->get($this->table_name);
        $rows=array();
        foreach ($query->result() as $index => $row) {
            $row->msg_row=$this->get_last_msg($row->id);
            $rows[$index]=$row;
        }
        return $rows;
    }

    // function get_chats($start = '', $offset = ''){
    //     $this->db->order_by('time','desc');
    //     if (!empty($offset))
    //         $this->db->limit($offset, $start);
    //     $query = $this->db->get($this->table_name);
    //     $rows=array();
    //     foreach ($query->result() as $index => $row) {
    //         $row->msg_row=$this->get_last_msg($row->id);
    //         $rows[$index]=$row;
    //     }
    //     return $rows;
    // }

    function chat_search($limit,$start,$search)
    {
        //$mem_id = get_mem_id($search);
        $mem = $this->master->getRow('members', array('mem_fname' => $search));
        if(!$mem->mem_id) {
            $mem = $this->master->getRow('members', array('mem_lname' => $search));
        }
        $query = $this->db->like('mem_one',$mem->mem_id)->or_like('mem_two',$mem->mem_id)->limit($limit,$start)->get($this->table_name);

        if($query->num_rows() > 0)
        {
            $rows=array();
            foreach ($query->result() as $index => $row) {
                $row->msg_row=$this->get_last_msg($row->id);
                $rows[$index]=$row;
            }
            return $rows;
            //return $query->result();  
        }
        else
        {
            return null;
        }
    }

    function posts_search_count($search)
    {
        $query = $this
                ->db
                ->like('mem_one',$search)
                ->or_like('mem_two',$search)
                ->get($this->table_name);
    
        return $query->num_rows();
    } 

    /*
     * Count all records
     */
    public function countAll(){
        $this->db->from($this->table_name);
        return $this->db->count_all_results();
    }

    function get_chat_detail($chat_id) {

        $this->db->where('chat_id',$chat_id);
        $query = $this->db->get('chat_msgs');

        $rows=array();
        foreach ($query->result() as $index => $row) {
            $row->attachments=$this->get_attachments($row->id);
            if($row->msg_type=='lesson')
                $row->lesson=$this->get_admin_chat_lesson($row->id);
            $rows[$index]=$row;
        }
        return $rows;
    }

    function get_admin_chat_lesson($msg_id){
        $this->db->where('msg_id',$msg_id);
        $this->db->limit(1);
        $query=$this->db->get('chat_lessons');

        return $query->row();
    }

    /*** end admin chat management ***/

    function have_chat($mem_id){
        $this->db->group_start()
        ->where('mem_one',$mem_id)
        ->where('mem_two',$this->session->mem_id)
        ->group_end();

        $this->db->or_group_start()
        ->where('mem_one',$this->session->mem_id)
        ->where('mem_two',$mem_id)
        ->group_end();

        $query = $this->db->get($this->table_name);
        // die($this->db->last_query());
        return $query->row();

    }

    function get_last_msg($chat_id){

        $this->db->where('chat_id',$chat_id);
        $this->db->order_by("id", 'desc');
        $this->db->limit(1);
        $query=$this->db->get('chat_msgs');
        /*$row=$query->row();
        if($row)
            $row->attachments=$this->get_attachments($row->id);
        return $row;*/
        return $query->row();
    }

    function get_mem_msgs_list($mem_id) {

        $this->db->where('mem_one',$mem_id);
        $this->db->or_where('mem_two',$mem_id);
        $this->db->order_by("time", 'desc');
        $query = $this->db->get($this->table_name);
        // die($this->db->last_query());
        $rows=array();
        foreach ($query->result() as $index => $row) {
            $row->msg_row=$this->get_last_msg($row->id);
            $rows[$index]=$row;
        }
        return $rows;
    }

    /*** start msgs ***/

    function get_chat_msgs($chat_id) {
        $this->db->where('chat_id',$chat_id);
        $this->db->where("FIND_IN_SET({$this->session->mem_id},no_deleted)>",0);
        $query = $this->db->get('chat_msgs');
        // die($this->db->last_query());
        $rows=array();
        foreach ($query->result() as $index => $row) {
            $row->attachments=$this->get_attachments($row->id);
            if($row->msg_type=='lesson')
                $row->lesson=$this->get_chat_lesson($row->id,$this->session->mem_id);
            $rows[$index]=$row;
        }
        return $rows;
    }

    function save_msg($vals, $id = '') {
        $this->db->set($vals);
        if ($id != '') {
            $this->db->where('id', $id);
            $this->db->update('chat_msgs');
            return $id;
        } else {
            $this->db->insert('chat_msgs');
            return $this->db->insert_id();
        }
    }

    function delete_msg($id){
        $this->db->where('id', $id);
        $this->db->where("FIND_IN_SET({$this->session->mem_id},no_deleted)>",0);
        $query=$this->db->get('chat_msgs');
        $row=$query->row();

        if($row){
            $arr=explode(',', $row->no_deleted);
            $arr=array_diff($arr,array($this->session->mem_id));
            $deleted_string=implode('',$arr);

            $this->db->set('no_deleted',$deleted_string);
            $this->db->where('id', $id);
            $this->db->where("FIND_IN_SET({$this->session->mem_id},no_deleted)>",0);
            $this->db->update('chat_msgs');
            return true;
        }
        return false;
    }

    /*** start attachment ***/

    function get_attachments($msg_id){
        $this->db->where('msg_id',$msg_id);
        $query=$this->db->get('chat_attachments');
        return $query->result();
    }

    function save_attachment($vals, $id = '') {
        $this->db->set($vals);
        if ($id != '') {
            $this->db->where('id', $id);
            $this->db->update('chat_attachments');
            return $id;
        } else {
            $this->db->insert('chat_attachments');
            return $this->db->insert_id();
        }
    }

    /*** end attachment ***/


    /*** start noti msg ***/

    function get_chat_lesson($msg_id,$mem_id){
        $this->db->where('msg_id',$msg_id);
        $this->db->where('mem_id',$mem_id);
        $query=$this->db->get('chat_lessons');
        return $query->row();
    }

    function save_chat_lesson($vals, $id = '') {
        $this->db->set($vals);
        if ($id != '') {
            $this->db->where('id', $id);
            $this->db->update('chat_lessons');
            return $id;
        } else {
            $this->db->insert('chat_lessons');
            return $this->db->insert_id();
        }
    }

    /*** end noti msg ***/



    function get_new_msgs($chat_id) {

        $this->db->where('status','new');
        $this->db->where('sender_id<>',$this->session->mem_id);
        $this->db->where('chat_id',$chat_id);

        $query = $this->db->get('chat_msgs');
        /*$rows=array();
        foreach ($query->result() as $index => $row) {
            $row->attachments=$this->get_attachments($row->id);
            $rows[$index]=$row;
        }
        return $rows;*/
        return $query->result();
    }

    function mark_seen_all($chat_id){
        $this->db->set(array('status'=>'seen'));
        $this->db->where('sender_id<>',$this->session->mem_id);
        $this->db->where('chat_id',$chat_id);
        $this->db->update('chat_msgs');
    }

    function mark_seen($msg_id){
        $this->db->set(array('status'=>'seen'));
        $this->db->where('sender_id<>',$this->session->mem_id);
        $this->db->where('id',$msg_id);
        $this->db->update('chat_msgs');
    }
}
?>

