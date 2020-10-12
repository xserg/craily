<!doctype html>
<html>
<head>
    <title>Direct Deposit - <?= $site_settings->site_name?></title>
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
                <div class="blans text-center">
                    <h4 class="regular">Current Balance <span class="price">$<?= num($current_balance) //num($balance_due)?></span></h4>
                    <h4 class="regular">Payouts <span class="price">$<?= num($total_payout)?></span></h4>
                    <h4 class="regular">Lessons Completed <span><?= total_tutor_lessons($this->session->mem_id)?></span></h4>
                </div>
                <div class="blk" style="text-align:center">
                    <h4>Click "Manage Deposits" below to access your earnings.</h4>
                    <!-- <div class="_header"> -->
                        <!--<a href="<?php //echo site_url('add-bank-account'); ?>" class="webBtn colorBtn">Add new Payment Method</a>-->
                        
                    <!-- </div> -->
                    <a href="<?php echo $url; ?>" class="webBtn colorBtn" style="margin-top:15px" target="_blank">Manage Deposits</a>
                    <?= showMsg()?>
                   	<span style="color: red;"></span>
                   	 <?php if($error) { header("Location: ".site_url('stripe-register'));  } ?>
                    <div class="tableBlk noAttrs" style="display:none">
                        <table class="dataTable" data-msg="No payment method added">
                            <thead>
                                <tr>
                                    <th class="desktop tablet-l">Bank Name</th>
                                    <th class="desktop tablet-l tablet-p">Routing Number</th>
                                    <th class="desktop tablet-l tablet-p mobile-l mobile-p">Acc Number</th>
                                    <th class="desktop tablet-l tablet-p mobile-l mobile-p no-sort" width="80">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                	if(!empty($rows)) :
                                		$i=0;
                                		foreach ($rows as $key => $row) : ?>
	                                    <tr>
	                                        <td>
	                                            <div class="inner">
	                                                <!-- <div class="icon"><img src="<?= base_url('assets/images/visa.png')?>" alt=""></div> -->
	                                                <div class="pin"><?= $row->bank_name ?></div>
	                                                <?php if (!empty($row->default_method)): ?>
	                                                    <span class="miniLbl green">Default</span>
	                                                <?php endif ?>
	                                            </div>
	                                        </td>
	                                        <td><?= $row->routing_number?></td>
	                                        <td>******* <?= $row->last4 ?></td>
	                                        <td>
	                                            <div class="dropDown">
	                                                <a href="javascript:void(0)" class="webBtn smBtn dropBtn">Edit</a>
	                                                <ul class="dropCnt dropLst">
	                                                    <!--<li><a href="#"  data-toggle="modal" data-target="#myModal_<?php //echo $i; ?>">Edit Info</a></li>-->
	                                                    <li><a href="<?php echo $url; ?>" target="_blank">Edit Info</a></li>
	                                                    <!-- <li><a href="<?php //echo site_url('make-default/'.$row->encoded_id)?>">Make Default</a></li>
	                                                    <li><a href="<?php //echo site_url('delete-method/'.$row->encoded_id)?>" onclick="return confirm('Are you sure ?')">Delete Account</a></li> -->
	                                                </ul>
	                                            </div>
	                                        </td>
	                                    </tr>
                                <?php  $i++; endforeach; endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php 
                	$j=0;
                    foreach ($rows as $key => $row) : ?>
		                <!-- Modal -->
						<div id="myModal_<?php echo $j; ?>" class="modal fade bank_details" role="dialog">
							<div class="modal-dialog">
								<form action="" method="post" id="frmBnkAct" class="frmAjax">
									<!-- Modal content-->
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Edit Bank Details</h4>
										</div>
										<div class="modal-body">
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
												<input type="hidden" name="cust_id" value="<?php echo $cust_id; ?>">
		                                		<input type="text" name="swift_code" id="swift_code" class="txtBox" placeholder="Swift Code">
		                            		</div>
				                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
				                                <input type="text" name="routing_number" id="routing_number" class="txtBox" placeholder="Routing Number" value="<?php echo $row->routing_number; ?>">
				                            </div>
				                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
				                                <input type="text" name="bank_name" id="bank_name" class="txtBox" placeholder="Bank Name" value="<?php echo $row->bank_name; ?>">
				                            </div>
				                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
				                                <input type="text" name="account_title" id="account_title" class="txtBox" placeholder="Account Title" value="<?php echo $row->account_holder_name; ?>">
				                            </div>
				                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
				                                <input type="text" name="account_number" id="account_number" class="txtBox" placeholder="Account Number" value="*******<?php echo $row->last4; ?>">
				                            </div>
				                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
				                                <select id="country" name="country" class="txtBox selectpicker" data-live-search="true">
				                                    <option value="Country">Country</option>
				                                    <?= get_countries_options('name', $row->country);?>
				                                </select>
				                            </div>
				                        </div>
				                        <div class="bTn text-center">
				                            <button type="submit" class="webBtn colorBtn">Update Bank Details <i class="fa-spinner hidden"></i></button>
				                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				                        </div>
									</div>
								</form>
								
							</div>
						</div>
				<?php  $j++; endforeach; ?>
                <!--<div class="blk">
                    <div class="_header">
                        <h3>Your Payouts</h3>
                    </div>
                    <p>Automatic deposits every Monday, free of charge, 2-3 days for the deposits to show on your bank statement.</p>
                    <div class="tableBlk">
                        <table>
                            <thead>
                                <tr>
                                    <th>Processing Payouts</th>
                                    <th width="140">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php// if (count($processing_payouts)<1): ?>
                                    <tr>
                                        <td colspan="2" class="text-center">No processing payouts</td>
                                    </tr>
                                <?php //endif ?>
                                <?php //foreach ($processing_payouts as $key => $processing_payout) :?>
                                    <tr>
                                        <td><?php //echo format_date($processing_payout->date,'F d, Y'); ?></td>
                                        <td>$<?php //echo num($processing_payout->amount); ?></td>
                                    </tr>
                                <?php //endforeach?>
                            </tbody>
                            <thead>
                                <tr>
                                    <th>Cleared Payouts</th>
                                    <th width="140">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php// if (count($cleared_payouts)<1): ?>
                                    <tr>
                                        <td colspan="2" class="text-center">No cleared payouts</td>
                                    </tr>
                                <?php// endif ?>
                                <?php //foreach ($cleared_payouts as $key => $cleared_payout) :?>
                                    <tr>
                                        <td><?php // echo format_date($cleared_payout->paid_date,'F d, Y') ?></td>
                                        <td>$<?php // echo num($cleared_payout->amount) ?></td>
                                    </tr>
                                <?php //endforeach?>
                            </tbody>
                        </table>
                    </div>
                </div>-->
            </div>
        </div>
    </section>
    <!-- dash -->


    <?php $this->load->view('includes/footer');?>
</body>
</html>