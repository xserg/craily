<!doctype html>
<html>
<head>
    <title>Tutor Sign up - <?=$site_settings->site_name?></title>
    <?php $this->load->view('includes/site-master'); ?>
</head>
<body id="home-page">
    <?php $this->load->view('includes/header-logon'); ?>


    <section id="logOn" style="background-image: url('<?= SITE_IMAGES.'images/'.$register_content['page_image']?>')">
        <div class="flexDv">
            <div class="contain">
                <div class="ouTer">
                    <div class="lSide ckEditor">
                        <?= $register_content['left_section']?>
                    </div>
                    <div class="logBlk">
                        <form action="" method="post" autocomplete="off" class="frmAjax" id="frmSignup">
                            <h2><?= $register_content['page_heading']?></h2>
                            <div class="txtGrp">
                                <input type="text" id="fname" name="fname" class="txtBox" placeholder="First Name" autofocus required="">
                            </div>
                            <div class="txtGrp">
                                <input type="text" name="lname" id="lname" class="txtBox" placeholder="Last Name">
                            </div>
                            <div class="txtGrp">
                                <input type="email" id="email" name="email" class="txtBox" placeholder="Email Address">
                            </div>
                            <div class="txtGrp">
                                <input type="text" id="phone" name="phone" class="txtBox" placeholder="Us Phone Number">
                                <div class="invald hide" id="phnMsg"></div>
                            </div>
                            <div class="txtGrp">
                                <input type="password" id="password" name="password" class="txtBox" placeholder="Password min 8 character">
                            </div>
                            <div class="txtGrp">
                                <input type="text" name="hear_about" id="hear_about" class="txtBox" placeholder="How did you hear about us?">
                            </div>
                            <div class="rememberMe">
                                <div class="lblBtn">
                                    <input type="checkbox" name="confirm" id="confirm">
                                    <label for="confirm">By signing up, I agree to Crainly
                                        <a href="<?= site_url('terms-services')?>">Term's of Services,</a>
                                        and
                                        <a href="<?= site_url('privacy-policy')?>">Privacy Policy.</a>
                                    </label>
                                </div>
                            </div>
                            <div class="bTn text-center">
                                <button type="submit" class="webBtn colorBtn lgBtn">Create your account <i class="fa fa-spinner fa-pulse fa-1x fa-fw hidden"></i></button>
                            </div>
                            <div class="alertMsg" style="display:none"></div>
                            <!-- <div class="oRLine"><span>OR</span></div>
                            <ul class="socialLnks text-center">
                                <li><a href="<?= site_url('facebook-login'); ?>" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="<?= site_url('google-login'); ?>" class="google"><i class="fa fa-google"></i></a></li>
                            </ul> -->
                        </form>
                        <div class="haveAccount text-center">
                            <span>Already have an account ?</span>
                            <a href="<?= site_url('login')?>">Login</a>
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
    <script type="text/javascript" src="<?= base_url('assets/js/additional-methods.js')?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/custom.js') ?>"></script>
</body>
</html>