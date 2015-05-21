<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rank extends CI_Model
{
	public function find_ranks_by_weeknumber($weekNumber) 
	{
		$sql = "SELECT r.* FROM rank r JOIN week w ON r.week_id = w.id WHERE w.week_number = ?";
		$sql = $sql . " ORDER BY points DESC";
		$result = $this->db->query($sql, $weekNumber);
		return $result->result_array();
	}
}
