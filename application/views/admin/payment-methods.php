    <?= showMsg(); ?>
    <?= getBredcrum(ADMIN, array('#' => 'Manage Payment Methods')); ?>
    <div class="row margin-bottom-10">
        <div class="col-md-12">
            <h2 class="no-margin"><i class="fa fa-th-large"></i> Manage <?php if ($this->uri->segment(4) > 0): ?><strong>"<?php echo ucwords($member_row->mem_fname.' '.$member_row->mem_lname); ?>'s "</strong> <?php endif; ?>Payment Methods</h2>
        </div>
    </div>
    <table class="table table-bordered datatable" id="table-1">
        <thead>
            <tr>
                <th width="5%" class="text-center">Sr#</th>
                <th>Method</th>
                <th>Expires</th>
                <!-- <th width="12%" class="text-center">&nbsp;</th> -->
            </tr>
        </thead>
        <tbody>
            <?php if (count($rows) > 0): $count = 0; ?>
                <?php foreach ($rows as $row): ?>
                    <tr class="odd gradeX">
                        <td class="text-center"><?= ++$count; ?></td>
                        <td>
                            <?php if (empty($row->paypal)): ?>
                                <i class="fa fa-credit-card"></i>&emsp;
                                <em>&#9679; &#9679; &#9679; &#9679; &#9679;</em> <?= $row->last_digits?>
                            <?php else:?>
                                <i class="entypo-paypal"></i>&emsp; <?= $row->paypal?>
                            <?php endif?>
                            <?php if (!empty($row->default_method)): ?>
                                <span class="miniLbl green">Default</span>
                            <?php endif ?>
                        </td>
                        <td><?= $row->expiry?></td>
                        <!-- <td class="text-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> Action <span class="caret"></span></button>
                                <ul class="dropdown-menu dropdown-primary" role="menu">
                                    <li><a href="<?= site_url(ADMIN.'/subjects/manage-subsubject/'.$row->parent_id.'/'.$row->id); ?>">Edit</a></li>
                                    <?php if(access(10)):?>
                                        <li><a href="<?= site_url(ADMIN.'/subjects/delete-subsubject/'.$row->id); ?>" onclick="return confirm('Are you sure?');">Delete</a></li>
                                    <?php endif?>
                                </ul>
                            </div>
                        </td> -->
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
