<!doctype html>
<html>
<head>
    <title><?=$site_settings->site_name?> Tutor Sign up - Tell us about yourself</title>
    <?php $this->load->view('includes/site-master'); ?>
</head>
<body id="home-page" class="register_tutor_page tutor-multi-signup">
    <?php $this->load->view('includes/header'); ?>


    <section id="logOn" style="background-image: url('<?= SITE_IMAGES.'images/'.$register_content['page_image']?>')">
        <div class="flexDv">
            <div class="contain">
                <div class="ouTer">
                    <div class="lSide ckEditor">
                        <?= $register_content['left_section']?>
                    </div>
					<div class="logBlk">
						<form action="" method="post" autocomplete="off" class="" id="frmSignup_tutor" enctype="multipart/form-data" data-cc-on-file="false" data-stripe-publishable-key="<?php echo $this->config->item('stripe_key') ?>">
						    <h2>Tell us about yourself</h2>
						    <!-- One "tab" for each step in the form: -->
						    <div class="tutor-step-form">
						        <span class="step">1. Select Subjects</span>
						        <span class="step">2. Additional Information</span>
						        <span class="step">3. Personalize Profile</span>
						        <span class="step">4. Online Lessons</span>
						        <!-- <span class="step">4. Payment Details</span> -->
						    </div>
						    <div class="tab">
						        <h2 style="font-size: 25px; margin-bottom: 10px;"> Choose your subjects</h2>
						        <span class="tabSub">Select 1-5 subjects you'd like to tutor. You can add more later once you're done signing up.</span>
						        <div class="main_for_check">
						            <div class="checkSelection">
						                <hr>
						                    <span class="checkSelect">None Selected</span>
						                <hr>
						            </div>
									<?php $loop = 0;?>
									<?php foreach($subjects as $key => $subject):?>
										<div class="card">
											<div class="card-header" id="heading<?=$subject->id?>">
												<h5 class="mb-0">
													<button class="btn btn-link <?=($loop == 0)?'':'collapsed'?>" type="button" data-toggle="collapse" data-target="#collapse<?=$subject->id?>" aria-expanded="<?=($loop == 0)?true:false?>" aria-controls="collapse<?=$subject->id?>">
														<span class="glyphicon <?=($loop == 0)?'glyphicon-minus':'glyphicon-plus'?>"></span>
														<?=$subject->name?>
													</button>
												</h5>
											</div>
											<div id="collapse<?=$subject->id?>" class="collapse <?=($loop == 0)?'in':''?>" aria-labelledby="heading<?=$subject->id?>" data-parent="#accordionExample">
												<div class="card-body">
													<?php foreach($sub_subjects as $key => $sub_subject) { ?>
														<?php if($sub_subject->parent_id == $subject->id) {?>
															<label class="checkbox-inline"><input type="checkbox" data-category="<?=$subject->name?>" name="sub_<?=$subject->id?>[]" class="checkbox_card" value="<?php echo $sub_subject->id; ?>"><?php echo $sub_subject->name; ?></label>
														<?php } ?>
													<?php } ?>
												</div>
											</div>
										</div>
										
										<?php $loop++;?>
									<?php endforeach;?>
						        </div>        
						    </div>
						    <div class="tab">
						        <div class="form-group">
						            <label for="txtCollege">Education</label>
						            <p>
						                <input type="text" class="form-control txtCollege" id="txtCollege" name="college" class="txtCollege" required placeholder="College/School">
						                <span class="college_error"></span>
						            </p> 
						            
						            <p>
						                <input type="text" id="txtMajor" name="major" class="txtMajor form-control" placeholder="Major" autofocus required="">
						                <span class="major_error"></span>
						            </p> 
						            
						            <p>
						                <input type="text" id="txtGradYear" name="grad_year" class="txtGradYear form-control" placeholder="Graduation Year" autofocus required="">
						                <span class="grad_year_error" style="text-align: left;"></span>
						            </p> 
						            
						        </div>

						        <div class="form-group">
						            <label for="txtHourlyRate">Hourly rate 
						            	<div class="help-tip">
											<p>Crainly’s platform fee is 20%. Average tutors charge between $25 - $50 depending on their experience and subject. You can change this at any time in settings.</p>
										</div> 
									</label>
						            
						            <input type="number" pattern="[0-9]" min="20" max="500" step="5" class="form-control txtHourlyRate  hourly-input" id="txtHourlyRate" name="hourly_rate" required placeholder="Hourly rate">
									<span> Rate must be at least $20 and a whole number.</span> 
						            <span class="hourly_rate_error"></span>
						        </div>

						        <div class="form-group">
						            <label for="textareaAddress">Address 1 <div class="help-tip">
											<p>This will not be shown on your profile or to students.</p>
										</div> 
									</label>
									<input type="text" class="form-control" id="autocomplete"  onFocus="geolocate()" placeholder="Enter your address" name="address" class="form-control textareaAddress" required>
									<!-- <input type="text" class="form-control" placeholder="Enter your address" name="address" class="form-control textareaAddress" required> -->
						            <!-- <span class="address_error" style="text-align: left;"></span> -->
									<input type="hidden" name="street" id="street_number" class="form-control street_number" disabled="true"/>
									<input type="hidden" class="form-control" id="route" disabled="true"/>
									<input class="form-control" id="country" name="country" type="hidden" disabled="true"/>
								</div>
								<div class="form-group">
						            <label for="textareaAddress">Address 2 <div class="help-tip">
											<p>This will not be shown on your profile or to students.</p>
										</div> 
									</label>
						            <!-- <input type="text" class="form-control" id="autocomplete" placeholder="Enter your address" onFocus="geolocate()" name="address" class="form-control textareaAddress" required> -->
						            <input type="text" class="form-control" id=""  onFocus="" placeholder="Enter your address" name="address2" class="form-control textareaAddress" >
						            
							    </div>
								<div class="form-group">
						            <label for="textareaAddress">City
									</label>
									<input  type="text" class="form-control textareaAddress" required name="city" id="locality"/>
								</div>
								<div class="form-group">
						            <label for="textareaAddress">State
									</label>
									<input  type="text" class="form-control textareaAddress" required name="state" id="administrative_area_level_1"/>
								</div>
								<div class="form-group">
						            <label for="textareaAddress">Zip
									</label>
									<input  type="text" class="form-control textareaAddress" required name="zip" id="postal_code"/>
								</div>

						        <div class="form-group">
						            <label for="txtTravelRadius">Travel radius <div class="help-tip">
											<p>The amount of miles you are willing to travel to a student.</p>
										</div> </label>
						            <!-- <input type="text" id="txtTravelRadius" name="travel_radius" class="form-control txtTravel" autofocus required="">  -->
									<select class="form-control txtTravel" id="txtTravelRadius" name="travel_radius">
						                <option value="">None</option>
						                <option value="5 miles">5 miles</option>
						                <option value="10 miles">10 miles</option>
						                <option value="20 miles">20 miles</option>
						                <option value="30 miles">30 miles</option>						                
						            </select>
						            <span class="travel_radius_error"></span>
						        </div>

						        <div class="form-group">
						            <label for="selectCancelPolicy">Cancellation policy <div class="help-tip">
											<p>The amount of time you require a student to cancel in advance without receiving an additional charge. This should always be communicated with students prior to sessions.</p>
										</div></label>
						            <select class="form-control selectCancelPolicy" id="selectCancelPolicy" name="selectCancelPolicy">
						                <option value="none">None</option>
						                <option value="1">1 hour</option>
						                <option value="3">3 hours</option>
						                <option value="6">6 hours</option>
						                <option value="12">12 hours</option>
						                <option value="24">24 hours</option>
						                
						            </select>
						        </div>
						    </div>
						    <div class="tab">
						        <div class="form-group" style="display:none">
						            <label for="txtProfileHeadline">Profile Headline <div class="help-tip">
											<p>This will appear as the cover for your profile. Students will see this before clicking onto your profile. This should be about 1 sentence long.</p>
										</div></label>
						            <input type="text" id="txtProfileHeadline" name="profile_headline" class="form-control txtProfileHeadline" value="none" autofocus required=""> 
						            <span class="profile_headline_error"></span>
						        </div>
						        <div class="form-group">
						            <label for="txtProfilePhoto">Profile Photo</label>
						            <input type="file" id="txtProfilePhoto" name="profile_photo" class="form-control-file txtProfilePhoto" required> 
						            <span class="profile_photo_error"></span>
						        </div>
						        <div class="form-group">
						            <label for="txtBio">Bio <div class="help-tip">
											<p>Use this section to tell students about yourself including your experience in the subjects you've chosen to teach in.</p>
										</div></label>
						            <textarea class="form-control" id="textareaBio" name="bio" class="form-control textareaBio" required rows="3"></textarea>
						            <span class="bio_error"></span>
						            <input type="hidden" id="txtLatitude" name="txtLatitude" class="form-control txtTravel" value=""> 
						            <input type="hidden" id="txtLongitude" name="txtLongitude" class="form-control txtTravel" value=""> 
						        </div>
						    </div>
							<div class="tab">
								<div class="form-group">
									<label for="txtTravelRadius">Are you able to perform lessons online?</label>
									<!-- <input type="text" id="txtTravelRadius" name="travel_radius" class="form-control txtTravel" autofocus required="">  -->
									<select class="form-control txtOnline" id="txtOnline" name="onlinelesson">
										<option value="1">Yes</option>
										<option value="0">No</option>					                
									</select>
									<!-- <span class="online_lesson_error"></span> -->
								</div>
							</div>
						    <!-- <div class="tab"> -->
						        <!-- <div class='form-row row'>
		                            <div class='col-xs-12 form-group required'>
		                                <label class='control-label'>Name on Card</label> 
		                                <input class='form-control' size='4' type='text'>
		                                <input type='hidden' name='stripeToken' id="stripeToken"/>
		                            </div>
		                        </div>
		     
		                        <div class='form-row row'>
		                            <div class='col-xs-12 form-group card required'>
		                                <label class='control-label'>Card Number</label> <input
		                                    autocomplete='off' class='form-control card-number' size='20'
		                                    type='text'>
		                            </div>
		                        </div> -->
		      
		                        <!-- <div class='form-row row'>
		                        	<div class="col-xs-12 form-group" style="text-align: center;">



		                        		<a href="https://connect.stripe.com/express/oauth/authorize?redirect_uri=https://crainly.com/tutor-signup&response_type=code&client_id=ca_ExkShtieuagE8i9vmtEpRpc0SwvBljXt&scope=read_write" class="connect-button" target="_blank"><span>Connect with Stripe</span></a>
		                        	</div>
		                        </div> -->
		                            <!-- <div class='col-xs-12 col-md-4 form-group cvc required'>
		                                <label class='control-label'>CVC</label> <input autocomplete='off'
		                                    class='form-control card-cvc' placeholder='ex. 311' size='4'
		                                    type='text'>
		                            </div>
		                            <div class='col-xs-12 col-md-4 form-group expiration required'>
		                                <label class='control-label'>Expiration Month</label> <input
		                                    class='form-control card-expiry-month' placeholder='MM' size='2'
		                                    type='text'>
		                            </div>
		                            <div class='col-xs-12 col-md-4 form-group expiration required'>
		                                <label class='control-label'>Expiration Year</label> <input
		                                    class='form-control card-expiry-year' placeholder='YYYY' size='4'
		                                    type='text'>
		                            </div>
			                        </div>
			      
			                        <div class='form-row row'>
			                            <div class='col-md-12 error form-group hide'>
			                                <div class='alert-danger alert'>Please correct the errors and try
			                                    again.</div>
			                            </div>
			                        </div>
			      
			                        <div class="row">
			                            <div class="col-xs-12">
			                                <button class="btn btn-primary btn-lg" id="btnpay" type="submit">Pay Now</button>
			                            </div>
			                        </div> -->
							<!-- </div> -->
						    <div class="bTn text-center">
						        <button type="button" id="prevBtn" class="webBtn colorBtn lgBtn" onclick="nextPrev(-1)">Previous</button>
						        <button type="button" class="webBtn colorBtn lgBtn" id="nextBtn" onclick="nextPrev(1)">Apply <i class="fa fa-spinner fa-pulse fa-1x fa-fw hidden"></i></button>
						        <span style="color: red;font-size: 25px;margin-bottom: 10px;" class="span_error active"></span>
						    </div>
						    <div class="alertMsg" style="display:none"></div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script type="text/javascript" src="<?= base_url('assets/js/additional-methods.js')?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/custom-validation.js') ?>"></script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSCYUhPdncSUnXlUHSMePigWasY9jChpU&libraries=places&callback=initAutocomplete"
        async defer></script>
    <script type="text/javascript" src="<?= base_url('assets/js/custom.js') ?>"></script>
	<script>
		(function($){
			$(".hourly-input").change(function(){
				var temp = parseInt($(this).val()*1-$(this).val()%5);
				$(this).val(temp);
			});
		})(jQuery); 
	</script>
</body>
</html>