<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['cases/(:num)'] = "cases/content/$1";
$route['news/(:num)'] = "news/content/$1";
$route['aromas/(:num)'] = "aromas/content/$1";

$route['admin'] = "admin/main";
$route['admin/edit'] = "admin/main/edit";
$route['admin/login'] = "admin/main/login";
$route['admin/logout'] = "admin/main/logout";

$route['default_controller'] = "main";
$route['404_override'] = '';
