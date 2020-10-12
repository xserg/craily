<?php if ($this->uri->segment(3) == 'detail'): ?>
    <?= showMsg(); ?>
    <?= getBredcrum(ADMIN, array('#' => 'Transaction Detail')); ?>
    <div class="row margin-bottom-10">
        <div class="col-md-6">
            <h2 class="no-margin"><i class="entypo-list"></i> <strong> Transaction</strong> Detail</h2>
        </div>
        <div class="col-md-6 text-right">
            <a href="<?= site_url(ADMIN . '/transactions'); ?>" class="btn btn-lg btn-default"><i class="fa fa-arrow-left"></i> Cancel</a>
        </div>
    </div>
    <div>
        <hr>
        <div class="row col-md-12">
            <h3><i class="fa fa-bars"></i> Transaction Detail </h3>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td><strong>Tutor Name:</strong></td>
                        <td><?=ucwords($member->mem_fname.' '.$member->mem_lname)?></td>
                        <td><strong>Status:</strong></td>
                        <td><?=get_paid_status($row->status)?></td>
                    </tr>
                    <tr>
                        <td width="120"><strong>Stduent Name:</strong></td>
                        <td><?= $row->mem_name?></td>
                        <td><strong>Stduent Email:</strong></td>
                        <td><?= $row->mem_email?></td>
                    </tr>
                    <tr>
                        <td><strong>Subject:</strong></td>
                        <td><?= $row->subject?></td>
                        <td><strong>Date:</strong></td>
                        <td><?= format_date($row->date)?></td>
                    </tr>
                    <tr>
                        <td><strong>Start Time:</strong></td>
                        <td><?= format_date($row->lesson_date_time,'h:i A')?></td>
                        <td><strong>Hours:</strong></td>
                        <td><?= $row->hours?></td>
                    </tr>
                    <tr>
                        <td><strong>Trans Amount:</strong></td>
                        <td><span style="font-size:14px; font-weight: bold; color:red"><?= format_amount($row->trx_amount)?></span></td>
                        <td><strong>Lesson Amount:</strong></td>
                        <td><span style="font-size:14px; font-weight: bold; color:green"><?= format_amount($row->amount)?></span></td>
                    </tr>
                    <tr>
                        <td><strong>Location:</strong></td>
                        <td colspan="3"><?= $row->address?></td>
                    </tr>
                    <tr>
                        <td><strong>Message:</strong></td>
                        <td colspan="3"><?= $row->detail?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
<?php else: ?>
    <?= showMsg(); ?>
    <?= getBredcrum(ADMIN, array('#' => 'Transactions Management')); ?>
    <div class="row margin-bottom-10">
        <div class="col-md-12">
            <h2 class="no-margin"><i class="entypo-list"></i> Manage <?php if ($this->uri->segment(4) > 0): ?><strong>" <?php echo ucwords($member_row->mem_fname.' '.$member_row->mem_lname); ?> "</strong> <?php endif; ?>Transactions</h2>
        </div>
    </div>
    <table class="table table-bordered datatable" id="table-1">
        <thead>
            <tr>
                <th width="5%" class="text-center">Sr#</th>
                <th width="5%" class="text-center">ID#</th>
                <th>Tutor</th>
                <th>Date</th>
                <th>Amount</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($rows) > 0): $count = 0; ?>
                <?php foreach ($rows as $row): ?>
                    <tr class="odd gradeX">
                        <td class="text-center"><?= ++$count; ?></td>
                        <td class="text-center"><?= num_size($row->id); ?></td>
                        <td><b><a href="<?= site_url(ADMIN.'/tutors/manage/'.$row->mem_id); ?>" target="_blank"><?= get_mem_name($row->mem_id); ?></a></b></td>
                        <td><?= format_date($row->date,'M d, Y h:i:m a'); ?></td>
                        <td><?= format_amount($row->amount); ?></td>
                        <td class="text-center">
                            <a href="<?= site_url(ADMIN.'/transactions/detail/'.$row->id); ?>" class="btn btn-primary btn-sm">Detail</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
<?php endif?>
<script type="text/javascript">
    (function($){
        $(function(){

        })
    }(jQuery))
</script>