<div class="sidebar-menu">
    <div class="sidebar-menu-inner">
        <header class="logo-env">
            <!-- logo -->
            <div class="logo">
                <a href="<?=site_url(ADMIN.'/dashboard')?>">
                    <img src="<?= base_url('assets/images/logo-line.png') ?>" width="120" alt="">
                </a>
            </div>
            <!-- logo collapse icon -->
            <div class="sidebar-collapse">
                <a href="#" class="sidebar-collapse-icon"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
                    <i class="entypo-menu"></i>
                </a>
            </div>
            <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
            <div class="sidebar-mobile-menu visible-xs">
                <a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
                    <i class="entypo-menu"></i>
                </a>
            </div>
        </header>
        <ul id="main-menu" class="main-menu">
            <li class="opened <?= ($this->uri->segment('2') == 'dashboard') ? 'active' : '' ?>">
                <a href="<?= site_url(ADMIN.'/dashboard') ?>">
                    <i class="entypo-gauge"></i>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <?php if(is_admin()):?>
            <li class="opened <?= ($this->uri->segment('2') == 'sub-admin') ? 'active' : '' ?>">
                <a href="<?= site_url(ADMIN.'/sub-admin') ?>">
                    <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                    <span class="title">Sub Admin</span>
                </a>
            </li>
            <?php endif?>
            <?php if(access(1)):?>
            <li class="opened <?= ($this->uri->segment('2') == 'students') ? 'active' : '' ?>">
                <a href="<?= site_url(ADMIN.'/students') ?>">
                    <i class="entypo-user"></i>
                    <span class="title">Students </span>
                </a>
            </li>
            <?php endif?>
            <?php if(access(2)):?>
            <li class="opened <?= ($this->uri->segment('2') == 'tutors') ? 'active' : '' ?>">
                <a href="<?= site_url(ADMIN.'/tutors') ?>">
                    <i class="entypo-user"></i>
                    <span class="title">Tutors </span>
                </a>
            </li>
            <?php endif?>
            <!-- <?php //if(access(3)):?>
            <li class="opened <?php //($this->uri->segment('2') == 'tutor-applications') ? 'active' : '' ?>">
                <a href="<?php //site_url(ADMIN.'/tutor-applications') ?>">
                    <i class="entypo-user"></i>
                    <span class="title">Tutor Applications </span>
                    <?php //$tutor_application_count=count_tutor_applications();?>
                    <?php //if ($tutor_application_count>0): ?>
                        <span class="badge"><?= $tutor_application_count?></span>
                    <?php// endif ?>
                </a>
            <?php //endif?>
            </li> -->
            <li class="opened <?= ($this->uri->segment('3') == 'tutor-registrations') ? 'active' : '' ?>">
                <a href="<?= site_url(ADMIN.'/tutors/tutor-registrations') ?>">
                    <i class="entypo-user"></i>
                    <span class="title">Tutor Registrations </span>
                </a>
            </li>
            <li class="opened <?= ($this->uri->segment('2') == 'jobs') ? 'active' : '' ?>">
                <a href="<?= site_url(ADMIN.'/jobs') ?>">
                    <i class="fa fa-th"></i>
                    <span class="title">Jobs </span>
                </a>
            </li>
            <!-- <li class="opened <?php //($this->uri->segment('2') == 'grade-levels') ? 'active' : '' ?>">
                <a href="<?php // site_url(ADMIN.'/grade-levels') ?>">
                    <i class="fa fa-th-list"></i>
                    <span class="title">Grade Level </span>
                </a>
            </li> -->
            <?php if(access(4)):?>
            <li class="opened <?= ($this->uri->segment('2') == 'subjects') ? 'active' : '' ?>">
                <a href="<?= site_url(ADMIN.'/subjects') ?>">
                    <i class="fa fa-book"></i>
                    <span class="title">Subjects </span>
                </a>
            </li>
            <?php endif?>
            <li class="opened <?= ($this->uri->segment('2') == 'lessons') ? 'active' : '' ?>">
                <a href="<?= site_url(ADMIN.'/lessons') ?>">
                    <i class="fa fa-th"></i>
                    <span class="title">Lesson Requests</span>
                </a>
            </li>
            <li class="opened <?= ($this->uri->segment('2') == 'promocodes') ? 'active' : '' ?>">
                <a href="<?= site_url(ADMIN.'/promocodes') ?>">
                    <i class="fa fa-ticket"></i>
                    <span class="title">Promo Codes</span>
                </a>
            </li>
            <?php if(access(5)):?>
            <li class="opened <?= ($this->uri->segment('2') == 'chat') ? 'active' : '' ?>">
                <a href="<?= site_url(ADMIN.'/chat') ?>">
                    <i class="fa fa-comments"></i>
                    <span class="title">Chat Management</span>
                </a>
            </li>
            <?php endif?>
            <!--
            <li class=" <?= ($this->uri->segment('2') == 'comments') ? ' opened  active' : '' ?>">
                <a href="javascript:void(0)">
                    <i class="entypo-comment"></i>
                    <span class="title">Comments Management</span>
                </a>
                <ul>
                    <li class=" <?= ($this->uri->segment('3') == 'reported') ? ' active' : '' ?>">
                        <a href="<?= site_url(ADMIN.'/comments/reported') ?>">
                            <i class="entypo-comment"></i>
                            <span class="title">Reported Comments</span>
                        </a>
                    </li>
                    <li class=" <?= ($this->uri->segment('3') == 'review') ? ' active' : '' ?>">
                        <a href="<?= site_url(ADMIN.'/comments/review') ?>">
                            <i class="entypo-comment"></i>
                            <span class="title">Review Comments</span>
                        </a>
                    </li>
                </ul>
            </li>
             -->
             <!-- <li class="opened <?php //($this->uri->segment('2') == 'transactions') ? 'active' : '' ?>">
                <a href="<?php// site_url(ADMIN.'/transactions') ?>">
                    <i class="fa fa-money"></i>
                    <span class="title">Transactions</span>
                </a>
            </li> -->
             <!-- <li class="opened <?php //($this->uri->segment('2') == 'withdraws' && $this->uri->segment('3') == '') ? 'active' : '' ?>">
                <a href="<?php //site_url(ADMIN.'/withdraws') ?>">
                    <i class="fa fa-money"></i>
                    <span class="title">Withdraws</span>
                </a>
            </li>
            <li class="opened <?php //($this->uri->segment('2') == 'withdraws' && $this->uri->segment('3') == 'requests') ? 'active' : '' ?>">
                <a href="<?php //site_url(ADMIN.'/withdraws/requests') ?>">
                    <i class="fa fa-money"></i>
                    <span class="title">Withdraw Requests</span>
                    <?php// $withdraw_count=count_panding_withdraws();?>
                    <?php// if ($withdraw_count>0): ?>
                        <span class="badge"><?=$withdraw_count?></span>
                    <?php// endif ?>
                </a>
            </li> -->
           <!--  <?php //if(access(6)):?>
            <li class="opened <?php //($this->uri->segment('2') == 'founders') ? 'active' : '' ?>">
                <a href="<?php //site_url(ADMIN.'/founders') ?>">
                    <i class="fa fa-th-list"></i>
                    <span class="title">Founders</span>
                </a>
            </li>
            <?php //endif?> -->
            <?php if(access(7)):?>
            <li class="opened <?= ($this->uri->segment('2') == 'faq') ? 'active' : '' ?>">
                <a href="<?= site_url(ADMIN.'/faq') ?>">
                    <i class="fa fa-th-list"></i>
                    <span class="title">FAQ's</span>
                </a>
            </li>
            <?php endif?>
            <?php if(access(8)):?>
            <li class=" <?= ($this->uri->segment('2') == 'sitecontent' || $this->uri->segment('2') == 'preferences') ? ' opened  active' : '' ?>">
                <a href="javascript:void(0)">
                    <i class="fa fa-pagelines  "></i>
                    <span class="title">Manage Pages</span>
                </a>
                <ul>
                    <li class=" <?= ($this->uri->segment('3') == 'login') ? ' active' : '' ?>">
                        <a href="<?= site_url(ADMIN.'/sitecontent/login') ?>">
                            <i class="entypo-doc-text  "></i>
                            <span class="title">Login</span>
                        </a>
                    </li>
                    <li class=" <?= ($this->uri->segment('3') == 'signup') ? ' active' : '' ?>">
                        <a href="<?= site_url(ADMIN.'/sitecontent/signup') ?>">
                            <i class="entypo-doc-text  "></i>
                            <span class="title">Sign up</span>
                        </a>
                    </li>
                    <li class=" <?= ($this->uri->segment('3') == 'tutor-signup') ? ' active' : '' ?>">
                        <a href="<?= site_url(ADMIN.'/sitecontent/tutor-signup') ?>">
                            <i class="entypo-doc-text  "></i>
                            <span class="title">Tutor Sign up</span>
                        </a>
                    </li>
                    <li class=" <?= ($this->uri->segment('3') == 'forgot') ? ' active' : '' ?>">
                        <a href="<?= site_url(ADMIN.'/sitecontent/forgot') ?>">
                            <i class="entypo-doc-text  "></i>
                            <span class="title">Forgot Password</span>
                        </a>
                    </li>
                    <li class=" <?= ($this->uri->segment('3') == 'reset') ? ' active' : '' ?>">
                        <a href="<?= site_url(ADMIN.'/sitecontent/reset') ?>">
                            <i class="entypo-doc-text  "></i>
                            <span class="title">Reset Password</span>
                        </a>
                    </li>
                    <li class=" <?= ($this->uri->segment('3') == 'phone-verify') ? ' active' : '' ?>">
                        <a href="<?= site_url(ADMIN.'/sitecontent/phone-verify') ?>">
                            <i class="entypo-doc-text  "></i>
                            <span class="title">Phone Verification</span>
                        </a>
                    </li>
                    <li class=" <?= ($this->uri->segment('3') == 'email-verify') ? ' active' : '' ?>">
                        <a href="<?= site_url(ADMIN.'/sitecontent/email-verify') ?>">
                            <i class="entypo-doc-text  "></i>
                            <span class="title">Email Verification</span>
                        </a>
                    </li>
                    <!-- <li class=" <?= ($this->uri->segment('3') == 'bannerimage') ? ' active' : '' ?>">
                        <a href="<?= site_url(ADMIN.'/preferences/bannerimage') ?>">
                            <i class="entypo-doc-text"></i>
                            <span class="title">Banner Image</span>
                        </a>
                    </li> -->
                    <li class=" <?= ($this->uri->segment('3') == 'footer-section') ? ' active' : '' ?>">
                        <a href="<?= site_url(ADMIN.'/preferences/footer-section') ?>">
                            <i class="entypo-doc-text  "></i>
                            <span class="title">Footer Section</span>
                        </a>
                    </li>
                    <li class=" <?= ($this->uri->segment('3') == 'home') ? ' active' : '' ?>">
                        <a href="<?= site_url(ADMIN.'/sitecontent/home') ?>">
                            <i class="entypo-doc-text  "></i>
                            <span class="title">Home</span>
                        </a>
                    </li>
                    <li class=" <?= ($this->uri->segment('3') == 'about') ? ' active' : '' ?>">
                        <a href="<?= site_url(ADMIN.'/sitecontent/about') ?>">
                            <i class="entypo-doc-text  "></i>
                            <span class="title">About</span>
                        </a>
                    </li>
                    <li class=" <?= ($this->uri->segment('3') == 'termsservices') ? ' active' : '' ?>">
                        <a href="<?= site_url(ADMIN.'/preferences/termsservices') ?>">
                            <i class="entypo-doc-text  "></i>
                            <span class="title">Term's of Services</span>
                        </a>
                    </li>
                    <li class=" <?= ($this->uri->segment('3') == 'privacypolicy') ? ' active' : '' ?>">
                        <a href="<?= site_url(ADMIN.'/preferences/privacypolicy') ?>">
                            <i class="entypo-doc-text  "></i>
                            <span class="title">Privacy Policy</span>
                        </a>
                    </li>
                    <li class=" <?= ($this->uri->segment('3') == 'contact') ? ' active' : '' ?>">
                        <a href="<?= site_url(ADMIN.'/sitecontent/contact') ?>">
                            <i class="entypo-doc-text  "></i>
                            <span class="title">Contact Us</span>
                        </a>
                    </li>
                    <li class=" <?= ($this->uri->segment('3') == 'search') ? ' active' : '' ?>">
                        <a href="<?= site_url(ADMIN.'/sitecontent/search') ?>">
                            <i class="entypo-doc-text  "></i>
                            <span class="title">Search Page</span>
                        </a>
                    </li>
                    <!-- <li class=" <?= ($this->uri->segment('3') == 'creators') ? ' active' : '' ?>">
                        <a href="<?= site_url(ADMIN.'/sitecontent/creators') ?>">
                            <i class="entypo-doc-text  "></i>
                            <span class="title">Creators</span>
                        </a>
                    </li>
                    <li class=" <?= ($this->uri->segment('3') == 'buygems') ? ' active' : '' ?>">
                        <a href="<?= site_url(ADMIN.'/sitecontent/buygems') ?>">
                            <i class="entypo-doc-text  "></i>
                            <span class="title">Buy Gems</span>
                        </a>
                    </li> -->
                </ul>
            </li>
            <?php endif?>
            <?php if(is_admin()):?>
            
            <li class="opened <?= ($this->uri->segment('2') == 'texts') ? 'active' : '' ?>">
                <a href="<?= site_url(ADMIN) ?>/texts">
                    <i class="fa fa-cog"></i>
                    <span class="title">Site Texts</span>
                </a>
            </li>
            <li class="opened <?= ($this->uri->segment('2') == 'settings' && $this->uri->segment('3') == '') ? 'active' : '' ?>">
                <a href="<?= site_url(ADMIN.'/settings') ?>">
                    <i class="fa fa-cogs"></i>
                    <span class="title">Site Settings</span>
                </a>
            </li>
            <?php endif?>
            <li class="opened">
                <a href="<?= site_url(ADMIN.'/settings/change') ?>">
                    <i class="fa fa-lock"></i>
                    <span class="title">Change Password</span>
                </a>
            </li>
        </ul>
    </div>
</div>