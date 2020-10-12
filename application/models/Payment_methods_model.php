<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Payment_methods_model extends CRUD_model {

    public function __construct(){
    	parent::__construct();
        $this->table_name="payment_methods";
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

    function get_account($stripe_cust_id = '') {

        if (!empty($stripe_cust_id)) {
            $this->db->where('stripe_customer_id', $stripe_cust_id);
            $query=$this->db->get($this->table_name);
            return $query->row();
        } else {
            return false;
        }
       
    }

    function get_mem_method($id,$mem_id=0){
        $mem_id=$mem_id>0?$mem_id:$this->session->mem_id;
        $this->db->where('mem_id',$mem_id);
        $this->db->where('id',$id);
        $query=$this->db->get($this->table_name);
        return $query->row();
    }

    function get_default_method($mem_id=0){
        $mem_id=$mem_id>0?$mem_id:$this->session->mem_id;
        $this->db->where('mem_id',$mem_id);
        $this->db->where('default_method',1);
        $query=$this->db->get($this->table_name);
        return $query->row();
    }

    function get_methods($mem_id=0){
        $mem_id=$mem_id>0?$mem_id:$this->session->mem_id;
        $this->db->where('mem_id',$mem_id);
        $this->db->order_by('default_method', 'DESC');
        $query=$this->db->get($this->table_name);
        return $query->result();
    }

    function get_credit_cards($mem_id=0){
        $mem_id=$mem_id>0?$mem_id:$this->session->mem_id;
        $this->db->where('mem_id',$mem_id);
        $this->db->where('paypal',NULL);
        $query=$this->db->get($this->table_name);
        return $query->result();
    }

    function clear_table() {
	    $this->db->empty_table($this->table_name);
    }
}
?>