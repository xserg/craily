<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Master extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getRow($table, $where = '', $array = false, $order_by = '') {
        if (!empty($where))
            $this->db->where($where);
             $query = $this->db->get($table);

            if ($array):

                if (!empty($order_by)):
                    $this->db->order_by("id", $order_by);
                endif;
                return (array) $query->row();
            else:
                if (!empty($order_by)):
                    $this->db->order_by("id", $order_by);
                endif;
                return $query->row();
            endif;
       
    }

    public function getRows($table, $where = '', $start = '', $offset = '', $order_by = '') {

        if (!empty($where))
            $this->db->where($where);

        if (!empty($offset)):
            $this->db->limit($offset, $start);
        endif;
        if (!empty($order_by)):
            $this->db->order_by("id", $order_by);
        endif;

        $query = $this->db->get($table);
        // die($this->db->last_query())
        return $query->result();
    }

    public function getRowsArray($table, $where = '', $offset = '', $start = '') {
        if (!empty($where))
            $this->db->where($where);

        if (!empty($offset))
            $this->db->limit($offset, $start);

        $query = $this->db->get($table);

        return $query->result_array();
    }

    public function save($table, $vals, $field = '', $id = '') {
        $this->db->set($vals);
        if (!empty($id)) {
            $this->db->where($field, $id);
            $this->db->update($table);
            return $id;
        } else {
            $query = $this->db->insert($table);
            return $this->db->insert_id();
        }
    }

    public function delete($table, $field = '', $where = '') {
        if (!empty($where)) {
            $this->db->where_in($field, $where);
        }
        $this->db->delete($table);
    }

    public function num_rows($table, $where = '') {
        if (!empty($where))
            $this->db->where($where);
        $query = $this->db->get($table);
        return $query->num_rows();
    }

    public function last_query() {

        return $this->db->last_query();
    }

    public function last_id() {

        return $this->db->insert_id();
    }

    public function last_row($table, $where = '') {
        if (!empty($where)) {
            $this->db->where($where);
        }

        $this->db->order_by('id', "desc");
        $this->db->limit(1);
        $query = $this->db->get($table);
        return $query->row();
    }

    public function query($query, $array = false) {
        $query = $this->db->query($query);
        if ($array) {

            return $query->result_array();
        } else {
            return $query->result();
        }
    }
    public function fetch_row($query, $array = false) {
        $query = $this->db->query($query);
        if ($array) {

            return $query->row_array();
        } else {
            return $query->row();
        }
    }

}

?>