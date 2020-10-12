Hello Team,
Please follow this files and methods to update (files name and file path mentions belows).


Excute Mysql Queries in mysql database:

ALTER TABLE `tbl_lessons` CHANGE `video_start_time` `video_start_time` DATETIME NULL DEFAULT NULL;
ALTER TABLE `tbl_lessons` CHANGE `video_end_time` `video_end_time` DATETIME NULL DEFAULT NULL;

Updated following files & methods :

1) main-header.php (application/views/include/lecture/main_header.php)

2) index.php (application/views/lecture/index.php)


3) Lecture.php (application/controllers/Lecture.php)
i)   ADDED DEFAULT TIMEZONE in __construct: date_default_timezone_set('America/Los_Angeles');
ii)  ADDED MODAL: $this->load->model('lesson_model');
iii) create new : startSession function place of index method
	Method : 
		a) startSession()
		b) convertToHoursMins()

4) My_lessons.php (application/controllers/My_lessons.php)
Method : index()

5) Add a new route in route.php (Application/config/route.php)
  $route['lecture/start/(:any)'] = 'lecture/startSession/$1';

6) Model -> Lesson_model.php (Application/modal/Lesson_model.php)
	Add new function :  get_tutor_lesson()

7) Added js file : jquery.countdownTimer.min.js
	path : assets/lecture/js/jquery.countdownTimer.min.js

8) Timer update using session hour wise and start time according to session hours