<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['404_override'] = 'page/error';

$route['default_controller'] = 'index';
$route['translate_uri_dashes'] = TRUE;

$route['admin/login'] = 'admin/index/login';
$route['admin/logout'] = 'admin/index/logout';

$route['home'] = 'index';
$route['terms-services'] = 'page/terms_services';
$route['privacy-policy'] = 'page/privacy_policy';
$route['contact-us'] = 'page/contact';
$route['about-us'] = 'page/about';
$route['help'] = 'page/help';
//$route['faq'] = 'page/faq';

$route['facebook-login'] = 'index/facebook_login';
$route['google-login'] = 'index/google_login';
$route['google-callback'] = 'ajax/google_callback';

$route['login'] = 'index/login';
$route['logout'] = 'index/logout';
$route['forgot-password'] = 'index/forgot';
$route['verification/(:any)'] = 'index/verification/$1';
$route['reset/(:any)'] = 'index/reset/$1';
$route['reset-password'] = 'index/reset_password';
$route['signup'] = 'index/register';
$route['rs/(:any)'] = 'index/register/$1';
$route['tutor-signup'] = 'index/tutor_register';
$route['tutor-multi-signup'] = 'index/tutor_multi_signup';
$route['stripe-success'] = 'index/stripe_success';
$route['rts/(:any)'] = 'index/tutor_register/$1';
$route['become-a-tutor'] = 'index/become_tutor';
$route['stripe-register'] = 'index/stripe_register';
$route['search-subject'] = 'ajax/search_subject';

$route['search'] = 'index/search';



$route['upload-attachment'] = 'uploader/save_attachment';

$route['email-verification'] = 'account/email_verification';
$route['resend-email'] = 'account/resend-email';
$route['phone-verification'] = 'account/phone_verification';
$route['verify-phone'] = 'account/verify_phone';
$route['verify-phone-code'] = 'account/verify_phone_code';
$route['change-phone'] = 'account/change_phone';

// $route['dashboard'] = 'account/dashboard';
$route['account-settings'] = 'account/account_settings';
$route['availability'] = 'account/availability';
$route['additional-subjects'] = 'account/additional_subjects';
$route['additional-info'] = 'account/additional_info';
$route['education'] = 'account/education';
$route['experience'] = 'account/experience';
$route['setonlinelesson'] = 'account/setonlinelesson';


$route['change-password'] = 'account/change_pswd';
$route['invite-friend'] = 'account/invite_friend';


$route['share-profile'] = 'account/share_profile';

/*** start payments ***/
$route['direct-deposit'] = 'payment_methods/direct_deposit';
$route['add-bank-account'] = 'payment_methods/add_bank';
$route['delete-method/(:any)'] = 'payment_methods/delete/$1';
$route['make-default/(:any)'] = 'payment_methods/make_default/$1';
$route['edit-info/(:any)'] = 'payment_methods/update_bank/$1';

$route['transactions'] = 'payment_methods/transactions';
$route['transaction-detail'] = 'payment_methods/transaction_detail';
$route['withdraw'] = 'payment_methods/withdraw';
/*** end payments ***/

/*$route['save-settings'] = 'account/save_settings';
$route['report-profile'] = 'account/report_profile';*/



/*** start lessons ***/
$route['get-admin-request-detail'] = 'admin/lessons/lesson_request_detail';

$route['my-tutors'] = 'my_lessons/my_tutors';
$route['my-tutors/(:num)'] = 'my_lessons/my_tutors/$1';
$route['book-lesson/(:any)'] = 'my_lessons/book_lesson/$1';
$route['purchase-back-check/(:any)'] = 'my_lessons/book_chat_lesson/$1';
$route['book-chat-lesson/(:any)'] = 'my_lessons/book_chat_lesson/$1';


$route['requests'] = 'my_lessons/requests';
$route['requests/(:num)'] = 'my_lessons/requests/$1';
$route['lesson-requests'] = 'my_lessons/requests';
$route['lesson-requests/(:num)'] = 'my_lessons/requests/$1';

$route['requests/payment/(:any)'] = 'my_lessons/request_payment/$1';
$route['get-request-detail'] = 'my_lessons/lesson_request_detail';
$route['reject-lesson-request'] = 'my_lessons/reject_lesson_request';
$route['accept-lesson-request'] = 'my_lessons/accept_lesson_request';
$route['book-now'] = 'my_lessons/book_now';

$route['check_coupon'] = 'my_lessons/check_coupon';


$route['my-lessons'] = 'my_lessons/index';
$route['lesson-detail'] = 'my_lessons/lesson_detail';
$route['mark-complete-lesson'] = 'my_lessons/mark_complete_lesson';
$route['complete-lesson'] = 'my_lessons/complete_lesson';
$route['mark-cancel-lesson'] = 'my_lessons/mark_cancel_lesson';
$route['cancel-lesson'] = 'my_lessons/cancel_lesson';
$route['join-lecture/(:any)'] = 'my_lessons/join_lecture/$1';
$route['video-lecture-completed'] = 'my_lessons/video_completed';

/*** end lessons ***/

/*** start jobs ***/
$route['my-jobs'] = 'my_jobs/index';
$route['add-new-job'] = 'my_jobs/add_new';
$route['edit-job'] = 'my_jobs/edit';
$route['get-job'] = 'my_jobs/get_job';
$route['delete-job'] = 'my_jobs/delete';
$route['job-detail/(:any)'] = 'my_jobs/detail/$1';
$route['search-jobs'] = 'index/search_jobs';
/*** end jobs ***/

/*** start messages ***/
$route['messages/(:any)'] = 'messages/index/$1';
$route['send-msg'] = 'messages/send_msg';
$route['send-noti-msg'] = 'messages/send_noti_msg';
$route['get-chat'] = 'messages/get_chat_msgs';
/*** end messages ***/

$route['favorite'] = 'common/favorite';
$route['rate'] = 'common/rate';
$route['subscribe'] = 'common/subscribe';

$route['notifications/(:num)'] = 'notifications/index/$1';
$route['notifications/(:num)/(:any)'] = 'notifications/index/$1/$2';
$route['open-notifications'] = 'notifications/mark_seen_noti';
$route['scan-notification'] = 'notifications/scan_notification';


$route['note'] = 'common/save_note';
$route['update-note'] = 'common/update_note';
$route['delete-note/(:any)'] = 'common/delete_note/$1';
$route['approve-note/(:any)'] = 'common/approve_note/$1';
$route['reject-note/(:any)'] = 'common/reject_note/$1';


$route['comment'] = 'common/comment';
$route['save-comment'] = 'common/comment_update';
$route['remove-comment'] = 'common/comment_delete';
$route['report-comment'] = 'common/comment_report';

$route['save-change-dp'] = 'ajax/save_change_dp';
$route['remove-image'] = 'ajax/remove_image';
$route['creators'] = 'index/creators';

//$route['profile/(:any)/(:any)'] = 'index/profile/$1/$2';
$route['tutor/(:any)'] = 'index/profile/$1';
$route['get-reviews'] = 'index/getReviews';
$route['pay-for-check'] = 'index/pay_for_check';
$route['check-status'] = 'index/check_status';
$route['check_pay'] = 'index/check_pay';
$route['profile'] = 'account/profile';