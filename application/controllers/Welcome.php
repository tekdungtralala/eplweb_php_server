<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		if ($this->auth_service->is_can_access()) {
			$this->load->library('rank_service');

			$result = $this->rank_service->find_ranks_currentweek();
			echo json_encode($result, JSON_NUMERIC_CHECK);
		} else {
			show_error("error message ", 404, "error header");
		}
	}
}
