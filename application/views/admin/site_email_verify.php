<?php echo getBredcrum(ADMIN, array('#' => 'Email Verification Page')); ?>
<?php echo showMsg(); ?>
<div class="row margin-bottom-10">
    <div class="col-md-6">
        <h2 class="no-margin"><i class="entypo-window"></i> Update <strong>Email Verification Page</strong></h2>
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
                    <input type="text" name="everify_heading" class="form-control" value="<?= $row['everify_heading'] ?>" autofocus>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12 ">
                    <label for="field-1" class="control-label "> Detail</label>
                    <textarea name="everify_detail" rows="6" class="form-control ckeditor" ><?= $row['everify_detail'] ?></textarea>
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