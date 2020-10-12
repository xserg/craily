<?php echo getBredcrum(ADMIN, array('#' => 'Privacy Policy')); ?>
<?php echo showMsg(); ?>
<div class="row margin-bottom-10">
    <div class="col-md-6">
        <h2 class="no-margin"><i class="entypo-window"></i> Update <strong>Contact Page</strong></h2>
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
            <div class="form-group">
                <div class="form-group col-sm-12 ">
                    <label for="first_heading" class="control-label "> First Heading:</label>
                    <input type="text" name="first_heading" id="first_heading" value="<?= $row['first_heading'] ?>" class="form-control" autofocus>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group col-sm-12 ">
                    <label for="detail" class="control-label "> Detail</label>
                    <textarea name="detail" rows="8" class="form-control ckeditor" ><?= $row['detail'] ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group col-sm-12 ">
                    <label for="second_heading" class="control-label "> Second Heading:</label>
                    <input type="text" name="second_heading" id="second_heading" value="<?= $row['second_heading'] ?>" class="form-control" autofocus>
                    <label for="second_head_text" class="control-label "> Second Text:</label>
                    <input type="text" name="second_head_text" id="second_head_text" value="<?= $row['second_head_text'] ?>" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="form-group col-sm-12 ">
                    <label for="third_heading" class="control-label "> Third Heading:</label>
                    <input type="text" name="third_heading" id="third_heading" value="<?= $row['third_heading'] ?>" class="form-control" autofocus>
                </div>
            </div>
            <div class="form-group">
                <label for="field-1" class="col-sm-2 control-label "></label>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary btn-lg col-md-3 pull-right"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
            <hr class="hr-short">
        </form>
    </div>
    <div class="clearfix"></div>
</div>