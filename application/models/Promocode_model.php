<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promocode_model extends CRUD_Model {

    public function __construct() {
        parent::__construct();
        $this->table_name='promocode';
        $this->field="id";
    }

    function get_promocode($id='',$where='') {
        if(!empty($id))
            $this->db->where('id', $id);
        if(!empty($where))
            $this->db->where($where);
        $query = $this->db->get($this->table_name);
        return $query->row();
    }

    function get_promocodes($where='',$start = '', $offset = '',$order_by='asc') {
        if(!empty($where))
            $this->db->where($where);
        if (!empty($offset))
            $this->db->limit($offset, $start);
        if (!empty($order_by))
            $this->db->order_by('id',$order_by);
        $query = $this->db->get($this->table_name);
        return $query->result();
    }
    function is_valid_promocode($code,$where='') {
        $this->db->where('code', $code);
        $this->db->where('status', 0);
        if(!empty($where))
            $this->db->where($where);
        $query = $this->db->get($this->table_name);
        return $query->row();
    }
    function total_promocodes($where = '') {
        if(!empty($where))
            $this->db->where($where);
        $query = $this->db->get($this->table_name);
        return $query->num_rows();
    }
   /* function save_promocodes_transaction($vals, $id = '') {
        $this->db->set($vals);
        if ($id != '') {
            $this->db->where('id', $id);
            $this->db->update('promocodes_transactions');
            return $id;
        } else {
            $this->db->insert('promocodes_transactions');
            return $this->db->insert_id();
            
        }
    }
    function get_transactions($where='',$start = '', $offset = '',$order_by='asc') {
        if(!empty($where))
            $this->db->where($where);
        if (!empty($offset))
            $this->db->limit($offset, $start);
        if (!empty($order_by))
            $this->db->order_by('id',$order_by);
        $query = $this->db->get($this->table_name.'_transactions');
        return $query->result();
    }
    function get_trx_detail($id,$where='') {
        $this->db->where('id', $id);
        if (!empty($where))
            $this->db->where($where);
        $query = $this->db->get('promocodes_transactions');
        $row=$query->row();
        if($row)
            $row->promocodes=$this->master->getRows($this->table_name,array('ct_id'=>$row->id));
        return $row;
    }*/
}
?>

