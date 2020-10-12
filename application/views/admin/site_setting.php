<?php echo showMsg(); ?>
<?php echo getBredcrum(ADMIN, array('#' => 'Site Settings')); ?>
<div class="row margin-bottom-10">
    <div class="col-md-6">
        <!-- <h2 class="no-margin"><i class="entypo-window"></i> Update <strong>About Page</strong></h2> -->
        <h2 class="no-margin"><i class="fa fa-cogs"></i> Site <strong>Settings</strong></h2>
    </div>
    <div class="col-md-6 text-right">
        <a href="<?= site_url(ADMIN . '/settings/clear-cashe'); ?>" class="btn btn-lg btn-primary"><i class="fa fa-refresh"></i> Clear Cache</a>
    </div>
</div>
<hr>
<div class="row col-md-12">
    <form role="form" class="form-horizontal" action="<?= base_url(ADMIN) ?>/settings/save" method="post">
        <div class="col-md-6">
            <h3><i class="fa fa-bars"></i> Meta Tags</h3>
            <hr class="hr-short">
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label"> Meta Description <span class="symbol required"></span></label>
                    <input type="text" name="site_meta_desc" value="<?php if (isset($adminsite_setting->site_meta_desc)) echo $adminsite_setting->site_meta_desc; ?>" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label"> Meta Keywords <span class="symbol required"></span></label>
                    <input type="text" name="site_meta_keyword" value="<?php if (isset($adminsite_setting->site_meta_keyword)) echo $adminsite_setting->site_meta_keyword; ?>" class="form-control" required>
                </div>
            </div>
            <!-- <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label"> Meta Copyright <span class="symbol required"></span></label>
                    <input type="text" name="site_meta_copyright" value="<?php if (isset($adminsite_setting->site_meta_copyright)) echo htmlentities($adminsite_setting->site_meta_copyright); ?>" class="form-control" required>
                </div>
            </div> -->
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label"> Meta Author <span class="symbol required"></span></label>
                    <input type="text" name="site_meta_author" value="<?php if (isset($adminsite_setting->site_meta_author)) echo $adminsite_setting->site_meta_author; ?>" class="form-control" required>
                </div>
            </div>
                            <h3><i class="fa fa-bars"></i> Social Media</h3>
                            <hr class="hr-short">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label"> Facebook Link</label>
                                    <input type="text" name="site_facebook" value="<?php if (isset($adminsite_setting->site_facebook)) echo $adminsite_setting->site_facebook; ?>" class="form-control" required>
                                </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label"> Twitter Link</label>
                                        <input type="text" name="site_twitter" value="<?php if (isset($adminsite_setting->site_twitter)) echo $adminsite_setting->site_twitter; ?>" class="form-control" required>
                                    </div>
                                    </div>
            <!-- <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label"> Google Link</label>
                <input type="text" name="site_google" value="<?php if (isset($adminsite_setting->site_google)) echo $adminsite_setting->site_google; ?>"  class="form-control" required>
                </div>
            </div> -->
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label"> Instagram Link</label>
                    <input type="text" name="site_instagram" value="<?php if (isset($adminsite_setting->site_instagram)) echo $adminsite_setting->site_instagram; ?>" class="form-control" required>
                </div>
                </div>
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label"> LinkedIn Link</label>
                    <input type="text" name="site_linkedin" value="<?php if (isset($adminsite_setting->site_linkedin)) echo $adminsite_setting->site_linkedin; ?>" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label"> Youtube Link</label>
                    <input type="text" name="site_youtube" value="<?php if (isset($adminsite_setting->site_youtube)) echo $adminsite_setting->site_youtube; ?>" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h3><i class="fa fa-bars"></i> General Detail</h3>
            <hr class="hr-short">
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label"> Site Domain <span class="symbol required"></span></label>
                    <input type="text" name="site_domain" value="<?php if (isset($adminsite_setting->site_domain)) echo $adminsite_setting->site_domain; ?>" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label"> Site Name <span class="symbol required"></span></label>
                    <input type="text" name="site_name" value="<?php if (isset($adminsite_setting->site_name)) echo $adminsite_setting->site_name; ?>" class="form-control" required>
                </div>
            </div>
            <!-- <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label"> Copyright Message <span class="symbol required"></span></label>
                <input type="text" name="site_copyright" value="<?php if (isset($adminsite_setting->site_copyright)) echo $adminsite_setting->site_copyright; ?>" class="form-control" required>
                </div>
            </div> -->
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label"> Site Email <span class="symbol required"></span></label>
                    <input type="text" name="site_email" value="<?php if (isset($adminsite_setting->site_email)) echo $adminsite_setting->site_email; ?>" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label"> Site No-Reply Email <span class="symbol required"></span></label>
                    <input type="text" name="site_noreply_email" value="<?php if (isset($adminsite_setting->site_noreply_email)) echo $adminsite_setting->site_noreply_email; ?>" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label"> Site Phone <span class="symbol required"></span></label>
                    <input type="text" name="site_phone" value="<?php if (isset($adminsite_setting->site_phone)) echo $adminsite_setting->site_phone; ?>"  class="form-control" required>
                </div>
            </div>
            <!-- <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label"> Site Fax</label>
                    <input type="text" name="site_fax" value="<?php if (isset($adminsite_setting->site_fax)) echo $adminsite_setting->site_fax; ?>"  class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label"> Pay-pal Email</label>
                    <input type="text" name="site_paypal" value="<?php if (isset($adminsite_setting->site_paypal)) echo $adminsite_setting->site_paypal; ?>"  class="form-control">
                </div>
            </div> -->
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label"> Address <span class="symbol required"></span></label>
                    <textarea rows="5" name="site_address" class="form-control"><?php if (isset($adminsite_setting->site_address)) echo ($adminsite_setting->site_address); ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label"> Site Percentage <span class="symbol required"></span></label>
                    <input type="number" step="0.01" name="site_percentage" value="<?php if (isset($adminsite_setting->site_percentage)) echo $adminsite_setting->site_percentage; ?>"  class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label"> Background Check Price<span class="symbol required"></span></label>
                    <input type="number" step="0.01" name="site_background_check_price" value="<?php if (isset($adminsite_setting->site_background_check_price)) echo $adminsite_setting->site_background_check_price; ?>"  class="form-control" required>
                </div>
            </div>
            <!-- <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label"> About Us <span class="symbol required"></span></label>
                    <textarea rows="5" name="site_about" class="form-control"><?php if (isset($adminsite_setting->site_about)) echo ($adminsite_setting->site_about); ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label"> Site Contact Map <span class="symbol required"></span></label>
                    <textarea rows="6" name="site_contact_map" class="form-control"><?php if (isset($adminsite_setting->site_contact_map)) echo ($adminsite_setting->site_contact_map); ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label"> Google Adsense Ad <span class="symbol required"></span></label>
                    <textarea rows="4" name="site_google_ad" class="form-control"><?php if (isset($adminsite_setting->site_google_ad)) echo ($adminsite_setting->site_google_ad); ?></textarea>
                </div>
            </div> 
        </div>
                <div class="col-md-6">
            <h3><i class="fa fa-bars"></i> Euro  Amount</h3>
            <hr class="hr-short">
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label">Amount <span class="symbol required"></span></label>
                <input type="number" name="euro_amount" value="<?php if (isset($adminsite_setting->euro_amount)) echo $adminsite_setting->euro_amount; ?>" class="form-control" required>
                </div>
            </div></div>-->
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label"> Chat Code <span class="symbol required"></span></label>
                    <textarea rows="5" name="site_chat" class="form-control"><?php if (isset($adminsite_setting->site_chat)) echo ($adminsite_setting->site_chat); ?></textarea>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12"><hr class="hr-short">
                <div class="form-group text-right">
                    <div class="col-md-12">
                        <input type="submit" class="btn btn-green btn-lg" value="Update Settings">
                    </div>
                </div>
            </div>
            <br><br>
        </form>
    </div>