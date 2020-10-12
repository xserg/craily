<?php echo getBredcrum(ADMIN, array('#' => 'Reset Password Page')); ?>
<?php echo showMsg(); ?>
<div class="row margin-bottom-10">
    <div class="col-md-6">
        <h2 class="no-margin"><i class="entypo-window"></i> Update <strong>Reset Password Page</strong></h2>
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
            <h3> Left Banner</h3>
            <div class="form-group">
                <div class="col-md-5">
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
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="max-width: 310px; height: 110px;" data-trigger="fileinput">
                                    <img src="<?= !empty($row['reset_image']) ? get_site_image_src("images/", $row['reset_image']) : 'http://placehold.it/3000x1000' ?>" alt="--">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 320px; max-height: 160px; line-height: 6px;"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileinput-new">Select image</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" name="reset_image" accept="image/*" <?php if(empty($row['reset_image'])){echo 'required=""';}?>>
                                    </span>
                                    <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <label class="control-label"> Heading <span class="symbol required">*</span></label>
                    <input type="text" name="reset_heading" value="<?= $row['reset_heading'] ?>" class="form-control" autofocus required>
                </div>

                <div class="col-md-7">
                    <label class="control-label"> Short Detail <span class="symbol required">*</span></label>
                    <textarea name="reset_short_detail" rows="3" class="form-control" ><?= $row['reset_short_detail'] ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group col-sm-12 ">
                    <label for="left_section" class="control-label "> Left Section</label>
                    <textarea name="left_section" rows="8" class="form-control ckeditor" required="" ><?= $row['left_section'] ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="field-1" class="col-sm-2 control-label "></label>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary btn-lg col-md-3 pull-right"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </form>
    </div>
</div>