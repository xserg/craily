<!doctype html>
<html>
<head>
<title>Payments - <?= $site_settings->site_name?></title>
    <?php $this->load->view('includes/site-master'); ?>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
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
                <?= showMsg()?>
                <div class="tableBlk noAttrs">
                    <table class="" data-msg="No card added">
<!--                        <thead>-->
<!--                            <tr>-->
<!--                                <th class="no-sort">Method</th>-->
<!--                                <th class="desktop tablet-p sortBy">Expires</th>-->
<!--                                <th class="desktop no-sort" width="80">Actions</th>-->
<!--                            </tr>-->
<!--                        </thead>-->
                        <tbody>
                            <?php if(count($rows) > 0) :?>
                                <?php foreach ($rows as $key => $row) :?>
                                    <?php if (empty($row->paypal)): ?>
                                        <tr>
                                        <td>
                                            <div class="inner">
                                                <div class="icon"><!-- <i class="fi-credit-card"></i>--><img src="<?= base_url('assets/images/cards/'.$row->image)?>" alt=""></div>
                                                <div class="pin"><em>&#9679; &#9679; &#9679; &#9679; &#9679;</em> <?= $row->last_digits?></div>
                                                <?php if (!empty($row->default_method)): ?>
                                                    <span class="miniLbl green">Default</span>
                                                <?php endif ?>
                                            </div>
                                        </td>
                                        <td><?= $row->expiry?></td>
                                        <td width="80">
                                            <div class="dropDown">
                                                <a href="javascript:void(0)" class="webBtn smBtn dropBtn">Edit</a>
                                                <ul class="dropCnt dropLst">
                                                    <li><a href="<?= site_url('payment-methods/make-default/'.$row->encoded_id)?>">Make Default</a></li>
                                                    <!-- <li><a href="#" data-toggle="modal" data-target="#edit_card_<?php echo $row->id; ?>">Edit Card</a></li> -->
                                                    <li><a href="<?= site_url('payment-methods/delete/'.$row->encoded_id)?>" onclick="return confirm('Are you sure ?')">Delete Account</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                    <?php else: ?>
                                    <tr>
                                        <td>
                                            <div class="inner">
                                                <div class="icon"><!-- <i class="fi-paypal"></i>--><img src="<?= base_url('assets/images/'.$row->image)?>" alt=""></div>
                                                <div class="icon"><i class="fi-paypal"></i></div>
                                                <div class="pin"><?= $row->paypal?></div>
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
                                                    <li><a href="<?= site_url('payment-methods/make-default/'.$row->encoded_id)?>">Make Default</a></li>
                                                    <!-- <li><a href="#" data-toggle="modal" data-target="#edit_card_<=$row->id ?>">Edit Card</a></li> -->
                                                    <li><a href="<?= site_url('payment-methods/delete/'.$row->encoded_id)?>" onclick="return confirm('Are you sure ?')">Delete Account</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endif ?>
                                <?php endforeach?>
                            <?php else: ?>
                                <tr>
                                    <td>
                                        No payment method found.
                                    </td>
                                </tr>
                            <?php endif ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- dash -->
<?php $this->load->view('includes/footer');?>

<?php foreach ($rows as $key => $row) :?>
<?php if (empty($row->paypal)): ?>
	<!-- Modal -->
	<div id="edit_card_<?php echo $row->id; ?>" class="modal fade card_update" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Update Card Details</h4>
	      </div>
	      <div class="modal-body">
	      	<form action="" method="post" autocomplete="off" id="frmPayment">
	      		<span style="color: red;" class="status_update"></span>
		        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
		            <h4>Card number</h4>
		            <input type="hidden" name="row_id" id="row_id" value="<?php echo $row->id; ?>">
		            <input type="hidden" name="customer_id" id="customer_id" value="<?php echo $row->stripe_customer_id; ?>">
		            <input type="hidden" name="method_token" id="method_token" value="<?php echo $row->method_token; ?>">
		            <input type="text" name="cardnumber" id="cardnumber" class="txtBox frmfield" value="" placeholder="" required="" autofocus=""> 
		        </div>
		        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                    <h4>Card holder</h4>
                    <input type="text" name="card_holder_name" id="card_holder_name" class="txtBox" placeholder="" value="">
                </div>
		        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xx-4 txtGrp">
		            <h4>Expiry Month</h4>
		            <select class="txtBox selectpicker" name="exp_month" id="exp_month" required="">
		                <?php for($i=1;$i<=12;$i++):?>
		                    <option value="<?=sprintf('%02d', $i);?>" <?=(sprintf('%02d', $i)==$mem_data->mem_card_exp_month?'selected':'')?>><?=sprintf('%02d', $i);?></option>
		                <?php endfor?>
		            </select>
		        </div>
		        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xx-4 txtGrp">
		            <h4>Expiry Year</h4>
		            <select  name="exp_year" id="exp_year" class="txtBox selectpicker" required="">
		                <?php for($i=date('Y');$i<=date('Y')+10;$i++):?>
		                    <option value="<?=$i?>"<?=($i==$mem_data->mem_card_exp_year?' selected':'')?>><?=$i?></option>
		                <?php endfor?>
		            </select>
		        </div>
		        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xx-4 txtGrp">
		            <h4>CVC ?</h4>
		            <input type="text" name="cvc" id="cvc" class="txtBox" placeholder="">
		        </div>
		      </div>
		      <div class="modal-footer">
		        <button type="submit" id="submit_button" class="btn btn-primary" >  <i class="fa-spinner hidden"></i>Submit</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		  </form>
	    </div>

	  </div>
	</div>
<?php endif ?>
<?php endforeach?>
<script type="text/javascript">
	$(function(){
    	$(document).on('submit', '#frmPayment', function (e) {
            e.preventDefault();

            needToConfirm = true;
            // createToken returns immediately - the supplied callback submits the form if there are no errors
            $(this).find('#submit_button').attr("disabled", true).find("i.fa-spinner").removeClass("hidden");
            Stripe.card.createToken({
                number: $('#cardnumber').val(),
                cvc: $('#cvc').val(),
                exp_month: $('#exp_month').val(),
                exp_year: $('#exp_year').val(),
               	name: $('#card_holder_name').val()
            }, stripeResponseHandler);
            return false; // submit from callback
        });

        Stripe.setPublishableKey('<?= API_PUBLIC_KEY; ?>');
        function stripeResponseHandler(status, response) {
            var form$ = $("#frmPayment");
            var sbtn=form$.find("button[type='submit']");
            var frmIcon=form$.find("button[type='submit'] i.fa-spinner");
            if (response.error) {
                needToConfirm = false;
                sbtn.attr("disabled", false);
                frmIcon.addClass("hidden");

                $("#alertMsg").html('<div class="alert alert-danger alert-sm"><strong>Error:</strong>1 ' + response.error.message + '</div>');
                $("#alertMsg").focus();
            } else {
                var nonce = response['id'];
                var frmMsg=form$.find("div.alertMsg:first");
            
	            var customer_id = $('#customer_id').val();
	            var method_token = $('#method_token').val();
	            var row_id = $('#row_id').val();

	            /*var card_number = $('#cardnumber').val();
	            var card_name = $('#card_holder_name').val();
	            var exp_month = $('#exp_month').val();
	            var exp_year = $('#exp_year').val();
	            var cvc = $('#cvc').val();*/
        
            	//var frmMsg=form$.find("div.alertMsg:first");
	            $.ajax({
	                url: base_url+"payment-methods/update-card",
	                data : {'type':'credit-card', 'nonce':nonce, 'method_token': method_token, 'row_id': row_id},
	                dataType: 'JSON',
	                method: 'POST',
	                success: function (rs) {
	                	$('.status_update').html(rs.msg);
	                    console.log(rs.msg);
	                    setTimeout(function(){
                            location.reload();
                        },1500);
	                    $("html, body").animate({ scrollTop: 100 }, "slow");
	                },
	                error: function (rs) {
	                    console.log(rs);
	                },
	                complete: function (rs) {
	                    needToConfirm = false;
	                }
	            });
	        }
	    }
        $(function(){;
            $('#frmPayment').validate({
                rules: {
                    card_holder_name: {
                        required: true,
                    },
                    cardnumber: {
                        required: true,
                        maxlength: 19
                    },
                    exp_month: {
                        required: true,
                    },
                    exp_year: {
                        required: true,
                    },
                    cvc: {
                        required: true,
                        maxlength: 4
                    }
                },errorPlacement: function(){
                    return false;
                }
            });
        });
    });
</script>
</body>
</html>