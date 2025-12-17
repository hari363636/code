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
$route['payment-return'] 									= 'client/payment_return';
$route['payment-cancel'] 									= 'client/payment_cancel';
$route['payment-notify'] 									= 'home/payment_notify';
$route['payment'] 											= 'client/payment';
$route['notify'] 											= 'notification/notify';

$route['suspend-agent-notification/(:num)'] 	= 'notification/suspend_agent_notification/$1';
$route['suspend-customer-notification/(:num)'] 	= 'notification/suspend_customer_notification/$1';
$route['suspend-admin-notification/(:num)'] 	= 'notification/suspend_admin_notification/$1';
$route['convert/(:num)'] 					= 'admin/convert/$1';
$route['location'] 							= 'agent/location';
$route['ticket-response/(:num)'] 			= 'admin/ticket_response/$1';
$route['manage-feedback'] 					= 'admin/manage_feedback';
$route['apending-order'] 					= 'admin/apending_order';
$route['acompleted-order'] 					= 'admin/acompleted_order';
$route['verified-seller'] 					= 'admin/seller';
$route['blacklist'] 					    = 'admin/blacklist';
$route['view-ticket'] 						= 'admin/view_ticket';
$route['know-agent'] 						= 'admin/know_agent';
$route['registered-vo'] 					= 'admin/registered_vo';
$route['applied-vo'] 						= 'admin/applied_vo';
$route['reg-buyers'] 						= 'admin/regbuyers';
$route['not-interest'] 						= 'admin/notinterest';
$route['phone-verify'] 						= 'admin/phone_verify';
$route['inperson-verify'] 					= 'admin/inperson_verify';
$route['collection-delivery'] 				= 'admin/collection_delivery';
$route['order-in-que'] 						= 'agent/in_que';
$route['order-in-completed'] 				= 'agent/order_in_completed';
$route['in-person-verify']                  = 'agent/in_person_verify';
$route['verify-delivery']                  = 'agent/verify_delivery';
$route['phone-report-generate/(:num)'] 		= 'admin/phone_report_generate/$1';
$route['order-in-process'] 					= 'agent/order_in_process';
$route['generate-report/(:num)'] 			= 'agent/generate_report/$1';
$route['applied-vo-edit/(:num)'] 			= 'admin/applied_vo_edit/$1';
$route['client-payments'] 					= 'client/payments';
$route['view-agentcuser-report/(:num)'] 	= 'agent/view_cuser_report/$1';
$route['client-payments-due'] 				= 'client/payments_due';

$route['view-receipt/(:num)'] 				= 'client/view_receipt/$1';
$route['receipts'] 						    = 'client/receipts';
$route['saved-cards'] 						 = 'client/saved_cards';
$route['my-orders'] 						= 'client/my_orders';
$route['pending-order'] 					= 'client/pending_order';
$route['completed-order'] 					= 'client/completed_order';
$route['view-report/(:num)'] 				= 'admin/view_report/$1';
$route['view-user-report/(:num)'] 			= 'admin/view_user_report/$1';
$route['view-cuser-report/(:num)'] 			= 'client/view_cuser_report/$1';
$route['membership'] 						= 'client/membership';
$route['membership-payment/(:num)'] 		= 'client/membership_payment/$1';
$route['membership-invoice/(:num)'] 		= 'client/membership_invoice/$1';

$route['email-phone-report/(:num)'] 	= 'admin/email_phone_report/$1';
$route['print-report/(:num)'] 	= 'admin/print_report/$1';
$route['ban-user/(:num)'] 		= 'admin/ban_user/$1';
$route['activate-user/(:num)'] 	= 'admin/activate_user/$1';
$route['update-agent/(:num)'] 	= 'admin/update_agent/$1';
$route['update-staff/(:num)'] 	= 'admin/update_staff/$1';
$route['update-client/(:num)'] 	= 'admin/update_client/$1';
$route['send-invoice/(:num)'] 	= 'admin/send_invoice/$1';
$route['payments'] 				= 'admin/payments';
$route['payments-due'] 			= 'admin/payments_due';
$route['payments-completed'] 	= 'admin/payments_completed';
$route['inv/(:num)'] 			= 'client/invoice/$1';
$route['invoice/(:num)'] 		= 'admin/invoice/$1';
$route['receipt/(:num)'] 		= 'admin/receipt/$1';
$route['manage-leads'] 			= 'admin/manage_leads';
$route['create-lead/(:num)'] 	= 'admin/create_lead/$1';
$route['manage-enquiry'] 		= 'admin/manage_enquiries';
$route['client'] 				= 'admin/client';
$route['show_joinus'] 			= 'admin/show_joinus';
$route['staff'] 				= 'admin/staff';
$route['agent'] 				= 'admin/agent';
$route['permission'] 			= 'admin/permission';
$route['profile'] 				= 'auth/profile';
$route['dashboard'] 			= 'auth/dashboard';
$route['logout'] 				= 'home/logout';
$route['login'] 				= 'home/login';
$route['signup'] 				= 'home/signup';
$route['forget-password'] 		= 'home/forget_password';
$route['reset-password'] 		= 'home/reset_password';
$route['guest-user'] 			= 'home/guest_user';
$route['cookie-policy'] 		= 'home/cookie_policy';
$route['terms-conditions'] 		= 'home/terms_conditions';
$route['privacy-policy'] 		= 'home/privacy_policy';
$route['customer-support'] 		= 'home/customer_support';
$route['join-us'] 				= 'home/join_us';
$route['know-your-agent'] 		= 'home/know_your_agent';
$route['what-we-do'] 			= 'home/what_we_do';
$route['about'] 				= 'home/about';
$route['enquiry']           	= 'client/enquiry';
$route['rate-us'] 				= 'client/rate_us';
$route['ticket'] 				= 'client/ticket';
$route['user-payment/(:num)'] 	= 'client/user_payment/$1';
$route['default_controller'] 	= 'home';
$route['404_override'] 			= '';
$route['translate_uri_dashes'] 	= FALSE;
