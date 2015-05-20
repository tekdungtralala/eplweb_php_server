<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rank extends CI_Model
{
	public function find_ranks_by_weeknumber($weekNumber) 
	{
		// $output = "r.games_drawn as gamesDrawn, ";
		// $output = $output . "r.games_lost as gamesLost, ";
		// $output = $output . "r.games_won as gamesWon, ";
		// $output = $output . "r.goals_against as goalsAgainst, ";
		// $output = $output . "r.goals_scored as goalsScored, ";
		// $output = $output . "r.team_id ";

		$sql = "SELECT r.* FROM rank r JOIN week w ON r.week_id = w.id WHERE w.week_number = ?";
		$sql = $sql . " ORDER BY points DESC";
		$result = $this->db->query($sql, $weekNumber);
		return $result->result_array();
	}
}
