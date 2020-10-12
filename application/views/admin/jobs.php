<?php if ($this->uri->segment(3) == 'manage'): ?>
    <?= showMsg(); ?>
    <?= getBredcrum(ADMIN, array('#' => 'Add/Update Jobs')); ?>
    <div class="row margin-bottom-10">
        <div class="col-md-6">
            <h2 class="no-margin"><i class="entypo-users"></i> Add/Update <strong>Jobs</strong></h2>
        </div>
        <div class="col-md-6 text-right">
            <a href="<?= site_url(ADMIN . '/jobs'); ?>" class="btn btn-lg btn-default"><i class="fa fa-arrow-left"></i> Cancel</a>
        </div>
    </div>
    <div>
        <hr>
        <div class="row col-md-12">
            <form action=""  role="form" class="form-horizontal" method="post" enctype="multipart/form-data">

                <div class="col-md-12">
                    <h3><i class="fa fa-bars"></i> Job Detail</h3>
                    <hr class="hr-short">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label"> Title <span class="symbol required">*</span></label>
                            <input type="text" name="title" value="<?php if (isset($row->title)) echo $row->title; ?>" class="form-control" autofocus required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4">
                            <div class="inputbox_group">
                                <label class="control-label"> Budget <span class="symbol required">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="number" name="budget" value="<?php if (isset($row->budget)) echo $row->budget; ?>" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label"> Subject <span class="symbol required">*</span></label>
                            <input type="text" name="subject" value="<?php if (isset($row->subject)) echo $row->subject; ?>" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label"> Country</label>
                            <select id="grade_level" name="grade_level" class="form-control">
                                <option value="">Your Grade Level</option>
                                <?php foreach ($grade_levels as $key => $grade_level): ?>
                                    <option value="<?= $grade_level->name?>"<?= $grade_level->name==$row->grade_level?' selected=""':''?>><?= $grade_level->name?></option>
                                <?php endforeach ?>
                                
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4">
                            <label class="control-label"> City <span class="symbol required">*</span></label>
                            <input type="text" name="city" value="<?php if (isset($row->city)) echo $row->city; ?>" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="control-label"> State <span class="symbol required">*</span></label>
                            <input type="text" name="state" value="<?php if (isset($row->state)) echo $row->state; ?>" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="control-label"> Zip Code <span class="symbol required">*</span></label>
                            <input type="text" name="zip" value="<?php if (isset($row->zip)) echo $row->zip; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label"> Detail <span class="symbol required">*</span></label>
                            <textarea name="detail" id="detail" class="form-control"><?php if (isset($row->detail)) echo $row->detail; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4">
                            <label class="control-label"> Status <span class="symbol required">*</span></label>
                            <select name="status" id="status" class="form-control">
                                <option value="0" <?php
                                if (isset($row->status) && '0' == $row->status) {
                                    echo 'selected';
                                }
                                ?>>InActive</option>
                                <option value="1" <?php
                                if (isset($row->status) && '1' == $row->status) {
                                    echo 'selected';
                                }
                                ?>>Active</option>
                            </select>
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

            </form>
            <input type="file" id="uploadFile" name="uploadFile" accept="image/*" class="uploadFile" data-file="">
            <div class="clearfix"></div>
        </div>
        <?php else: ?>
            <?= showMsg(); ?>
            <?= getBredcrum(ADMIN, array('#' => 'Manage Jobs')); ?>
            <div class="row margin-bottom-10">
                <div class="col-md-6">
                    <h2 class="no-margin"><i class="entypo-users"></i> Manage <strong>Jobs</strong></h2>
                </div>
                <!-- <div class="col-md-6 text-right">
                    <a href="<?= site_url(ADMIN . '/jobs/manage'); ?>" class="btn btn-lg btn-primary"><i class="fa fa-plus-circle"></i> Add New</a>
                </div> -->
            </div>
            <table class="table table-bordered datatable" id="table-1">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">Sr#</th>
                        <th width="60px">Photo</th>
                        <th>Title</th>
                        <th>Subject</th>
                        <th>Grade Level</th>
                        <th>Budget</th>
                        <th>Date</th>
                        <th width="8%" class="text-center">Status</th>
                        <th width="12%" class="text-center">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($rows) > 0): $count = 0; ?>
                        <?php foreach ($rows as $row): ?>
                            <tr class="odd gradeX">
                                <td class="text-center"><?= ++$count; ?></td>
                                <td class="text-center">
                                        <a href="<?= site_url(ADMIN.'/students/manage/'.$row->mem_id)?>" target="_blank" title="<?= $row->mem_name?>">
                                    <div class="icoRound">
                                        <img src = "<?= get_image_src($row->mem_image,50,true); ?>" height = "60">
                                    </div>
                                    </a>
                                </td>
                                <td><?= $row->title; ?></td>
                                <td><?= $row->subject; ?></td>
                                <td><?= $row->grade_level; ?></td>
                                <td><?= $row->budget; ?></td>
                                <td><?= format_date($row->date,'M d Y h:i:s A'); ?></td>
                                <td class="text-center"><?= getStatus($row->status); ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> Action <span class="caret"></span></button>
                                        <ul class="dropdown-menu dropdown-primary" role="menu">
                                            <?php if ($row->mem_status == '0'): ?>
                                                <li><a href="<?= site_url(ADMIN.'/jobs/active/'.$row->mem_id); ?>">Active</a></li>
                                                <?php else: ?>
                                                    <li><a href="<?= site_url(ADMIN.'/jobs/inactive/'.$row->mem_id);?>">Inactive</a></li>
                                                <?php endif; ?>

                                                <li><a href="<?= site_url(ADMIN.'/jobs/manage/'.$row->mem_id); ?>">Edit</a></li>
                                        <li><a href="<?= site_url(ADMIN.'/jobs/delete/'.$row->mem_id); ?>" onclick="return confirm('Are you sure?');">Delete</a></li>
                                    </ul>
                                </div>  
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    <?php endif; ?>