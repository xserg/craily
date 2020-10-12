<!doctype html>
<html>
<head>
    <title><?= $site_content['pverify_heading']?>Phone Verification - <?=$site_settings->site_name?></title>
    <?php $this->load->view('includes/site-master'); ?>
</head>
<body id="home-page">
    <?php $this->load->view('includes/header'); ?>


    <section id="dash">
        <div class="contain">
            <div id="verifyEmail">
                <div class="blk">
                    <div class="_header">
                        <h3><?= $site_content['pverify_heading']?></h3>
                    </div>
                    <div id="resndCntnt">
                        <p>Your Phone Number is <strong class="color"><?= $mem_data->mem_phone?></strong></p>
                        <p><?= $site_content['pverify_detail']?></p>
                        <p>
                            <a href="javascript:void(0)" class="vrfPhn">Verify Phone</a>
                            OR
                            <a href="javascript:void(0)" class="popBtn" data-popup="change-phone">Change Phone</a>
                        </p>
                    </div>
                    <div class="appLoad hide">
                        <div class="appLoader"><span class="spiner"></span></div>
                    </div>
                    <div class="popup small-popup" data-popup="change-phone">
                        <div class="tableDv">
                            <div class="tableCell">
                                <div class="contain">
                                    <div class="_inner">
                                        <div class="crosBtn"></div>
                                        <h3>Change your Phone number</h3>
                                        <form action="<?= site_url('change-phone')?>" method="post" autocomplete="off" class="frmAjax" id="frmPhone">
                                            <div class="txtGrp">
                                                <input type="text" name="phone" id="phone" class="txtBox" value="<?= $mem_data->mem_phone?$mem_data->mem_phone:''?>" placeholder="Phone"autofocus>
                                                <div class="invald hide" id="phnMsg"></div>
                                            </div>
                                            <div class="bTn text-center">
                                                <button type="submit" class="webBtn colorBtn lgBtn">Change your Phone <i class="fa fa-spinner fa-pulse fa-1x fa-fw hidden"></i></button>
                                            </div>
                                            <div class="alertMsg" style="display:none"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="popup small-popup" data-popup="verify-phone">
                        <div class="tableDv">
                            <div class="tableCell">
                                <div class="contain">
                                    <div class="_inner">
                                        <div class="crosBtn"></div>
                                        <h3>Please verify your phone number</h3>
                                        <p class="text-center">Enter 6 digit verification code to confirm you got the text message</p>
                                        <form action="" method="post" autocomplete="off" class="frmAjax" id="frmPhonevld">
                                            <div class="txtGrp">
                                                <ul class="phoneLst">
                                                    <?php for($i=0;$i<6;$i++):?> 
                                                        <li>
                                                            <input type="text" name="code[<?=$i?>]" maxlength="1" class="txtBox arrFld" placeholder="">
                                                        </li>
                                                    <?php endfor?>
                                                </ul>
                                                <div class="text-center showCode" style="display: none"><a href="javascript:void(0)" class="color">Didn't get a code?</a></div>
                                            </div>
                                            <div class="bTn text-center">
                                                <button type="submit" class="webBtn colorBtn">Verify <i class="fa fa-spinner fa-pulse fa-1x fa-fw hidden"></i></button>
                                            </div>
                                            <div class="alertMsg" style="display:none"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- dash -->


    <?php $this->load->view('includes/footer');?>
    <script type="text/javascript">
    $(function(){
        $(document).on('input','input[name^=code]:last',function(e){
            $(this).parents('form#frmPhonevld').submit()
        })
        $(document).on('click','div.showCode>a',function(e){
            e.preventDefault();
            $('.crosBtn').click();
            $('#phone').focus();
            $(this).slideUp();
        })
        $(document).on('click','a.vrfPhn',function(e){
            e.preventDefault()
            if(confirm("To make sure that <?= $mem_data->mem_phone?> is yours, Crainly is going to send you a text message with a 6-digit verification code.")){

                $.ajax({
                    url: base_url+'verify-phone-code',
                    data : {'cmd':'send-code'},
                    dataType: 'JSON',
                    method: 'POST',
                    success: function (rs) {
                        if(rs.status===1){
                            $('body').addClass('flow');
                            $(".popup[data-popup='verify-phone']").fadeIn().find('input:first').focus().end().find('form').get(0).reset();
                            setTimeout(function(){
                                $('#frmPhonevld div.showCode').slideDown();
                            },60000)
                        }
                        else
                            alert('Something went wrong!')
                    },
                    error: function(rs){
                        console.log(rs);
                    },
                    complete: function(){}
                })
            }
        })
    })
</script>
</body>
</html>