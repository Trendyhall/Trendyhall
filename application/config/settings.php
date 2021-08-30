<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//=========== UNCANGEBLE ===============
$config['actual_season'] = 1;
$config['cards_of_good_on_page'] = 48;

$config['api_key'] = 'a8b8aaea07e2489b8449f35408a1e3f58ff5a92be667c2d1';
$config['admin_uuid'] = 'b8038c7c-4fc1-4ad7-b64d-406449663c4c';

$config['order_statuses'] = array(
	0 => 'Не просмотренно', 
	1 => 'Просмотренно', 
	2 => 'Просрочено', 
	3 => 'Отменено', 
	4 => 'Выполнено', 
);

$config['order_statuses_classes'] = array(
	0 => 'text-danger', 
	2 => 'text-warning', 
	3 => 'text-secondary', 
	4 => 'text-success', 
);
//============ CANGEBLE ===============

$config['order_statuses_visability'] = array(
	0 => TRUE, 
	1 => TRUE, 
	2 => TRUE, 
	3 => FALSE, 
	4 => FALSE, 
);