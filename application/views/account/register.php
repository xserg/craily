<!doctype html>
<html>
<head>
    <title>Sign up - <?=$site_settings->site_name?></title>
    <?php $this->load->view('includes/site-master'); ?>
</head>
<body id="home-page" class="register_page" style="padding-bottom:0; min-height:100vh;">
    <?php $this->load->view('includes/header'); ?>


    <section class="sign-up-main">
        <div class="container">
            <div class="signup-sec">
            <div class="row">
                <div class="col-md-6">
                <div class="signup-left">
                    <h2 class="signup-sec-title">Start learning</h2>
                    <p class="signup-dec">The beautiful thing about learning is that nobody can take it away from you. Get started today!</p>
                    <img src="assets/images/login-img.png" alt="Crainly">
                </div>
                </div>
                <div class="col-md-6">
                <div class="signup-right">
                    <h2 class="signup-sec-title text-center"><?= $register_content['signup_heading']?></h2>
                    <?php if($this->session->flashdata('success')) { ?>
                        <span style="padding: 15px;margin-bottom: 20px;border: 1px solid transparent;border-radius: 4px;color: #8a6d3b;background-color: #fcf8e3;border-color: #faebcc;"><?php echo $this->session->flashdata('success'); ?></span>
                    <?php } ?>
                    <?php if(!empty($ref_code)) { ?>
                        <p style="color: red;"><?= $ref_name; ?> sent you $10 off your first lesson!</p>
                    <?php } ?>
                    <div id="error-msg" style="display:none;"></div>
                    <form action="" method="post" autocomplete="off" class="frmAjax signup-form" id="frmSignup_tutor" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first-name">First Name <span class="text-red">*</span></label>
                                    <input type="text" class="form-control" id="first-name" placeholder="First Name" name="fname" autofocus>
                                    <span class="fname_error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="last-name">Last Name <span class="text-red">*</span></label>
                                <input type="text" class="form-control" id="last-name" placeholder="Last Name" name="lname" >
                                <span class="lname_error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="email">Email Address <span class="text-red">*</span></label>
                                <input type="email" class="form-control" id="email-address" placeholder="Email Address" name="email" >
                                <span class="email_error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="phone-number">Phone Number <span class="text-red">*</span></label>
                                <input type="text" class="form-control" id="phone-number" placeholder="Phone Number" name="phone" >
                                <span class="phone_error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="password">Password <span class="text-red">*</span></label>
                                <input type="password" class="form-control" id="password" placeholder="Password" name="password" >
                                <span class="password_error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="confirm-password">Confirm Password <span class="text-red">*</span></label>
                                <input type="password" class="form-control" id="confirm-password" placeholder="Confirm Password" name="confirmpassword" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary signup-btn" id="nextBtn">Sign Up</button>
                                <div class="alertMsg" style="display:none"></div>
                            </div>
                            <div class="col-md-12">
                                <p class="signup-dec text-center">By clicking Sign up, Continue with Facebook, or Continue with Google, you agree to our <a href="<?= site_url('terms-services')?>">Terms and Conditions</a> and <a href="<?= site_url('privacy-policy')?>">Privacy Policy.</a></p>
                            </div>
                            <div class="col-md-12">
                                <p class="cta-txt text-center">Already have an account? <a href="<?= site_url('login')?>"> Log In </a></p>
                            </div>
                        </div>
                    </form>
                </div>
                </div>
            </div>
            </div>
        </div>
    </section>


    <?php //$this->load->view('includes/footer');?>
    <script type="text/javascript" src="<?= base_url('assets/js/main.js?v-'.$site_settings->site_version)?>"></script>
    <!-- <script type="text/javascript" src="<?php// base_url('assets/js/custom-validation.js?v-'.$site_settings->site_version) ?>"></script> -->
    <script type="text/javascript" src="<?= base_url('assets/js/custom.js?v-'.$site_settings->site_version) ?>"></script>
</body>
</html>