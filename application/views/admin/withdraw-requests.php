<?php if ($this->uri->segment(3) == 'detail'): ?>
    <?= showMsg(); ?>
    <?= getBredcrum(ADMIN, array('#' => 'Detail Withdraw Request')); ?>
    <div class="row margin-bottom-10">
        <div class="col-md-6">
            <h2 class="no-margin"><i class="entypo-list"></i> <strong>Withdraw</strong> Detail</h2>
        </div>
        <div class="col-md-6 text-right">
            <a href="<?= site_url(ADMIN . '/withdraws'); ?>" class="btn btn-lg btn-default"><i class="fa fa-arrow-left"></i> Cancel</a>
        </div>
    </div>
    <div>
        <hr>
        <div class="row col-md-12">
            <form action="<?=site_url(ADMIN.'/withdraws/mark-paid/'.$row->id)?>" name="frmPartner" role="form" class="form-horizontal" method="post" enctype="multipart/form-data">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td><strong>Name:</strong></td>
                        <td><?=ucwords($member->mem_fname.' '.$member->mem_lname)?></td>
                        <td><strong>Date:</strong></td>
                        <td><?= format_date($row->date ,'M d, Y H:i A')?></td>
                    </tr>
                    <tr>
                        <td><strong>Total Amount:</strong></td>
                        <td><span style="font-size:14px; font-weight: bold; color:green"><?= format_amount($row->amount)?></span></td>
                        <td><strong>Status:</strong></td>
                        <td><?= get_paid_status($row->status)?></td>
                    </tr>
                    <?php if($row->status==1):?>
                        <tr>
                            <td><strong>Bank:</strong></td>
                            <td><?= $bank_row->acc_bank_name?> (<?= $bank_row->acc_number?>)</td>
                            <td><strong>Paid Date:</strong></td>
                            <td><?= format_date($row->paid_date ,'M d, Y H:i A')?></td>
                        </tr>
                    <?php endif?>
                </tbody>
            </table>
            <?php if($row->status==0):?>
                <div class="form-group">
                    <div class="col-md-6">
                        <label class="control-label"> Select Bank</label>
                        <select name="bank" id="bank" class="select2">
                            <?php foreach ($banks as $bank_row): ?>
                                <option value="<?= $bank_row->id?>"<?= empty($bank_row->default_method)?'':'  selected=""'?>><?= $bank_row->acc_bank_name?> (<?= $bank_row->acc_number?>)</option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="form-group text-right">
                    <div class="col-md-12">
                        <button type="submit" onClick="return confirm('Complete this transaction you should have to pay this amount manually to the user! Are you sure mark paid that amount?')" class="btn btn-primary btn-lg col-md-2 pull-right"><i class="fa fa-save"></i> Mark Complete</button>
                    </div>
                </div>
            <?php endif?>
            </form>
        </div>
    </div>
<?php else: ?>
    <?= showMsg(); ?>
    <?= getBredcrum(ADMIN, array('#' => 'Manage Withdraw Requests')); ?>
    <div class="row margin-bottom-10">
        <div class="col-md-12">
            <h2 class="no-margin"><i class="entypo-list"></i> Manage <?php if ($this->uri->segment(4) > 0): ?><strong>" <?php echo ucwords($member_row->mem_fname.' '.$member_row->mem_lname); ?> "</strong> <?php endif; ?>Withdraw Requests</h2>
        </div>
    </div>
    <table class="table table-bordered datatable" id="table-1">
        <thead>
            <tr>
                <th width="5%" class="text-center">Sr#</th>
                <th>Member</th>
                <th>Date</th>
                <th>Amount</th>
                <th width="12%" class="text-center">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($rows) > 0): $count = 0; ?>
                <?php foreach ($rows as $row): ?>
                    <tr class="odd gradeX">
                        <td class="text-center"><?= ++$count; ?></td>
                        <td><b><a href="<?= site_url(ADMIN.'/tutors/manage/'.$row->mem_id)?>" target="_blank"><?= get_mem_name($row->mem_id); ?></a></b></td>
                        <td><?= format_date($row->date, 'M d, Y h:m:i a'); ?></td>
                        <td><?= format_amount($row->amount); ?></td>
                        <td class="text-center">
                            <a href="<?= site_url(ADMIN.'/withdraws/detail/'.$row->id); ?>" class="btn btn-primary btn-sm">View</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
<?php endif; ?>
<script type="text/javascript">
    (function($){
        $(function(){

        })
    }(jQuery))
</script>