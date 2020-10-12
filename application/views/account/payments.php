<!doctype html>
<html>
<head>
<title>Payments - <?= $site_settings->site_name?></title>
    <?php $this->load->view('includes/site-master'); ?>
</head>
<body id="home-page">
    <?php $this->load->view('includes/header'); ?>


<section id="dash">
    <div class="contain-fluid">
        <div class="lBar ease">
            <?php $this->load->view('includes/sidebar'); ?>
        </div>
        <div id="payMthd" class="inSide">
            <div class="blk">
                <div class="_header">
                    <h3>Payments</h3>
                    <a href="<?= site_url('payment-methods/add-new')?>" class="webBtn colorBtn">Add new Payment Method</a>
                </div>
                <div class="tableBlk noAttrs">
                    <table class="dataTable">
                        <thead>
                            <tr>
                                <th class="no-sort">Method</th>
                                <th class="desktop tablet-p sortBy">Expires</th>
                                <th class="desktop no-sort" width="80">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rows as $key => $row) :?>
                                <?php if (empty($row->paypal)): ?>
                                    <tr>
                                    <td>
                                        <div class="inner">
                                            <div class="icon"><i class="fi-credit-card"></i><!-- <img src="<?= base_url('assets/images/visa.png')?>" alt=""> --></div>
                                            <div class="pin"><em>&#9679; &#9679; &#9679; &#9679; &#9679;</em> <?= $row->last_digits?></div>
                                            <?php if (!empty($row->default_method)): ?>
                                                <span class="miniLbl green">Default</span>
                                            <?php endif ?>
                                        </div>
                                    </td>
                                    <td><?= $row->expiry?></td>
                                    <td>
                                        <div class="dropDown">
                                            <a href="javascript:void(0)" class="webBtn smBtn dropBtn">Edit</a>
                                            <ul class="dropCnt dropLst">
                                                <li><a href="<?= site_url('make-default/'.$row->encoded_id)?>">Make Default</a></li>
                                                <li><a href="<?= site_url('delete-method/'.$row->encoded_id)?>" onclick="return confirm('Are you sure ?')">Delete Account</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                    
                                <?php else: ?>
                                <tr>
                                    <td>
                                        <div class="inner">
                                            <div class="icon"><i class="fi-paypal"></i></div>
                                            <div class="pin"><?= $row->paypal?></div>
                                            <?php if (!empty($row->default_method)): ?>
                                                <span class="miniLbl green">Default</span>
                                            <?php endif ?>
                                        </div>
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <div class="dropDown">
                                            <a href="javascript:void(0)" class="webBtn smBtn dropBtn">Edit</a>
                                            <ul class="dropCnt dropLst">
                                                <li><a href="<?= site_url('make-default/'.$row->encoded_id)?>">Make Default</a></li>
                                                    <li><a href="<?= site_url('delete-method/'.$row->encoded_id)?>" onclick="return confirm('Are you sure ?')">Delete Account</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php endif ?>
                            <?php endforeach?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- dash -->


<?php $this->load->view('includes/footer');?>
</body>
</html>