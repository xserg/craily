<?php if ($this->uri->segment(3) == 'generate-new'): ?>
    <?= showMsg(); ?>
    <?= getBredcrum(ADMIN, array('#' => 'Generate Promo Codes')); ?>
    <div class="row margin-bottom-10">
        <div class="col-md-6">
            <h2 class="no-margin"><i class="entypo-list"></i> Generate <strong>Promo Codes</strong></h2>
        </div>
        <div class="col-md-6 text-right">
            <a href="<?= site_url(ADMIN . '/promocodes'); ?>" class="btn btn-lg btn-default"><i class="fa fa-arrow-left"></i> Cancel</a>
        </div>
    </div>
    <div>
        <hr>
        <div class="row col-md-12">
            <form action=""  role="form" class="form-horizontal" method="post" enctype="multipart/form-data">

                <div class="col-md-12">
                    <h3><i class="fa fa-ticket"></i> Promo Codes Detail</h3>
                    <hr class="hr-short">
                    <div class="form-group">
                        <div class="row" style="margin:0 0 0 0 !important">
                            <div class="col-md-4">
                                <select name="generate-mode" class="form-control generate-mode" required="" autofocus="">
                                    <option value="auto" selected>Generate PromoCode Automatically</option>
                                    <option value="manual">Input PromoCode Manually</option>
                                </select>
                            </div>
                        </div>
                        <div class="row" style="margin:30px 0 0 0 !important">
                            <div class="col-md-3 how-many">
                                <label class="control-label"> How many</label>
                                <input type="number" name="codes" class="form-control" required="" autofocus="">
                            </div>
                            <div class="col-md-3">
                                <label class="control-label"> Type</label>
                                <select id="code_type" name="code_type" class="form-control" required="">
                                    <option value="percent"> Percentage</option>
                                    <option value="fixed"> Fixed</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label"> Value</label>
                                <input type="number" step="0.1" name="code_value" id="code_value" class="form-control" required="">
                            </div>
                            <div class="col-md-3 promo-code" style="display:none">
                                <label class="control-label"> Promo Code</label>
                                <input name="promo_code" class="form-control" required="" autofocus="" disabled>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label"> Expire Date</label>
                                <input type="date" name="expire_date" class="form-control" required="" autofocus="">
                            </div>
                        </div>
                    </div>
                    <script>
                        (function($) {
                            'use strict';
                            $(document).ready(function(){
                                $(".generate-mode").change(function(){
                                    if($(this).val() == "auto"){
                                        $(".promo-code").css("display","none");
                                        $(".promo-code input").prop("disabled",true);
                                        $(".how-many").css("display","block");
                                        $(".how-many input").prop("disabled",false);
                                    }
                                    else if($(this).val() == "manual") {
                                        $(".promo-code").css("display","block");
                                        $(".promo-code input").prop("disabled",false);
                                        $(".how-many").css("display","none");
                                        $(".how-many input").prop("disabled",true);
                                    }
                                });
                            });
                        })(jQuery);
                        
                    </script>
                </div>
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
    <?php else: ?>
        <?= showMsg(); ?>
        <?= getBredcrum(ADMIN, array('#' => 'Manage Promo Codes')); ?>
        <div class="row margin-bottom-10">
            <div class="col-md-6">
                <h2 class="no-margin"><i class="entypo-list"></i> Manage <strong>Generate Promo Codes</strong></h2>
            </div>
            <div class="col-md-6 text-right">
                <a href="<?= site_url(ADMIN . '/promocodes/generate-new'); ?>" class="btn btn-lg btn-primary"><i class="fa fa-plus-circle"></i> Generate New</a>
            </div>
        </div>
        <table class="table table-bordered datatable" id="table-1">
            <thead>
                <tr>
                    <th width="5%" class="text-center">Sr#</th>
                    <th>Code</th>
                    <th>Code Type</th>
                    <th>Code Value</th>
                    <th>Created Date</th>
                    <th>Expire Date</th>
                    <th width="5%">Status</th>
                    <th width="12%" class="text-center">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($rows) > 0): $count = 0; ?>
                    <?php foreach ($rows as $row): ?>
                        <tr class="odd gradeX">
                            <td class="text-center"><?= ++$count; ?></td>
                            <td><?= $row->code; ?></td>
                            <td><?= ucfirst($row->code_type); ?></td>
                            <td><?= $row->code_type=='fixed'?format_amount($row->code_value):$row->code_value.'%'; ?></td>
                            <td><?= format_date($row->date); ?></td>
                            <td><?= format_date($row->expire_date); ?></td>
                            <td><?= get_promocode_status($row->status)?></td>
                            <td class="text-center">
                                <?php if ($row->status==0): ?>
                                    <a href="<?= site_url(ADMIN.'/promocodes/delete/'.$row->id); ?>" onclick="return confirm('Delete?')" class="btn btn-primary">Delete</a>
                                <?php else:?>
                                    <button type="button" onclick="alert('This promo code is used, it can\'t be deleted')" class="btn btn-default disabled" disabled="">Delete</a>
                                <?php endif ?>
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
                $('#printBtn').click(function(){
                    setTimeout(function(){
                        location.reload();
                    },100)
                })
            })
        }(jQuery))
    </script>