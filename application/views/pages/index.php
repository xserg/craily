<!doctype html>
<html>
<head>
<title>Home - <?=$site_settings->site_name?></title>
    <?php $this->load->view('includes/site-master'); ?>
</head>
<body id="home-page">
    <?php $this->load->view('includes/header'); ?>
<main>

<section id="banner" class="flexBox">
    <div class="flexDv">
        <div class="contain text-center">
            <div class="content">
                <h1 class="lite"><?= $site_content['banner_heading']?></h1>
                <p class="lite"><?= $site_content['banner_detail']?></p>
                <form action="<?= site_url('search'); ?>" method="get">
                    <ul class="lst">
                        <li>
                            <!-- <select name="subject" id="subject" class="txtBox selectpicker" data-live-search="true">
                                <option value="">Select your subject</option>
                                <?= get_subjects(0,12,true,'slug');?>
                            </select> -->
<!--                            <select class="auto-subject txtBox" id="subject" name="subject"></select>-->
                            <input type="text" name="subject" id="subject" class="txtBox autocomplete" data-from="search-subject" placeholder="Subject">
                        </li>
                        <li>
                            <input type="text" name="zip" id="zip" class="txtBox" placeholder="Zip code">                            
                        </li>
                        <li>
                            <button type="submit" class="webBtn colorBtn"><?= $site_content['banner_button_text']?></button>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </div>
    <div class="vidBlk">
        <video loop="" muted="" autoplay="">
            <source src="<?= SITE_VIDEOS.$site_content['banner_video']?>" type="video/mp4">
        </video>
    </div>
</section>
<!-- banner -->


<section id="how-it-works">
    <div class="contain text-center">
        <div class="content">
            <h1 class="secHeading"><?= $site_content['first_section_heading']?></h1>
            <p class="pre"><?= $site_content['first_section_detail']?></p>
        </div>
        <ul class="lst flex">
            <?php for ($i=1;$i<=3;$i++): ?>
                <li>
                    <div class="inner">
                        <div class="icon"><img src="<?= get_site_image_src("images", $site_content['first_ico_image'.$i])?>" alt=""></div>
                        <div class="cntnt">
                            <h3><?= $site_content['first_ico_heading'.$i]?></h3>
                            <p><?= $site_content['first_ico_text'.$i]?></p>
                        </div>
                    </div>
                </li>
            <?php endfor ?>
        </ul>
        <div class="bTn text-center"><a href="<?= site_url('signup')?>" class="webBtn lgBtn colorBtn"><?= $site_content['first_section_button_text']?></a>
        </div>
    </div>
</section>
<!-- how-it-works -->


<section id="why-us">
    <div class="how_works_section" style="background: url('<?= get_site_image_src("images", $site_content['second_ico_image4'])?>');">
        <div class="container">
            <h3><?= $site_content['second_section_heading']?></h2>
            <p><?= $site_content['second_section_detail']?></p>
            <div class="bTn text-center"><a href="<?= site_url('signup')?>" class="webBtn lgBtn colorBtn"><?= $site_content['second_section_button_text']?></a>
            </div>
        </div>
    </div>
</section>
<!-- why-us -->


<section id="cards">
    <div class="contain text-center">
        <div class="content">
            <h1 class="secHeading"><?= $site_content['tutor_heading']?></h1>
            <p class="pre"><?= $site_content['tutor_detail']?></p>
            <div class="bTn">
                <a href="<?= site_url('become-a-tutor')?>" class="webBtn lgBtn"><?= $site_content['tutor_button_text']?></a>
            </div>
        </div>
    </div>
</section>
<!-- cards -->


<!-- last section -->
<div class="contact_icon_sec">
    <div class="container">
        <div class="contact_icon_sec_inner">
            <?php for ($ii=1;$ii<=2;$ii++): ?>
                <div class="col-sm-6">
                    <div class="icon_cont">
                        <?php $chat = ''; if($site_content['last_section_heading'.$ii] == 'CHAT WITH US'): $chat = 'onclick="window.fcWidget.open();window.fcWidget.show();"'; endif ?>
                        <a href="<?php echo $site_content['last_section_link'.$ii] ?>" <?php echo $chat; ?>>
                            <div class="icon"><img src="<?= get_site_image_src("images", $site_content['last_section_image'.$ii])?>" alt=""></div>
                            <h3 ><?= $site_content['last_section_heading'.$ii] ?></h3>
                        </a>
                    </div>
                </div>
            <?php endfor ?>
        </div>
    </div>
</div>
<!-- last section -->

</main>
<?php $this->load->view('includes/footer');?>
<!--Start of freshdesk Script-->
<?php if ($_SERVER['HTTP_HOST'] != 'localhost'):?>

    <!-- <script src="https://wchat.freshchat.com/js/widget.js"></script> -->
    <?php if($site_settings->site_chat!=''):?>
        <script type="text/javascript">
            <?=$site_settings->site_chat?>
        </script>
    <?php endif?>
<?php endif?>
<!--End of freshdesk Script-->
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
    });
</script>
</body>
</html>