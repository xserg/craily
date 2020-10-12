<!doctype html>
<html>
<head>
    <title>Forgot Password - <?=$site_settings->site_name?></title>
    <?php $this->load->view('includes/site-master'); ?>
</head>
</head>
<body id="home-page" style="min-height:100vh; padding:0;">
    <?php $this->load->view('includes/header'); ?>

    <section id="logOn" style="padding:0; margin-top:0; background-image: none">
        <div class="flexDv">
            <div class="contain">
                <div class="ouTer">
                   
                    <div class="logBlk">
                        <form action="" method="post" autocomplete="off" class="frmAjax" id="frmForgot">
                            <h2><?= $site_content['forgot_heading']?></h2>
                            <p><?= $site_content['forgot_short_detail']?></p>
                            <div class="txtGrp">
                                <input type="text" id="email" name="email" class="txtBox" placeholder="Email Address" autofocus>
                            </div>
                            <div class="bTn text-center">
                                <button type="submit" class="webBtn colorBtn lgBtn">Send Email <i class="fa fa-spinner fa-pulse fa-1x fa-fw hidden"></i></button>
                            </div>
                            <div class="alertMsg" style="display:none"></div>
                        </form>
                        <!-- <ul class="miniNav">
                            <li><a href="<?= site_url('privacy-policy')?>">Privacy Policy</a></li>
                            <li><a href="<?= site_url('contact-us')?>">Contact</a></li>
                        </ul> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  logOn -->


    <?php $this->load->view('includes/footer');?>
    <script type="text/javascript" src="<?= base_url('assets/js/main.js?v-'.$site_settings->site_version)?>"></script>

    <script type="text/javascript" src="<?= base_url('assets/js/custom-validation.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/custom.js') ?>"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        var offSet = $('body').offset().top;
        var offSet = offSet + 5;
        $(window).scroll(function() {
            var scrollPos = $(window).scrollTop();
            if (scrollPos >= offSet) {
                $('header').addClass('fix');
            } else {
                $('header').removeClass('fix');
            }
        });

        $('body').on('click', '.chat', function(event) {
            $('.icon-ic_chat_icon').click();
        });
        $(".footer_section").css("z-index","50");
    });
</script>
</body>
</html>