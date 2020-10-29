<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories_model extends CI_Model {

	public function get_num_rows() {
		$query = $this->db->get('categories');
		return $query->num_rows(); 
	}

	public function get_categories(){
		$this->db->order_by('id');
		$query = $this->db->get('categories');
		return $query->result();
	}

	public function get_category($category_id){
		$query = $this->db->get_where('categories', array('id' => $category_id));
		if ($query->num_rows() > 0) {
			return $query->row();
		}
	}

	public function create_category() {
		$data = [
			'name' => $this->input->post('category_name'),
			'author_id' => $this->session->userdata('user_id'),
			'created_at' => date('Y-m-d H:i:s')
		];
		return $this->db->insert('categories', $data);
	}


	public function update_category($category_id) {
		$data = [
			'name' => $this->input->post('category_name'),
		];

		$this->db->where('id', $category_id);
		return $this->db->update('categories', $data);
	}

	public function delete_category($category_id) {
		$this->db->where('id', $category_id);
		$this->db->delete('categories');
		return true;
	}


}