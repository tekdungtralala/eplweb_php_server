<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matchday extends CI_Model
{
	public function find_by_weekid($weeknumber)
	{
		$sql = "SELECT * FROM  matchday WHERE  week_id = $weeknumber ORDER BY DATE ASC , TIME ASC";
		$result =  $this->db->query($sql);
		return $result->result_array();
	}
}
