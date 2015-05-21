<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Matchday_service {

	public function __construct()
	{
		$this->CI =& get_instance();
	}

	public function get_modelview_by_weeknumber($weeknumber) 
	{
		$this->CI->load->model('matchday_model');
		$this->CI->load->model('team_model');
		$this->CI->load->helper('model_helper');
		$this->CI->load->library('week_service');

		$teams = $this->CI->team_model->get_all_team();

		// Model week
		$current_week = $this->CI->week_service->find_by_weeknumber($weeknumber);

		// Model model
		$matchdays = $this->CI->matchday_model->find_by_weekid($current_week['id']);
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
		$result = [];		
		$result['model'] = $model;
		$result['week'] = change_key($current_week, get_week_keys());
		$result['voting'] = [];

		return $result;
	}
}