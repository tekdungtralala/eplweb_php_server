<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Person extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

	public function showperson()
	{
		$query= $this->db->get('Person');
		return $query->result();
	}
}
