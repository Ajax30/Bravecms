<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function posts($category_id) {
		//load and configure pagination 
		$this->load->library('pagination');
		$config['base_url'] = base_url('/categories/posts/' . $category_id);
		$config['query_string_segment'] = 'page';
		$config['total_rows'] =	$this->Posts_model->get_num_rows_by_category($category_id);
		$config['per_page'] = 12;
		
		if (!isset($_GET[$config['query_string_segment']]) || $_GET[$config['query_string_segment']] < 1) {
			$_GET[$config['query_string_segment']] = 1;
		}
		
		$limit = $config['per_page'];
		$offset = ($this->input->get($config['query_string_segment']) - 1) * $limit;
		$this->pagination->initialize($config);

		$data = $this->Static_model->get_static_data();
		$data['pages'] = $this->Pages_model->get_pages();
		$data['categories'] = $this->Categories_model->get_categories();
		$data['category_name'] = $this->Categories_model->get_category($category_id)->name;
		$data['posts'] = $this->Posts_model->get_posts_by_category($category_id, $limit, $offset);

		$this->load->view('dashboard/partials/header', $data);
		$this->load->view('categories/posts');
		$this->load->view('dashboard/partials/footer');
	}

}