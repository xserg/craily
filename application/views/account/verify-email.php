<!doctype html>
<html>
<head>
    <title><?= $site_content['everify_heading']?> - <?=$site_settings->site_name?></title>
    <?php $this->load->view('includes/site-master'); ?>
</head>
<body id="home-page">
    <?php $this->load->view('includes/header'); ?>


    <section id="dash">
        <div class="contain">
            <div id="verifyEmail">
                <div class="blk">
                    <div class="_header">
                        <h3><?= $site_content['everify_heading']?></h3>
                    </div>
                    <div id="resndCntnt">
                        <?= showMsg()?>
                        <p><?= $site_content['everify_detail']?></p>
                        <p>
                            <a href="javascript:void(0)" id="rsnd-email">Resend Email</a> OR 
                            <a href="javascript:void(0)" class="popBtn" data-popup="change-email">Change Email</a>
                        </p>
                    </div>
                    <div class="appLoad hide">
                        <div class="appLoader"><span class="spiner"></span></div>
                    </div>
                </div>
                <div class="popup small-popup" data-popup="change-email">
                    <div class="tableDv">
                        <div class="tableCell">
                            <div class="contain">
                                <div class="_inner">
                                    <div class="crosBtn"></div>
                                    <h3>Change your Email</h3>
                                    <form action="" method="post" autocomplete="off" class="frmAjax" id="frmChangeEmail">
                                        <div class="txtGrp">
                                            <input type="email" id="email" name="email" class="txtBox" placeholder="Email"autofocus>
                                        </div>
                                        <div class="bTn text-center">
                                            <button type="submit" class="webBtn colorBtn lgBtn">Change your Email <i class="fa fa-spinner fa-pulse fa-1x fa-fw hidden"></i></button>
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
    </section>
    <!-- dash -->


    <?php $this->load->view('includes/footer');?>
    <script type="text/javascript">
        $(function (){
            $(document).on('click','#rsnd-email',function(e){
                e.preventDefault();

                var btn=$(this);
                if (btn.data("disabled"))
                    return false;
                $("#resndCntnt").addClass('hide');
                $('.appLoad').removeClass('hide');

                btn.data("disabled", "disabled");
                $.ajax({
                    url: base_url+'resend-email',
                    data : {'cmd':'resend'},
                    dataType: 'JSON',
                    method: 'POST',
                    success: function (rs) {
                        $('#resndCntnt').find('.alertMsg').remove().end().append(rs.msg);
                    },
                    complete: function(){
                        btn.removeData("disabled");
                        setTimeout(function(){
                            $('.appLoad').addClass('hide');
                            $('#resndCntnt').removeClass('hide');
                        },3000)
                    }
                })
            })
        })
    </script>
</body>
</html>