<?php echo getBredcrum(ADMIN, array('#' => 'About Page')); ?>
<?php echo showMsg(); ?>
<div class="row margin-bottom-10">
    <div class="col-md-6">
        <h2 class="no-margin"><i class="entypo-window"></i> Update <strong>About Page</strong></h2>
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
                    <label for="field-1" class="control-label "> About Heading</label>
                    <input type="text" name="about_heading" class="form-control" value="<?= $row['about_heading'] ?>" autofocus>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12 ">
                    <label for="field-1" class="control-label "> Founder Heading</label>
                    <input type="text" name="founder_heading" class="form-control" value="<?= $row['founder_heading'] ?>">
                </div>
            </div>
            <!-- <div class="form-group">
                <div class="col-sm-4 ">
                    <label for="field-1" class="control-label "> Customers</label>
                    <input type="text" name="about_customers" class="form-control" value="<?= $row['about_customers'] ?>">
                </div>
                <div class="col-sm-4 ">
                    <label for="field-1" class="control-label "> Cities</label>
                    <input type="text" name="about_cities" class="form-control" value="<?= $row['about_cities'] ?>">
                </div>
                <div class="col-sm-4 ">
                    <label for="field-1" class="control-label "> Listing Worldwide</label>
                    <input type="text" name="about_listing" class="form-control" value="<?= $row['about_listing'] ?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12 ">
                    <img src = "<?= get_site_image_src("images/", $row['about_image']); ?>" height = "80"><br>
                    <input type = "file" name = "about_image" id = "about_image" class = "form-control file2 inline btn btn-primary" data-label = "<i class='fa fa-upload'></i> Browse" />
                </div>
            </div>
             -->
            <div class="form-group">
                <div class="form-group col-sm-12 ">
                    <label for="field-1" class="control-label "> About</label>
                    <textarea name="about_txt" rows="6" class="form-control ckeditor" ><?= $row['about_txt'] ?></textarea>
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