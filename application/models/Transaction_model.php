<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_model extends CRUD_Model {

    public function __construct() {
        parent::__construct();
        $this->table_name='transactions';
        $this->field="id";
    }

    function save($vals, $field = '', $id = '') {
        $this->db->set($vals);
        if (!empty($id)) {
            $this->db->where($field, $id);
            $this->db->update($this->table_name);
            return $id;
        } else {
            $query = $this->db->insert($this->table_name);
            return $this->db->insert_id();
        }
    }
    
    function get_tutor_transactions($mem_id, $mem_type){
        $this->db->select("trx.*,l.encoded_id,l.lesson_type,m.mem_image,concat(m.mem_fname,' ',m.mem_lname) as mem_name");
        $this->db->from($this->table_name.' trx');
        $this->db->join('lessons l','l.id=trx.lesson_id');

        if($mem_type == 'tutor') 
        {
        	$this->db->join('members m','m.mem_id=l.student_id');
        	$this->db->where("l.tutor_id",$mem_id);
        }
        else {
        	$this->db->join('members m','m.mem_id=l.tutor_id');
        	$this->db->where("l.student_id",$mem_id);
        }

        	
        //$this->db->order_by("trx.id", 'desc');
        $this->db->order_by("trx.date", 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    function get_balance_due($mem_id){
        $this->db->select("sum(amount) as total");
        $this->db->where("mem_id",$mem_id);
        $this->db->where("status",0);
        $row = $this->db->get($this->table_name)->row();
        return floatval(round($row->total, 2));
    }

    function get_tutor_transaction($id,$mem_id){
        $this->db->select("l.*,trx.id as trx_id,trx.date as trx_date,trx.amount as trx_amount,s.name as subject,m.mem_image,concat(m.mem_fname,' ',m.mem_lname) as mem_name,m.mem_email");
        $this->db->from($this->table_name.' trx');
        $this->db->join('lessons l','l.id=trx.lesson_id');
        $this->db->join('members m','m.mem_id=l.student_id');
        $this->db->join('subjects s','s.id=l.subject_id');

        $this->db->where("l.tutor_id",$mem_id);
        $this->db->where("l.id",$id);
        // $this->db->order_by("trx.date",'desc');
        $query = $this->db->get();
        // print_query();
        return $query->row();
    }

    function get_transaction($id){
        $this->db->select("l.*,trx.id as trx_id,trx.date as trx_date,trx.amount as trx_amount,s.name as subject,m.mem_image,concat(m.mem_fname,' ',m.mem_lname) as mem_name,m.mem_email");
        $this->db->from($this->table_name.' trx');
        $this->db->join('lessons l','l.id=trx.lesson_id');
        $this->db->join('members m','m.mem_id=l.student_id');
        $this->db->join('subjects s','s.id=l.subject_id');

        $this->db->where("trx.id",$id);
        $query = $this->db->get();
        // print_query();
        return $query->row();
    }


    /*** start withdraws ***/

    function save_withdraw($vals, $value = '',$field = 'id') {
        $this->db->set($vals);
        if ($value != '') {
            $this->db->where($field, $value);
            $this->db->update('withdraws');
            return $value;
        } else {
            $this->db->insert('withdraws');
            return $this->db->insert_id();
        }
    }

    function get_withdraw($id,$where=''){
        if(!empty($where))
            $this->db->where($where);
        $this->db->where('id',$id);
        $query = $this->db->get('withdraws');
        return $query->row();

    }

    function get_withdraws ($start = '', $offset = '',$order_by='desc'){
        $this->db->where('status',1);
        if (!empty($order_by))
            $this->db->order_by("id", $order_by);
        if (!empty($offset))
            $this->db->limit($offset, $start);

        return $this->db->get('withdraws')->result();
    }

    function get_tutor_withdraws ($mem_id,$start = '', $offset = '',$order_by='desc'){
        // $this->db->where('status',1);
        $this->db->where('mem_id',$mem_id);
        if (!empty($order_by))
            $this->db->order_by("id", $order_by);
        if (!empty($offset))
            $this->db->limit($offset, $start);

        return $this->db->get('withdraws')->result();
    }

    function get_withdraw_request ($start = '', $offset = '',$order_by='desc'){
        $this->db->where('status',0);
        if (!empty($order_by))
            $this->db->order_by("id", $order_by);
        if (!empty($offset))
            $this->db->limit($offset, $start);

        return $this->db->get('withdraws')->result();
    }

    function get_cleared_payouts ($mem_id,$start = '', $offset = '',$order_by='desc'){
        $this->db->where('mem_id',$mem_id);
        $this->db->where('status',1);
        
        if (!empty($order_by))
            $this->db->order_by("id", $order_by);
        if (!empty($offset))
            $this->db->limit($offset, $start);

        return $this->db->get('withdraws')->result();
    }

    function get_processing_payouts ($mem_id,$start = '', $offset = '',$order_by='desc'){
        $this->db->where('mem_id',$mem_id);
        $this->db->where('status',0);
        
        if (!empty($order_by))
            $this->db->order_by("id", $order_by);
        if (!empty($offset))
            $this->db->limit($offset, $start);

        return $this->db->get('withdraws')->result();
    }


    function get_total_payout($mem_id){
        $this->db->select("sum(amount) as total");
        $this->db->where("mem_id",$mem_id);
        $this->db->where("status",1);
        $row = $this->db->get('withdraws')->row();
        return floatval($row->total);
    }
}
?>

