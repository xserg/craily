<?php
class Subjects extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->isLogged();
        has_access(4);
        $this->load->model('subject_model');
    }

    function index() {
        // $subject = array('1' => 'Art', '2' => 'Business', '3' => 'Computer', '4' => 'Elementary Education', '5' => 'English', '6' => 'History', '7' => 'Language', '8' => 'Math', '9' => 'Music', '10' => 'Science', '11' => 'Special Needs', '12' => 'Sports/Recreation', '13' => 'Test Preparation');
        // $sub_subject = [
        //     '1'=>array('Adobe_Photoshop' => 'Adobe Photoshop', 'Animation' => 'Animation' , 'Architecture' => 'Architecture', 'Art_History' => 'Art History', 'Art_Theory' => 'Art Theory', 'Ballroom_Dancing' => 'Ballroom Dancing', 'Cinema' => 'Cinema', 'Composition (Music)' => 'Composition (Music)', 'Cosmetology' => 'Cosmetology', 'Drawing' => 'Drawing', 'Film' => 'Film', 'Graphic_Design' => 'Graphic Design', 'Painting' => 'Painting', 'Photography' => 'Photography', 'Salsa_Dancing' => 'Salsa Dancing', 'Theater' => 'Theater', 'Video_Production' => 'Video Production' ),
        //     '2'=>array('Architecture' => 'Architecture', 'business' => 'Business' , 'Career_Development' => 'Career Development', 'ESL/ESOL' => 'ESL/ESOL', 'Finance' => 'Finance', 'Financial_Accounting' => 'Financial Accounting', 'GMAT' => 'GMAT', 'GRE' => 'GRE', 'Law' => 'Law', 'Macroeconomics' => 'Macroeconomics', 'Managerial_Accounting' => 'Managerial Accounting', 'Marketing' => 'Marketing', 'Microeconomics' => 'Microeconomics', 'Project_Management' => 'Project Management', 'Public_Speaking' => 'Public Speaking', 'Tax_Accounting' => 'Tax Accounting'),
        //     '3'=>array('Adobe_Flash' => 'Adobe Flash', 'Adobe_Illustrator' => 'Adobe Illustrator' , 'Adobe_InDesign' => 'Adobe InDesign', 'Adobe_Lightroom' => 'Adobe Lightroom', 'Adobe_Photoshop' => 'Adobe Photoshop', 'Animation' => 'Animation', 'Autodesk_Maya' => 'Autodesk Maya', 'C' => 'C', 'C#' => 'C#', 'C++' => 'C++', 'COBOL' => 'COBOL', 'Computer_Engineering' => 'Computer Engineering', 'Computer_Gaming' => 'Computer_Gaming', 'Computer_Programming' => 'Computer Programming', 'Computer_Science' => 'Computer Science', 'CSS' => 'CSS','Dreamweaver' => 'Dreamweaver', 'General_Computer' => 'General Computer', 'GIS' => 'GIS', 'Graphic_Design' => 'Graphic Design', 'HTML' => 'HTML', 'Java' => 'Java', 'JavaScript' => 'JavaScript', 'Linux' => 'Linux', 'Macintosh' => 'Macintosh', 'MATLAB' => 'MATLAB', 'Microsoft_Access' => 'Microsoft Access', 'Microsoft_Excel' => 'Microsoft Excel', 'Microsoft_Outlook' => 'Microsoft Outlook', 'Microsoft_Powerpoint' => 'Microsoft Powerpoint', 'Microsoft_Project' => 'Microsoft Project', 'Microsoft_Publish' => 'Microsoft Publish', 'Microsoft_Windows' => 'Microsoft Windows', 'Microsoft_Word' => 'Microsoft Word', 'Perl' => 'Perl', 'Photography' => 'Photography', 'PHP' => 'PHP', 'Python' => 'Python', 'QuickBooks' => 'QuickBooks', 'R' => 'R', 'Ruby' => 'Ruby','SAS' => 'SAS', 'Sketchup' => 'Sketchup', 'Solidworks' => 'Solidworks', 'SPSS' => 'SPSS', 'SQL' => 'SQL', 'STATA' => 'STATA', 'Swift' => 'Swift', 'Video_Production' => 'Video Production', 'Visual_Basics' => 'Visual Basics', 'Web_Design' => 'Web Design'),
        //     '4'=>array('Common_Core' => 'Common Core', 'Elementary_(K-6th)' => 'Elementary (K-6th)' , 'Elementary_Math' => 'Elementary Math', 'Elementary_Science' => 'Elementary Science', 'Grammar' => 'Grammar', 'Handwriting' => 'Handwriting', 'Homeschool' => 'Homeschool', 'Phonics' => 'Phonics', 'Reading' => 'Reading', 'Spelling' => 'Spelling', 'Study_Skills' => 'Study Skills', 'Vocabulary' => 'Vocabulary', 'Writing' => 'Writing'),
        //     '5'=>array('ACT_English' => 'ACT English', 'ACT_Reading' => 'ACT Reading' , 'Bible_Studies' => 'Bible Studies', 'English' => 'English', 'ESL/ESOL' => 'ESL/ESOL', 'Grammar' => 'Grammar', 'IELTS' => 'IELTS', 'Linguistics' => 'Linguistics', 'Proofreading' => 'Proofreading', 'Public_Speaking' => 'Public Speaking', 'Reading' => 'Reading', 'SAT_Reading' => 'SAT Reading', 'SAT_Writing' => 'SAT Writing', 'TOEFL' => 'TOEFL', 'Vocabulary' => 'Vocabulary', 'Writing' => 'Writing'),
        //     '6'=>array('American_History' => 'American History', 'Anthropology' => 'Anthropology' , 'Archaeology' => 'Archaeology', 'Art_History' => 'Art History', 'Classics' => 'Classics', 'Criminal_Justice' => 'Criminal Justice', 'European_History' => 'European History', 'Geography' => 'Geography', 'Government_Politics' => 'Government & Politics', 'Music_History' => 'Music History', 'Political_Science' => 'Political Science', 'Religion' => 'Religion', 'Social_Studies' => 'Social Studies', 'World_History' => 'World History'),
        //     '7'=>array('Arabic' => 'Arabic', 'Braille' => 'Braille' , 'Bulgarian' => 'Bulgarian', 'Chinese' => 'Chinese', 'Czech' => 'Czech', 'Dutch' => 'Dutch', 'ESL/ESOL' => 'ESL/ESOL', 'Farsi' => 'Farsi', 'French' => 'French', 'German' => 'German', 'Greek' => 'Greek', 'Hebrew' => 'Hebrew', 'Hindi' => 'Hindi', 'Hungarian' => 'Hungarian', 'IELTS' => 'IELTS', 'Indonesian' => 'Indonesian','Italian' => 'Italian', 'Japanese' => 'Japanese', 'Korean' => 'Korean', 'Latin' => 'Latin', 'Polish' => 'Polish', 'Portuguese' => 'Portuguese', 'Reading' => 'Reading', 'Romanian' => 'Romanian', 'Russian' => 'Russian', 'Spanish' => 'Spanish', 'Speech' => 'Speech', 'Thai' => 'Thai', 'TOEFL' => 'TOEFL', 'Turkish' => 'Turkish', 'Urdu' => 'Urdu', 'USCIS' => 'USCIS', 'Vietnamese' => 'Vietnamese', 'Writing' => 'Writing'),
        //     '8'=>array('ACT_Math' => 'ACT Math', 'Actuarial_Science' => 'Actuarial Science' , 'Algebra_1' => 'Algebra 1', 'Algebra_2' => 'Algebra 2', 'Calculas' => 'Calculas', 'Common_Core' => 'Common Core', 'Econometrics' => 'Econometrics', 'Elementary_(K-6th)' => 'Elementary (K-6th)', 'Elementary_Math' => 'Elementary Math', 'Financial_Accounting' => 'Financial Accounting', 'Finite_Math' => 'Finite Math', 'GED' => 'GED', 'GMAT' => 'GMAT', 'GRE' => 'GRE', 'Linear_Algebra' => 'Linear Algebra', 'Managerial_Accounting' => 'Managerial Accounting','Microsoft_Excel' => 'Microsoft Excel', 'Pre-Algebra' => 'Pre-Algebra', 'Precalculas' => 'Precalculas', 'Probability' => 'Probability', 'SAT_Math' => 'SAT Math', 'Statistics' => 'Statistics', 'Trigonometry' => 'Trigonometry'),
        //     '9'=>array('Cello' => 'Cello', 'Clarinet' => 'Clarinet' , 'Composition' => 'Composition', 'Drums' => 'Drums', 'Ear_Training' => 'Ear Training', 'Flute' => 'Flute', 'French_Horn' => 'French Horn', 'General_Music' => 'General Music', 'Guitar' => 'Guitar', 'Harp' => 'Harp', 'Jazz' => 'Jazz', 'Harp' => 'Harp', 'Music_History' => 'Music History', 'Music_Production' => 'Music Production', 'Music_Theory' => 'Music Theory', 'Oboe' => 'Oboe','Piano' => 'Piano', 'Salsa' => 'Salsa', 'Saxophone' => 'Saxophone', 'Sight_Singing' => 'Sight Singing', 'Songwriting' => 'Songwriting', 'Trombone' => 'Trombone', 'Trumpet' => 'Trumpet', 'Violin' => 'Violin', 'Voice' => 'Voice (Music)'),
        //     '10'=>array('ACT_Science' => 'ACT Science', 'Anatomy' => 'Anatomy' , 'Anthropology' => 'Anthropology', 'Archaeology' => 'Archaeology', 'Astronomy' => 'Astronomy', 'Biochemistry' => 'Biochemistry', 'Biology' => 'Biology', 'Biostatistics' => 'Biostatistics', 'Botany' => 'Botany', 'Chemical_Engineering' => 'Chemical Engineering', 'Chemistry' => 'Chemistry', 'Civil_Engineering' => 'Civil Engineering', 'Ecology' => 'Ecology', 'Electrical_Engineering' => 'Electrical Engineering', 'Elementary_Science' => 'Elementary Science', 'Epidemiology' => 'Epidemiology','Genetics' => 'Genetics', 'Geology' => 'Geology', 'Mechanical_Engineering' => 'Mechanical Engineering', 'Microbiology' => 'Microbiology', 'Nursing' => 'Nursing', 'Nutrition' => 'Nutrition', 'Organic_Chemistry' => 'Organic Chemistry', 'Pharmacology' => 'Pharmacology', 'Philosophy' => 'Philosophy', 'Physical_Science' => 'Physical Science', 'Physics' => 'Physics', 'Physiology' => 'Physiology', 'Praxis' => 'Praxis', 'PSAT' => 'PSAT', 'Social_Work' => 'Social Work', 'Sociology' => 'Sociology', 'Zoology' => 'Zoology'),
        //     '11'=>array('ADHD' => 'ADHD', 'Autism_Spectrum_Disorder' => 'Autism Spectrum Disorder (ASD)' , 'Braille' => 'Braille', 'Common_Core' => 'Common Core', 'Dyslexia' => 'Dyslexia', 'Elementary (K-6th)' => 'Elementary (K-6th)', 'Elementary_Math' => 'Elementary Math', 'Elementary_Science' => 'Elementary Science', 'Phonics' => 'Phonics', 'Reading' => 'Reading', 'Special_Needs' => 'Special Needs', 'Study_Skills' => 'Study Skills'),
        //     '12'=>array('Ballet' => 'Ballet', 'Ballroom_Dancing' => 'Ballroom Dancing' , 'Baseball' => 'Baseball', 'Basketball' => 'Basketball', 'Bodybuilding' => 'Bodybuilding', 'Bridge' => 'Bridge', 'Chess' => 'Chess', 'Cooking' => 'Cooking', 'Fitness' => 'Fitness', 'Football' => 'Football', 'Gaming (Videogames)' => 'Gaming (Videogames)', 'Golf' => 'Golf', 'Lacrosse' => 'Lacrosse', 'Martial_Arts' => 'Martial Arts', 'Needlework' => 'Needlework', 'Poker' => 'Poker','Salsa_Dancing' => 'Salsa Dancing', 'Sewing' => 'Sewing', 'Soccer' => 'Soccer', 'Softball' => 'Softball', 'Swimming' => 'Swimming', 'Table_Tennis' => 'Table Tennis', 'Tango' => 'Tango', 'Tennis' => 'Tennis', 'Track_Field' => 'Track & Field', 'Volleyball' => 'Volleyball', 'Waterpolo' => 'Waterpolo', 'Yoga' => 'Yoga'),
        //     '13'=>array('Accuplacer' => 'Accuplacer', 'ACT_English' => 'ACT English' , 'ACT_Math' => 'ACT Math', 'ACT_Reading' => 'ACT Reading', 'ACT_Science' => 'ACT Science', 'ASVAB' => 'ASVAB', 'Bar_Exam' => 'Bar Exam', 'Career_Development' => 'Career Development', 'CBEST' => 'CBEST', 'CFA' => 'CFA', 'College_Counseling' => 'College Counseling', 'Common_Core' => 'Common Core', 'COOP/HSPT' => 'COOP/HSPT', 'GED' => 'GED', 'GMAT' => 'GMAT', 'GRE' => 'GRE','IELTS' => 'IELTS', 'ISEE' => 'ISEE', 'LSAT' => 'LSAT', 'MCAT' => 'MCAT', 'Praxis' => 'Praxis', 'PSAT' => 'PSAT', 'SAT_Math' => 'SAT Math', 'SAT_Reading' => 'SAT Reading', 'SAT_Writing' => 'SAT Writing')
        // ];
        
        // foreach ($subject as $key => $value) {
        //     $tblSubjects = array('encoded_id'=>doEncode('sub-'.$id), 'parent_id' => 0, 'slug' => strtolower($value), 'name' => $value, 'status' => 1 );
        //     $id = $this->master->save('subjects', $tblSubjects);

        //     foreach ($sub_subject[$key] as $k => $val) {
        //         $tblSub = array('encoded_id'=>doEncode('sub-'.$id), 'parent_id' => $id, 'slug' => strtolower($val), 'name' => $val, 'status' => 1 );
        //         $sub_id = $this->master->save('subjects', $tblSub);
        //     }
        // }

        
        $this->data['enable_datatable'] = TRUE;
        $this->data['pageView'] = ADMIN . '/subjects';
        $this->data['rows'] = $this->subject_model->get_subjects(0);
        $this->load->view(ADMIN.'/includes/siteMaster', $this->data);
    }

    function manage() {        
        $this->data['pageView'] = ADMIN . '/subjects';
        if ($this->input->post()) {
            $vals = $this->input->post();

            $vals['slug'] = toSlugUrl($vals['name']);
            $id=$this->subject_model->save($vals, $this->uri->segment(4));
            $this->subject_model->save(array('encoded_id'=>doEncode('sub-'.$id)), $id);
            setMsg('success', 'Subject has been saved successfully.');
            redirect(ADMIN . '/subjects', 'refresh');
            exit;
        }
        $this->data['row'] = $this->subject_model->get_row($this->uri->segment('4'));
        $this->load->view(ADMIN.'/includes/siteMaster', $this->data);
    }

    function delete($id=0) {
        has_access(10);
        $id=intval($id);
        if($this->subject_model->get_row_where(array('id'=>$id,'parent_id'=>0))){
            $this->subject_model->delete($id);
            $this->subject_model->delete($id,'parent_id');
            setMsg('success', 'Subject has been deleted successfully.');
            redirect(ADMIN . '/subjects', 'refresh');
            exit;
        }
        else
            show_404();
    }

    /*** start sub subjects ***/

    function manage_subsubject($parent_id=0) {
        if($this->data['main_subject'] = $this->subject_model->get_row_where(array('id'=>$parent_id,'parent_id'=>0))){

            $this->data['pageView'] = ADMIN . '/sub-subjects';
            if ($this->input->post()) {
                $vals = $this->input->post();
                $vals['slug'] = toSlugUrl($vals['name']);
                $vals['parent_id']=$parent_id;
                $id=$this->subject_model->save($vals, $this->uri->segment(5));
                $this->subject_model->save(array('encoded_id'=>doEncode('sub-'.$id)), $id);
                setMsg('success', 'Sub Subject has been saved successfully.');
                redirect(ADMIN . '/subjects/sub/'.$parent_id, 'refresh');
                exit;
            }
            $this->data['row'] = $this->subject_model->get_row($this->uri->segment(5));
            $this->load->view(ADMIN.'/includes/siteMaster', $this->data);
        }
        else
            show_404();
    }

    function sub($id=0) {
        if($this->data['main_subject']=$this->subject_model->get_row($id)){
            $this->data['enable_datatable'] = TRUE;
            $this->data['pageView'] = ADMIN . '/sub-subjects';
            $this->data['rows'] = $this->subject_model->get_sub_subjects($id);
            $this->data['add_url'] = site_url(ADMIN . '/subjects/manage-subsubject/'.$id);
            $this->load->view(ADMIN . '/includes/siteMaster', $this->data);
        }
        else
            show_404();
    }

    function delete_subsubject($id=0) {
        has_access(10);
        $id=intval($id);
        if($this->subject_model->get_row_where(array('id'=>$id,'parent_id<>'=>0))){
            $this->subject_model->delete($id);
            setMsg('success', 'Sub Subject has been deleted successfully.');
            redirect(ADMIN . '/sub-subjects', 'refresh');
            exit;
        }
        else
            show_404();
    }

    /*** end sub subjects ***/
}
?>