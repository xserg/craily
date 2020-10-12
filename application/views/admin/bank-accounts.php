    <?= showMsg(); ?>
    <?= getBredcrum(ADMIN, array('#' => 'Manage Bank Accounts')); ?>
    <div class="row margin-bottom-10">
        <div class="col-md-12">
            <h2 class="no-margin"><i class="fa fa-th-large"></i> Manage <?php if ($this->uri->segment(4) > 0): ?><strong>"<?php echo ucwords($member_row->mem_fname.' '.$member_row->mem_lname); ?>'s "</strong> <?php endif; ?>Bank Accounts</h2>
        </div>
    </div>
    <table class="table table-bordered datatable" id="table-1">
        <thead>
            <tr>
                <th width="5%" class="text-center">Sr#</th>
                <th>Stripe Id</th>
                <th>Bank Name</th>
                <th>Account Title</th>
                <th>Account Number</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($rows) > 0): $count = 0; ?>
                <?php foreach ($rows as $row): ?>
                    <tr class="odd gradeX">
                        <td class="text-center"><?= ++$count; ?></td>
                        <td><?= $row->stripe_id; ?></td>
                        <td>
                            <?= $row->acc_bank_name?>
                            <?php if (!empty($row->default_method)): ?>
                                &emsp;
                                <span class="miniLbl green">Default</span>
                            <?php endif ?>
                        </td>
                        <td><?= $row->acc_title?></td>
                        <td><?= $row->acc_number?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
