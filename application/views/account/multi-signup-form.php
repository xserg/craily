<!doctype html>
<html>
<head>
    <title><?=$site_settings->site_name?> Tutor Sign up - Tell us about yourself</title>
    <?php $this->load->view('includes/site-master'); ?>
</head>
<body id="home-page" class="register_tutor_page tutor-multi-signup">
    <?php $this->load->view('includes/header'); ?>
    <link href="<?= base_url('assets/css/select2.min.css')?>" rel="stylesheet" />
<section class="signup-stapper-main">
    <div class="container">
      <div class="signup-stapper-sec">
        <form action="" method="post" autocomplete="off" class="f1" id="frmSignup_tutor" enctype="multipart/form-data" data-cc-on-file="false" data-stripe-publishable-key="<?php echo $this->config->item('stripe_key') ?>">
          <h3 class="signup-stapper-box-title">Tell us about yourself</h3>

          <div class="f1-steps">
            <div class="f1-progress">
              <div class="f1-progress-line" data-now-value="0" data-number-of-steps="2" style="width: 0%;"></div>
            </div>
            <div class="f1-step active">
              <div class="f1-step-icon">1</div>
              <p>Agreements</p>
            </div>
            <div class="f1-step">
              <div class="f1-step-icon">2</div>
              <p>Select Subjects</p>
            </div>
            <div class="f1-step">
              <div class="f1-step-icon">3</div>
              <p>Additional Information</p>
            </div>
            <div class="f1-step">
              <div class="f1-step-icon">4</div>
              <p>Personalize Profile </p>
            </div>
          </div>

          <fieldset class="step0-content">
            <hr>

            <div class="agreement-sec pt-4 text-left">
              <div id="agreement-wizard" action="">
                <div class="agreement-step-indicators">
                  <div style="">
                    <span class="agreement-step">Step1</span>
                    <span class="agreement-step">Step2</span>
                    <span class="agreement-step">Step3</span>
                    <span class="agreement-step">Step4</span>
                  </div>
                  <div class="agreement-step-total-count">/4</div>
                </div>
                <div class="agreement-tab">
                  <h4 class="signup-stapper-sec-title">A few things first</h4>
                  <p class="signup-stapper-sec-des">Thanks for choosing Crainly! To prepare you to be a successful tutor with Crainly, we’re going to walk you through a few quick points about how Crainly works.</p>
                  <div class="text-center">
                    <div class="agreement-footer-btn">
                      <!-- <button type="button" id="agreement-prevBtn"  onclick="nextPrev(-1)">Previous</button> -->
                      <button type="button" id="agreement-nextBtn" onclick="nextPrev(1)">Next</button>
                    </div>
                  </div>
                </div>
                <div class="agreement-tab">
                  <h4 class="signup-stapper-sec-title">Your relationship with Crainly</h4>
                  <p class="signup-stapper-sec-des">In Crainly’s marketplace, you’re an independent tutor in control of your tutoring business. You have full responsibility and flexibility for setting up appointments with students. You will select which opportunities to pursue and how much to charge. A straightforward commission structure lets you know exactly how much you make from each lesson. As an independent tutor, you are not a Crainly employee and we are not able to verify your employment to other companies.</p>
                  <div class="text-center">
                    <div class="agreement-footer-btn">
                      <button type="button" id="agreement-prevBtn"  onclick="nextPrev(-1)">Previous</button>
                      <button type="button" id="agreement-nextBtn" onclick="nextPrev(1)">Next</button>
                    </div>
                </div>
                </div>
                <div class="agreement-tab">
                  <h4 class="signup-stapper-sec-title">Payment</h4>
                  <p class="signup-stapper-sec-des">During the registration process, you’ll decide your own default hourly rates. Students will pay for all lessons via the Crainly platform. Tutors do not receive direct payment from students at any time. You’ll be paid 80% of your rate for each lesson, and Crainly will retain a 20% platform fee. Since tutors listed on Crainly are independent, taxes and other fees will not be withheld from your payments.</p>
                  <p class="signup-stapper-sec-des">Tutor payments are issued via direct deposit. Payment is usually issued in as few as 3 business days following a completed lesson.</p>
                  <div class="text-center">
                    <div class="agreement-footer-btn">
                      <button type="button" id="agreement-prevBtn"  onclick="nextPrev(-1)">Previous</button>
                      <button type="button" id="agreement-nextBtn" onclick="nextPrev(1)">Next</button>
                    </div>
                  </div>
                </div>

                <div class="agreement-tab">
                  <h4 class="signup-stapper-sec-title">Important rules</h4>
                  <p class="signup-stapper-sec-des">Crainly has built a simple set of rules to ensure that tutors get paid, to protect the privacy of tutors and students, and to make our service fair and safe for everyone. Please keep the following things in mind as you use Crainly: </p>
                  <p class="signup-stapper-sec-des">* Accepting payment directly from students off of the platform is not allowed, and will prevent tutors from being successful on Crainly. <br>* All communication with your students must take place through Crainly’s messaging system. Tutors should not exchange personal email addresses or other personal contact info with students.</p>
                  
                  <span class="agreement-note">Please note that tutors who violate these rules will be removed from the marketplace.</span>
                  <div class="text-center">
                    <div class="agreement-footer-btn">
                      <button type="button" id="agreement-prevBtn"  onclick="nextPrev(-1)">Previous</button>
                      <button type="button" class="btn btn-next" data-step="1">Next</button>
                    </div>
                  </div>
                </div>
                   
              </div>
            
            </div>

            <!-- <div class="f1-buttons">
              <button type="button" class="btn btn-next">Next</button>
            </div> -->
          </fieldset>

          <fieldset class="step1-content">
            <h4 class="signup-stapper-sec-title">Choose your Subjects</h4>
            <p class="signup-stapper-sec-des">Select 1-5 subjects you'd like to tutor. You can add more later once you're done signing up.</p>
            <div class="selected-subjects-sec">
              <h5 class="selected-subjects-sec-title">Selected Subjects</h5>
              <ul class="selected-subjects-list">
	
              </ul>
            </div>
            <div class="subject-list-sec">
              <div id="accordion" class="accordion mb-3">
				<?php 
				$loop = 1;
				
				?>
				<?php 
				$subjectarrayids = array();
				foreach($subjects as $key => $subject):
				
				$subjectarrayids[$loop] = $subject->id;
				if($loop == 1):
				?>
				<div class="subject-head">
				<?php 
				endif;
				?>
				<div class="collapse-header mr-3">
          <a class="collapsed collapse<?php echo $subject->id;?>" data-toggle="collapse" href="#collapse<?php echo $loop;?>">
            <?php echo $subject->name;?> <!--(<?php echo $subject->subcatcount;?>)--> <span class="subjects-count" style="display:none;">0</span> 
            <svg width="11" height="12" viewBox="0 0 11 12" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M0 4.68V6.576H4.488V11.304H6.456V6.576H10.968V4.68H6.456V0H4.488V4.68H0Z" fill="white"/>
            </svg>
          </a>
				</div>
				<?php
				//echo $loop%3;
				if($loop%3 == 0):
				?>
				</div>
				<?php
				$co = 1;
				foreach($subjectarrayids as $k=>$val):
					if($co == 1):
					?>
						<div class="subject-body">
					<?php
					endif;
					?>
					<div id="collapse<?php echo $k;?>" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                      <div class="card-body-content">
						<?php 
						foreach($sub_subjects as $key => $sub_subject):?>
						<?php 
							if($sub_subject->parent_id == $val):
							?>
							<div class="checkbox">
								<label><input type="checkbox" data-category="<?php echo $subject->name;?>" name="sub_<?php echo $val;?>[]" value="<?php echo $sub_subject->id;?>" id="sub<?php echo $sub_subject->id;?>" onchange="return clickcheckbox(<?php echo $val;?>,<?php echo $sub_subject->id;?>,'<?php echo $sub_subject->name;?>');" class="subjeccheckbox"><span class="label-for-check"><?php echo $sub_subject->name;?></span></label>
							</div>
							<?php 
							endif; 
							?>
						<?php 
						endforeach; 
						?>
                      </div>
                    </div>
					</div>
					<?php
					if($co == count($subjectarrayids)):
					?>
						</div>
					<?php
					endif;
					$co++;
				endforeach;
				$subjectarrayids = array();
				?>
				<div class="subject-head">
				<?php
				endif;
				if(count($subjects) == $loop):
				?>
				</div>
				<?php
				$co = 1;
				foreach($subjectarrayids as $k=>$val):
					if($co == 1):
					?>
						<div class="subject-body">
					<?php
					endif;
					?>
					<div id="collapse<?php echo $k;?>" class="collapse" data-parent="#accordion">
					<div class="card-body">
                      <div class="card-body-content">
                        <?php 
						foreach($sub_subjects as $key => $sub_subject):?>
						<?php 
							if($sub_subject->parent_id == $val):
							?>
							<div class="checkbox">
								<label><input type="checkbox" data-category="<?php echo $subject->name;?>" name="sub_<?php echo $val;?>[]" value="<?php echo $sub_subject->id;?>" id="sub<?php echo $sub_subject->id;?>" onchange="return clickcheckbox(<?php echo $val;?>,<?php echo $sub_subject->id;?>,'<?php echo $sub_subject->name;?>');" class="subjeccheckbox"><span class="label-for-check"><?php echo $sub_subject->name;?></span></label>
							</div>
							<?php 
							endif; 
							?>
						<?php 
						endforeach; 
						?>
                      </div>
                    </div>
                  </div>
					<?php
					if($co == count($subjectarrayids)):
					?>
						</div>
					<?php
					endif;
					$co++;
				endforeach;
				
				$subjectarrayids = array();
				
				endif;
				$loop++;
				endforeach;?>
          
              </div>
            </div>
            <div class="f1-buttons">
              <button type="button" class="btn btn-previous">Previous</button>
              <button type="button" class="btn btn-next">Next</button>
            </div>
          </fieldset>

          <fieldset class="step2-content">
            <div class="add-work-sec">
              <h4 class="signup-stapper-sec-title">Add Education</h4>
              <p class="signup-stapper-sec-des">Add up to 3 Education Background</p>
              <input type="hidden" name="education" id="education">
              <div class="added-item-list" id="educationItem"></div>
              <div class="add-more">
                <button type="button" class="btn add-more-btn" data-toggle="modal" data-target="#educationModal" id="addMore">
                  <svg width="11" height="12" viewBox="0 0 11 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 4.68V6.576H4.488V11.304H6.456V6.576H10.968V4.68H6.456V0H4.488V4.68H0Z" fill="white"/>
                  </svg>
                  Add More
                </button>
              </div>
            </div>
            <div class="add-education-sec">
              <h4 class="signup-stapper-sec-title">Work Experience</h4>
              <p class="signup-stapper-sec-des">Add up to 3 Work Experience</p>
              <input type="hidden" name="workExperiences" id="workExperiences">
              <div class="added-item-list" id="workExperienceItem"></div>
              <div class="add-more">
                <button type="button" class="btn add-more-btn" data-toggle="modal" data-target="#workexperienceModal" id="addMoreExp">
                  <svg width="11" height="12" viewBox="0 0 11 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 4.68V6.576H4.488V11.304H6.456V6.576H10.968V4.68H6.456V0H4.488V4.68H0Z" fill="white"/>
                  </svg>
                  Add More
                </button>
              </div>
            </div>
            <div class="other-info-sec">
              <h4 class="signup-stapper-sec-title">Other Information</h4>
              <!-- <p class="signup-stapper-sec-des">Add up to 3 Work Experience</p> -->
              <div class="other-info-list">
                <div class="form-group">
                  <label for="address-line1">Address Line 1 <img src="assets/images/info_active.svg" alt="" alt="" data-toggle="popover" data-content="This will not be shown on your profile or to students."></label>
                  <input type="text" class="form-control textareaAddress" id="autocomplete"  onFocus="geolocate()" name="address" placeholder="Enter Your Address">
                  <input type="hidden" name="street" id="street_number" class="form-control street_number" disabled="true"/>
									<input type="hidden" class="form-control" id="route" disabled="true"/>
                  <input class="form-control" id="country" name="country" type="hidden" disabled="true"/>
                  <input type="hidden" id="txtLatitude" name="txtLatitude" class="form-control txtTravel" value=""> 
                  <input type="hidden" id="txtLongitude" name="txtLongitude" class="form-control txtTravel" value="">
                </div>
                <div class="form-group">
                  <label for="address-line2">Address Line 2 <img src="assets/images/info_inactive.svg" alt="" data-toggle="popover" data-content="This will not be shown on your profile or to students." ></label>
                  <input type="text" class="form-control" id="address-line2" placeholder="Enter Your Address" name="address2">
                </div>
                <div class="form-group">
                  <label for="zipcode">Zip Code</label>
                  <input type="text" class="form-control" name="zip" id="zip" placeholder="Enter Zip Code">
                </div>
                <div class="form-group">
                  <label for="city">City</label>
                  <input type="text" class="form-control" name="city" id="city" placeholder="Enter City Name">
                </div>
                <div class="form-group">
                  <label for="state">State</label>
                  <input type="text" class="form-control" name="state" id="state" placeholder="Enter State Name">
                </div>
                <div class="form-group custom-select">
                  <label for="gender">Gender</label>
                  <select class="form-control select2-dropdown" id="gender">
                    <option disabled selected>Select</option>
                    <option>Male</option>
                    <option>Female</option>
                    <option>Prefer not to say</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="txtHourlyRate">Hourly Rate <img src="assets/images/info_inactive.svg" alt=""  data-toggle="popover" data-content="Rate must be at least $20 and a whole number."></label>
                  <input type="number" class="form-control txtHourlyRate  hourly-input" id="txtHourlyRate" name="hourly_rate" placeholder="Hourly Rate" pattern="[0-9]" min="20" max="500" step="5">
                </div>
                <div class="form-group custom-select">
                  <label for="txtTravelRadius">Travel Radius <img src="assets/images/info_inactive.svg" alt=""  data-toggle="popover" data-content="The amount of miles you are willing to travel to a student."></label>
                  <select class="form-control select2-dropdown" id="txtTravelRadius" name="travel_radius">
                    <option value="">None</option>
                    <option value="5">5 miles</option>
                    <option value="10">10 miles</option>
                    <option value="20">20 miles</option>
                    <option value="30">30 miles</option>
                  </select>
                </div>
                <div class="form-group custom-select">
                  <label for="selectCancelPolicy">Cancelletion Policy <img src="assets/images/info_inactive.svg"  data-toggle="popover" data-content="The amount of time you require a student to cancel in advance without receiving an additional charge. This should always be communicated with students prior to sessions."></label>
                  <select class="form-control select2-dropdown" id="selectCancelPolicy" name="selectCancelPolicy">
                    <option value="">None</option>
                    <option value="1">1 hour</option>
                    <option value="3">3 hours</option>
                    <option value="6">6 hours</option>
                    <option value="12">12 hours</option>
                    <option value="24">24 hours</option>
                  </select>
                </div>
                <div class="form-group custom-select">
                  <label for="txtOnline">Are you able to perform lessons online?</label>
                  <select class="form-control select2-dropdown" id="txtOnline" name="onlinelesson">
                    <!-- <option value="">None</option> -->
                    <option value="1">Yes</option>
										<option value="0">No</option>
                  </select>
                </div>
                <div class="form-group custom-select">
                  <label for="highestlevelofeducation">Highest Level of Education</label>
                  <select class="form-control select2-dropdown" id="highestlevelofeducation" name="highest_level_of_education">
                    <?php $educations=educations()?>
                    <?php foreach ($educations as $edu_key => $education): ?>
                       <option value="<?php echo $edu_key;?>"><?php echo $education;?></option>
                    <?php endforeach?>
                  </select>
                </div>
              </div>
            </div>
            <div class="f1-buttons">
              <button type="button" class="btn btn-previous">Previous</button>
              <button type="button" class="btn btn-next">Next</button>
            </div>
          </fieldset>

          <fieldset class="step3-content">
            <div class="add-bio-sec">
              <div class="add-bio-inner">
                <div class="bio-img-upload-sec">
                  <div class="bio-thumb">
                    <img id="profile-preview" class="default" src="assets/images/thumbnail.svg" alt="">
                    <a href="javascript:void(0);" onClick="thumbClose()" class="thumb-close"><img src="assets/images/cancel_photo.svg" alt=""></a>
                  </div>
                  <!-- <button class="btn btn-upload">Upload Photo</button> -->
                  <input type="file" id="txtProfilePhoto" name="profile_photo" class="form-control-file txtProfilePhoto custom-file-input"> 
                </div>
                <div class="bio-box-sec">
                  <div class="form-group">
                    <label for="bio-des">Bio</label>
                    <textarea name="bio" id="bio-des" class="form-control" placeholder="Type Bio"></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="f1-buttons">
              <button type="button" class="btn btn-previous">Previous</button>
              <button type="submit" class="btn btn-next">Apply</button>
            </div>
          </fieldset>

        </form>
      </div>
    </div>
  </section>
  <div class="modal fade" id="educationModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><img src="assets/images/close.svg" alt=""></button>
          <h4 class="modal-title">Add Education </h4>
          <input type="hidden" id="mode" name="mode" value="add">
          <input type="hidden" id="editIndex" name="editIndex" value="0">
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="university">Unversity/College Name <span class="text-red">*</span></label>
                <input type="text" class="form-control" id="university" placeholder="Unversity/College Name" name="collegefinal">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="degree">Degree</label>
                <input type="text" class="form-control" id="degree" placeholder="Degree" name="degreefinal">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="study-field">Field of Study</label>
                <input type="text" class="form-control" id="studyField" placeholder="Field of Study" name="study-field-final">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
             <div class="form-group custom-select fixed-height">
              <label for="from-year">From Year <span class="text-red">*</span></label>
              <input type="text" class="form-control" id="fromYear" placeholder="From Year" name="from-year-final">
            </div>
            </div>
            <div class="col-md-6">
              <div class="form-group custom-select fixed-height">
                <label for="to-year">To Year <span class="text-red">*</span></label>
                <input type="text" class="form-control" id="toYear" placeholder="To Year" name="to-year">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer text-center">
			  <input type="hidden" id="addmorecount" value="1">
          <button type="button" class="btn btn-default save-btn" onclick="return addEductionDetails(true);">Save</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Add Education Modal Over -->

  <!-- Add Work Experience Modal Start -->
  <div class="modal fade" id="workexperienceModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><img src="assets/images/close.svg" alt=""></button>
          <h4 class="modal-title">Work Experience </h4>
          <input type="hidden" id="mode" name="mode" value="add">
          <input type="hidden" id="editIndex" name="editIndex" value="0">
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Company Name <span class="text-red">*</span></label>
                <input type="text" class="form-control" id="name" placeholder="Company Name">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="title">Job Title <span class="text-red">*</span></label>
                <input type="text" class="form-control" id="title" placeholder="Job Title">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group custom-select fixed-height">
              <label for="fromYearEx">From Date <span class="text-red">*</span></label>
                <select class="form-control select2-dropdown" id="fromMonth">
                  <option disabled selected>Month</option>
                  <?php
                  for($i=1;$i<=12;$i++):
                  $monthName = date("F", mktime(0, 0, 0, $i, 10));
                  ?>
                    <option value="<?php echo $monthName;?>"><?php echo $monthName;?></option>
                  <?php 
                  endfor;
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group custom-select fixed-height">
                <div class="checkbox">
                  <label><input type="checkbox" id="is_currently_work" value="1">I currently work here</label>
                </div>
                <input type="text" class="form-control" id="fromYearEx" placeholder="From Year">
              </div>
            </div>
          </div>
          <div class="row to-section">
            <div class="col-md-6">
              <div class="form-group custom-select fixed-height">
                <label for="toYearExp">To Date <span class="text-red">*</span></label>
                <select class="form-control select2-dropdown" id="toMonth">
                  <option disabled selected>Month</option>
                   <?php
                    for($i=1;$i<=12;$i++):
                    $monthName = date("F", mktime(0, 0, 0, $i, 10));
                  ?>
                  <option value="<?php echo $monthName;?>"><?php echo $monthName;?></option>
                  <?php 
                  endfor;
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group custom-select fixed-height">
                <label for="toMonth" style="visibility: hidden;">Select Month <span class="text-red">*</span></label>
                <input type="text" class="form-control" id="toYearExp" placeholder="To Year">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="description">Job Description <span class="text-red">*</span></label>
                <textarea id="description" class="form-control" placeholder="Write Job Description"></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer text-center">
          <button type="button" class="btn btn-default save-btn" onclick="return addWorkExperience(true);">Save</button>
        </div>
      </div>
    </div>
  </div>
	  <script type="text/javascript" src="<?= base_url('assets/js/additional-methods.js')?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/custom-validation.js') ?>"></script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?= GOOGLE_MAP_API_KEY ?>&libraries=places&callback=initAutocomplete"
        async defer></script>
    <script type="text/javascript" src="<?= base_url('assets/js/custom.js') ?>"></script>
	<script>
      function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#profile-preview').attr('src', e.target.result);
                $('#profile-preview').removeClass('default');
            }

            reader.readAsDataURL(input.files[0]);
        }
      }
      function thumbClose() {
        $('#profile-preview').attr('src', 'assets/images/thumbnail.svg');
        $('#profile-preview').addClass('default');
        $('#txtProfilePhoto').val('');
      }
      $(document).on('click', '.editEducation', function(){
          var key = $(this).data('id');
          var educations = JSON.parse($('#education').val());

          education = educations[key];
          $('#mode').val('edit');
          $('#editIndex').val(key);
          $('#university').val(education.college);
          $('#degree').val(education.degree);
          $('#studyField').val(education.studyField);
          $('#fromYear').val(education.fromYear).trigger('change');
          $('#toYear').val(education.toYear).trigger('change');
      });

      $(document).on('click', '.deleteEducation', function(){
          var key = $(this).data('id');
          var educations = JSON.parse($('#education').val());
          
          educations.splice(key, 1);
          educationHtml(educations, true);
      });

      $(document).on('click', '.editExperience', function(){
        var key = $(this).data('id');
        var experiences = JSON.parse($('#workExperiences').val());

        experience = experiences[key];
        $('#mode').val('edit');
        $('#editIndex').val(key);
        $('.to-section').show();
        $('#name').val(experience.name);
        $('#title').val(experience.title);
        $('#fromMonth').val(experience.fromMonth).trigger('change');
        $('#fromYearEx').val(experience.fromYear).trigger('change');
        $('#is_currently_work').prop( "checked", experience.is_currently_work);
        if (experience.is_currently_work) {
            $('.to-section').hide();
        }
        $('#toMonth').val(experience.toMonth).trigger('change');
        $('#toYearExp').val(experience.toYear).trigger('change');
        $('#description').val(experience.description);
        
      });

      $(document).on('click', '.deleteExperience', function(){
        var key = $(this).data('id');
        var experiences = JSON.parse($('#workExperiences').val());
        
        experiences.splice(key, 1);
        workExperienceHtml(experiences, true, true);
      });

      (function($){
        $(".hourly-input").change(function(){
          var temp = parseInt($(this).val()*1-$(this).val()%5);
          $(this).val(temp);
        });
        
        $("#txtProfilePhoto").change(function(){
            console.log('sas');
            readURL(this);
        });
      })(jQuery); 
    </script>
	<?php $this->load->view('includes/footer');?>
    <script src="assets/js/jquery.backstretch.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/select2.min.js')?>"></script>
    <script>
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);
</script>


<script>
$(document).ready(function(){
    $('.select2-dropdown').select2({
      width: '100%',
    });

    $('[data-toggle="popover"]').popover({
      placement : 'right',
      trigger : 'hover'
    });
});
</script>

<!-- Agreement wizard js start -->
<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("agreement-tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("agreement-prevBtn").style.display = "none";
  } else {
    document.getElementById("agreement-prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("agreement-nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("agreement-nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("agreement-tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("agreement-wizard").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("agreement-tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("agreement-step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("agreement-step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
</script>
<!-- Agreement wizard js over -->
</body>
</html>