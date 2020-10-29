<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages_model extends CI_Model {

	public function count_pages() {
		$query = $this->db->get('pages');
		return $query->num_rows(); 
	}

	public function get_pages(){
		$this->db->order_by('id');
		$query = $this->db->get('pages');
		return $query->result();
	}

	public function get_page($page_id){
		$query = $this->db->get_where('pages', array('id' => $page_id));
		if ($query->num_rows() > 0) {
			return $query->row();
		}
	}

	public function create_page() {
		$data = [
			'title' => $this->input->post('title'),
			'content' => $this->input->post('content'),
			'author_id' => $this->session->userdata('user_id'),
			'created_at' => date('Y-m-d H:i:s')
		];
		return $this->db->insert('pages', $data);
	}

	public function update_page($page_id) {
		$data = [
			'title' => $this->input->post('title'),
			'content' => $this->input->post('content'),
			'updated_at' => date('Y-m-d H:i:s')
		];

		$this->db->where('id', $page_id);
		return $this->db->update('pages', $data);
	}

	public function delete_page($page_id) {
		$this->db->where('id', $page_id);
		$this->db->delete('pages');
		return true;
	}

}