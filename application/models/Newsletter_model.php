<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletter_model extends CI_Model {

	public function subscriber_exists() {	
		$query = $this->db->get_where('newsletter', ['email' => $this->input->post('email')]);
		return $query->num_rows() > 0;
	}

	public function get_num_rows() {
		$query = $this->db->get('newsletter');
		return $query->num_rows(); 
	}

	public function addSubscriber() {
		$data = [
			'email' => $this->input->post('email'),
			'subscription_date' => date('Y-m-d H:i:s')
		];
		return $this->db->insert('newsletter', $data);
	}

	public function getSubscribers($limit, $offset){
		$this->db->select('newsletter.*');
		$this->db->order_by('newsletter.id', 'ASC');
	  $this->db->limit($limit, $offset);
		$query = $this->db->get('newsletter');
		return $query->result();
	}

	public function editSubscriber($id){
		$query = $this->db->get_where('newsletter', array('id' => $id));
		if ($query->num_rows() > 0) {
			return $query->row();
		}
	}

	public function updateSubscriber($id) {
		$data = [
			'email' => $this->input->post('email')
		];

		$this->db->where('id', $id);
		return $this->db->update('newsletter', $data);
	}

	public function deleteSubscriber($id) {
		return $this->db->delete('newsletter', array('id' => $id));
	}

	// Expot subscribers
	public function fetchSubscribers() {
		$this->db->select('email, subscription_date');
		$this->db->order_by('newsletter.id', 'DESC');
		$query = $this->db->get('newsletter');
		return $query->result();
 	}

}