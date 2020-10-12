<!doctype html>
<html>
<head>
    <title>Privacy Policy - <?=$site_settings->site_name?></title>
    <?php $this->load->view('includes/site-master'); ?>
</head>
<body id="home-page">
    <?php $this->load->view('includes/header'); ?>
<main>

    <section id="sBanner">
        <div class="contain">
            <div class="content">
                <h1>Privacy Policy</h1>
                <ul>
                    <li><a href="<?=site_url()?>">Home</a></li>
                    <li>Privacy Policy</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- sBanner -->

    <section id="terms">
        <div class="contain">
            <h3><?= getPref('privacypolicy','pref_title')?></h3>
            <?= getPref('privacypolicy','pref_detail')?>
        </div>
    </section><!-- terms -->
</main>
    <?php $this->load->view('includes/footer');?>
</body>
</html>