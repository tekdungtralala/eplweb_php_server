<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Phase extends CI_Model
{
	const CURRENT_MATCHDAY = "CURRENT_MATCHDAY";

	public function get_phase() 
	{
		$sql = "SELECT * FROM phase";
		$result =  $this->db->query($sql);
		return $result->result_array();
	}

	public function get_current_match() {
		$array = $this->get_phase();
		foreach ($array as $row) 
		{
			if ($row['key'] === self::CURRENT_MATCHDAY)
			{
				return $row['value'] - 1;
			}
		}
		return null;
	}
}
