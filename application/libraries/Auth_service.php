<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class path {
	public $path;
	public $secure;
	public $allowed_method;

	public function __construct($path, $secure, $allowed_method)
	{
		$this->path = $path;
		$this->secure = $secure;
		$this->allowed_method = $allowed_method;
	}


}

class Auth_service {

	private $all_path = array();

	public function __construct()
	{
		$this->CI =& get_instance();
		$this->all_path[0] = new path("/^api\/ranks/i", false, array('GET'));
		$this->all_path[1] = new path("/^api\/ranks\/\d+/i", false, array('GET'));
	}

	public function authorization() 
	{
		$all_path = $this->all_path;

		$req_path = uri_string();
		$req_method = $_SERVER['REQUEST_METHOD'];

		$cureent_path = null;
		$tmp = null;
		for ($i = 0; $i < count($all_path); $i++) 
		{
			$tmp = $all_path[$i];
			// Find curent path
			if (preg_match($tmp->path, $req_path)) 
			{
				$tmp_finded = false;
				// Find allowed method
				for($j = 0; $j < count($tmp->allowed_method); $j++) 
				{
					if ($req_method === $tmp->allowed_method[$j]) 
					{
						$cureent_path = $tmp;
						break;
					}
				}
				if ($tmp_finded) break;
			}
		}
		// Return false when did not found any path
		if ($cureent_path === null) 
		{
			show_error("error message ", 404, "error header");
		}
	}
}