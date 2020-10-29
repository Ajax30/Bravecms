<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts_model extends CI_Model {

	public function get_num_rows() {
		$query = $this->db->get('posts');
		return $query->num_rows(); 
	}

	public function get_posts($limit, $offset) {
    $this->db->select('posts.*,categories.name as post_category');
    $this->db->order_by('posts.id', 'DESC');
    $this->db->join('categories', 'posts.cat_id = categories.id', 'inner');
    $query = $this->db->get('posts', $limit, $offset);
    return $query->result();
	}

	public function search_count($expression) {
		$query = $this->db->like('title', $expression)
									->or_like('description', $expression)
									->or_like('content', $expression);
		$query = $this->db->get('posts');
		return $query->num_rows();  
	}

	public function search($expression, $limit, $offset) {
		$query = $this->db->like('title', $expression)
											->or_like('description', $expression)
											->or_like('content', $expression);
		$this->db->select('posts.*,categories.name as post_category');
		$this->db->order_by('posts.id', 'DESC');
		$this->db->join('categories', 'posts.cat_id = categories.id', 'inner');
		$query = $this->db->get('posts', $limit, $offset);
		return $query->result();
	}

	public function sidebar_posts($limit, $offset) {
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get('posts', $limit, $offset);
		return $query->result();
	}

	public function get_num_rows_by_category($category_id) { 
		$query = $this->db->get_where('posts', array('cat_id' => $category_id));
		return $query->num_rows(); 
	}

	public function get_posts_by_category($category_id, $limit, $offset) {
		$this->db->select('posts.*');
		$this->db->order_by('posts.id', 'DESC');
		$this->db->limit($limit, $offset);
		$this->db->join('categories', 'categories.id = posts.cat_id');
		$query = $this->db->get_where('posts', array('cat_id' => $category_id));
		return $query->result();
	}

	public function count_posts_in_category($category_id) {
		return $this->db
			->where('cat_id', $category_id)
			->count_all_results('posts');
	}

	public function get_posts_by_author($authorid, $limit, $offset) {
		$this->db->select('posts.*,categories.name as post_category');
    $this->db->order_by('posts.id', 'DESC');
    $this->db->limit($limit, $offset);
    $this->db->join('categories', 'posts.cat_id = categories.id', 'inner');
		$query = $this->db->get_where('posts', array('posts.author_id' => $authorid));
		return $query->result();
	}

	public function posts_by_author_count($authorid) {
		$query = $this->db->get_where('posts', array('posts.author_id' => $authorid));
		return $query->num_rows();  
	}

	public function posts_author($authorid) {
		$this->db->select('authors.first_name,last_name');
		$query = $this->db->get_where('authors', array('id' => $authorid));
		return $query->row();
	}

	/* Single post */
	public function get_post($slug) {
		$query = $this->db->get_where('posts', array('slug' => $slug));
		if ($query->num_rows() > 0) {
			$data = $query->row();
      // run separate query for author name
			$author_query = $this->db->get_where('authors', array('id' => $data->author_id));
			if ($author_query->num_rows() == 1) {
				$author = $author_query->row();
				$data->first_name = $author->first_name;
				$data->last_name = $author->last_name;
				$data->avatar = $author->avatar;              
			} else {
				$data->first_name = 'Unknown';
				$data->last_name = '';
				$data->avatar = '';
			}
			return $data;
		}
	}

	public function slug_count($slug, $id){
    $this->db->select('count(*) as slugcount');
    $this->db->from('posts');
    $this->db->where('slug', $slug);
    // if its an update
    if ($id != null) {
        $this->db->where('id !=', $id);
    }
    $query = $this->db->get();
    return $query->row(0)->slugcount;
	}

  // Create, post
	public function create_post($post_image, $slug) {
		$data = [
			'title' => $this->input->post('title'),
			'slug' => $slug,
			'description' => $this->input->post('desc'),
			'content' => $this->input->post('body'),
			'post_image' => $post_image,
			'author_id' => $this->session->userdata('user_id'),
			'cat_id' => $this->input->post('category'),
			'created_at' => date('Y-m-d H:i:s')
		];
		return $this->db->insert('posts', $data);
	}

	// Update post
	public function update_post($id, $post_image, $slug) {
		$data = [
			'title' => $this->input->post('title'),
			'slug' => $slug,
			'description' => $this->input->post('desc'),
			'content' => $this->input->post('body'),
			'post_image' => $post_image,
			'cat_id' => $this->input->post('category'),
			'updated_at' => date('Y-m-d H:i:s')
		];

		$this->db->where('id', $id);
		return $this->db->update('posts', $data);
	}

	//Delete post
	public function delete_post($slug) {
		$this->db->where('slug', $slug);
		$this->db->delete('posts');
		return true;
	}

	public function delete_post_image($id) {
		$this->db->update('posts', array('post_image'=>'default.jpg'), ['id'=>$id]);
	}

}