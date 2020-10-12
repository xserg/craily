<!doctype html>
<html>
<head>
<title>Jobs - <?= $site_settings->site_name?></title>
<?php $this->load->view('includes/site-master'); ?>
</head>
<body id="home-page">
<?php $this->load->view('includes/header'); ?>

<main>
<section id="dash">
    <div class="contain-fluid">
        <div class="lBar ease">
            <?php $this->load->view('includes/sidebar'); ?>
        </div>
        <div id="myRqst" class="inSide">
            <div class="blk">
                <div class="_header">
                    <h3>My Jobs</h3>
                    <button type="button" class="webBtn crtjb">Create A Job</button>
                </div>
                <ul class="blockLst _job_list _myJobBoard">
                </ul>
                <div class="appLoad"><div class="appLoader"><span class="spiner"></span></div></div>
            </div>
            <div class="popup" data-popup="add-job">
                <div class="tableDv">
                    <div class="tableCell">
                        <div class="contain">
                            <div class="_inner">
                                <div class="crosBtn"></div>
                                <h3>Create A Job</h3>
                                <form action="add-new-job" method="post" autocomplete="off" class="frmAjax">
                                    <div class="row formRow">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xx-12 txtGrp">
                                            <input type="text" name="title" id="title" class="txtBox" placeholder="Title" autofocus="" required="">
                                        </div>
                                        <!-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xx-4 txtGrp">
                                            <input type="number" min="0" name="budget" id="budget" class="txtBox" placeholder="budget" required="">
                                        </div> -->
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                            <input type="text" name="subject" id="subject" class="txtBox" placeholder="Subject" required="">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                            <select name="grade_level" id="grade_level" class="txtBox selectpicker" data-live-search="true">
                                                <option value="">Your Grade Level</option>
                                                <?php foreach ($grade_levels as $key => $grade_level): ?>
                                                    <option value="<?= $grade_level->name?>"><?= $grade_level->name?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xx-4 txtGrp">
                                            <input type="text" name="city" id="city" class="txtBox" placeholder="City" required="">
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xx-4 txtGrp">
                                            <input type="text" name="state" id="state" class="txtBox" placeholder="State" required="">
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xx-4 txtGrp">
                                            <input type="text" name="zip" id="zip" class="txtBox" placeholder="ZipCode" required="">
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xx-12 txtGrp">
                                            <textarea id="detail" name="detail" class="txtBox" placeholder="Add additional details" required=""></textarea>
                                        </div>
                                    </div>
                                    <div class="bTn text-center">
                                        <button type="submit" class="webBtn colorBtn">Submit<i class="fa-spinner hidden"></i></button>
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
</main>
<!-- dash -->


<?php $this->load->view('includes/footer');?>
<script type="text/javascript">
    $(function(){
        var ajaxSearch = false;
        var load=0;
        var reached=false;
        function get_lessons(){
            if(ajaxSearch)
                return;
            ajaxSearch=true;
            $('ul.blockLst').html('');
            $('.appLoad').fadeIn('fast');
            load=0;

            $.ajax({
                url: base_url+'my-jobs',
                data : {'load':load},
                dataType: 'JSON',
                method: 'POST',
                success: function(res){
                    if(res.found){
                        reached=res.reached;
                        load=res.load;
                        $('ul.blockLst').html(res.items);
                    }
                },
                error: function(res){
                    console.log(res);
                },
                complete: function(res){
                    setTimeout(function(){
                        $('.appLoad').hide();
                        $('ul.blockLst>li').removeClass('hidden');
                        ajaxSearch=false;
                    },1500)
                }
            })
        }
        get_lessons();
        $(window).scroll(function() {   
            if($(window).scrollTop() + $(window).height() >= $(document).height()-10) {
                if(reached)
                    return;
                if(ajaxSearch)
                    return;
                ajaxSearch=true;
                $('.appLoad').fadeIn();
                $.ajax({
                    url: base_url+'my-jobs',
                    data : {'load':load},
                    dataType: 'JSON',
                    method: 'POST',
                    success: function(res){
                        if(res.found){
                            reached=res.reached;
                            load=res.load;
                            $('ul.blockLst').append(res.items);
                        }
                    },
                    error: function(rs){
                        console.log(rs);
                    },
                    complete: function(res){
                        setTimeout(function(){
                            $('.appLoad').hide();
                            $('ul.blockLst>li').removeClass('hidden');
                            ajaxSearch=false;
                        },1500)
                    }
                })
            }
        });

        $(document).on('click','a.dltBtn',function(e){
            e.preventDefault();
            if(!confirm("Delete ?"))
                return false;
            var btn=$(this);
            var store=btn.data('store');
            if (store=='')
                return false;
            if (btn.data("disabled"))
                    return false;
            if(ajaxSearch)
                    return;
            ajaxSearch = true;
            needToConfirm = true;
            btn.attr("disabled", true);

            $.ajax({
                url: base_url+'/delete-job',
                data : {'store':store},
                dataType: 'JSON',
                method: 'POST',
                success: function (rs) {
                    if(rs.status===1){
                        btn.parents('li').remove();
                        setTimeout(function(){
                            get_lessons();
                        },100)
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
                    btn.attr("disabled", false);
                }
            })
        })

        $(document).on('click', 'a.edtBtn', function(e) {
            e.preventDefault();
            var btn=$(this);
            var store=$(this).data('store');
            var frm=$('div[data-popup="add-job"] form.frmAjax');
            $('div[data-popup="add-job"] h3').text('Edit Job');
            frm.find('input[type="hidden"]').remove();
            frm.find('div.alertMsg').html('');
            ajaxSearch = true;
            needToConfirm = true;
            btn.attr("disabled", true);
            $.ajax({
                url: base_url+'/get-job',
                data : {'store':store},
                dataType: 'JSON',
                method: 'POST',
                success: function (rs) {
                    if((typeof rs !== 'undefined') && rs){
                        frm.attr("action",'edit-job');
                        frm.append('<input type="hidden" name="store" value="'+store+'">');
                        frm.find('input#title').val(rs.title);
                        // frm.find('input#budget').val(rs.budget);
                        frm.find('input#subject').val(rs.subject);
                        frm.find('select#grade_level').val(rs.grade_level).trigger('change');
                        frm.find('input#city').val(rs.city);
                        frm.find('input#state').val(rs.state);
                        frm.find('input#zip').val(rs.zip);
                        frm.find('textarea#detail').val(rs.detail);
                        $('body').addClass('flow');
                        $('.popup[data-popup= "add-job"]').fadeIn().find('input:first').focus();
                        refresh_selectpicker();
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
                    btn.attr("disabled", false);
                }
            })
        });
        $(document).on('click', '.crtjb', function(){
            $('body').addClass('flow');
            $('div[data-popup="add-job"] h3');
            $('select#grade_level').val("").trigger('change');
            refresh_selectpicker();
            $('.popup[data-popup= "add-job"]').fadeIn().find('h3').text('Create A Job').end().find('input:first').focus().end().find('form').attr('action','add-new-job').find('div.alertMsg').html('').end().end().find('form').get(0).reset();
        });
    });
</script>
</body>
</html>