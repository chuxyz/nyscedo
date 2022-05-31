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
$route['home'] = 'pages/home';
///$route['home/:num'] = 'pages/home/$1';
$route['double'] = 'pages/double';
$route['addnew'] = 'pages/addnew';
$route['edit'] = 'pages/edit';
$route['edit/(:any)'] = 'pages/edit/$1';
$route['ajaxResponse/(:any)'] = 'pages/ajaxResponse/$1';
$route['payment'] = 'pages/payment';
$route['printpages/(:any)'] = 'pages/printpages/$1';
$route['undopayment'] = 'pages/undopayment';
$route['excel'] = 'pages/excel';
$route['excel/(:any)'] = 'pages/excel/$1';
$route['clearance'] = 'pages/clearance';
$route['upload'] = 'pages/upload';
$route['clear'] = 'pages/clear';
$route['logout'] = 'pages/logout';
$route['default_controller'] = "pages/index";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */