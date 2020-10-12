<?php if ($this->uri->segment(3) == 'manage'): ?>
    <?= showMsg(); ?>
    <?= getBredcrum(ADMIN, array('#' => 'Add/Update Sub-Admin')); ?>
    <div class="row margin-bottom-10">
        <div class="col-md-6">
            <h2 class="no-margin"><i class="fa fa-unlock-alt" aria-hidden="true"></i> Add/Update <strong>Sub-Admin</strong></h2>
        </div>
        <div class="col-md-6 text-right">
            <a href="<?= site_url(ADMIN . '/sub-admin'); ?>" class="btn btn-lg btn-default"><i class="fa fa-arrow-left"></i> Cancel</a>
        </div>
    </div>
    <div>
        <hr>
        <div class="row col-md-12">
            <form action=""  role="form" class="form-horizontal" method="post" enctype="multipart/form-data">

                <div class="col-md-6">
                    <h3><i class="fa fa-bars"></i> Profile Detail</h3>
                    <hr class="hr-short">
                    <?php if ($row): ?>
                    <div style="font-size: 13px"><b>Last Login:</b> <small> <?= format_date($row->site_lastlogindate,'M d Y h:i:s A'); ?></small></div>
                    <?php endif ?>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label"> Name <span class="symbol required">*</span></label>
                            <input type="text" name="site_admin_name" value="<?php if (isset($row->site_admin_name)) echo $row->site_admin_name; ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label"> Status <span class="symbol required">*</span></label>
                            <select name="site_status" id="site_status" class="form-control">
                                <option value="0" <?php
                                if (isset($row->site_status) && '0' == $row->site_status) {
                                    echo 'selected';
                                }
                                ?>>InActive</option>
                                <option value="1" <?php
                                if (isset($row->site_status) && '1' == $row->site_status) {
                                    echo 'selected';
                                }
                                ?>>Active</option>
                            </select>
                        </div>
                    </div>
                </div>    
                <div class="col-md-6">

                    <div class="col-md-12">
                        <h3><i class="fa fa-lock"></i> Login Credentials</h3>
                        <hr class="hr-short">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label">Username <span class="symbol required">*</span></label>
                                <input type="text" name="site_username" value="<?php if (isset($row->site_username)) echo $row->site_username; ?>"  class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label">Password<?= empty($row)?' <span class="symbol required">*</span>':''; ?></label>
                                <input type="text"  name="site_password" value="" class="form-control" autocomplete="off" placeholder="password"<?= empty($row)?' required':''; ?> >
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="col-md-12">                
                        <hr class="hr-short">
                        <div class="form-group text-right">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Save</button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
            <div class="clearfix"></div>
        </div>
        <?php else: ?>
            <?= showMsg(); ?>
            <?= getBredcrum(ADMIN, array('#' => 'Manage Sub-Admin')); ?>
            <div class="row margin-bottom-10">
                <div class="col-md-6">
                    <h2 class="no-margin"><i class="fa fa-unlock-alt" aria-hidden="true"></i> Manage <strong>Sub-Admin</strong></h2>
                </div>
                <div class="col-md-6 text-right">
                    <a href="<?= site_url(ADMIN . '/sub-admin/manage'); ?>" class="btn btn-lg btn-primary"><i class="fa fa-plus-circle"></i> Add New</a>
                </div>
            </div>
            <table class="table table-bordered datatable" id="table-1">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">Sr#</th>
                        <th width="20%">Name</th>
                        <th>Username</th>
                        <th>Last Login</th>
                        <th width="8%" class="text-center">Status</th>
                        <th width="12%" class="text-center">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($rows) > 0): $count = 0; ?>
                        <?php foreach ($rows as $row): ?>
                            <tr class="odd gradeX">
                                <td class="text-center"><?= ++$count; ?></td>
                                <td><strong><?= $row->site_admin_name?></strong></td>
                                <td><?= $row->site_username; ?></td>
                                <td><?= format_date($row->site_lastlogindate,'M d Y h:i:s A'); ?></td>
                                <td class="text-center"><?= getStatus($row->site_status); ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> Action <span class="caret"></span></button>
                                        <ul class="dropdown-menu dropdown-primary" role="menu">
                                            <?php if ($row->site_status == '0'): ?>
                                                <li><a href="<?= site_url(ADMIN.'/sub-admin/active/'.$row->site_id); ?>">Active</a></li>
                                            <?php else: ?>
                                                <li><a href="<?= site_url(ADMIN.'/sub-admin/inactive/'.$row->site_id); ?>">Inactive</a></li>
                                            <?php endif; ?>

                                            <li><a href="<?= site_url(ADMIN.
                                            '/sub-admin/manage/'.$row->site_id); ?>">Edit</a></li>
                                            <li><a href="<?= site_url(ADMIN.'/sub-admin/delete/'.$row->site_id); ?>" onclick="return confirm('Are you sure?');">Delete</a></li>
                                            <li class="divider"></li>
                                            <li><a href="<?= site_url(ADMIN.'/sub-admin/permissions/'.$row->site_id); ?>" >Permissions</a></li>
                                        </ul>
                                    </div>  
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        <?php endif; ?>