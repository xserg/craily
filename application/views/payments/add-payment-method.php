<!doctype html>
<html>
<head>
    <title>Payment Method - <?= $site_settings->site_name ?></title>
	<?php $this->load->view( 'includes/site-master' ); ?>
    <link type="text/css" rel="stylesheet" href="<?= base_url( 'assets/css/stripe-credit-card.css' ) ?>">
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
</head>
<body id="home-page">
<?php $this->load->view( 'includes/header' ); ?>

<section id="dash">
    <div class="contain-fluid">
        <div class="lBar ease">
			<?php $this->load->view( 'includes/sidebar' ); ?>
        </div>
        <div id="payMthd" class="inSide">
            <!-- <div class="blk">
                    <div class="_header">
                        <h3>Payment Method</h3>
                        <a href="<?= site_url( 'payment-methods' ) ?>" class="webBtn">Back</a>
                    </div>
                    <ul class="payLst text-center">
                        <li>
                            <a href="javascript:void(0)" data-pay-method="credit"><i class="fi-credit-card"></i><span>Credit Card</span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" data-pay-method="paypal"><i class="fi-paypal"></i><span>PayPal</span></a>
                        </li>
                    </ul>
                </div> -->
            <!-- <div class="blk" data-pay-method="credit"> -->
            <div class="blk">
                <div class="_header">
                    <h3>Credit card</h3>
                    <ul class="cardLst">
                        <li><img src="<?= base_url( 'assets/images/card1.svg' ) ?>" alt=""></li>
                        <li><img src="<?= base_url( 'assets/images/card2.svg' ) ?>" alt=""></li>
                        <li><img src="<?= base_url( 'assets/images/card3.svg' ) ?>" alt=""></li>
                        <li><img src="<?= base_url( 'assets/images/card4.svg' ) ?>" alt=""></li>
                    </ul>
                </div>

                <form action="" method="post" autocomplete="off" id="frmPayment">
                    <div id="parent-div-id" name="parent-div-name">
                        <div id="child-element-1" class="partial" data-element-number="1" style="position: relative;">
                            <div id="preload-1" class="custom-container preload custom-preload">
                                <div id="creditcard-1" class="creditcard">
                                    <div class="front">
                                        <div id="ccsingle-1" class="ccsingle"></div>
                                        <svg version="1.1" id="cardfront" xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 750 471"
                                             style="enable-background:new 0 0 750 471;" xml:space="preserve">
                        <g id="Front">
                            <g id="CardBackground">
                                <g id="Page-1_1_">
                                    <g id="amex_1_">
                                        <path id="Rectangle-1_1_" class="lightcolor-1 grey" d="M40,0h670c22.1,0,40,17.9,40,40v391c0,22.1-17.9,40-40,40H40c-22.1,0-40-17.9-40-40V40
                                C0,17.9,17.9,0,40,0z"/>
                                    </g>
                                </g>
                                <path class="darkcolor-1 greydark"
                                      d="M750,431V193.2c-217.6-57.5-556.4-13.5-750,24.9V431c0,22.1,17.9,40,40,40h670C732.1,471,750,453.1,750,431z"/>
                            </g>
                            <text transform="matrix(1 0 0 1 60.106 295.0121)" id="svgnumber-1" class="svgnumber st2 st3 st4">0123 4567
                                8910 1112
                            </text>
                            <!-- <text transform="matrix(1 0 0 1 54.1064 428.1723)" id="svgname" class="st2 st5 st6">JOHN DOE</text> -->
                            <!-- <text transform="matrix(1 0 0 1 54.1074 389.8793)" class="st7 st5 st8">cardholder name</text> -->
                            <text transform="matrix(1 0 0 1 479.7754 388.8793)" class="st7 st5 st8">expiration</text>
                            <text transform="matrix(1 0 0 1 65.1054 241.5)" class="st7 st5 st8">card number</text>
                            <g>
                                <text transform="matrix(1 0 0 1 574.4219 433.8095)" id="svgexpire-1"
                                      class="svgexpire st2 st5 st9">01/23
                                </text>
                                <text transform="matrix(1 0 0 1 479.3848 417.0097)" class="st2 st10 st11">VALID</text>
                                <text transform="matrix(1 0 0 1 479.3848 435.6762)" class="st2 st10 st11">THRU</text>
                                <polygon class="st2" points="554.5,421 540.4,414.2 540.4,427.9 		"/>
                            </g>
                            <g id="cchip">
                                <g>
                                    <path class="st2" d="M168.1,143.6H82.9c-10.2,0-18.5-8.3-18.5-18.5V74.9c0-10.2,8.3-18.5,18.5-18.5h85.3
                            c10.2,0,18.5,8.3,18.5,18.5v50.2C186.6,135.3,178.3,143.6,168.1,143.6z"/>
                                </g>
                                <g>
                                    <g>
                                        <rect x="82" y="70" class="st12" width="1.5" height="60"/>
                                    </g>
                                    <g>
                                        <rect x="167.4" y="70" class="st12" width="1.5" height="60"/>
                                    </g>
                                    <g>
                                        <path class="st12" d="M125.5,130.8c-10.2,0-18.5-8.3-18.5-18.5c0-4.6,1.7-8.9,4.7-12.3c-3-3.4-4.7-7.7-4.7-12.3
                                c0-10.2,8.3-18.5,18.5-18.5s18.5,8.3,18.5,18.5c0,4.6-1.7,8.9-4.7,12.3c3,3.4,4.7,7.7,4.7,12.3
                                C143.9,122.5,135.7,130.8,125.5,130.8z M125.5,70.8c-9.3,0-16.9,7.6-16.9,16.9c0,4.4,1.7,8.6,4.8,11.8l0.5,0.5l-0.5,0.5
                                c-3.1,3.2-4.8,7.4-4.8,11.8c0,9.3,7.6,16.9,16.9,16.9s16.9-7.6,16.9-16.9c0-4.4-1.7-8.6-4.8-11.8l-0.5-0.5l0.5-0.5
                                c3.1-3.2,4.8-7.4,4.8-11.8C142.4,78.4,134.8,70.8,125.5,70.8z"/>
                                    </g>
                                    <g>
                                        <rect x="82.8" y="82.1" class="st12" width="25.8" height="1.5"/>
                                    </g>
                                    <g>
                                        <rect x="82.8" y="117.9" class="st12" width="26.1" height="1.5"/>
                                    </g>
                                    <g>
                                        <rect x="142.4" y="82.1" class="st12" width="25.8" height="1.5"/>
                                    </g>
                                    <g>
                                        <rect x="142" y="117.9" class="st12" width="26.2" height="1.5"/>
                                    </g>
                                </g>
                            </g>
                        </g>
                                            <g id="Back">
                                            </g>
                    </svg>
                                    </div>
                                    <div class="back">
                                        <svg version="1.1" id="cardback" xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 750 471"
                                             style="enable-background:new 0 0 750 471;" xml:space="preserve">
                        <g id="Front">
                            <line class="st0" x1="35.3" y1="10.4" x2="36.7" y2="11"/>
                        </g>
                                            <g id="Back">
                                                <g id="Page-1_2_">
                                                    <g id="amex_2_">
                                                        <path id="Rectangle-1_2_" class="darkcolor-1 greydark" d="M40,0h670c22.1,0,40,17.9,40,40v391c0,22.1-17.9,40-40,40H40c-22.1,0-40-17.9-40-40V40
                            C0,17.9,17.9,0,40,0z"/>
                                                    </g>
                                                </g>
                                                <rect y="61.6" class="st2" width="750" height="78"/>
                                                <g>
                                                    <path class="st3" d="M701.1,249.1H48.9c-3.3,0-6-2.7-6-6v-52.5c0-3.3,2.7-6,6-6h652.1c3.3,0,6,2.7,6,6v52.5
                        C707.1,246.4,704.4,249.1,701.1,249.1z"/>
                                                    <rect x="42.9" y="198.6" class="st4" width="664.1" height="10.5"/>
                                                    <rect x="42.9" y="224.5" class="st4" width="664.1" height="10.5"/>
                                                    <path class="st5"
                                                          d="M701.1,184.6H618h-8h-10v64.5h10h8h83.1c3.3,0,6-2.7,6-6v-52.5C707.1,187.3,704.4,184.6,701.1,184.6z"/>
                                                </g>
                                                <text transform="matrix(1 0 0 1 621.999 227.2734)" id="svgsecurity-1" class="svgsecurity st6 st7">985</text>
                                                <g class="st8">
                                                    <text transform="matrix(1 0 0 1 518.083 280.0879)" class="st9 st6 st10">security code</text>
                                                </g>
                                                <rect x="58.1" y="378.6" class="st11" width="375.5" height="13.5"/>
                                                <rect x="58.1" y="405.6" class="st11" width="421.7" height="13.5"/>
                                                <!--<text transform="matrix(1 0 0 1 59.5073 228.6099)" id="svgnameback" class="st12 st13">-->
                                                <!--    John Doe-->
                                                <!--</text>-->
                                            </g>
                                     </svg>
                                    </div>
                                </div>
                            </div >
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2" style="margin-top: 15px;">
                                            <div class="textGrp">
                                                <label for="cardnumber">Card Number</label>
                                                <input id="cardnumber-1" name="cardnumber[1]" class="txtBox cardnumber required" type="text" pattern="[0-9]*" inputmode="numeric">
                                                <svg id="ccicon-1" class="ccicon" width="750" height="471" viewBox="0 0 750 471" version="1.1"
                                                     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4 col-lg-offset-2" style="margin-top: 15px;">
                                            <div class="textGrp">
                                                <label for="exp_month">Expiration Month</label>
                                                <select id="exp_month-1" class="txtBox selectpicker exp_month" name="exp_month[1]" required="">
								                    <?php for($i=1;$i<=12;$i++):?>
                                                        <option value="<?=sprintf('%02d', $i);?>" <?=(sprintf('%02d', $i)==$mem_data->mem_card_exp_month?'selected':'')?>><?=sprintf('%02d', $i);?></option>
								                    <?php endfor?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4" style="margin-top: 15px;">
                                            <div class="textGrp">
                                                <label for="exp_year">Expiration Year</label>
                                                <select id="exp_year-1" class="txtBox selectpicker exp_year required" name="exp_year[1]" required="">
								                    <?php for($i=date('Y');$i<=date('Y')+10;$i++):?>
                                                        <option value="<?=$i?>"<?=($i==$mem_data->mem_card_exp_year?' selected':'')?>><?=$i?></option>
								                    <?php endfor?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2" style="margin-top: 15px;">
                                            <div class="textGrp">
                                                <label for="cvc">Security Code</label>
                                                <input id="cvc-1" class="txtBox cvc required" type="text" name="cvc[1]" pattern="[0-9]*" inputmode="numeric">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="bTn text-center" style="margin-top: 35px;">
                            <a href="<?= site_url( 'payment-methods' ) ?>" class="webBtn">Back</a>
                            <button type="submit" id="submit_button" class="webBtn colorBtn">
                                Add card
                                <i class="fa-spinner hidden"></i></button>
<!--                            <button type="button" id="add-extra-card" class="webBtn colorBtn">-->
<!--                                Add another card-->
<!--                                <i class="fa-spinner hidden"></i>-->
<!--                            </button>-->
                        </div>
                        <div class="alertMsg" id="alertMsg"></div>
                    </div>
                </form>
            </div>
            <!-- <div class="blk" data-pay-method="paypal">
				<div class="_header">
					<h3>PayPal</h3>
				</div>
				<form action="" method="post" autocomplete="off" id="frmChangeEmail" class="frmAjax">
					<input type="hidden" name="type" value="paypal">
					<div class="formBlk">
						<div class="row formRow">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xx-12 txtGrp">
								<h4>Paypal address</h4>
								<input type="text" name="email" id="email" class="txtBox" placeholder="">
							</div>
						</div>
						<div class="bTn text-center">
							<button type="submit" class="webBtn colorBtn">Submit <i class="fa-spinner hidden"></i></button>
						</div>
						<div class="alertMsg" id="alertMsg"></div>
					</div>
				</form>
			</div> -->
        </div>
    </div>
</section>
<!-- dash -->

<?php $this->load->view( 'includes/footer' ); ?>
<script src='https://cdnjs.cloudflare.com/ajax/libs/imask/3.4.0/imask.min.js'></script>
<script type="text/javascript" src="<?= base_url( 'assets/js/stripe-credit-card.js' ) ?>"></script>
<script type="text/javascript">
    $( document ).ready(function() {
        // call one time only
        addCustomEvents(1);

        $( document ).on('click', '#add-extra-card', function(e) {
            let lastElementNumber = $('#parent-div-id').children().last().data('element-number');
            let idNumber = lastElementNumber + 1;
            let newCreditCardHtml = getNewCreditCardHtml(idNumber);
            $('#parent-div-id').append('<hr>');
            $('#parent-div-id').append(newCreditCardHtml);
            $('#exp_month-' + idNumber ).selectpicker();
            $('#exp_year-' + idNumber ).selectpicker();
            setTimeout(function(){
                addCustomEvents(idNumber);
            },1000);
            newValidationRules();
        });

        $( document ).on('click', '.remove-button', function(e) {
            $(this).parent().prev().remove();
            $(this).parent().remove();
        });

        function newValidationRules() {
            $('#frmPayment .cardnumber').each(function() {
                $(this).rules("add",
                    {
                        required: true,
                        maxlength: 19,
                        messages: {
                            required: "Card number is required",
                        }
                    });
            });
            $('#frmPayment .exp_month').each(function() {
                $(this).rules("add",
                    {
                        required: true,
                        messages: {
                            required: "Expiration month is required",
                        }
                    });
            });
            $('#frmPayment .exp_year').each(function() {
                $(this).rules("add",
                    {
                        required: true,
                        messages: {
                            required: "Expiration year is required",
                        }
                    });
            });
            $('#frmPayment .cvc').each(function() {
                $(this).rules("add",
                    {
                        required: true,
                        messages: {
                            required: "CVC is required",
                        }
                    });
            });
        }

        function getNewCreditCardHtml(idNumber){
            let creditCardHtml = `
            <div id="child-element-${idNumber}" class="partial" data-element-number="${idNumber}" style="position: relative;">
                <div data-element-number="${idNumber}" class="remove-button">
                    <i class="fa fa-times-circle fa-lg" aria-hidden="true"></i>
                </div>
                <div id="preload-${idNumber}" class="custom-container preload custom-preload">
                    <div id="creditcard-${idNumber}" class="creditcard">
                        <div class="front">
                            <div id="ccsingle-${idNumber}" class="ccsingle"></div>
                            <svg version="1.1" id="cardfront" xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 750 471"
                                 style="enable-background:new 0 0 750 471;" xml:space="preserve">
                        <g id="Front">
                            <g id="CardBackground">
                                <g id="Page-1_1_">
                                    <g id="amex_1_">
                                        <path id="Rectangle-1_1_" class="lightcolor-${idNumber} grey" d="M40,0h670c22.1,0,40,17.9,40,40v391c0,22.1-17.9,40-40,40H40c-22.1,0-40-17.9-40-40V40
                                C0,17.9,17.9,0,40,0z"/>
                                    </g>
                                </g>
                                <path class="darkcolor-${idNumber} greydark"
                                      d="M750,431V193.2c-217.6-57.5-556.4-13.5-750,24.9V431c0,22.1,17.9,40,40,40h670C732.1,471,750,453.1,750,431z"/>
                            </g>
                            <text transform="matrix(1 0 0 1 60.106 295.0121)" id="svgnumber-${idNumber}" class="svgnumber st2 st3 st4">0123 4567
                                8910 1112
                            </text>
                            <!-- <text transform="matrix(1 0 0 1 54.1064 428.1723)" id="svgname" class="st2 st5 st6">JOHN DOE</text> -->
                            <!-- <text transform="matrix(1 0 0 1 54.1074 389.8793)" class="st7 st5 st8">cardholder name</text> -->
                            <text transform="matrix(1 0 0 1 479.7754 388.8793)" class="st7 st5 st8">expiration</text>
                            <text transform="matrix(1 0 0 1 65.1054 241.5)" class="st7 st5 st8">card number</text>
                            <g>
                                <text transform="matrix(1 0 0 1 574.4219 433.8095)" id="svgexpire-${idNumber}"
                                      class="svgexpire st2 st5 st9">01/23
                                </text>
                                <text transform="matrix(1 0 0 1 479.3848 417.0097)" class="st2 st10 st11">VALID</text>
                                <text transform="matrix(1 0 0 1 479.3848 435.6762)" class="st2 st10 st11">THRU</text>
                                <polygon class="st2" points="554.5,421 540.4,414.2 540.4,427.9 		"/>
                            </g>
                            <g id="cchip">
                                <g>
                                    <path class="st2" d="M168.1,143.6H82.9c-10.2,0-18.5-8.3-18.5-18.5V74.9c0-10.2,8.3-18.5,18.5-18.5h85.3
                            c10.2,0,18.5,8.3,18.5,18.5v50.2C186.6,135.3,178.3,143.6,168.1,143.6z"/>
                                </g>
                                <g>
                                    <g>
                                        <rect x="82" y="70" class="st12" width="1.5" height="60"/>
                                    </g>
                                    <g>
                                        <rect x="167.4" y="70" class="st12" width="1.5" height="60"/>
                                    </g>
                                    <g>
                                        <path class="st12" d="M125.5,130.8c-10.2,0-18.5-8.3-18.5-18.5c0-4.6,1.7-8.9,4.7-12.3c-3-3.4-4.7-7.7-4.7-12.3
                                c0-10.2,8.3-18.5,18.5-18.5s18.5,8.3,18.5,18.5c0,4.6-1.7,8.9-4.7,12.3c3,3.4,4.7,7.7,4.7,12.3
                                C143.9,122.5,135.7,130.8,125.5,130.8z M125.5,70.8c-9.3,0-16.9,7.6-16.9,16.9c0,4.4,1.7,8.6,4.8,11.8l0.5,0.5l-0.5,0.5
                                c-3.1,3.2-4.8,7.4-4.8,11.8c0,9.3,7.6,16.9,16.9,16.9s16.9-7.6,16.9-16.9c0-4.4-1.7-8.6-4.8-11.8l-0.5-0.5l0.5-0.5
                                c3.1-3.2,4.8-7.4,4.8-11.8C142.4,78.4,134.8,70.8,125.5,70.8z"/>
                                    </g>
                                    <g>
                                        <rect x="82.8" y="82.1" class="st12" width="25.8" height="1.5"/>
                                    </g>
                                    <g>
                                        <rect x="82.8" y="117.9" class="st12" width="26.1" height="1.5"/>
                                    </g>
                                    <g>
                                        <rect x="142.4" y="82.1" class="st12" width="25.8" height="1.5"/>
                                    </g>
                                    <g>
                                        <rect x="142" y="117.9" class="st12" width="26.2" height="1.5"/>
                                    </g>
                                </g>
                            </g>
                        </g>
                                            <g id="Back">
                                            </g>
                    </svg>
                                    </div>
                                    <div class="back">
                                        <svg version="1.1" id="cardback" xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 750 471"
                                             style="enable-background:new 0 0 750 471;" xml:space="preserve">
                        <g id="Front">
                            <line class="st0" x1="35.3" y1="10.4" x2="36.7" y2="11"/>
                        </g>
                                            <g id="Back">
                                                <g id="Page-1_2_">
                                                    <g id="amex_2_">
                                                        <path id="Rectangle-1_2_" class="darkcolor-${idNumber} greydark" d="M40,0h670c22.1,0,40,17.9,40,40v391c0,22.1-17.9,40-40,40H40c-22.1,0-40-17.9-40-40V40
                            C0,17.9,17.9,0,40,0z"/>
                                                    </g>
                                                </g>
                                                <rect y="61.6" class="st2" width="750" height="78"/>
                                                <g>
                                                    <path class="st3" d="M701.1,249.1H48.9c-3.3,0-6-2.7-6-6v-52.5c0-3.3,2.7-6,6-6h652.1c3.3,0,6,2.7,6,6v52.5
                        C707.1,246.4,704.4,249.1,701.1,249.1z"/>
                                                    <rect x="42.9" y="198.6" class="st4" width="664.1" height="10.5"/>
                                                    <rect x="42.9" y="224.5" class="st4" width="664.1" height="10.5"/>
                                                    <path class="st5"
                                                          d="M701.1,184.6H618h-8h-10v64.5h10h8h83.1c3.3,0,6-2.7,6-6v-52.5C707.1,187.3,704.4,184.6,701.1,184.6z"/>
                                                </g>
                                                <text transform="matrix(1 0 0 1 621.999 227.2734)" id="svgsecurity-${idNumber}" class="svgsecurity st6 st7">985</text>
                                                <g class="st8">
                                                    <text transform="matrix(1 0 0 1 518.083 280.0879)" class="st9 st6 st10">security code</text>
                                                </g>
                                                <rect x="58.1" y="378.6" class="st11" width="375.5" height="13.5"/>
                                                <rect x="58.1" y="405.6" class="st11" width="421.7" height="13.5"/>
                                                <!--<text transform="matrix(1 0 0 1 59.5073 228.6099)" id="svgnameback" class="st12 st13">-->
                <!--    John Doe-->
                <!--</text>-->
                </g>
                </svg>
                </div>
                </div>
                </div >
                <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2" style="margin-top: 15px;">
                <div class="textGrp">
                <label for="cardnumber">Card Number</label>
                <input id="cardnumber-${idNumber}" name="cardnumber[${idNumber}]" class="txtBox cardnumber required" type="text" pattern="[0-9]*" inputmode="numeric">
                <svg id="ccicon-${idNumber}" class="ccicon" width="750" height="471" viewBox="0 0 750 471" version="1.1"
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                </svg>
                </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4 col-lg-offset-2" style="margin-top: 15px;">
                <div class="textGrp">
                <label for="exp_month">Expiration Month</label>
                <select id="exp_month-${idNumber}" class="txtBox selectpicker exp_month required" name="exp_month[${idNumber}]" required="">
	        <?php for($i=1;$i<=12;$i++):?>
                <option value="<?=sprintf('%02d', $i);?>" <?=(sprintf('%02d', $i)==$mem_data->mem_card_exp_month?'selected':'')?>><?=sprintf('%02d', $i);?></option>
	        <?php endfor?>
                </select>
                </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4" style="margin-top: 15px;">
                <div class="textGrp">
                <label for="exp_year">Expiration Year</label>
                <select id="exp_year-${idNumber}" class="txtBox selectpicker exp_year required" name="exp_year[${idNumber}]" required="">
	        <?php for($i=date('Y');$i<=date('Y')+10;$i++):?>
                <option value="<?=$i?>"<?=($i==$mem_data->mem_card_exp_year?' selected':'')?>><?=$i?></option>
	        <?php endfor?>
                </select>
                </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-offset-2" style="margin-top: 15px;">
                <div class="textGrp">
                <label for="cvc">Security Code</label>
                <input id="cvc-${idNumber}" name="cvc[${idNumber}]" class="txtBox cvc required" type="text" pattern="[0-9]*" inputmode="numeric">
                </div>
                </div>
                </div>
                </div>
                </div>
                </div>`;
                return creditCardHtml;
        };
    });
</script>
<script type="text/javascript">
    $(document).ready(function (){
        $(document).on('submit', '#frmPayment', function (e) {
            e.preventDefault();
            if($('form#frmPayment').validate().form()){
                needToConfirm = true;
                let data = $('form#frmPayment').serializeArray();
                const testCardArray = makePostObject(data);
                testCardArray.forEach(function (item) {
                    Stripe.card.createToken(item, stripeResponseHandler);
                });

                $(this).find('#submit_button').attr("disabled", true).find("i.fa-spinner").removeClass("hidden");

                return false; // submit from callback
            } else {
                console.log('Please fill all details.')
            }
        });
        Stripe.setPublishableKey('<?= API_PUBLIC_KEY; ?>');

        function stripeResponseHandler(status, response) {
            var form$ = $("#frmPayment");
            var sbtn = form$.find("button[type='submit']");
            var frmIcon = form$.find("button[type='submit'] i.fa-spinner");
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
                var frmMsg = form$.find("div.alertMsg:first");
                $.ajax({
                    url: base_url + "payment-methods/add-new",
                    data: {'type': 'credit-card', 'nonce': nonce},
                    dataType: 'JSON',
                    method: 'POST',
                    success: function (rs) {
                        console.log(rs);
                        $("html, body").animate({scrollTop: 100}, "slow");
                        frmMsg.html(rs.msg).slideDown(500);
                        if (rs.status == 1) {
                            setTimeout(function () {
                                frmIcon.addClass("hidden");
                                form$[0].reset();
                                window.location.href = rs.redirect_url;
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

        function makePostObject(allData){
            console.log(allData);
            let dataArray = [];
            var idNumber = null;
            $.each(allData,function (key, data) {
                idNumber = data.name.substring(data.name.lastIndexOf("[") + 1, data.name.lastIndexOf("]"));

                if(dataArray[idNumber] === undefined || dataArray[idNumber] === {}){
                    dataArray[idNumber] = {};
                }

                if(data.name === "cardnumber["+idNumber+"]"){
                    dataArray[idNumber].number = data.value.replace(/ /g,'');
                }
                if(data.name === "exp_month["+idNumber+"]"){
                    dataArray[idNumber].exp_month = data.value
                }
                if(data.name === "exp_year["+idNumber+"]"){
                    dataArray[idNumber].exp_year = data.value
                }
                if(data.name === "cvc["+idNumber+"]"){
                    dataArray[idNumber].cvc = data.value
                }
            });
            dataArray = dataArray.filter(function(v){return v !== ''});

            return dataArray;
        }

        $(function () {
            $('#frmPayment').validate({
                rules: {
                    'cardnumber[]': {
                        required: true,
                        maxlength: 19
                    },
                    'exp_month[]': {
                        required: true,
                    },
                    'exp_year[]': {
                        required: true,
                    },
                    'cvc[]': {
                        required: true,
                        maxlength: 4
                    }
                }, errorPlacement: function () {
                    // console.log('Error in validation for static fields');
                    return false;
                }
            });
        })
    });

</script>
</body>
</html>