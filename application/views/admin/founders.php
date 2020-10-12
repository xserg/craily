<?php if ($this->uri->segment(3) == 'manage'): ?>
    <?php echo showMsg(); ?>
    <?php echo getBredcrum(ADMIN, array('#' => 'Add/Update Founders')); ?>
    <div class="row margin-bottom-10">
        <div class="col-md-6">
            <h2 class="no-margin"><i class="entypo-users"></i> Add/Update <strong>Founder</strong></h2>
        </div>
        <div class="col-md-6 text-right">
            <a href="<?php echo base_url(ADMIN . '/founders'); ?>" class="btn btn-lg btn-default"><i class="fa fa-arrow-left"></i> Cancel</a>
        </div>
    </div>
    <div>
        <hr>
        <div class="row col-md-12">
            <form action=""  role="form" class="form-horizontal" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="col-md-6">
                        <label class="control-label"> Name <span class="symbol required">*</span></label>
                        <input type="text" name="name" value="<?php if (isset($row->name)) echo $row->name; ?>" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="control-label"> Designation <span class="symbol required">*</span></label>
                        <input type="text" name="designation" value="<?php if (isset($row->designation)) echo $row->designation; ?>" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <label class="control-label"> Overview <span class="symbol required">*</span></label>
                        <textarea  name="overview" rows="8" class="form-control" required><?php if (isset($row->overview)) echo $row->overview; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class = "col-md-12">
                        <img src = "<?=  get_site_image_src("founders/",$row->image,'thumb_'); ?>" height = "80"><br>
                        <input type = "file" name = "image" id = "image" class = "form-control file2 inline btn btn-primary" data-label = "<i class='fa fa-upload'></i> Browse" />
                        <div><br />
                            <small style = "color:#F00;">* Best resolution is <strong>600 x 600</strong>.</small><br />
                            <small style = " color:#F00;">* Allowed formats are <strong>JPG | JPEG | PNG</strong>.</small><br>
                            <small style = "color:#F00;">* Image size maximum <strong>2MB</strong> allowed.</small>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-md-12">
                    <div class="form-group text-right">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-lg col-md-3 pull-right"><i class="fa fa-save"></i> Save</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="clearfix"></div>
        </div>
    </div>
<?php else: ?>
    <?php echo showMsg(); ?>
    <?php echo getBredcrum(ADMIN, array('#' => 'Manage Founders')); ?>
    <div class="row margin-bottom-10">
        <div class="col-md-6">
            <h2 class="no-margin"><i class="entypo-users"></i> Manage <strong>Founders</strong></h2>
        </div>
        <div class="col-md-6 text-right">
            <a href="<?php echo base_url(ADMIN . '/founders/manage'); ?>" class="btn btn-lg btn-primary"><i class="fa fa-plus-circle"></i> Add New</a>
        </div>
    </div>
    <table class="table table-bordered datatable" id="table-1">
        <thead>
            <tr>
                <th width="5%" class="text-center">Sr#</th>
                <th width="10%">Photo</th>
                <th width="20%">Name</th>
                <th>Designation</th>
                <th width="12%" class="text-center">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($rows) > 0): $count = 0; ?>
                <?php foreach ($rows as $row): ?>
                    <tr class="odd gradeX">
                        <td class="text-center"><?php echo ++$count; ?></td>
                        <td class="text-center"><img src = "<?=  get_site_image_src("founders/",$row->image,'thumb_'); ?>" height = "60"></td>
                        <td><?php echo $row->name ?></td>
                        <td><?php echo $row->designation; ?></td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> Action <span class="caret"></span></button>
                                <ul class="dropdown-menu dropdown-primary" role="menu">
                                    <li><a href="<?php echo base_url(ADMIN.'/founders/manage/'.$row->id); ?>">Edit</a></li>
                                    <?php if(access(10)):?>
                                        <li><a href="<?php echo base_url(ADMIN.'/founders/delete/'.$row->id); ?>" onclick="return confirm('Are you sure?');">Delete</a></li>
                                    <?php endif?>
                                </ul>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
<?php endif; ?>