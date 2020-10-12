<!doctype html>
<html>
<head>
<title>My Lessons - <?= $site_settings->site_name?></title>
    <?php $this->load->view('includes/site-master'); ?>
</head>
<body id="home-page">
<?php $this->load->view('includes/header'); ?>


<section id="dash">
    <div class="contain-fluid">
        <div class="lBar ease">
            <?php $this->load->view('includes/sidebar'); ?>
        </div>
        <div id="myLeson" class="inSide">
            <div class="blk">
                <div class="_header">
                    <h3>My Lessons</h3>
                    <ul class="nav nav-tabs semi">
                        <li class="active"><a data-toggle="tab" href="#Upcoming">Upcoming</a></li>
                        <li><a data-toggle="tab" href="#Previous">Previous</a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div id="Upcoming" class="tab-pane fade active in">
                        <ul class="blockLst">
                        </ul>
                    </div>
                    <div id="Previous" class="tab-pane fade">
                        <ul class="blockLst">
                        </ul>
                    </div>
                </div>
                <div class="appLoad"><div class="appLoader"><span class="spiner"></span></div></div>
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
    var pre_lessons = '';
    $(function(){
        var hash = window.location.hash;
        hash && $('.nav.nav-tabs li a[href="' + hash + '"]').tab('show');
        get_lessons();
        $('.nav.nav-tabs li a').click(function(e) {
            $(this).tab('show');
            var scrollmem = $('body').scrollTop();
            window.location.hash = this.hash;
            $('html,body').scrollTop(scrollmem);
            hash=this.hash;
            get_lessons()
        });
        function get_lessons(){
            store=hash.replace('#', '');
            if (store==''){
                hash='#Upcoming';
                store='Upcoming';
            }
            $(hash+' ul.blockLst').html('');
            $('.appLoad').fadeIn('fast');

            $.ajax({
                url: base_url+'my-lessons',
                data : {'store':store},
                dataType: 'JSON',
                method: 'POST',
                success: function(res){
                    if(res.found){
                        reached=res.reached;
                        load=res.load;
                        pre_lessons = res.items;
                        $(hash+' ul.blockLst').html(res.items);
                    }
                },
                error: function(res){
                    console.log(res);
                },
                complete: function(res){
                    setTimeout(function(){
                        $('.appLoad').hide();
                        $(hash+' ul.blockLst>li').removeClass('hidden');
                    },1500)
                }
            })
        }
        ajaxSearch=false;
        var load=1;
        var reached=false;
        $(window).scroll(function() {   
            if($(window).scrollTop() + $(window).height() >= $(document).height()-10) {
                if(reached)
                    return;
                $('.appLoad').fadeIn();
                $.ajax({
                    url: base_url+'my-lessons',
                    data : {'store':store,'load':load},
                    dataType: 'JSON',
                    method: 'POST',
                    success: function(res){
                        if(res.found){
                            reached=res.reached;
                            load=res.load;
                            $(hash+' ul.blockLst').append(res.items);
                        }
                    },
                    error: function(rs){
                        console.log(rs);
                    },
                    complete: function(res){
                        setTimeout(function(){
                            $('.appLoad').hide();
                            $(hash+' ul.blockLst>li').removeClass('hidden');
                        },1500)
                    }
                })
            }
        });
        function scan_lessons(){
            store=hash.replace('#', '');
            if (store==''){
                hash='#Upcoming';
                store='Upcoming';
            }
           
            $.ajax({
                url: base_url+'my-lessons',
                data : {'store':store},
                dataType: 'JSON',
                method: 'POST',
                success: function(res){
                    if(res.found){
                        reached=res.reached;
                        load=res.load;
                        if(res.items != pre_lessons){
                            $(hash+' ul.blockLst').html(res.items);
                            $(hash+' ul.blockLst>li').removeClass('hidden');
                        }
                        pre_lessons = res.items;
                    }
                },
                error: function(res){
                    console.log(res);
                },
                complete: function(res){
                   
                }
            })
        }
        setInterval(function(){ scan_lessons(); }, 3000);
        $(document).on('click','a.view-detail',function(e){
            e.preventDefault();
            if(ajaxSearch)
                return;
            var btn=$(this);
            var store=btn.data('store');
            if (store=='')
                return false;
            needToConfirm = true;
            $.ajax({
                url: base_url+'lesson-detail',
                data : {'store':store},
                dataType: 'JSON',
                method: 'POST',
                success: function (rs) {
                    if(rs.status===1){
                        btn.find('span').remove();
                        $('body').addClass('flow');
                        var detail_popup=$(".popup[data-popup='view-detail']");
                        detail_popup.find('._inner').html(rs.data);
                        refresh_rateYo();
                        refresh_timepicker();
                        refresh_datepicker();
                        detail_popup.fadeIn();
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
        $(document).on('click','a.mActn-btn',function(e){
            e.preventDefault();
            if(ajaxSearch)
                    return;
            var btn=$(this);
            var store=btn.data('store');
            var link=btn.data('link');
            if (store=='' || link=='')
                return false;
            if (btn.data("disabled"))
                    return false;
            needToConfirm = true;

            btn.attr("disabled", true);
            btn.find("i.fa-spinner").removeClass('hidden');

            $.ajax({
                url: base_url+'/'+link,
                data : {'store':store},
                dataType: 'JSON',
                method: 'POST',
                success: function (rs) {
                    if(rs.status===1){
                        setTimeout(function(){
                            var detail_popup=$(".popup[data-popup='view-detail']");
                            detail_popup.find('._inner').html(rs.data);
                            $('.TotalPrice').text('After Discount: '+rs.discount);
                            refresh_rateYo();
                            refresh_timepicker();
                            refresh_datepicker();
                        },1000)
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
        <?php if($this->session->mem_type=='student'):?>
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