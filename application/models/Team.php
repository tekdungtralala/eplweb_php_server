<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team extends CI_Model
{
	public function get_all_team() 
	{
		$sql = "SELECT * FROM team";
		$result = $this->db->query($sql);
		return $result->result_array();
	}
}
