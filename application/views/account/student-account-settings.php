<!doctype html>
<html>
<head>
    <title>Profile Settings - <?=$site_settings->site_name?></title>
    <?php $this->load->view('includes/site-master'); ?>
</head>
<body id="home-page">
    <?php $this->load->view('includes/header'); ?>


    <section id="dash">
        <div class="contain-fluid">
            <div class="lBar ease">
                <?php $this->load->view('includes/sidebar'); ?>
            </div>
            <div id="profileSet" class="inSide regular">
                <div class="blk">
                    <div class="_header">
                        <h3>Account Settings</h3>
                    </div>
                    <div class="mainSetting">
                        <form action="" method="post" autocomplete="off" class="frmAjax" id="frmSetting">
                            <?= showMsg()?>
                            <div class="formBlk">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-xx-12">
                                        <div class="row formRow">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xx-12 txtGrp">
                                                <div class="proDp ico">
                                                    <img src="<?= get_image_src($mem_data->mem_image,'300',true)?>" alt="" id="userImage">
                                                </div>

                                                <div class="text-center"><button type="button" class="webBtn smBtn uploadImg" id="uploadDp" data-image-src="image"><i class="fi-camera"></i> Change Photo</button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 col-xx-12">
                                        <h4 class="color">Account Details</h4>
                                        <div class="row formRow">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                                <h4>First Name</h4>
                                                <input type="text" name="fname" id="fname" value="<?= ($mem_data->mem_fname?$mem_data->mem_fname:'')?>" class="txtBox" placeholder="First Name" autofocus>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                                <h4>Last Name</h4>
                                                <input type="text" name="lname" id="lname" value="<?= ($mem_data->mem_lname?$mem_data->mem_lname:'')?>" class="txtBox" placeholder="Last Name">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                                <h4>Email Address</h4>
                                                <div class="verifyBlk">
                                                    <input type="text" id="email" name="email" class="txtBox" value="<?= $mem_data->mem_email?$mem_data->mem_email:''?>" placeholder="Email Address">
                                                    <!-- <?php if (!empty($mem_data->mem_phone)): ?>
                                                        <?php if (empty($mem_data->mem_phone_verified)): ?>
                                                            <a href="<?= site_url('email-verification')?>" class="ntVerify">Verify</a>
                                                            <?php else: ?>
                                                                <a href="javascript:void(0)" class="fi fi-check"></a>
                                                            <?php endif ?>
                                                        <?php endif ?> -->
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                                    <h4>Country</h4>
                                                    <select name="country" id="country" class="txtBox selectpicker" data-live-search="true">
                                                        <option value="">Select</option>
                                                        <?=get_countries_details('id',$mem_data->mem_country_id)?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="file" id="uploadFile" name="uploadFile" accept="image/*" class="" style="display: none;" data-file="">
                                    <div class="bTn text-center">
                                        <button type="submit" class="webBtn colorBtn">Save <i class="fa fa-spinner fa-pulse fa-1x fa-fw hidden"></i></button>
                                    </div>
                                </div>
                                <div class="alertMsg" style="display: none;"></div>
                            </form>
                        </div>
                    </div>
                   <!--  <div class="blk">
                        <div class="_header">
                            <h3>Verify Phone</h3>
                        </div>
                        <form action="<?php //site_url('change-phone') ?>" method="post" autocomplete="off" class="frmAjax" id="frmPhone">
                            <div class="formBlk">
                                <p>Crainly is going to send you a text message for Phone verification if you want to verify your phone number, Please make sure you already save that phone number before verification.</p>
                                <div class="row formRow">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-xx-3 txtGrp">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                        <h4>Phone Number</h4>
                                        <div class="verifyBlk">
                                            <input type="text" name="phone" id="phone" class="txtBox" value="<?php //$mem_data->mem_phone?$mem_data->mem_phone:''?>">

                                            <?php //if (!empty($mem_data->mem_phone)): ?>
                                                <?php //if (empty($mem_data->mem_verified)): ?>
                                                    <a href="<?php //site_url('phone-verification')?>" class="ntVerify">Verify</a>
                                                <?php //else: ?>
                                                    <a href="javascript:void(0)" class="fi fi-check"></a>
                                                <?php //endif ?>
                                            <?php// endif ?>
                                        </div>
                                        <div class="invald hide" id="phnMsg"></div>
                                    </div>
                                </div>
                                <div class="bTn text-center">
                                    <button type="submit" class="webBtn colorBtn">Save <i class="fa fa-spinner fa-pulse fa-1x fa-fw hidden"></i></button>
                                </div>
                            </div>
                            <div class="alertMsg" style="display: none;"></div>
                        </form>
                    </div> -->
                <!-- <div class="blk">
                    <div class="_header">
                        <h3>Change Password</h3>
                    </div>
                    <div class="changePass">
                        <form action="<?= site_url('change-password')?>" method="post" autocomplete="off" class="frmAjax" id="frmChangePass">
                            <div class="formBlk">
                                <div class="content">
                                    <p>Your password must contain the following:</p>
                                    <ol class="_list2">
                                        <li>At least 8 characters in length (a strong password has at least 14 characters)</li>
                                        <li>At least 1 letter and at least 1 number or symbol</li>
                                    </ol>
                                </div>
                                <div class="row formRow">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xx-4 txtGrp">
                                        <input type="password" id="pswd" name="pswd" value="" class="txtBox" placeholder="Current password">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xx-4 txtGrp">
                                        <input type="password" id="npswd" name="npswd" value="" class="txtBox" placeholder="New password">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xx-4 txtGrp">
                                        <input type="password" id="cpswd" name="cpswd" value="" class="txtBox" placeholder="Confirm new password">
                                    </div>
                                </div>
                                <div class="bTn text-center">
                                    <button type="submit" class="webBtn colorBtn">Save <i class="fa fa-spinner fa-pulse fa-1x fa-fw hidden"></i></button>
                                </div>
                            </div>
                            <div class="alertMsg" style="display:none"></div>
                        </form>
                    </div>
                </div> -->
            </div>
        </div>
    </section>
    <!-- dash


    <script type="text/javascript" src="<?= base_url('assets/js/additional-methods.js')?>"></script>
    <?php $this->load->view('includes/footer'); ?>
</body>
</html>