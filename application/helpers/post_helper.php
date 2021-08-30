<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// ------------------------------------------------------------------------

if ( ! function_exists('get_post_json'))
{
	function get_post_json(){
        return json_decode(file_get_contents('php://input'), true);
    }
}

if ( ! function_exists('get_post_json_and_test_keys'))
{
    function get_post_json_and_test_keys($keys){
        $post_json = json_decode(file_get_contents('php://input'), true);
        foreach ($keys as $key => $value) {
            if (!array_key_exists($value, $post_json)) return FALSE;
        }
        return $post_json;
    }
}
