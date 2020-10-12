<!doctype html>
<html>
<head>
<title>Payment Method - <?= $site_settings->site_name?></title>
    <?php $this->load->view('includes/site-master'); ?>
</head>
<body id="home-page">
    <?php $this->load->view('includes/header'); ?>


<section id="dash">
    <div class="contain-fluid">
        <div class="lBar ease">
            <?php $this->load->view('includes/sidebar'); ?>
        </div>
        <div id="payMthd" class="inSide">
            <div class="blk">
                <div class="_header">
                    <h3>Bank Account</h3>
                    <a href="<?= site_url('direct-deposit')?>" class="webBtn">Back</a>
                </div>
                <form action="" method="post" autocomplete="off" id="frmBnkAct" class="frmAjax">
                    <div class="formBlk">
                        <div class="row formRow">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                <input type="text" name="swift_code" id="swift_code" class="txtBox" placeholder="Swift Code">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                <input type="text" name="routing_number" id="routing_number" class="txtBox" placeholder="Routing Number">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                <input type="text" name="bank_name" id="bank_name" class="txtBox" placeholder="Bank Name">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                <input type="text" name="account_title" id="account_title" class="txtBox" placeholder="Account Title">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                <input type="text" name="account_number" id="account_number" class="txtBox" placeholder="Account Number">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                <input type="text" name="city" id="city" class="txtBox" placeholder="City">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                <input type="text" name="state" id="state" class="txtBox" placeholder="State">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                <select id="country" name="country" class="txtBox selectpicker" data-live-search="true">
                                    <option value="Country">Country</option>
                                    <?= get_countries_options('name');?>
                                </select>
                            </div>
                        </div>
                        <div class="bTn text-center">
                            <button type="submit" class="webBtn colorBtn">Submit <i class="fa-spinner hidden"></i></button>
                        </div>
                        <div class="alertMsg" id="alertMsg"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- dash -->


<?php $this->load->view('includes/footer'); ?>
</body>
</html>