<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Install extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index(){
		// Create all the database tables if there are none
		// by redirecting to the Migrations controller
		$tables = $this->db->list_tables();
		redirect(count($tables) == 0 ? 'migrate' : '/');
	}
}