<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

	public function matchday()
	{
		$this->auth_service->authorization();

		$this->load->model('phase');
		$this->load->model('week');
		$this->load->model('matchday');
		$this->load->model('team');
		$this->load->helper('model_helper');
		$this->load->library('week_service');

		$weeks = $this->week->get_all_week();
		$teams = $this->team->get_all_team();

		// Weeks
		foreach ($weeks as &$w) 
		{
			$w = change_key($w, get_week_keys());
			unset($w["season_id"]);

			$w['startDay'] = $w['startDay'] * 1000;
		}

		// Model week
		$current_match = $this->phase->get_current_match();
		$current_week = $this->week_service->find_by_weeknumber($current_match);

		// Model model
		$matchdays = $this->matchday->find_by_weekid($current_week['id']);
		$sameDate = '';
		$model = [];
		foreach ($matchdays as &$m) 
		{
			$date = new DateTime($m['date']);
			$match_date = $date->format('D M m, Y');
			if ($sameDate !== $match_date) 
			{
				$sameDate = $match_date;
				$model[$sameDate] = [];			
			}

			$newM = change_key($m, get_matchday_keys());
			$newM['date'] = strtotime($newM['date']);

			$awayTeam = find_team_byteamid($teams, $newM['away_team_id']); 
			$awayTeam = change_key($awayTeam, get_team_keys());
			$newM['awayTeam'] = $awayTeam;

			$homeTeam = find_team_byteamid($teams, $newM['home_team_id']); 
			$homeTeam = change_key($homeTeam, get_team_keys());
			$newM['homeTeam'] = $homeTeam;

			$newM['week'] = change_key($current_week, get_week_keys());
			$newM['week']['startDay'] = $newM['week']['startDay'] * 1000;

			$newM['date'] = $newM['date'] * 1000;
			unset($newM["total_rating"]);
			unset($newM["home_team_id"]);
			unset($newM["away_team_id"]);
			unset($newM["week_id"]);

			array_push($model[$sameDate], $newM);
		}

		
		$result = [];
		$result['matchdayModelView'] = [];		
		$result['matchdayModelView']['model'] = $model;
		$result['matchdayModelView']['week'] = change_key($current_week, get_week_keys());
		$result['matchdayModelView']['voting'] = [];
		$result['weeks'] = $weeks;
		echo json_encode($result, get_json_encode_opt());
	}
}
