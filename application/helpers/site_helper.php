<?php

$CI = & get_instance();

function get_lesson_status($status) {
    if ($status == 0)
        return '<span class="miniLbl gray">Pending</span>';
    elseif ($status == 1)
        return '<span class="miniLbl yellow">Accepted</span>';
    else if ($status == 2)
        return '<span class="miniLbl green">Booked</span>';
    else
        return '<span class="miniLbl red">Declined</span>';
}

function get_completed_status($status) {
    if ($status == 1)
        return '<span class="miniLbl yellow">Pending</span>';
    else if ($status == 2)
        return '<span class="miniLbl green">Completed</span>';
    
}

function get_background_check($id) {
	$CI = get_instance();
    return $CI->master->last_row('background_check_info', array('tutor_id' => $id));
}

function count_panding_withdraws(){
    global $CI;
    return $CI->master->num_rows('withdraws',array('status'=>0));
}
function count_tutor_applications(){
    global $CI;
    return $CI->master->num_rows('members',array('mem_type'=>'student','mem_tutor_application'=>1));
}
function tutor_hours_tutored($tutor_id){
    global $CI;
    $CI->db->select_sum("hours","total_time");
    $CI->db->where('tutor_id',$tutor_id);
    $CI->db->group_start()
    ->where("completed",2)
    ->or_where("completed",1)
    ->group_end();
    $query = $CI->db->get('lessons');
    return round($query->row()->total_time,1);
}
function total_tutor_lessons($tutor_id,$student_id=0){
    global $CI;
    $CI->db->select("count(id) as total");
    $CI->db->where('tutor_id',$tutor_id);
    $CI->db->where("status",2);
    $CI->db->where("completed",2);
    if(!empty($student_id))
        $CI->db->where("student_id",$student_id);
    $query = $CI->db->get('lessons');
    return intval($query->row()->total);
}

function subjects() {
    
    global $CI;
    // $CI = get_instance();
    $CI->db->where('status',1);
    $CI->db->where('parent_id',0);
    $query = $CI->db->get('subjects');
    $subjects =  $query->result();

    $options="";
    foreach ($subjects as $key => $row) {
        $options.='<option value="'.$row->id.'">'.$row->name.'</option>';
    }
    return $options;
}

function get_subjects($parent_id='',$limit=0,$option=false,$type='id',$selected='', $mem_id='') {
    global $CI;
    // $CI = get_instance();
    $CI->db->where('status',1);
    if ($parent_id!=='')
        $CI->db->where('parent_id',$parent_id);
    if ($mem_id!=='')
        $CI->db->where('encoded_id',$mem_id);
    if ($limit>0)
        $CI->db->limit($limit);

    $query = $CI->db->get('subjects');
    if(!$option)
        return $query->result();

    $options="";
    $rows=$query->result();

    foreach ($rows as $key => $row) {
        $options.='<option value="'.$row->{$type}.'"'.($selected!='' && ($selected==$row->id || $selected==$row->slug || $selected==$row->name)?' selected':'').'>'.$row->name.'</option>';
    }
    return $options;
}

//***** PERMISSIONS*******///
function has_access($permission_id=0){
    $CI = get_instance();
    if(is_admin())
        return true;
    if(!in_array($permission_id,$CI->session->permissions)){
    // if($permission_id>0 && !is_admin() && !in_array($permission_id,$CI->session->userdata('permissions'))){
        show_404();
        exit;
    }
    return $CI->session->loged_in['id'];
}
function access($permission_id){
    $CI = get_instance();
    if(is_admin()) return true;
    return in_array($permission_id,$CI->session->permissions);
}
function is_admin(){
    $CI = get_instance();
    return $CI->session->loged_in['admin_type']=='admin' ? true : false;
}
function has_permissions($permission_id,$id=0) {
    $CI = get_instance();
    if($id<1)
        $id=$CI->session->loged_in['id'];
    return $CI->master->getRow('permissions_admin', array('permission_id' => $permission_id,'admin_id'=>$id));
}
//***** end PERMISSIONS*******///

function get_location_detail($zipcode,$country='usa'){
    $url = 'https://geocoder.api.here.com/6.2/geocode.json?app_id=zMqasMt9e2HnC28OQFGp&app_code=4-A9YcfKd0rTg1PY1YxCJQ%20&searchtext='.$country.'%20'.$zipcode;
    $headers = array(
        'Accept: application/json',
        'Content-Type: application/json');
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $data = curl_exec($ch);
    if (curl_error($ch)) {
        echo $error_msg = curl_error($ch);
    }
    curl_close($ch);
    $response = json_decode($data);
            // pr($response->Response->View[0]->Result[0]->Location);
    return $response->Response->View[0]->Result[0]->Location->DisplayPosition;
    /*echo $response->Response->View[0]->Result[0]->Location->DisplayPosition->Latitude.'<br>';
    echo $response->Response->View[0]->Result[0]->Location->DisplayPosition->Longitude*/;
}
?>