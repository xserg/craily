<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Notification_model extends CRUD_model {

    public function __construct(){
    	parent::__construct();
        $this->table_name="notifications";
        $this->field="id";
    }
    function get_notification($id,$mem_id='') {
        $this->db->select("n.*,concat(mem_fname,' ',mem_lname) as mem_name,mem_image");
        $this->db->from($this->table_name.' n');
        $this->db->join('members m','n.mem_id=m.mem_id');
        $this->db->where('n.id',$id);
        if(!empty($mem_id))
            $this->db->where('n.mem_id',$mem_id);
        $query = $this->db->get();
        return $query->row();
    }

    function get_notifications($where='',$start = '', $offset = '',$order_by='desc') {
        $this->db->select("n.*,concat(mem_fname,' ',mem_lname) as mem_name,mem_image,mem_type");
        $this->db->from($this->table_name.' n');
        $this->db->join('members m','n.from_id=m.mem_id');

        if(!empty($where))
            $this->db->where($where);

        if (!empty($order_by))
            $this->db->order_by("n.id", $order_by);
        if (!empty($offset))
            $this->db->limit($offset, $start);

        return $this->db->get()->result();
    }

    /*function get_note_notifications($where='',$start = '', $offset = '',$order_by='desc') {
        $this->db->select("n.*,nt.ref_id,nt.ref_type,nt.title,nt.detail,nt.image,nt.status as note_status,concat(mem_fname,' ',mem_lname) as mem_name,mem_image");
        $this->db->from($this->table_name.' n');
        $this->db->join('notes nt',"nt.id=n.note_id");
        $this->db->join('members m','m.mem_id=n.from_id');

        if(!empty($where))
            $this->db->where($where);

        if (!empty($order_by))
            $this->db->order_by("n.id", $order_by);
        if (!empty($offset)) {
            $this->db->limit($offset, $start);
        }
        return $this->db->get()->result();
    }
    
    function get_all_notifications($where='',$start = '', $offset = '',$order_by='desc') {
        $this->db->select("n.*,nt.ref_id,nt.ref_type,nt.title,nt.detail,nt.image,nt.status as note_status,concat(mem_fname,' ',mem_lname) as mem_name,mem_image");
        $this->db->from($this->table_name.' n');
        $this->db->join('members m','m.mem_id=n.from_id');
        $this->db->join('notes nt',"nt.id=n.note_id",'left');

        if(!empty($where))
            $this->db->where($where);

        if (!empty($order_by))
            $this->db->order_by("n.id", $order_by);
        if (!empty($offset)) {
            $this->db->limit($offset, $start);
        }
        return $this->db->get()->result();
    }

    function count_notifications($comic_id){
        $this->db->select("count(n.id) as total");
        $this->db->from($this->table_name.' n');
        $this->db->join('members m','n.from_id=m.mem_id');
        
        $query = $this->db->get();
        return intval($query->row()->total);
    }

    function get_review_comments($start = '', $offset = '',$order_by='desc') {
        $this->db->select("c.*,concat(mem_fname,' ',mem_lname) as mem_name,mem_image");
        $this->db->from($this->table_name.' c');
        $this->db->join('members m','m.mem_id=c.mem_id');
        $this->db->where('c.status',0);

        if (!empty($order_by))
            $this->db->order_by("c.id", $order_by);
        if (!empty($offset)) {
            $this->db->limit($offset, $start);
        }
        return $this->db->get()->result();
    }

    function get_episode_comments($ref_id,$parent_id='',$start = '', $offset = '',$order_by='asc') {
        $this->db->select("c.*,concat(mem_fname,' ',mem_lname) as mem_name,mem_image,(select count(*) FROM `tbl_favorites` where ref_id=c.id and ref_type='comment') total_likes");
        $this->db->from($this->table_name.' c');
        $this->db->join('members m','c.mem_id=m.mem_id');
        $this->db->where('c.ref_id',$ref_id);
        $this->db->where('c.ref_type','episode');

        if (!empty($parent_id))
            $this->db->where('c.parent_id',$parent_id);
        if (!empty($order_by))
            $this->db->order_by("c.id", $order_by);
        if (!empty($offset)) {
            $this->db->limit($offset, $start);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function get_chapter_comments($ref_id,$parent_id=0,$start = '', $offset = '',$order_by='asc') {
        $this->db->select("c.*,concat(mem_fname,' ',mem_lname) as mem_name,mem_image,(select count(*) FROM `tbl_favorites` where ref_id=c.id and ref_type='comment') total_likes");
        $this->db->from($this->table_name.' c');
        $this->db->join('members m','c.mem_id=m.mem_id');
        $this->db->where('c.ref_id',$ref_id);
        $this->db->where('c.ref_type','chapter');

        $this->db->where('c.parent_id',$parent_id);
        if (!empty($order_by))
            $this->db->order_by("c.id", $order_by);
        if (!empty($offset)) {
            $this->db->limit($offset, $start);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function is_valid_reply_id($id,$ref_id,$ref_type){
        $this->db->where('id',$id);
        $this->db->where('ref_id',$ref_id);
        $this->db->where('ref_type',$ref_type);
        $this->db->where('parent_id',0);
        $query=$this->db->get($this->table_name);
        return $query->row();
    }

    function is_valid_delete($id){
        if($row=$this->get_row($id)){
            $model_name=$row->ref_type.'_model';
            $this->load->model($model_name,'type_model');
            $function_name='get_'.$type;
            if($row->mem_id==$this->session->mem_id || $this->type_model->$function_name($row->$ref_id,array('c.mem_id'=>$this->session->mem_id)))
                return $row;
        }
        return false;
    }

    function is_editable($id){
        return $this->get_row_where(array('id'=>$id,'mem_id'=>$this->session->mem_id));
    }

    function save_comment($ref_id,$ref_type,$mem_id,$comment,$parent_id=''){
        $comment_vals=array('mem_id'=>$mem_id,'ref_id'=>$ref_id,'ref_type'=>$ref_type,'comment'=>$comment);
        if(!empty($parent_id))
            $comment_vals['parent_id']=$parent_id;
        $this->master->save('comments',$comment_vals);
    }

    function delete_comment($id){
        $this->db->where('id',$id);
        $this->db->or_where('parent_id',$id);
        $this->db->delete($this->table_name);
        $this->db->query("delete from `tbl_favorites` where ref_type='comment' and ref_id=".$id);
    }*/
}
?>