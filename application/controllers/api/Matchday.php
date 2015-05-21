<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matchday extends CI_Controller {

	public function weeknumber($week_number)
	{
		$this->auth_service->authorization();

		$this->load->library('matchday_service');

		$result = $this->matchday_service->get_modelview_by_weeknumber($week_number);
		echo json_encode($result, get_json_encode_opt());
	}
}
