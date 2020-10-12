<!doctype html>
<html>
<head>
    <title>Profile Settings - <?=$site_settings->site_name?></title>
    <?php $this->load->view('includes/site-master'); ?>
</head>
<body id="home-page">
    <?php $this->load->view('includes/header'); ?>
    <link href="<?= base_url('assets/css/select2.min.css')?>" rel="stylesheet" />
    <section id="dash">
        <div class="contain-fluid">
            <div class="lBar ease">
                <?php $this->load->view('includes/sidebar'); ?>
            </div>
            <div id="profileSet" class="inSide regular">
                <!-- <div class="blk">
                    <div class="_header">
                        <h3>Verify Phone</h3>
                    </div>
                    <form action="<?= site_url('change-phone')?>" method="post" autocomplete="off" class="frmAjax" id="frmPhone">
                        <div class="formBlk">
                            <p>Crainly is going to send you a text message for Phone verification if you want to verify your phone number, Please make sure you already save that phone number before verification.</p>
                            <div class="row formRow">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-xx-3 txtGrp">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                    <h4>Phone Number</h4>
                                    <div class="verifyBlk">
                                        <input type="text" name="phone" id="phone" class="txtBox" value="<?php //$mem_data->mem_phone?$mem_data->mem_phone:''?>">
                                        <?php //if (!empty($mem_data->mem_phone)): ?>
                                            <?php //if (empty($mem_data->mem_verified)): ?>
                                                <a href="<?php //site_url('phone-verification')?>" class="ntVerify">Verify</a>
                                            <?php// else: ?>
                                                <a href="javascript:void(0)" class="fi fi-check"></a>
                                            <?php //endif ?>
                                        <?php //endif ?>
                                        <a href="javascript:void(0)" class="fi fi-check"></a>
                                    </div>
                                    <div class="invald hide" id="phnMsg"></div>
                                </div>
                            </div>
                            <div class="bTn text-center">
                                <button type="submit" class="webBtn colorBtn">Save <i class="fa fa-spinner fa-pulse fa-1x fa-fw hidden"></i></button>
                            </div>
                        </div>
                        <div class="alertMsg" style="display: none;"></div>
                    </form>
                </div>-->

                    <!-- <div class="blk">
                        <div class="_header">
                            <h3>Contact Info</h3>
                        </div>
                        <div class="formBlk">
                            <div class="row formRow">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                    <h4>Email Address</h4>
                                    <div class="verifyBlk">
                                        <input type="text" id="email" name="email" class="txtBox" value="<?= $mem_data->mem_email?$mem_data->mem_email:''?>" placeholder="Email Address" autofocus>
                                        <?php if (!empty($mem_data->mem_phone)): ?>
                                            <?php if (empty($mem_data->mem_phone_verified)): ?>
                                                <a href="<?= site_url('email-verification')?>" class="ntVerify">Verify</a>
                                            <?php else: ?>
                                                <a href="javascript:void(0)" class="fi fi-check"></a>
                                            <?php endif ?>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                        <h4>Phone Number</h4>
                                        <div class="verifyBlk">
                                            <input type="text" name="phone" id="phone" class="txtBox" value="<?= $mem_data->mem_phone?$mem_data->mem_phone:''?>">
                                            <a href="javascript:void(0)" class="fi fi-check"></a>
                                        <?php if (!empty($mem_data->mem_phone)): ?>
                                            <?php if (empty($mem_data->mem_phone_verified)): ?>
                                                <a href="javascript:void(0)" class="vrfPhn">Verify</a>
                                                <?php else: ?>
                                                    <a href="javascript:void(0)" class="fi fi-check"></a>
                                                <?php endif ?>
                                                <?php endif ?>
                                            </div>
                                            <div class="invald hide" id="phnMsg"></div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <?php if(!empty($alertText)) { ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php print_r($alertText); ?>
                                </div>
                            <?php } ?>
                            <div class="blk">
                                <div class="_header">
                                    <h3>Profile Info</h3>
                                </div>
                                <form action="" method="post" autocomplete="off" class="frmAjax" id="frmSetting">
                                    <div class="formBlk">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-xx-12">
                                                <div class="row formRow">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xx-12 txtGrp">
                                                        <div class="proDp ico">
                                                            <img src="<?= get_image_src($mem_data->mem_image,'300',true)?>" alt="" id="userImage">

                                                        </div>
                                                        <div class="text-center"><button type="button" class="webBtn smBtn uploadImg" id="uploadDp" data-image-src="image"><i class="fi-camera"></i> Change Photo</button></div>
                                                        <div class="noHats text-center">(Please upload your photo, no hats and sunglasses)</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 col-xx-12">
                                                <h4 class="color">Account Details</h4>
                                                <div class="row formRow">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                                        <h4>First Name</h4>
                                                        <input type="text" name="fname" id="fname" value="<?= ($mem_data->mem_fname?$mem_data->mem_fname:'')?>" class="txtBox" placeholder="First Name">
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                                        <h4>Last Name</h4>
                                                        <input type="text" name="lname" id="lname" value="<?= ($mem_data->mem_lname?$mem_data->mem_lname:'')?>" class="txtBox" placeholder="Last Name">
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xx-12 txtGrp" style="display:none">
                                                        <h4>Profile Headline</h4>
                                                        <input type="text" name="profile_heading" id="profile_heading" class="txtBox"  value="none">
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xx-12 txtGrp">
                                                        <h4>Profile Bio</h4>
                                                        <textarea name="profile_bio" id="profile_bio" class="txtBox"><?= ($mem_data->mem_about?$mem_data->mem_about:'')?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="file" id="uploadFile" name="uploadFile" accept="image/*" class="" style="display: none;" data-file="">
                                        <div class="bTn text-center">
                                            <button type="submit" class="webBtn colorBtn">Save <i class="fa fa-spinner fa-pulse fa-1x fa-fw hidden"></i></button>
                                        </div>
                                    </div>
                                    <div class="alertMsg" style="display: none;"></div>
                                </form>
                            </div>
                            <div class="blk">
                                <div class="_header">
                                    <h3>Additional Subjects</h3>
                                </div>
                                <?php //get_subjects(0,0,true,'id',$tutor_main_subject->subject_id, doEncode($this->session->mem_id));?>
                                <form action="<?= site_url('additional-subjects')?>" method="post" autocomplete="off" class="frmAjax" id="frmAdditionalSubjects">
                                    <div class="formBlk">
                                        <div class="row formRow">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 col-xx-12 txtGrp">
                                                <h4>Subject</h4>
                                                <select name="subject" id="subject" class="txtBox selectpicker" data-live-search="true">
                                                    <option value="">Select your subject</option>
                                                    <?= subjects(); ?>

                                                </select>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xx-12 txtGrp">
                                                <div class="appLoad" style="display: none;">
                                                    <div class="appLoader"><span class="spiner"></span></div>
                                                </div>
                                                <ul class="subjLst flex">
                                                </ul>
                                            </div>
                                            <!-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 col-xx-12 txtGrp">
                                                <input type="text" name="new_subject" id="new_subject" class="txtBox" placeholder="Add new subject">
                                            </div> -->
                                        </div>
                                        <div class="bTn text-center">
                                            <button type="submit" class="webBtn colorBtn">Save <i class="fa fa-spinner fa-pulse fa-1x fa-fw hidden"></i></button>
                                        </div>
                                    </div>
                                    <div class="alertMsg" style="display: none;"></div>
                                </form>
                            </div>
                            <div class="blk">
                                <div class="_header">
                                    <h3>Additional Info</h3>
                                </div>
                                <form action="<?= site_url('additional-info')?>" method="post" autocomplete="off" class="frmAjax" id="frmAdditionalInfo">
                                    <div class="formBlk">
                                        <div class="row formRow">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                                <h4>Email Address</h4>
                                                <div class="verifyBlk">
                                                    <input type="text" id="email" name="email" class="txtBox" value="<?= $mem_data->mem_email?$mem_data->mem_email:''?>" placeholder="Email Address" autofocus>
                                                <!-- <?php if (!empty($mem_data->mem_phone)): ?>
                                                    <?php if (empty($mem_data->mem_phone_verified)): ?>
                                                        <a href="<?= site_url('email-verification')?>" class="ntVerify">Verify</a>
                                                    <?php else: ?>
                                                        <a href="javascript:void(0)" class="fi fi-check"></a>
                                                    <?php endif ?>
                                                    <?php endif ?> -->
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                                <h4>Hourly Rate $ <small>(Minimum hourly rate should be 20)</small></h4>
                                                <input type="text" name="hourly_rate" id="hourly_rate" class="txtBox" value="<?= $mem_data->mem_hourly_rate?$mem_data->mem_hourly_rate:''?>">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                                <h4>Travel Radius (Miles) <small>(distance willing to travel to student)</small></h4>
                                                <select name="travel_radius" id="travel_radius" class="txtBox selectpicker" data-live-search="true">
                                                    <option value="10" <?php echo ($mem_data->mem_travel_radius == '10' ? 'selected="selected"' : '');?>>10</option>
                                                    <option value="20" <?php echo ($mem_data->mem_travel_radius == '20' ? 'selected="selected"' : '');?>>20</option>
                                                    <option value="30" <?php echo ($mem_data->mem_travel_radius == '30' ? 'selected="selected"' : '');?>>30</option>
                                                    <option value="40" <?php echo ($mem_data->mem_travel_radius == '40' ? 'selected="selected"' : '');?>>40</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                                <h4>Highest Level of Education</small></h4>
                                                <select name="highest_level_of_education" id="highestlevelofeducation" class="txtBox selectpicker" data-live-search="true">
                                                     <?php $educations=educations()?>
                                                    <?php foreach ($educations as $edu_key => $education): 
                                                        $sele = '';
                                                        if($mem_data->highest_level_of_education == $edu_key):
                                                            $sele = ' Selected';
                                                       endif; 
                                                        ?>
                                                       <option value="<?php echo $edu_key;?>" <?php echo $sele;?>><?php echo $education;?></option>
                                                    <?php endforeach?>
                                                </select>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                                <h4>Address 1</h4>
												<input type="text" class="txtBox" id="autocomplete" value="<?= $mem_data->mem_address1?$mem_data->mem_address1:''?>"
												onFocus="geolocate()" 
												placeholder="Enter your address" 
												name="address" required>
												<!-- <input type="text" class="form-control" placeholder="Enter your address" name="address" class="form-control textareaAddress" required> -->
												<!-- <span class="address_error" style="text-align: left;"></span> -->
												<input type="hidden" name="street" id="street_number" class="form-control street_number" disabled="true"/>
												<input type="hidden" class="form-control" id="route" disabled="true"/>
												<input class="form-control" id="country" name="country" type="hidden" disabled="true"/>
                                                
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                                <h4>Address 2</h4>
                                                <input type="text" id="" name="address2" class="txtBox" value="<?= $mem_data->mem_address2?$mem_data->mem_address2:''?>" placeholder="">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                                <h4>City</h4>
                                                <input type="text" id="city" name="city" class="txtBox shwFld"  value="<?= $mem_data->mem_city?$mem_data->mem_city:''?>" placeholder="">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                                <h4>State</h4>
                                                <input type="text" id="state" name="state" class="txtBox shwFld"  value="<?= $mem_data->mem_state_id?$mem_data->mem_state_id:''?>" placeholder="">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                                <h4>Zip Code</h4>
                                                <input type="text" id="zip" name="zip" class="txtBox shwFld"  value="<?= $mem_data->mem_zip?$mem_data->mem_zip:''?>" placeholder="">
                                            </div>
                                        </div>
                                        <div class="bTn text-center">
                                            <button type="submit" class="webBtn colorBtn">Save <i class="fa fa-spinner fa-pulse fa-1x fa-fw hidden"></i></button>
                                        </div>
                                    </div>
                                    <div class="alertMsg" style="display: none;"></div>
                                </form>
                            </div>
                            <div class="blk">
                                <div class="_header">
                                    <h3>Education</h3>
                                </div>
                                <form action="<?= site_url('education')?>" method="post" autocomplete="off" class="frmAjax" id="frmEducation" novalidate="false">
                                    <input type="hidden" name="education" id="education" value='<?php echo json_encode($eduction) ?>'>
                                    <div class="added-item-list" id="educationItem"></div>
                                    <div class="bTn text-center">
                                        <button type="button" class="btn webBtn colorBtn" data-toggle="modal" data-target="#educationModal" id="addMore">Add More</button>
                                    </div>
                                    <div class="alertMsg" style="display: none;"></div>
                                </form>
                            </div>
                            <div class="blk">
                                <div class="_header">
                                    <h3>Work Experience</h3>
                                </div>
                                <form action="<?= site_url('experience')?>" method="post" autocomplete="off" class="frmAjax" id="frmExperience">
                                    <input type="hidden" name="workExperiences" id="workExperiences" value='<?php echo json_encode($experiences) ?>'>
                                    <div class="added-item-list" id="workExperienceItem"></div>
                                    <div class="bTn text-center">
                                        <button type="button" class="btn webBtn colorBtn" data-toggle="modal" data-target="#workexperienceModal" id="addMoreExp">Add More</button>
                                    </div>
                                    <div class="alertMsg" style="display: none;"></div>
                                </form>
                            </div>
                            <div class="blk">
                                <div class="_header">
                                    <h3>Availability</h3>
                                </div>
                                <form action="<?= site_url('availability')?>" method="post" autocomplete="off" class="frmAjax" id="frmAvailability">
                                    <div class="formBlk">
                                        <div class="row formRow">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xx-12 txtGrp">
                                                <ul class="dayLst flex">
                                                    <?php $days=get_week_days()?>
                                                    <?php foreach ($days as $day_key => $day): ?>
                                                        <li>
                                                            <div class="inner <?= $tutor_timings[$day_key]->day==$day && empty($tutor_timings[$day_key]->available)?'notAvail':''?>">
                                                                <h5><?= $day?>:</h5>
                                                                <div class="flexGrp">
                                                                    <input type="text" name="start_time[<?= $day_key?>]" class="txtBox timepicker1" value="<?= empty($tutor_timings[$day_key]->available)?'':($tutor_timings[$day_key]->start_time == '')?'Anytime':get_meridian_time($tutor_timings[$day_key]->start_time) ?>" <?= empty($tutor_timings[$day_key]->available)?'disabled':'' ?>>
                                                                    <em>to</em>
                                                                    <input type="text" name="end_time[<?= $day_key?>]" class="txtBox timepicker1" value="<?= empty($tutor_timings[$day_key]->available)?'':($tutor_timings[$day_key]->end_time == '')?'Anytime':get_meridian_time($tutor_timings[$day_key]->end_time) ?>" <?= empty($tutor_timings[$day_key]->available)?'disabled':'' ?>>
                                                                    <div class="unavail">Unavailable</div>
                                                                </div>
                                                                <div class="switchBtn individual-day">
                                                                    <input type="checkbox" class="avaliable-check" name="days[<?= $day_key?>]" value="<?= $day?>" <?= empty($tutor_timings[$day_key]->available)?'':'checked=""' ?>>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    <?php endforeach ?>
                                                    <li>
                                                        <div class="inner ">
                                                            <h5>Full Availability:</h5>
                                                            <div class="flexGrp">

                                                            </div>
                                                            <div class="switchBtn full-day">
                                                                <input type="checkbox" name="days['full']" value="full" id="full-day" <?= empty($tutor_timings['full']->available)?'':'checked=""' ?>>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="bTn text-center">
                                            <button type="submit" class="webBtn colorBtn">Save <i class="fa fa-spinner fa-pulse fa-1x fa-fw hidden"></i></button>
                                        </div>
                                    </div>
                                    <div class="alertMsg" style="display: none;"></div>
                                </form>
                            </div>
                            <div class="blk">
                                <div class="_header">
                                    <h3>Online Lessons</h3>
                                </div>
                                <?php //get_subjects(0,0,true,'id',$tutor_main_subject->subject_id, doEncode($this->session->mem_id));?>
                                <form action="<?= site_url('setonlinelesson')?>" method="post" autocomplete="off" class="frmAjax" id="frmOlineLesson">
                                    <div class="formBlk">
                                        <div class="row formRow">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 col-xx-12 txtGrp">
                                                <h4>Are you able to perform lessons online?</h4>

                                                <select class="selectpicker txtBox" id="txtOnline" name="onlinelesson">
                                                    <option <?=$mem_data->mem_onlinelesson == "1"?"selected":""?> value="1">Yes</option>
                                                    <option <?=$mem_data->mem_onlinelesson == "0"?"selected":""?> value="0">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="bTn text-center">
                                            <button type="submit" class="webBtn colorBtn">Save <i class="fa fa-spinner fa-pulse fa-1x fa-fw hidden"></i></button>
                                        </div>
                                    </div>
                                    <div class="alertMsg" style="display: none;"></div>
                                </form>
                            </div>

                            <!-- <div class="blk">
                                <div class="_header">
                                    <h3>Change Password</h3>
                                </div>
                                <div class="changePass">
                                    <form action="<?= site_url('change-password')?>" method="post" autocomplete="off" class="frmAjax" id="frmChangePass">
                                        <div class="formBlk">
                                            <div class="content">
                                                <p>Your password must contain the following:</p>
                                                <ol class="_list2">
                                                    <li>At least 8 characters in length (a strong password has at least 14 characters)</li>
                                                    <li>At least 1 letter and at least 1 number or symbol</li>
                                                </ol>
                                            </div>
                                            <div class="row formRow">
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xx-4 txtGrp">
                                                    <input type="password" id="pswd" name="pswd" value="" class="txtBox" placeholder="Current password">
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xx-4 txtGrp">
                                                    <input type="password" id="npswd" name="npswd" value="" class="txtBox" placeholder="New password">
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xx-4 txtGrp">
                                                    <input type="password" id="cpswd" name="cpswd" value="" class="txtBox" placeholder="Confirm new password">
                                                </div>
                                            </div>
                                            <div class="bTn text-center">
                                                <button type="submit" class="webBtn colorBtn">Save <i class="fa fa-spinner fa-pulse fa-1x fa-fw hidden"></i></button>
                                            </div>
                                        </div>
                                        <div class="alertMsg" style="display:none"></div>
                                    </form>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </section>
        <!-- dash -->
        
        <div class="modal fade" id="educationModal" role="dialog">
            <div class="modal-dialog">
                <!-- <form action="<?= site_url('education')?>" method="post" autocomplete="off"     class="frmAjax" id="frmEducation" novalidate="false"> -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><img src="assets/images/close.svg" alt=""></button>
                            <input type="hidden" id="mode" name="mode" value="add">
                            <input type="hidden" id="id" name="id" value="">
                            <input type="hidden" id="editIndex" name="editIndex" value="0">
                            <h4 class="modal-title">Education</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                <div class="form-group">
                                    <label for="university">Unversity/College Name <span class="text-red">*</span></label>
                                    <input type="text" class="form-control" id="university" placeholder="Unversity/College Name" name="college">
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="degree">Degree</label>
                                    <input type="text" class="form-control" id="degree" placeholder="Degree" name="degree">
                                </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="study-field">Field of Study</label>
                                    <input type="text" class="form-control" id="studyField" placeholder="Field of Study" name="study_field">
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group custom-select fixed-height">
                                        <label for="from-year">From Year <span class="text-red">*</span></label>
                                        <input type="text" class="form-control" id="fromYear" placeholder="From Year" name="from_year">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group custom-select fixed-height">
                                        <label for="to-year">To Year <span class="text-red">*</span></label>
                                        <input type="text" class="form-control" id="toYear" placeholder="To Year" name="to_year">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer text-center">
                            <input type="hidden" id="addmorecount" value="1">
                            <button type="button" class="btn btn-default save-btn" onclick="addEductionDetails(true);submitFrom('frmEducation');">Save</button>
                        </div>
                    </div>
                <!-- </form> -->
            </div>
        </div>
        <!-- Add Education Modal Over -->

        <!-- Add Work Experience Modal Start -->
        <div class="modal fade" id="workexperienceModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><img src="/assets/images/close.svg" alt=""></button>
                        <input type="hidden" id="mode" name="mode" value="add">
                        <input type="hidden" id="editIndex" name="editIndex" value="0">
                        <h4 class="modal-title">Work Experience </h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Company Name <span class="text-red">*</span></label>
                                    <input type="text" class="form-control" id="name" placeholder="Company Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Job Title <span class="text-red">*</span></label>
                                    <input type="text" class="form-control" id="title" placeholder="Job Title">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group custom-select fixed-height">
                                    <label for="fromYearEx">From Date <span class="text-red">*</span></label>
                                    <select class="form-control select2-dropdown" id="fromMonth">
                                    <option disabled selected>Month</option>
                                    <?php
                                    for($i=1;$i<=12;$i++):
                                    $monthName = date("F", mktime(0, 0, 0, $i, 10));
                                    ?>
                                        <option value="<?php echo $monthName;?>"><?php echo $monthName;?></option>
                                    <?php 
                                    endfor;
                                    ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group custom-select fixed-height">
                                    <div class="checkbox">
                                        <label><input type="checkbox" id="is_currently_work" value="1">I currently work here</label>
                                    </div>
                                    <input type="text" class="form-control" id="fromYearEx" placeholder="From Year">
                                </div>
                            </div>
                        </div>
                        <div class="row to-section">
                            <div class="col-md-6">
                                <div class="form-group custom-select fixed-height">
                                    <label for="toYearExp">To Date <span class="text-red">*</span></label>
                                    <select class="form-control select2-dropdown" id="toMonth">
                                        <option disabled selected>Month</option>
                                        <?php
                                            for($i=1;$i<=12;$i++):
                                            $monthName = date("F", mktime(0, 0, 0, $i, 10));
                                        ?>
                                        <option value="<?php echo $monthName;?>"><?php echo $monthName;?></option>
                                        <?php 
                                        endfor;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group custom-select fixed-height">
                                    <label for="toMonth" style="visibility: hidden;">Select Year <span class="text-red">*</span></label>
                                    <input type="text" class="form-control" id="toYearExp" placeholder="To Year">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Job Description <span class="text-red">*</span></label>
                                    <textarea id="description" class="form-control" placeholder="Write Job Description"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-center">
                        <button type="button" class="btn btn-default save-btn" onclick="addWorkExperience(true);submitFrom('frmExperience');">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="<?= base_url('assets/js/additional-methods.js')?>"></script>
        <!-- Editor Js -->
		<script type="text/javascript" src="<?= base_url('assets/js/custom.js').'?'.time() ?>"></script>
	   <script src="https://maps.googleapis.com/maps/api/js?key=<?= GOOGLE_MAP_API_KEY ?>&libraries=places&callback=initAutocomplete"
        async defer></script>
	
        <script type="text/javascript" src="<?= base_url('assets/js/ckeditor.js')?>"></script>
        <script type="text/javascript" src="<?= base_url('assets/js/select2.min.js')?>"></script>
        <?php $this->load->view('includes/footer');?>
        <script type="text/javascript">
            
            function submitFrom(fid) {
                if ( fid === 'frmEducation' ) {
                    if ( !$('#educationModal').hasClass('in') ) {
                        $('#'+fid).submit();
                    }
                } else if ( fid === 'frmExperience' ) {
                    if ( !$('#workexperienceModal').hasClass('in') ) {
                        $('#'+fid).submit();
                    }
                }
            }

            $(function(){
                $('.select2-dropdown').select2({
                    width: '100%',
                });
                
                let education = $('#education').val();
                if ( education == '' ) {
                    education = [];
                } else {
                    education = JSON.parse($('#education').val());
                }
                educationHtml(education, true);

                let workExperiences = $('#workExperiences').val();
                if ( workExperiences == '' ) {
                    workExperiences = [];
                } else {
                    workExperiences = JSON.parse($('#workExperiences').val());
                }
                workExperienceHtml(workExperiences, true, true);

                $(document).on('click', '.editEducation', function(){
                    var key = $(this).data('id');
                    var educations = JSON.parse($('#education').val());

                    education = educations[key];
                    $('#mode').val('edit');
                    $('#editIndex').val(key);
                    $('#university').val(education.college);
                    $('#degree').val(education.degree);
                    $('#studyField').val(education.studyField);
                    $('#fromYear').val(education.fromYear).trigger('change');
                    $('#toYear').val(education.toYear).trigger('change');
                });

                $(document).on('click', '.deleteEducation', function(){
                    var key = $(this).data('id');
                    var educations = JSON.parse($('#education').val());
                    
                    educations.splice(key, 1);
                    educationHtml(educations, true);

                    $('#frmEducation').submit();
                });

                $(document).on('click', '.editExperience', function(){
                    var key = $(this).data('id');
                    var experiences = JSON.parse($('#workExperiences').val());

                    experience = experiences[key];
                    $('#mode').val('edit');
                    $('#editIndex').val(key);
                    $('.to-section').show();
                    $('#name').val(experience.name);
                    $('#title').val(experience.title);
                    $('#fromMonth').val(experience.fromMonth).trigger('change');
                    $('#fromYearEx').val(experience.fromYear).trigger('change');
                    $('#is_currently_work').prop( "checked", experience.is_currently_work);
                    if (experience.is_currently_work) {
                        $('.to-section').hide();
                    }
                    $('#toMonth').val(experience.toMonth).trigger('change');
                    $('#toYearExp').val(experience.toYear).trigger('change');
                    $('#description').val(experience.description);
                    
                });

                $(document).on('click', '.deleteExperience', function(){
                    var key = $(this).data('id');
                    var experiences = JSON.parse($('#workExperiences').val());
                    
                    experiences.splice(key, 1);
                    workExperienceHtml(experiences, true, true);

                    $('#frmExperience').submit();
                });

                $(document).on('click', '#profileSet .dayLst li .individual-day', function(){
                    if($(this).children('input[type="checkbox"]').is(':checked')){
                        $(this).parents('.inner').removeClass('notAvail');
                        $(this).parents('.inner').find('input[type="text"]').val('Anytime').attr('disabled',false);
                    } else{
                        $(this).parents('.inner').addClass('notAvail');
                        $(this).parents('.inner').find('input[type="text"]').attr('disabled',true);
                    }
                });

                $(".full-day").click(function(){

                    if($(this).children('input[type="checkbox"]').is(':checked')){

                        $('#profileSet .dayLst li .switchBtn').each(function(){
                            if(!$(this).children('input[type="checkbox"]').is(':checked')){
                                $(this).parents('.inner').removeClass('notAvail');
                                $(this).parents('.inner').find('input[type="text"]').val('Anytime').attr('disabled',false);
                                $(this).parents('.inner').find('input[type="checkbox"]').prop('checked',true);
                            }
                        });
                        $(this).parents('.inner').removeClass('notAvail');
                        $(this).parents('.inner').find('input[type="text"]').val('Anytime').attr('disabled',false);
                    }
                    else{
                        $(this).parents('.inner').addClass('notAvail');
                        $(this).parents('.inner').find('input[type="text"]').attr('disabled',true);
                    }
                });

                $('#subject').change(function(){
                    var subject=this.value;
                    $("ul.subjLst").html('').hide();
                    $('.appLoad').fadeIn();
                    $.ajax({
                        url: base_url+'ajax/get_subjects_new',
                        data : {'subject':subject, 'mem_id':'<?= $this->session->mem_id?>'},
                        method: 'POST',
                        dataType: 'json',
                        success: function (data) {
                            if(data.option!='')
                                $('ul.subjLst').html(data.option);
                        },
                        complete: function(){
                            setTimeout(function(){
                                $('.appLoad').fadeOut();
                                $('ul.subjLst').show('slow');
                            },3000)
                        }
                    })
                })
                <?php if($tutor_main_subject->subject_id>0):?>
                    $('#subject').trigger('change');
                <?php endif?>
                /*ClassicEditor
                .create(document.querySelector('#profile_bio'), {
                    ckfinder: {
                    }
                })
                .then(editor => {
                })
                .catch(error => {
                    console.error(error);
                });*/
            })
        </script>
    </body>
    </html>