<!doctype html>
<html>
<head>
    <title><?= $site_content['page_title']?> - <?=$site_settings->site_name?></title>
    <?php $this->load->view('includes/site-master'); ?>
  
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/css/bootstrap-slider.css" rel="stylesheet" />
	
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/bootstrap-slider.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmqmsf3pVEVUoGAmwerePWzjUClvYUtwM&libraries=geometry,places&ext=.js"></script>
</head>
<body id="home-page">
    <?php $this->load->view('includes/header'); ?>

    <section id="sBanner" style="display:none">
        <div class="contain">
            <div class="content">
                <h1><?= $site_content['heading']?></h1>
                <p><?= $site_content['description']?></p>
                <ul>
                    <li><a href="<?= site_url()?>">Home</a></li>
                    <li><?= $site_content['page_title']?></li>
                </ul>
            </div>
        </div>
    </section>
    <!-- sBanner -->


    <section id="search" style="margin-top:15px">
        <div id="layer"></div>
        <div class="circleBtn">
            <a href="javascript:void(0)" id="rsltBtn" class="webBtn">Result</a>
            <a href="javascript:void(0)" id="fltrBtn" class="webBtn">Filter</a>
        </div>
<!-- Filters  -->
<!-- !Filters -->
        <div class="contain">
            <div class="flexRow flex">
               
                <div class="col col2">
                    <form action="" method="post" class="srchBar" id="manualSearch">
                        <ul class="srchLst relative">
<!--                            <li class="autoBox1">-->
                            <li>                            
                                <label for="subject">Subject</label>
                               <!-- <a data-toggle="collapse" href="#filter-options" role="button" aria-expanded="false" aria-controls="filter-options">
                                    <label >Enter a subject</label>
                                </a>	-->						
<!--                              <select class="auto-subject txtBox" id="subject" name="subject"></select>-->
                                <input type="text" name="subject" id="subject" class="txtBox autocomplete" data-from="search-subject" placeholder="Enter a subject">
                              <!--input type="text" name="subject" id="subject" class="txtBox" placeholder="Search Subject" value="<?= $get['subject']; ?>"-->
                            </li>
							<li class="dropdown">
								<label for="hourlyRate">Hourly Rate</label>
								<label class="dropdown-toggle hourly-rate-toggle" data-toggle="dropdown">$10 - $200</label>
                                <input type="hidden" name="hourlyRate" id="hourlyRate" class="txtBox autocomplete" data-from="search-hourlyRate">
                              <!--input type="text" name="subject" id="subject" class="txtBox" placeholder="Search Subject" value="<?= $get['hourlyRate']; ?>"-->
                                <div class="content inBlk dropdown-menu">
									<label for="hourly-rate">Hourly Rate: <span>$10 - $200</span></label>
									<input type="range" style="display: none !important;" min="10" max="200"  value="200" class="slider hourly-rate">
                                </div>
                            </li>
                            <li class="dropdown dis-dropdown">
								<label for="autocomplete">Zipcode</label>
								<!-- <label for="autocomplete" class="dropdown-toggle" data-toggle="dropdown">Select Distance</label> -->
                                <input type="text" name="zip" id="autocomplete" value="<?= $get['zip']; ?>" class="txtBox dropdown-toggle distance-toggle" data-toggle="dropdown" placeholder="Enter a Zip Code">
                                <input type="hidden" class="field" id="postal_code">
                                <!-- <div class="content inBlk inBlk-distance dropdown-menu">
									<label for="distance">Distance: <span>Within 20 miles</span></label>
									<input type="range" style="display: none !important;" min="0" max="40"  value="20" class="slider distance">
								</div> -->
                            </li>

                            <li><button type="button" class="webBtn colorBtn" onclick="return getsearch();"><i class="fi-search"></i></button></li>
                        </ul>
                    </form>
                  
<!--                     <div class="appLoad"><div class="appLoader"><span class="spiner"></span></div></div> -->
                   
                </div>
				 <div class="col col1">
				 
                    <div class="filterbox">
                      <div class="filter-btn">
                        <div class="select" href="#filter-options" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="filter-options" onClick="moreFiltersTrigger()">
							<a href="#filter-options">
                                <span><i class="fa fa-bars" aria-hidden="true"></i>&nbsp;More Filters</span>
                            </a>
                        </div>
                      </div>
                    </div>
                </div>
				<div class="col col2 collapse" id="filter-options">
				  <div class="card card-body">

				  <form action="" method="" id="searchForm">
					<input type="hidden" name="lat" id="map_lat">
					<input type="hidden" name="lng" id="map_lng">
					<input type="hidden" name="subject" value="">
					<input type="hidden" name="hourly_min" value="10">
					<input type="hidden" name="hourly_max" value="200">
					<input type="hidden" name="distance_min" value="0">
					<input type="hidden" name="distance_max" value="20">
					<input type="hidden" id="hiddenZip" name="zip" value="">
					<input type="hidden" name="sort" value="">
					<div class="col-lg-2 col-md-4 col-sm-12">
						<div class="inBlk">
							<h5>Lesson Type</h5>
							<ul class="ctgLst">
								<li>
									<input type="radio" id="lesson-person" name="lessontype" value="0" checked>
									<label for="lesson-person">In-person</label>
								</li>
								<li>
									<input type="radio" id="lesson-online" name="lessontype" value="1">
									<label for="lesson-online">Online</label>
								</li>
							</ul>

						</div>
					</div>
					<div class="col-lg-2 col-md-4 col-sm-12">
						<div class="inBlk">
							<h5>Availability</h5>
							<ul class="ctgLst">
								<li>
									<input type="checkbox" id="availAll" name="day" value="all" checked="">
									<label for="availAll">All / Any</label>
								</li>
								<?php $days=get_week_days()?>
								<?php foreach ($days as $day_key => $day): ?>
									<li>
										<input type="checkbox" id="avail<?= $day?>" name="days[]" value="<?= $day?>">
										<label for="avail<?= $day?>"><?= $day?></label>
									</li>
								<?php endforeach?>
							</ul>
						</div>
					</div>
					<div class="col-lg-3 col-md-4 col-sm-12">
						<div class="inBlk">
							<h5>Minimum level of Education</h5>
							<ul class="ctgLst">
								<li>
									<input type="radio" id="educationAny" name="education" value="all" checked="">
									<label for="educationAny">Any</label>
								</li>
								<?php $educations=educations()?>
								<?php foreach ($educations as $edu_key => $education): ?>
									<li>
										<input type="radio" id="education<?= $edu_key?>" name="education" value="<?= $edu_key?>">
										<label for="education<?= $edu_key?>"><?= $education?></label>
									</li>
								<?php endforeach?>
							</ul>
						</div>
					</div>
					<div class="col-lg-2 col-md-4 col-sm-12">
						<div class="inBlk">
							<h5>Gender</h5>
							<ul class="ctgLst" style="display: inline-grid;">
                                <li>
                                    <input type="radio" id="any_gender" name="gender" value="all" checked="">
                                    <label for="any_gender">Any</label>
                                </li>
								<li>
									<input type="radio" id="male_gender" name="gender" value="male" >
									<label for="male_gender">Male</label>
								</li>
								<li>
									<input type="radio" id="female_gender" name="gender" value="female">
									<label for="female_gender">Female</label>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-lg-3 col-md-4 col-sm-12">
						<div class="inBlk">
							<h5></h5>
							<ul class="ctgLst">
								<li>
									<input type="checkbox" id="has_background" name="background">
									<label for="has_background">Has background check</label>
								</li>
								<li>
									<input type="checkbox" id="has_photo" name="photo" >
									<label for="has_photo">Has Photo</label>
								</li>
								<br>
								<br>
								<div class="inBlk">
									<label for="hourly-rate">Hourly Rate: <span>$10 - $200</span></label>
									<input type="range" style="display: none !important;" min="10" max="200"  value="200" class="slider hourly-rate">
								</div>
								<div class="inBlk inBlk-distance" >
									<label for="distance">Distance: <span>Within 20 miles</span></label>
									<input type="range" style="display: none !important;" min="0" max="20"  value="20" class="slider distance">
								</div>
							</ul>
						</div>
					</div>
					
					<div class="col-lg-12 col2" style="float:right; margin-top: 45px;text-align:right;">
						<a  class="" style="margin: 0 40px 0 0px;" id="filter-clear" href="javascript:void(0)">Clear</a>
						<a id="filter-apply" class="webBtn colorBtn" href="javascript:void(0)">Apply Changes</a>
					</div>
				</form>
				  </div>
				</div>
				  <div class="topHead col col2">
					<h2></h2>
				</div>
				 <ul class="lst flex text-center" id="srchDta">
				</ul>
            </div>
            <div class="flexRow flex">
                <div class="col" style="width:100%">
                    <ul class="lst2 flex text-center" id="srchDta2">
                    </ul>
                </div>
            </div>
          
            
            <div id="lstPaging">
                <!-- <ul class="pagination">
                    <li><a href="?">1</a></li>
                    <li><a href="?" class="active">2</a></li>
                    <li><a href="?">3</a></li>
                    <li><a href="?">4</a></li>
                    <li><a href="?">5</a></li>
                </ul> -->
            </div>
            <div class="appLoad"><div class="appLoader"><span class="spiner"></span></div></div>
        </div>
    </section>
    <!-- search -->

    <!-- Ion Slider Css -->
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/ion.slider.min.css') ?>">
    <!-- Ion Slider Js -->
    <script type="text/javascript" src="<?= base_url('assets/js/ion.slider.min.js') ?>"></script>
  
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  
    <script>
      // $('.dis-dropdown').addClass('disabled');
      
      var placeSearch, autocomplete;
	  var geocoder = new google.maps.Geocoder();
      var componentForm1 = {
        postal_code: 'short_name',
      };

      function moreFiltersTrigger() {
          var hrL = $('.hourly-rate-toggle');
          if ( hrL.parent().hasClass('open') ) {
            hrL.trigger('click');
            hrL.parent().removeClass('open');
          }

          var disL = $('.distance-toggle');
          if ( disL.parent().hasClass('open') ) {
            disL.trigger('click');
            disL.parent().removeClass('open');
          }
      }

      function initAutocomplete_tour() {
        // Create the autocomplete object, restricting the search predictions to
        // geographical location types
        autocomplete = new google.maps.places.Autocomplete(
        document.getElementById('autocomplete'), {types: ['geocode']});
        
        // Avoid paying for data that you don't need by restricting the set of
        // place fields that are returned to just the address components.
        autocomplete.setFields(['address_component']);

        // When the user selects an address from the drop-down, populate the
        // address fields in the form.
        autocomplete.addListener('place_changed', fillInAddress1);
      }
      
      function fillInAddress1() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm1) {
     
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details,
        // and then fill-in the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm1[addressType]) {
            var val = place.address_components[i][componentForm1[addressType]];
            document.getElementById(addressType).value = val;
            if ( addressType == 'postal_code' ) {
                document.getElementById('autocomplete').value = val;
            }
          }
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocates() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
        	   var geolocation = {
					  lat: position.coords.latitude,
					  lng: position.coords.longitude
					};
            var circle = new google.maps.Circle(
                {center: geolocation, radius: position.coords.accuracy});
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
      $(document).ready(function () {
        initAutocomplete_tour();
		geolocates();
      })
    </script>
  
  
    <script type="text/javascript">
        var query_subject = '<?= $q_subject ?>';
        var query_zipcode= '<?= $q_zip ?>';

        var loop_start = 0, loop_end = 15, per_page = 15, total = 0, paging = '', itemsList = {};
        var total_show = 8;                                   
        var xhr = new window.XMLHttpRequest();
        var ajaxSearch = false;
        function searchTutors(allow_loader = true) {
            $('.filterbox .dropdown').removeClass('active');
            $('.filterbox .dropdown .dropdown-menu').slideUp(300);
          
            if($('#subject').val() != '' && $('#subject').val() != null) {
                $('[name="subject"]').val($('#subject').val());
              // $("#searchForm").append('<input type="hidden" name="subject" value="'+$('#subject').val()+'">');
            } else {
              // $("#searchForm").append('<input type="hidden" name="subject" value="">');
                if(query_subject) {
                    $('[name="subject"]').val(query_subject);
                } else {
                    $('[name="subject"]').val('');
                }
            }

            if($('#autocomplete').val() != ''){
                if(query_zipcode) {
                    $('[name="zip"]').val(query_zipcode);
                    $('#autocomplete').val(query_zipcode);
                } else {
			
                    $('#hiddenZip').val($('#autocomplete').val());
                }
                // $("#searchForm").append('<input type="hidden" name="zip" value="'+$('#postal_code').val()+'">');
            } else {

                // $("#searchForm").append('<input type="hidden" name="zip" value="">');
                if(query_zipcode) {
                    $('#hiddenZip').val(query_zipcode);
                    $('#autocomplete').val(query_zipcode);
                } else {
                    $('#hiddenZip').val('');
                    $('#autocomplete').val('');
                }
            }

            $('[name="sort"]').val($('#sorting').val());
            // $("#searchForm").append('<input type="hidden" name="sort" value="'+$('#sorting').val()+'">');

            if(xhr && xhr.readyState != 4){
                xhr.abort();
            }
            if(ajaxSearch)
                return;
            ajaxSearch=true;

            $('#srchDta').hide();
            if ( allow_loader ) {
                $('#srchDta2').hide();
                $('#layer, .appLoad').show();
            }
            
            $('.topHead>h2').html("");
            $('#lstPaging').hide();
            var params = $("#searchForm").serialize();
		
            loop_start = 0, loop_end = 15, paging = '', total = 0, itemsList = {}, subjectObj = [];
            $.ajax({
                url: base_url + "/search",
                data: params,
                dataType: "json",
                method: "POST",
                success: function (rs) {
                    console.log(rs)
                    if($('.auto-subject').hasClass('select2-hidden-accessible')) {
                      // do nothing
                    } else {
                      $('.auto-subject').select2({data:rs.subject});
                    }
                  
                    if (rs.lstData != undefined && rs.lstData != '') {
                        itemsList = rs.lstData;
                        total = rs.total;
                        paging = rs.paging;
                        per_page = rs.per_page;
                        loop_end = rs.per_page;
                    }
                    $('#lstPaging').html(paging);
                    if(query_subject != '') {
                        $('.auto-subject').val(query_subject).trigger('change');
                        query_subject = '';
                    }

                    if(query_zipcode != '') {
                        query_zipcode = ''
                        // $('.zip').val(query_zipcode);
                    }

                    initRankings(allow_loader);
                    if(total_show < total)
                        $('#lstPaging').html(' <div  class="webBtn colorBtn show-more"  style="margin: 35px auto; cursor:pointer">Show More Results</div>');

                    // Update route history
                    let urlHistory = window.location.href.replace(window.location.search, '');
                    window.history.pushState('','', urlHistory);

                },error: function (rs) {
                    console.log(rs)
                },
                xhr : function(){
                    return xhr;
                }
            })
        }
        function initRankings(allow_loader = true) {
            $('#srchDta').html('');
            if ( allow_loader ) {
                $('#srchDta2').hide();
                $('#layer, .appLoad').show();
            }
            $('#lstPaging').hide();
            setTimeout(function () {
              $('#srchDta2').html('');
                if (itemsList && itemsList.length > 0) {                
                    $.each(itemsList, function (index, obj) {
                        if (loop_start <= index && index < total_show) {
//                             if(index < 3)
//                                 $('#srchDta').append(obj);
//                             else
                                $('#srchDta2').append(obj);    
                        }
                    });
                    refresh_rateYo();
                } else {
                    $('#srchDta').append('<li style="width:100%;"><div class="col-md-12 alert alert-info">We couldn\'t find tutors matching your search criteria Try a searching a different subject or a new location.</div></li>');
                }
                $('.topHead>h2').html(total+" tutors matching "+$("#subject").val()+".");
                $('#layer, .appLoad').hide();
                $('#srchDta').show();
                $('#srchDta2').show();
                $('#lstPaging').show();
                ajaxSearch=false;
            }, 1500);
        }
        $(document).ready(function () {
			$(document).on('click', '#filter-apply', function(e) {
				var params = $("#searchForm").serialize();
				searchTutors();
			});
			// $(document).on('change', '#hourly-rate', function(e) {
			// 	var range = $(this).val();
			// 	$()
			// });
			$(".hourly-rate").ionRangeSlider({
				type: "double",
				min: 10,
				skin: "round",
				max: 200,
				from: 10,
				to: 200,
				prefix: '$',
				grid: false,
				grid_snap: false,
				from_fixed: false,  // fix position of FROM handle
				to_fixed: false,     // fix position of TO handle
				onChange: function (data) {
					
					$('input[name="hourly_min"]').val(data.from);
					$('input[name="hourly_max"]').val(data.to);
					$('#hourlyRate').val('$'+data.from + '-'+ '$'+data.to);
				},
                onFinish: function (data) {
                    $('.hourly-rate-toggle').text('$'+data.from + '-'+ '$'+data.to);
					var params = $("#searchForm").serialize();
				    searchTutors();
				}
			});
			
			$(".distance").ionRangeSlider({
				type: "double",
				min: 0,
				skin: "round",
				max: 40,
				from: 0,
				to: 20,
				grid: false,
				grid_snap: false,
				
				from_fixed: false,  // fix position of FROM handle
				to_fixed: false,     // fix position of TO handle,
				onStart: function (data) {
					console.log(data.to);
				 },
				onChange: function (data) {
					$('input[name="distance_min"]').val(data.from);
					$('input[name="distance_max"]').val(data.to);
				 },
			    onFinish: function (data) {
					// Called then action is done and mouse is released
					console.log(data.to);
				}
			});
			$(document).on('click', '#filter-clear', function(e)  {
				$('#searchForm').trigger("reset");
			})
            $(document).on('click', '.show-more', function (e) {
                total_show+= 8;
                searchTutors(false);
            });
            
            $(document).on('click', '#searchPaging li a', function (e) {
                e.preventDefault();
                var page_id = parseInt($(this).data('page'));
                loop_start = (page_id - 1) * per_page;
                loop_end = loop_start + per_page;
                initRankings();
                $('#searchPaging li>a').removeClass('active');
                $(this).addClass('active');
            });

            $('#price').ionRangeSlider({
                min: 0,
                max: 150,
                type: 'double',
                prettify: function (num) {
                    return '$' + num;
                },
                onFinish: function (data) {
                    searchTutors();
                },
                // prefix: '$',
                grid: true
            });
           

            $('#manualSearch').on('submit',function(e){
                e.preventDefault();
                
            })
            $(document).on('change','#sorting',function(){
                
            });

            $(document).on('change','#searchForm input[name="educations[]"]',function(){
                if($('#educationAny').prop('checked'))
                    $('#educationAny').prop('checked',false);
               
            });
			$(document).on('change','#searchForm input[name="days[]"]',function(){
                if($('#availAll').prop('checked'))
                    $('#availAll').prop('checked',false);
               
            });
            $(document).on('change','#availAll',function(){
				
                if (this.checked) {
                    $('input[name="days[]"]').prop('checked',false)
                }
              
            });
			$(document).on('change','#educationAny',function(){
                if (this.checked) {
                    $('input[name="educations[]"]').prop('checked',false)
                }
              
            });
        

            var startLat =0, startLng =0;
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    startLat = position.coords.latitude;
                    startLng = position.coords.longitude;
				 var geolocation = {
					  lat: position.coords.latitude,
					  lng: position.coords.longitude
					};
				geocoder.geocode(
				{
				  location: geolocation
				},
				(results, status) => {
				  if (status === "OK") {
					if (results[0] && results[0]['address_components']) {
						console.log(results[0])
						var addresses =  results[0]['address_components'];
						addresses.forEach((e) => {
							if(e.types.includes('postal_code'))
							{
                                $('#autocomplete').val(e.long_name);
							}
						})
					} 
				  }
					$('#map_lat').val(startLat);
					$('#map_lng').val(startLng);
					searchTutors();
				});
                }, function () {
                // Do Nothing
                    searchTutors();
                });
            }
        });
      </script>
     <script>
        $("#lesson-person").on('click', function() {
            // in the handler, 'this' refers to the box clicked on
            var $box = $(this);
            if ($box.is(":checked")) {                                           
                $("#lesson-online").prop("checked", false);
                $box.prop("checked", true);
                $("#distance-blk").css("display","block");
            } else {
                $box.prop("checked", false);
                $("#distance-blk").css("display","block");
            }
            //searchTutors();
        });
        $("#lesson-online").on('click', function() {
            // in the handler, 'this' refers to the box clicked on
            var $box = $(this);
            if ($box.is(":checked")) {                                           
                $("#lesson-person").prop("checked", false);
                $box.prop("checked", true);
                $("#distance-blk").css("display","none");
            } else {
                $box.prop("checked", false);
                $("#distance-blk").css("display","block");
            }
            //searchTutors();
        });
    </script>
  
    <script>
      /*Dropdown Filter Box*/
      $('.filterbox .dropdown .select').click(function () {
        $this = $('.filterbox .dropdown');
        $this.attr('tabindex', 1).focus();
        $this.toggleClass('active');
        $this.find('.dropdown-menu').slideToggle(300);
      });
      $('.filterbox .dropdown .dropdown-menu li').click(function () {
//           $(this).parents('.dropdown').find('span').text($(this).text());
//           $(this).parents('.dropdown').find('input').attr('value', $(this).attr('id'));
      });
      /*End Dropdown  Filter Box*/
    </script>

    <!-- <script>
        $('.hour-popover>.trigger').popover({
            html: true,
            placement : 'bottom',
            title: function () {
                return $(this).parent().find('.head').html();
            },
            content: function () {
                return $(this).parent().find('.content').html();
            }
        });
    </script>
    <script>
        $('.zipcode-popover>.trigger').popover({
            html: true,
            placement : 'bottom',
            title: function () {
                return $(this).parent().find('.head').html();
            },
            content: function () {
                return $(this).parent().find('.content').html();
            }
        });
    </script> -->
    <!-- <script>
        $(document).ready(function(){
            $('[data-toggle="popover"]').popover({
                placement : 'auto'
            });
        });
    </script> -->
    <script>
       $('.dropdown-toggle').on('click', function (e) {
		$(this).next().toggle();
        });
        $('.dropdown-menu.keep-open').on('click', function (e) {
            e.stopPropagation();
        });
        function getsearch()
        {
               $('#filter-apply').trigger('click'); 
        }
    </script>

    <?php $this->load->view('includes/footer');?>
</body>
</html>
