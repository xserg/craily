<?php if ($this->uri->segment(3) == 'manage-subsubject'): ?>
    <?= showMsg(); ?>
    <?= getBredcrum(ADMIN, array('#' => 'Add/Update Sub Subject')); ?>
    <div class="row margin-bottom-10">
        <div class="col-md-6">
            <h2 class="no-margin"><i class="fa fa-th-large"></i> Add/Update <?php if ($this->uri->segment(4) > 0): ?><strong>"<?= ucwords($main_subject->name); ?>"</strong><?php endif; ?> Sub Subject</h2>
        </div>
        <div class="col-md-6 text-right">
            <a href="<?= site_url(ADMIN.'/subjects/sub/'.$main_subject->id); ?>" class="btn btn-lg btn-default"><i class="fa fa-arrow-left"></i> Cancel</a>
        </div>
    </div>
    <div>
        <hr>
        <div class="row col-md-12">
            <form action=""  role="form" class="form-horizontal" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="col-md-12">
                        <label class="control-label"> Subject Title</label>
                        <input type="text" name="name" value="<?php if (isset($row->name)) echo $row->name; ?>" class="form-control" autofocus required>
                    </div>
                </div>
            <!-- <div class="form-group">
                <div class="col-md-6">
                    <label class="control-label"> Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1" <?php
                        if (isset($row->status) && '1' == $row->status) {
                            echo 'selected';
                        }
                        ?>>Active</option>
                        <option value="0" <?php
                        if (isset($row->status) && '0' == $row->status) {
                            echo 'selected';
                        }
                        ?>>InActive</option>
                    </select>
                </div>
            </div> -->
            <div class="clearfix"></div>
            <div class="col-md-12">
                <hr class="hr-short">
                <div class="form-group text-right">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-lg col-md-3 pull-right"><i class="fa fa-save"></i> Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="clearfix"></div>
</div>
<?php else: ?>
    <?= showMsg(); ?>
    <?= getBredcrum(ADMIN, array('#' => 'Manage Sub Subjects')); ?>
    <div class="row margin-bottom-10">
        <div class="col-md-6">
            <h2 class="no-margin"><i class="fa fa-th-large"></i> Manage <?php if ($this->uri->segment(4) > 0): ?><strong>"<?= ucwords($main_subject->name); ?>"</strong> <?php endif; ?>Sub Subjects</h2>
        </div>
        <div class="col-md-6 text-right">
            <a href="<?= $add_url; ?>" class="btn btn-lg btn-primary"><i class="fa fa-plus-circle"></i> Add New</a>
        </div>
    </div>
    <table class="table table-bordered datatable" id="table-1">
        <thead>
            <tr>
                <th width="5%" class="text-center">Sr#</th>
                <th>Title</th>
                <th width="12%" class="text-center">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($rows) > 0): $count = 0; ?>
                <?php foreach ($rows as $row): ?>
                    <tr class="odd gradeX">
                        <td class="text-center"><?= ++$count; ?></td>
                        <td><?= $row->name; ?></td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> Action <span class="caret"></span></button>
                                <ul class="dropdown-menu dropdown-primary" role="menu">
                                    <li><a href="<?= site_url(ADMIN.'/subjects/manage-subsubject/'.$row->parent_id.'/'.$row->id); ?>">Edit</a></li>
                                    <?php if(access(10)):?>
                                        <li><a href="<?= site_url(ADMIN.'/subjects/delete-subsubject/'.$row->id); ?>" onclick="return confirm('Are you sure?');">Delete</a></li>
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