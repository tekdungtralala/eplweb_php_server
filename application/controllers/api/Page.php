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
		foreach ($weeks as &$w) 
		{
			$w = change_key($w, get_week_keys());
			unset($w["season_id"]);

			$w['startDay'] = $w['startDay'] * 1000;
		}

		$week_number = $this->phase_model->get_current_match();

		$result = [];
		$result['matchdayModelView'] = $this->matchday_service->get_modelview_by_weeknumber($week_number);
		$result['weeks'] = $weeks;
		echo json_encode($result, get_json_encode_opt());
	}
}
