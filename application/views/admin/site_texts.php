<?php echo showMsg(); ?>
<?php echo getBredcrum(ADMIN, array('#' => 'Site Texts')); ?>
<h2><i class="fa fa-cogs"></i> Site <strong>Texts</strong></h2>
<div class="row col-md-12" style="display: none;">
    <form action=""  role="form" class="form-horizontal" method="post" enctype="multipart/form-data">
        <input type="hidden" name="addnewForm" value="posted">
        <div class="col-md-12">
            <div class="form-group">
                <div class="col-md-6">
                    <label class="control-label">Type</label>
                    <div class="form-group">
                        <div class="col-md-12">
                            <select name="txt_type" class="form-control">
                                <option value="alert">Alert</option>
                                <option value="email">Email</option>
                            </select>
                        </div>
                    </div> 
                </div>
                <div class="col-md-6">
                    <label class="control-label">Label</label>
                    <input type="text" name="txt_label" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6">
                    <label class="control-label">Key</label>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" name="txt_key" class="form-control" required>
                        </div>
                    </div> 
                </div>
                <div class="col-md-6">
                    <label class="control-label">Value</label>
                    <textarea  name="txt_value" rows="3" class="form-control"></textarea>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12">                
            <hr class="hr-short">
            <div class="form-group text-right">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-lg col-md-3 pull-right"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </div>
        <br>
        <br>
    </form>
</div>
<hr>
<div class="row col-md-12">
    <form role="form" class="form-horizontal" action="" method="post">
        <input type="hidden" name="textsForm" value="posted">
        <div class="col-md-8">
            <h3><i class="fa fa-envelope-o"></i> Emails</h3>
            <p>Please don't change $name in email body</p>
            <hr class="hr-short"> 
            <?php
            if (count($email_texts) > 0):
                foreach ($email_texts as $key => $rs):
                    ?>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label"><?php echo $rs->txt_label; ?> Subject</label>
                            <input type="text" name="txt_subject[<?php echo $rs->txt_id; ?>]" value="<?php echo $rs->txt_subject; ?>" class="form-control" required>
                        </div>
                    </div> 
                    <div class="form-group">
                        <div class="col-md-12">
                            <strong class="control-label"><?php echo $rs->txt_label; ?> Body <span class="symbol required"></span></strong>
                            <!-- <textarea rows="5" name="txt_value[<?php echo $rs->txt_id; ?>]" class="form-control"><?php echo $rs->txt_value; ?></textarea> -->
                            <textarea rows="5" name="txt_value[<?php echo $rs->txt_id; ?>]" class="form-control  ckeditor"><?php echo $rs->txt_value; ?></textarea>
                        </div>
                    </div>
                    <hr> 
                    <?php
                endforeach;
            endif;
            ?>
        </div>
        <div class="col-md-4">
            <h3><i class="fa fa-bell-o"></i> Alerts</h3>
            <hr class="hr-short"> 
            <?php
            if (count($alert_texts) > 0):
                foreach ($alert_texts as $key => $rs):
                    ?>
                    <div class="form-group">
                        <div class="col-md-12">
                            <strong class="control-label"><?php echo $rs->txt_label; ?> <span class="symbol required"></span></strong>
                            <textarea rows="5" name="txt_value[<?php echo $rs->txt_id; ?>]" class="form-control"><?php echo $rs->txt_value; ?></textarea>
                        </div>
                    </div> 
                    <?php
                endforeach;
            endif;
            ?>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12"><hr class="hr-short">
            <div class="form-group text-right">
                <div class="col-md-12">
                    <input type="submit" class="btn btn-green btn-lg" value="Update Texts">
                </div>
            </div>
        </div>   
        <br><br>
    </form>
</div>