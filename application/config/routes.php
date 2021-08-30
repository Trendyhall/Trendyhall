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
$route['default_controller'] = 'main';
$route['404_override'] = 'main/error_404';
$route['translate_uri_dashes'] = FALSE;



//====== VIEW ==========

$route['view'] = 'view';
$route['view/(:num)'] = 'view/index/$1';

$route['boys'] = 'view/boys';
$route['boys/(:num)'] = 'view/boys/$1';
$route['girls'] = 'view/girls';
$route['girls/(:num)'] = 'view/girls/$1';
$route['new'] = 'view/new';
$route['new/(:num)'] = 'view/new/$1';
$route['sale'] = 'view/sale';
$route['sale/(:num)'] = 'view/sale/$1';

$route['goods/(:any)'] = 'view/item/$1';

$route['like-cards'] = 'view/like_cards';
$route['cart-cards'] = 'view/cart_cards';


$route['brands'] = 'view/brands';
$route['brands/(:any)'] = 'view/brand/$1';
$route['brands/(:any)/(:num)'] = 'view/brand/$1/$2';

//======= MAIN ==========
$route['news'] = 'main/news';
$route['news'] = 'main/news/$1';

$route['contact'] = 'main/contact';
$route['shops'] = 'main/shops';
$route['about-the-refund'] = 'main/about_the_refund';
$route['about-delivery'] = 'main/about_delivery';

$route['terms'] = 'main/terms';
$route['privacy-policy'] = 'main/privacypolicy';


$route['signup'] = 'main/signup';
$route['reset-password'] = 'main/reset_password';
$route['profile'] = 'main/profile';

$route['cart'] = 'main/cart';
$route['buy']= 'main/buy';

$route['like'] = 'main/like';

//====== ADDITION ==========
$route['junior-republic-event'] = 'addition/junior_republic_event';


//===== ADMIN =====

$route['admin'] = 'admin';
$route['admin/tests'] = 'admin/tests';
$route['admin/settings'] = 'admin/settings';
$route['admin/set-setting/(:any)']['post'] = 'admin/set_setting/$1';
$route['admin/orders'] = 'admin/orders';
$route['admin/orders/(:num)'] = 'admin/orders/$1';
$route['admin/order/(:num)/delete'] = 'admin/order_delete/$1';
$route['admin/order/(:num)/cancel'] = 'admin/order_cancel/$1';



$route['admin/database-upload'] = 'admin/database_upload';
$route['admin/database-upload1'] = 'admin/database_upload1';
$route['admin/headers'] = 'admin/headers1';
$route['admin/databasedebug'] = 'admin/databasedebug';
//$route['admin/'] = 'admin/';

//========= BACKGROUND =============

$route['user/login']['post'] = 'background/user_login';
$route['user/exsist']['post'] = 'background/user_exsist';
$route['user/signup']['post'] = 'background/user_signup';
$route['user/get-user-name']['post'] = 'background/get_user_name';
$route['user/get-user-data']['post'] = 'background/get_user_data';
$route['user/set-user-like']['post'] = 'background/set_user_like';
$route['user/set-user-cart']['post'] = 'background/set_user_cart';

$route['orders/new-order']['post'] = 'background/new_order';



//========= API =============
$route['api']['post'] = 'api';
