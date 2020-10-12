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
                        <?php if (count_new_header_notis()>0): ?>
                            <span class="dot yellow"></span>
                        <?php endif ?>
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
                    <a href="<?= site_url('messages')?>">
                        <i class="fi-envelope"></i>
                        <?php if (count_new_msgs()>0): ?>
                            <span class="dot red"></span>
                        <?php endif ?>
                    </a>
                </li>
            </ul>
        <?php endif?>
        <nav class="ease">
            <?php if (!empty($mem_data) && !empty($this->session->mem_type)): ?>
            <ul id="nav">
                <li class=" bTn dashBtn">
                    <a href="<?= site_url('my-lessons')?>">Dashboard</a>
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
                    <li class="<?php if($page=="become-a-tutor"){echo 'active';} ?>">
                        <a href="<?= site_url('tutor-signup')?>">Become a Tutor</a>
                    </li>
                    <li class="<?php if($page=="login"){echo 'active';} ?>">
                        <a href="javascript:void(0)" class="popBtn" data-popup="login">Login</a>
                    </li>
                    <li class="<?php if($page=="signup"){echo 'active';} ?> bTn">
                        <a href="<?= site_url('signup')?>">Sign up</a>
                    </li>
                </ul>
            <?php endif?>
        </nav>
    </div>
    <?php if (empty($mem_data)): ?>
        <div class="popup" data-popup="login">
            <div class="tableDv">
                <div class="tableCell">
                    <div class="contain">
                        <div class="logBlk _inner">
                            <div class="crosBtn"></div>
                            <form action="<?= site_url('login')?>" method="post" autocomplete="off" class="frmAjax" id="frmLogin">
                                <h2>Login with Crainly</h2>
                                <div class="txtGrp">
                                    <input type="email" id="email" name="email" class="txtBox" placeholder="Email" autofocus>
                                </div>
                                <div class="txtGrp">
                                    <input type="password" id="password" name="password" class="txtBox" placeholder="Password">
                                </div>
                                <div class="rememberMe">
                                    <div class="lblBtn pull-left">
                                        <input type="checkbox" name="remeberMe" id="rememberMe">
                                        <label for="rememberMe">Remember me</label>
                                    </div>
                                    <a href="<?= site_url('forgot-password')?>" id="pass" class="pull-right">Forgot Password ?</a>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="bTn text-center">
                                    <button type="submit" class="webBtn colorBtn lgBtn">Login to your account <i class="fa fa-spinner fa-pulse fa-1x fa-fw hidden"></i></button>
                                </div>
                                <div class="alertMsg" style="display:none"></div>
                                <div class="oRLine"><span>OR</span></div>
                                <ul class="socialLnks text-center">
                                    <li><a href="<?= site_url('facebook-login'); ?>" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="<?= site_url('google-login'); ?>" class="google"><i class="fa fa-google"></i></a></li>
                                </ul>
                                <div class="haveAccount text-center">
                                    <span>Don’t have an account ?</span>
                                    <a href="<?= site_url('signup')?>">Sign up</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>
</header>
<!-- header -->
<script type="text/javascript">
    $(function(){
        $(document).on('click','.notifiDrop>ul>li',function(){
            window.location=base_url+'notifications/1/'+$(this).data('store')
        })
        $(document).on('click','a.dropBtn>i.fi-bell',function(){
            $.post(base_url+'open-notifications',function(data){})
        })
    })
</script>


<div class="upperlay"></div>
<!-- <div id="pageloader">
    <div class="loader"><span></span><span></span></div>
</div> -->
<div class="pBar hidden"><span id="myBar" style="width:0%"></span></div>
