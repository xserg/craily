<?php if ($this->uri->segment(3) == 'manage'): ?>
    <?= showMsg(); ?>
    <?= getBredcrum(ADMIN, array('#' => 'Add/Update Tutors')); ?>
    <div class="row margin-bottom-10">
        <div class="col-md-6">
            <h2 class="no-margin"><i class="entypo-users"></i> Add/Update <strong>Tutors</strong></h2>
        </div>
        <div class="col-md-6 text-right">
            <!--a href="<?= site_url(ADMIN . '/tutors'); ?>" class="btn btn-lg btn-default"><i class="fa fa-arrow-left"></i> Go back</a-->
            <a href="<?= $_SERVER['HTTP_REFERER']; ?>" class="btn btn-lg btn-default"><i class="fa fa-arrow-left"></i> Go back</a>
            <button type="button" class="btn btn-default dropdown-toggle btn-lg" data-toggle="dropdown"> Action <span class="caret"></span></button>
            <ul class="dropdown-menu dropdown-primary" role="menu">
                <?php if ($row->mem_status == '0'): ?>
                    <li><a href="<?= site_url(ADMIN); ?>/tutors/active/<?= $row->mem_id; ?>">Active</a></li>
                <?php else: ?>
                    <li><a href="<?= site_url(ADMIN); ?>/tutors/suspend/<?= $row->mem_id; ?>">Inactive</a></li>
                <?php endif; ?>
                <?php if(access(10)):?>
                    <li><a href="<?= site_url(ADMIN); ?>/tutors/delete/<?= $row->mem_id; ?>" onclick="return confirm('Are you sure?');">Delete</a></li>
                <?php endif?>
            </ul>
        </div>
    </div>
    <div>
        <hr>
        <div class="row col-md-12">
            <form action=""  role="form" class="form-horizontal" method="post" enctype="multipart/form-data">

                <div class="col-md-6">
                    <h3><i class="fa fa-bars"></i> Profile Detail</h3>
                    <hr class="hr-short">
                    <?php if (isset($row->mem_fname)):?>
                        <div style="font-size: 13px"><b>Member Since:</b> <small> <?= format_date($row->mem_date); ?></small></div>
                        <div style="font-size: 13px"><b>Last Login:</b> <small> <?= format_date($row->mem_last_login,'M d Y h:i:s A'); ?></small></div>
                    <?php endif?>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label"> First Name <span class="symbol required">*</span></label>
                            <input type="text" name="mem_fname" value="<?php if (isset($row->mem_fname)) echo $row->mem_fname; ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label"> Last Name <span class="symbol required">*</span></label>
                            <input type="text" name="mem_lname" value="<?php if (isset($row->mem_lname)) echo $row->mem_lname; ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label"> Phone Number <span class="symbol required">*</span></label>
                            <input type="text" name="mem_phone" value="<?php if (isset($row->mem_phone)) echo $row->mem_phone; ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label"> Profile Headline</label>
                            <input type="text" name="mem_profile_heading" value="<?php if (isset($row->mem_profile_heading)) echo $row->mem_profile_heading; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label">Profile Bio <span class="symbol required">*</span></label>
                            <!-- <textarea name="mem_bio" id="mem_bio" rows="4" class="form-control ckeditor"><?=$row->mem_about; ?></textarea> -->
                            <!-- <textarea name="mem_bio" id="mem_bio" rows="4" class="form-control ckeditor"><?=$row->mem_bio; ?></textarea> -->
                            <textarea name="mem_about" id="mem_about" rows="4" class="form-control ckeditor"><?=$row->mem_about; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class = "col-md-6">
                            <label class="control-label"> Profile Image <span class="symbol required">*</span></label><br>
                            <img src = "<?= get_image_src($row->mem_image,150,true); ?>" height = "150"><br>
                            <input type = "file" name = "mem_image" id = "mem_image" class = "form-control file2 inline btn btn-primary" data-label = "<i class='fa fa-upload'></i> Browse" />
                            <div><br />
                                <small style = "color:#F00;">* Best resolution is <strong>600 x 600</strong>.</small><br />
                                <small style = " color:#F00;">* Allowed formats are <strong>JPG | JPEG | PNG</strong>.</small><br>
                                <small style = "color:#F00;">* Image size maximum <strong>2MB</strong> allowed.</small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                    	<?php
	                    	$tutorcheck = get_background_check($row->mem_id);
	                    	if(!empty($tutorcheck)) {
                    	?>
	                        <div class="col-md-6">
	                            <label class="control-label"> Background Verified</label>
	                            <select name="mem_verified" id="mem_verified" class="form-control">
	                                <option value="0" <?php
	                                if(!empty($tutorcheck) && $tutorcheck->status == 0) {
	                                	echo 'selected';
	                                }
	                                ?>>No</option>
	                                <option value="1" <?php
	                              	if(!empty($tutorcheck) && $tutorcheck->status == 1) {
	                                	echo 'selected';
	                               	}
	                                ?>>Yes</option>
	                            </select>
	                        </div>
                        <?php } ?>
                        <!--<div class="col-md-6">
                            <label class="control-label"> Verify Email</label>
                            <select name="mem_email_verified" id="mem_email_verified" class="form-control">
                                <option value="0" <?php
                               	/*if (isset($row->mem_email_verified) && '0' == $row->mem_email_verified) {
                                    echo 'selected';
                                }*/
                                ?>>No</option>
                                <option value="1" <?php
                                /*if (isset($row->mem_email_verified) && '1' == $row->mem_email_verified) {
                                    echo 'selected';
                                }*/
                                ?>>Yes</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                       	<div class="col-md-6">
                            <label class="control-label"> Status</label>
                            <select name="mem_status" id="mem_status" class="form-control">
                                <option value="0" <?php
                                //if (isset($row->mem_status) && '0' == $row->mem_status) {
                                   // echo 'selected';
                                //}
                                ?>>InActive</option>
                                <option value="1" <?php
                               // if (isset($row->mem_status) && '1' == $row->mem_status) {
                                  //  echo 'selected';
                                //}
                                ?>>Active</option>
                            </select>
                        </div>-

                        <div class="col-md-6">
                            <label class="control-label"> Featured</label>
                            <select name="mem_featured" id="mem_featured" class="form-control">
                                <option value="0" <?php
                                //if (isset($row->mem_featured) && '0' == $row->mem_featured) {
                                    //echo 'selected';
                               //}
                                ?>>No</option>
                                <option value="1" <?php
                                //if (isset($row->mem_featured) && '1' == $row->mem_featured) {
                                    //echo 'selected';
                                //}
                                ?>>Yes</option>
                            </select>
                        </div>-->
                    </div>
                    
                    <h3><i class="fa fa-bars"></i> Education <a href="javascript:void(0);" onClick="addEducation()" style="float: right;font-size: 14px;margin-top: 7px;">Add New Education</a></h3>
                    <hr class="hr-short">
                    <div class="education-section" data-items="<?php echo count($education); ?>">
                        <?php if ( count($education) > 0 ) {
                            foreach ($education as $eduI => $edu) {?>
                            <div class="form-group education-item item-ind-<?php echo $eduI; ?>" data-index="<?php echo $eduI; ?>">
                                <div class="col-md-12">
                                    <label class="control-label">Unversity/College Name</label>
                                    <input type="text" value="<?php echo $edu->college; ?>" name="edu_name[<?php echo $eduI; ?>]" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label">Degree</label>
                                    <input type="text" value="<?php echo $edu->degree; ?>"  name="edu_degree[<?php echo $eduI; ?>]" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label"> Field of Study</label>
                                    <input type="text" value="<?php echo $edu->study_field; ?>" name="edu_study[<?php echo $eduI; ?>]" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label">From Year</label>
                                    <input type="text" value="<?php echo $edu->from_year; ?>" name="edu_from_year[<?php echo $eduI; ?>]" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label">To Year</label>
                                    <input type="text" value="<?php echo $edu->to_year; ?>" name="edu_to_year[<?php echo $eduI; ?>]" class="form-control">
                                </div>
                            </div>  
                        <?php }
                        } ?>
                    </div>
                    <br>
                    <h3><i class="fa fa-bars"></i> Work Experience <a href="javascript:void(0);" onClick="addWorkExperience()" style="float: right;font-size: 14px;margin-top: 7px;">Add New Work Experience</a></h3>
                    <hr class="hr-short">
                    <div class="experience-section" data-items="<?php echo count($work_experience); ?>">
                        <?php if ( count($work_experience) > 0 ) {
                            foreach ($work_experience as $expI => $exp) {?>
                            <div class="form-group experience-item ex-item-ind-<?php echo $expI; ?>" data-index="<?php echo $expI; ?>">
                                <div class="col-md-12">
                                    <label class="control-label">Company Name</label>
                                    <input type="text" value="<?php echo $exp->company_name; ?>" name="work_company_name[<?php echo $expI; ?>]" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label class="control-label">Job Title</label>
                                    <input type="text" value="<?php echo $exp->title; ?>" name="work_title[<?php echo $expI; ?>]" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label">From Month</label>
                                    <!-- <input type="text" value="<?php echo $exp->from_month; ?>" name="work_from_month[<?php echo $expI; ?>]" class="form-control"> -->
                                    <select class="form-control txtBox" name="work_from_month[<?php echo $expI; ?>]">
                                        <option value="January" <?php echo (($exp->from_month == 'January') ? 'selected="selected"' : ''); ?>>January</option>
                                        <option value="February" <?php echo (($exp->from_month == 'February') ? 'selected="selected"' : ''); ?>>February</option>
                                        <option value="March" <?php echo (($exp->from_month == 'March') ? 'selected="selected"' : ''); ?>>March</option>
                                        <option value="April" <?php echo (($exp->from_month == 'April') ? 'selected="selected"' : ''); ?>>April</option>
                                        <option value="May" <?php echo (($exp->from_month == 'May') ? 'selected="selected"' : ''); ?>>May</option>
                                        <option value="June" <?php echo (($exp->from_month == 'June') ? 'selected="selected"' : ''); ?>>June</option>
                                        <option value="July" <?php echo (($exp->from_month == 'July') ? 'selected="selected"' : ''); ?>>July</option>
                                        <option value="August" <?php echo (($exp->from_month == 'August') ? 'selected="selected"' : ''); ?>>August</option>
                                        <option value="September" <?php echo (($exp->from_month == 'September') ? 'selected="selected"' : ''); ?>>September</option>
                                        <option value="October" <?php echo (($exp->from_month == 'October') ? 'selected="selected"' : ''); ?>>October</option>
                                        <option value="November" <?php echo (($exp->from_month == 'November') ? 'selected="selected"' : ''); ?>>November</option>
                                        <option value="December" <?php echo (($exp->from_month == 'December') ? 'selected="selected"' : ''); ?>>December</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label">From Year</label>
                                    <input type="text" value="<?php echo $exp->from_year; ?>" name="work_from_year[<?php echo $expI; ?>]" class="form-control">
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-12">
                                    <label for="work_currently_<?php echo $expI; ?>" style="margin-top: 5px;">
                                        <input type="checkbox" class="work_currently_check" name="work_currently[<?php echo $expI; ?>]" value="1" id="work_currently_<?php echo $expI; ?>" <?php echo ($exp->is_currently_work ? 'checked="checked"' : '') ?>> I currently work here
                                    </label>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-6 work_currently_<?php echo $expI; ?>" style="<?php echo ($exp->is_currently_work ? 'display: none;' : '') ?>">
                                    <label class="control-label">To Month</label>
                                    <!-- <input type="text" value="<?php echo $exp->to_month; ?>" name="work_to_month[<?php echo $expI; ?>]" class="form-control"> -->
                                    <select class="form-control txtBox" name="work_to_month[<?php echo $expI; ?>]">
                                    <option value="January" <?php echo (($exp->to_month == 'January') ? 'selected="selected"' : ''); ?>>January</option>
                                        <option value="February" <?php echo (($exp->to_month == 'February') ? 'selected="selected"' : ''); ?>>February</option>
                                        <option value="March" <?php echo (($exp->to_month == 'March') ? 'selected="selected"' : ''); ?>>March</option>
                                        <option value="April" <?php echo (($exp->to_month == 'April') ? 'selected="selected"' : ''); ?>>April</option>
                                        <option value="May" <?php echo (($exp->to_month == 'May') ? 'selected="selected"' : ''); ?>>May</option>
                                        <option value="June" <?php echo (($exp->to_month == 'June') ? 'selected="selected"' : ''); ?>>June</option>
                                        <option value="July" <?php echo (($exp->to_month == 'July') ? 'selected="selected"' : ''); ?>>July</option>
                                        <option value="August" <?php echo (($exp->to_month == 'August') ? 'selected="selected"' : ''); ?>>August</option>
                                        <option value="September" <?php echo (($exp->to_month == 'September') ? 'selected="selected"' : ''); ?>>September</option>
                                        <option value="October" <?php echo (($exp->to_month == 'October') ? 'selected="selected"' : ''); ?>>October</option>
                                        <option value="November" <?php echo (($exp->to_month == 'November') ? 'selected="selected"' : ''); ?>>November</option>
                                        <option value="December" <?php echo (($exp->to_month == 'December') ? 'selected="selected"' : ''); ?>>December</option>
                                    </select>
                                </div>
                                <div class="col-md-6 work_currently_<?php echo $expI; ?>" style="<?php echo ($exp->is_currently_work ? 'display: none;' : '') ?>">
                                    <label class="control-label">To Year</label>
                                    <input type="text" value="<?php echo $exp->to_year; ?>" name="work_to_year[<?php echo $expI; ?>]" class="form-control">
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-12">
                                    <label class="control-label">Job Description</label>
                                    <textarea class="form-control" name="work_description[<?php echo $expI; ?>]"><?php echo $exp->description; ?></textarea>
                                </div>
                            </div>  
                        <?php }
                        } ?>
                    </div>
                    <br>
                    <br>

                </div>
                <div class="col-md-6">

                    <div class="col-md-12">
                        <h3><i class="fa fa-bars"></i> Personal Information</h3>
                        <hr class="hr-short">
                        <!-- <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label"> Gender </label>
                                <select id="mem_sex" name="mem_sex" class="form-control">
                                    <option value="" text="Gender">Gender</option>
                                    <option value="male" <?= $row->mem_sex=='male'?'selected':''?>>Male</option>
                                    <option value="female" <?= $row->mem_sex=='female'?'selected':''?>>Female</option>
                                    <option value="other" <?= $row->mem_sex=='other'?'selected':''?>>Other</option>
                                </select>
                            </div>
                        </div> -->
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label"> Hourly Rate $</label>
                                <input type="number" name="mem_hourly_rate" pattern="[0-9]" min="20" max="500" step="5" value="<?php if (isset($row->mem_hourly_rate)) echo $row->mem_hourly_rate; ?>" class="form-control range hourly-input">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label"> School Name</label>
                                <input type="text" name="mem_school_name" value="<?php if (isset($row->mem_school_name)) echo $row->mem_school_name; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label"> Major Subject</label>
                                <input type="text" name="mem_major_subject" value="<?php if (isset($row->mem_major_subject)) echo $row->mem_major_subject; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <?php
                                    $mem_subject = json_decode($row->mem_subjects,true);
                                ?>
                                <label class="control-label"> Subjects</label>
                                <br>
                                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Check Subjects</button>

                                <!-- Modal -->
                                <div id="myModal" class="modal fade" role="dialog">
                                    <div class="modal-dialog modal-lg">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Select Subjects</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="main_for_check">
                                                    <?php $loop = 0; $flag = 0;?>
                                                    <?php foreach($subjects as $key => $subject):?>
                                                        <?php foreach($sub_subjects as $key => $sub_subject) : ?>
                                                            <?php
                                                             $flag = 0;
                                                            if($sub_subject->parent_id == $subject->id ) {
                                                                $flag = 1; break;
                                                            }?>
                                                        <?php endforeach;?>
                                                        <?php if($flag == 1):?>
                                                            <div class="card">
                                                                <div class="card-header" id="heading<?=$subject->id?>">
                                                                    <h5 class="mb-0">
                                                                        <button class="btn btn-link <?=($loop == 0)?'':'collapsed'?>" type="button" data-toggle="collapse" data-target="#collapse<?=$subject->id?>" aria-expanded="<?=($loop == 0)?true:false?>" aria-controls="collapse<?=$subject->id?>">
                                                                            <span class="glyphicon <?=($loop == 0)?'glyphicon-minus':'glyphicon-plus'?>"></span>
                                                                            <?=$subject->name?>
                                                                        </button>
                                                                    </h5>
                                                                </div>
                                                                <div id="collapse<?=$subject->id?>" class="collapse <?=($loop == 0)?'in':''?>" aria-labelledby="heading<?=$subject->id?>" data-parent="#accordionExample">
                                                                    <div class="card-body">
                                                                        <?php foreach($sub_subjects as $key => $sub_subject) { ?>
                                                                            <?php if($sub_subject->parent_id == $subject->id ) {?>
                                                                                <label class="checkbox-inline"><input type="checkbox" name="sub_<?=$subject->id?>[]" class="checkbox_card" value="<?php echo $sub_subject->id; ?>" <?php if (in_array($sub_subject->name, $mem_subject[$subject->name])) { ?> checked <?php } ?>><?php echo $sub_subject->name; ?></label>
                                                                            <?php } ?>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endif;?>
                                                        <?php $loop++;?>
                                                    <?php endforeach;?>
                                                </divd>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label"> Graduation Year</label>
                                <input type="text" name="mem_graduation_year" value="<?php if (isset($row->mem_graduation_year)) echo $row->mem_graduation_year; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label"> Travel Radius (km) (distance willing to travel to student)</label>
                                <input type="text" name="mem_travel_radius" value="<?php if (isset($row->mem_travel_radius)) echo $row->mem_travel_radius; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label"> Date Of Birth</label>
                                <input type="text" name="mem_dob" value="<?php if (isset($row->mem_dob)) echo format_date($row->mem_dob,'m/d/Y'); ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label"> Address 1</label>
                                <input type="text" name="mem_address1" value="<?php if (isset($row->mem_address1)) echo $row->mem_address1; ?>" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label"> Address 2</label>
                                <input type="text" name="mem_address2" value="<?php if (isset($row->mem_address2)) echo $row->mem_address2; ?>" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4">
                                <label class="control-label"> City</label>
                                <input type="text" name="mem_city" value="<?php if (isset($row->mem_city)) echo $row->mem_city; ?>" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="control-label"> State</label>
                                <input type="text" name="mem_state_id" value="<?php if (isset($row->mem_state_id)) echo $row->mem_state_id; ?>" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="control-label"> Zip</label>
                                <input type="text" name="mem_zip" value="<?php if (isset($row->mem_zip)) echo $row->mem_zip; ?>" class="form-control">
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label"> SSN</label>
                                <input type="text" name="mem_ssn" value="<?php //if (isset($row->mem_ssn)) echo $row->mem_ssn; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label"> Drivering License Number</label>
                                <input type="text" name="mem_driver_license_number" value="<?php//if (isset($row->mem_driver_license_number)) echo $row->mem_driver_license_number; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label"> Drivering License State</label>
                                <input type="text" name="mem_driver_license_state" value="<?php //if (isset($row->mem_driver_license_state)) echo $row->mem_driver_license_state; ?>" class="form-control">
                            </div>
                        </div> -->
                       <!-- <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label"> Referral Code</label>
                                <input type="text" name="mem_referral_code" value="<?php //if (isset($row->mem_referral_code)) echo $row->mem_referral_code; ?>" class="form-control">
                            </div>
                        </div>-->
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label"> Hear About</label>
                                <input type="text" name="mem_hear_about" value="<?php if (isset($row->mem_hear_about)) echo $row->mem_hear_about; ?>" class="form-control">
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label">Main Subject <span class="symbol required">*</span></label>
                                <select id="subject" name="subject" class="form-control">
                                    <option value="">Select your subject</option>
                                    <?php //get_subjects(0,12,true,'id',$tutor_main_subject->subject_id);?>
                                </select>
                            </div>
                        </div> -->
                        <!-- <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label">Sub Subjects <span class="symbol required">*</span></label>
                                <ul class="subjLst">
                                     <label for="Algebra1">
                                        <input type="checkbox" name="" value="" id="Algebra1"> Algebra 1
                                    </label>
                                </ul>
                            </div>
                        </div> -->
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label">Availability <span class="symbol required">*</span></label>
                            <?php $days=get_week_days()?>
                            <?php foreach ($days as $day_key => $day): ?>
                                <div class="form-group col-md-12 dayLst">
                                    <label for="<?= $day?>">
                                        <input type="checkbox" name="days[<?= $day_key?>]" value="<?= $day?>" id="<?= $day?>" <?= empty($tutor_timings[$day_key]->available)?'':'checked=""' ?>> <?= $day?>
                                    </label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" name="start_time[<?= $day_key?>]" value="<?= empty($tutor_timings[$day_key]->available)?'':(($tutor_timings[$day_key]->start_time=='')?'Anytime':get_meridian_time($tutor_timings[$day_key]->start_time)) ?>" <?= empty($tutor_timings[$day_key]->available)?'disabled':'' ?> class="form-control timepicker1">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="end_time[<?= $day_key?>]" value="<?= empty($tutor_timings[$day_key]->available)?'':(($tutor_timings[$day_key]->end_time=='')?'Anytime':get_meridian_time($tutor_timings[$day_key]->end_time)) ?>" <?= empty($tutor_timings[$day_key]->available)?'disabled':'' ?> class="form-control timepicker1">
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label">Are you able to perform lessons online?<span class="symbol required">*</span></label>
                            <select class="form-control txtBox" id="txtOnline" name="mem_onlinelesson">
                                <option <?=$row->mem_onlinelesson == "1"?"selected":""?> value="1">Yes</option>
                                <option <?=$row->mem_onlinelesson == "0"?"selected":""?> value="0">No</option>
                            </select>
                        </div>
                    </div>
                    </div>
                    <?php if(access(9)):?>
                    <div class="col-md-12">
                        <h3><i class="fa fa-lock"></i> Login Credentials</h3>
                        <hr class="hr-short">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label">Email <span class="symbol required">*</span></label>
                                <input type="text" name="mem_email" value="<?php if (isset($row->mem_email)) echo $row->mem_email; ?>"  class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label">Password </label>
                                <input type="password"  name="mem_pswd" value="<?php  if (isset($row->mem_pswd)) echo doDecode($row->mem_pswd);  ?>" class="form-control" autocomplete="off" placeholder="password" <?php  if (!empty($row->mem_pswd)) echo 'required';  ?> >
                            </div>
                        </div>
                    </div>
                    <?php endif?>

                    <div class="clearfix"></div>
                    <div class="col-md-12">
                        <hr class="hr-short">
                        <div class="form-group text-right">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Save</button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
            <input type="file" id="uploadFile" name="uploadFile" accept="image/*" class="uploadFile" data-file="">
            <div class="clearfix"></div>
        </div>
        <script type="text/javascript">
            function addEducation() {
                
                var nextIndex = jQuery('.education-section').attr('data-items');
                var educationHtml = '<div class="form-group education-item item-ind-'+nextIndex+'" data-index="'+nextIndex+'">';
                    educationHtml += '<div class="col-md-12">';
                        educationHtml += '<label class="control-label">Unversity/College Name</label>';
                        educationHtml += '<input type="text" name="edu_name['+nextIndex+']" class="form-control" required>';
                    educationHtml += '</div>';
                    educationHtml += '<div class="col-md-6">';
                        educationHtml += '<label class="control-label">Degree</label>';
                        educationHtml += '<input type="text" name="edu_degree['+nextIndex+']" class="form-control">';
                    educationHtml += '</div>';
                    educationHtml += '<div class="col-md-6">';
                        educationHtml += '<label class="control-label"> Field of Study</label>';
                        educationHtml += '<input type="text" name="edu_study['+nextIndex+']" class="form-control">';
                    educationHtml += '</div>';
                    educationHtml += '<div class="col-md-6">';
                        educationHtml += '<label class="control-label">From Year</label>';
                        educationHtml += '<input type="text" name="edu_from_year['+nextIndex+']" class="form-control">';
                    educationHtml += '</div>';
                    educationHtml += '<div class="col-md-6">';
                        educationHtml += '<label class="control-label">To Year</label>';
                        educationHtml += '<input type="text" name="edu_to_year['+nextIndex+']" class="form-control">';
                    educationHtml += '</div>';
                educationHtml += '</div>';
                jQuery('.education-section').append(educationHtml);
                jQuery('.education-section').attr('data-items', +nextIndex + 1);
            }

            function addWorkExperience() {
                
                var nextIndex = jQuery('.experience-section').attr('data-items');
                var experienceHtml = '<div class="form-group experience-item ex-item-ind-'+nextIndex+'" data-index="'+nextIndex+'">';
                    experienceHtml += '<div class="col-md-12">';
                        experienceHtml += '<label class="control-label">Company Name</label>';
                        experienceHtml += '<input type="text" name="work_company_name['+nextIndex+']" class="form-control">';
                    experienceHtml += '</div>';
                    experienceHtml += '<div class="col-md-12">';
                        experienceHtml += '<label class="control-label">Job Title</label>';
                        experienceHtml += '<input type="text" name="work_title['+nextIndex+']" class="form-control">';
                    experienceHtml += '</div>';
                    experienceHtml += '<div class="col-md-6">';
                        experienceHtml += '<label class="control-label">From Month</label>';
                        experienceHtml += '<select class="form-control txtBox" name="work_from_month['+nextIndex+']"><option value="January">January</option><option value="February">February</option><option value="March">March</option><option value="April">April</option><option value="May">May</option><option value="June">June</option><option value="July">July</option><option value="August">August</option><option value="September">September</option><option value="October">October</option><option value="November">November</option><option value="December">December</option></select>';
                    experienceHtml += '</div>';
                    experienceHtml += '<div class="col-md-6">';
                        experienceHtml += '<label class="control-label">From Year</label>';
                        experienceHtml += '<input type="text" name="work_from_year['+nextIndex+']" class="form-control">';
                    experienceHtml += '</div>';
                    experienceHtml += '<div class="clearfix"></div>';
                    experienceHtml += '<div class="col-md-12">';
                        experienceHtml += '<label for="work_currently_'+nextIndex+'" style="margin-top: 5px;">';
                            experienceHtml += '<input type="checkbox" class="work_currently_check" name="work_currently['+nextIndex+']" value="1" id="work_currently_'+nextIndex+'"> I currently work here';
                        experienceHtml += '</label>';
                    experienceHtml += '</div>';
                    experienceHtml += '<div class="clearfix"></div>';
                    experienceHtml += '<div class="col-md-6 work_currently_'+nextIndex+'">';
                        experienceHtml += '<label class="control-label">To Month</label>';
                        experienceHtml += '<select class="form-control txtBox" name="work_to_month['+nextIndex+']"><option value="January">January</option><option value="February">February</option><option value="March">March</option><option value="April">April</option><option value="May">May</option><option value="June">June</option><option value="July">July</option><option value="August">August</option><option value="September">September</option><option value="October">October</option><option value="November">November</option><option value="December">December</option></select>';
                    experienceHtml += '</div>';
                    experienceHtml += '<div class="col-md-6 work_currently_'+nextIndex+'">';
                        experienceHtml += '<label class="control-label">To Year</label>';
                        experienceHtml += '<input type="text" name="work_to_year['+nextIndex+']" class="form-control">';
                    experienceHtml += '</div>';
                    experienceHtml += '<div class="clearfix"></div>';
                    experienceHtml += '<div class="col-md-12">';
                        experienceHtml += '<label class="control-label">Job Description</label>';
                        experienceHtml += '<textarea class="form-control" name="work_description['+nextIndex+']"></textarea>';
                    experienceHtml += '</div>';
                experienceHtml += '</div>';
                jQuery('.experience-section').append(experienceHtml);
                jQuery('.experience-section').attr('data-items', +nextIndex + 1);
            }

            function isFloat(x) { return !!(x % 1); }

            (function($){
                $(document).on('keydown', 'input[number]', function(e){
                    var input = $(this);

                    if (input.val() < 20){
                        $('.btn-lg').prop("disabled",true);
                    } else if(y[i].val() > 500){
                        $('.btn-lg').prop("disabled",true);
                    } else if(isFloat(y[i].val())==true)
                    {
                        $('.btn-lg').prop("disabled",true);
                    }
                    $('.btn-lg').prop("disabled",false);
                });

                $(document).on('change', '.work_currently_check', function(e){
                    $('.'+$(this).attr('id')).show();
                    if (this.checked) {
                        $('.'+$(this).attr('id')).hide();
                    }
                });

                $(function(){
                    $('#subject').change(function(){
                        var subject=this.value;
                        $("ul.subjLst").html('<li>Please Wait subjects are loading</li>');
                        $.ajax({
                            url: base_url+'ajax/get-subjects',
                            data : {'subject':subject,'mem_id':'<?= $tutor_main_subject->mem_id?>'},
                            method: 'POST',
                            dataType: 'json',
                            success: function (data) {
                                setTimeout(function(){
                                    if(data.option!='')
                                        $('ul.subjLst').html(data.option);
                                },3000)
                            }
                        })
                    })
                    <?php if($tutor_main_subject->subject_id>0):?>
                        $('#subject').trigger('change');
                    <?php endif?>
                     /*$('.timepicker5').timepicker({
                        template: false,
                        showInputs: false,
                        defaultTime: false,
                        minuteStep: 5
                    });*/
                     $(document).on('change', 'input[name^="days"]', function(){
                        if(this.checked){
                            $(this).parents('div.dayLst').find('input[type="text"]').attr('disabled',false);
                        } else{
                            $(this).parents('div.dayLst').find('input[type="text"]').attr('disabled',true);
                        }
                    });
                })
            }(jQuery))
        </script>
        <?php else: ?>
            <?= showMsg(); ?>
            <?= getBredcrum(ADMIN, array('#' => 'Manage Tutors')); ?>
            <div class="row margin-bottom-10">
                <div class="col-md-6">
                    <h2 class="no-margin"><i class="entypo-users"></i> Manage <strong>Tutors</strong></h2>
                </div>
                <div class="col-md-6 text-right">
                    <a href="<?= site_url(ADMIN . '/tutors/manage'); ?>" class="btn btn-lg btn-primary"><i class="fa fa-plus-circle"></i> Add New</a>
                </div>
            </div>
            <table class="table table-bordered datatable" id="table-1">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">Sr#</th>
                        <th width="60px">Photo</th>
                        <th width="20%">Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Last Login</th>
                        <th width="8%" class="text-center">Background Check</th>
                        <th width="8%" class="text-center">Status</th>
                        <th width="12%" class="text-center">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($rows) > 0): $count = 0; ?>
                        <?php foreach ($rows as $row): ?>
                            <tr class="odd gradeX">
                                <td class="text-center"><?= ++$count; ?></td>
                                <td class="text-center">
                                    <div class="icoRound">
                                        <img src = "<?= get_image_src($row->mem_image,150,true); ?>" height = "75">
                                    </div>
                                </td>
                                <td><b><a href="<?= profile_url($row->mem_id,$row->mem_fname . ' ' . $row->mem_lname)?>" target="_blank"><?= $row->mem_fname . ' ' . $row->mem_lname; ?></a></b></td>
                                <td><?= $row->mem_email; ?></td>
                                <td><?= $row->mem_phone; ?></td>
                                <td><?= format_date($row->mem_last_login,'M d Y h:i:s A'); ?></td>
                                <td class="text-center"><?php
                                $tutorcheck = get_background_check($row->mem_id);
                                if(!empty($tutorcheck) && $tutorcheck->status == 0)
                                {
                                	echo '<strong style="color:red;">Pending</strong>';
                                }
                                else {
                                	print_r(verified_status($row->mem_verified));
                                }
                                ?></td>
                                <td class="text-center"><?= getStatus($row->mem_status); ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> Action <span class="caret"></span></button>
                                        <ul class="dropdown-menu dropdown-primary" role="menu">
                                            <?php if ($row->mem_status == '0'): ?>
                                                <li><a href="<?= site_url(ADMIN); ?>/tutors/active/<?= $row->mem_id; ?>">Active</a></li>
                                            <?php else: ?>
                                                <li><a href="<?= site_url(ADMIN); ?>/tutors/suspend/<?= $row->mem_id; ?>">Inactive</a></li>
                                            <?php endif; ?>

                                            <li><a href="<?= site_url(ADMIN); ?>/tutors/manage/<?= $row->mem_id; ?>">Edit</a></li>
                                            <?php if(access(10)):?>
                                                <li><a href="<?= site_url(ADMIN); ?>/tutors/delete/<?= $row->mem_id; ?>" onclick="return confirm('Are you sure?');">Delete</a></li>
                                            <?php endif?>
                                            <li class="divider"></li>
                                            <li><a href="<?= site_url(ADMIN.'/tutors/bank-accounts/'.$row->mem_id); ?>" >Bank Accounts</a></li>
                                            <li><a href="<?= site_url(ADMIN.'/tutors/transactions/'.$row->mem_id); ?>" >Transactions</a></li>
                                            <!-- <li><a href="<?= site_url(ADMIN.'/tutors/withdraws/'.$row->mem_id); ?>" >Withdraws</a></li> -->
                                            <li><a href="<?= site_url(ADMIN.'/tutors/chats/'.$row->mem_id); ?>" >Chats</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
<?php endif; ?>
<script>
(function($){
    $(".hourly-input").change(function(){
        var temp = parseInt($(this).val()*1-$(this).val()%5);
        $(this).val(temp);
    });
})(jQuery);
</script>