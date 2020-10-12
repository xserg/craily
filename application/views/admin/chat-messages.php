<!-- messages -->
<section id="messages">
    <div class="ouTer relative clearfix">
        <div class="inNer rSide">
            <div class="chatBlk relative clearfix">
                <div class="chatPerson relative">
                    <h3><i class="fa fa-envelope"></i> Messages</h3>
                    
                    <div class="ticketId">Between<span><?= ucwords($mem_one->mem_fname.' '.$mem_one->mem_lname)?> <i class="fa fa-exchange"></i> <?= ucwords($mem_two->mem_fname.' '.$mem_two->mem_lname)?></span></div>
                </div>
                <div class="chat  active">
                    <?php foreach ($messages as  $msg): ?>
                        <?php if($msg->msg_type=='lesson'):?>
                            <?= $msg->lesson->txt?>
                            <?php continue?>
                        <?php endif?>
                        <?php if($msg->sender_id==$mem_one->mem_id):?>
                            <div class="buble you">
                                <div class="icoBlk">
                                    <div class="ico">
                                        <img src="<?=get_image_src($mem_one->mem_image,50); ?>" alt="">
                                    </div>
                                    <div class="tip"><?= ucwords($mem_one->mem_fname.' '.$mem_one->mem_lname)?></div>
                                </div>
                                <div class="cntnt">
                                    <?=nl2br($msg->msg)?>
                                    <?php foreach($msg->attachments as $index=> $attch):?>
                                        <?php if($index==0 && $msg->msg!=''):?>
                                            <br>
                                        <?php endif?>
                                        <a href="<?=SITE_VPATH.'attachments/'.$attch->attachment?>" target="_blank"><?=$attch->att_name?></a>
                                    <?php endforeach?>
                                    <div class="tip"><?=format_date($msg->time,'F d,Y h:i a')?></div>
                                </div>
                            </div>
                        <?php else:?>
                            <div class="buble me">
                                <div class="icoBlk">
                                    <div class="ico">
                                        <img src="<?=get_image_src($mem_two->mem_image,50); ?>" alt="">
                                    </div>
                                    <div class="tip"><?= ucwords($mem_two->mem_fname.' '.$mem_two->mem_lname)?></div>
                                </div>
                                <div class="cntnt">
                                    <?=nl2br($msg->msg)?>
                                    <?php foreach($msg->attachments as $index=> $attch):?>
                                        <?php if($index==0 && $msg->msg!=''):?>
                                            <br>
                                        <?php endif?>
                                        <a href="<?=SITE_VPATH.'attachments/'.$attch->attachment?>" target="_blank"><?=$attch->att_name?></a>
                                    <?php endforeach?>
                                    <div class="tip"><?=format_date($msg->time,'F d,Y h:i a')?></div>
                                </div>
                            </div>
                        <?php endif?>
                    <?php endforeach?>
                </div>
            </div>
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
</section><!-- messages -->
<script type="text/javascript">
    (function($){
        $(function(){
            $('.chat').scrollTop($('.chat').prop("scrollHeight"));

            $(document).on('click','a.view-detail',function(e){
                e.preventDefault()
                needToConfirm = true;
                var btn=$(this);
                var rdStore=btn.data('store');
                if (rdStore=='')
                    return false;

                $.ajax({
                    url: base_url+'get-admin-request-detail',
                    data : {'store':rdStore},
                    dataType: 'JSON',
                    method: 'POST',
                    success: function (rs) {
                        if(rs.status===1){
                            $('body').addClass('flow');
                            var detail_popup=$(".popup[data-popup='view-detail']");
                            detail_popup.find('._inner').html(rs.data);
                            detail_popup.fadeIn();
                        }
                        else
                            alert('Something went wrong!')
                    },
                    error: function(rs){
                        console.log(rs);
                    },
                    complete: function (rs) {
                        needToConfirm = false;
                    }
                })
            })
        })
        $(document).on('click', '.popup', function(e) {
            if ($(e.target).closest('.popup ._inner, .popup .inside').length === 0) {
                $('.popup').fadeOut('3000');
                $('body').removeClass('flow');
            }
        });
        $(document).on('click', '.crosBtn', function() {
            $('.popup').fadeOut();
            $('body').removeClass('flow');
        });
        $(document).keydown(function(e) {
            if (e.keyCode == 27) $('.crosBtn').click();
        });

    }(jQuery))
</script>