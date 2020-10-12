<!doctype html>
<html>
<head>
    <title>Profile - <?=$site_settings->site_name?></title>
    <?php $this->load->view('includes/site-master'); ?>
</head>
<body id="home-page">
<?php $this->load->view('includes/header'); ?>

<section id="profile">
    <div class="contain">
        <div class="flexRow flex clearfix">
            <div class="col col1">
                <div class="blk dpBlk p-0">
                    <div class="tutor-profile-sec bg-white">
                        <div class="tutor-content">
                            <div class="tutor-thumb">
                               
                                <img src="<?= get_image_src($row->mem_image,300,true)?>" alt="">
                            </div>
                            <div class="tutor-detail">
                                <h3 class="tutor-name"><?= format_name($row->mem_fname,$row->mem_lname)?></h3>
                                <div class="rating">
                                    <div class="rateYo" data-rateyo-rating="<?= get_avg_mem_rating($row->mem_id)?>" data-rateyo-read-only="true"></div>
                                    <strong><?= get_avg_mem_rating($row->mem_id)?><span class="review-count">(<?= $review_count?> ratings)</span></strong>
                                </div>
                            </div>
                        </div>
                        <p class="tutor-dec"><?php echo $row->mem_profile_heading; ?></p>
                    </div>
                    <div class="side-bar-menu">
                        <ul>
                            <li class="active"><a href="#tutor-bio-sec" class="checkHash">Bio</a></li>
                            <li><a href="#schedule-sec"  class="checkHash">Schedule</a></li>
                            <li><a href="#education-sec" class="checkHash">Education</a></li>
                             <li><a href="#work-experience-sec" class="checkHash">Experience</a></li>
                            <li><a href="#subject-sec" class="checkHash">Subjects</a></li>
                            <li><a href="#policies-sec" class="checkHash">Policies</a></li>
                            <li><a href="#review-sec" class="checkHash">Ratings</a></li>                            
                        </ul>
                    </div>
					
                    <div class="side-bar-bottom text-center">
                        <strong class="hour">$<?= $row->mem_hourly_rate?><sub>/hr</sub></strong>
                        
                        <?php $msg_url='login'?>
                        <?php $bk_lesson_url='login'?>
                        <?php $bk_back_check='login'?>
                        <?php if ($this->session->mem_type!='tutor'): ?>
                            <?php if ($mem_data->mem_status == 1):?>
                                <?php $msg_url='messages/'.$encoded_id?>
                                <?php $bk_lesson_url='book-lesson/'.$encoded_id?>
                                <?php $bk_back_check='purchase-back-check/'.$encoded_id.'/'.$row->mem_id ?>
                                <a href="<?= site_url($msg_url)?>" class="btn msg-now-btn">Message Now</a>
                                <a href="<?= site_url($bk_lesson_url)?>" class="btn book-now-btn">Book Now</a>
                                <p class="tutor-dec"><a href="#" class="purchase_back" encoded-id="<?= $encoded_id ?>" mem_id="<?= $row->mem_id ?>">Background Check</a></p>
                            <?php else:?>
                                <a href="#" class="btn msg-now-btn popBtn" data-popup="login-profile">Message Now</a>
                                <a href="#" class="btn book-now-btn popBtn" data-popup="login-profile">Book Now</a>
                                <p class="tutor-dec"><a href="#" class="popBtn background-check-purchase" data-popup="login-profile">Purchase Background Check</a></p>
                            <?php endif?>
                        <?php endif ?>

                    </div>
                    <div class="content">
                        
                        <!--<div class="btmBar">
                            <h2 class="proName"><a href="<?= profile_url($row->mem_id,$row->mem_fname.' '.$row->mem_lname)?>"><?= format_name($row->mem_fname,$row->mem_lname)?></a></h2>
                            <div class="hrRate price">$<?= $row->mem_hourly_rate?><small class="semi"> /hour</small></div>
                            <div class="rating"><div class="rateYo" data-rateyo-rating="<?= get_avg_mem_rating($row->mem_id)?>" data-rateyo-read-only="true"></div><strong>(<?= $review_count?> reviews)</strong></div>

                            <ul class="spanLst">
                                <?php $address = substr($row->mem_address1, 0, strrpos( $row->mem_address1, ','));
                                $address_arry= explode(",",$row->mem_address1);
                                $len = count($address_arry);
                                if($len >= 3) $address = $address_arry[$len-3].",".$address_arry[$len-2];
                                else $address = $row->mem_address1;
                                $address = $row->mem_city.($row->mem_state_id == ''?'':",".$row->mem_state_id);
                                ?>
                                <li><strong>Location</strong><span><?=$address ?></span></li>
                                <li><strong>School</strong><span><?= $row->mem_school_name?></span></li>
                                <li><strong>Graduation Year</strong><span><?= $row->mem_graduation_year?></span></li>
                                <li><strong>Major Subject</strong><span><?= $row->mem_major_subject?></span></li>
                                <li><strong>Total Lessons</strong><span><?= total_tutor_lessons($row->mem_id)?></span></li>
                                <li><strong>Travel Radius</strong><span> Within <?= $row->mem_travel_radius?> miles</span></li>
                                <?php if(!empty($tutorcheck) && $tutorcheck->status == 1 && $row->mem_verified == 1)
                                {
                                    ?>
                                    <li><strong>Background Check</strong><span><a class="check_status" style="color:  #008cd2" href="javascript:void(0)" encoded-id="<?= $encoded_id ?>" mem_id="<?= $row->mem_id ?>">Passed <?php echo format_date($tutorcheck->date, 'm/d/Y'); ?></a></span></li>
                                <?php } if(!empty($tutorcheck) && $tutorcheck->status == 0)
                                { ?>
                                    <li><strong>Background Check</strong><span> <a class="check_status"  style="color:  #008cd2" href="javascript:void(0)"  encoded-id="<?= $encoded_id ?>" mem_id="<?= $row->mem_id ?>">Pending</a></span></li>
                                <?php } if(empty($tutorcheck))
                                { ?>
                                    <li><strong>Background Check</strong><span><a class="check_status"  style="color:  #008cd2" href="javascript:void(0)"  encoded-id="<?= $encoded_id ?>" mem_id="<?= $row->mem_id ?>"> Not Complete</a></span></li>
                                <?php } ?>
                            </ul>

                            <ul class="btnLst">
                                <?php $msg_url='login'?>
                                <?php $bk_lesson_url='login'?>
                                <?php $bk_back_check='login'?>

                                <?php if ($this->session->mem_type!='tutor'): ?>
                                    <?php if ($mem_data->mem_status == 1):?>
                                        <?php $msg_url='messages/'.$encoded_id?>
                                        <?php $bk_lesson_url='book-lesson/'.$encoded_id?>
                                        <?php $bk_back_check='purchase-back-check/'.$encoded_id.'/'.$row->mem_id ?>
                                        <li><a href="<?= site_url($msg_url)?>" class="webBtn">Message Now</a></li>
                                        <li><a href="<?= site_url($bk_lesson_url)?>" class="webBtn colorBtn">Book Lesson</a></li>
                                        <li><a href="#" class="webBtn purchase_back" encoded-id="<?= $encoded_id ?>" mem_id="<?= $row->mem_id ?>">Background Check</a></li>
                                    <?php else:?>
                                        <li class=""><a href="#" class="webBtn popBtn" data-popup="login-profile">Message Now</a></li>
                                        <li class=""><a href="#" class="webBtn colorBtn popBtn" data-popup="login-profile">Book Lesson</a></li>
                                        <li class=""><a href="#" class="webBtn popBtn" data-popup="login-profile">Purchase Background Check</a></li>
                                    <?php endif?>

                                <?php endif ?>
                            </ul>
                        </div>-->


                    </div>
                </div>
                <!-- <div class="blk">
                    <div class="_header">
                        <h3>Subjects</h3>
                    </div>
                    <div class="content">
                        <ul class="subjectLst flex">
                            <?php

                            $subjects = json_decode($subjects);

                            if(!empty($subjects)){
                                foreach ($subjects as $key => $value){
                                    if(!empty($value)) {
                                        ?>
                                        <li>
                                            <strong>
                                                <?php echo $key; ?>
                                            </strong>
                                            <?php
                                            print_r(str_replace('_', ' ', implode(", ",$value)));
                                            ?>
                                        </li>

                                        <?php
                                    }
                                }
                            } else {
                                ?>
                                <li>No subject</li>
                            <?php } ?>
                        </ul>
                    </div>
                </div> -->
            </div>
            <div class="popup login-popup" data-popup="login-profile">
                <div class="tableDv">
                    <div class="tableCell">
                        <?php if($page=="signup" || $page =="tutor-signup") { ?>
                        <div class="contain PlusClass">
                            <?php } else { ?>
                            <div class="contain">
                                <?php } ?>
                                <div class="logBlk _inner">
                                    <div class="crosBtn"></div>
                                    <form action="<?= site_url('login')?>" method="post" autocomplete="off" class="frmAjax" id="frmLogin">
                                        <h2>Log in</h2>
                                        <div class="haveAccount text-center"> <span>Don’t have an account?</span>
                                            <a href="<?= site_url('signup')?>">Sign up for free</a>
                                        </div>
                                        <div class="txtGrp">
                                            <label for="email">Email</label>
                                            <input type="email" id="email" name="email" class="txtBox" placeholder="" autofocus>
                                        </div>
                                        <div class="txtGrp">
                                            <label for="password">Password</label>
                                            <input type="password" id="password" name="password" class="txtBox" placeholder="">
                                        </div>
                                        <div class="login-popup-btn">
                                            <div class="bTn text-center">
                                                <button type="submit" class="webBtn colorBtn lgBtn" style="width:100%!important">LOG IN <i class="fa fa-spinner fa-pulse fa-1x fa-fw hidden"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="rememberMe">
                                            <!-- <div class="lblBtn pull-left">
                                            <input type="checkbox" name="remeberMe" id="rememberMe">
                                            <label for="rememberMe">Remember me</label>
                                            </div> -->
                                            <a href="<?= site_url('forgot-password')?>" id="pass" class="pull-right" style="margin-top:12px; text-align:right">Forgot name or password ?</a>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="alertMsg" style="display:none"></div>
                                    </form>
                                </div>
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
                <div class="col col2">
                    <div id="tutor-bio-sec" class="blk introBlk bg-white tutor-bio-sec mb-0">
                        <div class="_header bg-white">
                            <h3><?= $row->mem_fname?>'s Bio</h3>
                        </div>
                        <div class="div-readmore" style="white-space: break-spaces; overflow:hidden"><?= $row->mem_about?></div>
                        <!-- <p class="tutor-bio">
                            Hey!
                        </p>
                        <p class="tutor-bio"> 
                            I'm Jonathan. The College Guy.
                        </p>
                        <p class="tutor-bio">
                            For almost 10 years now, I've been a leading test prep guru and essay specialist in sunny Southern California.
                        </p>
                        <p class="tutor-bio">
                             I'm the author of the legendary "College Guy" curriculum and the tutor of choice for students who are committed to hitting 1500+ on SAT or 34+ on ACT.
                        </p>
                        <p class="tutor-bio">
                            This is the first time I'm offering tutoring or materials online.
                        </p>
                        <p class="tutor-bio">
                            I've tutored on-set with some of America's brightest young on-screen talent, and, as "Hollywood's Tutor", I've presented on application essays and test strategy to parents and students all over the Los Angeles area.
                        </p>
                        <a href="#" class="font-16 read-more">Read More</a> -->
                    </div>
                    <div id="schedule-sec" class="blk mb-0 bg-white schedule-sec border-bottom">
                        <div class="_header bg-white mb-0">
                            <h3 class="section-head">Schedule</h3>
                        </div>
                        <div class="content" style="height:100%!important">
                            <?php if(count($tutor_timings)<1):?>
                                <p class="text-center">No Schedule set</p>
                            <?php endif?>
                            <?php if(count($tutor_timings)>=1):?>
                                <ul class="schdulLst flex">
                                    <?php foreach ($tutor_timings as $day_row): ?>
                                        <li><strong><?= $day_row->day?>:</strong><span> <?= $day_row->available==1?(($day_row->start_time=='')?'Anytime':get_meridian_time($day_row->start_time)).' - '.(($day_row->end_time=='')?'Anytime':get_meridian_time($day_row->end_time)):'UNAVAILABLE'?></span></li>
                                    <?php endforeach ?>
                                </ul>
                            <?php endif?>
                        </div>
                    </div>
                    <div id="education-sec" class="blk education-sec border-bottom mb-0">
                        <div class="_header bg-white mb-0">
                            <h3 class="section-head">Education</h3>
                        </div>
                        <ul class="education-list">
						<?php
						if($eduction):
						foreach($eduction as $edu):
						?>
                            <li>
                                <div class="education-thumb">
                                    <img src="../assets/images/education_cap.svg" />
                                </div>  
                                <div class="education-details">
                                    <h3 class="education-title"><?php echo $edu->college;?> <span> (<?php echo $edu->from_year;?> - <?php echo $edu->to_year;?>)</span></h3>
                                    <p class="education-dec"><?php echo $edu->degree;?>, <?php echo $edu->study_field;?></p>
                                </div>                              
                            </li>
						<?php
						endforeach;
						else:
							echo 'Record not found.';
						endif;
						?>
                        </ul>
                    </div>
					
                   <div id="work-experience-sec" class="blk education-sec work-experience-sec border-bottom mb-0">
                        <div class="_header bg-white mb-0">
                            <h3 class="section-head">Work Experience</h3>
                        </div>
                        <ul class="education-list">
						<?php
						if($experiences):
                        foreach($experiences as $exp):
						?>
                            <li>
                                <div class="education-thumb">
                                    <img src="../assets/images/work_experience.svg" alt="">
                                </div>  
                                <div class="education-details">
                                    <h3 class="education-title"><?php echo $exp->company_name;?> <span>(<?php echo $exp->from_year;?> - <?php echo ($exp->is_currently_work ? 'Present' : $exp->to_year);?>)</span></h3>
                                    <p class="education-dec"><?php echo $exp->description;?></p>
                                </div>                              
                            </li>
						<?php
						endforeach;
						else:
							echo 'Record not found.';
						endif;
						?>
                           
                        </ul>
                    </div>
					
                    <div id="subject-sec" class="blk subject-sec border-bottom mb-0">
                        <div class="_header bg-white mb-0">
                            <h3 class="section-head">Subjects</h3>
                        </div>
                        <div class="row">
                            <?php 
                                $subjects = json_decode(json_encode($subjects), 1);
                                if(!empty($subjects)){
                                    foreach ($subjects as $key => $value){
                                        if(!empty($value)) { ?>
                                        <div class="col-md-6">
                                            <div class="subject-box">
                                                <h4 class="subject-title"><?php echo $key; ?></h4>
                                                <ul class="subject-keywords">
                                                    <?php foreach ($value as $in => $subSubject){ ?>
                                                        <li><?php echo $subSubject; ?><?php echo ((($in+1) != count($value)) ? ',' : '') ?></li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                <?php   
                                        }
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    <div id="policies-sec" class="blk policies-sec education-sec border-bottom">
                        <div class="_header bg-white mb-0">
                            <h3 class="section-head">Policies</h3>
                        </div>
                        <ul class="education-list">
                            <li>
                                <div class="education-thumb">
                                    <img src="/assets/images/Hourly_rate.svg" style="width: 24px;height: 24px;margin: 0 auto;" alt="">
                                </div>  
                                <div class="education-details">
                                    <h3 class="education-title">Hourly Rate</h3>
                                    <p class="education-dec">$<?= $row->mem_hourly_rate?></p>
                                </div>                              
                            </li>
                            <li>
                                <div class="education-thumb">
                                    <img src="/assets/images/Background_check.svg" style="width: 18px;height: 25px;margin: 0 auto;" alt="">
                                </div>  
                                <div class="education-details">
                                    <?php if(!empty($tutorcheck) && $tutorcheck->status == 1 && $row->mem_verified == 1) {?>
                                        <h3 class="education-title">Background check</h3>
                                        <p class="education-dec"><a class="check_status1"  style="color:  #008cd2" href="javascript:void(0)"  encoded-id="<?= $encoded_id ?>" mem_id="<?= $row->mem_id ?>">Passed on <?php echo format_date($tutorcheck->date, 'm/d/Y'); ?></a></span></p>
                                    <?php } ?>

                                    <?php if(!empty($tutorcheck) && $tutorcheck->status == 0) {?>
                                        <h3 class="education-title">Background check</h3>
                                        <p class="education-dec"> <a class="check_status1"  style="color:  #008cd2" href="javascript:void(0)"  encoded-id="<?= $encoded_id ?>" mem_id="<?= $row->mem_id ?>">Pending</a></span></p>
                                    <?php } ?>

                                    <?php if(empty($tutorcheck)) {?>
                                        <h3 class="education-title">Background check</h3>
                                        <p class="education-dec"> <a class="check_status"  style="color:  #008cd2" href="javascript:void(0)"  encoded-id="<?= $encoded_id ?>" mem_id="<?= $row->mem_id ?>">Not Complete</a></span></p>
                                    <?php } ?>
                                </div>                              
                            </li>
                            <li>
                                <div class="education-thumb">
                                    <img src="/assets/images/Lesson_Cancellation.svg" style="width: 25px;height: 25px;margin: 0 auto;" alt="">
                                </div>  
                                <div class="education-details">
                                    <h3 class="education-title">Lesson Cancellation</h3>
                                    <p class="education-dec">24 hours notice required</p>
                                </div>                              
                            </li>
                            <li>
                                <div class="education-thumb">
                                    <img src="/assets/images/good_fit_guarantee.svg" style="width: 18px;height: 25px;margin: 0 auto;" alt="">
                                </div>  
                                <div class="education-details">
                                    <h3 class="education-title">Good Fit Guarantee</h3>
                                    <p class="education-dec">Your First lesson is backed by our <a class="good_match_guarantee" href='javascript:void(0)'>Good Match Guarantee </a></p>
                                </div>                              
                            </li>
                        </ul>
                    </div>
                    <div id="review-sec" class="blk introBlk review-sec border-bottom mb-0">
                        <div class="_header bg-white mb-0">
                            <h3 class="section-head">Reviews <span class="review-count review-count-change">(<?= $review_count?>)</span></h3>
                            <!-- <div class="rating-filter">
                                <select class="form-control" id="sel1" encoded-id="<?= $encoded_id ?>">
                                    <option value="">All Rating</option>
                                    <option value="5">5 Star Rating</option>
                                    <option value="4">4 Star Rating</option>
                                    <option value="3">3 Star Rating</option>
                                    <option value="2">2 Star Rating</option>
                                    <option value="1">1 Star Rating</option>
                                </select>
                            </div> -->
                        </div>
                        <ul class="review-list">
                            <!-- <?php foreach ($mem_reviews as $review_row): ?>
                            <li>
                                <div class="review-title-sec">
                                    <h4>&nbsp;</h4>
                                    <div class="rating">
                                        <div class="rateYo" data-rateyo-rating="<?= $review_row->rating?>" data-rateyo-read-only="true"></div>
                                    </div>
                                </div>
                                <p class="review-text"><?= $review_row->comment?></p>
                                <a href="#" class="review-author">- <?= $review_row->mem_name?></a>
                            </li>
                            <?php endforeach ?> -->
                        </ul>
                        <div class="pagination-sec">
                            <ul class="pagination">
                                <!-- <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item"><a class="page-link" href="#">5</a></li>
                                <li class="page-item active">
                                    <a class="page-link" href="#"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                    
                </div>
            </div>

        </div>
</section>
<!-- profile -->


<?php $this->load->view('includes/footer'); ?>
<script src="<?= base_url('assets/js/readmore.min.js')?>"></script>
<script type="text/javascript">
    
    function getReviews(encoded_id, rating, page) {
        $.ajax({
            url: base_url+'/get-reviews',
            data : {'encoded_id':encoded_id, 'rating': rating, 'page': page},
            dataType: 'JSON',
            method: 'POST',
            success: function (rs) {
                if ( rs.status ) {
                    var reviewHtml = '';
                    if ( rs.data_count > 0 ) {
                        rs.data.forEach(function(item) {
                            reviewHtml += '<li>';
                                reviewHtml += '<div class="review-title-sec">';
                                    reviewHtml += '<h4>&nbsp;</h4>';
                                    reviewHtml += '<div class="rating">';
                                        reviewHtml += '<div class="rateYo" data-rateyo-rating="'+item.rating+'" data-rateyo-read-only="true"></div>';
                                    reviewHtml += '</div>';
                                reviewHtml += '</div>';
                            reviewHtml += '<p class="review-text">'+item.comment+'</p>';
                            reviewHtml += '<a href="#" class="review-author">- '+item.mem_name+'</a>';
                            reviewHtml += '</li>';
                        });
                        $('.review-list').html(reviewHtml);
                        $('.review-count-change').html('('+rs.data_count+')');

                        $('.rateYo').rateYo({
                            fullStar: true,
                            normalFill: '#e4efff',
                            ratedFill: '#5495FF',
                            starWidth: '14px',
                            spacing: '2px'
                        });
                    } else {
                        $('.review-list').html('<p class="text-center">No Reviews</p>');
                        $('.review-count-change').html('(0)');
                    }

                    //console.log(rs.data_count, rs.data_per_page, rs.data_total_page, page);
                    var paginationHtml = '';
                    if ( rs.data_total_page > 1 ) {
                        paginationHtml += '<li class="page-item '+(page == '1' ? 'disabled' : 'active')+'">';
                            paginationHtml += '<a class="page-link gotoPage" page="1" href="javascript:void(0);" tabindex="-1"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>';
                        paginationHtml += '</li>';

                        if ( page > 1 ) {
                            paginationHtml += '<li class="page-item"><a class="page-link gotoPage" page="'+(+page-1)+'" href="javascript:void(0);">'+(+page-1)+'</a></li>';
                        }

                        paginationHtml += '<li class="page-item active"><a class="page-link" href="javascript:void(0);">'+page+'</a></li>';

                        if ( page < rs.data_total_page ) {
                            paginationHtml += '<li class="page-item"><a class="page-link gotoPage" page="'+(+page+1)+'" href="javascript:void(0);">'+(+page+1)+'</a></li>';
                        }

                        paginationHtml += '<li class="page-item '+(page == rs.data_total_page ? 'disabled' : 'active')+'">';
                            paginationHtml += '<a class="page-link gotoPage" page="'+rs.data_total_page+'" href="javascript:void(0);"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>';
                        paginationHtml += '</li>';
                    }
                    $('.pagination').html(paginationHtml);
                }
            },
            error: function(rs){
                console.log(rs);
            },
            complete: function (rs) {
                console.log(rs);
            }
        });
    }

    $(function(){
        $(".div-readmore").readmore({collapsedHeight: 80,speed: 500});
        h = $('#profile .col1 .content').height();
        // $('#profile .col2 .content').height(h);

        // load all rating (init)
        getReviews('<?= $encoded_id ?>', '', 1);

        $(document).on('change', '#sel1', function(e) {
            var encoded_id = $(this).attr('encoded-id');
            getReviews(encoded_id, this.value, 1);
        });

        $(document).on('click', 'a.gotoPage', function(e) {
            var rating = $('#sel1').val();
            var page = $(this).attr('page');
            getReviews('<?= $encoded_id ?>', rating, page);
        });

        $(document).on('click', 'a.checkHash', function(e) {
            e.preventDefault();
            return false;
            $('.side-bar-menu li').removeClass('active');
            $(this).parent().addClass('active');
        });

        $(document).on('click', 'a.purchase_back', function(e) {
            e.preventDefault();
            var encoded_id = $(this).attr('encoded-id');
            var mem_id = $(this).attr('mem_id');
            $.ajax({
                url: base_url+'/pay-for-check',
                data : {'encoded_id':encoded_id,'mem_id':mem_id},
                dataType: 'JSON',
                method: 'POST',
                success: function (rs) {
                    if(rs.status===1) {
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
                    ajaxSearch=false;
                    needToConfirm = false;
                }
            });
        });

        $(document).on('click', 'a.good_match_guarantee', function(e) {
            e.preventDefault();
            var detail_popup=$(".popup[data-popup='view-detail']");
            detail_popup.find('._inner').html('<div class="cardBlk text-center"><div class="crosBtn order_back_cross"></div><h3 class="order_back">Your first hour with any tutor is always protected by our Good Match Guarantee If you are unhappy with your tutor after the first hour just let us know and we will refund up to the first hour of the lesson.</h3><div class="formRow row svdCards"></div>');
            detail_popup.fadeIn();
        });

        $(document).on('click', 'a.check_status', function(e) {
            e.preventDefault();
            var encoded_id = $(this).attr('encoded-id');
            var mem_id = $(this).attr('mem_id');
            $.ajax({
                url: base_url+'/check-status',
                data : {'encoded_id':encoded_id,'mem_id':mem_id},
                dataType: 'JSON',
                method: 'POST',
                success: function (rs) {
                    if(rs.status===1) {
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
                    ajaxSearch=false;
                    needToConfirm = false;
                }
            });
        });
        
        $(document).on('click', '.checkPay', function(e) {
            e.preventDefault();

            var btn=$(this);
            btn.find("i.fa-spinner").removeClass('hidden');
            var store = $(this).attr('data-store');
            var payment_method = $('#payment_method').val();

            $.ajax({
                url: '<?php echo base_url(); ?>check_pay',
                data : {'store':store, 'payment_method':payment_method},
                dataType: 'JSON',
                method: 'POST',
                success: function (rs) {
                    if(rs.status===1){
                        var detail_popup=$(".popup[data-popup='view-detail']");
                        $('.alertMsg').html(rs.msg);
                        btn.find("i.fa-spinner").addClass('hidden');
                        detail_popup.fadeIn();

                        setTimeout(function() {
                            $('.crosBtn').trigger('click');
                            location.reload();
                        }, 3000);
                    }
                    else{
                        $('.alertMsg').html(rs.msg);
                        setTimeout(function() {
                            $('.crosBtn').trigger('click');
                            location.reload();
                        }, 3000);
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
    });

    $(document).on('submit','#frmLoginProfile',function(e) {
        e.preventDefault();
        $('#txtSubmit').trigger('click');
        needToConfirm = true;
        var frmbtn=$(this).find("button[type='submit']");
        var frmIcon=$(this).find("button[type='submit'] i.fa-spinner");
        var frmMsg=$(this).find("div.alertMsg:first");
        var frm=this;


        // frmbtn.attr("disabled", true);
        frmMsg.hide();
        frmIcon.removeClass("hidden");
        $.ajax({
            url: $(this).attr('action'),
            data : new FormData(frm),
            processData: false,
            contentType: false,
            dataType: 'JSON',
            method: 'POST',

            error: function (rs) {
                console.log(rs);
            },
            success: function (rs) {
                console.log(rs);
                console.log(rs.redirect_url);
                console.log(rs.msg);
                frmMsg.html(rs.msg).slideDown(500);
                if(rs.scroll_to_msg)
                    $('html, body').animate({ scrollTop: frmMsg.offset().top-300}, 'slow');
                if (rs.status == 1) {
                    setTimeout(function () {
                        if(rs.frm_reset){
                            frm.reset();
                            /*if((typeof recaptcha !== 'undefined') && recaptcha)
                                grecaptcha.reset();*/
                        }
                        if(rs.hide_msg)
                            frmMsg.slideUp(500);
                        frmIcon.addClass("hidden");

                        location.reload();

                    }, 3000);
                } else {
                    setTimeout(function () {
                        if(rs.hide_msg)
                            frmMsg.slideUp(500);
                        frmbtn.attr("disabled", false);
                        frmIcon.addClass("hidden");
                        location.reload();
                    }, 3000);
                }
            },
            complete: function (rs) {
                needToConfirm = false;
            }
        });
    });

</script>
</body>
</html>