
<div class="proIco">
    <div class="ico">
        <img src="<?= get_image_src($mem_data->mem_image,'50',true)?>" alt="">
    </div>
    <h4 class="title"><?= format_name($mem_data->mem_fname,$mem_data->mem_lname)?> <a href="javascript:void(0)"><?= $mem_data->mem_email?></a></h4>
</div>

<div class="head">
    <h5>Dashboard List</h5>
    <i class="fi-bars"></i>
</div>


<ul id="sBar">
    <?php if ($mem_data->mem_type=='tutor'): ?>
        <!-- <li class="<?php if($page=="dashboard"){echo 'active';} ?>">
            <a href="<?= site_url('dashboard')?>"><i class="fi-webpage"></i><span>Dashboard</span></a>
        </li> -->
    <?php endif ?>
    <?php if ($mem_data->mem_type=='student'): ?>
        <li class="<?php if($page=="my-jobs"){echo 'active';} ?>">
            <a href="<?= site_url('my-jobs')?>"><i class="fi-list"></i><span>My Jobs</span></a>
        </li>
        <li class="<?php if($page=="search"){echo 'active';} ?>">
            <a href="<?= site_url('search')?>"><i class="fi-search"></i><span>Find a Tutor</span></a>
        </li>
        <li class="<?php if($page=="my-lessons"){echo 'active';} ?>">
            <a href="<?= site_url('my-lessons')?>"><i class="fi-layers"></i><span>My Lessons</span></a>
        </li>
        <li class="<?php if($page=="requests"){echo 'active';} ?>">
            <a href="<?= site_url('requests')?>"><i class="fi-list"></i><span>Requests</span></a>
        </li>
        <li class="<?php if($page=="notifications"){echo 'active';} ?>">
            <a href="<?= site_url('notifications')?>"><i class="fi-bell"></i><span>Notifications</span></a>
        </li>
        <li class="<?php if($page=="my-tutors"){echo 'active';} ?>">
            <a href="<?= site_url('my-tutors')?>"><i class="fi-user"></i><span>My Tutors</span></a>
        </li>
        <li class="<?php if($page=="payment-methods"){echo 'active';} ?>">
            <a href="<?= site_url('payment-methods')?>"><i class="fi-credit-card"></i><span>Payments</span></a>
        </li>
        <!-- <li class="<?php if($page=="contact"){echo 'active';} ?>">
            <a href="<?= site_url('contact')?>"><i class="fi-pencil"></i><span>Contact us</span></a>
        </li> -->
    <?php endif ?>
    <?php if ($mem_data->mem_type=='tutor'): ?>
        <li class="<?php if($page=="search-jobs"){echo 'active';} ?>">
            <a href="<?= site_url('search-jobs')?>"><i class="fi-search"></i><span>Find a Job</span></a>
        </li>
        <li class="<?php if($page=="my-lessons"){echo 'active';} ?>">
            <a href="<?= site_url('my-lessons')?>"><i class="fi-layers"></i><span>My Lessons</span></a>
        </li>
        <li class="<?php if($page=="lesson-requests"){echo 'active';} ?>">
            <a href="<?= site_url('lesson-requests')?>"><i class="fi-list"></i><span>Lesson Requests</span></a>
        </li>
        <li class="<?php if($page=="notifications"){echo 'active';} ?>">
            <a href="<?= site_url('notifications')?>"><i class="fi-bell"></i><span>Notifications</span></a>
        </li>
        <li class="<?php if($page=="direct-deposit" || $page=="add-bank-account"){echo 'active';} ?>">
            <a href="<?= site_url('direct-deposit')?>"><i class="fi-credit-card"></i><span>Direct Deposit</span></a>
        </li>
        <li class="<?php if($page=="share-profile"){echo 'active';} ?>">
            <a href="<?= site_url('share-profile')?>"><i class="fi-users"></i><span>Share Profile</span></a>
        </li>
    <?php endif ?>

    <?php if ($mem_data->mem_type=='student'): ?>
        <li class="<?php if($page=="invite-friend"){echo 'active';} ?>">
            <a href="<?= site_url('invite-friend')?>"><i class="fi-users"></i><span>Invite a Friend</span></a>
        </li>
    <?php endif ?>
    <li class="<?php if($page=="transactions"){echo 'active';} ?>">
        <a href="<?= site_url('transactions')?>"><i class="fi-exchange"></i><span>Transactions</span></a>
    </li>
    <li class="<?php if($page=="account-settings"){echo 'active';} ?>">
        <a href="<?= site_url('account-settings')?>"><i class="fi-cog"></i><span>Account Settings</span></a>
    </li>
    <!-- <li class="<?php if($page=="contact-us"){echo 'active';} ?>">
        <a href="<?= site_url('contact-us')?>"><i class="fi-envelope"></i><span>Contact Us</span></a>
    </li> -->
    <!-- <li class="<?php if($page=="support"){echo 'active';} ?>">
        <a href="<?= site_url('support')?>"><i class="fi-support"></i><span>Support</span></a>
    </li> -->
    <!-- <li class="<?php if($page=="login"){echo 'active';} ?>">
        <a href="<?= site_url('logout')?>"><i class="fi-power-switch"></i><span>Logout</span></a>
    </li> -->
</ul>
<?php
/*if (empty($mem_data->mem_verified)):
    echo showMsg('info','Please verify your profile!');
endif*/
?>