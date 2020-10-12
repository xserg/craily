<?php if ($this->uri->segment(3) == 'view'): ?>
    <?= showMsg(); ?>
    <?= getBredcrum(ADMIN, array('#' => 'View Tutor Applications')); ?>
    <div class="row margin-bottom-10">
        <div class="col-md-6">
            <h2 class="no-margin"><i class="entypo-users"></i> View <strong>Tutor Applications</strong></h2>
        </div>
        <div class="col-md-6 text-right">
            <a href="<?= site_url(ADMIN . '/tutor-applications'); ?>" class="btn btn-lg btn-default"><i class="fa fa-arrow-left"></i> Back</a>
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
                            <label class="control-label">Email <span class="symbol required">*</span></label>
                            <input type="text" name="mem_email" value="<?php if (isset($row->mem_email)) echo $row->mem_email; ?>"  class="form-control" required>
                        </div>
                    </div>
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
                            <textarea name="mem_about" id="mem_about" rows="4" class="form-control ckeditor"><?=$row->mem_about; ?></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class = "col-md-6">
                            <label class="control-label"> Profile Image <span class="symbol required">*</span></label><br>
                            <img src = "<?= get_image_src($row->mem_image,150,true); ?>" height = "80"><br>
                            <input type = "file" name = "mem_image" id = "mem_image" class = "form-control file2 inline btn btn-primary" data-label = "<i class='fa fa-upload'></i> Browse" />
                            <div><br />
                                <small style = "color:#F00;">* Best resolution is <strong>600 x 600</strong>.</small><br />
                                <small style = " color:#F00;">* Allowed formats are <strong>JPG | JPEG | PNG</strong>.</small><br>
                                <small style = "color:#F00;">* Image size maximum <strong>2MB</strong> allowed.</small>
                            </div>
                        </div>
                    </div>
                </div>    
                <div class="col-md-6">

                    <div class="col-md-12">
                        <h3><i class="fa fa-bars"></i> Personal Information</h3>
                        <hr class="hr-short">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label"> Hourly Rate $</label>
                                <input type="text" name="mem_hourly_rate" value="<?php if (isset($row->mem_hourly_rate)) echo $row->mem_hourly_rate; ?>" class="form-control">
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
                                <label class="control-label"> Zip Code</label>
                                <input type="text" name="mem_zip" value="<?php if (isset($row->mem_zip)) echo $row->mem_zip; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label"> Address</label>
                                <input type="text" name="mem_address1" value="<?php if (isset($row->mem_address1)) echo $row->mem_address1; ?>" class="form-control">
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label"> SSN</label>
                                <input type="text" name="mem_ssn" value="<?php if (isset($row->mem_ssn)) echo $row->mem_ssn; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label"> Drivering License Number</label>
                                <input type="text" name="mem_driver_license_number" value="<?php if (isset($row->mem_driver_license_number)) echo $row->mem_driver_license_number; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label"> Drivering License State</label>
                                <input type="text" name="mem_driver_license_state" value="<?php if (isset($row->mem_driver_license_state)) echo $row->mem_driver_license_state; ?>" class="form-control">
                            </div>
                        </div> -->
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label"> Referral Code</label>
                                <input type="text" name="mem_referral_code" value="<?php if (isset($row->mem_referral_code)) echo $row->mem_referral_code; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label"> Hear About</label>
                                <input type="text" name="mem_hear_about" value="<?php if (isset($row->mem_hear_about)) echo $row->mem_hear_about; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label">Main Subject <span class="symbol required">*</span></label>
                                <select id="subject" name="subject" class="form-control">
                                    <option value="">Select your subject</option>
                                    <?= get_subjects(0,12,true,'id',$tutor_main_subject->subject_id);?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label">Sub Subjects <span class="symbol required">*</span></label>
                                <ul class="subjLst">
                                    <!-- <label for="Algebra1">
                                        <input type="checkbox" name="" value="" id="Algebra1"> Algebra 1
                                    </label> -->
                                </ul>
                            </div>
                        </div>
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
                                                <input type="text" name="start_time[<?= $day_key?>]" value="<?= empty($tutor_timings[$day_key]->available)?'':get_meridian_time($tutor_timings[$day_key]->start_time) ?>" <?= empty($tutor_timings[$day_key]->available)?'disabled':'' ?> class="form-control timepicker">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="end_time[<?= $day_key?>]" value="<?= empty($tutor_timings[$day_key]->available)?'':get_meridian_time($tutor_timings[$day_key]->end_time) ?>" <?= empty($tutor_timings[$day_key]->available)?'disabled':'' ?> class="form-control timepicker">
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label class="control-label"> Application</label>
                                <select name="mem_tutor_verified" id="mem_tutor_verified" class="form-control" required="">
                                    <option value="" readonly>Appliction status</option>
                                    <!-- <option value="0"<?= (isset($row->mem_tutor_verified) && '0' == $row->mem_tutor_verified)? ' selected':''?>>Pending</option> -->
                                    <option value="1"<?= (isset($row->mem_tutor_verified) && '1' == $row->mem_tutor_verified)?' selected':''?>>Accepted</option>
                                    <option value="2"<?= (isset($row->mem_tutor_verified) && '2' == $row->mem_tutor_verified)?' selected':''?>>Declined</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="clearfix"></div>
                        
                    <div class="col-md-12">                
                        <hr class="hr-short">
                        <div class="form-group text-right">
                            <div class="col-md-12">
                                <!-- <a href="<?= site_url(ADMIN.'/tutor-applications/declince/'.$row->mem_id); ?>" class="btn btn-danger btn-lg" onclick="return confirm('Are you sure to decline it ?')"><i class="fa fa-times"></i> Decline</a> -->
                                <!-- <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-check"></i> Approve</button> -->
                                <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Save</button>
                            </div>
                        </div>
                    </div>
                    <?php if ($row->mem_tutor_verified==0): ?>
                    <?php endif ?>

                </div>
            </form>
            <!-- <input type="file" id="uploadFile" name="uploadFile" accept="image/*" class="uploadFile" data-file=""> -->
            <div class="clearfix"></div>
        </div>
        <script type="text/javascript">
            (function($){
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
                     /*$('.timepicker').timepicker({
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
            <?= getBredcrum(ADMIN, array('#' => 'Manage Tutor Applications')); ?>
            <div class="row margin-bottom-10">
                <div class="col-md-6">
                    <h2 class="no-margin"><i class="entypo-users"></i> Manage <strong>Tutor Applications</strong></h2>
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
                        <th class="text-center">Application Status</th>
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
                                        <img src = "<?= get_image_src($row->mem_image,50,true); ?>" height = "60">
                                    </div>
                                </td>
                                <td><b><a href="<?= profile_url($row->mem_id,$row->mem_fname . ' ' . $row->mem_lname)?>" target="_blank"><?= $row->mem_fname . ' ' . $row->mem_lname; ?></a></b></td>
                                <td><?= $row->mem_email; ?></td>
                                <td><?= $row->mem_phone; ?></td>
                                <td><?= format_date($row->mem_last_login,'M d Y h:i:s A'); ?></td>
                                <td class="text-center"><?= get_application_status($row->mem_tutor_verified); ?></td>
                                
                                <td class="text-center">
                                    <a href="<?= site_url(ADMIN.'/tutor-applications/view/'.$row->mem_id); ?>" class="btn btn-primary">View</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        <?php endif; ?>