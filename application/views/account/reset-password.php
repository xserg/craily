<!doctype html>
<html>
<head>
    <title>Reset Password - <?=$site_settings->site_name?></title>
    <?php $this->load->view('includes/site-master'); ?>
</head>
<body id="home-page">
    <?php $this->load->view('includes/header-logon'); ?>


    <section id="logOn" style="background-image: url('<?=SITE_IMAGES.'images/'.$site_content['reset_image']?>')">
        <div class="flexDv">
            <div class="contain">
                <div class="ouTer">
                    <div class="lSide">
                        <?= $site_content['left_section']?>
                    </div>
                    <div class="logBlk">
                        <form action="" method="post" autocomplete="off" class="frmAjax" id="frmReset">
                            <h2><?= $site_content['reset_heading']?></h2>
                            <p><?= $site_content['reset_short_detail']?></p>
                            <div class="txtGrp">
                                <input type="password" id="pswd" name="pswd" class="txtBox" placeholder="New Password">
                            </div>
                            <div class="txtGrp">
                                <input type="password" id="cpswd" name="cpswd" class="txtBox" placeholder="Confirm Password">
                            </div>
                            <div class="bTn text-center">
                                <button type="submit" class="webBtn colorBtn lgBtn">Submit <i class="fa fa-spinner fa-pulse fa-1x fa-fw hidden"></i></button>
                            </div>
                            <div class="alertMsg" style="display:none"></div>
                        </form>
                        <ul class="miniNav">
                            <li><a href="<?= site_url('privacy-policy')?>">Privacy Policy</a></li>
                            <li><a href="<?= site_url('contact-us')?>">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  logOn -->


    <?php //require_once('includes/footer.php');?>
    <script type="text/javascript" src="<?= base_url('assets/js/custom-validation.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/custom.js') ?>"></script>
</body>
</html>