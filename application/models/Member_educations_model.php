<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member_educations_model extends CI_Model {

    private $table_name="member_educations";
    public function __construct() {
        $this->load->database();
    }

    function getText($id) {
        $this->db->where('id', $id);
        $query = $this->db->get($this->table_name);
        return $query->row();
    }

    function getTextValue($txt_key) {
        $this->db->select('txt_value');
        $this->db->where('txt_key', $txt_key);
        $query = $this->db->get($this->table_name);
        return $query->row()->txt_value;
    }

    function getTexts($txt_type = '', $where = '', $start = '', $offset = '') {
        if (!empty($txt_type)) {
            $this->db->where('txt_type', $txt_type);
        }
        if (!empty($where)) {
            $this->db->where($where);
        }
        if (!empty($offset)) {
            $this->db->limit($offset, $start);
        }
        $query = $this->db->get($this->table_name);
        return $query->result();
    }

    function changeStatus($id) {
        $this->db->where('id', $id);
        $query = $this->db->get($this->table_name);
        $rs = $query->row();

        if ($rs->txt_status == '0') {
            $vals['txt_status'] = '1';
        } else {
            $vals['txt_status'] = '0';
        }
        $this->db->set($vals);
        $this->db->where('id', $id);
        $this->db->update($this->table_name);
        return $vals['txt_status'];
    }
	function getRecordMemberwise($memid) {
		
        $this->db->where('mem_id', $memid);
        $query = $this->db->get($this->table_name);
        return $query->result();
    }
    function save($vals, $id = '') {
        $this->db->set($vals);
        if ($id != '') {
            $this->db->where('id', $id);
            $this->db->update($this->table_name);
        } else {
            $this->db->insert($this->table_name);
        }
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table_name);
    }

    function deleteMemberwise($memid) {
        $this->db->where('mem_id', $memid);
        $this->db->delete($this->table_name);
    }
}

?>