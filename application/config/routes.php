<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'posts';
$route['install'] = 'install';
$route['migrate'] = 'migrate';
$route['register'] = 'register';
$route['login'] = 'login';
$route['dashboard'] = 'dashboard';
$route['dashboard/create-post'] = 'dashboard/posts/create';
$route['dashboard/create-page'] = 'dashboard/pages/create';
$route['dashboard/create-category'] = 'dashboard/categories/create';
$route['dashboard/manage-authors'] = 'dashboard/users';
$route['404_override'] = '';
$route['categories/posts/(:any)'] = 'categories/posts/$1';
$route['(:any)'] = 'posts/post/$1';
$route['translate_uri_dashes'] = FALSE;
