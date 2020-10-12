<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

defined('UPLOAD_PATH') OR define('UPLOAD_PATH','./uploads/');
defined('UPLOAD_VPATH') OR define('UPLOAD_VPATH','./v/');

// defined('UPLOAD_IMAGES')      OR define('UPLOAD_IMAGES','assets/site-content/');
define('ADMIN', 'admin');

// Stripe keys
/*
if ($_SERVER['HTTP_HOST'] != 'localhost') {
	define('API_PUBLIC_KEY', 'pk_live_uxnMlyqResd0xtjeB9jmbRkP002j6kUBA2');
	define('API_SECRET_KEY', 'sk_live_rTVRdilRTzJsaMyBiaHbOkJq00w5ADsUyP');
} else {
	define('API_PUBLIC_KEY', 'pk_live_uxnMlyqResd0xtjeB9jmbRkP002j6kUBA2');
	define('API_SECRET_KEY', 'sk_live_rTVRdilRTzJsaMyBiaHbOkJq00w5ADsUyP');
}
*/

/* */
if ($_SERVER['HTTP_HOST'] != 'localhost') {
//	start key before 01_07_2020
//	define('API_PUBLIC_KEY', 'pk_test_wojmZS7DxzFZFoOm66pNfkWc00433VqO3P');
//	define('API_SECRET_KEY', 'sk_test_3wxBwdD1U5E9BwqIw0myKueq00PK5vSoXt');
//	define('STRIPE_API_CLIENT_ID', 'ca_ExkShtieuagE8i9vmtEpRpc0SwvBljXt');// NOTE Used for tutor stripe registration
//	define('GOOGLE_MAP_API_KEY','AIzaSyCSCYUhPdncSUnXlUHSMePigWasY9jChpU');
//	end key before 01_07_2020

//	start key after 01_07_2020 (test key used)
	define('API_PUBLIC_KEY', 'pk_test_wojmZS7DxzFZFoOm66pNfkWc00433VqO3P');
	define('API_SECRET_KEY', 'sk_test_51ETowYKhbNNgyXc3RHwfdAiueHvreSftDy2f7MWQBY3Sjj7p0M95pwoNHMcv209eXcBs6nhESX3OSAowD0IoTOJD00JKkBdcic');
	define('STRIPE_API_CLIENT_ID', 'ca_ExkSUEG7kTYC539ZGIryXP9LgcXwNeGv');// NOTE Used for tutor stripe registration
	define('GOOGLE_MAP_API_KEY','AIzaSyAmqmsf3pVEVUoGAmwerePWzjUClvYUtwM');
	define('CHECKR_API_KEY','6a82d58114f5b57e468f3e6485c4648cfffcd2e2');// NOTE used test key
//	end key after 01_07_2020


// 	define('API_PUBLIC_KEY', 'pk_test_P6UPuc7zk3yWS5FFf0PhtLbw00MVVNx0kT');
// 	define('API_SECRET_KEY', 'sk_test_uHwjt5FrGHHIMYNvL6Uxhla300aok5gznX');
} else {
	define('API_PUBLIC_KEY', 'pk_test_wojmZS7DxzFZFoOm66pNfkWc00433VqO3P');
	define('API_SECRET_KEY', 'sk_test_51ETowYKhbNNgyXc3RHwfdAiueHvreSftDy2f7MWQBY3Sjj7p0M95pwoNHMcv209eXcBs6nhESX3OSAowD0IoTOJD00JKkBdcic');
	// NOTE Used for tutor stripe registration
	define('GOOGLE_MAP_API_KEY','AIzaSyAmqmsf3pVEVUoGAmwerePWzjUClvYUtwM');
	define('STRIPE_API_CLIENT_ID', 'ca_ExkSUEG7kTYC539ZGIryXP9LgcXwNeGv');
	define('CHECKR_API_KEY','6a82d58114f5b57e468f3e6485c4648cfffcd2e2');
//	define('API_PUBLIC_KEY', 'pk_test_51GvKHIIRf1BUxLDILH3vaTnRSVxKdEJcTqR3psT9Q2rbSx05JmwbcCPfu503lEeiKQUw5cweEKjK1A51Cq5IiMma003BPXRQ7b');
//	define('API_SECRET_KEY', 'sk_test_51GvKHIIRf1BUxLDIE4akxtgP3j1qmYkJ9xbbOOqAVc0QOEhMrqHg8yFZWbuqLrhkVIG67Dle9zJBjLoL3z3URxEh00GBa7PTsB');
// 	define('API_PUBLIC_KEY', 'pk_test_P6UPuc7zk3yWS5FFf0PhtLbw00MVVNx0kT');
// 	define('API_SECRET_KEY', 'sk_test_uHwjt5FrGHHIMYNvL6Uxhla300aok5gznX');
}
/**/

// Your Account Sid and Auth Token from twilio.com/user/account
define('TWILIO_SID', 'AC668b0ab77da8ebbb1730e5090a65dde8');
define('TWILIO_TOEKN', 'b601c6857308a5031495f9a62992642f');
define('TWILIO_NUMBER', '+12528886772');


// google Recaptcha
define('RECAPTCHA_SECRET_KEY','6Lcu36gUAAAAAKeVJyeaBxOqt43KxZpJ9oRqUGHp');
define('RECAPTCHA_SITE_KEY','6Lcu36gUAAAAACL_if-5Ywu-03K2M16acq8-JDth') ;

// opentok
// define('OpenTok_API_KEY', '46396492');   // Office 
// define('OpenTok_SECRET_KEY', 'd7501352b93c2196666d64b1d5394b552ccd4f99');

define('OpenTok_API_KEY', '46284772');   // Office 
define('OpenTok_SECRET_KEY', '1f8b4d29577b282a4cebd6be6ff52a671403c37f');


// define('Sendgrid_API_KEY', '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');
define('Sendgrid_API_KEY', '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');
define('Password_rest_template', 'd-570c82b4b9ab49eabb546c0f3cc0ef0c');
define('Signup_template_id', 'd-fa34b5edfc964f779a13bea679f04f28');
define('Lesson_booked_template_id', 'd-b5ad9e7d2c9b4dad9f3eea9c4f7c3669');
define('Account_suspended_template_id', 'd-e15eac90666747e6a8164c160c33b338');
define('Account_decline_template_id', 'd-a58ea0d976eb4fd0a5b14e1450855814');
define('Lesson_cancel_template_id', 'd-7f9bd84445f9496185b64e8feacbc455');
define('Lesson_request_template_id', 'd-b8df1a85984a47cdb75caca99b92f383');
//define('Sendgrid_API_KEY', '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');

