<!doctype html>
<html>
<head>
    <title>Tutor Sign up - <?=$site_settings->site_name?></title>
    <?php $this->load->view('includes/site-master'); ?>
</head>
<body id="home-page" class="register_tutor_page">
    <?php $this->load->view('includes/header-logon'); ?>


    <section id="logOn" style="background-image: url('<?= SITE_IMAGES.'images/'.$register_content['page_image']?>')">
        <div class="flexDv">
            <div class="contain">
                <div class="ouTer">
                    <div class="lSide ckEditor">
                        <?= $register_content['left_section']?>
                    </div>
                    <div class="logBlk">
                        <form action="" method="post" autocomplete="off" class="frmAjax" id="frmSignup_tutor" enctype="multipart/form-data">
                            <h2><?= $register_content['page_heading']?></h2>
                            <!-- One "tab" for each step in the form: -->
                            <div class="tutor-step-form">
                                <span class="step">Basic Information</span>
                                <span class="step">Select Subjects</span>
                                <span class="step">Additional Personal Information</span>
                                <span class="step">Finishing up the Profile</span>
                            </div>
                            <div class="tab">
                                <p>
                                    <input type="text" id="fname" name="fname" class="txtBox" placeholder="First Name" autofocus required="">
                                    <span class="fname_error"></span>
                                </p>
                                <p>
                                    <input type="text" name="lname" id="lname" class="txtBox" placeholder="Last Name">
                                    <span class="lname_error"></span>
                                </p>
                                <p>
                                    <input type="email" id="email" name="email" class="txtBox" placeholder="Email Address">
                                    <span class="email_error"></span>
                                </p> 
                                <p>
                                    <input type="text" id="phone" name="phone" class="txtBox" placeholder="Us Phone Number"> 
                                    <span class="phone_error"></span>
                                </p>
                                <p>
                                    <input type="password" id="password" name="password" class="txtBox" placeholder="Password min 8 character">
                                    <span class="password_error"></span>
                                </p> 
                            </div>
                            <div class="tab">
                                <h2>Choose your Subjects</h2>
                                <span class="tabSub">Select 1-5 subjects you'd like to tutor. You can add more later once you're done signing up.</span>
                                <div class="main_for_check">
                                    <div class="checkSelection">
                                        <hr>
                                            <span class="checkSelect">None Selected</span>
                                        <hr>
                                    </div>
                                    <div class="accordion" id="accordionExample">
                                        <div class="card">
                                            <div class="card-header" id="headingOne">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        <span class="glyphicon glyphicon-minus"></span>
                                                        Math
                                                    </button>
                                                </h5>
                                            </div>

                                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <label class="checkbox-inline"><input type="checkbox" name="Math[]" class="checkbox_card" value="ACT_Math">ACT Math</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Math[]" class="checkbox_card" value="Actuarial_Science">Actuarial Science</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Math[]" class="checkbox_card" value="Algebra_1">Algebra 1</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Math[]" class="checkbox_card" value="Algebra_2">Algebra 2</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Math[]" class="checkbox_card" value="Calculas">Calculas</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Math[]" class="checkbox_card" value="Common_Core">Common Core</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Math[]" class="checkbox_card" value="Econometrics">Econometrics</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Math[]" class="checkbox_card" value="Elementary_(K-6th)">Elementary (K-6th)</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Math[]" class="checkbox_card" value="Elementary_Math">Elementary Math</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Math[]" class="checkbox_card" value="Financial Accounting">Financial Accounting</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Math[]" class="checkbox_card" value="Finite_Math">Finite Math</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Math[]" class="checkbox_card" value="GED">GED</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Math[]" class="checkbox_card" value="GMAT">GMAT</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Math[]" class="checkbox_card" value="GRE">GRE</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Math[]" class="checkbox_card" value="Linear_Algebra">Linear Algebra</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Math[]" class="checkbox_card" value="Managerial_Accounting">Managerial Accounting</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Math[]" class="checkbox_card" value="Microsoft_Excel">Microsoft Excel</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Math[]" class="checkbox_card" value="Pre-Algebra">Pre-Algebra</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Math[]" class="checkbox_card" value="Precalculas">Precalculas</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Math[]" class="checkbox_card" value="Probability">Probability</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Math[]" class="checkbox_card" class="checkbox_card" value="SAT_Math">SAT Math</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Math[]" class="checkbox_card" value="Statistics">Statistics</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Math[]" class="checkbox_card" value="Trigonometry">Trigonometry</label>
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
                                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <label class="checkbox-inline"><input type="checkbox" name="Science[]" class="checkbox_card" value="ACT_Science">ACT Science</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Science[]" class="checkbox_card" value="Anatomy">Anatomy</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Science[]" class="checkbox_card" value="Anthropology">Anthropology</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Science[]" class="checkbox_card" value="Archaeology">Archaeology</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Science[]" class="checkbox_card" value="Astronomy">Astronomy</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Science[]" class="checkbox_card" value="Biochemistry">Biochemistry</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Science[]" class="checkbox_card" value="Biology">Biology</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Science[]" class="checkbox_card" value="Biostatistics">Biostatistics</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Science[]" class="checkbox_card" value="Botany">Botany</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Science[]" class="checkbox_card" value="Chemical_Engineering">Chemical Engineering</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Science[]" class="checkbox_card" value="Chemistry">Chemistry</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Science[]" class="checkbox_card" value="Civil_Engineering">Civil Engineering</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Science[]" class="checkbox_card" value="Ecology">Ecology</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Science[]" class="checkbox_card" value="Electrical_Engineering">Electrical Engineering</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Science[]" class="checkbox_card" value="Elementary_Science">Elementary Science</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Science[]" class="checkbox_card" value="Epidemiology">Epidemiology</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Science[]" class="checkbox_card" value="Genetics">Genetics</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Science[]" class="checkbox_card" value="Geology">Geology</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Science[]" class="checkbox_card" value="Mechanical_Engineering">Mechanical Engineering</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Science[]" class="checkbox_card" value="Microbiology">Microbiology</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Science[]" class="checkbox_card" value="Nursing">Nursing</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Science[]" class="checkbox_card" value="Nutrition">Nutrition</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Science[]" class="checkbox_card" value="Organic_Chemistry">Organic Chemistry</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Science[]" class="checkbox_card" value="Pharmacology">Pharmacology</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Science[]" class="checkbox_card" value="Philosophy">Philosophy</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Science[]" class="checkbox_card" value="Physical_Science">Physical Science</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Science[]" class="checkbox_card" value="Physics">Physics</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Science[]" class="checkbox_card" value="Physiology">Physiology</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Science[]" class="checkbox_card" value="Praxis">Praxis</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Science[]" class="checkbox_card" value="PSAT">PSAT</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Science[]" class="checkbox_card" value="Social_Work">Social Work</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Science[]" class="checkbox_card" value="Sociology">Sociology</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Science[]" class="checkbox_card" value="Zoology">Zoology</label>
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
                                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <label class="checkbox-inline"><input type="checkbox" name="Language[]" class="checkbox_card" value="Arabic">Arabic</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Language[]" class="checkbox_card" value="Braille">Braille</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Language[]" class="checkbox_card" value="Bulgarian">Bulgarian</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Language[]" class="checkbox_card" value="Chinese">Chinese</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Language[]" class="checkbox_card" value="Czech">Czech</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Language[]" class="checkbox_card" value="Dutch">Dutch</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Language[]" class="checkbox_card" value="ESL/ESOL">ESL/ESOL</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Language[]" class="checkbox_card" value="Farsi">Farsi</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Language[]" class="checkbox_card" value="French">French</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Language[]" class="checkbox_card" value="German">German</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Language[]" class="checkbox_card" value="Greek">Greek</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Language[]" class="checkbox_card" value="Hebrew">Hebrew</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Language[]" class="checkbox_card" value="Hindi">Hindi</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Language[]" class="checkbox_card" value="Hungarian">Hungarian</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Language[]" class="checkbox_card" value="IELTS">IELTS</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Language[]" class="checkbox_card" value="Indonesian">Indonesian</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Language[]" class="checkbox_card" value="Italian">Italian</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Language[]" class="checkbox_card" value="Japanese">Japanese</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Language[]" class="checkbox_card" value="Korean">Korean</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Language[]" class="checkbox_card" value="Latin">Latin</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Language[]" class="checkbox_card" value="Polish">Polish</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Language[]" class="checkbox_card" value="Portuguese">Portuguese</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Language[]" class="checkbox_card" value="Reading">Reading</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Language[]" class="checkbox_card" value="Romanian">Romanian</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Language[]" class="checkbox_card" value="Russian">Russian</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Language[]" class="checkbox_card" value="Spanish">Spanish</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Language[]" class="checkbox_card" value="Speech">Speech</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Language[]" class="checkbox_card" value="Thai">Thai</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Language[]" class="checkbox_card" value="TOEFL">TOEFL</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Language[]" class="checkbox_card" value="Turkish">Turkish</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Language[]" class="checkbox_card" value="Urdu">Urdu</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Language[]" class="checkbox_card" value="USCIS">USCIS</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Language[]" class="checkbox_card" value="Vietnamese">Vietnamese</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Language[]" class="checkbox_card" value="Writing">Writing</label>
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
                                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <label class="checkbox-inline"><input type="checkbox" name="English[]" class="checkbox_card" value="ACT_English">ACT English</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="English[]" class="checkbox_card" value="ACT_Reading">ACT Reading</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="English[]" class="checkbox_card" value="Bible_Studies">Bible Studies</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="English[]" class="checkbox_card" value="English">English</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="English[]" class="checkbox_card" value="ESL/ESOL">ESL/ESOL</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="English[]" class="checkbox_card" value="Grammar">Grammar</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="English[]" class="checkbox_card" value="IELTS">IELTS</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="English[]" class="checkbox_card" value="Linguistics">Linguistics</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="English[]" class="checkbox_card" value="Proofreading">Proofreading</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="English[]" class="checkbox_card" value="Public_Speaking">Public Speaking</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="English[]" class="checkbox_card" value="Reading">Reading</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="English[]" class="checkbox_card" value="SAT_Reading">SAT Reading</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="English[]" class="checkbox_card" value="SAT_Writing">SAT Writing</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="English[]" class="checkbox_card" value="TOEFL">TOEFL</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="English[]" class="checkbox_card" value="Vocabulary">Vocabulary</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="English[]" class="checkbox_card" value="Writing">Writing</label>
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
                                            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <label class="checkbox-inline"><input type="checkbox" name="Test[]" class="checkbox_card" value="Accuplacer">Accuplacer</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Test[]" class="checkbox_card" value="ACT_English">ACT English</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Test[]" class="checkbox_card" value="ACT_Math">ACT Math</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Test[]" class="checkbox_card" value="ACT_Reading">ACT Reading</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Test[]" class="checkbox_card" value="ACT_Science">ACT Science</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Test[]" class="checkbox_card" value="ASVAB">ASVAB</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Test[]" class="checkbox_card" value="Bar_Exam">Bar Exam</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Test[]" class="checkbox_card" value="Career_Development">Career Development</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Test[]" class="checkbox_card" value="CBEST">CBEST</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Test[]" class="checkbox_card" value="CFA">CFA</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Test[]" class="checkbox_card" value="College_Counseling">College Counseling</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Test[]" class="checkbox_card" value="Common_Core">Common Core</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Test[]" class="checkbox_card" value="COOP/HSPT">COOP/HSPT</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Test[]" class="checkbox_card" value="GED">GED</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Test[]" class="checkbox_card" value="GMAT">GMAT</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Test[]" class="checkbox_card" value="GRE">GRE</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Test[]" class="checkbox_card" value="IELTS">IELTS</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Test[]" class="checkbox_card" value="ISEE">ISEE</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Test[]" class="checkbox_card" value="LSAT">LSAT</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Test[]" class="checkbox_card" value="MCAT">MCAT</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Test[]" class="checkbox_card" value="Praxis">Praxis</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Test[]" class="checkbox_card" value="PSAT">PSAT</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Test[]" class="checkbox_card" value="SAT_Math">SAT Math</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Test[]" class="checkbox_card" value="SAT_Reading">SAT Reading</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Test[]" class="checkbox_card" value="SAT_Writing">SAT Writing</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="headingSix">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                                        <span class="glyphicon glyphicon-plus"></span>
                                                        COMPUTER
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="Adobe_Flash">Adobe Flash</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="Adobe_Illustrator">Adobe Illustrator</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="Adobe_InDesign">Adobe InDesign</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="Adobe_Lightroom">Adobe Lightroom</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="Adobe_Photoshop">Adobe Photoshop</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="Animation">Animation</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="Autodesk_Maya">Autodesk Maya</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="C">C</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="C#">C#</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="C++">C++</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="COBOL">COBOL</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="Computer_Engineering">Computer Engineering</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="Computer_Gaming">Computer Gaming</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="Computer_Programming">Computer Programming</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="Computer_Science">Computer Science</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="CSS">CSS</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="Dreamweaver">Dreamweaver</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="General_Computer">General Computer</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="GIS">GIS</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" value="Graphic_Design">Graphic Design</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="HTML">HTML</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="Java">Java</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="JavaScript">JavaScript</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="Linux">Linux</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="Macintosh">Macintosh</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="MATLAB">MATLAB</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="Microsoft_Access">Microsoft Access</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="Microsoft Excel">Microsoft Excel</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="Microsoft Outlook">Microsoft Outlook</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="Microsoft Powerpoint">Microsoft Powerpoint</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="Microsoft Project">Microsoft Project</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="Microsoft Publish">Microsoft Publish</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]"class="checkbox_card" value="Microsoft Windows">Microsoft Windows</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="Microsoft Word">Microsoft Word</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="Perl">Perl</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="Photography">Photography</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="PHP">PHP</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="Python">Python</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="QuickBooks">QuickBooks</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="R">R</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="Ruby">Ruby</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="SAS">SAS</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="Sketchup">Sketchup</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="Solidworks">Solidworks</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="SPSS">SPSS</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="SQL">SQL</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="STATA">STATA</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="Swift">Swift</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="Video_Production">Video Production</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="Visual_Basics">Visual Basics</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Computer[]" class="checkbox_card" value="Web_Design">Web Design</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="headingSeven">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                                        <span class="glyphicon glyphicon-plus"></span>
                                                        BUSINESS
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <label class="checkbox-inline"><input type="checkbox" name="Business[]" class="checkbox_card" value="Architecture">Architecture</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Business[]" class="checkbox_card" value="business">Business</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Business[]" class="checkbox_card" value="Career_Development">Career Development</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Business[]" class="checkbox_card" value="ESL/ESOL">ESL/ESOL</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Business[]" class="checkbox_card" value="Finance">Finance</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Business[]" class="checkbox_card" value="Financial_Accounting">Financial Accounting</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Business[]" class="checkbox_card" value="GMAT">GMAT</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Business[]" class="checkbox_card" value="GRE">GRE</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Business[]" class="checkbox_card" value="Law">Law</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Business[]" class="checkbox_card" value="Macroeconomics">Macroeconomics</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Business[]" class="checkbox_card" value="Managerial_Accounting">Managerial Accounting</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Business[]" class="checkbox_card" value="Marketing">Marketing</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Business[]" class="checkbox_card" value="Microeconomics">Microeconomics</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Business[]" class="checkbox_card" value="Project_Management">Project Management</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Business[]" class="checkbox_card" value="Public_Speaking">Public Speaking</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Business[]" class="checkbox_card" value="Tax_Accounting">Tax Accounting</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="headingEight">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                                        <span class="glyphicon glyphicon-plus"></span>
                                                        HISTORY
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <label class="checkbox-inline"><input type="checkbox" name="History[]" class="checkbox_card" value="American_History">American History</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="History[]" class="checkbox_card" value="Anthropology">Anthropology</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="History[]" class="checkbox_card" value="Archaeology">Archaeology</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="History[]" class="checkbox_card" value="Art_History">Art History</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="History[]" class="checkbox_card" value="Classics">Classics</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="History[]" class="checkbox_card" value="Criminal_Justice">Criminal Justice</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="History[]" class="checkbox_card" value="European_History">European History</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="History[]" class="checkbox_card" value="Geography">Geography</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="History[]" class="checkbox_card" value="Government_Politics">Government & Politics</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="History[]" class="checkbox_card" value="Music_History">Music History</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="History[]" class="checkbox_card" value="Political_Science">Political Science</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="History[]" class="checkbox_card" value="Religion">Religion</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="History[]" class="checkbox_card" value="Social_Studies">Social Studies</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="History[]" class="checkbox_card" value="World_History">World History</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="headingNine">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                                        <span class="glyphicon glyphicon-plus"></span>
                                                        MUSIC
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample">
                                                <div class="card-body">
                                                     <label class="checkbox-inline"><input type="checkbox" name="Music[]" class="checkbox_card" value="Cello">Cello</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Music[]" class="checkbox_card" value="Clarinet">Clarinet</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Music[]" class="checkbox_card" value="Composition">Composition</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Music[]" class="checkbox_card" value="Drums">Drums</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Music[]" class="checkbox_card" value="Ear_Training">Ear Training</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Music[]" class="checkbox_card" value="Flute">Flute</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Music[]" class="checkbox_card" value="French_Horn">French Horn</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Music[]" class="checkbox_card" value="General_Music">General Music</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Music[]" class="checkbox_card" value="Guitar">Guitar</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Music[]" class="checkbox_card" value="Harp">Harp</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Music[]" class="checkbox_card" value="Jazz">Jazz</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Music[]" class="checkbox_card" value="Harp">Harp</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Music[]" class="checkbox_card" value="Music_History">Music History</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Music[]" class="checkbox_card" value="Music_Production">Music Production</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Music[]" class="checkbox_card" value="Music_Theory">Music Theory</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Music[]" class="checkbox_card" value="Oboe">Oboe</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Music[]" class="checkbox_card" value="Piano">Piano</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Music[]" class="checkbox_card" value="Salsa">Salsa</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Music[]" class="checkbox_card" value="Saxophone">Saxophone</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Music[]" class="checkbox_card" value="Sight_Singing">Sight Singing</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Music[]" class="checkbox_card" value="Songwriting">Songwriting</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Music[]" class="checkbox_card" value="Trombone">Trombone</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Music[]" class="checkbox_card" value="Trumpet">Trumpet</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Music[]" class="checkbox_card" value="Violin">Violin</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Music[]" class="checkbox_card" value="Voice">Voice (Music)</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="headingTen">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                                                        <span class="glyphicon glyphicon-plus"></span>
                                                        SPECIAL NEEDS
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="collapseTen" class="collapse" aria-labelledby="headingTen" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <label class="checkbox-inline"><input type="checkbox" name="Special_needs[]" class="checkbox_card" value="ADHD">ADHD</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Special_needs[]" class="checkbox_card" value="Autism_Spectrum_Disorder">Autism Spectrum Disorder (ASD)</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Special_needs[]" class="checkbox_card" value="Braille">Braille</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Special_needs[]" class="checkbox_card" value="Common_Core">Common Core</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Special_needs[]" class="checkbox_card" value="Dyslexia">Dyslexia</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Special_needs[]" class="checkbox_card" value="Elementary (K-6th)">Elementary (K-6th)</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Special_needs[]" class="checkbox_card" value="Elementary_Math">Elementary Math</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Special_needs[]" class="checkbox_card" value="Elementary_Science">Elementary Science</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Special_needs[]" class="checkbox_card" value="Phonics">Phonics</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Special_needs[]" class="checkbox_card" value="Reading">Reading</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Special_needs[]" class="checkbox_card" value="Special_Needs">Special Needs</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Special_needs[]" class="checkbox_card" value="Study_Skills">Study Skills</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="headingEleven">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                                                        <span class="glyphicon glyphicon-plus"></span>
                                                        SPORTS/RECREATION
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="collapseEleven" class="collapse" aria-labelledby="headingEleven" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <label class="checkbox-inline"><input type="checkbox" name="Sports[]" class="checkbox_card" value="Ballet">Ballet</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Sports[]" class="checkbox_card" value="Ballroom_Dancing">Ballroom Dancing</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Sports[]" class="checkbox_card" value="Baseball">Baseball</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Sports[]" class="checkbox_card" value="Basketball">Basketball</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Sports[]" class="checkbox_card" value="Bodybuilding">Bodybuilding</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Sports[]" class="checkbox_card" value="Bridge">Bridge</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Sports[]" class="checkbox_card" value="Chess">Chess</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Sports[]" class="checkbox_card" value="Cooking">Cooking</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Sports[]" class="checkbox_card" value="Fitness">Fitness</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Sports[]" class="checkbox_card" value="Football">Football</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Sports[]" class="checkbox_card" value="Gaming (Videogames)">Gaming (Videogames)</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Sports[]" class="checkbox_card" value="Golf">Golf</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Sports[]" class="checkbox_card" value="Lacrosse">Lacrosse</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Sports[]" class="checkbox_card" value="Martial_Arts">Martial Arts</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Sports[]" class="checkbox_card" value="Needlework">Needlework</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Sports[]" class="checkbox_card" value="Poker">Poker</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Sports[]" class="checkbox_card" value="Salsa_Dancing">Salsa Dancing</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Sports[]" class="checkbox_card" value="Sewing">Sewing</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Sports[]" class="checkbox_card" value="Soccer">Soccer</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Sports[]" class="checkbox_card" value="Softball">Softball</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Sports[]" class="checkbox_card" value="Swimming">Swimming</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Sports[]" class="checkbox_card" value="Table_Tennis">Table Tennis</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Sports[]" class="checkbox_card" value="Tango">Tango</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Sports[]" class="checkbox_card" value="Tennis">Tennis</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Sports[]" class="checkbox_card" value="Track_Field">Track & Field</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Sports[]" class="checkbox_card" value="Volleyball">Volleyball</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Sports[]" class="checkbox_card" value="Waterpolo">Waterpolo</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Sports[]" class="checkbox_card" value="Yoga">Yoga</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="headingTweleve">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTweleve" aria-expanded="false" aria-controls="collapseTweleve">
                                                        <span class="glyphicon glyphicon-plus"></span>
                                                        ART
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="collapseTweleve" class="collapse" aria-labelledby="headingTweleve" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <label class="checkbox-inline"><input type="checkbox" name="Art[]" class="checkbox_card" value="Adobe_Photoshop">Adobe Photoshop</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Art[]" class="checkbox_card" value="Animation">Animation</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Art[]" class="checkbox_card" value="Architecture">Architecture</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Art[]" class="checkbox_card" value="Art_History">Art History</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Art[]" class="checkbox_card" value="Art_Theory">Art Theory</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Art[]" class="checkbox_card" value="Ballroom_Dancing">Ballroom Dancing</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Art[]" class="checkbox_card" value="Cinema">Cinema</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Art[]" class="checkbox_card" value="Composition (Music)">Composition (Music)</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Art[]" class="checkbox_card" value="Cosmetology">Cosmetology</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Art[]" class="checkbox_card" value="Drawing">Drawing</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Art[]" class="checkbox_card" value="Film">Film</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Art[]" class="checkbox_card" value="Graphic_Design">Graphic Design</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Art[]" class="checkbox_card" value="Painting">Painting</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Art[]" class="checkbox_card" value="Photography">Photography</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Art[]" class="checkbox_card" value="Salsa_Dancing">Salsa Dancing</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Art[]" class="checkbox_card" value="Theater">Theater</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Art[]" class="checkbox_card" value="Video_Production">Video Production</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="headingThirteen">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen">
                                                        <span class="glyphicon glyphicon-plus"></span>
                                                        ELEMENTARY EDUCATION
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="collapseThirteen" class="collapse" aria-labelledby="headingThirteen" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <label class="checkbox-inline"><input type="checkbox" name="Education[]" class="checkbox_card" value="Common_Core">Common Core</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Education[]" class="checkbox_card" value="Elementary_(K-6th)">Elementary (K-6th)</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Education[]" class="checkbox_card" value="Elementary_Math">Elementary Math</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Education[]" class="checkbox_card" value="Elementary_Science">Elementary Science</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Education[]" class="checkbox_card" value="Grammar">Grammar</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Education[]" class="checkbox_card" value="Handwriting">Handwriting</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Education[]" class="checkbox_card" value="Homeschool">Homeschool</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Education[]" class="checkbox_card" value="Phonics">Phonics</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Education[]" class="checkbox_card" value="Reading">Reading</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Education[]" class="checkbox_card" value="Spelling">Spelling</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Education[]" class="checkbox_card" value="Study_Skills">Study Skills</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Education[]" class="checkbox_card" value="Vocabulary">Vocabulary</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="Education[]" class="checkbox_card" value="Writing">Writing</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab">
                                <div class="form-group">
                                    <label for="txtCollege">Education</label>
                                    <p>
                                        <input type="text" class="form-control txtCollege" id="txtCollege" name="college" class="txtCollege" required placeholder="College">
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
                                    <label for="txtHourlyRate">Hourly rate</label>
                                    <input type="number" min="20" step="20" class="form-control txtHourlyRate" id="txtHourlyRate" name="hourly_rate" required placeholder="Hourly rate">
                                </div>

                                <div class="form-group">
                                    <label for="textareaAddress">Address</label>
                                    <textarea class="form-control" id="textareaAddress" name="address" class="form-control textareaAddress" required rows="3"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="txtTravelRadius">Travel radius</label>
                                    <input type="text" id="txtTravelRadius" name="travel_radius" class="form-control txtTravel" autofocus required=""> 
                                    <span class="travel_radius_error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="selectCancelPolicy">Cancellation policy</label>
                                    <select class="form-control selectCancelPolicy" id="selectCancelPolicy" name="selectCancelPolicy">
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
                                    <label for="txtProfileHeadline">Profile Headline</label>
                                    <input type="text" id="txtProfileHeadline" name="profile_headline" class="form-control txtProfileHeadline" autofocus required=""> 
                                    <span class="profile_headline_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="txtProfilePhoto">Profile Photo</label>
                                    <input type="file" id="txtProfilePhoto" name="profile_photo" class="form-control-file txtProfilePhoto" required> 
                                    <span class="profile_photo_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="txtBio">Bio</label>
                                    <textarea class="form-control" id="textareaBio" name="bio" class="form-control textareaBio" required rows="3"></textarea>
                                </div>
                            </div>
                            <div class="rememberMe">
                                <div class="lblBtn">
                                   <!--  <input type="checkbox" name="confirm" id="confirm"> -->
                                    <label for="confirm">By clicking Sign up, Continue with Facebook, or Continue with Google, you agree to our 
                                        <a href="<?= site_url('terms-services')?>">Terms and Conditions,</a>
                                        and
                                        <a href="<?= site_url('privacy-policy')?>">Privacy Policy.</a>
                                    </label>
                                </div>
                            </div>
                            <div class="bTn text-center">
                                <button type="button" id="prevBtn" class="webBtn colorBtn lgBtn" onclick="nextPrev(-1)">Previous</button>
                                <button type="button" class="webBtn colorBtn lgBtn" id="nextBtn" onclick="nextPrev(1)">Apply <i class="fa fa-spinner fa-pulse fa-1x fa-fw hidden"></i></button>
                            </div>
                            <div class="alertMsg" style="display:none"></div>
                        </form>
                        <div class="haveAccount text-center">
                            <span>Already have an account?</span>
                            <a href="<?= site_url('login')?>">Sign In</a>
                        </div>
                        <ul class="miniNav">
                            <li><a href="<?= site_url('privacy-policy')?>">Privacy Policy</a></li>
                            <li><a href="<?= site_url('contact-us')?>">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  logOn -->


    <?php //require_once('includes/footer.php');?>
    <script type="text/javascript" src="<?= base_url('assets/js/additional-methods.js')?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/custom.js') ?>"></script>
</body>
</html>