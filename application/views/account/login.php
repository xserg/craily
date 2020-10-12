<!doctype html>
<html>
<head>
    <title>Login - <?=$site_settings->site_name?></title>
    <?php $this->load->view('includes/site-master'); ?>
</head>
<body id="home-page">
    <?php $this->load->view('includes/header-logon'); ?>


    <section id="logOn" style="background-image: url('<?= SITE_IMAGES.'images/'.$login_content['login_image']?>')">
        <div class="flexDv">
            <div class="contain">
                <div class="ouTer">
                    <div class="lSide ckEditor">
                        <?=$login_content['left_section']?>
                    </div>
                    <div class="logBlk">
                        <?php if($this->session->flashdata('success')) { ?>
                            <span style="padding: 15px;margin-bottom: 20px;border: 1px solid transparent;border-radius: 4px;color: #8a6d3b;background-color: #fcf8e3;border-color: #faebcc;"><?php echo $this->session->flashdata('success'); ?></span>
                        <?php } ?>
                        <form action="" method="post" autocomplete="off" class="frmAjax" id="frmLogin">
                            <h2><?=$login_content['login_heading']?></h2>
                            <div class="txtGrp">
                                <input type="email" id="email" name="email" class="txtBox" placeholder="Email" autofocus>
                            </div>
                            <div class="txtGrp">
                                <input type="password" id="password" name="password" class="txtBox" placeholder="Password">
                            </div>
                            <div class="rememberMe">
                                <div class="lblBtn pull-left">
                                    <input type="checkbox" name="remeberMe" id="rememberMe">
                                    <label for="rememberMe">Remember me</label>
                                </div>
                                <a href="<?= site_url('forgot-password')?>" id="pass" class="pull-right">Forgot Password ?</a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="bTn text-center">
                                <button type="submit" class="webBtn colorBtn lgBtn">Login to your account <i class="fa fa-spinner fa-pulse fa-1x fa-fw hidden"></i></button>
                            </div>
                            <div class="alertMsg" style="display:none"></div>
                            <div class="oRLine"><span>OR</span></div>
                            <ul class="socialLnks text-center">
                                <li><a href="<?= site_url('facebook-login'); ?>" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="<?= site_url('google-login'); ?>" class="google"><i class="fa fa-google"></i></a></li>
                            </ul>
                        </form>
                        <div class="haveAccount text-center">
                            <span>Don’t have an account?</span>
                            <a href="<?= site_url('signup')?>">Sign up</a>
                        </div>
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