<?php echo getBredcrum(ADMIN, array('#' => 'Phone Verification Page')); ?>
<?php echo showMsg(); ?>
<div class="row margin-bottom-10">
    <div class="col-md-6">
        <h2 class="no-margin"><i class="entypo-window"></i> Update <strong>Phone Verification Page</strong></h2>
    </div>
    <div class="col-md-6 text-right">

    </div>
</div>
<div>
    <hr>
    <div class="clearfix"></div>
    <div class="panel-body">
        <form role="form"  method="post" class="form-horizontal form-groups-bordered validate" novalidate="novalidate" enctype="multipart/form-data">
            <div class="form-group">
                <div class="col-sm-12 ">
                    <label for="field-1" class="control-label "> Heading</label>
                    <input type="text" name="pverify_heading" class="form-control" value="<?= $row['pverify_heading'] ?>" autofocus>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12 ">
                    <label for="field-1" class="control-label "> Detail</label>
                    <textarea name="pverify_detail" rows="6" class="form-control ckeditor" ><?= $row['pverify_detail'] ?></textarea>
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