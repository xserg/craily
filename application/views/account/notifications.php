<!doctype html>
<html>
<head>
    <title>Notifications - <?= $site_settings->site_name?></title>
    <?php $this->load->view('includes/site-master'); ?>
</head>
<body id="home-page">
    <?php $this->load->view('includes/header'); ?>


    <section id="dash">
        <div class="contain-fluid">
            <div class="lBar ease">
                <?php $this->load->view('includes/sidebar'); ?>
            </div>
            <div id="notification" class="inSide">
                <div class="blk">
                    <div class="_header">
                        <h3>Notifications</h3>
                    </div>
                    <div class="content">
                        <div class="notiBlk">
                            <?php if(count($rows)<1):?>
                                <div class="semi color">
                                    No new notification
                                </div>
                            <?php endif?>
                            <?php foreach ($rows as $key => $row) :?>
                                <div class="inner">
                                    <?php if ($row->mem_type=='student'): ?>
                                        <div class="ico"><img src="<?= get_image_src($row->mem_image,50,true)?>" alt=""></div>
                                    <?php else: ?>
                                        <div class="ico"><a href="<?= profile_url($row->from_id,$row->mem_name)?>"><img src="<?= get_image_src($row->mem_image,50,true)?>" alt=""></a></div>
                                    <?php endif ?>
                                    <div class="cntnt" data-store="<?= $row->encoded_id?>">
                                        <p><?=$row->txt ?></p>
                                        <!-- <p><strong><?= $row->mem_name?></strong> <?=$row->txt ?></p> -->
                                        <span class="time"><?=time_ago($row->date) ?></span>
                                    </div>
                                </div>
                            <?php endforeach?>
                        </div>
                        <?= $links ?>
                    </div>
                </div>
                <div class="popup detail-pupup" data-popup="view-detail">
                    <div class="tableDv">
                        <div class="tableCell">
                            <div class="contain">
                                <div class="_inner">
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
        <?php if(!empty($noti)):?>
            setTimeout(function(){
                var ntShw='<?= $noti?>';
                $('.notiBlk .cntnt[data-store="'+ntShw+'"]>p> a').trigger('click');
            },500)
        <?php endif?>
        var ajaxSearch = false;
        $(document).on('click','a.view-detail',function(e){
            e.preventDefault()
            if(ajaxSearch)
                return;

            var btn=$(this);
            var store=btn.data('store');
            var link=btn.data('link');

            var image = btn.data('image');
            var name = btn.data('name');
            var mem_id = btn.data('mem');

            if (store=='' || link=='')
                return false;
            needToConfirm = true;

            $.ajax({
                url: base_url+''+link,
                data : {'store':store, 'image': image, 'name': name, 'mem_id': mem_id},
                dataType: 'JSON',
                method: 'POST',
                success: function (rs) {
                    if(rs.status===1){
                        btn.find('span').remove();
                        $('#lsn-detail').html('flow');
                        $('body').addClass('flow');
                        var detail_popup=$(".popup[data-popup='view-detail']");
                        detail_popup.find('._inner').html(rs.data);
                        refresh_rateYo();
                        refresh_selectpicker();
                        detail_popup.fadeIn();
                    }
                    else
                        alert('Something went wrong!')
                },
                error: function(rs){
                    console.log(rs);
                },
                complete: function (rs) {
                    ajaxSearch = false;
                    needToConfirm = false;
                }
            })
        })
        <?php if ($this->session->mem_type=='tutor'):?>
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
                        setTimeout(function(){
                            btn.parents('div.bTn').after(rs.data);
                            btn.parents('div.bTn').remove();
                        },1000)
                    }
                    else
                        alert('Something went wrong!')
                },
                error: function(rs){
                    console.log(rs);
                },
                complete: function (rs) {
                    ajaxSearch = false;
                    needToConfirm = false;
                }
            })
        })
        <?php endif?>
        <?php if ($this->session->mem_type=='student'):?>
        $(document).on('click', 'div[data-popup="view-detail"] .bkNow', function(e){
            e.preventDefault()
            if(ajaxSearch)
                return;

            var btn=$(this);
            var payment_method=$('#payment_method').val();
            var promocode=$('#promocode').val();
            var store=btn.data('store');
            if (store=='' || payment_method=='' || payment_method==null)
                return false;
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
                    setTimeout(function(){
                        if(rs.status===1){
                            btn.parents('div._inner').append(rs.data);
                            btn.parents('.svdCards').remove();
                            $('div[data-popup="view-detail"] .alertMsg:first, div[data-popup="view-detail"] form').remove();
                        }
                        else{
                            $('div[data-popup="view-detail"] .alertMsg:first').html(rs.msg)
                            btn.attr("disabled", false);
                            btn.find("i.fa-spinner").addClass('hidden');
                        }
                    },1000)
                },
                error: function(rs){
                    console.log(rs);
                },
                complete: function (rs) {
                    ajaxSearch = false;
                    needToConfirm = false;
                }
            })
        })
        $(document).on('click', '.apply_button', function(e){
        	e.preventDefault();
        	var promocode = $('#promocode').val();
        	var btn=$(this);
        	btn.find("i.fa-spinner").removeClass('hidden');
        	var store = $('#encoded_id').val();
        	var total_num = $('#total_sum').val();

        	$.ajax({
                url: base_url+'/check_coupon',
                data : {'store':store, 'promocode':promocode, 'total_num':total_num},
                dataType: 'JSON',
                method: 'POST',
                success: function (rs) {
                	if(rs.status===1){
                		$('.pre_promo_code').hide();
                		$('.promo_coded').show();
                		$('.promo_code').hide();
                       	$('.applied_promo_view').text(rs.promo_code_discount);
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
            $(document).on("rateyo.set",'#rating',function(e, data){
                var rating=data.rating;
                $('input[name="rating"]').val(rating);
            });
        <?php endif?>
        $(document).on('reset', 'div[data-popup="view-detail"] form.frmAjax', function(e){
            var pupUpCBtn=$(this).parents('._inner').find('.crosBtn');
            setTimeout(function(){
                pupUpCBtn.trigger('click');
            },500)
        })

    });
</script>
</body>
</html>