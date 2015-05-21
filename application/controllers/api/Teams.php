<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teams extends CI_Controller {

	public function index()
	{
		$this->auth_service->authorization();

		$this->load->model('team'); 
		$this->load->helper('model_helper');

		$teams = $this->team->get_all_team();;
		foreach ($teams as &$t)
		{
			$t = change_key($t, get_team_keys());
		}
		$result = [];
		$result['result'] = $teams;
		echo json_encode($result, get_json_encode_opt());
	}
}
