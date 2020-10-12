<!-- footer section -->
<div class="footer_section">
    <div class="footer_left"><img src="<?= base_url('assets/images/logo-line.png') ?>" alt=""></div>
        <div class="footer_center">
            <ul>                                       
                <li><a href="<?= site_url('faq')?>">FAQ</a></li>
                <li><a href="<?= site_url('tutor-signup')?>">Become a Tutor </a></li>
                <li><a href="<?= site_url('privacy-policy')?>">Privacy Policy</a></li>
                <li><a href="<?= site_url('terms-services')?>">Terms of Service</a></li>
                <li><a href="<?= site_url('contact-us')?>">Contact Us</a></li>
            </ul>
        </div>
    <div class="footer_right">
        <ul>       
            <li><a href="https://www.facebook.com/crainly"  target="_blank"><img src="<?= base_url('assets/images/facebook-icon.png') ?>"><!-- <i class="fa fa-facebook-f"></i> --></a></li>
            <li><a href="http://www.instagram.com/crainly_"  target="_blank"><img src="<?= base_url('assets/images/instagram-icon.png') ?>"><!-- <i class="fa fa-instagram"></i> --></a></li>
            <li><a href="https://twitter.com/crainly" target="_blank"><img src="<?= base_url('assets/images/twitter-icon.png') ?>"><!-- <i class="fa fa-twitter"></i> --></a></li>       
        </ul>
    </div>
    <div class="copyright text-center">
        <p>© <?= date('Y')?> <a href="<?= site_url()?>">Crainly</a></p>
    </div>
</div>
<!-- footer -->

<!-- Main Js -->
<script type="text/javascript" src="<?= base_url('assets/js/main.js?v-'.$site_settings->site_version)?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/custom-validation.js?v-'.$site_settings->site_version) ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/custom.js?v-'.$site_settings->site_version) ?>"></script>