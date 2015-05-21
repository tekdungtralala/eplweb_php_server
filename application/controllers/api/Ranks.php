<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ranks extends CI_Controller {

	public function index()
	{
		$this->auth_service->authorization();

		$this->load->library('rank_service');
		
		$result = $this->rank_service->find_ranks_currentweek();
		echo json_encode($result, get_json_encode_opt());
	}

	public function weeknumber($weeknumber) 
	{
		$this->auth_service->authorization();
		
		$this->load->library('rank_service');
		
		$result = $this->rank_service->find_ranks_by_weeknumber($weeknumber);
		echo json_encode($result, get_json_encode_opt());
	}
}
