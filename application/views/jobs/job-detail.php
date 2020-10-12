<!doctype html>
<html>
<head>
    <title>Job Details - <?= $site_settings->site_name?></title>
    <?php $this->load->view('includes/site-master'); ?>
</head>
<body id="home-page">
    <?php $this->load->view('includes/header'); ?>


<!-- <section id="sBanner">
    <div class="contain">
        <div class="content">
            <h1>Restaurant Team Member(Job Title)</h1>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="jobs.php">Jobs</a></li>
                <li>Job Detail</li>
            </ul>
        </div>
    </div>
</section> -->
<!-- sBanner -->
<main>

<section id="search" class="margin_top50">
    <div class="contain">
        <div class="flex">
            <div class="_jodDesc">
                <div class="inner">
                    <h1><?= $row->title?></h1>
                    <h4><i class="fi-tag"></i> <?= $row->grade_level?></h4>
                    <div class="meta-info d-flex">
                         <p><i class="fa fa-map-marker" aria-hidden="true"></i><?= $row->city?> , <?= $row->state?>, <?= $row->zip?></p>
                         <p><i class="fa fa-briefcase" aria-hidden="true"></i><?= $row->subject?></p>
                         <p><i class="fa fa-calendar" aria-hidden="true"></i><?= format_date($row->date)?></p>
                         <p><i class="fi-clock" aria-hidden="true"></i><?= time_ago($row->date)?></p>
                    </div>
                    <div class="infoJob">
                        <h3>Description</h3>
                        <p><?= $row->detail?></p>
                        <!-- <h4>Primary Areas of Accountability:</h4>
                        <ul>
                            <li>Agreeing project objectives</li>
                            <li>Overseeing the accounting, costing and billing;</li>
                            <li>Carrying out risk assessment;</li>
                            <li>Monitoring sub-contractors;</li>
                        </ul> -->
                    </div>
                </div>
            </div>
            <div class="_jodDesc">
                <div class="inner">
                    <div class="ico">
                        <img src="<?= get_image_src($row->mem_image,150,true) ?>">
                    </div>
                    <div class="_name">
                        <h3><?= format_name($row->mem_fname,$row->mem_lname)?></h3>
                        <?php if ($this->session->mem_id!=$row->mem_id):?>
                            <?php $msg_url='login'?>
                            <?php //if ($this->session->has_userdata('mem_type') && !empty($mem_data->mem_verified)):?>
                            <?php if ($this->session->has_userdata('mem_type')):?>
                                <?php $msg_url='messages/'.doEncode($row->mem_id)?>
                            <?php endif?>
                            <a href="<?= site_url($msg_url)?>" class="webBtn colorBtn lgBtn">Send A Message</a>
                        <?php endif?>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</section>
</main>

<?php $this->load->view('includes/footer'); ?>
</body>
</html>