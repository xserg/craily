<?php echo getBredcrum(ADMIN, array('#' => 'Search Page')); ?>
<?php echo showMsg(); ?>
<div class="row margin-bottom-10">
    <div class="col-md-6">
        <h2 class="no-margin"><i class="entypo-window"></i> Update <strong>Search Page</strong></h2>
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
            <h3> Search Page</h3>
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label"> Page Title <span class="symbol required">*</span></label>
                    <input type="text" name="page_title" value="<?= $row['page_title'] ?>" class="form-control" required>
                </div>
                <div class="col-md-12">
                    <label class="control-label"> Heading <span class="symbol required">*</span></label>
                    <input type="text" name="heading" value="<?= $row['heading'] ?>" class="form-control" required>
                </div>
                <div class="col-md-12">
                    <label class="control-label"> Short Description <span class="symbol required">*</span></label>
                    <input type="text" name="description" value="<?= $row['description'] ?>" class="form-control" required>
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