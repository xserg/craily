<!doctype html>
<html>
<head>
    <title><?= $page_title?> - <?=$site_settings->site_name?></title>
    <?php $this->load->view('includes/site-master'); ?>
</head>
<body id="home-page">
    <?php $this->load->view('includes/header'); ?>

<main>
    <section id="sBanner">
        <div class="contain">
            <div class="content">
                <h1><?= $page_title?></h1>
                <ul>
                    <li><a href="<?=site_url()?>">Home</a></li>
                    <li><?= $page_title?></li>
                </ul>
            </div>
        </div>
    </section>
    <!-- sBanner -->

    <section id="faq">
        <div class="contain">
            <ul class="faqLst">
                <?php foreach ($faqs as $key => $faq) :?>
                    <li>
                        <h3><?=$faq->question?></h3>
                        <i class="fi-<?=$key==0?'minus':'plus'?>"></i>
                        <div class="cntnt">
                            <?=$faq->answer?>
                        </div>
                    </li>
                <?php endforeach?>

            </ul>
        </div>
    </section><!-- faq -->

</main>
    <?php $this->load->view('includes/footer');?>
</body>
</html>