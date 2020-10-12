<!doctype html>
<html>
<head>
    <title>Dashboard - <?=$site_settings->site_name?></title>
    <?php $this->load->view('includes/site-master'); ?>
</head>
<body id="home-page">
    <?php $this->load->view('includes/header'); ?>


    <section id="dash">
        <div class="contain-fluid">
            <div class="lBar ease">
                <?php $this->load->view('includes/sidebar'); ?>
            </div>
            <div id="dashboard" class="inSide">
                <ul class="lessonLst flex">
                    <li>
                        <div class="miniBlk">
                            <div class="ico"><a href="?"><img src="<?= get_image_src($mem_data->mem_image,'150',true)?>" alt=""></a></div>
                            <div class="cntnt">
                                <h3>Jennifer K</h3>
                                <div class="subjId semi">Subject: <span>Mathematics</span></div>
                                <div class="status"><?= time_ago(1)?></div>
                                <div class="bTn"><button type="button" class="webBtn smBtn popBtn" data-popup="view-detail">view detail</button></div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="miniBlk">
                            <div class="ico"><a href="<?= site_url('transactions') ?>"><img src="<?= base_url('assets/images/users/2.jpg')?>" alt=""></a></div>
                            <div class="cntnt">
                                <h3>Shoemaker L</h3>
                                <div class="subjId semi">Subject: <span>Mathematics</span></div>
                                <div class="status">8 hours ago</div>
                                <div class="bTn"><button type="button" class="webBtn smBtn popBtn" data-popup="view-detail">view detail</button></div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="miniBlk">
                            <div class="ico"><a href="?"><img src="<?= base_url('assets/images/users/6.jpg')?>" alt=""></a></div>
                            <div class="cntnt">
                                <h3>James S</h3>
                                <div class="subjId semi">Subject: <span>Mathematics</span></div>
                                <div class="status">2 days ago</div>
                                <div class="bTn"><button type="button" class="webBtn smBtn popBtn" data-popup="view-detail">view detail</button></div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="miniBlk">
                            <div class="ico"><a href="?"><img src="<?= base_url('assets/images/users/7.jpg')?>" alt=""></a></div>
                            <div class="cntnt">
                                <h3>John W</h3>
                                <div class="subjId semi">Subject: <span>Mathematics</span></div>
                                <div class="status">7 days ago</div>
                                <div class="bTn"><button type="button" class="webBtn smBtn popBtn" data-popup="view-detail">view detail</button></div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="miniBlk">
                            <div class="ico"><a href="?"><img src="<?= base_url('assets/images/users/3.jpg')?>" alt=""></a></div>
                            <div class="cntnt">
                                <h3>Lachinet D</h3>
                                <div class="subjId semi">Subject: <span>Mathematics</span></div>
                                <div class="status">1 month ago</div>
                                <div class="bTn"><button type="button" class="webBtn smBtn popBtn" data-popup="view-detail">view detail</button></div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="miniBlk">
                            <div class="ico"><a href="?"><img src="<?= base_url('assets/images/users/2.jpg')?>" alt=""></a></div>
                            <div class="cntnt">
                                <h3>Kristofer X</h3>
                                <div class="subjId semi">Subject: <span>Mathematics</span></div>
                                <div class="status">2 months ago</div>
                                <div class="bTn"><button type="button" class="webBtn smBtn popBtn" data-popup="view-detail">view detail</button></div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="miniBlk">
                            <div class="ico"><a href="?"><img src="<?= base_url('assets/images/users/5.jpg')?>" alt=""></a></div>
                            <div class="cntnt">
                                <h3>Jennifer K</h3>
                                <div class="subjId semi">Subject: <span>Mathematics</span></div>
                                <div class="status">2 months ago</div>
                                <div class="bTn"><button type="button" class="webBtn smBtn popBtn" data-popup="view-detail">view detail</button></div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="miniBlk">
                            <div class="ico"><a href="?"><img src="<?= base_url('assets/images/users/4.jpg')?>" alt=""></a></div>
                            <div class="cntnt">
                                <h3>Shoemaker H</h3>
                                <div class="subjId semi">Subject: <span>Mathematics</span></div>
                                <div class="status">2 months ago</div>
                                <div class="bTn"><button type="button" class="webBtn smBtn popBtn" data-popup="view-detail">view detail</button></div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="miniBlk">
                            <div class="ico"><a href="?"><img src="<?= base_url('assets/images/users/7.jpg')?>" alt=""></a></div>
                            <div class="cntnt">
                                <h3>Johny S</h3>
                                <div class="subjId semi">Subject: <span>Mathematics</span></div>
                                <div class="status">2 months ago</div>
                                <div class="bTn"><button type="button" class="webBtn smBtn popBtn" data-popup="view-detail">view detail</button></div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="miniBlk">
                            <div class="ico"><a href="?"><img src="<?= base_url('assets/images/users/2.jpg')?>" alt=""></a></div>
                            <div class="cntnt">
                                <h3>John W</h3>
                                <div class="subjId semi">Subject: <span>Mathematics</span></div>
                                <div class="status">3 months ago</div>
                                <div class="bTn"><button type="button" class="webBtn smBtn popBtn" data-popup="view-detail">view detail</button></div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="miniBlk">
                            <div class="ico"><a href="?"><img src="<?= base_url('assets/images/users/5.jpg')?>" alt=""></a></div>
                            <div class="cntnt">
                                <h3>Lachinet F</h3>
                                <div class="subjId semi">Subject: <span>Mathematics</span></div>
                                <div class="status">3 months ago</div>
                                <div class="bTn"><button type="button" class="webBtn smBtn popBtn" data-popup="view-detail">view detail</button></div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="miniBlk">
                            <div class="ico"><a href="?"><img src="<?= base_url('assets/images/users/6.jpg')?>" alt=""></a></div>
                            <div class="cntnt">
                                <h3>Kristofer S</h3>
                                <div class="subjId semi">Subject: <span>Mathematics</span></div>
                                <div class="status">5 months ago</div>
                                <div class="bTn"><button type="button" class="webBtn smBtn popBtn" data-popup="view-detail">view detail</button></div>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="popup" data-popup="view-detail">
                    <div class="tableDv">
                        <div class="tableCell">
                            <div class="contain">
                                <div class="_inner">
                                    <div class="crosBtn"></div>
                                    <h3>Lesson Detail</h3>
                                    <ul class="list">
                                        <li><strong>Name:</strong><span>Jennifer K</span></li>
                                        <li><strong>Subject:</strong><span>Algebra</span></li>
                                        <li><strong>Hours:</strong><span>2 Hours</span></li>
                                        <li><strong>Budget:</strong><span>$20</span></li>
                                        <li><strong>Detail:</strong><span>I have been a professional model since I was 16 years old. I have done both paid and charity work. I have done a variety of different styles of photo shoots, promotional and runway events.</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- <ul class="tileBlk flex text-center">
                <li>
                    <div class="inner">
                        <div class="ico"><i class="fi-webpage"></i></div>
                        <h4>Dashboard</h4>
                        <a href="dashboard.php"></a>
                    </div>
                </li>
                <li>
                    <div class="inner">
                        <div class="ico"><i class="fi-bell"></i></div>
                        <h4>Notifications</h4>
                        <a href="notifications.php"></a>
                    </div>
                </li>
                <li>
                    <div class="inner">
                        <div class="ico"><i class="fi-list"></i></div>
                        <h4>Lesson Requests</h4>
                        <a href="lesson-requests.php"></a>
                    </div>
                </li>
                <li>
                    <div class="inner">
                        <div class="ico"><i class="fi-layers"></i></div>
                        <h4>My Lessons</h4>
                        <a href="my-lessons.php"></a>
                    </div>
                </li>
                <li>
                    <div class="inner">
                        <div class="ico"><i class="fi-exchange"></i></div>
                        <h4>Transactions</h4>
                        <a href="transactions.php"></a>
                    </div>
                </li>
                <li>
                    <div class="inner">
                        <div class="ico"><i class="fi-credit-card"></i></div>
                        <h4>Payment Method</h4>
                        <a href="payment-method.php"></a>
                    </div>
                </li>
                <li>
                    <div class="inner">
                        <div class="ico"><i class="fi-users"></i></div>
                        <h4>Invite a Friend</h4>
                        <a href="invite-friend.php"></a>
                    </div>
                </li>
                <li>
                    <div class="inner">
                        <div class="ico"><i class="fi-cog"></i></div>
                        <h4>Account Settings</h4>
                        <a href="account-settings.php"></a>
                    </div>
                </li>
            </ul> -->
        </div>
    </div>
</section>
<!-- dash -->


<?php $this->load->view('includes/footer');?>
</body>
</html>