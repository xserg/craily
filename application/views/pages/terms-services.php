<!doctype html>
<html>
<head>
    <title>Term's of Services - <?=$site_settings->site_name?></title>
    <?php $this->load->view('includes/site-master'); ?>
</head>
<body id="home-page">
    <?php $this->load->view('includes/header'); ?>
<main>

    <section id="sBanner">
        <div class="contain">
            <div class="content">
                <h1>Term's of Services</h1>
                <ul>
                    <li><a href="<?=site_url()?>">Home</a></li>
                    <li>Term's of Services</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- sBanner -->

    <section id="terms">
        <div class="contain">
            <h3><?= getPref('termsservices','pref_title')?></h3>
            <?= getPref('termsservices','pref_detail')?>
        </div>
    </section>
    <!-- terms -->
</main>
    <?php $this->load->view('includes/footer');?>
</body>
</html>