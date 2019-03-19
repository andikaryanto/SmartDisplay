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
$route['default_controller'] = 'login';
$route['404_override'] = 'Error404';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'login/login';
$route['login'] = 'login/index';
$route['login/dologin'] = 'login/dologin';
$route['register'] = 'register/index';

$route['home'] = 'home/index';

$route['mgroupuser'] = 'm_groupuser';
$route['mgroupuser/add'] = 'm_groupuser/add';
$route['mgroupuser/addsave'] = 'm_groupuser/addsave';
$route['mgroupuser/edit/(:num)'] = 'm_groupuser/edit/$1';
$route['mgroupuser/editsave'] = 'm_groupuser/editsave';
$route['mgroupuser/delete'] = 'm_groupuser/delete';
$route['mgroupuser/editrole/(:num)'] = 'm_groupuser/editrole/$1';
$route['mgroupuser/editreportrole/(:num)'] = 'm_groupuser/editreportrole/$1';

$route['muser'] = 'm_user';
$route['muser/add'] = 'm_user/add';
$route['muser/addsave'] = 'm_user/addsave';
$route['muser/edit/(:num)'] = 'm_user/edit/$1';
$route['muser/editsave'] = 'm_user/editsave';
$route['muser/delete/(:num)'] = 'm_user/delete/$1';
$route['muser/activate/(:num)'] = 'm_user/activate/$1';
$route['changePassword'] = 'm_user/changePassword';
$route['saveChangePassword'] = 'm_user/saveNewPassword';
$route['settings'] = 'm_user/setting';
$route['savesettings'] = 'm_user/savesetting';
$route['saveprofile'] = 'm_user/saveprofile';   
$route['profile'] = 'm_user/profile';

$route['mgroupplayer'] = 'm_groupplayer';
$route['mgroupplayer/add'] = 'm_groupplayer/add';
$route['mgroupplayer/addsave'] = 'm_groupplayer/addsave';
$route['mgroupplayer/edit/(:num)'] = 'm_groupplayer/edit/$1';
$route['mgroupplayer/editsave'] = 'm_groupplayer/editsave';
$route['mgroupplayer/delete'] = 'm_groupplayer/delete';

$route['mplayer'] = 'm_player';
$route['mplayer/add'] = 'm_player/add';
$route['mplayer/addsave'] = 'm_player/addsave';
$route['mplayer/edit/(:num)'] = 'm_player/edit/$1';
$route['mplayer/editsave'] = 'm_player/editsave';
$route['mplayer/delete'] = 'm_player/delete';

$route['mcompany'] = 'm_company';
$route['mcompany/add'] = 'm_company/add';
$route['mcompany/addsave'] = 'm_company/addsave';
$route['mcompany/edit/(:num)'] = 'm_company/edit/$1';
$route['mcompany/editsave'] = 'm_company/editsave';
$route['mcompany/delete'] = 'm_company/delete';

$route['mevent'] = 'm_event';
$route['mevent/add'] = 'm_event/add';
$route['mevent/addsave'] = 'm_event/addsave';
$route['mevent/edit/(:num)'] = 'm_event/edit/$1';
$route['mevent/editsave'] = 'm_event/editsave';
$route['mevent/delete'] = 'm_event/delete';

$route['report'] = 'reports';
$route['report/submission_payment_receipt_pdf/(:num)'] = 'reports/submission_payment_receipt_pdf/$1';
$route['report/submission_payment_detail_pdf'] = 'reports/submission_payment_detail_pdf';


$route['mainsetup'] = 'm_form';

//API
$route['api/mdisaster']['GET'] = 'api_mdisaster/get_disaster';
$route['api/mdisaster/(:any)/(:any)'] = 'api_mdisaster/get_disaster/$1/$2';
$route['api/mdisaster/save']['POST'] = 'api_mdisaster/save_disaster';
