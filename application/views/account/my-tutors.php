<!doctype html>
<html>
<head>
    <title>My Tutors - <?= $site_settings->site_name?></title>
    <?php $this->load->view('includes/site-master'); ?>
</head>
<body id="home-page">
    <?php $this->load->view('includes/header'); ?>


    <section id="dash">
        <div class="contain-fluid">
            <div class="lBar ease">
                <?php $this->load->view('includes/sidebar'); ?>
            </div>
            <div id="myRqst" class="inSide">
                <div class="blk">
                    <div class="_header">
                        <h3>My Tutors</h3>
                    </div>
                    <ul class="blockLst">
                        <?php if (count($rows)<1): ?>
                            <li>
                                <div class="semi color">No tutor available</div>
                            </li>
                        <?php endif ?>
                        <?php foreach ($rows as $key => $row): ?>
                            <li>
                                <div class="icoBlk">
                                    <div class="ico"><img src="<?= get_image_src($row->mem_image,50,true)?>"></div>
                                    <div class="name"><?= $row->mem_name?></div>
                                </div>
                                <div class="subject"><strong>Total Lessons:</strong> <?= total_tutor_lessons($row->tutor_id,$this->session->mem_id)?></div>
                                <div class="bTn"><a href="<?= profile_url($row->tutor_id,$row->mem_name)?>" class="webBtn smBtn">View Profile</a></div>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- dash -->


    <?php $this->load->view('includes/footer');?>
    <script type="text/javascript">
        $(function(){
            $(document).on('click','button.view-detail',function(e){
                e.preventDefault()
                var store=$(this).data('store');
                if (store=='')
                    return false;

                $.ajax({
                    url: base_url+'get-request-detail',
                    data : {'store':store},
                    dataType: 'JSON',
                    method: 'POST',
                    success: function (rs) {
                        console.log(rs);
                        if(rs.status===1){
                            $('#lsn-detail').html('flow');
                            $('body').addClass('flow');
                            // $(".popup[data-popup='lesson-request-detail']").fadeIn();
                            var detail_popup=$(".popup[data-popup='view-detail']");
                            detail_popup.fadeIn();
                            detail_popup.find().html(rs.data);
                        }
                        else
                            alert('Something went wrong!')
                    },
                    error: function(rs){
                        console.log(rs);
                    },
                    complete: function(){}
                })
            })
        })
    </script>
</body>
</html>