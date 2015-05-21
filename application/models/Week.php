<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Week extends CI_Model
{
	public function get_all_week() 
	{
		$sql = "SELECT id, week_number, UNIX_TIMESTAMP(start_day) as start_day FROM week";
		$result =  $this->db->query($sql);
		return $result->result_array();
	}
}
