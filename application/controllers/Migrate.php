<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $this->load->library('migration');

    if($this->migration->current() === FALSE) {
      show_error($this->migration->error_string());
    }
    else {
      $this->session->set_flashdata('tables_created', "All the required database tables have been created. You can now register.");
        redirect('register');
    }
  }
}
