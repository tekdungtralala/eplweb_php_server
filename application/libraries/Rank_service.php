<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Rank_service {

	public function __construct()
	{
		$this->CI =& get_instance();
	}

	public function find_ranks_currentweek() {
		$this->CI->load->model('phase_model'); 
		$currentWeek = $this->CI->phase_model->get_current_match();

		return $this->find_ranks_by_week($currentWeek);
	}

	public function find_ranks_by_week($weeknumber) {
		$this->CI->load->model('rank_model');
		$this->CI->load->model('team_model');
		$this->CI->load->helper('model_helper');

		$ranks = $this->CI->rank_model->find_ranks_by_weeknumber($weeknumber);
		$teams = $this->CI->team_model->get_all_team();

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