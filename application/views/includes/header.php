<header class="<?= empty($page)?'':'fix '?><?= empty($mem_data)?'':'logged '?>ease">
<div class="contain-fluid">
<div class="logo ease">
<a href="<?= site_url()?>"><img src="<?= base_url('assets/images/logo-line.png')?>" alt="<?= $site_settings->site_name?>"></a>
</div>
<div class="toggle"><span></span></div>

<?php //if ($mem_data && !empty($mem_data->mem_verified)): ?>
<?php if ($mem_data): ?>
<div class="proIco dropDown">
<div class="inside dropBtn">
<div class="ico">
<img src="<?= get_image_src($mem_data->mem_image,'50',true)?>" alt="">
</div>
</div>
<ul class="proDrop dropCnt">
<?php if ($this->session->mem_type=='tutor'): ?>
<li><a href="<?= site_url('my-lessons')?>"><i class="fi-webpage"></i>Dashboard</a></li>
<li><a href="<?=site_url('profile')?>"><i class="fi-user"></i>View Profile</a></li>
<?php endif ?>
<li><a href="<?=site_url('account-settings')?>"><i class="fi-cog"></i>Account Settings</a></li>
<li><a href="<?= site_url('logout') ?>"><i class="fi-power-switch"></i>Logout</a></li>
</ul>
</div>
<ul class="global">
<!-- <li class="srchBtn">
<a href="javascript:void(0)">
<i class="fi-search"></i>
</a>
</li> -->
    <li class="dropDown">
        <a href="javascript:void(0)" class="dropBtn">
            <i class="fi-bell"></i>
            <span class="dot yellow"  style="display:<?=(count_new_header_notis()==0)?'none':'block';?>"></span>
        </a>
        <div class="notifiDrop dropCnt">
            <ul class="scrollbar">
            <?php $noti_rows=get_header_notis(10)?>
            <?php if (count($noti_rows)<1): ?>
                <li>
                    <div class="inside">
                        No new notification
                    </div>
                </li>
            <?php endif ?>
            <?php foreach ($noti_rows as $key => $noti_row): ?>
                <li data-store="<?= $noti_row->encoded_id?>">
                    <div class="inside">
                        <dic class="ico"><img src="<?= get_image_src($noti_row->mem_image,50,true)?>" alt=""></dic>
                        <h5><?= $noti_row->mem_name?></h5>
                        <p><?=$noti_row->txt ?></p>
                        <span class="time"><?=time_ago($noti_row->date) ?></span>
                    </div>
                </li>
            <?php endforeach ?>
            </ul>
            <div class="shwAll semi text-center">
                <a href="<?= site_url('notifications')?>">See All</a>
            </div>
        </div>
    </li>
    <li>
        <?php if(!empty($mem_data->mem_stripe_id) || $mem_data->mem_type != 'tutor') { ?>
        <a href="<?= site_url('messages')?>">
            <i class="fi-envelope"></i>
            <span class="dot red" style="display:<?=(count_new_msgs()==0)?'none':'block';?>"></span>
        </a>
        <?php  } else { ?>
        <a href="#" id="myBtn_1"><i class="fi-envelope"></i></a>
        <?php } ?>
    </li>
</ul>
<?php endif?>
<div id="myModal" class="modal">

<!-- Modal content -->
<div class="modal-content">
<span class="close">&times;</span>
<p>Please connect with <a href="<?= site_url('stripe-register')?>">Stripe</a> first.  </p>
</div>

</div>
<nav class="ease">
<?php if (!empty($mem_data) && !empty($this->session->mem_type)): ?>
<ul id="nav">
<li class=" bTn dashBtn">
<?php if(!empty($mem_data->mem_stripe_id) || $mem_data->mem_type != 'tutor') { ?>
<a href="<?= site_url('my-lessons')?>">Dashboard</a>
<?php  } else { ?>
<a href="#" id="myBtn">Dashboard</a>
<?php } ?>
</li>
</ul>
<!-- <ul id="nav">
<li class="<?php if($page=="dashboard"){echo 'active';} ?> dashBtn">
<a href="<?= site_url($this->session->mem_type=='tutor'?'dashboard':'account-settings')?>">Dashboard</a>
</li>
<?php if (empty($mem_data->mem_verified)): ?>
<li class="<?php if($page=="logout"){echo 'active';} ?> bTn">
<a href="<?= site_url('logout')?>">Logout</a>
</li>
<?php endif ?>
</ul> -->
<?php elseif (empty($mem_data)): ?>
<ul id="loged">
<?php if($page!="tutor-signup" && $page != "tutor-multi-signup") { ?>
<!-- <li class="<?php //if($page=="become-a-tutor"){echo 'active';} ?>"> -->
<li>
<a href="<?= site_url('tutor-signup')?>">Become a Tutor</a>
</li>
<?php } ?>
<li class="<?php if($page=="login"){echo 'active';} ?>">
<a href="#" class="popBtn" data-popup="login">Login</a>
</li>
<?php if($page!="signup") { ?>
<!-- <li class="<?php//if($page=="signup"){echo 'active';} ?> bTn"> -->
<li class="bTn">
<a href="<?= site_url('signup')?>">Sign up</a>
</li>
<?php } ?>
</ul>
<?php endif?>
</nav>
</div>
<?php //if (empty($mem_data)): ?>
<div class="popup login-popup" data-popup="login">
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

<?php// endif ?>
    <div class="popup tutor-popup" style="background: #0000009e;display:<?=($_SESSION['tutor-review'] == true)?'block':'none'?>">
        <div class="tableDv">
            <div class="tableCell" style="vertical-align:baseline;position:relative">
                <div class="contain PlusClass">
                    <div style="font-size: 15px;
                        background: white;
                        padding: 20px 20px 12px;
                        border-radius: 5px;
                        text-align: center;
                        position:relative;
                        color:#114361">
                        <div class="crosBtn" style="color: #2cb1ff; background: white;font-weight: bold;"></div>
                        <h3>Thanks for signing up!</h3>
                        <div>Your registration is complete and our team will review <br> your application and get back to you shortly.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php unset($_SESSION['tutor-review']);?>
</header>
<!-- header -->
<script type="text/javascript">
$(document).ready(function(){
    function scan_notification(){
        $.ajax({
            url: base_url+'scan-notification',
            method: 'POST',
            success: function(res){
                var result = JSON.parse(res);
                if(result.noti_cnt == 0){
                    $(".dot.yellow").css('display','none');
                }
                else{
                    $(".dot.yellow").css('display','block');
                }
                if(result.message_cnt == 0){
                    $(".dot.red").css('display','none');
                }
                else{
                    $(".dot.red").css('display','block');
                }
                console.log(res);
            },
            error: function(res){
                console.log(res);
            },
            complete: function(res){
                
            }
        })
    }
    setInterval(function(){ scan_notification(); }, 3000);
});
$(function(){
  $(document).on('click','.notifiDrop>ul>li',function(){
                 window.location=base_url+'notifications/1/'+$(this).data('store')
                 })
  $(document).on('click','a.dropBtn>i.fi-bell',function(){
                 $.post(base_url+'open-notifications',function(data){
                     if(data == 'ok') {
                         if($(".dot.yellow").length > 0) $(".dot.yellow").css("display","none");
                     }
                 })
  });
  
  function contolzendesk(){    
    var height  = $("body").height()-$(window).height();
    if($("#fc_frame").length > 0) {
        if($(this).scrollTop() > height +60) 
            $("#fc_frame").css("bottom","85px");
        else
            $("#fc_frame").css("bottom","15px");
    }
  }
  $(window).scroll(function() {
    contolzendesk();
  });
  
    $(document).ready(function(){
        setTimeout(function(){ contolzendesk(); }, 3000);
        
    });
  // Get the modal
  var modal = document.getElementById("myModal");
  
  // Get the button that opens the modal
  var btn = document.getElementById("myBtn");
  var btn1 = document.getElementById("myBtn_1");
  
  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];
  
  if(btn)
  {
  // When the user clicks on the button, open the modal
  btn.onclick = function() {
  modal.style.display = "block";
  }
  }
  if(btn1)
  {
  btn1.onclick = function() {
  modal.style.display = "block";
  }
  }
  
  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
  modal.style.display = "none";
  }
  
  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
  if (event.target == modal) {
  modal.style.display = "none";
  }
  }
  })
</script>


<div class="upperlay"></div>
<!-- <div id="pageloader">
<div class="loader"><span></span><span></span></div>
</div> -->
<div class="pBar hidden"><span id="myBar" style="width:0%"></span></div>
