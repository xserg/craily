<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Job_model extends CRUD_Model {

    public function __construct() {
        parent::__construct();
        $this->table_name='jobs';
        $this->field="id";
    }

    /*** start admin***/
    function get_admin_job($id,$where='') {
        $this->db->select("j.*,m.mem_image,concat(m.mem_fname,' ',m.mem_lname) as mem_name");
        $this->db->from($this->table_name.' j');
        $this->db->join('members m','m.mem_id=j.mem_id');

        $this->db->where('j.id', $id);
        if (!empty($where))
            $this->db->where($where);
        $query = $this->db->get();
        return $query->row();
    }
    
    function get_admin_jobs($where='') {
        $this->db->select("j.*,m.mem_image,concat(m.mem_fname,' ',m.mem_lname) as mem_name");
        $this->db->from($this->table_name.' j');
        $this->db->join('members m','m.mem_id=j.mem_id');

        if (!empty($where))
            $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }
    /*** end admin***/

    function get_job($id,$where='') {
        $this->db->select("j.*,m.mem_image,m.mem_fname,m.mem_lname");
        $this->db->from($this->table_name.' j');
        $this->db->join('members m','m.mem_id=j.mem_id');

        $this->db->where('j.id', $id);
        if (!empty($where))
            $this->db->where($where);
        $query = $this->db->get();
        return $query->row();
    }

    function get_mem_jobs($where='',$start = '', $offset = '',$order_by='desc') {
        $this->db->select("j.*,m.mem_image,m.mem_fname,m.mem_lname");
        $this->db->from($this->table_name.' j');
        $this->db->join('members m','m.mem_id=j.mem_id');

        $this->db->where("j.mem_id",$this->session->mem_id);

        // $this->db->where("l.lesson_date_time>=",date('Y-m-d h:i'));
        if (!empty($where))
            $this->db->where($where);
        if (!empty($order_by))
            $this->db->order_by('j.date', $order_by);
        if (!empty($offset)) {
            $this->db->limit($offset, $start);
        }
        $query = $this->db->get();
        return $query->result();
    }



    function total_mem_jobs($where) {
        $this->db->select("count(id) as total");
        $this->db->from($this->table_name.' j');
        $this->db->join('members m','m.mem_id=j.mem_id');
        // $this->db->where("j.mem_id",$this->session->mem_id);
        $this->db->where($where);
        $query = $this->db->get();
        return intval($query->row()->total);
    }

    function search_job($post){
        $this->db->from($this->table_name.' j');
        $this->db->join('members m','m.mem_id=j.mem_id');
        $this->db->where("status",1);

        if (!empty($post['subject'])){
            $this->db->group_start()
            ->like('title', $post['subject'], 'both')
            ->or_like('subject', $post['subject'], 'both')
            ->group_end();
        }

        if (!empty($post['price'])) {
            $ary = explode(';', str_replace('$', '', $post['price']));
            $min_price = floatval(trim($ary[0]));
            $max_price = floatval(trim($ary[1]));
            $this->db->where("( budget >= $min_price  AND budget <= $max_price ) ", null, false);
        }
        
        if (count($post['grades']) > 0  && $post['grades'][0]!='')
            $this->db->where_in('grade_level', $post['grades']);

        if (!empty($post['zip'])) {
            // $this->db->where('zip', $post['zip']);
            $coordinates=get_location_detail($post['zip']);
            $post['lat']=$coordinates->Latitude;
            $post['lng']=$coordinates->Longitude;
        }
        if (!empty($post['distance']) && !empty($post['lat']) && !empty($post['lng'])) {
            $d=intval($post['distance']);
            $this->db->select("j.*,m.mem_image,m.mem_fname,m.mem_lname,
            (69.0 * DEGREES(ACOS(COS(RADIANS({$post['lat']}))
                      * COS(RADIANS(map_lat))
                      * COS(RADIANS({$post['lng']}) - RADIANS(map_lng))
                        + SIN(RADIANS({$post['lat']}))
                      * SIN(RADIANS(map_lat))))) AS distance
                        ");
            $this->db->having('distance<=',  $d);
        }
        else
            $this->db->select("j.*,m.mem_image,m.mem_fname,m.mem_lname");

        if (!empty($post['sort']) && in_array($post['sort'], array('asc','desc'))) 
            $this->db->order_by('budget', $post['sort']);

        $query = $this->db->get();
        return $query->result();
    }
    
    /*function view($id){
        $this->db->set('views', 'views+1', FALSE);
        $this->db->where('id', $id);
        $this->db->update($this->table_name);
    }*/
}
?>

