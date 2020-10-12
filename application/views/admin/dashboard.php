
<div class="row">
    <?php if(access(1)):?>
    <div class="col-md-3 col-sm-3 col-xs-6">
        <a href="<?= site_url(ADMIN.'/students') ?>">
            <div class="tile-stats tile-white">
                <div class="icon"><i class="entypo-user"></i></div>
                <div class="num" data-start="0" data-end="<?=$total_students?>" data-postfix="" data-duration="1500" data-delay="0"><?=$total_students?></div>
                <h3>Total Students </h3>
                <p>Total Students in our website </p>
            </div>
        </a>
    </div>
    <?php endif?>
    <?php if(access(2)):?>
    <div class="col-md-3 col-sm-3 col-xs-6">
        <a href="<?= site_url(ADMIN.'/tutors') ?>">
            <div class="tile-stats tile-green">
                <div class="icon"><i class="entypo-user"></i></div>
                <div class="num" data-start="0" data-end="<?=$total_tutors?>" data-postfix="" data-duration="1500" data-delay="0"><?=$total_tutors?></div>
                <h3>Total Tutors </h3>
                <p>Total Tutors in our website </p>
            </div>
        </a>
    </div>
    <?php endif?>
    <?php if(is_admin()):?>
    <div class="col-md-3 col-sm-3 col-xs-6">
        <a href="<?= site_url(ADMIN.'/subjects') ?>">
            <div class="tile-stats tile-blue">
                <div class="icon"><i class="entypo-book"></i></div>
                <div class="num" data-start="0" data-end="<?=$total_subjects?>" data-postfix="" data-duration="1500" data-delay="0"><?=$total_subjects?></div>
                <h3>Total Subjects </h3>
                <p>Total Subjects in our website </p>
            </div>
        </a>
    </div>
    <?php endif?>
    <?php if(is_admin()):?>
    <div class="col-md-3 col-sm-3 col-xs-6">
        <a href="<?= site_url(ADMIN.'/settings') ?>">
            <div class="tile-stats tile-black">
                <div class="icon"><i class="fa fa-cogs"></i></div>
                <div class="num" data-start="0" data-end="0" data-postfix="" data-duration="1500" data-delay="1800"> Settings</div>

                <h3>Change Settings</h3>
                <p>on our site right now.</p>
            </div>
        </a>		
    </div>
    <?php endif?>
</div>
