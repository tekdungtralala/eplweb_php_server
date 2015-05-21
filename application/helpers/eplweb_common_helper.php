<?php defined('BASEPATH') OR exit('No direct script access allowed');

function get_json_encode_opt() 
{
	return JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK | JSON_UNESCAPED_SLASHES;
}