<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// ------------------------------------------------------------------------

if ( ! function_exists('get_price'))
{
	function get_price($price, $sale = 0){
        return number_format($price * (0.01 * (100 - $sale)), 0,"."," ");
    }
}

