<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// ------------------------------------------------------------------------

if ( ! function_exists('get_cart_after_stock'))
{
	function get_cart_after_stock($cart, $cart_count){
		$cart_sale = 0;
		foreach ($cart_count as $key => $value) $cart_sale += $value;

		if ($cart_sale > 3) $cart_sale = 3;
		$cart_sale *= 10;

		$exclusive_itemgroup_sale = array(1, 6, 7, 10, 11, 14, 16);

		foreach ($cart as $key => $value) {
			if (!in_array($value['itemgroup'], $exclusive_itemgroup_sale)){
				if ($value['sale'] == 0) $cart[$key]['sale'] = $cart_sale;
			}
		}

        return $cart;
    }
}
