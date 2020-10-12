<?php echo getBredcrum(ADMIN, array('#' => 'Home Page')); ?>
<?php echo showMsg(); ?>
<div class="row margin-bottom-10">
    <div class="col-md-6">
        <h2 class="no-margin"><i class="entypo-window"></i> Update <strong>Home Page</strong></h2>
    </div>
    <div class="col-md-6 text-right">
        <!--        <a href="<?php echo base_url('admin/services'); ?>" class="btn btn-lg btn-default"><i class="fa fa-arrow-left"></i> Cancel</a>-->
    </div>
</div>
<div>
    <hr>
    <div class="clearfix"></div>
    <div class="panel-body">
        <form role="form"  method="post" class="form-horizontal form-groups-bordered validate" novalidate="novalidate" enctype="multipart/form-data">
            <h3> Main Banner</h3>
            <div class="form-group">
                <div class="col-md-3">
                    <?php if($row['banner_video']!=''):?>
                        <video muted="" width="100%" controls="">
                            <source src="<?=SITE_VIDEOS.$row['banner_video']?>" type="video/mp4">
                            </video>

                    <?php else:?>
                        <label class="control-label"> Banner Video</label><br>
                    <?php endif?>
                    <input type = "file" name = "banner_video" accept="video/*" id = "banner_video" class = "form-control file2 inline btn btn-primary" data-label = "<i class='fa fa-upload'></i> Browse" />
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label"> Heading <span class="symbol required">*</span></label>
                            <input type="text" name="banner_heading" value="<?= $row['banner_heading'] ?>" class="form-control" required>
                        </div>
                        <div class="col-md-12">
                            <label class="control-label"> Short Detail <span class="symbol required">*</span></label>
                            <textarea name="banner_detail" rows="3" class="form-control" ><?= $row['banner_detail'] ?></textarea>
                        </div>
                        <div class="col-md-12">
                            <label class="control-label"> Button Text <span class="symbol required">*</span></label>
                            <input type="text" name="banner_button_text" value="<?= $row['banner_button_text'] ?>" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>

            <h3> First Section</h3>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label"> Heading <span class="symbol required">*</span></label>
                            <input type="text" name="first_section_heading" value="<?= $row['first_section_heading'] ?>" class="form-control" required>
                        </div>
                        <div class="col-md-12">
                            <label class="control-label"> Short Detail <span class="symbol required">*</span></label>
                            <textarea name="first_section_detail" id="first_section_detail" rows="6" class="form-control" required=""><?= $row['first_section_detail'] ?></textarea>
                        </div>
                        
                        <div class="col-md-12">
                            <label class="control-label"> Button Text <span class="symbol required">*</span></label>
                            <input type="text" name="first_section_button_text" value="<?= $row['first_section_button_text'] ?>" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>
            <?php for($i=1;$i<=3;$i++):?>
            <div class="form-group">
                <div class="col-md-3">
                    <img src = "<?php echo get_site_image_src("images", $row['first_ico_image'.$i]); ?>" height = "80"><br>
                    <input type = "file" name = "first_ico_image<?=$i?>" class = "form-control file2 inline btn btn-primary" data-label = "<i class='fa fa-upload'></i> Browse" />
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label"> Heading <span class="symbol required">*</span></label>
                            <input type="text" name="first_ico_heading<?=$i?>" value="<?= $row['first_ico_heading'.$i] ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label"> Detail <span class="symbol required">*</span></label>
                            <textarea name="first_ico_text<?=$i?>" rows="4" class="form-control" ><?= $row['first_ico_text'.$i] ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <?php endfor?>

            <h3> Second Section</h3>
            <div class="form-group">
                <div class="col-md-3">
                    <label class="control-label"> Background Image <span class="symbol required">*</span></label><br>
                    <img src = "<?php echo get_site_image_src("images", $row['second_ico_image'.$i]); ?>" height = "80"><br>
                    <input type = "file" name = "second_ico_image<?=$i?>" class = "form-control file2 inline btn btn-primary" data-label = "<i class='fa fa-upload'></i> Browse"/>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label"> Heading <span class="symbol required">*</span></label>
                            <input type="text" name="second_section_heading" value="<?= $row['second_section_heading'] ?>" class="form-control" required>
                        </div>
                        <div class="col-md-12">
                            <label class="control-label"> Short Detail <span class="symbol required">*</span></label>
                            <textarea name="second_section_detail" id="second_section_detail" rows="6" class="form-control" required=""><?= $row['second_section_detail'] ?></textarea>
                        </div>
                        <div class="col-md-12">
                            <label class="control-label"> Button Text <span class="symbol required">*</span></label>
                            <input type="text" name="second_section_button_text" value="<?= $row['second_section_button_text'] ?>" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <h3> Third Section</h3>
            <div class="form-group">
                <div class="col-md-4">
                    <div class="panel panel-primary" data-collapsed="0">
                        <div class="panel-heading">
                            <div class="panel-title">
                                Background Image
                            </div>
                            <div class="panel-options">
                                <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="fileinput fileinput-new" data-provides="fileinput"><input type="hidden"><input type="hidden">
                                <div class="fileinput-new thumbnail" style="min-width: 150px; max-width: 310px; height: 110px;" data-trigger="fileinput">
                                    <img src="<?= !empty($row['third_section_image']) ? get_site_image_src("images", $row['third_section_image']) : 'http://placehold.it/3000x1000' ?>" alt="--">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 320px; max-height: 160px; line-height: 6px;"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileinput-new">Select image</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" name="third_section_image" accept="image/*" >
                                    </span>
                                    <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label"> Heading <span class="symbol required">*</span></label>
                            <input type="text" name="third_section_heading" value="<?= $row['third_section_heading'] ?>" class="form-control" required>
                        </div>
                        <div class="col-md-12">
                            <label class="control-label"> Short Detail <span class="symbol required">*</span></label>
                            <textarea name="third_section_detail" id="third_section_detail" rows="6" class="form-control" required=""><?= $row['third_section_detail'] ?></textarea>
                        </div>
                        <div class="col-md-12">
                            <label class="control-label"> Button Text <span class="symbol required">*</span></label>
                            <input type="text" name="third_section_button_text" value="<?= $row['third_section_button_text'] ?>" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>
            <?php for($i=1;$i<=3;$i++):?>
            <div class="form-group">
                <div class="row col-sm-2 text-center">
                    <h1>0<?= $i?></h1>
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label"> Heading <span class="symbol required">*</span></label>
                            <input type="text" name="third_ico_heading<?=$i?>" value="<?= $row['third_ico_heading'.$i] ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label"> Detail <span class="symbol required">*</span></label>
                            <textarea name="third_ico_text<?=$i?>" rows="4" class="form-control" ><?= $row['third_ico_text'.$i] ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <?php endfor?>
            
            
            <h3>Fourth Section</h3>
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label"> Heading <span class="symbol required">*</span></label>
                    <input type="text" name="fourth_section_heading" value="<?= $row['fourth_section_heading'] ?>" class="form-control" required>
                </div>
                <div class="col-md-12">
                    <label class="control-label"> Short Detail <span class="symbol required">*</span></label>
                    <textarea name="fourth_section_detail" id="fourth_section_detail" rows="2" class="form-control" required=""><?= $row['fourth_section_detail'] ?></textarea>
                </div>
            </div>
            
            
            <h3>Fifth Section</h3>
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label"> Heading <span class="symbol required">*</span></label>
                    <input type="text" name="fifth_section_heading" value="<?= $row['fifth_section_heading'] ?>" class="form-control" required>
                </div>
                <div class="col-md-12">
                    <label class="control-label"> Short Detail <span class="symbol required">*</span></label>
                    <textarea name="fifth_section_detail" id="fifth_section_detail" rows="2" class="form-control" required=""><?= $row['fifth_section_detail'] ?></textarea>
                </div>
            </div> -->


            <!-- <h3>Tutor Section</h3>
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label"> Heading <span class="symbol required">*</span></label>
                    <input type="text" name="sixth_section_heading" value="<?php// $row['sixth_section_heading'] ?>" class="form-control" required>
                </div>
            </div> -->


            <h3>Tutor Section</h3>
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label"> Heading <span class="symbol required">*</span></label>
                    <input type="text" name="tutor_heading" value="<?= $row['tutor_heading'] ?>" class="form-control" required>
                </div>
                <div class="col-md-12">
                    <label class="control-label"> Short Detail <span class="symbol required">*</span></label>
                    <textarea name="tutor_detail" id="tutor_detail" rows="2" class="form-control" required=""><?= $row['tutor_detail'] ?></textarea>
                </div>
                <div class="col-md-12">
                    <label class="control-label"> Button Text <span class="symbol required">*</span></label>
                    <input type="text" name="tutor_button_text" value="<?= $row['tutor_button_text'] ?>" class="form-control" required>
                </div>
            </div>

            <h3>Last Section</h3>
            <?php for($ii=1;$ii<=2;$ii++):?>
            <div class="form-group">
                <div class="col-md-3">
                    <img src = "<?php echo get_site_image_src("images", $row['last_section_image'.$ii]); ?>" height = "80"><br>
                    <input type = "file" name = "last_section_image<?=$ii?>" class = "form-control file2 inline btn btn-primary" data-label = "<i class='fa fa-upload'></i> Browse" />
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label"> Heading <span class="symbol required">*</span></label>
                            <input type="text" name="last_section_heading<?=$ii?>" value="<?= $row['last_section_heading'.$ii] ?>" class="form-control" required>

                            <label class="control-label"> Link Name <span class="symbol required">*</span></label>
                            <input type="text" name="last_section_link<?=$ii?>" value="<?= $row['last_section_link'.$ii] ?>" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>
            <?php endfor ?>


            <div class="form-group">
                <label for="field-1" class="col-sm-2 control-label "></label>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary btn-lg col-md-3 pull-right"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </form>
    </div>
</div>