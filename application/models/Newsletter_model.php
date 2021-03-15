<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletter_model extends CI_Model {

	public function subscriber_exists() {	
		$query = $this->db->get_where('newsletter', ['email' => $this->input->post('email')]);
		return $query->num_rows() > 0;
	}

	public function add_subscriber() {
		$data = [
			'email' => $this->input->post('email'),
			'subscription_date' => date('Y-m-d H:i:s')
		];
		return $this->db->insert('newsletter', $data);
	}
}