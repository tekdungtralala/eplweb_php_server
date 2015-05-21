<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Rank_service {

	public function __construct()
	{
		$this->CI =& get_instance();
	}

	public function find_ranks_currentweek() {
		$this->CI->load->model('phase'); 
		$currentWeek = $this->CI->phase->get_current_match();

		return $this->find_ranks_by_weeknumber($currentWeek);
	}

	public function find_ranks_by_weeknumber($weeknumber) {
		$this->CI->load->model('rank');
		$this->CI->load->model('team');
		$this->CI->load->helper('model_helper');

		$ranks = $this->CI->rank->find_ranks_by_weeknumber($weeknumber);
		$teams = $this->CI->team->get_all_team();

		foreach ($ranks as &$r)
		{
			foreach ($teams as $t) 
			{
				if ($t["id"] === $r["team_id"])
				{
					$r["team"] = change_key($t, get_team_keys());
				}
			}
			
			$r = change_key($r, get_rank_keys());
			unset($r["team_id"]);
			unset($r["week_id"]);
		}

		$finalResult = [];
		$finalResult["ranks"] = $ranks;

		return $finalResult;
	}
}