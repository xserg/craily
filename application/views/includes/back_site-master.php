<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="description" content="<?=$site_settings->site_meta_desc?>">
<meta name="keywords" content="<?=$site_settings->site_meta_keyword?>">
<!-- Css files -->
<!-- Bootstrap Css -->
<link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css?v-'.$site_settings->site_version)?>">
<!-- Main Css -->
<link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/mycss.css?v-'.$site_settings->site_version)?>">
<!-- Custom Css -->
<link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/custom.css?v-'.$site_settings->site_version)?>">
<!-- Media-Query Css -->
<link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/responsive.css?v-'.$site_settings->site_version)?>">
<!-- Font-Awesome Css -->
<link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/font-awesome.min.css?v-'.$site_settings->site_version)?>">
<!-- Font-Icon Css -->
<link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/font-icon.min.css?v-'.$site_settings->site_version)?>">
<!-- Datepicker Css -->
<link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/datepicker.min.css?v-'.$site_settings->site_version)?>">
<!-- Timepicker Css -->
<link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/timepicker.min.css?v-'.$site_settings->site_version)?>">
<!-- Select Css -->
<link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/select.min.css?v-'.$site_settings->site_version)?>">
<!-- Owl Carousel Css -->
<link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/owl.carousel.min.css?v-'.$site_settings->site_version)?>">
<!-- Owl Theme Css -->
<link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/owl.theme.min.css?v-'.$site_settings->site_version)?>">
<!-- Data Table Css -->
<link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/datatables.min.css?v-'.$site_settings->site_version)?>">
<!-- Data Table Responsive Css -->
<link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/datatables-responsive.min.css?v-'.$site_settings->site_version)?>">
<!-- Switcher Css -->
<link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/switcher.css?v-'.$site_settings->site_version)?>">
<!-- Telphone Css -->
<link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/intlTelInput.css?v-'.$site_settings->site_version)?>">



<!-- JS Files -->
<script type="text/javascript" src="<?= base_url('assets/js/jquery.min.js?v-'.$site_settings->site_version)?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/bootstrap.min.js?v-'.$site_settings->site_version)?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/jquery-ui.min.js?v-'.$site_settings->site_version)?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript"> var base_url = "<?= base_url()?>";</script>
<!-- Datepicker Js -->
<script type="text/javascript" src="<?= base_url('assets/js/datepicker.min.js') ?>"></script>
<script type="text/javascript">
    $(window).on('load', function() {
        $('.datepicker').datepicker({
            // multidate: true,
            // format: 'mm-dd-yyyy',
            format: 'mm/dd/yyyy',
            autoclose: true,
            todayHighlight: true,
            // multidateSeparator: ',  ',
            templates : {
                leftArrow: '<i class="fi-arrow-left"></i>',
                rightArrow: '<i class="fi-arrow-right"></i>'
            }
        });
    });
</script>
<!-- <script type="text/javascript">
    $(document).ready(function () {
        $('.datepicker').datepicker({
            dateFormat: 'MM dd, yy',
            changeMonth: true,
            changeYear: true,
            yearRange: '1900:2060'
        });
    });
</script> -->
<!-- Timepicker Js -->
<script type="text/javascript" src="<?= base_url('assets/js/timepicker.min.js?v-'.$site_settings->site_version)?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.timepicker').timepicki({
            reset: true,
            step_size_minutes: 15,
            overflow_minutes:true,
            start_time: ["12", "00", "AM"],
            disable_keyboard_mobile: true
        });
    });
</script>
<!-- Select Js -->
<script type="text/javascript" src="<?= base_url('assets/js/select.min.js?v-'.$site_settings->site_version)?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.selectpicker').selectpicker();
    });
</script>
<!-- Owl Carousel Js -->
<script type="text/javascript" src="<?= base_url('assets/js/owl.carousel.min.js?v-'.$site_settings->site_version)?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#owl-partner').owlCarousel({
            autoplay: true,
            nav: true,
            navText: ['<i class="fi-chevron-left"></i>','<i class="fi-chevron-right"></i>'],
            dots: false,
            loop: true,
            smartSpeed: 1000,
            autoplayTimeout: 8000,
            autoplayHoverPause: true,
            autoWidth: true,
            margin: 20,
            responsive: {
                0:{
                    items: 1
                },
                480:{
                    items: 2
                },
                767:{
                    items: 3
                },
                991:{
                    items: 4
                },
                1200:{
                    items: 5
                }
            }
        });
        $('#owl-testimonial').owlCarousel({
            autoplay: true,
            dots: false,
            loop: true,
            margin: 60,
            smartSpeed: 1000,
            autoplayTimeout: 10000,
            autoplayHoverPause: true,
            responsive: {
                0:{
                    items: 1,
                    autoplay: false,
                    autoHeight: true,
                    dots: true
                },
                600:{
                    items: 2
                },
                1000:{
                    items: 3
                }
            }
        });
        $('#owl-students').owlCarousel({
            autoplay: true,
            dots: false,
            loop: true,
            center: true,
            autoWidth: true,
            autoHeight: true,
            smartSpeed: 1000,
            autoplayTimeout: 10000,
            autoplayHoverPause: true,
            responsive: {
                0:{
                    items: 1,
                    autoplay: false,
                    autoHeight: true,
                    dots: true
                },
                600:{
                    items: 2
                },
                1000:{
                    items: 3
                }
            }
        });
        $('#owl-cards').owlCarousel({
            autoplay: true,
            dots: false,
            loop: true,
            smartSpeed: 1000,
            autoplayTimeout: 8000,
            autoplayHoverPause: true,
            responsive: {
                0:{
                    items: 1,
                    autoplay: false,
                    dots: true
                },
                480:{
                    items: 2
                },
                991:{
                    items: 3
                },
                1200:{
                    items: 4
                }
            }
        });
    });
</script>
<!-- Data Table Js -->
<script type="text/javascript" src="<?= base_url('assets/js/moments.js')?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/datatables.min.js?v-'.$site_settings->site_version)?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/datatables-responsive.min.js?v-'.$site_settings->site_version)?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var sortOrder = ($('th.sortBy').index()>-1)?$('th.sortBy').index():0;
        var emptyMsg = ($('.dataTable').data('msg'))?$('.dataTable').data('msg'):"No data available in table";
        $('.dataTable').DataTable({
            "language": {
                "emptyTable": emptyMsg
            },
            'order': [[
            sortOrder, 'asc'
            ]],
            'pageLength': 25,
            columnDefs: [{
                orderable: false,
                targets: 'no-sort'
            }],
            responsive: true
        });
    });
</script>
<!-- Rateyo Js -->
<script type="text/javascript" src="<?= base_url('assets/js/jquery.rateyo.min.js?v-'.$site_settings->site_version)?>"></script>
<script type="text/javascript">
    $(function(){
        $('.rateYo').rateYo({
            fullStar: true,
            normalFill: '#ddd',
            ratedFill: '#f6a623',
            starWidth: '14px',
            spacing: '2px'
        });
    });
</script>
<!-- Telphone Js -->
<script type="text/javascript" src="<?= base_url('assets/js/intlTelInput.js?v-'.$site_settings->site_version)?>"></script>

<!-- Favicon -->
<link type="image/png" rel="icon" href="<?= base_url('assets/images/favicon.png?v-'.$site_settings->site_version)?>">
