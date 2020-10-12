<!doctype html>
<html>
<head>
    <title>Become a Tutor - <?=$site_settings->site_name?></title>
    <?php $this->load->view('includes/site-master'); ?>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmqmsf3pVEVUoGAmwerePWzjUClvYUtwM&libraries=geometry,places&ext=.js"></script>
</head>
<body id="home-page">
    <?php $this->load->view('includes/header'); ?>


    <section id="sBanner">
        <div class="contain">
            <div class="content">
                <h1>Become our Tutor</h1>
                <ul>
                    <li><a href="<?= site_url()?>">Home</a></li>
                    <li>Become a Tutor</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- sBanner -->


    <section id="beTutor">
        <div class="contain">
            <form action="" method="post" autocomplete="off" class="frmAjax" id="becameTutor">
                <fieldset>
                    <div class="formBlk">
                        <div class="blk">
                            <div class="_header">
                                <h3>Personal Info</h3>
                            </div>
                            <div class="row formRow">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                    <input type="text" name="fname" id="fname" value="<?= ($mem_data->mem_fname?$mem_data->mem_fname:'')?>" class="txtBox shwFld" placeholder="First Name" autofocus>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                    <input type="text" name="lname" id="lname" value="<?= ($mem_data->mem_lname?$mem_data->mem_lname:'')?>" class="txtBox shwFld" placeholder="Last Name">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                    <input type="text" id="email" name="email" class="txtBox shwFld" value="<?= $mem_data->mem_email?$mem_data->mem_email:''?>" placeholder="Email Address">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                    <!-- <input type="text" name="phone" id="phone" class="txtBox shwFld" value="<?= $mem_data->mem_phone?$mem_data->mem_phone:''?>" placeholder="Phone">  -->
                                    <div class="verifyBlk">
                                        <input type="text" name="phone" id="phone" class="txtBox shwFld" value="<?= $mem_data->mem_phone?$mem_data->mem_phone:''?>" placeholder="Phone">
                                        <?php if (!empty($mem_data->mem_phone) && !empty($mem_data->mem_verified)): ?>
                                        <a href="javascript:void(0)" class="fi fi-check"></a>
                                    <?php endif ?>
                                </div>
                                <div class="invald hide" id="phnMsg"></div>
                            </div>
                        </div>
                        <div class="bTn text-center">
                            <button type="button" class="webBtn colorBtn nextBtn hidden" id="fstBtn">Next</button>
                        </div>
                    </div>
                </div>
            </fieldset>
            <!-- <fieldset>
                <div class="formBlk">
                    <div class="blk">
                        <div class="_header">
                            <h3>Phone verify</h3>
                        </div>
                        <ul class="phoneLst">
                            <?php for($i=0;$i<6;$i++):?> 
                                <li>
                                    <input type="text" name="code[<?=$i?>]" maxlength="1" class="txtBox arrFld" placeholder="">
                                </li>
                            <?php endfor?>
                        </ul>
                        <div class="bTn text-center">
                            <button type="button" class="webBtn prevBtn">Back</button>
                            <button type="button" class="webBtn colorBtn nextBtn">Verify</button>
                        </div>
                    </div>
                </div>
            </fieldset> -->
            <fieldset>
                <div class="formBlk">
                    <div class="blk">
                        <div class="_header">
                            <h3>Education Background</h3>
                        </div>
                        <div class="row formRow">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 col-xx-12 txtGrp">
                                <select name="subject" id="subject" class="txtBox selectpicker" data-live-search="true" placeholder="Subject">
                                    <option value="">Select your subject</option>
                                    <?= get_subjects(0,0,true,'id',$tutor_main_subject->subject_id);?>
                                </select>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xx-12 txtGrp">
                                <div class="appLoad" style="display: none;">
                                    <div class="appLoader"><span class="spiner"></span></div>
                                </div>
                                <ul class="subjLst flex">
                                </ul>
                            </div>
                        </div>
                        <div class="bTn text-center">
                            <button type="button" class="webBtn prevBtn">Back</button>
                            <button type="button" id="btnSbFld" class="webBtn colorBtn nextBtn hidden">Next</button>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="formBlk">
                    <div class="blk">
                        <div class="_header">
                            <h3>Additional Info</h3>
                        </div>
                        <div class="row formRow">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                <input type="text" name="hourly_rate" id="hourly_rate" class="txtBox shwFld" placeholder="Hourly Rate $">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                <input type="text" name="school_name" id="school_name" class="txtBox shwFld" placeholder="School Name">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                <input type="text" name="major_subject" id="major_subject" class="txtBox shwFld" placeholder="Major Subject">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                <input type="text" name="graduation_year" id="graduation_year" class="txtBox shwFld" placeholder="Graduation Year">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                <input type="text" name="travel_radius" id="travel_radius" class="txtBox shwFld" placeholder="Travel Radius(Miles)">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                <input type="text" id="dob" name="dob" class="txtBox datepicker shwFld" data-date-end-date="-0d" value="" placeholder="Date of birth">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                <input type="text" id="zip" name="zip" class="txtBox shwFld" value="" placeholder="Zip Code">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                <input type="text" id="address" name="address" class="txtBox shwFld" value="<?= $mem_data->mem_address1?$mem_data->mem_address1:''?>" placeholder="Address">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                <input type="text" name="referral_code" id="referral_code" class="txtBox shwFld" placeholder="Referral code">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                <input type="text" name="hear_about" id="hear_about" class="txtBox shwFld" placeholder="Where did you hear about us?">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xx-12 txtGrp">
                                <div id="map-canvas" class="googleMap" style=""></div>
                                <input type="hidden" name="map_lat" id="ad_map_lat" value="">
                                <input type="hidden" name="map_lng" id="ad_map_lng" value="">
                            </div>
                        </div>
                        <div class="bTn text-center">
                            <button type="button" class="webBtn prevBtn">Back</button>
                            <button type="button" class="webBtn colorBtn nextBtn">Next</button>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="formBlk">
                    <div class="blk">
                        <div class="_header">
                            <h3>Profile Info</h3>
                        </div>
                        <div class="row formRow">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xx-12 txtGrp">
                                <div class="proDp ico">
                                    <img src="<?= get_image_src($mem_data->mem_image,'300',true)?>" alt="" id="userImage">
                                    <div class="icoMask uploadImg" id="uploadDp" data-image-src="dp">
                                        <i class="fi-camera"></i> choose <br> image
                                    </div>
                                </div>
                                <div class="noHats text-center">(Please upload your photo, no hats and sunglasses)</div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xx-12 txtGrp">
                                <input type="text" name="profile_heading" id="profile_heading" class="txtBox shwFld" value="" placeholder="Profile Headline">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xx-12 txtGrp">
                                <textarea name="profile_bio" id="profile_bio" class="txtBox shwFld" placeholder="Profile Bio"></textarea>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xx-12 txtGrp">
                                <div class="lblBtn">
                                    <input type="checkbox" name="confirm" id="confirm">
                                    <label for="confirm">By signing up, I agree to Crainly
                                        <a href="<?= site_url('terms-services')?>">Term's of Services,</a>
                                        and
                                        <a href="<?= site_url('privacy-policy')?>">Privacy Policy.</a>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="bTn text-center">
                            <button type="button" class="webBtn prevBtn">Back</button>
                            <button type="button" class="webBtn colorBtn nextBtn">Next</button>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="formBlk">
                    <div class="blk">
                        <div class="_header">
                            <h3>Tutor Info</h3>
                        </div>
                        <div class="content">
                            <ul class="list" id="ttrInf">
                            </ul>
                        </div>
                        <input type="file" name="image" class="tutorImg" data-file="" accept="image/*">
                        <div class="bTn text-center">
                            <button type="button" class="webBtn prevBtn">Back</button>
                            <button type="submit" class="webBtn colorBtn">Submit <i class="fa fa-spinner fa-pulse fa-1x fa-fw hidden"></i></button>     
                        </div>
                        <div class="alertMsg" style="display:none"></div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</section>
<!-- beTutor -->


<script type="text/javascript">
    // for load
    var $grid;
</script>
<script type="text/javascript" src="<?= base_url('assets/js/additional-methods.js')?>"></script>
<?php $this->load->view('includes/footer'); ?>
<!-- Editor Js -->
<script type="text/javascript" src="<?= base_url('assets/js/ckeditor.js')?>"></script>
<script type="text/javascript">
    $(function(){
        $('#fstBtn').removeClass('hidden');

        $(window).keydown(function(event){
            if(event.keyCode == 13) {
                event.preventDefault();
                $(event.target).parents("fieldset").find(".nextBtn").trigger("click");
                return false;
            }
            /*else if(event.keyCode == 8) {
                event.preventDefault();
                $(event.target).parents("fieldset").find('.prevBtn').trigger("click");
                return false;
            }*/
        });

        /*let editor;
        ClassicEditor
        .create(document.querySelector('#profile_bio'), {
            ckfinder: {
            }
        })
        .then(newEditor => {
            editor = newEditor;
        })
        .catch(error => {
            console.error(error);
        });*/

        $(document).on('click', '#profileSet .dayLst li .switchBtn', function(){
            if($(this).children('input[type="checkbox"]').is(':checked')){
                $(this).parents('.inner').removeClass('notAvail');
                $(this).parents('.inner').find('input[type="text"]').attr('disabled',false);
            } else{
                $(this).parents('.inner').addClass('notAvail');
                $(this).parents('.inner').find('input[type="text"]').attr('disabled',true);
            }
        });

        $('#subject').change(function(){
            var subject=this.value;
            $("ul.subjLst").html('').hide();
            $('.appLoad').fadeIn();
            $.ajax({
                url: base_url+'ajax/get-subjects',
                data : {'subject':subject},
                method: 'POST',
                dataType: 'json',
                success: function (data) {
                    if(data.option!='')
                        $('ul.subjLst').html(data.option);
                },
                complete: function(){
                    setTimeout(function(){
                        $('.appLoad').fadeOut();
                        $('ul.subjLst').show('slow');
                        $('#btnSbFld').removeClass('hidden');
                    },1500)
                }
            })
        })
        <?php if($tutor_main_subject->subject_id>0):?>
            $('#subject').trigger('change');
        <?php endif?>
        $(document).on('input','input[name^=code]:last',function(e){
            $(this).parents('form#frmPhonevld').submit()
        })
        $(document).on('click','div.showCode>a',function(e){
            e.preventDefault();
            $('.crosBtn').click();
            $('#phone').focus();
            $(this).slideUp();
        })
        /*$(document).on('click','a.vrfPhn',function(e){
            var phone='<?= $mem_data->mem_phone?>';
            e.preventDefault()
            if(phone!==$('#phone').val()){
                alert('Please save Phone number before going to verify!');
                $('#phone').focus();
                return false;
            }
            if(confirm("To make sure that "+phone+" is yours, Crainly is going to send you a text message with a 6-digit verification code.")){

                $.ajax({
                    url: base_url+'verify-phone-code',
                    data : {'cmd':'send-code'},
                    dataType: 'JSON',
                    method: 'POST',
                    success: function (rs) {
                        if(rs.status===1){
                            $('body').addClass('flow');
                            $(".popup[data-popup='verify-phone']").fadeIn().find('input:first').focus().end().find('form').get(0).reset();
                            setTimeout(function(){
                                $('#frmPhonevld div.showCode').slideDown();
                            },60000)
                        }
                        else
                            alert('Something went wrong!')
                    },
                    complete: function(){}
                })
            }
        })*/

        $('.nextBtn').click(function() {
            if($('#becameTutor').valid()){
                currStep = $(this).parents('fieldset');
                nextStep = currStep.next('fieldset');
                currStep.hide();
                nextStep.fadeIn();
                nextStep.find('input:first').focus();
            }
        });
        $('.prevBtn').click(function() {
            currStep = $(this).parents('fieldset');
            prevStep = currStep.prev('fieldset');
            currStep.hide();
            prevStep.fadeIn();
            prevStep.find('input:first').focus();
        });

        $(document).on('click',"button[type='button'].nextBtn:last()",function(){
            $('#ttrInf').html('');
            $('input[type="text"].shwFld').each(function(i,obj){
                var fld_name=$(this).attr('placeholder');
                var fld_val=$(this).val()
                $('#ttrInf').append('<li><strong>'+fld_name+':</strong><span>'+fld_val+'</span></li>');
            })
            $('#ttrInf').append('<li><strong>'+$('textarea.shwFld').attr('placeholder')+':</strong><span>'+($('textarea.shwFld').val())+'</span></li>');
            // $('#ttrInf').append('<li><strong>'+$('textarea.shwFld').attr('placeholder')+':</strong><span>'+(editor.getData())+'</span></li>');
        })
    })


var map, bounds, startLat = 37.0902, startLng = 95.7129;
var haveGeoLocation = true;
var startLatLng = null;
var startLatLng = new google.maps.LatLng(startLat, startLng);

if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function (position) {
            // $('.searchInputMarker').addClass('active');
            oldLat = startLat;
            oldLng = startLng;
            startLat = position.coords.latitude;
            startLng = position.coords.longitude;
            //console.log('Your latitude is :' + startLat + ' and longitude is ' + startLng);
            startLatLng = new google.maps.LatLng(startLat, startLng);
            // map.setCenter(startLatLng);
            // map.setZoom(12);
            init();
        }, function () {
            // Do Nothing
        });
}

function init() {
    map = new google.maps.Map(document.getElementById('map-canvas'), {
        center: startLatLng,
        zoom: 8
    });
    bounds = new google.maps.LatLngBounds();
    var user_icon = {
                url: base_url+"/assets/images/user_marker.png", // url
                scaledSize: new google.maps.Size(50, 50), // scaled size
                origin: new google.maps.Point(0, 0), // origin
                anchor: new google.maps.Point(25, 50) // anchor
            };
            searchAreaMarker = new google.maps.Marker({
                position: startLatLng,
                map: map,
                draggable: true,
                icon: user_icon,
                animation: google.maps.Animation.DROP,
                title: 'My Location'
            });

            $('#ad_map_lat').val(startLat);
            $('#ad_map_lng').val(startLng);
        // searchLocation();
    }
    
    google.maps.event.addDomListener(window, 'load', init);

    
</script>
</body>
</html>