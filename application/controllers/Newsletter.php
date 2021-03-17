<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Newsletter extends CI_Controller {
  
  public function __construct() {
		parent::__construct();
	}

  public function subscribe(){
    $data['is_new_subscriber'] = true;
    if (!$this->Newsletter_model->subscriber_exists()) {
      $this->Newsletter_model->addSubscriber();
    } else {
      $data['is_new_subscriber'] = false;
    }
    echo json_encode($data);
  }
}