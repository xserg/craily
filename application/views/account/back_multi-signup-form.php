<!doctype html>
<html>
<head>
    <title>Tutor Sign up - Tell us about yourself<?=$site_settings->site_name?></title>
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
						<form action="" method="post" autocomplete="off" class="frmAjax" id="frmSignup_tutor" enctype="multipart/form-data" data-cc-on-file="false" data-stripe-publishable-key="<?php echo $this->config->item('stripe_key') ?>">
						    <h2>Tell us about yourself</h2>
						    <!-- One "tab" for each step in the form: -->
						    <div class="tutor-step-form">
						        <span class="step">1. Select Subjects</span>
						        <span class="step">2. Additional Information</span>
						        <span class="step">3. Personalize Profile</span>
						        <span class="step">4. Payment Details</span>
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
						              <div class="card">
						                    <div class="card-header" id="headingTweleve">
						                        <h5 class="mb-0">
						                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTweleve" aria-expanded="true" aria-controls="collapseTweleve">
						                                <span class="glyphicon glyphicon-minus"></span>
						                                Art
						                            </button>
						                        </h5>
						                    </div>
						                    <?php 
						                    	$headingTweleve = array('Adobe_Photoshop' => 'Adobe Photoshop', 'Animation' => 'Animation' , 'Architecture' => 'Architecture', 'Art_History' => 'Art History', 'Art_Theory' => 'Art Theory', 'Ballroom_Dancing' => 'Ballroom Dancing', 'Cinema' => 'Cinema', 'Composition (Music)' => 'Composition (Music)', 'Cosmetology' => 'Cosmetology', 'Drawing' => 'Drawing', 'Film' => 'Film', 'Graphic_Design' => 'Graphic Design', 'Painting' => 'Painting', 'Photography' => 'Photography', 'Salsa_Dancing' => 'Salsa Dancing', 'Theater' => 'Theater', 'Video_Production' => 'Video Production' );
						                    ?>
						                    <div id="collapseTweleve" class="collapse in" aria-labelledby="headingTweleve" data-parent="#accordionExample">
						                        <div class="card-body">
						                        	<?php foreach($headingTweleve as $key => $value) { ?>
						                            	<label class="checkbox-inline"><input type="checkbox" name="Art[]" class="checkbox_card" value="<?php echo $key; ?>"><?php echo $value; ?></label>
						                            <?php } ?>
						                        </div>
						                    </div>
						                </div>
						                   <div class="card">
						                    <div class="card-header" id="headingSeven">
						                        <h5 class="mb-0">
						                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
						                                <span class="glyphicon glyphicon-plus"></span>
						                                Business
						                            </button>
						                        </h5>
						                    </div>
						                    <?php 
						                    	$headingSeven = array('Architecture' => 'Architecture', 'business' => 'Business' , 'Career_Development' => 'Career Development', 'ESL/ESOL' => 'ESL/ESOL', 'Finance' => 'Finance', 'Financial_Accounting' => 'Financial Accounting', 'GMAT' => 'GMAT', 'GRE' => 'GRE', 'Law' => 'Law', 'Macroeconomics' => 'Macroeconomics', 'Managerial_Accounting' => 'Managerial Accounting', 'Marketing' => 'Marketing', 'Microeconomics' => 'Microeconomics', 'Project_Management' => 'Project Management', 'Public_Speaking' => 'Public Speaking', 'Tax_Accounting' => 'Tax Accounting');
						                    ?>
						                    <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
						                        <div class="card-body">
						                        	<?php foreach($headingSeven as $key => $value) { ?>
						                            	<label class="checkbox-inline"><input type="checkbox" name="Business[]" class="checkbox_card" value="<?php echo $key; ?>"><?php echo $value; ?></label>
						                            <?php } ?>
						                        </div>
						                    </div>
						                </div>
						                 <div class="card">
						                    <div class="card-header" id="headingSix">
						                        <h5 class="mb-0">
						                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
						                                <span class="glyphicon glyphicon-plus"></span>
						                                Computer
						                            </button>
						                        </h5>
						                    </div>
						                    <?php 
						                    	$headingSix = array('Adobe_Flash' => 'Adobe Flash', 'Adobe_Illustrator' => 'Adobe Illustrator' , 'Adobe_InDesign' => 'Adobe InDesign', 'Adobe_Lightroom' => 'Adobe Lightroom', 'Adobe_Photoshop' => 'Adobe Photoshop', 'Animation' => 'Animation', 'Autodesk_Maya' => 'Autodesk Maya', 'C' => 'C', 'C#' => 'C#', 'C++' => 'C++', 'COBOL' => 'COBOL', 'Computer_Engineering' => 'Computer Engineering', 'Computer_Gaming' => 'Computer_Gaming', 'Computer_Programming' => 'Computer Programming', 'Computer_Science' => 'Computer Science', 'CSS' => 'CSS','Dreamweaver' => 'Dreamweaver', 'General_Computer' => 'General Computer', 'GIS' => 'GIS', 'Graphic_Design' => 'Graphic Design', 'HTML' => 'HTML', 'Java' => 'Java', 'JavaScript' => 'JavaScript', 'Linux' => 'Linux', 'Macintosh' => 'Macintosh', 'MATLAB' => 'MATLAB', 'Microsoft_Access' => 'Microsoft Access', 'Microsoft_Excel' => 'Microsoft Excel', 'Microsoft_Outlook' => 'Microsoft Outlook', 'Microsoft_Powerpoint' => 'Microsoft Powerpoint', 'Microsoft_Project' => 'Microsoft Project', 'Microsoft_Publish' => 'Microsoft Publish', 'Microsoft_Windows' => 'Microsoft Windows', 'Microsoft_Word' => 'Microsoft Word', 'Perl' => 'Perl', 'Photography' => 'Photography', 'PHP' => 'PHP', 'Python' => 'Python', 'QuickBooks' => 'QuickBooks', 'R' => 'R', 'Ruby' => 'Ruby','SAS' => 'SAS', 'Sketchup' => 'Sketchup', 'Solidworks' => 'Solidworks', 'SPSS' => 'SPSS', 'SQL' => 'SQL', 'STATA' => 'STATA', 'Swift' => 'Swift', 'Video_Production' => 'Video Production', 'Visual_Basics' => 'Visual Basics', 'Web_Design' => 'Web Design');
						                    ?>
						                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
						                        <div class="card-body">
						                            <?php foreach($headingSix as $key => $value) { ?>
						                            	<label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="<?php echo $key; ?>"><?php echo $value; ?></label>
						                            <?php } ?>
						                        </div>
						                    </div>
						                </div>
						                
						                  <div class="card">
						                    <div class="card-header" id="headingThirteen">
						                        <h5 class="mb-0">
						                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen">
						                                <span class="glyphicon glyphicon-plus"></span>
						                                Elementary Education
						                            </button>
						                        </h5>
						                    </div>
						                    <?php 
						                    	$headingThirteen = array('Common_Core' => 'Common Core', 'Elementary_(K-6th)' => 'Elementary (K-6th)' , 'Elementary_Math' => 'Elementary Math', 'Elementary_Science' => 'Elementary Science', 'Grammar' => 'Grammar', 'Handwriting' => 'Handwriting', 'Homeschool' => 'Homeschool', 'Phonics' => 'Phonics', 'Reading' => 'Reading', 'Spelling' => 'Spelling', 'Study_Skills' => 'Study Skills', 'Vocabulary' => 'Vocabulary', 'Writing' => 'Writing');
						                    ?>
						                    <div id="collapseThirteen" class="collapse" aria-labelledby="headingThirteen" data-parent="#accordionExample">
						                        <div class="card-body">
						                            <?php foreach($headingThirteen as $key => $value) { ?>
						                            	<label class="checkbox-inline"><input type="checkbox" name="Education[]" class="checkbox_card" value="<?php echo $key; ?>"><?php echo $value; ?></label>
						                            <?php } ?>
						                        </div>
						                    </div>
						                </div>
						            </div>
						                  <div class="card">
						                    <div class="card-header" id="headingFour">
						                        <h5 class="mb-0">
						                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
						                                <span class="glyphicon glyphicon-plus"></span>
						                                English
						                            </button>
						                        </h5>
						                    </div>
						                    <?php 
						                    	$headingFour = array('ACT_English' => 'ACT English', 'ACT_Reading' => 'ACT Reading' , 'Bible_Studies' => 'Bible Studies', 'English' => 'English', 'ESL/ESOL' => 'ESL/ESOL', 'Grammar' => 'Grammar', 'IELTS' => 'IELTS', 'Linguistics' => 'Linguistics', 'Proofreading' => 'Proofreading', 'Public_Speaking' => 'Public Speaking', 'Reading' => 'Reading', 'SAT_Reading' => 'SAT Reading', 'SAT_Writing' => 'SAT Writing', 'TOEFL' => 'TOEFL', 'Vocabulary' => 'Vocabulary', 'Writing' => 'Writing');
						                    ?>
						                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
						                        <div class="card-body">
						                           	<?php foreach($headingFour as $key => $value) { ?>
						                            	<label class="checkbox-inline"><input type="checkbox" name="English[]" class="checkbox_card" value="<?php echo $key; ?>"><?php echo $value; ?></label>
						                            <?php } ?>
						                        </div>
						                    </div>
						                </div>
						                <div class="card">
						                    <div class="card-header" id="headingEight">
						                        <h5 class="mb-0">
						                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
						                                <span class="glyphicon glyphicon-plus"></span>
						                                History
						                            </button>
						                        </h5>
						                    </div>
						                    <?php 
						                    	$headingEight = array('American_History' => 'American History', 'Anthropology' => 'Anthropology' , 'Archaeology' => 'Archaeology', 'Art_History' => 'Art History', 'Classics' => 'Classics', 'Criminal_Justice' => 'Criminal Justice', 'European_History' => 'European History', 'Geography' => 'Geography', 'Government_Politics' => 'Government & Politics', 'Music_History' => 'Music History', 'Political_Science' => 'Political Science', 'Religion' => 'Religion', 'Social_Studies' => 'Social Studies', 'World_History' => 'World History');
						                    ?>
						                    <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordionExample">
						                        <div class="card-body">
						                            <?php foreach($headingEight as $key => $value) { ?>
						                            	<label class="checkbox-inline"><input type="checkbox" name="History[]" class="checkbox_card" value="<?php echo $key; ?>"><?php echo $value; ?></label>
						                            <?php } ?>
						                        </div>
						                    </div>
						                </div>
						                <div class="card">
						                    <div class="card-header" id="headingThree">
						                        <h5 class="mb-0">
						                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
						                                <span class="glyphicon glyphicon-plus"></span>
						                                Language
						                            </button>
						                        </h5>
						                    </div>
						                    <?php 
						                    	$headingThree = array('Arabic' => 'Arabic', 'Braille' => 'Braille' , 'Bulgarian' => 'Bulgarian', 'Chinese' => 'Chinese', 'Czech' => 'Czech', 'Dutch' => 'Dutch', 'ESL/ESOL' => 'ESL/ESOL', 'Farsi' => 'Farsi', 'French' => 'French', 'German' => 'German', 'Greek' => 'Greek', 'Hebrew' => 'Hebrew', 'Hindi' => 'Hindi', 'Hungarian' => 'Hungarian', 'IELTS' => 'IELTS', 'Indonesian' => 'Indonesian','Italian' => 'Italian', 'Japanese' => 'Japanese', 'Korean' => 'Korean', 'Latin' => 'Latin', 'Polish' => 'Polish', 'Portuguese' => 'Portuguese', 'Reading' => 'Reading', 'Romanian' => 'Romanian', 'Russian' => 'Russian', 'Spanish' => 'Spanish', 'Speech' => 'Speech', 'Thai' => 'Thai', 'TOEFL' => 'TOEFL', 'Turkish' => 'Turkish', 'Urdu' => 'Urdu', 'USCIS' => 'USCIS', 'Vietnamese' => 'Vietnamese', 'Writing' => 'Writing');
						                    ?>
						                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
						                        <div class="card-body">
						                           	<?php foreach($headingThree as $key => $value) { ?>
						                            	<label class="checkbox-inline"><input type="checkbox" name="Language[]" class="checkbox_card" value="<?php echo $key; ?>"><?php echo $value; ?></label>
						                            <?php } ?>
						                        </div>
						                    </div>
						                </div>
						            <div class="accordion" id="accordionExample">
						                <div class="card">
						                    <div class="card-header" id="headingOne">
						                        <h5 class="mb-0">
						                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						                                <span class="glyphicon glyphicon-plus"></span>
						                                Math
						                            </button>
						                        </h5>
						                    </div>
						                    <?php 
						                    	$headingOne = array('ACT_Math' => 'ACT Math', 'Actuarial_Science' => 'Actuarial Science' , 'Algebra_1' => 'Algebra 1', 'Algebra_2' => 'Algebra 2', 'Calculas' => 'Calculas', 'Common_Core' => 'Common Core', 'Econometrics' => 'Econometrics', 'Elementary_(K-6th)' => 'Elementary (K-6th)', 'Elementary_Math' => 'Elementary Math', 'Financial_Accounting' => 'Financial Accounting', 'Finite_Math' => 'Finite Math', 'GED' => 'GED', 'GMAT' => 'GMAT', 'GRE' => 'GRE', 'Linear_Algebra' => 'Linear Algebra', 'Managerial_Accounting' => 'Managerial Accounting','Microsoft_Excel' => 'Microsoft Excel', 'Pre-Algebra' => 'Pre-Algebra', 'Precalculas' => 'Precalculas', 'Probability' => 'Probability', 'SAT_Math' => 'SAT Math', 'Statistics' => 'Statistics', 'Trigonometry' => 'Trigonometry');
						                    ?>
						                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
						                        <div class="card-body">
						                            <?php foreach($headingOne as $key => $value) { ?>
						                            	<label class="checkbox-inline"><input type="checkbox" name="Math[]" class="checkbox_card" value="<?php echo $key; ?>"><?php echo $value; ?></label>
						                            <?php } ?>
						                        </div>
						                    </div>
						                </div>
						                 <div class="card">
						                    <div class="card-header" id="headingNine">
						                        <h5 class="mb-0">
						                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
						                                <span class="glyphicon glyphicon-plus"></span>
						                                Music
						                            </button>
						                        </h5>
						                    </div>
						                    <?php 
						                    	$headingNine = array('Cello' => 'Cello', 'Clarinet' => 'Clarinet' , 'Composition' => 'Composition', 'Drums' => 'Drums', 'Ear_Training' => 'Ear Training', 'Flute' => 'Flute', 'French_Horn' => 'French Horn', 'General_Music' => 'General Music', 'Guitar' => 'Guitar', 'Harp' => 'Harp', 'Jazz' => 'Jazz', 'Harp' => 'Harp', 'Music_History' => 'Music History', 'Music_Production' => 'Music Production', 'Music_Theory' => 'Music Theory', 'Oboe' => 'Oboe','Piano' => 'Piano', 'Salsa' => 'Salsa', 'Saxophone' => 'Saxophone', 'Sight_Singing' => 'Sight Singing', 'Songwriting' => 'Songwriting', 'Trombone' => 'Trombone', 'Trumpet' => 'Trumpet', 'Violin' => 'Violin', 'Voice' => 'Voice (Music)');
						                    ?>
						                    <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample">
						                        <div class="card-body">
						                            <?php foreach($headingNine as $key => $value) { ?>
						                            	<label class="checkbox-inline"><input type="checkbox" name="Music[]" class="checkbox_card" value="<?php echo $key; ?>"><?php echo $value; ?></label>
						                            <?php } ?>
						                        </div>
						                    </div>
						                </div>
						                <div class="card">
						                    <div class="card-header" id="headingTwo">
						                        <h5 class="mb-0">
						                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
						                                <span class="glyphicon glyphicon-plus"></span>
						                                Science
						                            </button>
						                        </h5>
						                    </div>
						                    <?php 
						                    	$headingTwo = array('ACT_Science' => 'ACT Science', 'Anatomy' => 'Anatomy' , 'Anthropology' => 'Anthropology', 'Archaeology' => 'Archaeology', 'Astronomy' => 'Astronomy', 'Biochemistry' => 'Biochemistry', 'Biology' => 'Biology', 'Biostatistics' => 'Biostatistics', 'Botany' => 'Botany', 'Chemical_Engineering' => 'Chemical Engineering', 'Chemistry' => 'Chemistry', 'Civil_Engineering' => 'Civil Engineering', 'Ecology' => 'Ecology', 'Electrical_Engineering' => 'Electrical Engineering', 'Elementary_Science' => 'Elementary Science', 'Epidemiology' => 'Epidemiology','Genetics' => 'Genetics', 'Geology' => 'Geology', 'Mechanical_Engineering' => 'Mechanical Engineering', 'Microbiology' => 'Microbiology', 'Nursing' => 'Nursing', 'Nutrition' => 'Nutrition', 'Organic_Chemistry' => 'Organic Chemistry', 'Pharmacology' => 'Pharmacology', 'Philosophy' => 'Philosophy', 'Physical_Science' => 'Physical Science', 'Physics' => 'Physics', 'Physiology' => 'Physiology', 'Praxis' => 'Praxis', 'PSAT' => 'PSAT', 'Social_Work' => 'Social Work', 'Sociology' => 'Sociology', 'Zoology' => 'Zoology');
						                    ?>
						                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
						                        <div class="card-body">
						                            <?php foreach($headingTwo as $key => $value) { ?>
						                            	<label class="checkbox-inline"><input type="checkbox" name="Science[]" class="checkbox_card" value="<?php echo $key; ?>"><?php echo $value; ?></label>
						                            <?php } ?>
						                        </div>
						                    </div>
						                </div>
						                
						               <div class="card">
						                    <div class="card-header" id="headingTen">
						                        <h5 class="mb-0">
						                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
						                                <span class="glyphicon glyphicon-plus"></span>
						                                Special Needs
						                            </button>
						                        </h5>
						                    </div>
						                    <?php 
						                    	$headingTen = array('ADHD' => 'ADHD', 'Autism_Spectrum_Disorder' => 'Autism Spectrum Disorder (ASD)' , 'Braille' => 'Braille', 'Common_Core' => 'Common Core', 'Dyslexia' => 'Dyslexia', 'Elementary (K-6th)' => 'Elementary (K-6th)', 'Elementary_Math' => 'Elementary Math', 'Elementary_Science' => 'Elementary Science', 'Phonics' => 'Phonics', 'Reading' => 'Reading', 'Special_Needs' => 'Special Needs', 'Study_Skills' => 'Study Skills');
						                    ?>
						                    <div id="collapseTen" class="collapse" aria-labelledby="headingTen" data-parent="#accordionExample">
						                        <div class="card-body">
						                            <?php foreach($headingTen as $key => $value) { ?>
						                            	<label class="checkbox-inline"><input type="checkbox" name="Special_needs[]" class="checkbox_card" value="<?php echo $key; ?>"><?php echo $value; ?></label>
						                            <?php } ?>
						                        </div>
						                    </div>
						                </div>
						                    <div class="card">
						                    <div class="card-header" id="headingEleven">
						                        <h5 class="mb-0">
						                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
						                                <span class="glyphicon glyphicon-plus"></span>
						                                Sports/Recreation
						                            </button>
						                        </h5>
						                    </div>
						                    <?php 
						                    	$headingEleven = array('Ballet' => 'Ballet', 'Ballroom_Dancing' => 'Ballroom Dancing' , 'Baseball' => 'Baseball', 'Basketball' => 'Basketball', 'Bodybuilding' => 'Bodybuilding', 'Bridge' => 'Bridge', 'Chess' => 'Chess', 'Cooking' => 'Cooking', 'Fitness' => 'Fitness', 'Football' => 'Football', 'Gaming (Videogames)' => 'Gaming (Videogames)', 'Golf' => 'Golf', 'Lacrosse' => 'Lacrosse', 'Martial_Arts' => 'Martial Arts', 'Needlework' => 'Needlework', 'Poker' => 'Poker','Salsa_Dancing' => 'Salsa Dancing', 'Sewing' => 'Sewing', 'Soccer' => 'Soccer', 'Softball' => 'Softball', 'Swimming' => 'Swimming', 'Table_Tennis' => 'Table Tennis', 'Tango' => 'Tango', 'Tennis' => 'Tennis', 'Track_Field' => 'Track & Field', 'Volleyball' => 'Volleyball', 'Waterpolo' => 'Waterpolo', 'Yoga' => 'Yoga');
						                    ?>
						                    <div id="collapseEleven" class="collapse" aria-labelledby="headingEleven" data-parent="#accordionExample">
						                        <div class="card-body">
						                            <?php foreach($headingEleven as $key => $value) { ?>
						                            	<label class="checkbox-inline"><input type="checkbox" name="Sports[]" class="checkbox_card" value="<?php echo $key; ?>"><?php echo $value; ?></label>
						                            <?php } ?>
						                        </div>
						                    </div>
						                </div>
						                <div class="card">
						                    <div class="card-header" id="headingFive">
						                        <h5 class="mb-0">
						                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
						                                <span class="glyphicon glyphicon-plus"></span>
						                                Test Preparation
						                            </button>
						                        </h5>
						                    </div>
						                    <?php 
						                    	$headingFive = array('Accuplacer' => 'Accuplacer', 'ACT_English' => 'ACT English' , 'ACT_Math' => 'ACT Math', 'ACT_Reading' => 'ACT Reading', 'ACT_Science' => 'ACT Science', 'ASVAB' => 'ASVAB', 'Bar_Exam' => 'Bar Exam', 'Career_Development' => 'Career Development', 'CBEST' => 'CBEST', 'CFA' => 'CFA', 'College_Counseling' => 'College Counseling', 'Common_Core' => 'Common Core', 'COOP/HSPT' => 'COOP/HSPT', 'GED' => 'GED', 'GMAT' => 'GMAT', 'GRE' => 'GRE','IELTS' => 'IELTS', 'ISEE' => 'ISEE', 'LSAT' => 'LSAT', 'MCAT' => 'MCAT', 'Praxis' => 'Praxis', 'PSAT' => 'PSAT', 'SAT_Math' => 'SAT Math', 'SAT_Reading' => 'SAT Reading', 'SAT_Writing' => 'SAT Writing');
						                    ?>
						                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
						                        <div class="card-body">
						                            <?php foreach($headingFive as $key => $value) { ?>
						                            	<label class="checkbox-inline"><input type="checkbox" name="Test[]" class="checkbox_card" value="<?php echo $key; ?>"><?php echo $value; ?></label>
						                            <?php } ?>
						                        </div>
						                    </div>
						                </div>
						               
						             
						                
						               
						               
						            
						              
						              
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
						                <span class="grad_year_error"></span>
						            </p> 
						            
						        </div>

						        <div class="form-group">
						            <label for="txtHourlyRate">Hourly rate 
						            	<div class="help-tip">
											<p>Crainly’s platform fee is 20%. Average tutors charge between $25 - $50 depending on their experience and subject. You can change this at any time in settings.</p>
										</div> 
									</label>
						            
						            <input type="number" pattern="[0-9]" min="20" max="500" step="1" class="form-control txtHourlyRate" id="txtHourlyRate" name="hourly_rate" required placeholder="Hourly rate">
									<span> Please enter a rate between $20-$50. Rate must be a whole number.</span> 
						            <span class="hourly_rate_error"></span>
						        </div>

						        <div class="form-group">
						            <label for="textareaAddress">Address <div class="help-tip">
											<p>This will not be shown on your profile or to students.</p>
										</div> 
									</label>
						            <!-- <input type="text" class="form-control" id="autocomplete" placeholder="Enter your address" onFocus="geolocate()" name="address" class="form-control textareaAddress" required> -->
						            <input type="text" class="form-control" id="autocomplete" placeholder="Enter your address" onFocus="geolocate()" name="address" class="form-control textareaAddress" required>
						            <input type="hidden" name="street" id="street_number" class="form-control street_number" disabled="true"/>
									<input type="hidden" class="form-control" id="route" disabled="true"/>
									<input class="form-control" type="hidden" name="city" id="locality" disabled="true"/>
									<input class="form-control" id="administrative_area_level_1" type="hidden" name="state" disabled="true"/>
									<input class="form-control" id="postal_code" name="zip" type="hidden" disabled="true"/>
									<input class="form-control" id="country" name="country" type="hidden" disabled="true"/>
							    </div>

						        <div class="form-group">
						            <label for="txtTravelRadius">Travel radius <div class="help-tip">
											<p>The amount of miles you are willing to travel to a student.</p>
										</div> </label>
						            <input type="text" id="txtTravelRadius" name="travel_radius" class="form-control txtTravel" autofocus required=""> 
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
						        <div class="form-group">
						            <label for="txtProfileHeadline">Profile Headline <div class="help-tip">
											<p>This will appear as the cover for your profile. Students will see this before clicking onto your profile. This should be about 1 sentence long.</p>
										</div></label>
						            <input type="text" id="txtProfileHeadline" name="profile_headline" class="form-control txtProfileHeadline" autofocus required=""> 
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
						        </div>
						    </div>
						    <div class="tab">
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
		      
		                        <div class='form-row row'>
		                        	<div class="col-xs-12 form-group" style="text-align: center;">
		                        		<a href="https://connect.stripe.com/oauth/authorize?response_type=code&amp;client_id=ca_32D88BD1qLklliziD7gYQvctJIhWBSQ7&amp;scope=read_write" class="connect-button" target="_blank"><span>Connect with Stripe</span></a>
		                        	</div>
		                        </div>
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
							</div>
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
</body>
</html>