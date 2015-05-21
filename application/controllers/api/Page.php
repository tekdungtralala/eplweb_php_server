<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

	public function matchday()
	{
		$this->auth_service->authorization();

		$this->load->model('phase_model');
		$this->load->model('week_model');
		$this->load->helper('model_helper');
		$this->load->library('matchday_service');

		$weeks = $this->week_model->get_all_week();

		// Weeks
		$this->change_weeks_key($weeks);

		$week_number = $this->phase_model->get_current_match();

		$result = [];
		$result['matchdayModelView'] = $this->matchday_service->get_modelview_by_weeknumber($week_number);
		$result['weeks'] = $weeks;
		echo json_encode($result, get_json_encode_opt());
	}

	public function rank() {
		$this->load->model('team_model'); 
		$this->load->model('rank_model');
		$this->load->model('phase_model');
		$this->load->model('week_model');
		$this->load->helper('model_helper');

		$teams = $this->team_model->get_all_team();;
		$weeknumber = $this->phase_model->get_current_match();
		$ranks = $this->rank_model->find_ranks_by_weeknumber($weeknumber);
		foreach ($ranks as &$r)
		{
			$r = change_key($r, get_rank_keys());
			$r['team'] = find_team_byteamid($teams, $r['team_id']); 
		}


		$weeks = $this->week_model->get_all_week();
		// Weeks
		$this->change_weeks_key($weeks);

		$result = [];
		$result['weeks'] = $weeks;
		$result['ranks'] = $ranks;
		echo json_encode($result, get_json_encode_opt());
	}

	private function change_weeks_key($weeks) 
	{
		foreach ($weeks as &$w) 
		{
			$w = change_key($w, get_week_keys());
			unset($w["season_id"]);

			$w['startDay'] = $w['startDay'] * 1000;
		}
	}
}
