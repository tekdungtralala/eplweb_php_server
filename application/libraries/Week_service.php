<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Week_service {

	public function __construct()
	{
		$this->CI =& get_instance();
	}

	public function find_by_weeknumber($weeknumber) 
	{
		$this->CI->load->model('week_model');
		$weeks = $this->CI->week_model->get_all_week();

		for($i = 0; $i < count($weeks); $i++)
		{
			$w = $weeks[$i];
			if ($weeknumber == $w['week_number'])
			{
				return $w;
			}
		}

		return null;
	}
}