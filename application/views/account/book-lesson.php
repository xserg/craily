<!doctype html>
<html>

<head>
    <title>Book Lesson - <?= $site_settings->site_name ?></title>
    <?php $this->load->view('includes/site-master'); ?>
    <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmqmsf3pVEVUoGAmwerePWzjUClvYUtwM&libraries=geometry,places&ext=.js"></script> -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmqmsf3pVEVUoGAmwerePWzjUClvYUtwM&libraries=places"></script>
</head>

<body id="home-page">
    <?php $this->load->view('includes/header'); ?>


    <section id="sBanner">
        <div class="contain">
            <div class="content">
                <h1>Book Lesson</h1>
                <!-- <ul>
                <li><a href="index.php">Home</a></li>
                <li>Book Lesson</li>
            </ul> -->
            </div>
        </div>
    </section>
    <!-- sBanner -->


    <section id="bookLeson">
        <div class="contain">
            <form action="" method="post" autocomplete="off" id="frmBkLsn" class="frmAjax">
                <div class="formBlk">
                    <div class="blk">
                        <div class="_header">
                            <h3>New Lesson</h3>
                        </div>
                        <div class="row formRow">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                <select name="subject" id="subject" class="txtBox selectpicker" data-live-search="true" title="Select your subject">
                                    <option value="">Select your subject</option>
                                    <?php foreach ($subjects as $subject) : ?>
                                        <option value="<?= $subject->id ?>"><?= str_replace('_', ' ', $subject->name) ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                <input type="text" name="date" id="date" class="txtBox datepicker" <?= $not_avail_days == '' ? '' : ' data-date-days-of-week-disabled="' . $not_avail_days . '"' ?> data-date-start-date="0d" placeholder="Date" readonly="">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                <input type="text" name="time" id="time" class="txtBox timepicker" placeholder="Time">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                <select name="hours" id="hours" class="txtBox selectpicker" title="How many hours?">
                                    <option value="" readonly>How many hours?</option>
                                    <?php for ($i = 0; $i <= 4; $i++) : ?>
                                        <?php if ($i > 0) : ?>
                                            <option value="<?= $i ?>"><?= $i . ' ' ?><?= ($i > 1) ? "hours" : "hour" ?></option>
                                        <?php endif ?>
                                        <?php if ($i < 4) : ?>
                                            <option value="<?= $i ?>.5"><?= ($i > 0) ? $i . ' ' : '' ?><?= ($i > 0) ? (($i > 1) ? "hours " : "hour ") : '' ?>30 minutes</option>
                                        <?php endif ?>
                                    <?php endfor ?>
                                </select>
                                <!-- <input type="text" name="hours" id="hours" class="txtBox" placeholder="How many hours?"> -->
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                <select name="lesson_type" id="lesson_type" class="txtBox selectpicker" title="Lesson type">
                                    <option value="">Lesson type</option>
                                    <option value="In Person">In Person</option>
                                    <option value="Online">Online</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                <input type="text" name="address" id="txtAddress" class="txtBox" placeholder="Address" autocomplete="off" disabled="">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xx-12 txtGrp">
                                <textarea id="detail" name="detail" class="txtBox" style="height: 75px" placeholder="Details (optional)"></textarea>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xx-12 txtGrp">
                                <small>*Lesson booking time is in <i><b>America/Los_Angeles</b></i> time that is <i><b>PDT</b></i> time. Kindly book lesson according to this time.</small>
                                <div>
                                    <small>Lesson Booking Time:</small>
                                    <span id="systemTime"></span>
                                </div>
                                <div>
                                    <small>Your Current Time:</small>
                                    <span id="userTime"></span>
                                </div>
                            </div>
                        </div>
                        <div class="bTn text-center">
                            <button type="submit" class="webBtn colorBtn">Request Lesson <i class="fa-spinner hidden"></i></button>
                        </div>
                        <div class="alertMsg"></div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- bookLeson -->


    <?php $this->load->view('includes/footer'); ?>
    <script type="text/javascript">
        $(function() {
            $(document).on('change', '#lesson_type', function() {
                var v = $(this).val()
                if (v == 'Online')
                    $('#txtAddress').attr('disabled', true).parent('div').addClass('hidden')
                else
                    $('#txtAddress').attr('disabled', false).parent('div').removeClass('hidden')
            });

            setInterval(() => {
                var defaultTime = new Date().toLocaleString('en-US', {
                    timeZone: 'America/Los_Angeles'
                });
                var date = new Date().toLocaleString('en-US');

                $('#systemTime').text(defaultTime);
                $('#userTime').text(date);
            }, 1000);
        })

        function initialize() {
            var input = document.getElementById('txtAddress');
            input.removeAttribute('disabled')
            google.maps.event.addDomListener(input, 'keydown', function(e) {
                if (e.keyCode == 13 && $('.pac-container:visible').length) {
                    e.preventDefault();
                }
            });
            var autocomplete = new google.maps.places.Autocomplete(input);
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
</body>

</html>