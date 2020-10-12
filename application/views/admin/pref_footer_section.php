<?php echo getBredcrum(ADMIN, array('#' => 'Footer Section')); ?>
<?php echo showMsg(); ?>
<div class="row margin-bottom-10">
    <div class="col-md-6">
        <h2 class="no-margin"><i class="entypo-window"></i> Update <strong>Footer Section</strong></h2>
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
            <h3> Footer Text</h3>
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label"> Main line <span class="symbol required">*</span></label>
                    <input type="text" name="pref_detail" value="<?= $row->pref_detail ?>" class="form-control" required>
                </div>
                <div class="col-md-12">
                    <label class="control-label"> Button Text <span class="symbol required">*</span></label>
                    <input type="text" name="pref_image" value="<?= $row->pref_image ?>" class="form-control" required>
                </div>
                <div class="col-md-12">
                    <label class="control-label"> Heading <span class="symbol required">*</span></label>
                    <input type="text" name="pref_title" value="<?= $row->pref_title ?>" class="form-control" required>
                </div>
                <div class="col-md-12">
                    <label class="control-label"> Short Description <span class="symbol required">*</span></label>
                    <input type="text" name="pref_short_desc" value="<?= $row->pref_short_desc ?>" class="form-control" required>
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