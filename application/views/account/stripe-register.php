<!doctype html>
<html>
<head>
    <title>Connect Your Stripe Account - <?=$site_settings->site_name?></title>
    <?php $this->load->view('includes/site-master'); ?>
</head>
    <body id="home-page">
        <?php $this->load->view('includes/header'); ?>


        <section id="sBanner">
            <div class="contain">
                <div class="content">
                    <h1>Connect with stripe to start getting paid</h1>
             
                </div>
            </div>
        </section>
        <!-- sBanner -->


        <section id="beTutor">
            <div class="contain">
                <fieldset>
                    <div class="formBlk">
                        <div class="blk stripe-tag">
                            <div class="_header">
                                <span class="stripe-heading">Payment Information</span>
                            </div>
                            <div class="row formRow">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xx-12 txtGrp payment_info">
                                    <div class="stripe-section">
                                        <p class="stripe_detail">
                                            We use Stripe to make sure you get paid on time and to keep your personal bank and details secure. Click <b>Continue</b> to set up your payments on Stripe.
                                        </p>
                                        <img src="<?= base_url('assets/images/stripe.png')?>">
                                    </div>
<!--                                    <a href="https://connect.stripe.com/express/oauth/authorize?redirect_uri=https://crainly.com/stripe-success&response_type=code&client_id=ca_ExkShtieuagE8i9vmtEpRpc0SwvBljXt&scope=read_write" class="connect-button" target="_blank"><span>Continue</span></a>-->
                                    <a href="https://connect.stripe.com/express/oauth/authorize?redirect_uri=https://staging.crainly.com/stripe-success&response_type=code&client_id=<?= STRIPE_API_CLIENT_ID  ?>&scope=read_write" class="connect-button" target="_blank"><span>Continue</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
        </section>
        <script type="text/javascript" src="<?= base_url('assets/js/additional-methods.js')?>"></script>
        <?php $this->load->view('includes/footer'); ?>
        <!-- Editor Js -->
        <script type="text/javascript" src="<?= base_url('assets/js/ckeditor.js')?>"></script>
    </body>
</html>