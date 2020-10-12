<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Grade_level_model extends CRUD_model {

    public function __construct() {
    	parent::__construct();
        $this->table_name="job_grade_levels";
        $this->field="id";
    }
}
?>

