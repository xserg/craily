<!doctype html>
<html>
<head>
    <title><?= $page_title?> - <?= $site_settings->site_name?></title>
    <?php $this->load->view('includes/site-master'); ?>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
</head>
<body id="home-page">
    <?php $this->load->view('includes/header'); ?>

    <div class="modal fade" id="service_details" data-target="#service_details">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header orange">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #2db1ff;opacity: 1;"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"><strong></strong></h4>
					<p>This <?php echo $this->data['site_settings']->site_percentage ?>% service fee helps us operate crainly.</p>
	            </div>
	        </div>
	    </div>
	</div>

    <div class="modal fade" id="add_new_card" data-target="#add_new_card">
	    <div class="modal-dialog ">
	        <div class="modal-content">
	            <div class="modal-header custom-modal-header orange">
					<button type="button" class="close custom-modal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title text-center" style="color: #000000"><strong>Add Payment Method</strong></h4>
                </div>
                <div class="modal-body">
					<form action="" method="post" autocomplete="off" id="frmPayment">
                        <input type="hidden" name="type" value="credit-card">
                        <div class="formBlk">
                            <div class="row formRow">
                                <noscript>
                                    <div>
                                        <h4>JavaScript is not enabled!</h4>
                                        <p>This payment form requires your browser to have JavaScript enabled. Please activate JavaScript and reload this page. Check <a href="http://enable-javascript.com" target="_blank">enable-javascript.com</a> for more informations.</p>
                                    </div>
                                </noscript>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xx-12 txtGrp">
<!--                                    <h4>Card number</h4>-->
<!--                                    <div class="icon">-->
<!--                                    	<img src="--><?//= base_url('assets/images/download.png')?><!--" alt="" id="card_type" style="width: 40px;">-->
<!--                                        <input type="text" name="cardnumber" id="cardnumber" class="txtBox frmfield" value="" placeholder="" required="" autofocus="">-->
<!--                                    </div>-->
                                    <label for="cardnumber">Card Number</label>
                                    <input type="text" name="cardnumber" id="cardnumber" class="txtBox frmfield" value="" placeholder="" required="" autofocus="">
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xx-4 txtGrp form-group">
<!--                                    <h4>Expiry Month</h4>-->
                                    <label for="exp_month">Expiration Month</label>
                                    <select class="txtBox selectpicker" name="exp_month" id="exp_month" required="">
                                        <?php for($i=1;$i<=12;$i++):?>
                                            <option value="<?=sprintf('%02d', $i);?>" <?=(sprintf('%02d', $i)==$mem_data->mem_card_exp_month?'selected':'')?>><?=sprintf('%02d', $i);?></option>
                                        <?php endfor?>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xx-4 txtGrp">
<!--                                    <h4>Expiry Year</h4>-->
                                    <label for="exp_year">Expiration Year</label>
                                    <select  name="exp_year" id="exp_year" class="txtBox selectpicker" required="">
                                        <?php for($i=date('Y');$i<=date('Y')+10;$i++):?>
                                            <option value="<?=$i?>"<?=($i==$mem_data->mem_card_exp_year?' selected':'')?>><?=$i?></option>
                                        <?php endfor?>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xx-4 txtGrp">
<!--                                    <h4>CVC ?</h4>-->
                                    <label>CVC</label>
                                    <input type="text" name="cvc" id="cvc" class="txtBox" placeholder="">
                                </div>
                            </div>
                            <div class="bTn text-center">
                                <button type="submit" id="submit_button" class="webBtn colorBtn">Add Card <i class="fa-spinner hidden"></i></button>
                            </div>
                            <div class="alertMsg" id="alertMsg"></div>
                        </div>
                    </form>
	            </div>
	        </div>
	    </div>
	</div>

    <section id="dash">
        <div class="contain-fluid">
            <div class="lBar ease">
                <?php $this->load->view('includes/sidebar'); ?>
            </div>
            <div id="myRqst" class="inSide">
                <div class="blk">
                    <div class="_header">
<!--                        <h3>--><?//= $page_title?><!--</h3>-->
                        <h3>
                            <a href="<?= site_url( 'requests' ) ?>" class="webBtn colorBtn">Back</a>
                        </h3>
                    </div>
                    <div id="request-payment-body" class="request-payment-body" data-popup="view-detail">

                    </div>
                    <div class="appLoad"><div class="appLoader"><span class="spiner"></span></div></div>
                </div>
<!--                <div class="popup detail-pupup" data-popup="view-detail">-->
<!--                    <div class="tableDv">-->
<!--                        <div class="tableCell">-->
<!--                            <div class="contain">-->
<!--                                <div class="_inner">-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
            </div>
        </div>
    </section>
    <!-- dash -->

   <?php $this->load->view('includes/footer');?>
    <script type="text/javascript">
    	function creditCardTypeFromNumber(num) {
			   // first, sanitize the number by removing all non-digit characters.
			   num = num.replace(/[^\d]/g,'');
			   // now test the number against some regexes to figure out the card type.
			   if (num.match(/^5[1-5]\d{14}$/)) {
			     return 'mastercard';
			   } else if (num.match(/^4\d{15}/) || num.match(/^4\d{12}/)) {
			     return 'visa';
			   } else if (num.match(/^3[47]\d{13}/)) {
			     return 'american_express';
			   } else if (num.match(/^6011\d{12}/)) {
			     return 'discover';
			   }
			   return 'UNKNOWN';
		}
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
	                    exp_year: $('#exp_year').val()
	                   // name: $('#card_holder_name').val()
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

	                $("#alertMsg").html('<div class="alert alert-danger alert-sm"><strong>Error:</strong> ' + response.error.message + '</div>');
	                $("#alertMsg").focus();
	            } else {
	                var nonce = response['id'];
	                // console.log(nonce);
	                // form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
	                /*var sbtn=form$.find("button[type='submit']");
	                var frmIcon=form$.find("button[type='submit'] i.fa-spinner");
	                sbtn.attr("disabled", true);
	                frmIcon.removeClass("hidden");*/
	                var frmMsg=form$.find("div.alertMsg:first");
	                $.ajax({
	                    url: base_url+"payment-methods/add-new",
	                    data : {'type':'credit-card','nonce':nonce},
	                    dataType: 'JSON',
	                    method: 'POST',
	                    success: function (rs) {
	                        console.log(rs);
	                        $("html, body").animate({ scrollTop: 100 }, "slow");
	                        frmMsg.html(rs.msg).slideDown(500);
	                        if (rs.status == 1) {
	                            setTimeout(function () {
	                                frmIcon.addClass("hidden");
	                                form$[0].reset();
	                                var card = rs.credit_card; //credit card

	                                //$('.menu-inner').appendTo('<li data-original-index="0" class><a tabindex="0" class="payment_option" style="background-image:url(https://crainly.com/assets/images/cards/'+card.image+') !important;background-repeat: no-repeat!important;padding: 13px;display: inline-block;padding-left: 70px;background-position: 5px 6px !important;width: 100%;background-color: #FFFAF6 !important;" data-normalized-text="<span class=&quot;text&quot;> * * * * * '+card.last_digits+'</span>" data-tokens="null"><span class="text"> * * * * * '+card.last_digits+'</span></a></li>');

	                                //$('#payment_method').appendTo('<option style="background-image:url(https://crainly.com/assets/images/cards/'+card.image+') !important;background-repeat: no-repeat!important;padding: 13px;display: inline-block;padding-left: 70px;background-position: 5px 6px !important;width: 100%;background-color: #FFFAF6 !important;" class="payment_option" value="'+card.encoded_id+'"> * * * * * '+card.last_digits+'</option>');
	                                $('#add_new_card').modal('toggle');
	                                 location.reload();
	                                //window.location.href = rs.redirect_url;
	                            }, 3000);
	                        } else {
	                            setTimeout(function () {
	                                frmIcon.addClass("hidden");
	                                sbtn.attr("disabled", false);
	                            }, 3000);
	                        }
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

        	$('#cardnumber').keyup(function() {
			    $('#card_type').attr('src', 'https://crainly.com/assets/images/cards/'+creditCardTypeFromNumber($(this).val())+'.png');
			});
            var ajaxSearch = false;

            // NOTE get request payment details
            var store= '<?php echo $encoded_id;?>';
            var image = '<?php echo $tut_image;?>';
            var name = '<?php echo $tut_name;?>';
            var mem_id = '';
            $('.appLoad').fadeIn('fast');
            // $('.appLoad').hide();
            $.ajax({
                url: base_url+'get-request-detail',
                data : {'store':store, 'image': image, 'name': name, 'mem_id': mem_id},
                dataType: 'JSON',
                method: 'POST',
                success: function (rs) {
                    $('.appLoad').hide();
                    if(rs.status===1){

                        $('#request-payment-body').html(rs.data);
                        $('.selectpicker').selectpicker('refresh');

                        // btn.find('span').remove();
                        // $('body').addClass('flow');
                        // var detail_popup=$(".popup[data-popup='view-detail']");
                        // detail_popup.find('._inner').html(rs.data);
                        // refresh_rateYo();
                        // refresh_selectpicker();
                        // detail_popup.fadeIn();
                    }
                    else
                        alert('Something went wrong!')
                },
                error: function(rs){
                    console.log(rs);
                    $('.appLoad').hide();
                },
                complete: function (rs) {
                    $('.appLoad').hide();
                    ajaxSearch=false;
                    needToConfirm = false;
                }
            })

            // TODO remove below code
            // $(document).on('click','a.view-detail',function(e){
            //    // e.preventDefault();
            //     if(ajaxSearch)
            //         return;
            //     ajaxSearch=true;
            //     var btn=$(this);
            //     var store=btn.data('store');
            //     if (store=='')
            //         return false;
            //     needToConfirm = true;
            //
            //     var image = $(this).attr('data-image');
            //     var name = $(this).attr('data-name');
            //     var mem_id = $(this).attr('data-mem');
            //
            //     $.ajax({
            //         url: base_url+'get-request-detail',
            //         data : {'store':store, 'image': image, 'name': name, 'mem_id': mem_id},
            //         dataType: 'JSON',
            //         method: 'POST',
            //         success: function (rs) {
            //             if(rs.status===1){
            //                 btn.find('span').remove();
            //                 $('body').addClass('flow');
            //                 var detail_popup=$(".popup[data-popup='view-detail']");
            //                 detail_popup.find('._inner').html(rs.data);
            //                 refresh_rateYo();
            //                 refresh_selectpicker();
            //                 detail_popup.fadeIn();
            //             }
            //             else
            //                 alert('Something went wrong!')
            //         },
            //         error: function(rs){
            //             console.log(rs);
            //         },
            //         complete: function (rs) {
            //             ajaxSearch=false;
            //             needToConfirm = false;
            //         }
            //     })
            // })
            <?php if($this->session->mem_type=='tutor'):?>
                $(document).on('click','div[data-popup="view-detail"] a.actn-btn',function(e){
                    e.preventDefault()
                    if(ajaxSearch)
                        return;
                    var btn=$(this);
                    var store=btn.data('store');
                    var link=btn.data('link');
                    if (store=='' || link=='')
                        return false;
                    if (btn.data("disabled"))
                        return false;
                    if (link=='reject-lesson-request')
                       if(!confirm('Are you sure ?'))
                        return false;
                    needToConfirm = true;


                    btn.data("disabled", "disabled");
                    btn.find("i.fa-spinner").removeClass('hidden');
                    $.ajax({
                        url: base_url+'/'+link,
                        data : {'store':store},
                        dataType: 'JSON',
                        method: 'POST',
                        success: function (rs) {
                            if(rs.status===1){
                                btn.parents('div.bTn').after(rs.data);
                                btn.parents('div.bTn').remove();
                                if(rs.reload===1){
                                    setTimeout(function(){
                                        location.reload();
                                    },1000)
                                }
                            }
                            else
                                alert('Something went wrong!')
                        },
                        error: function(rs){
                            console.log(rs);
                        },
                        complete: function (rs) {
                            ajaxSearch=false;
                            needToConfirm = false;
                        }
                    })
                })
            <?php endif?>
            <?php if($this->session->mem_type=='student'):?>
            $(document).on('click', 'div[data-popup="view-detail"] .bkNow', function(e){
                e.preventDefault()
                
                if(ajaxSearch)
                    return;

                var btn=$(this);
                var payment_method=$('#payment_method').val();
                var promocode=$('#promocode').val();
                var store=btn.data('store');
                if (store=='' || payment_method=='' || payment_method==null){
                    return false;
                }
                needToConfirm = true;

                btn.attr("disabled", true);
                btn.find("i.fa-spinner").removeClass('hidden');
                $('div[data-popup="view-detail"] .alertMsg:first').html('');
                $.ajax({
                    url: base_url+'/book-now',
                    data : {'store':store,'payment_method':payment_method,'promocode':promocode,'payment_type':'saved-card'},
                    dataType: 'JSON',
                    method: 'POST',
                    success: function (rs) {
                        
                        if(rs.status===1){
                            btn.parents('#request-payment-body').append(rs.data);
                            btn.parents('.svdCards').remove();
                            $('div[data-popup="view-detail"] .alertMsg:first, div[data-popup="view-detail"] form').remove();
                            setTimeout(function(){
                                location.reload();
                            },1500)
                        }
                        else{
                            $('div[data-popup="view-detail"] .alertMsg:first').html('<div class="alert alert-danger alert-sm"><strong>Error:</strong> ' + rs.msg+ '</div>');
                            btn.attr("disabled", false);
                            btn.find("i.fa-spinner").addClass('hidden');
                        }
                        
                    },
                    error: function(rs){

                        $('div[data-popup="view-detail"] .alertMsg:first').html('<div class="alert alert-danger alert-sm"><strong>Error:</strong> ' + rs.responseText + '</div>');
                        btn.attr("disabled", false);
                        btn.find("i.fa-spinner").addClass('hidden');
                        console.log(rs);
                    },
                    complete: function (rs) {
                        ajaxSearch=false;
                        needToConfirm = false;
                    }
                })
            });

            //apply promo code
            $(document).on('click', '.apply_button', function(e) {
            	e.preventDefault();
            	var promocode = $('#promocode').val();
            	var btn=$(this);
            	btn.find("i.fa-spinner").removeClass('hidden');
            	var store = $('#encoded_id').val();
            	var total_num = $('#total_sum').val();
            	
            	$.ajax({
                    url: '<?php echo base_url(); ?>check_coupon',
                    data : {'store':store, 'promocode':promocode, 'total_num':total_num},
                    dataType: 'JSON',
                    method: 'POST',
                    success: function (rs) {
                        console.log(rs);
                        if(rs.status===1){
                        	$('.pre_promo_code').hide();
                			$('.promo_coded').show();
                			$('.promo_code').hide();
                        	$('.applied_promo_view').text(rs.promo_code_discount);
                        	//$('.applied_promo_code').text(rs.promo_code_discount);
                           	$('.total_amount_applied').text(rs.amount);
                            $('.show_result').html(rs.data);
                        }
                        else{
                        	$('.show_result').html(rs.data);
                            $('div[data-popup="view-detail"] .alertMsg:first').html(rs.msg)
                            btn.attr("disabled", false);
                            btn.find("i.fa-spinner").addClass('hidden');
                        }
                        
                    },
                    error: function(rs){

                        console.log(rs);
                    },
                    complete: function (rs) {
                        ajaxSearch=false;
                        needToConfirm = false;
                    }
                });
            });
            <?php endif?>
            /*$(document).on('submit', 'div[data-popup="view-detail"] form.frmCreditCard', function(e){
                e.preventDefault()
                needToConfirm = true;
                var frmbtn=$(this).find("button[type='submit']");
                var frmIcon=frmbtn.find("i.fa-spinner");
                var frmMsg=$(this).find("div.alertMsg:first");
                var frm=this;

                var store=frmbtn.data('store');
                if (store=='')
                    return false;

                frmbtn.attr("disabled", true);
                frmIcon.removeClass("hidden");
                frmMsg.html('');

                var formData = new FormData(frm);
                formData.append('store', store);
                $.ajax({
                    url: base_url+'/book-now',
                    data : formData,
                    // data : new FormData(frm),
                    processData: false,
                    contentType: false,
                    dataType: 'JSON',
                    method: 'POST',
                    success: function (rs) {
                        console.log(rs);
                        setTimeout(function(){
                            if(rs.status===1){
                                frmbtn.parents('div._inner').append(rs.data);
                                frmbtn.parents('.svdCards').remove();
                                $(frm).remove();
                            }
                            else{
                                frmMsg.html(rs.msg)
                                frmbtn.attr("disabled", false);
                                frmbtn.find("i.fa-spinner").addClass('hidden');
                            }
                        },1000)
                    },
                    error: function(rs){
                        console.log(rs);
                    },
                    complete: function (rs) {
                        needToConfirm = false;
                    }
                })
            })
            $(document).on('click', 'div[data-popup="view-detail"] .addCard,div[data-popup="view-detail"]  .cnclBtnNCard', function(){
                $('div[data-popup="view-detail"] form,div[data-popup="view-detail"]  .svdCards').slideToggle();
            });*/
        })
    </script>
</body>
</html>