<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comments_model extends CI_Model {

	public function get_num_rows() {
		$query = $this->db->get('comments');
		return $query->num_rows(); 
	}

	public function create_comment($post_id) {
		$data = [
			'post_id' => $post_id,
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'comment' => $this->input->post('message'),
			'aproved' => 0,
			'created_at' => date('Y-m-d H:i:s')
		];
		return $this->db->insert('comments', $data);
	}

	public function get_comments($post_id){
		$this->db->order_by('id');
		$query = $this->db->get_where('comments', array('post_id' => $post_id, 'aproved'=>1));
		return $query->result();
	}

	public function get_all_comments($limit, $offset) {
		$this->db->select('comments.*,posts.title as post_title, posts.slug as post_slug');
		$this->db->order_by('comments.id', 'DESC');
	  $this->db->limit($limit, $offset);
		$this->db->join('posts', 'posts.id = comments.post_id');        
		$query = $this->db->get('comments');
		return $query->result();
	}

	public function aprove($comment_id) {
		$comment = null;
		$updateQuery = $this->db->where('id', $comment_id)->update('comments', array('aproved' => 1));
		if ($updateQuery !== false) {
			$commentQuery = $this->db->get_where('comments', ['id' => $comment_id]);
			$comment = $commentQuery->row();
		}
		return $comment;
	}

	public function disaprove($comment_id) {
		$comment = null;
		$updateQuery = $this->db->where('id', $comment_id)->update('comments', array('aproved' => 0));
		if ($updateQuery !== false) {
			$commentQuery = $this->db->get_where('comments', ['id' => $comment_id]);
			$comment = $commentQuery->row();
		}
		return $comment;
	}

	public function delete_comment($comment_id) {
		$this->db->where('id', $comment_id);
		$this->db->delete('comments');
		return true;
	}
}