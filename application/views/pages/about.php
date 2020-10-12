<!doctype html>
<html>
<head>
    <title>About us - <?=$site_settings->site_name?></title>
    <?php $this->load->view('includes/site-master'); ?>
</head>
<body id="home-page">
    <?php $this->load->view('includes/header'); ?>
<main>

    <section id="sBanner">
        <div class="contain">
            <div class="content">
                <h1>About us</h1>
                <ul>
                    <li><a href="<?= site_url()?>">Home</a></li>
                    <li>About us</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- sBanner -->


    <section id="about">
        <div class="contain">
            <div class="flexRow flex">
                <div class="col col1">
                    <ul class="nav nav-tabs semi">
                        <li class="active"><a data-toggle="tab" href="#About-us">About us</a></li>
                        <li><a data-toggle="tab" href="#Founder">Founder</a></li>
                    </ul>
                </div>
                <div class="col col2">
                    <div class="tab-content">
                        <div id="About-us" class="tab-pane fade active in">
                            <div class="content">
                                <h2><?=$aboutContent['about_heading']?></h2>
                                <?=$aboutContent['about_txt']?>
                            </div>
                        </div>

                        <div id="Founder" class="tab-pane fade">
                            <h2><?=$aboutContent['founder_heading']?></h2>
                            <ul class="founderLst flex">
                                <?php foreach ($founders as $founder) :?>
                                    <li>
                                        <div class="inner">
                                            <div class="ico"><img src="<?=  get_site_image_src("founders/",$founder->image,'thumb_'); ?>" alt=""></div>
                                            <div class="cntnt">
                                                <h3><?= $founder->name?> <span><?= $founder->designation?></span></h3>
                                                <p><?= $founder->overview?></p>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about -->

</main>
    <?php $this->load->view('includes/footer');?>
</body>
</html>