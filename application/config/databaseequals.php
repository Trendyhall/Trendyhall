<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// номре столбца в его имя
$config['numb_to_name'] = array(
	0  => 'id',
	1  => 'articule',
	2  => 'modelcode',
	3  => 'colour',
	4  => 'size',
	5  => 'firstsize',
	6  => 'gender',
	7  => 'brand',
	8  => 'itemgroup',
	9  => 'name',
	10 => 'consist',
	11 => 'provider',
	12 => 'manufacturer',
	13 => 'country',
	14 => 'imagecount',
	15 => 'price',
	16 => 'sale',
	17 => 'count',
	18 => 'season',
	19 => 'description'
);

$config['name_to_numb'] = array(
	'id'           => 0,
	'articule'     => 1,
	'modelcode'    => 2,
	'colour'       => 3,
	'size'         => 4,
	'firstsize'    => 5,
	'gender'       => 6,
	'brand'        => 7,
	'itemgroup'    => 8,
	'name'         => 9,
	'consist'      => 10,
	'provider'     => 11,
	'manufacturer' => 12,
	'country'      => 13,
	'imagecount'   => 14,
	'price'        => 15,
	'sale'         => 16,
	'count'        => 17,
	'season'       => 18,
	'description'  => 19
);


$config['foreign_column_numb_to_table_name'] = array(
	3  => 'colours',
	4  => 'sizes',
	7  => 'brands',
	8  => 'groups',
	11 => 'providers',
	12 => 'manufactures',
	13 => 'countries',
	18 => 'seasons',
	19 => 'descriptions'
);

$config['foreign_column_name_to_table_name'] = array(
	'colour'       => 'colours',
	'size'         => 'sizes',
	'brand'        => 'brands',
	'itemgroup'    => 'groups',
	'provider'     => 'providers',
	'manufacturer' => 'manufactures',
	'country'      => 'countries',
	'season'       => 'seasons',
	'description'  => 'descriptions'
);
