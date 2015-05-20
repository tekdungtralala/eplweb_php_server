<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ranks extends CI_Controller {

	public function index()
	{
		$this->auth_service->authorization();

		$this->load->library('rank_service');
		
		$result = $this->rank_service->find_ranks_currentweek();
		echo json_encode($result, JSON_NUMERIC_CHECK);
	}
}
