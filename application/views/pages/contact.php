<!doctype html>
<html>
<head>
    <title>Contact us - <?=$site_settings->site_name?></title>

    <?php $this->load->view('includes/site-master'); ?>

    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script type="text/javascript">var recaptcha=true;</script>
</head>
<body id="home-page">
    <?php $this->load->view('includes/header'); ?>
<main>

    <section id="sBanner">
        <div class="contain">
            <div class="content">
                <h1>Contact us</h1>
                <ul>
                    <li><a href="<?=site_url()?>">Home</a></li>
                    <li>Contact us</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- sBanner -->


    <section id="contact">
        <div class="contain">
            <div class="flexRow flex">
                <div class="col col1">
                    <div class="content">
                        <h3><?= $contactContent['first_heading']?></h3>
                        <?= $contactContent['detail']?>
                        <h4><?= $contactContent['second_heading']?></h4>
                        <p><?= $contactContent['second_head_text']?></p>
                        
                    </div>
                </div>
                <div class="col col2">
                    <h3><?= $contactContent['third_heading']?></h3>
                    <form action="<?= site_url('ajax/contact')?>" method="post" autocomplete="off" class="frmAjax" id="frmContact">
                        <div class="alertMsg" style="display:none"></div>
                        <div class="row formRow">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                <input class="txtBox" id="name" name="name" type="text" placeholder="Full Name" autofocus>
                            </div>
                            <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                <input class="txtBox" id="phone" name="phone" type="text" placeholder="Phone">
                            </div> -->
                            <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                <input class="txtBox" id="subject" name="subject" type="text" placeholder="Subject">
                            </div> -->
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                <input class="txtBox" id="email" name="email" type="email" placeholder="Email" required="">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xx-12 txtGrp">
                                <textarea class="txtBox" id="comment" name="msg" placeholder="Message"></textarea>
                            </div>
                        </div>
                        <!-- <div id="recaptcha" class="g-recaptcha" data-sitekey="<?php //RECAPTCHA_SITE_KEY?>" data-size="invisible" data-callback="onSubmit"></div> -->
                        <div class="bTn"><button type="submit" class="webBtn colorBtn lgBtn">Send Message <i class="fa fa-spinner fa-pulse fa-1x fa-fw hidden"></i></button></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- contact -->

</main>
    <?php $this->load->view('includes/footer');?>
</body>
</html>