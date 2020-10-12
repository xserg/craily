<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Member_model extends CRUD_Model {
    public function __construct() {
        parent::__construct();
        $this->table_name="members";
        $this->field="mem_id";
    }

    function get_row($value,$field='') {
        $field=$field==''?$this->field:$field;
        $this->db->where($field, $value);
        $query = $this->db->get($this->table_name);
        return $query->row();
    }
    function getMember($mem_id,$where='') {
        if(!empty($where)){
            $this->db->where($where);
        }
        $this->db->where('mem_id', $mem_id);
        $query = $this->db->get($this->table_name);
        return $query->row();
    }

    function update($vals, $where, $value) {
        $this->db->set($vals);
        $this->db->where($where, $value);
        $this->db->update($this->table_name);
        return true;
    }

    function get_row_where($where, $table ) {
        $this->db->where($where);
        if(!empty($table)) {
            $query = $this->db->get($table);
        } else {
            $query = $this->db->get($this->table_name);
        }
        return $query->row();
    }

    function getMembers($where = '', $start = '', $offset = '',$order_by='') {
        if (!empty($where))
            $this->db->where($where);
        if (!empty($order_by))
            $this->db->order_by("mem_id", $order_by);
        if (!empty($offset))
            $this->db->limit($offset, $start);

        $query = $this->db->get($this->table_name);
        return $query->result();
    }

    function get_members_by_order($where = '', $start = '', $offset = '',$order_field='mem_id',$order_by='') {

        $this->db->select("*,(SELECT AVG(rating) FROM `tbl_reviews` `r` WHERE `r`.`mem_id`=`tbl_members`.`mem_id`) as rating");
        if (!empty($where))
            $this->db->where($where);
        if (!empty($order_by))
            $this->db->order_by($order_field, $order_by);
        if (!empty($offset))
            $this->db->limit($offset, $start);

        $query = $this->db->get($this->table_name);
        return $query->result();
    }

    function get_active_members() {

        $this->db->where(array('mem_status'=>1,'mem_verified'=>1));
        $this->db->order_by("mem_id", $order_by);

        $query = $this->db->get($this->table_name);
        return $query->result();
    }

    function  get_students() {
//        Grab all active student list
        $this->db->where(array('mem_status'=>1,'mem_type'=>'student'));
        $query=$this->db->get($this->table_name);
        return $query->result();
    }

    function get_tutor($mem_id) {

        //$this->db->where(array('mem_status'=>1,'mem_verified'=>1,'mem_tutor_verified'=>1,'mem_type'=>'tutor'));
        $this->db->where(array('mem_status'=>1,'mem_type'=>'tutor'));
        $this->db->where("mem_id", $mem_id);

        $query = $this->db->get($this->table_name);
		
        return $query->row();
    }

    /*function delete($mem_id) {
        $this->db->where('mem_id', $mem_id);
        $this->db->delete($this->table_name);
    }

    function save($vals, $mem_id = '') {
        $this->db->set($vals);
        if ($mem_id != '') {
            $this->db->where('mem_id', $mem_id);
            $this->db->update($this->table_name);
            return $mem_id;
        } else {
            $this->db->insert($this->table_name);
            //return $this->db->last_query();
            return $this->db->insert_id();
        }
    }*/

    function oldPswdCheck($mem_id, $mem_pswd) {
        $mem_pswd = doEncode($mem_pswd);
        $this->db->where('mem_id', $mem_id);
        $this->db->where('mem_pswd', $mem_pswd);
        $query = $this->db->get($this->table_name);
        return $query->row();
    }

    function search_members($post, $flag){

        // $this->db->select('mem.*');
        $this->db->from($this->table_name.' mem');
        // $this->db->join('brands b', "b.id = p.brand_id");

        /*if (isset($keywords['gender']) && count($keywords['gender']) > 0) {
            $genders = $keywords['gender'];

            foreach ($genders as $gen) {
                $where_type[] = " (gender LIKE '%$gen%')";
            }
            if (count($where_type) > 0) {
                $where_type_string = @implode(' OR ', $where_type);
            }
            $this->db->where(" ( " . $where_type_string . " ) ", null, false);
        }*/


        /*if (isset($keywords['gender']) && count($keywords['gender']) > 0) {
            $genders = $keywords['gender'];

            foreach ($genders as $gen) {
                $where_type[] = " (p.gender LIKE '%$gen%')";
            }
            if (count($where_type) > 0) {
                $where_type_string = @implode(' OR ', $where_type);
            }
            $this->db->where(" ( " . $where_type_string . " ) ", null, false);
        }*/

        /*if (isset($keywords['cat']) && count($keywords['cat']) > 0) {
            $cats = $keywords['cat'];

            foreach ($cats as $ct) {
                $where_type[] = " (p.cat_id = '$ct')";
            }
            if (count($where_type) > 0) {
                $where_type_string = @implode(' OR ', $where_type);
            }
            $this->db->where(" ( " . $where_type_string . " ) ", null, false);
        }*/



        /*$todate = date('Y-m-d');
        $this->db->where("`mem_id` NOT IN (SELECT mem_id FROM  `tbl_vacation_mods` WHERE vm_status =  '0' AND vm_startdate <=  '$todate' AND vm_enddate >=  '$todate' GROUP BY mem_id)", NULL, FALSE);*/

        $this->db->where('mem.mem_type','tutor');
        //$this->db->where('mem.mem_verified',1);
        $this->db->where('mem.mem_status',1);
	    $this->db->where('mem.mem_stripe_id is NOT NULL');
       // $this->db->where('mem.mem_tutor_verified',1);
        if (isset($post['lessontype']) && $post['lessontype'] == 1){
            $this->db->where('mem.mem_onlinelesson', 1);
            unset($post['distance']);
            unset($post['distance_max']);
            unset($post['zip']);
            unset($post['lat']);
            unset($post['lng']);
        }
        if (isset($post['gender']) && $post['gender']!="all"){
            $this->db->where('mem.mem_sex', $post['gender']);
        }

        if (isset($post['background']) && $post['background']=="on"){
            $this->db->where('mem.mem_cover_image !=', null);
        }
        if (isset($post['photo']) && $post['photo']=="on"){
            $this->db->where('mem.mem_image !=' , null);
        }
        if (isset($post['education']) && $post['education']!="all")
        {
            $this->db->where('mem.highest_level_of_education <=' , $post['education']);
        }
        
        if (!empty($post['zip']))
        {
            $this->db->where('mem.mem_zip', $post['zip']);
            // $this->db->where('mem.mem_zip', $post['zip']);
            /*$coordinates=get_location_detail($post['zip']);
            $post['lat']=$coordinates->Latitude;
            $post['lng']=$coordinates->Longitude;*/
        }

        if (!empty($post['subject'])){
            $this->db->join('tutor_subjects tsub', "tsub.mem_id = mem.mem_id");
            $this->db->group_start()
            ->where("subject_id in(select id from tbl_subjects where name like '".$this->db->escape_like_str($post['subject'])."%')")
            ->or_like('mem.mem_major_subject', $post['subject'], 'both')
            ->group_end();
        }

        if (!empty($post['hourly_min']) || !empty($post['hourly_max'])) {
            $ary = explode(';', $post['price']);
            $min_price = floatval(trim($post['hourly_min']));
            $max_price = floatval(trim($post['hourly_max']));
            $this->db->where("( mem.mem_hourly_rate >= $min_price  AND mem.mem_hourly_rate <= $max_price ) ", null, false);
        }
        if (!empty($post['distance_max']) && !empty($post['distance_min']) && !empty($post['lat']) && !empty($post['lng'])) {
            $maxDistance=intval($post['distance_max']);
			$minDistance=intval($post['distance_min']);
            $this->db->select("mem.*,(SELECT sum(hours) FROM tbl_lessons WHERE tutor_id=mem.mem_id and (completed=2 or completed=1)) as total_time,
            (69.0 * DEGREES(ACOS(COS(RADIANS({$post['lat']}))
                      * COS(RADIANS(mem.mem_map_lat))
                      * COS(RADIANS({$post['lng']}) - RADIANS(mem.mem_map_lng))
                        + SIN(RADIANS({$post['lat']}))
                      * SIN(RADIANS(mem.mem_map_lat))))) AS distance
                        ");
            $this->db->having('mem_travel_radius>=distance');
            $this->db->having('distance<=', $maxDistance);
            $this->db->having('distance>=', $minDistance);
            // $this->db->having("(mem_travel_radius>=distance and distance<=$d)");

        }
        else
            $this->db->select('mem.*,(SELECT sum(hours) FROM tbl_lessons WHERE tutor_id=mem.mem_id and (completed=2 or completed=1)) as total_time ');
        /*if (!empty($post['zip']))
            $this->db->or_having('mem.mem_zip', $post['zip']);*/

        if (!empty($post['day']) || count($post['days']) > 0) {
            if($flag == 1)
            {
                $this->db->join('tutor_timings tt', "tt.mem_id = mem.mem_id and tt.available=1");
                if(count($post['days']) > 0 && $post['days'][0]!='')
                    $this->db->where_in('tt.day', $post['days']);
            }
        }


        if (!empty($post['sort']) && in_array($post['sort'], array('asc','desc')))
            $this->db->order_by('mem.mem_hourly_rate', $post['sort']);

        $this->db->group_by('mem.mem_id');

        $query = $this->db->get();
        $rows=array();
        foreach ($query->result() as $key => $row) {
            $rows[$key]=$row;
            // $rows[$key]->total_favorites=$this->total_favorites($row->id);
        }
        return $rows;
    }

    function check_timing($mem_id='')
    {
        $this->db->where('mem_id', $mem_id);
        $this->db->where('available', 1);
        $query = $this->db->get('tutor_timings');
        return $query->row();
    }


    function changeStatus($mem_id) {
        $this->db->where('mem_id', $mem_id);
        $query = $this->db->get($this->table_name);
        $rs = $query->row();

        if ($rs->mem_status == '0') {
            $vals['mem_status'] = '1';
        } else {
            $vals['mem_status'] = '0';
        }
        $this->db->set($vals);
        $this->db->where('mem_id', $mem_id);
        $this->db->update($this->table_name);
        return $vals['mem_status'];
    }


    function emailExists($mem_email,$mem_id=0) {
        $this->db->where('mem_email', $mem_email);
        $this->db->where('mem_id <> ' . $mem_id);
        $query = $this->db->get($this->table_name);
        return $query->row();
    }

    function getId() {
        $this->db->where('mem_email', $mem_email);
        $this->db->select('mem_id');
        $query = $this->db->get($this->table_name);
        return $query->row()->mem_id;
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

    function phoneExists($mem_phone,$mem_id=0) {
        $this->db->where('mem_phone', $mem_phone);
        $this->db->where('mem_id <> ' . $mem_id);
        $query = $this->db->get($this->table_name);
        return $query->row();
    }

    function forgotEmailExists($mem_email) {
        $this->db->where('mem_email', $mem_email);
        $this->db->where('mem_status', '1');
        // $this->db->where('mem_verified', '0');
        $query = $this->db->get($this->table_name);
        return $query->row();
    }

    function memberExists($mem_keyword) {
        $this->db->where('mem_email', $mem_keyword);
        $this->db->or_where('mem_username', $mem_keyword);
        $query = $this->db->get($this->table_name);
        return $query->row();
    }

    function usernameExists($mem_username) {
        $this->db->where('mem_username', $mem_username);
        $query = $this->db->get($this->table_name);
        return $query->row();
    }

    function ipExists($mem_id, $mem_ip) {
        if (!empty($mem_ip)) {
            $this->db->where("mem_id <> " . $mem_id);
            $this->db->where('mem_ip', $mem_ip);
            $query = $this->db->get($this->table_name);
            if ($query->row())
                return true;
        }
        return false;
    }

    function socialIdExists($mem_type, $mem_id) {
        $this->db->where('mem_social_type', $mem_type);
        $this->db->where('mem_social_id', $mem_id);
        $query = $this->db->get($this->table_name);
        return $query->row();
    }

    function getMemCode($mem_code,$mem_id=0) {
        if($mem_id>0)
            $this->db->where('mem_id', $mem_id);
        $this->db->where('mem_code', $mem_code);
        $query = $this->db->get($this->table_name);
        return $query->row();
    }

    function authenticate($mem_email, $mem_pswd, $mem_type = NULL) {
        $mem_pswd = doEncode($mem_pswd);
        if (!empty($mem_type))
            $this->db->where('mem_type', $mem_type);

        $this->db->where('mem_email', $mem_email);
        $this->db->where('mem_pswd', $mem_pswd);
        // $this->db->where('mem_status', '1');
        $query = $this->db->get($this->table_name);
        // return $this->db->last_query();
        return $query->row();
    }
    function update_last_login($id,$token='') {
        /*$this->db->where('mem_id', $id);
        $query = $this->db->get($this->table_name);
        $rs = $query->row();*/

        // $this->session->set_userdata('last_login',array('ip'=>$rs->site_ip,'time_date'=>$rs->site_lastlogindate));

        // $vals['mem_ip'] = $_SERVER["REMOTE_ADDR"];
        if(!empty($token))
            $vals['mem_remember'] = $token;

        $vals['mem_token'] = $this->session->session_id;
        $vals['mem_last_login'] = date('Y-m-d h:i:s');
        $this->save($vals, 'mem_id', $id);
    }

    function get_max_rate() {
        $this->db->select_max('mem_hourly_rate');
        $query = $this->db->get($this->table_name);
        return floatval($query->row()->mem_hourly_rate);
    }

    function get_max_distance() {
        $this->db->select_max('mem_travel_radius');
        $query = $this->db->get($this->table_name);
        return floatval($query->row()->mem_travel_radius);
    }

    // White Video Call
    function getDetails($tbl_name,$where)
    {
        $this->db->where($where);
        $query = $this->db->get($tbl_name);
        // return $query->result();
        return $query->row();
    }
    function updateMemberSession($tbl_name,$where,$data)
    {
      $this->db->set($data);
      $this->db->where($where);
      $this->db->update($tbl_name);
    }
   // function getChatMessage($tbl_name1,$tbl_name2,$id1,$id2,$where1,$where2)
    function getChatMessage($SQL)
    {
         $query = $this->db->query($SQL);
        return $query->result_array();
    }
    function insertData($table_name,$vals)
    {
        $this->db->set($vals);
        $this->db->insert($table_name);
        //return $this->db->last_query();
        return $this->db->insert_id();
    }
}
?>

