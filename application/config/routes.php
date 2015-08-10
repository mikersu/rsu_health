<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "index";
$route['404_override'] = 'auto_controller/index';

$route['(\w{2}\/|w{0})account/confirm-register(.*)'] = 'account/confirm_register$2';
$route['(\w{2}\/|w{0})account/edit-profile(.*)'] = 'account/edit_profile$2';
$route['(\w{2}\/|w{0})account/resend-activate'] = 'account/resend_activate';
$route['(\w{2}\/|w{0})account/view-logins'] = 'account/view_logins';


$route['(\w{2}\/|w{0})site-admin/account-level(.*)'] = 'site-admin/account_level$2';
$route['(\w{2}\/|w{0})site-admin/account-permission(.*)'] = 'site-admin/account_permission$2';

// set new route admin
$route['site-admin/login(.*)'] = 'site-admin/login$1';
$route['site-admin/account(.*)'] = 'site-admin/account$1';
$route['site-admin/account_permission(.*)'] = 'site-admin/account_permission$1';
$route['site-admin/article(.*)'] = 'site-admin/article$1';
$route['site-admin/config(.*)'] = 'site-admin/config$1';
$route['site-admin/cacheman(.*)'] = 'site-admin/cacheman$1';
$route['site-admin/logout(.*)'] = 'site-admin/logout$1';
$route['site-admin/menu(.*)'] = 'site-admin/menu$1';
$route['site-admin/page(.*)'] = 'site-admin/page$1';
$route['site-admin/urls(.*)'] = 'site-admin/urls$1';
$route['site-admin/themes(.*)'] = 'site-admin/themes$1';
$route['site-admin/module(.*)'] = 'site-admin/module$1';
$route['site-admin/lang(.*)'] = 'site-admin/lang$1';

$route['aboutus(.*)'] = 'about$1';
$route['news-event(.*)'] = 'news$1';
$route['engineering-service(.*)'] = 'service$1';
$route['index.html(.*)'] = 'home$1';

$route['news-event(.*)'] = 'news$1';

$route['site-admin/(\w+)'] = '$1/site-admin/$1';
$route['site-admin/(\w+)/(.+)'] = '$1/site-admin/$1/$2';



// $route['site-admin/filemanager/image'] = 'filemanager/image';
// $route['site-admin/filemanager/connector'] = 'filemanager/connector';

//route example: http://domain.tld/en/controller => http://domain.tld/controller
$route['(\w{2})/(.*)'] = '$2';
$route['(\w{2})'] = $route['default_controller'];


/* End of file routes.php */
/* Location: ./application/config/routes.php */




