<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usermodel extends CI_Model {

	public function email_exists() {	
		$query = $this->db->get_where('authors', ['email' => $this->input->post('email')]);
		return $query->num_rows() > 0;
	}

	public function get_num_rows() {
		$query = $this->db->get('authors');
		return $query->num_rows(); 
	}

	public function getAuthors(){
		$query = $this->db->get('authors');
		return $query->result();
	}

	public function editAuthor($id) {
		$query = $this->db
            ->select('id, first_name, last_name, email, bio, avatar')
            ->from('authors')
            ->where('id', $id)
            ->get();
            
		if ($query->num_rows() > 0) {
			$data = $query->row();
			return $data;
		}
	}

	public function deleteAuthor($id) {
		return $this->db->delete('authors', array('id' => $id));
	}

	public function deleteAvatar($id) {
		$this->db->update('authors', array('avatar'=>''), ['id'=>$id]);
	}


	public function activateAuthor($id) {
		$author = null;
		$updateQuery = $this->db->where(['id' => $id, 'is_admin' => 0])->update('authors', array('active' => 1));
		if ($updateQuery !== false) {
			$authorQuery = $this->db->get_where('authors', array('id' => $id));
			$author = $authorQuery->row();
		}
		return $author;
	}

	public function deactivateAuthor($id) {
		$author = null;
		$updateQuery = $this->db->where(['id' => $id, 'is_admin' => 0])->update('authors', array('active' => 0));
		if ($updateQuery !== false) {
			$authorQuery = $this->db->get_where('authors', array('id' => $id));
			$author = $authorQuery->row();
		}
		return $author;
	}

	public function register_user($enc_password, $active, $is_admin) {
		// User data
		$data = [
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'email' => $this->input->post('email'),
			'password' => $enc_password,
			'register_date' => date('Y-m-d H:i:s'),
			'active' => $active,
			'is_admin' => $is_admin
		];
		return $this->db->insert('authors', $data);
	}

	public function update_user($avatar, $id) {
		$data = [
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'email' => $this->input->post('email'),
			'bio' => $this->input->post('bio'),
			'avatar' => $avatar
		];

		$this->db->where('id', $id);
		return $this->db->update('authors', $data);
	}

	public function user_login($email, $password) {
		$pass_hash_query = $this->db
            ->select('password')
            ->get_where('authors', ['email' => $email]);

    $pass_hash = $pass_hash_query->row()->password;
        
		if (password_verify($password, $pass_hash)) {
			$query = $this->db->get_where('authors', ['email' => $email, 'password' => $pass_hash]);
			return $query->row();
		}
	}
	
}

